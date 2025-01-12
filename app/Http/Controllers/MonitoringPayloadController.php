<?php

namespace App\Http\Controllers;

use App\Models\Ritation;
use App\Models\Unit;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringPayloadController extends Controller
{
    //
    public function index(Request $request)
    {

        $unit = Unit::select('VHC_ID')
            ->where('VHC_ID', 'LIKE', 'HD%')
            ->get();


        $time = Carbon::now();
        $startDateMorning = $time->copy()->setTime(6, 30, 0); // 06:30:00 hari ini
        $endDateNight = $time->copy()->setTime(6, 30, 0)->addDay(); // 06:30:00 besok

        $startTimeFormatted = $startDateMorning->format('Y-m-d H:i:s');
        $endTimeFormatted = $endDateNight->format('Y-m-d H:i:s');

        $waktu_sekarang = (int)date('H');
        $waktu = '';

        if ($waktu_sekarang >= 6 && $waktu_sekarang <= 18) {
            $waktu = 'Siang';
        } else {
            $waktu = 'Malam';
        }

        $payload = Ritation::selectRaw('
            VHC_ID,
            CONVERT(DATE, OPR_REPORTTIME) AS report_date,
            COUNT(CASE WHEN LOD_TONNAGE < 100 THEN 1 END) AS less_than_100,
            COUNT(CASE WHEN LOD_TONNAGE BETWEEN 100 AND 115 THEN 1 END) AS between_100_and_115,
            COUNT(CASE WHEN LOD_TONNAGE > 115 THEN 1 END) AS greater_than_115,
            MAX(LOD_TONNAGE) AS max_payload
        ')
        ->whereBetween('OPR_REPORTTIME', [$startTimeFormatted, $endTimeFormatted]);
        if (!empty($request->unit)) {
            $payload = $payload->where('VHC_ID', $request->unit);
        }
        $payload = $payload->groupBy(DB::raw('VHC_ID, CONVERT(DATE, OPR_REPORTTIME)'))
        ->orderBy(DB::raw('CONVERT(DATE, OPR_REPORTTIME)'))
        ->get();

        return view('monitoring-payload.index', compact('payload', 'unit'));
    }
}
