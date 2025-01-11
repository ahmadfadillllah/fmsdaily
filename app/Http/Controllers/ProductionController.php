<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class ProductionController extends Controller
{
    //
    public function index()
    {
        $data = DB::table('FOCUS_REPORTING.DASHBOARD.PRODUCTION_PER_HOUR as a')
        ->select([
            'PIT',
            'a.HOUR',
            'a.SORT',
            'PRODUCTION',
            DB::raw("COALESCE(
                        CASE
                            WHEN PLAN_PRODUCTION < 7000 AND PIT = 'ALL PIT' THEN NULL
                            WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-A3' THEN NULL
                            WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-B1' THEN NULL
                            WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-B2' THEN NULL
                            ELSE PLAN_PRODUCTION
                        END, PLAN_PRODUCTION) AS PLAN_PRODUCTION")
        ])
        ->where('PIT', 'ALL PIT')
        ->orderByRaw("CASE
                        WHEN a.HOUR >= 19 THEN a.HOUR
                        ELSE a.HOUR + 24
                    END")
        ->get();

        $data = $data->transform(function ($item) {
            if (isset($item->PRODUCTION)) {
                $item->PRODUCTION = number_format($item->PRODUCTION, 0, '.', '');
            }
            return $item;
        });

        $siang = DB::select('SET NOCOUNT ON;EXEC FOCUS_REPORTING.dbo.APP_GET_PRODUCTION_TODAY_AND_LAST_SHIFT @shift = ?', ['Siang']);
        $historymalam = DB::select('SET NOCOUNT ON;EXEC FOCUS_REPORTING.dbo.APP_GET_PRODUCTION_TODAY_AND_LAST_SHIFT @shift = ?', ['malam']);

        foreach ($historymalam as $value) {
            if (property_exists($value, 'HOUR')) {
                $hour = (int)$value->HOUR;
                if ($hour >= 7 && $hour <= 18) {
                    $b['HistorySiang'][] = $value;
                }else{
                    $b['HistoryMalam'][] = $value;
                }
            }
        }

        $categorizedData = [
            'Siang' => $siang,
            'Malam' => [],
            'HistorySiang' => $b['HistorySiang'],
            'HistoryMalam' => $b['HistoryMalam'],
        ];

        foreach ($data as $value) {
            if (property_exists($value, 'HOUR')) {
                $hour = (int)$value->HOUR;
                if ($hour >= 7 && $hour <= 18) {
                    $b['trash'][] = $value;
                }else{
                    $categorizedData['Malam'][] = $value;
                }
            }
        }





        $waktu_sekarang = (int)date('H');
        $waktu = '';

        if ($waktu_sekarang >= 6 && $waktu_sekarang <= 18) {
            $waktu = 'Siang';
        } else {
            $waktu = 'Malam';
        }

        if ($waktu == 'Siang') {
            $dataArray = array_merge($categorizedData['Siang']);
            $actual = array_sum(array_column($dataArray, 'PRODUCTION'));
            $plan = array_sum(array_column($dataArray, 'PLAN_PRODUCTION'));
        } else {
            $dataArray = array_merge($categorizedData['Malam'], $categorizedData['HistorySiang']);
            $actual = array_sum(array_column($dataArray, 'PRODUCTION'));
            $plan = array_sum(array_column($dataArray, 'PLAN_PRODUCTION'));
        }

        $data = [
            'kategori' => $categorizedData,
            'actual' => $actual,
            'plan' => $plan,
            'waktu' => $waktu,
            'by' => 'ahmadfadillllah'
        ];

        return view('production.index', compact('data'));
    }
}
