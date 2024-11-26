<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class ProductionController extends Controller
{
    //
    public function index()
    {
        $response = Http::get('http://36.67.119.214:3003/api/production');

        $data = $response->json();

        foreach ($data as $key => $value) {
            if (isset($value['PRODUCTION'])) {
                $data[$key]['PRODUCTION'] = number_format($value['PRODUCTION'], 0, '.', '');
            }
        }

        $categorizedData = [
            'Siang' => [],
            'Malam' => []
        ];

        foreach ($data as $key => $value) {
            $hour = (int)$value['HOUR'];
            if ($hour >= 7 && $hour <= 18) {
                $categorizedData['Siang'][] = $value;
            } else {
                $categorizedData['Malam'][] = $value;
            }
        }

        $waktu_sekarang = date('H');
        // $kategori_terpilih[];

        if ($waktu_sekarang >= 7 && $waktu_sekarang <= 18) {
            $kategori_terpilih["Siang"] = $categorizedData["Siang"];
        } else {
            $kategori_terpilih["Malam"] = $categorizedData["Malam"];
        }

        $data = [
            'all' => $data,
            'kategori' => $kategori_terpilih,
            'actual' => array_sum(array_column($data, 'PRODUCTION')),
            'plan' => array_sum(array_column($data, 'PLAN_PRODUCTION')),
            'by' => 'ahmadfadillllah'
        ];
        // dd($data);
        return view('production.index', compact('data'));
    }
}
