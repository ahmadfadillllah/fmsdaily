<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Auth;

class CatatanPengawasController extends Controller
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

        $note = DB::table('catatan_pengawas_t as cp')
        ->leftJoin('daily_report_t as dr', 'cp.daily_report_id', 'dr.id')
        ->leftJoin('users as us', 'dr.foreman_id', 'us.id')
        ->select(
            'cp.daily_report_id as id',
            'dr.tanggal_dasar as tanggal_pelaporan',
            'dr.shift_dasar as shift',
            'dr.area as area',
            'dr.lokasi as lokasi',
            'us.nik as nik_foreman',
            'us.name as nama_foreman',
            'dr.nik_supervisor',
            'dr.nama_supervisor',
            'dr.nik_superintendent',
            'dr.nama_superintendent',
            'cp.jam_start',
            'cp.jam_stop',
            'cp.keterangan'
        )
        ->where('cp.statusenabled', 'true')
        ->whereBetween('tanggal_dasar', [$startTimeFormatted, $endTimeFormatted]);
        if (Auth::user()->role !== 'ADMIN') {
            $note->where('dr.foreman_id', Auth::user()->id);
        }

        $note = $note->get();

        return view('catatan-pengawas.index', compact('note'));
    }
}
