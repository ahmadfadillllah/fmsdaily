<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\KLKHBatuBara;
use App\Models\Personal;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;

class KLKHBatuBaraController extends Controller
{
    //
    public function index(Request $request)
    {
        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }


        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');


        $baseQuery = DB::table('klkh_batubara_t as lp')
        ->leftJoin('users as us', 'lp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lp.shift_id', '=', 'sh.id')
        ->select(
            'lp.id',
            'lp.uuid',
            'lp.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, lp.created_at, 120) as tanggal_pembuatan'),
            'lp.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'lp.date',
            'lp.time',
        )
        ->where('lp.statusenabled', 'true')
        ->whereBetween(DB::raw('CONVERT(varchar, lp.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $baseQuery->where('pic', Auth::user()->id);
        }

        $loading = $baseQuery->get();



        return view('klkh.batu-bara.index', compact('loading'));
    }

    public function preview($uuid)
    {
        $ld = DB::table('klkh_batubara_t as lp')
        ->leftJoin('users as us', 'lp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lp.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'lp.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'lp.superintendent', '=', 'gl.NRP')
        ->select(
            'lp.*',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'us.name as nama_pic',
            'spv.PERSONALNAME as nama_supervisor',
            'gl.PERSONALNAME as nama_superintendent'
            )
        ->where('lp.statusenabled', 'true')
        ->where('lp.uuid', $uuid)->first();

        if($ld == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $ld->generate_pic = $ld->pic ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $ld->nama_pic) : null;
            $ld->verified_supervisor = $ld->verified_supervisor != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $ld->nama_supervisor) : null;
            $ld->verified_superintendent = $ld->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $ld->nama_superintendent) : null;
        }

        return view('klkh.batu-bara.preview', compact('ld'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();
        $superintendent = Personal::where('ROLETYPE', 4)->get();
        $pit = Area::where('statusenabled', 'true')->get();
        $shift = Shift::where('statusenabled', 'true')->get();

        $users = [
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'pit' => $pit,
            'shift' => $shift,
        ];
        return view('klkh.batu-bara.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
            $dataToInsert = [
                    'pic' => Auth::user()->id,
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => 'true',
                    'pit_id' => $data['pit'],
                    'shift_id' => $data['shift'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'loading_point_check' => $data['loading_point_check'] ?? null,
                    'loading_point_note' => $data['loading_point_note'] ?? null,
                    'permukaan_front_check' => $data['permukaan_front_check'] ?? null,
                    'permukaan_front_note' => $data['permukaan_front_note'] ?? null,
                    'tinggi_bench_check' => $data['tinggi_bench_check'] ?? null,
                    'tinggi_bench_note' => $data['tinggi_bench_note'] ?? null,
                    'lebar_loading_check' => $data['lebar_loading_check'] ?? null,
                    'lebar_loading_note' => $data['lebar_loading_note'] ?? null,
                    'drainase_check' => $data['drainase_check'] ?? null,
                    'drainase_note' => $data['drainase_note'] ?? null,
                    'penempatan_unit_check' => $data['penempatan_unit_check'] ?? null,
                    'penempatan_unit_note' => $data['penempatan_unit_note'] ?? null,
                    'pelabelan_seam_check' => $data['pelabelan_seam_check'] ?? null,
                    'pelabelan_seam_note' => $data['pelabelan_seam_note'] ?? null,
                    'lampu_unit_check' => $data['lampu_unit_check'] ?? null,
                    'lampu_unit_note' => $data['lampu_unit_note'] ?? null,
                    'unit_bersih_check' => $data['unit_bersih_check'] ?? null,
                    'unit_bersih_note' => $data['unit_bersih_note'] ?? null,
                    'penerangan_area_check' => $data['penerangan_area_check'] ?? null,
                    'penerangan_area_note' => $data['penerangan_area_note'] ?? null,
                    'housekeeping_check' => $data['housekeeping_check'] ?? null,
                    'housekeeping_note' => $data['housekeeping_note'] ?? null,
                    'pengukuran_roof_check' => $data['pengukuran_roof_check'] ?? null,
                    'pengukuran_roof_note' => $data['pengukuran_roof_note'] ?? null,
                    'cleaning_batubara_check' => $data['cleaning_batubara_check'] ?? null,
                    'cleaning_batubara_note' => $data['cleaning_batubara_note'] ?? null,
                    'genangan_air_check' => $data['genangan_air_check'] ?? null,
                    'genangan_air_note' => $data['genangan_air_note'] ?? null,
                    'big_coal_check' => $data['big_coal_check'] ?? null,
                    'big_coal_note' => $data['big_coal_note'] ?? null,
                    'stock_material_check' => $data['stock_material_check'] ?? null,
                    'stock_material_note' => $data['stock_material_note'] ?? null,
                    'lebar_jalan_angkut_check' => $data['lebar_jalan_angkut_check'] ?? null,
                    'lebar_jalan_angkut_note' => $data['lebar_jalan_angkut_note'] ?? null,
                    'lebar_jalan_tikungan_check' => $data['lebar_jalan_tikungan_check'] ?? null,
                    'lebar_jalan_tikungan_note' => $data['lebar_jalan_tikungan_note'] ?? null,
                    'super_elevasi_check' => $data['super_elevasi_check'] ?? null,
                    'super_elevasi_note' => $data['super_elevasi_note'] ?? null,
                    'safety_berm_check' => $data['safety_berm_check'] ?? null,
                    'safety_berm_note' => $data['safety_berm_note'] ?? null,
                    'tinggi_tanggul_check' => $data['tinggi_tanggul_check'] ?? null,
                    'tinggi_tanggul_note' => $data['tinggi_tanggul_note'] ?? null,
                    'safety_post_check' => $data['safety_post_check'] ?? null,
                    'safety_post_note' => $data['safety_post_note'] ?? null,
                    'drainase_genangan_air_check' => $data['drainase_genangan_air_check'] ?? null,
                    'drainase_genangan_air_note' => $data['drainase_genangan_air_note'] ?? null,
                    'median_jalan_check' => $data['median_jalan_check'] ?? null,
                    'median_jalan_note' => $data['median_jalan_note'] ?? null,
                    'additional_notes' => $data['additional_notes'] ?? null,
                    'superintendent' => $data['superintendent'] ?? null,
            ];
            if (Auth::user()->role == 'SUPERVISOR') {
                $dataToInsert['supervisor'] = Auth::user()->nik;
                $dataToInsert['verified_supervisor'] = Auth::user()->nik;
            }

            if (Auth::user()->role == 'FOREMAN') {
                $dataToInsert['foreman'] = Auth::user()->nik;
                $dataToInsert['verified_foreman'] = Auth::user()->nik;
            }

            KLKHBatuBara::create($dataToInsert);

            return redirect()->route('klkh.batubara')->with('success', 'KLKH Batubara berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.batubara')->with('info', nl2br('KLKH Batubara gagal dibuat..\n' . $th->getMessage()));
        }

    }

    public function delete($id)
    {
        try {
            KLKHBatuBara::where('id', $id)->update([
                'statusenabled' => 'false',
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.batubara')->with('success', 'KLKH Batubara berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.batubara')->with('info', nl2br('KLKH Batubara gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
