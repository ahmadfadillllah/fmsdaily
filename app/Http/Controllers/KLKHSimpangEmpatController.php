<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\KLKHSimpangEmpat;
use App\Models\Personal;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Ramsey\Uuid\Uuid;

class KLKHSimpangEmpatController extends Controller
{
    //
    public function index(Request $request)
    {
        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$startDate");
            $end = new DateTime("$endDate");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }


        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');


        $baseQuery = DB::table('klkh_simpangempat_t as se')
        ->leftJoin('users as us', 'se.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'se.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'se.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'se.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'se.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'se.superintendent', '=', 'spt.NRP')
        ->select(
            'se.id',
            'se.uuid',
            'se.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, se.created_at, 120) as tanggal_pembuatan'),
            'se.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'se.foreman as nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'se.supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'se.superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'se.verified_foreman',
            'se.verified_supervisor',
            'se.verified_superintendent',
            'se.date',
            'se.time',
        )
        ->where('se.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, se.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        // if (Auth::user()->role == 'FOREMAN') {
        //     $baseQuery->where('foreman', Auth::user()->nik);
        // }
        // if (Auth::user()->role == 'SUPERVISOR') {
        //     $baseQuery->where('supervisor', Auth::user()->nik);
        // }
        // if (Auth::user()->role == 'SUPERINTENDENT') {
        //     $baseQuery->where('superintendent', Auth::user()->nik);
        // }
        if (Auth::user()->role == 'ADMIN') {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $baseQuery = $baseQuery->where(function($query) {
            $query->where('se.foreman', Auth::user()->nik)
                  ->orWhere('se.supervisor', Auth::user()->nik)
                  ->orWhere('se.superintendent', Auth::user()->nik);
        });

        $simpang = $baseQuery->get();



        return view('klkh.simpang-empat.index', compact('simpang'));
    }

    public function preview($uuid)
    {
        $se = DB::table('klkh_simpangempat_t as se')
        ->leftJoin('users as us', 'se.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'se.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'se.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'se.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'se.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'se.superintendent', '=', 'spt.NRP')
        ->select(
            'se.*',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'us.name as nama_pic',
            'gl.PERSONALNAME as nama_foreman',
            'spv.PERSONALNAME as nama_supervisor',
            'spt.PERSONALNAME as nama_superintendent'
            )
        ->where('se.statusenabled', true)
        ->where('se.uuid', $uuid)->first();

        if($se == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $se->verified_foreman = $se->verified_foreman != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $se->nama_foreman) : null;
            $se->verified_supervisor = $se->verified_supervisor != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $se->nama_supervisor) : null;
            $se->verified_superintendent = $se->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $se->nama_superintendent) : null;
        }

        return view('klkh.simpang-empat.preview', compact('se'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();

        $superintendent = Personal::whereIn('ROLETYPE', [3, 4])
        ->select('*', DB::raw("CASE WHEN ROLETYPE = 3 THEN 'SUPERVISOR' WHEN ROLETYPE = 4 THEN 'SUPERINTENDENT' ELSE 'UNKNOWN' END as JABATAN "))
        ->orderBy(DB::raw("CASE WHEN ROLETYPE = 3 THEN 1 WHEN ROLETYPE = 4 THEN 2 ELSE 3 END "))->get();

        $pit = Area::where('statusenabled', true)->get();
        $shift = Shift::where('statusenabled', true)->get();

        $users = [
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'pit' => $pit,
            'shift' => $shift,
        ];

        return view('klkh.simpang-empat.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();
            $dataToInsert = [
                    'pic' => Auth::user()->id,
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => true,
                    'pit_id' => $data['pit'],
                    'shift_id' => $data['shift'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'intersection_name_check' => $data['intersection_name_check'] ?? null,
                    'intersection_name_note' => $data['intersection_name_note'] ?? null,
                    'speed_limit_sign_check' => $data['speed_limit_sign_check'] ?? null,
                    'speed_limit_sign_note' => $data['speed_limit_sign_note'] ?? null,
                    'intersection_sign_check' => $data['intersection_sign_check'] ?? null,
                    'intersection_sign_note' => $data['intersection_sign_note'] ?? null,
                    'caution_sign_check' => $data['caution_sign_check'] ?? null,
                    'caution_sign_note' => $data['caution_sign_note'] ?? null,
                    'stop_sign_check' => $data['stop_sign_check'] ?? null,
                    'stop_sign_note' => $data['stop_sign_note'] ?? null,
                    'horn_sign_unit_check' => $data['horn_sign_unit_check'] ?? null,
                    'horn_sign_unit_note' => $data['horn_sign_unit_note'] ?? null,
                    'double_sign_check' => $data['double_sign_check'] ?? null,
                    'double_sign_note' => $data['double_sign_note'] ?? null,
                    'right_turn_prohibited_check' => $data['right_turn_prohibited_check'] ?? null,
                    'right_turn_prohibited_note' => $data['right_turn_prohibited_note'] ?? null,
                    'traffic_light_check' => $data['traffic_light_check'] ?? null,
                    'traffic_light_note' => $data['traffic_light_note'] ?? null,
                    'intersection_officer_check' => $data['intersection_officer_check'] ?? null,
                    'intersection_officer_note' => $data['intersection_officer_note'] ?? null,
                    'radio_communication_check' => $data['radio_communication_check'] ?? null,
                    'radio_communication_note' => $data['radio_communication_note'] ?? null,
                    'intersection_monitoring_check' => $data['intersection_monitoring_check'] ?? null,
                    'intersection_monitoring_note' => $data['intersection_monitoring_note'] ?? null,
                    'standard_road_medium_check' => $data['standard_road_medium_check'] ?? null,
                    'standard_road_medium_note' => $data['standard_road_medium_note'] ?? null,
                    'road_width_check' => $data['road_width_check'] ?? null,
                    'road_width_note' => $data['road_width_note'] ?? null,
                    'smooth_transport_path_check' => $data['smooth_transport_path_check'] ?? null,
                    'smooth_transport_path_note' => $data['smooth_transport_path_note'] ?? null,
                    'blind_spot_check' => $data['blind_spot_check'] ?? null,
                    'blind_spot_note' => $data['blind_spot_note'] ?? null,
                    'radius_check' => $data['radius_check'] ?? null,
                    'radius_note' => $data['radius_note'] ?? null,
                    'trash_bin_check' => $data['trash_bin_check'] ?? null,
                    'trash_bin_note' => $data['trash_bin_note'] ?? null,
                    'toilet_facility_check' => $data['toilet_facility_check'] ?? null,
                    'toilet_facility_note' => $data['toilet_facility_note'] ?? null,
                    'lighting_check' => $data['lighting_check'] ?? null,
                    'lighting_note' => $data['lighting_note'] ?? null,
                    'first_aid_box_check' => $data['first_aid_box_check'] ?? null,
                    'first_aid_box_note' => $data['first_aid_box_note'] ?? null,
                    'fire_extinguisher_check' => $data['fire_extinguisher_check'] ?? null,
                    'fire_extinguisher_note' => $data['fire_extinguisher_note'] ?? null,
                    'parking_area_check' => $data['parking_area_check'] ?? null,
                    'parking_area_note' => $data['parking_area_note'] ?? null,
                    'lightning_rod_check' => $data['lightning_rod_check'] ?? null,
                    'lightning_rod_note' => $data['lightning_rod_note'] ?? null,
                    'sop_check' => $data['sop_check'] ?? null,
                    'sop_note' => $data['sop_note'] ?? null,
                    'additional_notes' => $data['additional_notes'] ?? null,
                    'superintendent' => $data['superintendent'] ?? null,
            ];

            if (Auth::user()->role == 'SUPERVISOR') {
                $dataToInsert['supervisor'] = Auth::user()->nik;
                $dataToInsert['verified_supervisor'] = Auth::user()->nik;
            }

            if (Auth::user()->role == 'FOREMAN') {
                $dataToInsert['supervisor'] = $data['supervisor'] ?? null;
                $dataToInsert['foreman'] = Auth::user()->nik;
                $dataToInsert['verified_foreman'] = Auth::user()->nik;
            }

            KLKHSimpangEmpat::create($dataToInsert);

            return redirect()->route('klkh.simpangempat')->with('success', 'KLKH Simpang Empat berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.simpangempat')->with('info', nl2br('KLKH Simpang Empat gagal dibuat..\n' . $th->getMessage()));
        }

    }

    public function delete($id)
    {
        try {
            KLKHSimpangEmpat::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.simpangempat')->with('success', 'KLKH Simpang Empat berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.simpangempat')->with('info', nl2br('KLKH Simpang Empat gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function verifiedAll($uuid)
    {
        $klkh =  KLKHSimpangEmpat::where('uuid', $uuid)->first();

        try {
            KLKHSimpangEmpat::where('id', $klkh->id)->update([
                'verified_foreman' => $klkh->foreman,
                'verified_supervisor' => $klkh->supervisor,
                'verified_superintendent' => $klkh->superintendent,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Simpang Empat berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Simpang Empat gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedForeman($uuid)
    {
        $klkh =  KLKHSimpangEmpat::where('uuid', $uuid)->first();

        try {
            KLKHSimpangEmpat::where('id', $klkh->id)->update([
                'verified_foreman' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Simpang Empat berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Simpang Empat gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedSupervisor($uuid)
    {
        $klkh =  KLKHSimpangEmpat::where('uuid', $uuid)->first();

        try {
            KLKHSimpangEmpat::where('id', $klkh->id)->update([
                'verified_supervisor' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Simpang Empat berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Simpang Empat gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedSuperintendent($uuid)
    {
        $klkh =  KLKHSimpangEmpat::where('uuid', $uuid)->first();

        try {
            KLKHSimpangEmpat::where('id', $klkh->id)->update([
                'verified_superintendent' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Simpang Empat berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Simpang Empat gagal diverifikasi..\n' . $th->getMessage()));
        }
    }
}
