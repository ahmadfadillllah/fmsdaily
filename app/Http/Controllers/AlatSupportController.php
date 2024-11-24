<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
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
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->select(
            'al.daily_report_id as id',
            'al.jenis_unit',
            'al.alat_unit as nomor_unit',
            'al.nik_operator',
            'al.nama_operator',
            'al.tanggal_operator',
            'al.shift_operator',
            'us.nik as nik_foreman',
            'us.name as nama_foreman',
            'dr.tanggal_dasar as tanggal_pelaporan',
            'dr.shift_dasar as shift',
            'dr.area as area',
            'dr.lokasi as lokasi',
            'dr.nik_supervisor',
            'dr.nama_supervisor',
            'dr.nik_superintendent',
            'dr.nama_superintendent',
            'al.hm_awal',
            'al.hm_akhir',
            'al.hm_cash',
            'al.material'
        )
        ->whereBetween('tanggal_dasar', [$startTimeFormatted, $endTimeFormatted])
        ->get();

        return view('alat-support.index', compact('support'));
    }
}
