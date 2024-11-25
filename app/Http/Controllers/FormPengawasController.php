<?php

namespace App\Http\Controllers;

use App\Models\AlatSupport;
use App\Models\CatatanPengawas;
use App\Models\DailyReport;
use App\Models\FrontLoading;
use App\Models\Material;
use App\Models\Personal;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class FormPengawasController extends Controller
{
    //
    public function index()
    {

        $daily = DailyReport::where('foreman_id', Auth::user()->id)
        ->whereDate('created_at', now())
        ->get();

        // if(empty($daily)){
        //     return view('form-pengawas.empty');
        // }
        $ex = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'like', 'EX%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $hd = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'like', 'HD%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $mg = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'like', 'MG%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $bd = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'like', 'BD%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $wt = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'like', 'WT%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $material = Material::select([
            'MAT_ID',
            'MAT_DESC',
            'MAT_DENSITY',
        ])->get();

        $data = [
            'HD' => $hd,
            'MG' => $mg,
            'BD' => $bd,
            'WT' => $wt,
            'EX' => $ex,
            'material' => $material,
        ];
        return view('form-pengawas.index', compact('data'));
    }

    public function users(Request $request)
    {
        $nik = $request->query('nik');

        $data['users'] = Personal::where('ROLETYPE', 2)->get();

        // Mencari user berdasarkan NIK
        $user = $data['users']->firstWhere('NRP', $nik);

        if ($user) {
            return Response::json([
                'success' => true,
                'name' => $user->PERSONALNAME,
                'by' => 'ahmadfadillah'
            ]);
        } else {
            return Response::json([
                'success' => false,
                'message' => 'User tidak ditemukan',
                'by' => 'ahmadfadillah'
            ]);
        }
    }

    public function post(Request $request)
    {

        // dd($request->all());
        try {
            return DB::transaction(function () use ($request) {
                // insert daily report
                $dailyReport = DailyReport::create([
                    'foreman_id' => Auth::user()->id,
                    'tanggal_dasar' => now()->parse($request->tanggal_dasar)->format('Y-m-d'),
                    'shift_dasar' => $request->shift_dasar,
                    'area' => $request->area,
                    'lokasi' => $request->lokasi,
                    'nik_supervisor' => $request->nik_supervisor,
                    'nama_supervisor' => $request->nama_supervisor,
                    'nik_superintendent' => $request->nik_superintendent,
                    'nama_superintendent' => $request->nama_superintendent
                ]);

                // insert front loading
                if (!empty($request->front_unit_number)) {
                    foreach ($request->front_unit_number as $front_unit) {
                        $timeIndexes = array_keys($front_unit["times"] ?? []);

                        $morning = array_filter($request->front_time_siang, function ($key) use ($timeIndexes) {
                            return in_array($key, $timeIndexes);
                        }, ARRAY_FILTER_USE_KEY);
                        $night = array_filter($request->front_time_malam, function ($key) use ($timeIndexes) {
                            return in_array($key, $timeIndexes);
                        }, ARRAY_FILTER_USE_KEY);

                        FrontLoading::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled'=> true,
                            'nomor_unit' => $front_unit["name"],
                            'siang' => json_encode(array_values($morning)),
                            'malam' => json_encode(array_values($night)),
                        ]);
                    }
                }

                // insert alat support
                // if (!empty($request->supports)) {
                    foreach ($request->supports as $value) {
                        AlatSupport::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled'=> true,
                            'jenis_unit' => $value['jenisSupport'],
                            'alat_unit' => $value['unitSupport'],
                            'nik_operator' => $value['nikSupport'],
                            'nama_operator' => $value['namaSupport'],
                            'tanggal_operator' => now()->parse($value['tanggalSupport'])->format('Y-m-d'),
                            'shift_operator' => $value['shiftSupport'],
                            'hm_awal' => $value['hmAwalSupport'],
                            'hm_akhir' => $value['hmAkhirSupport'],
                            'hm_total' => $value['totalSupport'],
                            'hm_cash' => $value['hmCashSupport'],
                            'material' => $value['materialSupport'],
                        ]);
                    }
                // }

                if (!empty($request->start_catatan) && !empty($request->end_catatan)) {
                    foreach ($request->start_catatan as $index => $start) {
                        $end = $request->end_catatan[$index];
                        $description = $request->description_catatan[$index];

                        CatatanPengawas::create([
                            'daily_report_id' => $dailyReport->id,
                            'jam_start' => $start,
                            'jam_stop' => $end,
                            'keterangan' => $description,
                        ]);
                    }
                }

                return redirect()->route('form-pengawas.index')->with('success', 'Laporan harian berhasil dibuat');
            });
        } catch (\Throwable $th) {
            return redirect()->route('form-pengawas.index')->with('info', nl2br('Laporan harian gagal dibuat..\n' . $th->getMessage()));
        }
    }
}
