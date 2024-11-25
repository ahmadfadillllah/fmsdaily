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

        $nomor_unit = Unit::select([
            'VHC_ID as MAT_ID'
        ])
            ->where('VHC_ACTIVE', true)
            ->get();


        $data = [
            'HD' => $hd,
            'MG' => $mg,
            'BD' => $bd,
            'WT' => $wt,
            'EX' => $ex,
            'material' => $material,
            'nomor_unit' => $nomor_unit,
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
                    'statusenabled' => 'true',
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
                if (!empty($request->front_loading)) {
                    foreach ($request->front_loading as $front_unit) {
                        $timeData = $front_unit["time"] ?? [];

                        $morning = [];
                        $night = [];

                        foreach ($timeData as $time) {
                            $timeSlots = explode('|', $time);
                            if (isset($timeSlots[0])) {
                                $morning[] = trim($timeSlots[0]); // Waktu siang
                            }
                            if (isset($timeSlots[1])) {
                                $night[] = trim($timeSlots[1]); // Waktu malam
                            }
                        }

                        FrontLoading::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => 'true',
                            'nomor_unit' => $front_unit["nomor_unit"],
                            'siang' => json_encode($morning),
                            'malam' => json_encode($night),
                        ]);
                    }
                }


                // insert alat support
                // if (!empty($request->supports)) {
                if (!empty($request->alat_support)) {
                    foreach ($request->alat_support as $value) {
                        AlatSupport::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => 'true',
                            'jenis_unit' => $value['jenisSupport'],
                            'alat_unit' => $value['unitSupport'],
                            'nik_operator' => $value['nikSupport'],
                            'nama_operator' => $value['namaSupport'],
                            'tanggal_operator' => \Carbon\Carbon::createFromFormat('m/d/Y', $value['tanggalSupport'])->format('Y-m-d'),
                            'shift_operator' => $value['shiftSupport'],
                            'hm_awal' => $value['hmAwalSupport'],
                            'hm_akhir' => $value['hmAkhirSupport'],
                            'hm_total' => $value['totalSupport'],
                            'hm_cash' => $value['hmCashSupport'],
                            'material' => $value['materialSupport'],
                        ]);
                    }
                }

                if (!empty($request->catatan)) {
                    foreach ($request->catatan as $catatan) {
                        CatatanPengawas::create([
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => 'true',
                            'jam_start' => $catatan['start_catatan'],
                            'jam_stop' => $catatan['end_catatan'],
                            'keterangan' => $catatan['description_catatan'],
                        ]);
                    }
                }


                return redirect()->route('form-pengawas.index')->with('success', 'Laporan berhasil dibuat');
            });
        } catch (\Throwable $th) {
            return redirect()->route('form-pengawas.index')->with('info', 'Laporan gagal dibuat.. \n' . $th->getMessage());
        }
    }

    public function getOperatorByNIK($nik)
    {
        // Data operator
        $data = Personal::select(
            'NRP as MAT_ID',
            'PERSONALNAME as MAT_DESC',
            'ROLETYPE as MAT_CATEGORY',
        )
        ->where('ROLETYPE', 0)->get();

        // Cari operator berdasarkan NIK
        $operator = $data->firstWhere('MAT_ID', $nik);

        if ($operator) {
            return response()->json([
                'success' => true,
                'nama' => $operator->MAT_DESC,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Operator tidak ditemukan',
            ]);
        }
    }

    public function show()
    {
        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_superintendent', '=', 'gl.NRP')
        ->select(
            'dr.id',
            'dr.tanggal_dasar as tanggal',
            'dr.shift_dasar as shift',
            'dr.area',
            'dr.lokasi',
            'dr.nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent',
            'gl.PERSONALNAME as nama_superintendent',
            'dr.tanggal_dasar',
        )
        ->where('dr.statusenabled', 'true')->get();

        return view('form-pengawas.daftar.index', compact('daily'));
    }
}
