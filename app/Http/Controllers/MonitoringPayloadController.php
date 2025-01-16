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


        $waktu_sekarang = (int)date('H');
        $waktu = '';

        if ($waktu_sekarang >= 7 && $waktu_sekarang <= 17) {
            $startDateMorning = $time->copy()->setTime(7, 0, 0); // 07:30:00 hari ini
            $endDateNight = $time->copy()->setTime(17, 59,59)->addDay(); // 07:30:00 besok

            $startTimeFormatted = $startDateMorning->format('Y-m-d H:i:s');
            $endTimeFormatted = $endDateNight->format('Y-m-d H:i:s');
            $waktu = 'Siang';
        } else {
            $startDateMorning = $time->copy()->subDay()->setTime(18, 0, 0); // 18:00:00 kemarin
            $endDateNight = $time->copy()->setTime(6, 59, 59); // 06:59:59 besok

            $startTimeFormatted = $startDateMorning->format('Y-m-d H:i:s');
            $endTimeFormatted = $endDateNight->format('Y-m-d H:i:s');
            $waktu = 'Malam';
        }

        // dd($startTimeFormatted);

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


            $payload_khusus = DB::table('focus.dbo.FLT_VEHICLE as flt')
        ->leftJoin('focus.dbo.PRD_RITATION as prd', function($join) use ($startTimeFormatted, $endTimeFormatted) {
            $join->on('flt.VHC_ID', '=', 'prd.VHC_ID')
                ->whereBetween('prd.OPR_REPORTTIME', [$startTimeFormatted, $endTimeFormatted]);
        })
        ->whereIn('flt.VHC_ID', ['HD629', 'HD630', 'HD632', 'HD633', 'HD635', 'HD639', 'HD6406', 'HD6408', 'HD1150', 'HD1152', 'HD1155'])
        ->select(
            'flt.VHC_ID',
            DB::raw('
                COALESCE(SUM(CASE WHEN prd.LOD_TONNAGE < 100 THEN 1 ELSE 0 END), 0) AS less_than_100,
                COALESCE(SUM(CASE WHEN prd.LOD_TONNAGE BETWEEN 100 AND 115 THEN 1 ELSE 0 END), 0) AS between_100_and_115,
                COALESCE(SUM(CASE WHEN prd.LOD_TONNAGE > 115 THEN 1 ELSE 0 END), 0) AS greater_than_115,
                COALESCE(MAX(prd.LOD_TONNAGE), 0) AS max_payload
            ')
        )
        ->groupBy('flt.VHC_ID')
        ->get();

        $startDate = '2023-01-01 00:00:00';
        $endDate = '2024-08-31 23:59:59';
        $vhcIds = 'HD629, HD630, HD632, HD633, HD635, HD639, HD6406, HD6408, HD1150, HD1152, HD1155';

        $payload_2023 = DB::select('SET NOCOUNT ON; EXEC DAILY.dbo.GET_PAYLOAD_2023_2024 @StartDate = ?, @EndDate = ?, @VHC_IDs = ?', [$startDate, $endDate, $vhcIds]);

        $data = [
            'payload' => $payload,
            'payload_khusus' => $payload_khusus,
            'payload_2023' => $payload_2023,
            'unit' => $unit,
        ];

        return view('monitoring-payload.index', compact('data'));
    }
}
