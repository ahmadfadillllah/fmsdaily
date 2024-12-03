<?php

namespace App\Http\Controllers;

use App\Models\PayloadRitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayloadRitationController extends Controller
{
    //
    public function index()
    {
        return redirect()->back()->with('info', 'Maaf fungsi ini belum tersedia');
        $getDate = Carbon::now();

        // Waktu mulai dan berhenti untuk rentang waktu pertama
        $start1 = Carbon::parse($getDate)->subHour()->format('Ymd H:00:00');
        $stop1 = Carbon::parse($getDate)->format('Ymd H:00:00');

        // Waktu mulai dan berhenti untuk rentang waktu kedua
        $start3 = Carbon::parse($getDate)->subHours(3)->format('Ymd H:00:00');
        $stop3 = Carbon::parse($getDate)->format('Ymd H:00:00');

        // Waktu mulai dan berhenti untuk shift
        if (Carbon::parse($getDate)->format('H:i:s') < '07:30:00') {
            $start = Carbon::parse($getDate)->subDay()->setTime(7, 30)->toDateTimeString();
        } else {
            $start = Carbon::parse($getDate)->setTime(7, 30)->toDateTimeString();
        }

        if (Carbon::parse($getDate)->format('H:i:s') >= '07:30:00') {
            $stop = Carbon::parse($getDate)->addDay()->setTime(7, 30)->toDateTimeString();
        } else {
            $stop = Carbon::parse($getDate)->setTime(7, 30)->toDateTimeString();
        }

        // Query untuk memasukkan data ke dalam tabel sementara
        $data = DB::table('FOCUS.dbo.PRD_RITATION as A')
    ->leftJoin('FOCUS.dbo.FLT_VEHICLE as B', 'A.VHC_ID', '=', 'B.VHC_ID')
    ->leftJoin('FOCUS.dbo.FLT_EQUTYPE as C', 'B.EQU_TYPEID', '=', 'C.EQU_TYPEID')
    ->select(
        'C.DEFCAPACITY',
        'B.EQU_TYPEID',
        'A.VHC_ID',
        'A.OPR_REPORTTIME',
        DB::raw('FORMAT(CASE WHEN CAST(A.OPR_REPORTTIME AS TIME) < \'07:30:00\' THEN DATEADD(DAY, -1, A.OPR_REPORTTIME) ELSE A.OPR_REPORTTIME END, \'yyyyMMdd\') AS DATE'),
        DB::raw('SUM(A.RIT_TONNAGE) AS LOD_TONNAGE'),  // Menjumlahkan LOD_TONNAGE per VHC_ID
        // Menambahkan kolom untuk menghitung 1 jam terakhir
        DB::raw('CASE
                    WHEN A.OPR_REPORTTIME >= DATEADD(HOUR, -1, GETDATE()) THEN 1
                    ELSE 0
                 END AS LAST_HOUR')
    )
    ->whereBetween('A.OPR_REPORTTIME', [$start, $stop])
    ->groupBy(
        'C.DEFCAPACITY',
        'B.EQU_TYPEID',
        'A.VHC_ID',
        'A.OPR_REPORTTIME'
    )
    ->get();

        dd($data);


        // return view('payloadritation.index');
    }
}
