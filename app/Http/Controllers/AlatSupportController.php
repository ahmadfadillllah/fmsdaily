<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Auth;

class AlatSupportController extends Controller
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

        $support = DB::table('alat_support_t as al')
        ->leftJoin('daily_report_t as dr', 'al.daily_report_id', '=', 'dr.id')
        ->leftJoin('shift_m as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('shift_m as sh2', 'al.shift_operator_id', '=', 'sh2.id')
        ->leftJoin('area_m as ar', 'dr.area_id', '=', 'ar.id')
        ->leftJoin('lokasi_m as lok', 'dr.lokasi_id', '=', 'lok.id')
        // ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'al.daily_report_id as id',
            'al.jenis_unit',
            'al.alat_unit as nomor_unit',
            'al.nik_operator',
            'al.nama_operator',
            'al.tanggal_operator',
            'sh2.keterangan as shift_operator',
            'dr.nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.tanggal_dasar as tanggal_pelaporan',
            'sh.keterangan as shift',
            'ar.keterangan as area',
            'lok.keterangan as lokasi',
            'dr.nik_supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'al.hm_awal',
            'al.hm_akhir',
            'al.hm_cash',
            'al.keterangan'
        )
        ->where('al.statusenabled', 'true')
        ->whereBetween('tanggal_dasar', [$startTimeFormatted, $endTimeFormatted]);
        if (Auth::user()->role !== 'ADMIN') {
            $support->where('dr.foreman_id', Auth::user()->id);
        }

        $support = $support->get();

        return view('alat-support.index', compact('support'));
    }
}
