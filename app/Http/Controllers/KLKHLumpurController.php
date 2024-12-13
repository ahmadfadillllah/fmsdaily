<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\KLKHLumpur;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\Personal;
use App\Models\Shift;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KLKHLumpurController extends Controller
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


        $baseQuery = DB::table('klkh_lumpur_t as lum')
        ->leftJoin('users as us', 'lum.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lum.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lum.shift_id', '=', 'sh.id')
        ->select(
            'lum.id',
            'lum.uuid',
            'lum.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, lum.created_at, 120) as tanggal_pembuatan'),
            'lum.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'lum.date',
            'lum.time',
        )
        ->where('lum.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, lum.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $baseQuery->where('pic', Auth::user()->id);
        }

        $lumpur = $baseQuery->get();

        return view('klkh.lumpur.index', compact('lumpur'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();
        $superintendent = Personal::where('ROLETYPE', 4)->get();
        $pit = Area::where('statusenabled', true)->get();
        $shift = Shift::where('statusenabled', true)->get();

        $users = [
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'pit' => $pit,
            'shift' => $shift,
        ];
        return view('klkh.lumpur.insert', compact('users'));
    }

    public function post(Request $request)
    {
        // dd($request->all());

        try {

            $data = $request->all();
            $dataToInsert = [
                    'pic' => Auth::user()->id,
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => true,
                    'pit_id' => $data['pit'],
                    'shift_id' => $data['shift'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'unit_breakdown_check' => $data['unit_breakdown_check'] ?? null,
                    'unit_breakdown_note' => $data['unit_breakdown_note'] ?? null,
                    'rambu_check' => $data['rambu_check'] ?? null,
                    'rambu_note' => $data['rambu_note'] ?? null,
                    'grade_check' => $data['grade_check'] ?? null,
                    'grade_note' => $data['grade_note'] ?? null,
                    'unit_maintenance_check' => $data['unit_maintenance_check'] ?? null,
                    'unit_maintenance_note' => $data['unit_maintenance_note'] ?? null,
                    'debu_check' => $data['debu_check'] ?? null,
                    'debu_note' => $data['debu_note'] ?? null,
                    'lebar_jalan_check' => $data['lebar_jalan_check'] ?? null,
                    'lebar_jalan_note' => $data['lebar_jalan_note'] ?? null,
                    'blind_spot_check' => $data['blind_spot_check'] ?? null,
                    'blind_spot_note' => $data['blind_spot_note'] ?? null,
                    'kondisi_jalan_check' => $data['kondisi_jalan_check'] ?? null,
                    'kondisi_jalan_note' => $data['kondisi_jalan_note'] ?? null,
                    'tanggul_jalan_check' => $data['tanggul_jalan_check'] ?? null,
                    'tanggul_jalan_note' => $data['tanggul_jalan_note'] ?? null,
                    'pengelolaan_air_check' => $data['pengelolaan_air_check'] ?? null,
                    'pengelolaan_air_note' => $data['pengelolaan_air_note'] ?? null,
                    'crack_check' => $data['crack_check'] ?? null,
                    'crack_note' => $data['crack_note'] ?? null,
                    'luas_area_check' => $data['luas_area_check'] ?? null,
                    'luas_area_note' => $data['luas_area_note'] ?? null,
                    'tanggul_check' => $data['tanggul_check'] ?? null,
                    'tanggul_note' => $data['tanggul_note'] ?? null,
                    'free_dump_check' => $data['free_dump_check'] ?? null,
                    'free_dump_note' => $data['free_dump_note'] ?? null,
                    'alokasi_material_check' => $data['alokasi_material_check'] ?? null,
                    'alokasi_material_note' => $data['alokasi_material_note'] ?? null,
                    'beda_level_check' => $data['beda_level_check'] ?? null,
                    'beda_level_note' => $data['beda_level_note'] ?? null,
                    'tinggi_dumpingan_check' => $data['tinggi_dumpingan_check'] ?? null,
                    'tinggi_dumpingan_note' => $data['tinggi_dumpingan_note'] ?? null,
                    'genangan_air_check' => $data['genangan_air_check'] ?? null,
                    'genangan_air_note' => $data['genangan_air_note'] ?? null,
                    'dumpingan_bergelombang_check' => $data['dumpingan_bergelombang_check'] ?? null,
                    'dumpingan_bergelombang_note' => $data['dumpingan_bergelombang_note'] ?? null,
                    'bendera_acuan_check' => $data['bendera_acuan_check'] ?? null,
                    'bendera_acuan_note' => $data['bendera_acuan_note'] ?? null,
                    'rambu_jarak_check' => $data['rambu_jarak_check'] ?? null,
                    'rambu_jarak_note' => $data['rambu_jarak_note'] ?? null,
                    'tower_lamp_check' => $data['tower_lamp_check'] ?? null,
                    'tower_lamp_note' => $data['tower_lamp_note'] ?? null,
                    'penyalur_petir_check' => $data['penyalur_petir_check'] ?? null,
                    'penyalur_petir_note' => $data['penyalur_petir_note'] ?? null,
                    'muster_point_check' => $data['muster_point_check'] ?? null,
                    'muster_point_note' => $data['muster_point_note'] ?? null,
                    'safety_bundwall_check' => $data['safety_bundwall_check'] ?? null,
                    'safety_bundwall_note' => $data['safety_bundwall_note'] ?? null,
                    'ring_buoy_check' => $data['ring_buoy_check'] ?? null,
                    'ring_buoy_note' => $data['ring_buoy_note'] ?? null,
                    'sling_ware_check' => $data['sling_ware_check'] ?? null,
                    'sling_ware_note' => $data['sling_ware_note'] ?? null,
                    'pondok_pengawas_check' => $data['pondok_pengawas_check'] ?? null,
                    'pondok_pengawas_note' => $data['pondok_pengawas_note'] ?? null,
                    'struktur_pengawas_check' => $data['struktur_pengawas_check'] ?? null,
                    'struktur_pengawas_note' => $data['struktur_pengawas_note'] ?? null,
                    'life_jacket_bulldozer_check' => $data['life_jacket_bulldozer_check'] ?? null,
                    'life_jacket_bulldozer_note' => $data['life_jacket_bulldozer_note'] ?? null,
                    'emergency_number_check' => $data['emergency_number_check'] ?? null,
                    'emergency_number_note' => $data['emergency_number_note'] ?? null,
                    'life_jacket_spotter_check' => $data['life_jacket_spotter_check'] ?? null,
                    'life_jacket_spotter_note' => $data['life_jacket_spotter_note'] ?? null,
                    'additional_notes' => $data['additional_notes'] ?? null,
                    'superintendent' => $data['superintendent'] ?? null,
            ];
            if (Auth::user()->role == 'SUPERVISOR') {
                $dataToInsert['supervisor'] = Auth::user()->nik;
                $dataToInsert['verified_supervisor'] = Auth::user()->nik;
            }

            if (Auth::user()->role == 'FOREMAN') {
                $dataToInsert['supervisor'] = $data['supervisor'] ?? null;
                $dataToInsert['foreman'] = Auth::user()->nik;
                $dataToInsert['verified_foreman'] = Auth::user()->nik;
            }

            KLKHLumpur::create($dataToInsert);

            return redirect()->route('klkh.lumpur')->with('success', 'KLKH Dumping di Kolam Air/Lumpur berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.lumpur')->with('info', nl2br('KLKH Dumping di Kolam Air/Lumpur gagal dibuat..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $lpr = DB::table('klkh_lumpur_t as lpr')
        ->leftJoin('users as us', 'lpr.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lpr.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lpr.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'lpr.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'lpr.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'lpr.superintendent', '=', 'spt.NRP')
        ->select(
            'lpr.*',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'us.name as nama_pic',
            'gl.PERSONALNAME as nama_foreman',
            'spv.PERSONALNAME as nama_supervisor',
            'spt.PERSONALNAME as nama_superintendent'
            )
        ->where('lpr.statusenabled', true)
        ->where('lpr.uuid', $uuid)->first();

        if($lpr == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $lpr->verified_foreman = $lpr->verified_foreman != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $lpr->nama_foreman) : null;
            $lpr->verified_supervisor = $lpr->verified_supervisor != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $lpr->nama_supervisor) : null;
            $lpr->verified_superintendent = $lpr->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $lpr->nama_superintendent) : null;
        }

        return view('klkh.lumpur.preview', compact('lpr'));
    }

    public function delete($id)
    {
        try {
            KLKHLumpur::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.lumpur')->with('success', 'KLKH Dumping di Kolam Air/Lumpur berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.lumpur')->with('info', nl2br('KLKH Dumping di Kolam Air/Lumpur gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
