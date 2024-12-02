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
        // Mendapatkan tanggal sekarang
        $currentDate = now();

        // Logika untuk menentukan rentang waktu
        // Mendapatkan waktu shift
        $startShift = now()->setDate(2024, 11, 29)->setTime(0, 0);
        $stopShift = 6; // Stop shift dalam format jam

        $startShiftTime = now()->setDate(2024, 11, 29)->setTime(7, 30);
        $stopShiftTime = now()->setDate(2024, 11, 30)->setTime(7, 30);

        // Data pertama (query builder, tidak menggunakan `get()` di sini)
        $tDataQuery = DB::table('FOCUS.dbo.PRD_RITATION as A')
            ->join('FOCUS.dbo.FLT_VEHICLE as B', 'A.VHC_ID', '=', 'B.VHC_ID')
            ->join('FOCUS.dbo.FLT_EQUTYPE as C', 'B.EQU_TYPEID', '=', 'C.EQU_TYPEID')
            ->selectRaw("
                C.DEFCAPACITY as DEFAULTCAPACITY,
                B.EQU_TYPEID,
                A.VHC_ID,
                A.OPR_REPORTTIME,
                CONVERT(VARCHAR(8), CASE
                    WHEN CAST(A.OPR_REPORTTIME AS TIME) < '07:30:00'
                    THEN DATEADD(DAY, -1, A.OPR_REPORTTIME)
                    ELSE A.OPR_REPORTTIME
                    END, 112) AS DATE,
                A.RIT_TONNAGE as LOD_TONNAGE
            ");

        // Query payload untuk berbagai kondisi
        $payloadQueries = [
            ['range' => [$startShiftTime->subHour(), $startShiftTime], 'remark' => 'last hour payload'],
            ['range' => [$startShiftTime->subHours(3), $startShiftTime], 'remark' => 'last 3 hour payload'],
            ['range' => [$startShiftTime, $stopShiftTime], 'remark' => 'last shift payload'],
        ];

        $payloadResults = [];

        // Menambahkan query untuk menghitung distribusi payload
        foreach ($payloadQueries as $query) {
            $payloadResults[] = DB::table(DB::raw("({$tDataQuery->toSql()}) as T"))
                ->mergeBindings($tDataQuery) // Penting untuk menambahkan bindings
                ->selectRaw("
                    DEFAULTCAPACITY,
                    EQU_TYPEID,
                    VHC_ID,
                    AVG(CASE WHEN LOD_TONNAGE > 0 THEN LOD_TONNAGE END) AS LOAD_TONNAGE,
                    SUM(CASE WHEN LOD_TONNAGE < 95 THEN 1 ELSE 0 END) AS Less_95,
                    SUM(CASE WHEN LOD_TONNAGE BETWEEN 95 AND 110 THEN 1 ELSE 0 END) AS abc,
                    SUM(CASE WHEN LOD_TONNAGE > 110 THEN 1 ELSE 0 END) AS More_110,
                    '{$query['remark']}' AS REMARK
                ")
                ->whereBetween('OPR_REPORTTIME', $query['range'])
                ->groupBy('DEFAULTCAPACITY', 'EQU_TYPEID', 'VHC_ID')
                ->get();
        }

        // Penghitungan ritasi
        $ritQueries = [
            ['range' => [$startShiftTime->subHour(), $startShiftTime], 'remark' => 'last hour rit'],
            ['range' => [$startShiftTime->subHours(3), $startShiftTime], 'remark' => 'last 3 hour rit'],
            ['range' => [$startShiftTime, $stopShiftTime], 'remark' => 'last shift rit'],
        ];

        $ritResults = [];

        // Menambahkan query untuk menghitung ritasi
        foreach ($ritQueries as $query) {
            $ritResults[] = DB::table(DB::raw("({$tDataQuery->toSql()}) as T"))
                ->mergeBindings($tDataQuery) // Penting untuk menambahkan bindings
                ->selectRaw("
                    MAX(DEFAULTCAPACITY) as DEFAULTCAPACITY,
                    EQU_TYPEID,
                    VHC_ID,
                    COUNT(VHC_ID) AS NRIT,
                    '{$query['remark']}' AS REMARK
                ")
                ->whereBetween('OPR_REPORTTIME', $query['range'])
                ->groupBy('EQU_TYPEID', 'VHC_ID')
                ->get();
        }

        // dd($payloadResults->toArray());

        // Gabungkan hasil payload dan ritasi
        $combinedResults = [];
        foreach ($payloadResults as $payload) {
            foreach ($ritResults as $rit) {
                if ($payload->VHC_ID === $rit->VHC_ID && $payload->EQU_TYPEID === $rit->EQU_TYPEID) {
                    // Gabungkan data payload dan ritasi berdasarkan VHC_ID dan EQU_TYPEID
                    $combinedResults[] = (object) [
                        'VHC_ID' => $payload->VHC_ID,
                        'EQU_TYPEID' => $payload->EQU_TYPEID,
                        'DEFAULTCAPACITY' => $payload->DEFAULTCAPACITY,
                        'LOAD_TONNAGE' => $payload->LOAD_TONNAGE,
                        'Less_95' => $payload->Less_95,
                        '95_110' => $payload->abc,  // Pastikan properti ini ada pada array payload
                        'More_110' => $payload->More_110,
                        'NRIT' => $rit->NRIT,
                        'REMARK' => $payload->REMARK,
                    ];
                }
            }
        }
        dd($combinedResults);


        // return view('payloadritation.index');
    }
}
