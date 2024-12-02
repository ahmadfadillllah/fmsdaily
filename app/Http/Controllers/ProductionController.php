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
            'NUM',
            'PIT',
            'a.HOUR',
            'a.SORT',
            'PRODUCTION',
            DB::raw("CASE
                        WHEN PLAN_PRODUCTION < 7000 AND PIT = 'ALL PIT' THEN NULL
                        WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-A3' THEN NULL
                        WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-B1' THEN NULL
                        WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-B2' THEN NULL
                        ELSE PLAN_PRODUCTION
                    END AS PLAN_PRODUCTION_2"),
            DB::raw("CASE
                        WHEN PLAN_PRODUCTION < 7000 AND PIT = 'ALL PIT' THEN PLAN_PRODUCTION
                        WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-A3' THEN PLAN_PRODUCTION
                        WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-B1' THEN PLAN_PRODUCTION
                        WHEN PLAN_PRODUCTION < 2333.333 AND PIT = 'PIT SM-B2' THEN PLAN_PRODUCTION
                        ELSE NULL
                    END AS PLAN_PRODUCTION"),
            'ACH',
            'PRODUCTION_CUM',
            'PLAN_PRODUCTION_CUM',
            'PRODUCTION_MD',
            'ACH_CUM',
            'CREATED_TIME'
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

        $dataArray = $data->toArray();

        $categorizedData = [
            'Siang' => [],
            'Malam' => []
        ];

        foreach ($data as $value) {
            if (property_exists($value, 'HOUR')) {
                $hour = (int)$value->HOUR;
                if ($hour >= 7 && $hour <= 18) {
                    $categorizedData['Siang'][] = $value;
                } else {
                    $categorizedData['Malam'][] = $value;
                }
            }
        }

        $kategori_terpilih = [];
        $waktu_sekarang = (int)date('H');

        if ($waktu_sekarang >= 7 && $waktu_sekarang <= 18) {
            $kategori_terpilih['Siang'] = $categorizedData['Siang'];
        } else {
            $kategori_terpilih['Malam'] = $categorizedData['Malam'];
        }

        $actual = array_sum(array_column($dataArray, 'PRODUCTION'));
        $plan = array_sum(array_column($dataArray, 'PLAN_PRODUCTION'));

        $data = [
            'all' => $data,
            'kategori' => $kategori_terpilih,
            'actual' => $actual,
            'plan' => $plan,
            'by' => 'ahmadfadillllah'
        ];

        // dd($data);

        return view('production.index', compact('data'));
    }
}
