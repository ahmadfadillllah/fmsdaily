<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MonitoringLaporanKerjaKLKHController extends Controller
{
    //
    public function index(Request $request)
    {
        // dd($request->all());
        $today = Carbon::today();  // Mendapatkan tanggal hari ini
        $year = strval($today->year);  // Tahun dalam format angka (contoh: 2025)
        $month = strval($today->month);  // Bulan dalam format angka, dikonversi ke string (contoh: "1" untuk Januari)
        $dayOfMonth = $today->day;

        if (empty($request->rangeStartVerif) || empty($request->rangeEndVerif)) {
            $time = Carbon::now();  // Mendapatkan waktu saat ini menggunakan Carbon

            // Shift siang dimulai pukul 06:30 dan berakhir pukul 18:30
            $startDateMorning = $time->copy()->setTime(6, 30, 0); // 06:30:00 hari ini
            $endDateMorning = $time->copy()->setTime(18, 30, 0); // 18:30:00 hari ini

            // Shift malam dimulai pukul 18:30 hari ini dan berakhir pukul 06:30 hari berikutnya
            $startDateNight = $time->copy()->setTime(18, 30, 0); // 18:30:00 hari ini
            $endDateNight = $time->copy()->setTime(6, 30, 0); // 06:30:00 besok

            // Pilih shift berdasarkan waktu saat ini (siang atau malam)
            if ($time->hour >= 18 && $time->minute >= 30 && $time->hour <= 6 && $time->minute >= 30) {
                // Jika sudah lewat jam 18:30, gunakan shift malam
                $endDateNight->addDay();
                $start = new DateTime($startDateNight->format('Y-m-d\TH:i:s'));
                $end = new DateTime($endDateNight->format('Y-m-d\TH:i:s'));
            } else {
                // Jika belum lewat jam 18:30, gunakan shift siang
                $start = new DateTime($startDateMorning->format('Y-m-d\TH:i:s'));
                $end = new DateTime($endDateMorning->format('Y-m-d\TH:i:s'));
            }
        } else {
            // Jika parameter rangeStartVerif dan rangeEndVerif ada di URL, gunakan nilai tersebut
            $start = new DateTime($request->rangeStartVerif);
            $end = new DateTime($request->rangeEndVerif);
        }

        // Format waktu sesuai dengan format yang diinginkan
        $startTimeFormatted = $start->format('Y-m-d H:i:s');
        $endTimeFormatted = $end->format('Y-m-d H:i:s');

        // dd($endTimeFormatted);


        $loading = DB::table('klkh_loadingpoint_t as lp')
        ->leftJoin('users as us', 'lp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lp.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'lp.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'lp.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'lp.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'lp.id',
            'lp.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, lp.created_at, 120) as tanggal_pembuatan'),
            'lp.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(lp.created_at) = 1 THEN rs.[1]
                    WHEN DAY(lp.created_at) = 2 THEN rs.[2]
                    WHEN DAY(lp.created_at) = 3 THEN rs.[3]
                    WHEN DAY(lp.created_at) = 4 THEN rs.[4]
                    WHEN DAY(lp.created_at) = 5 THEN rs.[5]
                    WHEN DAY(lp.created_at) = 6 THEN rs.[6]
                    WHEN DAY(lp.created_at) = 7 THEN rs.[7]
                    WHEN DAY(lp.created_at) = 8 THEN rs.[8]
                    WHEN DAY(lp.created_at) = 9 THEN rs.[9]
                    WHEN DAY(lp.created_at) = 10 THEN rs.[10]
                    WHEN DAY(lp.created_at) = 11 THEN rs.[11]
                    WHEN DAY(lp.created_at) = 12 THEN rs.[12]
                    WHEN DAY(lp.created_at) = 13 THEN rs.[13]
                    WHEN DAY(lp.created_at) = 14 THEN rs.[14]
                    WHEN DAY(lp.created_at) = 15 THEN rs.[15]
                    WHEN DAY(lp.created_at) = 16 THEN rs.[16]
                    WHEN DAY(lp.created_at) = 17 THEN rs.[17]
                    WHEN DAY(lp.created_at) = 18 THEN rs.[18]
                    WHEN DAY(lp.created_at) = 19 THEN rs.[19]
                    WHEN DAY(lp.created_at) = 20 THEN rs.[20]
                    WHEN DAY(lp.created_at) = 21 THEN rs.[21]
                    WHEN DAY(lp.created_at) = 22 THEN rs.[22]
                    WHEN DAY(lp.created_at) = 23 THEN rs.[23]
                    WHEN DAY(lp.created_at) = 24 THEN rs.[24]
                    WHEN DAY(lp.created_at) = 25 THEN rs.[25]
                    WHEN DAY(lp.created_at) = 26 THEN rs.[26]
                    WHEN DAY(lp.created_at) = 27 THEN rs.[27]
                    WHEN DAY(lp.created_at) = 28 THEN rs.[28]
                    WHEN DAY(lp.created_at) = 29 THEN rs.[29]
                    WHEN DAY(lp.created_at) = 30 THEN rs.[30]
                    WHEN DAY(lp.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'LOADING POINT' as source_table")
        )
        ->where('lp.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(lp.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(lp.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, lp.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);


        $haulroad = DB::table('klkh_haulroad_t as hr')
        ->leftJoin('users as us', 'hr.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'hr.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'hr.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'hr.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'hr.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'hr.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'hr.id',
            'hr.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, hr.created_at, 120) as tanggal_pembuatan'),
            'hr.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(hr.created_at) = 1 THEN rs.[1]
                    WHEN DAY(hr.created_at) = 2 THEN rs.[2]
                    WHEN DAY(hr.created_at) = 3 THEN rs.[3]
                    WHEN DAY(hr.created_at) = 4 THEN rs.[4]
                    WHEN DAY(hr.created_at) = 5 THEN rs.[5]
                    WHEN DAY(hr.created_at) = 6 THEN rs.[6]
                    WHEN DAY(hr.created_at) = 7 THEN rs.[7]
                    WHEN DAY(hr.created_at) = 8 THEN rs.[8]
                    WHEN DAY(hr.created_at) = 9 THEN rs.[9]
                    WHEN DAY(hr.created_at) = 10 THEN rs.[10]
                    WHEN DAY(hr.created_at) = 11 THEN rs.[11]
                    WHEN DAY(hr.created_at) = 12 THEN rs.[12]
                    WHEN DAY(hr.created_at) = 13 THEN rs.[13]
                    WHEN DAY(hr.created_at) = 14 THEN rs.[14]
                    WHEN DAY(hr.created_at) = 15 THEN rs.[15]
                    WHEN DAY(hr.created_at) = 16 THEN rs.[16]
                    WHEN DAY(hr.created_at) = 17 THEN rs.[17]
                    WHEN DAY(hr.created_at) = 18 THEN rs.[18]
                    WHEN DAY(hr.created_at) = 19 THEN rs.[19]
                    WHEN DAY(hr.created_at) = 20 THEN rs.[20]
                    WHEN DAY(hr.created_at) = 21 THEN rs.[21]
                    WHEN DAY(hr.created_at) = 22 THEN rs.[22]
                    WHEN DAY(hr.created_at) = 23 THEN rs.[23]
                    WHEN DAY(hr.created_at) = 24 THEN rs.[24]
                    WHEN DAY(hr.created_at) = 25 THEN rs.[25]
                    WHEN DAY(hr.created_at) = 26 THEN rs.[26]
                    WHEN DAY(hr.created_at) = 27 THEN rs.[27]
                    WHEN DAY(hr.created_at) = 28 THEN rs.[28]
                    WHEN DAY(hr.created_at) = 29 THEN rs.[29]
                    WHEN DAY(hr.created_at) = 30 THEN rs.[30]
                    WHEN DAY(hr.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'HAUL ROAD' as source_table")
        )
        ->where('hr.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(hr.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(hr.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, hr.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);

        $disposal = DB::table('klkh_disposal_t as dp')
        ->leftJoin('users as us', 'dp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'dp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'dp.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dp.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dp.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dp.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'dp.id',
            'dp.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, dp.created_at, 120) as tanggal_pembuatan'),
            'dp.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(dp.created_at) = 1 THEN rs.[1]
                    WHEN DAY(dp.created_at) = 2 THEN rs.[2]
                    WHEN DAY(dp.created_at) = 3 THEN rs.[3]
                    WHEN DAY(dp.created_at) = 4 THEN rs.[4]
                    WHEN DAY(dp.created_at) = 5 THEN rs.[5]
                    WHEN DAY(dp.created_at) = 6 THEN rs.[6]
                    WHEN DAY(dp.created_at) = 7 THEN rs.[7]
                    WHEN DAY(dp.created_at) = 8 THEN rs.[8]
                    WHEN DAY(dp.created_at) = 9 THEN rs.[9]
                    WHEN DAY(dp.created_at) = 10 THEN rs.[10]
                    WHEN DAY(dp.created_at) = 11 THEN rs.[11]
                    WHEN DAY(dp.created_at) = 12 THEN rs.[12]
                    WHEN DAY(dp.created_at) = 13 THEN rs.[13]
                    WHEN DAY(dp.created_at) = 14 THEN rs.[14]
                    WHEN DAY(dp.created_at) = 15 THEN rs.[15]
                    WHEN DAY(dp.created_at) = 16 THEN rs.[16]
                    WHEN DAY(dp.created_at) = 17 THEN rs.[17]
                    WHEN DAY(dp.created_at) = 18 THEN rs.[18]
                    WHEN DAY(dp.created_at) = 19 THEN rs.[19]
                    WHEN DAY(dp.created_at) = 20 THEN rs.[20]
                    WHEN DAY(dp.created_at) = 21 THEN rs.[21]
                    WHEN DAY(dp.created_at) = 22 THEN rs.[22]
                    WHEN DAY(dp.created_at) = 23 THEN rs.[23]
                    WHEN DAY(dp.created_at) = 24 THEN rs.[24]
                    WHEN DAY(dp.created_at) = 25 THEN rs.[25]
                    WHEN DAY(dp.created_at) = 26 THEN rs.[26]
                    WHEN DAY(dp.created_at) = 27 THEN rs.[27]
                    WHEN DAY(dp.created_at) = 28 THEN rs.[28]
                    WHEN DAY(dp.created_at) = 29 THEN rs.[29]
                    WHEN DAY(dp.created_at) = 30 THEN rs.[30]
                    WHEN DAY(dp.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'DISPOSAL/DUMPING POINT' as source_table")
        )
        ->where('dp.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(dp.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(dp.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, dp.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);

        $lumpur = DB::table('klkh_lumpur_t as lum')
        ->leftJoin('users as us', 'lum.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lum.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lum.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'lum.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'lum.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'lum.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'lum.id',
            'lum.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, lum.created_at, 120) as tanggal_pembuatan'),
            'lum.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(lum.created_at) = 1 THEN rs.[1]
                    WHEN DAY(lum.created_at) = 2 THEN rs.[2]
                    WHEN DAY(lum.created_at) = 3 THEN rs.[3]
                    WHEN DAY(lum.created_at) = 4 THEN rs.[4]
                    WHEN DAY(lum.created_at) = 5 THEN rs.[5]
                    WHEN DAY(lum.created_at) = 6 THEN rs.[6]
                    WHEN DAY(lum.created_at) = 7 THEN rs.[7]
                    WHEN DAY(lum.created_at) = 8 THEN rs.[8]
                    WHEN DAY(lum.created_at) = 9 THEN rs.[9]
                    WHEN DAY(lum.created_at) = 10 THEN rs.[10]
                    WHEN DAY(lum.created_at) = 11 THEN rs.[11]
                    WHEN DAY(lum.created_at) = 12 THEN rs.[12]
                    WHEN DAY(lum.created_at) = 13 THEN rs.[13]
                    WHEN DAY(lum.created_at) = 14 THEN rs.[14]
                    WHEN DAY(lum.created_at) = 15 THEN rs.[15]
                    WHEN DAY(lum.created_at) = 16 THEN rs.[16]
                    WHEN DAY(lum.created_at) = 17 THEN rs.[17]
                    WHEN DAY(lum.created_at) = 18 THEN rs.[18]
                    WHEN DAY(lum.created_at) = 19 THEN rs.[19]
                    WHEN DAY(lum.created_at) = 20 THEN rs.[20]
                    WHEN DAY(lum.created_at) = 21 THEN rs.[21]
                    WHEN DAY(lum.created_at) = 22 THEN rs.[22]
                    WHEN DAY(lum.created_at) = 23 THEN rs.[23]
                    WHEN DAY(lum.created_at) = 24 THEN rs.[24]
                    WHEN DAY(lum.created_at) = 25 THEN rs.[25]
                    WHEN DAY(lum.created_at) = 26 THEN rs.[26]
                    WHEN DAY(lum.created_at) = 27 THEN rs.[27]
                    WHEN DAY(lum.created_at) = 28 THEN rs.[28]
                    WHEN DAY(lum.created_at) = 29 THEN rs.[29]
                    WHEN DAY(lum.created_at) = 30 THEN rs.[30]
                    WHEN DAY(lum.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'DUMPING DIKOLAM AIR/LUMPUR' as source_table")
        )
        ->where('lum.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(lum.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(lum.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, lum.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);

        $ogs = DB::table('klkh_ogs_t as ogs')
        ->leftJoin('users as us', 'ogs.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'ogs.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'ogs.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'ogs.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'ogs.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'ogs.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'ogs.id',
            'ogs.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, ogs.created_at, 120) as tanggal_pembuatan'),
            'ogs.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(ogs.created_at) = 1 THEN rs.[1]
                    WHEN DAY(ogs.created_at) = 2 THEN rs.[2]
                    WHEN DAY(ogs.created_at) = 3 THEN rs.[3]
                    WHEN DAY(ogs.created_at) = 4 THEN rs.[4]
                    WHEN DAY(ogs.created_at) = 5 THEN rs.[5]
                    WHEN DAY(ogs.created_at) = 6 THEN rs.[6]
                    WHEN DAY(ogs.created_at) = 7 THEN rs.[7]
                    WHEN DAY(ogs.created_at) = 8 THEN rs.[8]
                    WHEN DAY(ogs.created_at) = 9 THEN rs.[9]
                    WHEN DAY(ogs.created_at) = 10 THEN rs.[10]
                    WHEN DAY(ogs.created_at) = 11 THEN rs.[11]
                    WHEN DAY(ogs.created_at) = 12 THEN rs.[12]
                    WHEN DAY(ogs.created_at) = 13 THEN rs.[13]
                    WHEN DAY(ogs.created_at) = 14 THEN rs.[14]
                    WHEN DAY(ogs.created_at) = 15 THEN rs.[15]
                    WHEN DAY(ogs.created_at) = 16 THEN rs.[16]
                    WHEN DAY(ogs.created_at) = 17 THEN rs.[17]
                    WHEN DAY(ogs.created_at) = 18 THEN rs.[18]
                    WHEN DAY(ogs.created_at) = 19 THEN rs.[19]
                    WHEN DAY(ogs.created_at) = 20 THEN rs.[20]
                    WHEN DAY(ogs.created_at) = 21 THEN rs.[21]
                    WHEN DAY(ogs.created_at) = 22 THEN rs.[22]
                    WHEN DAY(ogs.created_at) = 23 THEN rs.[23]
                    WHEN DAY(ogs.created_at) = 24 THEN rs.[24]
                    WHEN DAY(ogs.created_at) = 25 THEN rs.[25]
                    WHEN DAY(ogs.created_at) = 26 THEN rs.[26]
                    WHEN DAY(ogs.created_at) = 27 THEN rs.[27]
                    WHEN DAY(ogs.created_at) = 28 THEN rs.[28]
                    WHEN DAY(ogs.created_at) = 29 THEN rs.[29]
                    WHEN DAY(ogs.created_at) = 30 THEN rs.[30]
                    WHEN DAY(ogs.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'OGS' as source_table")
        )
        ->where('ogs.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(ogs.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(ogs.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, ogs.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);

        $batubara = DB::table('klkh_batubara_t as lp')
        ->leftJoin('users as us', 'lp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'lp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'lp.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'lp.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'lp.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'lp.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'lp.id',
            'lp.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, lp.created_at, 120) as tanggal_pembuatan'),
            'lp.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(lp.created_at) = 1 THEN rs.[1]
                    WHEN DAY(lp.created_at) = 2 THEN rs.[2]
                    WHEN DAY(lp.created_at) = 3 THEN rs.[3]
                    WHEN DAY(lp.created_at) = 4 THEN rs.[4]
                    WHEN DAY(lp.created_at) = 5 THEN rs.[5]
                    WHEN DAY(lp.created_at) = 6 THEN rs.[6]
                    WHEN DAY(lp.created_at) = 7 THEN rs.[7]
                    WHEN DAY(lp.created_at) = 8 THEN rs.[8]
                    WHEN DAY(lp.created_at) = 9 THEN rs.[9]
                    WHEN DAY(lp.created_at) = 10 THEN rs.[10]
                    WHEN DAY(lp.created_at) = 11 THEN rs.[11]
                    WHEN DAY(lp.created_at) = 12 THEN rs.[12]
                    WHEN DAY(lp.created_at) = 13 THEN rs.[13]
                    WHEN DAY(lp.created_at) = 14 THEN rs.[14]
                    WHEN DAY(lp.created_at) = 15 THEN rs.[15]
                    WHEN DAY(lp.created_at) = 16 THEN rs.[16]
                    WHEN DAY(lp.created_at) = 17 THEN rs.[17]
                    WHEN DAY(lp.created_at) = 18 THEN rs.[18]
                    WHEN DAY(lp.created_at) = 19 THEN rs.[19]
                    WHEN DAY(lp.created_at) = 20 THEN rs.[20]
                    WHEN DAY(lp.created_at) = 21 THEN rs.[21]
                    WHEN DAY(lp.created_at) = 22 THEN rs.[22]
                    WHEN DAY(lp.created_at) = 23 THEN rs.[23]
                    WHEN DAY(lp.created_at) = 24 THEN rs.[24]
                    WHEN DAY(lp.created_at) = 25 THEN rs.[25]
                    WHEN DAY(lp.created_at) = 26 THEN rs.[26]
                    WHEN DAY(lp.created_at) = 27 THEN rs.[27]
                    WHEN DAY(lp.created_at) = 28 THEN rs.[28]
                    WHEN DAY(lp.created_at) = 29 THEN rs.[29]
                    WHEN DAY(lp.created_at) = 30 THEN rs.[30]
                    WHEN DAY(lp.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'BATU BARA' as source_table")
        )
        ->where('lp.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(lp.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(lp.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, lp.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);


        $simpangempat = DB::table('klkh_simpangempat_t as se')
        ->leftJoin('users as us', 'se.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'se.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'se.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'se.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'se.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'se.superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'se.id',
            'se.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, se.created_at, 120) as tanggal_pembuatan'),
            'se.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(se.created_at) = 1 THEN rs.[1]
                    WHEN DAY(se.created_at) = 2 THEN rs.[2]
                    WHEN DAY(se.created_at) = 3 THEN rs.[3]
                    WHEN DAY(se.created_at) = 4 THEN rs.[4]
                    WHEN DAY(se.created_at) = 5 THEN rs.[5]
                    WHEN DAY(se.created_at) = 6 THEN rs.[6]
                    WHEN DAY(se.created_at) = 7 THEN rs.[7]
                    WHEN DAY(se.created_at) = 8 THEN rs.[8]
                    WHEN DAY(se.created_at) = 9 THEN rs.[9]
                    WHEN DAY(se.created_at) = 10 THEN rs.[10]
                    WHEN DAY(se.created_at) = 11 THEN rs.[11]
                    WHEN DAY(se.created_at) = 12 THEN rs.[12]
                    WHEN DAY(se.created_at) = 13 THEN rs.[13]
                    WHEN DAY(se.created_at) = 14 THEN rs.[14]
                    WHEN DAY(se.created_at) = 15 THEN rs.[15]
                    WHEN DAY(se.created_at) = 16 THEN rs.[16]
                    WHEN DAY(se.created_at) = 17 THEN rs.[17]
                    WHEN DAY(se.created_at) = 18 THEN rs.[18]
                    WHEN DAY(se.created_at) = 19 THEN rs.[19]
                    WHEN DAY(se.created_at) = 20 THEN rs.[20]
                    WHEN DAY(se.created_at) = 21 THEN rs.[21]
                    WHEN DAY(se.created_at) = 22 THEN rs.[22]
                    WHEN DAY(se.created_at) = 23 THEN rs.[23]
                    WHEN DAY(se.created_at) = 24 THEN rs.[24]
                    WHEN DAY(se.created_at) = 25 THEN rs.[25]
                    WHEN DAY(se.created_at) = 26 THEN rs.[26]
                    WHEN DAY(se.created_at) = 27 THEN rs.[27]
                    WHEN DAY(se.created_at) = 28 THEN rs.[28]
                    WHEN DAY(se.created_at) = 29 THEN rs.[29]
                    WHEN DAY(se.created_at) = 30 THEN rs.[30]
                    WHEN DAY(se.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan KLKH' as jenis_laporan"),
            DB::raw("'SIMPANG EMPAT' as source_table")
        )
        ->where('se.statusenabled', true)
        ->where('rs.tahun', DB::raw('YEAR(se.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(se.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, se.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);


        $daily = DB::table('daily_report_t as dr')
        ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
        ->leftJoin('shift_m as sh', 'dr.shift_dasar_id', '=', 'sh.id')
        ->leftJoin('area_m as ar', 'dr.area_id', '=', 'ar.id')
        ->leftJoin('lokasi_m as lok', 'dr.lokasi_id', '=', 'lok.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dr.nik_foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dr.nik_supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dr.nik_superintendent', '=', 'spt.NRP')
        ->leftJoin('roster_kerja_m as rs', 'us.nik', '=', 'rs.nik')
        ->select(
            'dr.id',
            'dr.uuid',
            'us.name as pic',
            'us.nik as nik_pic',
            DB::raw('CONVERT(varchar, dr.created_at, 120) as tanggal_pembuatan'),
            'dr.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'rs.unit_kerja',
            'us.role',
            DB::raw("
                CASE
                    WHEN DAY(dr.created_at) = 1 THEN rs.[1]
                    WHEN DAY(dr.created_at) = 2 THEN rs.[2]
                    WHEN DAY(dr.created_at) = 3 THEN rs.[3]
                    WHEN DAY(dr.created_at) = 4 THEN rs.[4]
                    WHEN DAY(dr.created_at) = 5 THEN rs.[5]
                    WHEN DAY(dr.created_at) = 6 THEN rs.[6]
                    WHEN DAY(dr.created_at) = 7 THEN rs.[7]
                    WHEN DAY(dr.created_at) = 8 THEN rs.[8]
                    WHEN DAY(dr.created_at) = 9 THEN rs.[9]
                    WHEN DAY(dr.created_at) = 10 THEN rs.[10]
                    WHEN DAY(dr.created_at) = 11 THEN rs.[11]
                    WHEN DAY(dr.created_at) = 12 THEN rs.[12]
                    WHEN DAY(dr.created_at) = 13 THEN rs.[13]
                    WHEN DAY(dr.created_at) = 14 THEN rs.[14]
                    WHEN DAY(dr.created_at) = 15 THEN rs.[15]
                    WHEN DAY(dr.created_at) = 16 THEN rs.[16]
                    WHEN DAY(dr.created_at) = 17 THEN rs.[17]
                    WHEN DAY(dr.created_at) = 18 THEN rs.[18]
                    WHEN DAY(dr.created_at) = 19 THEN rs.[19]
                    WHEN DAY(dr.created_at) = 20 THEN rs.[20]
                    WHEN DAY(dr.created_at) = 21 THEN rs.[21]
                    WHEN DAY(dr.created_at) = 22 THEN rs.[22]
                    WHEN DAY(dr.created_at) = 23 THEN rs.[23]
                    WHEN DAY(dr.created_at) = 24 THEN rs.[24]
                    WHEN DAY(dr.created_at) = 25 THEN rs.[25]
                    WHEN DAY(dr.created_at) = 26 THEN rs.[26]
                    WHEN DAY(dr.created_at) = 27 THEN rs.[27]
                    WHEN DAY(dr.created_at) = 28 THEN rs.[28]
                    WHEN DAY(dr.created_at) = 29 THEN rs.[29]
                    WHEN DAY(dr.created_at) = 30 THEN rs.[30]
                    WHEN DAY(dr.created_at) = 31 THEN rs.[31]
                    ELSE NULL
                END as roster_kerja
            "),
            DB::raw("'Laporan Kerja' as jenis_laporan"),
            DB::raw("'Laporan Kerja' as source_table")
        )
        ->where('dr.statusenabled', true)
        ->where('dr.is_draft', false)
        ->where('rs.tahun', DB::raw('YEAR(dr.created_at)'))
        ->where('rs.bulan', DB::raw('MONTH(dr.created_at)'))
        ->whereBetween(DB::raw('CONVERT(varchar, dr.created_at, 120)'), [$startTimeFormatted, $endTimeFormatted]);

        //Gabung Table
        $combinedQuery = $loading->unionAll($haulroad)->unionAll($disposal)->unionAll($lumpur)
        ->unionAll($ogs)->unionAll($batubara)->unionAll($simpangempat)->unionAll($daily);


        // $combinedQuery = $combinedQuery->get()->groupBy('source_table');
        $combinedQuery = $combinedQuery->get();

        // dd($combinedQuery);

        session(['data_verified' => $combinedQuery]);


        return view('monitoring-lk-klkh.index', compact('combinedQuery'));
    }
}
