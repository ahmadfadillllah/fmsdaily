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
        // Menggunakan COALESCE untuk mengambil PLAN_PRODUCTION jika PLAN_PRODUCTION_2 NULL
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

// Format angka PRODUCTION agar lebih mudah dibaca
$data = $data->transform(function ($item) {
    if (isset($item->PRODUCTION)) {
        $item->PRODUCTION = number_format($item->PRODUCTION, 0, '.', '');
    }
    return $item;
});

// Mengkategorikan berdasarkan jam (Siang: 7-18, Malam: 19-6)
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

// Menentukan kategori yang sesuai berdasarkan jam saat ini
$kategori_terpilih = [];
$waktu_sekarang = (int)date('H');

if ($waktu_sekarang >= 7 && $waktu_sekarang <= 18) {
    $kategori_terpilih['Siang'] = $categorizedData['Siang'];
} else {
    $kategori_terpilih['Malam'] = $categorizedData['Malam'];
}

// Menghitung total PRODUCTION dan PLAN_PRODUCTION
$dataArray = $data->toArray();
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
