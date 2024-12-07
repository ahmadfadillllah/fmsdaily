<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\KLKHHaulRoad;
use App\Models\Personal;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class KLKHHaulRoadController extends Controller
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


        $baseQuery = DB::table('klkh_haulroad_t as hr')
        ->leftJoin('users as us', 'hr.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'hr.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'hr.shift_id', '=', 'sh.id')
        ->select(
            'hr.id',
            'hr.uuid',
            'hr.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, hr.created_at, 120) as tanggal_pembuatan'),
            'hr.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'hr.date',
            'hr.time',
        )
        ->where('hr.statusenabled', 'true')
        ->whereBetween(DB::raw('CONVERT(varchar, hr.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $baseQuery->where('pic', Auth::user()->id);
        }

        $haul = $baseQuery->get();

        return view('klkh.haul-road.index', compact('haul'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();
        $superintendent = Personal::where('ROLETYPE', 4)->get();
        $pit = Area::where('statusenabled', 'true')->get();
        $shift = Shift::where('statusenabled', 'true')->get();

        $users = [
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'pit' => $pit,
            'shift' => $shift,
        ];
        return view('klkh.haul-road.insert', compact('users'));
    }

    public function post(Request $request)
    {
        // dd($request->all());

        try {

            $data = $request->all();
            if(Auth::user()->role == 'SUPERVISOR'){
                KLKHHaulRoad::create([
                    'pic' => Auth::user()->id,
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => 'true',
                    'pit_id' => $data['pit'],
                    'shift_id' => $data['shift'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'road_width_check' => $data['road_width_check'],
                    'road_width_note' => $data['road_width_note'] ?? null,
                    'curve_width_check' => $data['curve_width_check'],
                    'curve_width_note' => $data['curve_width_note'] ?? null,
                    'super_elevation_check' => $data['super_elevation_check'],
                    'super_elevation_note' => $data['super_elevation_note'] ?? null,
                    'safety_berm_check' => $data['safety_berm_check'],
                    'safety_berm_note' => $data['safety_berm_note'] ?? null,
                    'tanggul_check' => $data['tanggul_check'],
                    'tanggul_note' => $data['tanggul_note'] ?? null,
                    'safety_patok_check' => $data['safety_patok_check'],
                    'safety_patok_note' => $data['safety_patok_note'] ?? null,
                    'drainage_check' => $data['drainage_check'],
                    'drainage_note' => $data['drainage_note'] ?? null,
                    'median_check' => $data['median_check'],
                    'median_note' => $data['median_note'] ?? null,
                    'intersection_check' => $data['intersection_check'],
                    'intersection_note' => $data['intersection_note'] ?? null,
                    'traffic_sign_check' => $data['traffic_sign_check'],
                    'traffic_sign_note' => $data['traffic_sign_note'] ?? null,
                    'night_work_sign_check' => $data['night_work_sign_check'],
                    'night_work_sign_note' => $data['night_work_sign_note'] ?? null,
                    'road_condition_check' => $data['road_condition_check'],
                    'road_condition_note' => $data['road_condition_note'] ?? null,
                    'divider_check' => $data['divider_check'],
                    'divider_note' => $data['divider_note'] ?? null,
                    'haul_route_check' => $data['haul_route_check'],
                    'haul_route_note' => $data['haul_route_note'] ?? null,
                    'dust_control_check' => $data['dust_control_check'],
                    'dust_control_note' => $data['dust_control_note'] ?? null,
                    'intersection_officer_check' => $data['intersection_officer_check'],
                    'intersection_officer_note' => $data['intersection_officer_note'] ?? null,
                    'red_light_check' => $data['red_light_check'],
                    'red_light_note' => $data['red_light_note'] ?? null,
                    'additional_notes' => $data['additional_notes'] ?? null,
                    'supervisor' => Auth::user()->nik,
                    'verified_supervisor' => Auth::user()->nik,
                    'superintendent' => $data['superintendent'] ?? null,
                ]);
            }else{
                KLKHHaulRoad::create([
                    'pic' => Auth::user()->id,
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => 'true',
                    'pit_id' => $data['pit'],
                    'shift_id' => $data['shift'],
                    'date' => $data['date'],
                    'time' => $data['time'],
                    'road_width_check' => $data['road_width_check'],
                    'road_width_note' => $data['road_width_note'] ?? null,
                    'curve_width_check' => $data['curve_width_check'],
                    'curve_width_note' => $data['curve_width_note'] ?? null,
                    'super_elevation_check' => $data['super_elevation_check'],
                    'super_elevation_note' => $data['super_elevation_note'] ?? null,
                    'safety_berm_check' => $data['safety_berm_check'],
                    'safety_berm_note' => $data['safety_berm_note'] ?? null,
                    'tanggul_check' => $data['tanggul_check'],
                    'tanggul_note' => $data['tanggul_note'] ?? null,
                    'safety_patok_check' => $data['safety_patok_check'],
                    'safety_patok_note' => $data['safety_patok_note'] ?? null,
                    'drainage_check' => $data['drainage_check'],
                    'drainage_note' => $data['drainage_note'] ?? null,
                    'median_check' => $data['median_check'],
                    'median_note' => $data['median_note'] ?? null,
                    'intersection_check' => $data['intersection_check'],
                    'intersection_note' => $data['intersection_note'] ?? null,
                    'traffic_sign_check' => $data['traffic_sign_check'],
                    'traffic_sign_note' => $data['traffic_sign_note'] ?? null,
                    'night_work_sign_check' => $data['night_work_sign_check'],
                    'night_work_sign_note' => $data['night_work_sign_note'] ?? null,
                    'road_condition_check' => $data['road_condition_check'],
                    'road_condition_note' => $data['road_condition_note'] ?? null,
                    'divider_check' => $data['divider_check'],
                    'divider_note' => $data['divider_note'] ?? null,
                    'haul_route_check' => $data['haul_route_check'],
                    'haul_route_note' => $data['haul_route_note'] ?? null,
                    'dust_control_check' => $data['dust_control_check'],
                    'dust_control_note' => $data['dust_control_note'] ?? null,
                    'intersection_officer_check' => $data['intersection_officer_check'],
                    'intersection_officer_note' => $data['intersection_officer_note'] ?? null,
                    'red_light_check' => $data['red_light_check'],
                    'red_light_note' => $data['red_light_note'] ?? null,
                    'additional_notes' => $data['additional_notes'] ?? null,
                    'supervisor' => $data['supervisor'] ?? null,
                    'superintendent' => $data['superintendent'] ?? null,
                ]);
            }

            return redirect()->route('klkh.haul-road')->with('success', 'KLKH Haul Road berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.haul-road')->with('info', nl2br('KLKH Haul Road gagal dibuat..\n' . $th->getMessage()));
        }
    }

    public function delete($id)
    {
        try {
            KLKHHaulRoad::where('id', $id)->update([
                'statusenabled' => 'false',
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.haul-road')->with('success', 'KLKH Haul Road berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.haul-road')->with('info', nl2br('KLKH Haul Road gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
