<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;
use App\Models\Personal;
use App\Models\Shift;
use App\Models\Area;
use App\Models\KLKHOGS;

class KLKHOGSController extends Controller
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


        $baseQuery = DB::table('klkh_ogs_t as ogs')
        ->leftJoin('users as us', 'ogs.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'ogs.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'ogs.shift_id', '=', 'sh.id')
        ->select(
            'ogs.id',
            'ogs.uuid',
            'ogs.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, ogs.created_at, 120) as tanggal_pembuatan'),
            'ogs.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'ogs.date',
            'ogs.time',
        )
        ->where('ogs.statusenabled', 'true')
        ->whereBetween(DB::raw('CONVERT(varchar, ogs.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $baseQuery->where('pic', Auth::user()->id);
        }

        $ogs = $baseQuery->get();

        return view('klkh.ogs.index', compact('ogs'));
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
        return view('klkh.ogs.insert', compact('users'));
    }

    public function post(Request $request)
    {
        // dd($request->all());

        try {

            $data = $request->all();

            KLKHOGS::create([
                'pic' => Auth::user()->id,
                'uuid' => (string) Uuid::uuid4()->toString(),
                'statusenabled' => 'true',
                'pit_id' => $data['pit'],
                'shift_id' => $data['shift'],
                'date' => $data['date'],
                'time' => $data['time'],
                'rata_padat_check' => $data['rata_padat_check'] ?? null,
                'rata_padat_note' => $data['rata_padat_note'] ?? null,
                'parkir_terpisah_check' => $data['parkir_terpisah_check'] ?? null,
                'parkir_terpisah_note' => $data['parkir_terpisah_note'] ?? null,
                'ceceran_oli_check' => $data['ceceran_oli_check'] ?? null,
                'ceceran_oli_note' => $data['ceceran_oli_note'] ?? null,
                'genangan_air_check' => $data['genangan_air_check'] ?? null,
                'genangan_air_note' => $data['genangan_air_note'] ?? null,
                'rambu_darurat_check' => $data['rambu_darurat_check'] ?? null,
                'rambu_darurat_note' => $data['rambu_darurat_note'] ?? null,
                'rambu_lalulintas_check' => $data['rambu_lalulintas_check'] ?? null,
                'rambu_lalulintas_note' => $data['rambu_lalulintas_note'] ?? null,
                'rambu_berhenti_check' => $data['rambu_berhenti_check'] ?? null,
                'rambu_berhenti_note' => $data['rambu_berhenti_note'] ?? null,
                'rambu_masuk_keluar_check' => $data['rambu_masuk_keluar_check'] ?? null,
                'rambu_masuk_keluar_note' => $data['rambu_masuk_keluar_note'] ?? null,
                'rambu_ogs_check' => $data['rambu_ogs_check'] ?? null,
                'rambu_ogs_note' => $data['rambu_ogs_note'] ?? null,
                'papan_nama_check' => $data['papan_nama_check'] ?? null,
                'papan_nama_note' => $data['papan_nama_note'] ?? null,
                'emergency_call_check' => $data['emergency_call_check'] ?? null,
                'emergency_call_note' => $data['emergency_call_note'] ?? null,
                'tempat_sampah_check' => $data['tempat_sampah_check'] ?? null,
                'tempat_sampah_note' => $data['tempat_sampah_note'] ?? null,
                'penyalur_petir_check' => $data['penyalur_petir_check'] ?? null,
                'penyalur_petir_note' => $data['penyalur_petir_note'] ?? null,
                'tempat_istirahat_check' => $data['tempat_istirahat_check'] ?? null,
                'tempat_istirahat_note' => $data['tempat_istirahat_note'] ?? null,
                'apar_check' => $data['apar_check'] ?? null,
                'apar_note' => $data['apar_note'] ?? null,
                'kotak_p3k_check' => $data['kotak_p3k_check'] ?? null,
                'kotak_p3k_note' => $data['kotak_p3k_note'] ?? null,
                'penerangan_check' => $data['penerangan_check'] ?? null,
                'penerangan_note' => $data['penerangan_note'] ?? null,
                'kamar_mandi_check' => $data['kamar_mandi_check'] ?? null,
                'kamar_mandi_note' => $data['kamar_mandi_note'] ?? null,
                'permukaan_tanah_check' => $data['permukaan_tanah_check'] ?? null,
                'permukaan_tanah_note' => $data['permukaan_tanah_note'] ?? null,
                'akses_jalan_check' => $data['akses_jalan_check'] ?? null,
                'akses_jalan_note' => $data['akses_jalan_note'] ?? null,
                'tinggi_tanggul_check' => $data['tinggi_tanggul_check'] ?? null,
                'tinggi_tanggul_note' => $data['tinggi_tanggul_note'] ?? null,
                'lebar_bus_check' => $data['lebar_bus_check'] ?? null,
                'lebar_bus_note' => $data['lebar_bus_note'] ?? null,
                'lebar_hd_check' => $data['lebar_hd_check'] ?? null,
                'lebar_hd_note' => $data['lebar_hd_note'] ?? null,
                'jalur_hd_check' => $data['jalur_hd_check'] ?? null,
                'jalur_hd_note' => $data['jalur_hd_note'] ?? null,
                'additional_notes' => $data['additional_notes'] ?? null,
                'supervisor' => $data['supervisor'] ?? null,
                'superintendent' => $data['superintendent'] ?? null,
            ]);

            return redirect()->route('klkh.ogs')->with('success', 'KLKH OGS berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.ogs')->with('info', nl2br('KLKH OGS gagal dibuat..\n' . $th->getMessage()));
        }
    }

    public function delete($id)
    {
        try {
            KLKHOGS::where('id', $id)->update([
                'statusenabled' => 'false',
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.ogs')->with('success', 'KLKH OGS berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.ogs')->with('info', nl2br('KLKH OGS gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
