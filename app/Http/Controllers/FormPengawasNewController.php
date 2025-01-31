<?php

namespace App\Http\Controllers;

use App\Models\AlatSupport;
use App\Models\Area;
use App\Models\CatatanPengawas;
use App\Models\DailyReport;
use App\Models\FrontLoading;
use App\Models\Log;
use App\Models\Lokasi;
use App\Models\Material;
use App\Models\Personal;
use App\Models\Shift;
use App\Models\Unit;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Ramsey\Uuid\Uuid;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DateTimeImmutable;

class FormPengawasNewController extends Controller
{
    //
    public function index()
    {


        $daily = DailyReport::where('foreman_id', Auth::user()->id)
        ->where('is_draft', true)
        ->orderBy('created_at', 'desc')
        ->first();


        if (!empty($daily['tanggal_dasar'])) {
            $tanggalDasar = new DateTimeImmutable($daily['tanggal_dasar']);
            if ($tanggalDasar) {
                $daily['tanggal_dasar'] = $tanggalDasar->format('m/d/Y');
            } else {
                $daily['tanggal_dasar'];
            }
        }


         // Array waktu siang dan malam
    $staticTimeSlots = [
        ['siang' => '07.00 - 08.00', 'malam' => '19.00 - 20.00'],
        ['siang' => '08.00 - 09.00', 'malam' => '20.00 - 21.00'],
        ['siang' => '09.00 - 10.00', 'malam' => '21.00 - 22.00'],
        ['siang' => '10.00 - 11.00', 'malam' => '22.00 - 23.00'],
        ['siang' => '11.00 - 12.00', 'malam' => '23.00 - 24.00'],
        ['siang' => '12.00 - 13.00', 'malam' => '24.00 - 01.00'],
        ['siang' => '13.00 - 14.00', 'malam' => '01.00 - 02.00'],
        ['siang' => '14.00 - 15.00', 'malam' => '02.00 - 03.00'],
        ['siang' => '15.00 - 16.00', 'malam' => '03.00 - 04.00'],
        ['siang' => '16.00 - 17.00', 'malam' => '04.00 - 05.00'],
        ['siang' => '17.00 - 18.00', 'malam' => '05.00 - 06.00'],
        ['siang' => '18.00 - 19.00', 'malam' => '06.00 - 07.00'],
    ];



      //  dd($daily);

        $frontLoading = [];
        $alatSupports = [];
        $supervisorNotes = [];

        if ($daily) {
            $frontLoading = FrontLoading::where('daily_report_id', $daily->id)->get();
            foreach ($frontLoading as $loading) {
                $loading->siang = json_decode($loading->siang, true);
                $loading->malam = json_decode($loading->malam, true);
            }

            //dd($frontLoading->toArray());
            $alatSupports = AlatSupport::where('daily_report_id', $daily->id)->get();
            $supervisorNotes = CatatanPengawas::where('daily_report_id', $daily->id)->get();
        }

        // if(empty($daily)){
        //     return view('form-pengawas.empty');
        // }
        $ex = Unit::select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
            ->where('VHC_ID', 'LIKE', 'EX%')
            ->where('VHC_ACTIVE', true)
            ->get();

        $nomor_unit = Unit::select('VHC_ID')
            ->where('VHC_ID', 'NOT LIKE', 'HD%')
            ->get();

        $operator = Personal::select
        (
            'ID', 'NRP', 'USERNAME', 'PERSONALNAME', 'EPIGONIUSERNAME', 'ROLETYPE', 'SYS_CREATEDBY', 'SYS_UPDATEDBY'
        )->where('ROLETYPE', 0)->get();

        $supervisor = Personal::select
        (
            'ID', 'NRP', 'USERNAME', 'PERSONALNAME', 'EPIGONIUSERNAME', 'ROLETYPE', 'SYS_CREATEDBY', 'SYS_UPDATEDBY'
        )->where('ROLETYPE', 3)->get();

        $superintendent = Personal::select
        (
            'ID', 'NRP', 'USERNAME', 'PERSONALNAME', 'EPIGONIUSERNAME', 'ROLETYPE', 'SYS_CREATEDBY', 'SYS_UPDATEDBY'
        )->where('ROLETYPE', 4)->get();

        $lokasi = Lokasi::where('statusenabled', true)->get();
        $area = Area::where('statusenabled', true)->get();
        $shift = Shift::where('statusenabled', true)->get();


        $data = [
            'operator' => $operator,
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'EX' => $ex,
            'EX' => $ex,
            'nomor_unit' => $nomor_unit,
            'lokasi' => $lokasi,
            'area' => $area,
            'shift' => $shift,
        ];

        return view('form-pengawas-new.index', compact('data', 'daily', 'frontLoading', 'staticTimeSlots', 'alatSupports', 'supervisorNotes'));
        // return view('form-pengawas-old.index', compact('data', 'daily'));
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
        $lokasi = Lokasi::where('id', $request->lokasi)->first();
        $area = Area::where('id', $request->area)->first();
        $shift = Shift::where('id', $request->shift_dasar)->first();

        Log::create([
            'tanggal_loging' => now(),
            'jenis_loging' => 'Laporan Kerja',
            'nama_user' => Auth::user()->id,
            'nik' => Auth::user()->nik,
            'keterangan' => 'Tambah laporan kerja dengan nama: '. Auth::user()->name . ', NIK: '. Auth::user()->nik . ', Role: '. Auth::user()->role .
            ', shift: '. $shift->keterangan . ', area: '. $area->keterangan . ', lokasi: '. $lokasi->keterangan,
        ]);
        // dd($request->all());
        try {
            return DB::transaction(function () use ($request) {
                // insert daily report
                $supervisor = $request->nik_supervisor ?? [];
                $superintendent = $request->nik_superintendent ?? [];

                $nikSlotsSV = explode('|', $supervisor);
                $nikSupervisor = $nikSlotsSV[0];
                $namaSupervisor = trim($nikSlotsSV[1]);

                $nikSlotsSI = explode('|', $superintendent);
                $nikSuperintendent = $nikSlotsSI[0];
                $namaSuperintendent = trim($nikSlotsSI[1]);

                $data = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'foreman_id' => Auth::id(),
                    'statusenabled' => true,
                    'tanggal_dasar' => now()->parse($request->tanggal_dasar)->format('Y-m-d'),
                    'shift_dasar_id' => $request->shift_dasar,
                    'area_id' => $request->area,
                    'lokasi_id' => $request->lokasi,
                    'nik_superintendent' => $nikSuperintendent,
                    'nama_superintendent' => $namaSuperintendent,
                    'is_draft' => false,
                ];

                // Tambahkan data berdasarkan role
                if (Auth::user()->role == 'SUPERVISOR') {
                    $data['nik_supervisor'] = Auth::user()->nik;
                    $data['nama_supervisor'] = Auth::user()->name;
                    $data['verified_supervisor'] = Auth::user()->nik;
                }
                if (Auth::user()->role == 'FOREMAN') {
                    $data['nik_foreman'] = Auth::user()->nik;
                    $data['nama_foreman'] = Auth::user()->name;
                    $data['verified_foreman'] = Auth::user()->nik;
                    $data['nik_supervisor'] = $nikSupervisor;
                    $data['nama_supervisor'] = $namaSupervisor;
                }

                // Buat DailyReport
                //$dailyReport = DailyReport::create($data);

                $data['is_draft'] = false; // Ubah menjadi final
                $dailyReport = DailyReport::where('uuid', $request->uuid)->update($data);



                // insert front loading
                if (!empty($request->front_loading)) {
                    foreach ($request->front_loading as $front_unit) {
                        $timeData = $front_unit["time"] ?? [];

                        $morning = [];
                        $night = [];
                        $checked = []; // Untuk menyimpan status checked
                        $keterangan = []; // Untuk menyimpan keterangan

                        foreach ($timeData as $time) {
                            // Hanya proses yang checked = true atau keterangan terisi
                            if ($time['checked'] == 'true' || !empty($time['keterangan'])) {
                                $timeSlots = explode('|', $time['value']);

                                if (isset($timeSlots[0])) {
                                    $morning[] = trim($timeSlots[0]); // Waktu siang
                                }
                                if (isset($timeSlots[1])) {
                                    $night[] = trim($timeSlots[1]); // Waktu malam
                                }

                                // Tambahkan 'checked' dan 'keterangan' untuk waktu yang valid
                                $checked[] = $time['checked'] == "false" ? NULL : $time['checked'];
                                $keterangan[] = $time['keterangan'] ?? NULL;
                            }
                        }

                        // Jika ada data yang valid, buat entry di database
                        if (!empty($checked)) {
                            FrontLoading::create([
                                'uuid' => (string) Uuid::uuid4()->toString(),
                                'daily_report_id' => $dailyReport->id,
                                'daily_report_uuid' => $dailyReport->uuid,
                                'statusenabled' => true,
                                'checked' => json_encode($checked), // Store checked values in JSON format
                                'keterangan' => json_encode($keterangan), // Store keterangan values in JSON format
                                'nomor_unit' => $front_unit["nomor_unit"],
                                'siang' => json_encode($morning),
                                'malam' => json_encode($night),
                                'is_draft' => false,
                            ]);
                        }
                    }
                }


                // insert alat support
                // if (!empty($request->supports)) {
                if (!empty($request->alat_support)) {
                    foreach ($request->alat_support as $value) {

                        $operator = explode('|',  $value['namaSupport']);
                        $nikOperator = $operator[0];
                        $namaOperator = trim($operator[1]);
                        $jenisUnit = substr($value['unitSupport'], 0, 2);

                        AlatSupport::create([
                            'uuid' => (string) Uuid::uuid4()->toString(),
                            'daily_report_uuid' => $dailyReport->uuid,
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => true,
                            'jenis_unit' => $jenisUnit,
                            'alat_unit' => $value['unitSupport'],
                            'nik_operator' => $nikOperator,
                            'nama_operator' => $namaOperator,
                            'tanggal_operator' => \Carbon\Carbon::createFromFormat('m/d/Y', $value['tanggalSupport'])->format('Y-m-d'),
                            'shift_operator_id' => $value['shiftSupport'],
                            'hm_awal' => $value['hmAwalSupport'],
                            'hm_akhir' => $value['hmAkhirSupport'],
                            'hm_total' => $value['hmAkhirSupport'] - $value['hmAwalSupport'],
                            'hm_cash' => $value['hmCashSupport'],
                            'keterangan' => $value['keteranganSupport'],
                            'is_draft' => false,
                        ]);
                    }
                }

                if (!empty($request->catatan)) {
                    foreach ($request->catatan as $catatan) {
                        CatatanPengawas::create([
                            'uuid' => (string) Uuid::uuid4()->toString(),
                            'daily_report_uuid' => $dailyReport->uuid,
                            'daily_report_id' => $dailyReport->id,
                            'statusenabled' => true,
                            'jam_start' => $catatan['start_catatan'],
                            'jam_stop' => $catatan['end_catatan'],
                            'keterangan' => $catatan['description_catatan'],
                            'is_draft' => false,
                        ]);
                    }
                }


                return redirect()->route('form-pengawas-old.index')->with('success', 'Laporan berhasil dibuat');
            });
        } catch (\Throwable $th) {
            return redirect()->route('form-pengawas-old.index')->with('info', 'Laporan gagal dibuat.. \n' . $th->getMessage());
        }
    }

    public function saveAsDraft(Request $request)
    {
        try {
            return DB::transaction(function () use ($request) {
                $uuid = $request->uuid;

            // Jika UUID tidak kosong, cek apakah draft sudah ada
            $dailyReport = !empty($uuid)
                ? DailyReport::where('uuid', $uuid)->first()
                : null;


              if ($dailyReport) {
                $dailyReport->update([
                    'tanggal_dasar' => $request->filled('tanggal_dasar')
                        ? now()->parse($request->tanggal_dasar)->format('Y-m-d')
                        : $dailyReport->tanggal_dasar,
                    'shift_dasar_id' => $request->shift_dasar ?? $dailyReport->shift_dasar_id,
                    'area_id' => $request->area ?? $dailyReport->area_id,
                    'lokasi_id' => $request->lokasi ?? $dailyReport->lokasi_id,
                    'nik_supervisor' => $request->nik_supervisor ?? $dailyReport->nik_supervisor,
                    'nik_superintendent' => $request->nik_superintendent ?? $dailyReport->nik_superintendent,
                ]);
            } else {
                // Buat draft baru jika UUID kosong
                $supervisor = $request->nik_supervisor;
                $superintendent = $request->nik_superintendent;

                $nikSupervisor = null;
                $namaSupervisor = null;

                if (is_string($supervisor) && !empty($supervisor)) {
                    $nikSlotsSV = explode('|', $supervisor);
                    $nikSupervisor = $nikSlotsSV[0] ?? null;
                    $namaSupervisor = trim($nikSlotsSV[1] ?? '');
                }

                $nikSuperintendent = null;
                $namaSuperintendent = null;

                if (is_string($superintendent) && !empty($superintendent)) {
                    $nikSlotsSI = explode('|', $superintendent);
                    $nikSuperintendent = $nikSlotsSI[0] ?? null;
                    $namaSuperintendent = trim($nikSlotsSI[1] ?? '');
                }

                $data = [
                    'uuid' => Uuid::uuid4()->toString(),
                    'foreman_id' => Auth::id(),
                    'statusenabled' => true,
                    'tanggal_dasar' => $request->filled('tanggal_dasar')
                        ? now()->parse($request->tanggal_dasar)->format('Y-m-d')
                        : null,
                    'shift_dasar_id' => $request->shift_dasar,
                    'area_id' => $request->area,
                    'lokasi_id' => $request->lokasi,
                    'nik_superintendent' => $nikSuperintendent,
                    'nama_superintendent' => $namaSuperintendent,
                    'is_draft' => true,
                ];

                // Tambahkan data berdasarkan role
                if (Auth::user()->role == 'SUPERVISOR') {
                    $data['nik_supervisor'] = Auth::user()->nik;
                    $data['nama_supervisor'] = Auth::user()->name;
                    $data['verified_supervisor'] = Auth::user()->nik;
                }
                if (Auth::user()->role == 'FOREMAN') {
                    $data['nik_foreman'] = Auth::user()->nik;
                    $data['nama_foreman'] = Auth::user()->name;
                    $data['verified_foreman'] = Auth::user()->nik;
                    $data['nik_supervisor'] = $nikSupervisor;
                    $data['nama_supervisor'] = $namaSupervisor;
                }

                $dailyReport = DailyReport::create($data);
            }

            // insert front loading
            if (!empty($request->front_loading)) {
                $frontLoadingData = json_decode($request->front_loading, true);
                //dd($frontLoadingData);

                if (!is_array($frontLoadingData)) {
                    return response()->json(['error' => 'Invalid front_loading data format'], 422);
                }

                foreach ($frontLoadingData as $front_unit) {
                    $morning = $front_unit['siang'] ?? null;
                    $night = $front_unit['malam'] ?? null;
                    $checked = $front_unit['checked'] ?? null;
                    $keterangan = $front_unit['keterangan'] ?? null;
                    $nomor_unit = $front_unit['nomor_unit'] ?? null;

                    if (!empty($keterangan) || $checked) {
                        FrontLoading::create([
                            'uuid' => (string) Uuid::uuid4()->toString(),
                            'daily_report_id' => $dailyReport->id,
                            'daily_report_uuid' => $dailyReport->uuid,
                            'statusenabled' => true,
                            'checked' => $checked, // Nilai tunggal
                            'keterangan' => $keterangan, // Nilai tunggal
                            'nomor_unit' => $nomor_unit, // Nilai tunggal
                            'siang' => $morning, // Nilai tunggal
                            'malam' => $night, // Nilai tunggal
                            'is_draft' => true,
                        ]);
                    }
                }
            }





                return response()->json([
                    'success' => true,
                    'message' => 'Draft saved successfully!',
                    'uuid' => $dailyReport->uuid,
                    'data' => $dailyReport,
                ]);
            });
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to save draft: ' . $th->getMessage()], 500);
        }
    }

    public function getDraft($uuid)
    {
        try {

            // $DailyReportdraft = DailyReport::where('uuid', $uuid)->first();
            //ambil data yg latest dan yang tidak null uuid nya
            $DailyReportdraft = DailyReport::where('uuid', $uuid)->whereNotNull('uuid')->latest()->first();

            if (!$DailyReportdraft) {
                return response()->json(['error' => 'Draft not found'], 404);
            }




            return response()->json([
                'success' => true,
                'data' => $DailyReportdraft,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Failed to fetch draft: ' . $th->getMessage()], 500);
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

    public function show(Request $request)
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


        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('shift_m as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('area_m as ar', 'dr.area_id', '=', 'ar.id')
        ->leftJoin('lokasi_m as lok', 'dr.lokasi_id', '=', 'lok.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'dr.id',
            'dr.uuid',
            'dr.tanggal_dasar as tanggal',
            'sh.keterangan as shift',
            'ar.keterangan as area',
            'lok.keterangan as lokasi',
            'us.name as pic',
            'dr.nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',

        )
        ->whereBetween('dr.tanggal_dasar', [$startTimeFormatted, $endTimeFormatted])
        ->where('dr.statusenabled', true);
        if (Auth::user()->role !== 'ADMIN') {
            $daily->where('dr.foreman_id', Auth::user()->id);
        }

        $daily = $daily->get();

        return view('form-pengawas-old.daftar.index', compact('daily'));
    }

    public function preview($uuid)
    {
        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('shift_m as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('area_m as ar', 'dr.area_id', '=', 'ar.id')
        ->leftJoin('lokasi_m as lok', 'dr.lokasi_id', '=', 'lok.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'dr.uuid',
            'dr.foreman_id as pic',
            'dr.tanggal_dasar as tanggal',
            'sh.keterangan as shift',
            'ar.keterangan as area',
            'lok.keterangan as lokasi',
            'us.nik as nik_foreman',
            'us.name as nama_foreman',
            'dr.nik_foreman as nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.nik_supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'dr.verified_foreman',
            'dr.verified_supervisor',
            'dr.verified_superintendent',
        )->where('dr.uuid', $uuid)->first();

        if($daily == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $daily->verified_foreman = $daily->verified_foreman != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_foreman) : null;
            $daily->verified_supervisor = $daily->verified_supervisor != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_supervisor) : null;
            $daily->verified_superintendent = $daily->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_superintendent) : null;
        }

        $front = DB::table('front_loading_t as fl')
        ->leftJoin('daily_report_t as dr', 'fl.daily_report_id', '=', 'dr.id')
        ->leftJoin('focus.dbo.FLT_VEHICLE as flt', 'fl.nomor_unit', '=', 'flt.VHC_ID')
        ->select(
            'fl.nomor_unit',
            'flt.EQU_GROUPID as type',
            DB::raw("CASE
                    WHEN flt.EQU_GROUPID LIKE 'HT%' THEN 'Hitachi'
                    WHEN flt.EQU_GROUPID LIKE 'PC%' THEN 'Komatsu'
                    ELSE 'Unknown'
                END as brand"),
            'fl.siang',
            'fl.malam',
            'fl.checked',
            'fl.keterangan',
        )
        ->where('fl.statusenabled', true)
        ->where('fl.daily_report_uuid', $uuid)
        ->get()
        ->groupBy('brand');

        $support = DB::table('alat_support_t as al')
        ->leftJoin('daily_report_t as dr', 'al.daily_report_id', '=', 'dr.id')
        ->leftJoin('shift_m as sh', 'al.shift_operator_id', '=', 'sh.id')
        ->select(
            'al.alat_unit as nomor_unit',
            'al.nama_operator',
            'al.hm_awal',
            'al.hm_akhir',
            'al.hm_cash',
            'al.keterangan',
            'sh.keterangan as shift',
            'al.tanggal_operator as tanggal',
        )
        ->where('al.daily_report_uuid', $uuid)->get();

        $catatan = DB::table('catatan_pengawas_t as cp')
        ->leftJoin('daily_report_t as dr', 'cp.daily_report_id', '=', 'dr.id')
        ->select(
            'cp.jam_start',
            'cp.jam_stop',
            'cp.keterangan',
        )
        ->where('cp.daily_report_uuid', $uuid)->get();

        $timeSlots = [
            'siang' => ['07.00 - 08.00', '08.00 - 09.00', '09.00 - 10.00', '10.00 - 11.00', '11.00 - 12.00', '12.00 - 13.00', '13.00 - 14.00', '14.00 - 15.00', '15.00 - 16.00', '16.00 - 17.00', '17.00 - 18.00', '18.00 - 19.00'],
            // 'malam' => ['19.00 - 20.00', '20.00 - 21.00', '21.00 - 22.00', '22.00 - 23.00', '23.00 - 24.00', '24.00 - 01.00', '01.00 - 02.00', '02.00 - 03.00', '03.00 - 04.00', '04.00 - 05.00', '05.00 - 06.00', '06.00 - 07.00'],
        ];

        // Menghasilkan data seperti '✓' untuk menandakan waktu yang dicentang
        $processedData = $front->map(function ($units, $brand) use ($timeSlots) {
            return $units->map(function ($unit) use ($timeSlots) {
                $siangTimes = json_decode($unit->siang, true);
                $malamTimes = json_decode($unit->malam, true);
                $checked = array_map(function ($item) {
                    return $item === 'true'; // Convert 'true' string to boolean
                }, json_decode($unit->checked, true));
                $keterangan = array_map(function ($item) {
                    return $item === null ? '' : $item; // Mengganti null dengan string kosong
                }, json_decode($unit->keterangan, true));

                $siangResult = collect($timeSlots['siang'])->map(function ($slot) use ($siangTimes, $checked, $keterangan) {
                    $index = array_search($slot, $siangTimes);
                    if ($index !== false && $checked[$index] === true) {
                        return (object)[
                            'status' => '√', // Checkmark
                            'keterangan' => $keterangan[$index] ?? '', // Get corresponding keterangan
                        ];
                    }
                    return (object)[
                        'status' => '',
                        'keterangan' => '', // No keterangan
                    ];
                });
                return [
                    'brand' => $unit->brand,
                    'type' => $unit->type,
                    'nomor_unit' => $unit->nomor_unit,
                    'siang' => $siangResult,
                    // 'malam' => $malamResult,
                ];
            });
        });

        $data = [
            'daily' => $daily,
            'front' => $processedData,
            'support' => $support,
            'catatan' => $catatan,
        ];

        return view('form-pengawas-old.preview', compact(['data', 'timeSlots']));
    }

    public function download($uuid)
    {

        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('shift_m as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('area_m as ar', 'dr.area_id', '=', 'ar.id')
        ->leftJoin('lokasi_m as lok', 'dr.lokasi_id', '=', 'lok.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'dr.uuid',
            'dr.foreman_id as pic',
            'dr.tanggal_dasar as tanggal',
            'sh.keterangan as shift',
            'ar.keterangan as area',
            'lok.keterangan as lokasi',
            'us.nik as nik_foreman',
            'us.name as nama_foreman',
            'dr.nik_foreman as nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.nik_supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'dr.verified_foreman',
            'dr.verified_supervisor',
            'dr.verified_superintendent',
        )->where('dr.uuid', $uuid)->first();

        if($daily == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $daily->verified_foreman = $daily->verified_foreman != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_foreman) : null;
            $daily->verified_supervisor = $daily->verified_supervisor != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_supervisor) : null;
            $daily->verified_superintendent = $daily->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $daily->nama_superintendent) : null;
        }

        $front = DB::table('front_loading_t as fl')
        ->leftJoin('daily_report_t as dr', 'fl.daily_report_id', '=', 'dr.id')
        ->leftJoin('focus.dbo.FLT_VEHICLE as flt', 'fl.nomor_unit', '=', 'flt.VHC_ID')
        ->select(
            'fl.nomor_unit',
            'flt.EQU_GROUPID as type',
            DB::raw("CASE
                    WHEN flt.EQU_GROUPID LIKE 'HT%' THEN 'Hitachi'
                    WHEN flt.EQU_GROUPID LIKE 'PC%' THEN 'Komatsu'
                    ELSE 'Unknown'
                END as brand"),
            'fl.siang',
            'fl.malam',
            'fl.checked',
            'fl.keterangan',
        )
        ->where('fl.statusenabled', true)
        ->where('fl.daily_report_uuid', $uuid)
        ->get()
        ->groupBy('brand');

        $support = DB::table('alat_support_t as al')
        ->leftJoin('daily_report_t as dr', 'al.daily_report_id', '=', 'dr.id')
        ->leftJoin('shift_m as sh', 'al.shift_operator_id', '=', 'sh.id')
        ->select(
            'al.alat_unit as nomor_unit',
            'al.nama_operator',
            'al.hm_awal',
            'al.hm_akhir',
            'al.hm_cash',
            'al.keterangan',
            'sh.keterangan as shift',
            'al.tanggal_operator as tanggal',
        )
        ->where('al.daily_report_uuid', $uuid)->get();

        $catatan = DB::table('catatan_pengawas_t as cp')
        ->leftJoin('daily_report_t as dr', 'cp.daily_report_id', '=', 'dr.id')
        ->select(
            'cp.jam_start',
            'cp.jam_stop',
            'cp.keterangan',
        )
        ->where('cp.daily_report_uuid', $uuid)->get();

        $timeSlots = [
            'siang' => ['07.00 - 08.00', '08.00 - 09.00', '09.00 - 10.00', '10.00 - 11.00', '11.00 - 12.00', '12.00 - 13.00', '13.00 - 14.00', '14.00 - 15.00', '15.00 - 16.00', '16.00 - 17.00', '17.00 - 18.00', '18.00 - 19.00'],
            // 'malam' => ['19.00 - 20.00', '20.00 - 21.00', '21.00 - 22.00', '22.00 - 23.00', '23.00 - 24.00', '24.00 - 01.00', '01.00 - 02.00', '02.00 - 03.00', '03.00 - 04.00', '04.00 - 05.00', '05.00 - 06.00', '06.00 - 07.00'],
        ];

        // Menghasilkan data seperti '✓' untuk menandakan waktu yang dicentang
        $processedData = $front->map(function ($units, $brand) use ($timeSlots) {
            return $units->map(function ($unit) use ($timeSlots) {
                $siangTimes = json_decode($unit->siang, true);
                $malamTimes = json_decode($unit->malam, true);
                $checked = array_map(function ($item) {
                    return $item === 'true'; // Convert 'true' string to boolean
                }, json_decode($unit->checked, true));
                $keterangan = array_map(function ($item) {
                    return $item === null ? '' : $item; // Mengganti null dengan string kosong
                }, json_decode($unit->keterangan, true));

                $siangResult = collect($timeSlots['siang'])->map(function ($slot) use ($siangTimes, $checked, $keterangan) {
                    $index = array_search($slot, $siangTimes);
                    if ($index !== false && $checked[$index] === true) {
                        return (object)[
                            'status' => '√', // Checkmark
                            'keterangan' => $keterangan[$index] ?? '', // Get corresponding keterangan
                        ];
                    }
                    return (object)[
                        'status' => '',
                        'keterangan' => '', // No keterangan
                    ];
                });
                return [
                    'brand' => $unit->brand,
                    'type' => $unit->type,
                    'nomor_unit' => $unit->nomor_unit,
                    'siang' => $siangResult,
                    // 'malam' => $malamResult,
                ];
            });
        });

        $data = [
            'daily' => $daily,
            'front' => $processedData,
            'support' => $support,
            'catatan' => $catatan,
        ];

        // $pdf = PDF::loadView('form-pengawas.download', array(
        //     'data' => $data,
        // ))->setPaper('a4', 'portrait');
        // return $pdf->download($data['daily']->tanggal.'_'.$data['daily']->nik_foreman.'_'.$data['daily']->nama_foreman.'.pdf');

        return view('form-pengawas-old.download', compact(['data', 'timeSlots']));
    }

    public function delete($uuid)
    {
        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('shift_m as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('area_m as ar', 'dr.area_id', '=', 'ar.id')
        ->leftJoin('lokasi_m as lok', 'dr.lokasi_id', '=', 'lok.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->select(
            'dr.id',
            'dr.uuid',
            'dr.tanggal_dasar as tanggal',
            'sh.keterangan as shift',
            'ar.keterangan as area',
            'lok.keterangan as lokasi',
            'us.name as pic',
            'dr.nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dr.nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dr.nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',

        )->where('dr.uuid', $uuid)->first();

        try {

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'Laporan Kerja',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Hapus laporan kerja dengan PIC: '. $daily->pic . ', tanggal pembuatan: '. $daily->tanggal .
                ', shift: '. $daily->shift . ', area: '. $daily->area . ', lokasi: '. $daily->lokasi,
            ]);

            DailyReport::where('uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            FrontLoading::where('daily_report_uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            AlatSupport::where('daily_report_uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            CatatanPengawas::where('daily_report_uuid', $uuid)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Laporan kerja berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Laporan kerja gagal dihapus');
        }
    }
}
