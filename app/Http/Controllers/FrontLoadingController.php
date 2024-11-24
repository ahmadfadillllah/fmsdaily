<?php

namespace App\Http\Controllers;

use App\Models\FrontLoading;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Support\Facades\DB;

class FrontLoadingController extends Controller
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

        $front = DB::table('front_loading_t as fl')
        ->leftJoin('daily_report_t as dr', 'fl.daily_report_id', '=', 'dr.id')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->select(
            'fl.daily_report_id as id',
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
            'fl.nomor_unit',
            'fl.siang',
            'fl.malam',
            'dr.created_at',
            'dr.updated_at',
        )
        ->whereNotNull('nomor_unit')
        ->whereBetween('tanggal_dasar', [$startTimeFormatted, $endTimeFormatted])
        ->get()
        ->flatMap(function ($item) {
            $siang = json_decode($item->siang, true) ?? [];
            $malam = json_decode($item->malam, true) ?? [];

            $result = [];

                foreach ($siang as $waktu) {
                    $result[] = [
                        'id' => $item->id,
                        'tanggal_pelaporan' => $item->tanggal_pelaporan,
                        'shift' => $item->shift,
                        'area' => $item->area,
                        'lokasi' => $item->lokasi,
                        'jam' => $waktu,
                        'nomor_unit' => $item->nomor_unit,
                        'nik_foreman' => $item->nik_foreman,
                        'nama_foreman' => $item->nama_foreman,
                        'nik_supervisor' => $item->nik_supervisor,
                        'nama_supervisor' => $item->nama_supervisor,
                        'nik_superintendent' => $item->nik_superintendent,
                        'nama_superintendent' => $item->nama_superintendent,
                        'shift_dasar' => 'Siang',
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }

                foreach ($malam as $waktu) {
                    $result[] = [
                        'id' => $item->id,
                        'tanggal_pelaporan' => $item->tanggal_pelaporan,
                        'shift' => $item->shift,
                        'area' => $item->area,
                        'lokasi' => $item->lokasi,
                        'jam' => $waktu,
                        'nomor_unit' => $item->nomor_unit,
                        'nik_foreman' => $item->nik_foreman,
                        'nama_foreman' => $item->nama_foreman,
                        'nik_supervisor' => $item->nik_supervisor,
                        'nama_supervisor' => $item->nama_supervisor,
                        'nik_superintendent' => $item->nik_superintendent,
                        'nama_superintendent' => $item->nama_superintendent,
                        'shift_dasar' => 'Malam',
                        'created_at' => $item->created_at,
                        'updated_at' => $item->updated_at,
                    ];
                }

                return $result;
            });

        return view('front-loading.index', compact('front'));
    }

    public function download()
    {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();

        return view('front-loading.modal.download');
    }
}
