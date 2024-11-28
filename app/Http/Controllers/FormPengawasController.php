<?php

namespace App\Http\Controllers;

use App\Models\AlatSupport;
use App\Models\CatatanPengawas;
use App\Models\DailyReport;
use App\Models\FrontLoading;
use App\Models\Material;
use App\Models\Personal;
use App\Models\Unit;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;

class FormPengawasController extends Controller
{
    //
    public function index()
    {

        $daily = DailyReport::where('foreman_id', Auth::user()->id)
        ->whereDate('created_at', now())
        ->get();

        // if(empty($daily)){
        //     return view('form-pengawas.empty');
        // }
        $ex = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'like', 'EX%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $nomor_unit = Unit::select([
            'VHC_ID'
        ])->get();

        $operator = Personal::select
        (
            'ID', 'NRP', 'USERNAME', 'PERSONALNAME', 'EPIGONIUSERNAME', 'ROLETYPE', 'SYS_CREATEDBY', 'SYS_UPDATEDBY'
        )->where('ROLETYPE', 0)->get();

        $supervisor = Personal::select
        (
            'ID', 'NRP', 'USERNAME', 'PERSONALNAME', 'EPIGONIUSERNAME', 'ROLETYPE', 'SYS_CREATEDBY', 'SYS_UPDATEDBY'
        )->where('ROLETYPE', 3)->get();

        $superintendent = Personal::select
        (
            'ID', 'NRP', 'USERNAME', 'PERSONALNAME', 'EPIGONIUSERNAME', 'ROLETYPE', 'SYS_CREATEDBY', 'SYS_UPDATEDBY'
        )->where('ROLETYPE', 4)->get();


        $data = [
            'operator' => $operator,
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'EX' => $ex,
            'EX' => $ex,
            'nomor_unit' => $nomor_unit,
        ];
        return view('form-pengawas.index', compact('data', 'daily'));
    }

    public function users(Request $request)
    {
        $nik = $request->query('nik');

        $data['users'] = Personal::where('ROLETYPE', 2)->get();

        // Mencari user berdasarkan NIK
        $user = $data['users']->firstWhere('NRP', $nik);

        if ($user) {
            return Response::json([
                'success' => true,
                'name' => $user->PERSONALNAME,
                'by' => 'ahmadfadillah'
            ]);
        } else {
            return Response::json([
                'success' => false,
                'message' => 'User tidak ditemukan',
                'by' => 'ahmadfadillah'
            ]);
        }
    }

    public function post(Request $request)
    {

        // dd($request->all());
        try {
            return DB::transaction(function () use ($request) {
                // insert daily report
                $supervisor = $request->nik_supervisor ?? [] ;
                $superintendent = $request->nik_superintendent ?? [];

                $nikSlotsSV = explode('|', $supervisor);
                $nikSupervisor = $nikSlotsSV[0];
                $namaSupervisor = trim($nikSlotsSV[1]);

                $nikSlotsSI = explode('|', $superintendent);
                $nikSuperintendent = $nikSlotsSI[0];
                $namaSuperintendent = trim($nikSlotsSI[1]);

                $dailyReport = DailyReport::create([
                    'foreman_id' => Auth::user()->id,
                    'statusenabled' => 'true',
                    'tanggal_dasar' => now()->parse($request->tanggal_dasar)->format('Y-m-d'),
                    'shift_dasar' => $request->shift_dasar,
                    'area' => $request->area,
                    'lokasi' => $request->lokasi,
                    'nik_supervisor' => $nikSupervisor,
                    'nama_supervisor' => $namaSupervisor,
                    'nik_superintendent' => $nikSuperintendent,
                    'nama_superintendent' => $namaSuperintendent
                ]);

                // insert front loading
                if (!empty($request->front_loading)) {
                    foreach ($request->front_loading as $front_unit) {
                        $timeData = $front_unit["time"] ?? [];

                        $morning = [];
                        $night = [];

                        foreach ($timeData as $time) {
                            $timeSlots = explode('|', $time);
                            if (isset($timeSlots[0])) {
                                $morning[] = trim($timeSlots[0]); // Waktu siang
                            }
                            if (isset($timeSlots[1])) {
                                $night[] = trim($timeSlots[1]); // Waktu malam
                            }
                        }

                        FrontLoading::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => 'true',
                            'nomor_unit' => $front_unit["nomor_unit"],
                            'siang' => json_encode($morning),
                            'malam' => json_encode($night),
                        ]);
                    }
                }

                // insert alat support
                // if (!empty($request->supports)) {
                if (!empty($request->alat_support)) {
                    foreach ($request->alat_support as $value) {

                        $operator = explode('|',  $value['namaSupport']);
                        $nikOperator = $operator[0];
                        $namaOperator = trim($operator[1]);
                        $jenisUnit = substr($value['unitSupport'], 0, 2);

                        AlatSupport::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => 'true',
                            'jenis_unit' => $jenisUnit,
                            'alat_unit' => $value['unitSupport'],
                            'nik_operator' => $nikOperator,
                            'nama_operator' => $namaOperator,
                            'tanggal_operator' => \Carbon\Carbon::createFromFormat('m/d/Y', $value['tanggalSupport'])->format('Y-m-d'),
                            'shift_operator' => $value['shiftSupport'],
                            'hm_awal' => $value['hmAwalSupport'],
                            'hm_akhir' => $value['hmAkhirSupport'],
                            'hm_total' => $value['hmAkhirSupport'] - $value['hmAwalSupport'],
                            'hm_cash' => $value['hmCashSupport'],
                            'keterangan' => $value['keteranganSupport'],
                        ]);
                    }
                }

                if (!empty($request->catatan)) {
                    foreach ($request->catatan as $catatan) {
                        CatatanPengawas::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => 'true',
                            'jam_start' => $catatan['start_catatan'],
                            'jam_stop' => $catatan['end_catatan'],
                            'keterangan' => $catatan['description_catatan'],
                        ]);
                    }
                }


                return redirect()->route('form-pengawas.index')->with('success', 'Laporan berhasil dibuat');
            });
        } catch (\Throwable $th) {
            return redirect()->route('form-pengawas.index')->with('info', 'Laporan gagal dibuat.. \n' . $th->getMessage());
        }
    }

    public function getOperatorByNIK($nik)
    {
        // Data operator
        $data = Personal::select(
            'NRP as MAT_ID',
            'PERSONALNAME as MAT_DESC',
            'ROLETYPE as MAT_CATEGORY',
        )
        ->where('ROLETYPE', 0)->get();

        // Cari operator berdasarkan NIK
        $operator = $data->firstWhere('MAT_ID', $nik);

        if ($operator) {
            return response()->json([
                'success' => true,
                'nama' => $operator->MAT_DESC,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Operator tidak ditemukan',
            ]);
        }
    }

    public function show(Request $request)
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


        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_superintendent', '=', 'gl.NRP')
        ->select(
            'dr.id',
            'dr.tanggal_dasar as tanggal',
            'dr.shift_dasar as shift',
            'dr.area',
            'dr.lokasi',
            'dr.nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent',
            'gl.PERSONALNAME as nama_superintendent',
        )
        ->whereBetween('dr.tanggal_dasar', [$startTimeFormatted, $endTimeFormatted])
        ->where('dr.statusenabled', 'true');
        if (Auth::user()->role !== 'ADMIN') {
            $daily->where('dr.foreman_id', Auth::user()->id);
        }

        $daily = $daily->get();

        return view('form-pengawas.daftar.index', compact('daily'));
    }

    public function download($id)
    {

        // $daily = DB::table('daily_report_t as dr')
        // ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        // ->leftJoin('front_loading_t as fl', 'dr.id', '=', 'fl.daily_report_id')
        // ->leftJoin('alat_support_t as al', 'dr.id', '=', 'al.daily_report_id')
        // ->leftJoin('catatan_pengawas_t as cp', 'dr.id', '=', 'cp.daily_report_id')
        // ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        // ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_superintendent', '=', 'gl.NRP')
        // ->select(
        //     'dr.tanggal_dasar as tanggal_daily',
        //     'dr.shift_dasar as shift_daily',
        //     'dr.area as area_daily',
        //     'dr.lokasi as lokasi_daily',
        //     'us.nik as nik_foreman_daily',
        //     'us.name as nama_foreman_daily',
        //     'dr.nik_supervisor as nik_supervisor_daily',
        //     'spv.PERSONALNAME as nama_supervisor_daily',
        //     'dr.nik_superintendent as nik_superintendent_daily',
        //     'gl.PERSONALNAME as nama_superintendent_daily',
        //     'fl.nomor_unit as nomor_unit_front',
        //     'fl.siang as siang_front',
        //     'fl.malam as malam_front',
        //     'al.jenis_unit as jenis_unit_support',
        //     'al.alat_unit as alat_unit_support',
        //     'al.nik_operator as nik_operator_support',
        //     'al.nama_operator as nama_operator_support',
        //     'al.tanggal_operator as tanggal_operator_support',
        //     'al.shift_operator as shift_operator_support',
        //     'al.hm_awal as hm_awal_support',
        //     'al.hm_akhir as hm_akhir_support',
        //     'al.hm_total as hm_total_support',
        //     'al.hm_cash as hm_cash_support',
        //     'al.material as material_support',
        //     'cp.jam_start as jam_start_catatan',
        //     'cp.jam_stop as jam_stop_catatan',
        //     'cp.keterangan as keterangan_catatan',
        //     )
        // ->get();

        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_superintendent', '=', 'gl.NRP')
        ->select(
            'dr.foreman_id as id_foreman',
            'dr.tanggal_dasar as tanggal',
            'dr.shift_dasar as shift',
            'dr.area',
            'dr.lokasi',
            'us.nik as nik_foreman',
            'us.name as nama_foreman',
            'dr.nik_supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent as nik_superintendent',
            'gl.PERSONALNAME as nama_superintendent'
        )->where('dr.id', $id)->first();

        $support = DB::table('alat_support_t as al')
        ->leftJoin('daily_report_t as dr', 'al.daily_report_id', '=', 'dr.id')
        ->select(
            'al.alat_unit as nomor_unit',
            'al.nama_operator',
            'al.hm_awal',
            'al.hm_akhir',
            'al.hm_cash',
            'al.keterangan',
            'al.shift_operator as shift',
            'al.tanggal_operator as tanggal',
        )
        ->where('al.daily_report_id', $id)->get();

        $catatan = DB::table('catatan_pengawas_t as cp')
        ->leftJoin('daily_report_t as dr', 'cp.daily_report_id', '=', 'dr.id')
        ->select(
            'cp.jam_start',
            'cp.jam_stop',
            'cp.keterangan',
        )
        ->where('cp.daily_report_id', $id)->get();

        $data = [
            'daily' => $daily,
            'support' => $support,
            'catatan' => $catatan,
        ];

        // $pdf = PDF::loadView('form-pengawas.download', array(
        //     'data' => $data,
        // ))->setPaper('a4', 'portrait');
        // return $pdf->download($data['daily']->tanggal.'_'.$data['daily']->nik_foreman.'_'.$data['daily']->nama_foreman.'.pdf');

        return view('form-pengawas.download', compact('data'));
    }
}
