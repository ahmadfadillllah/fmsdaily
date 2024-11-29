<?php

namespace App\Http\Controllers;

use App\Models\KLKHLoadingPoint;
use App\Models\Personal;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class KLKHLoadingPointController extends Controller
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


        $baseQuery = DB::table('klkh_loadingpoint_t as lp')
        ->leftJoin('users as us', 'lp.pic', '=', 'us.id')
        ->select(
            'lp.pic as id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, lp.created_at, 120) as tanggal_pembuatan'),
            'lp.statusenabled',
            'lp.pit',
            'lp.shift',
            'lp.date',
            'lp.time',
        )
        ->where('lp.statusenabled', 'true')
        ->whereBetween(DB::raw('CONVERT(varchar, lp.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $baseQuery->where('pic', Auth::user()->id);
        }

        $loading = $baseQuery->get();



        return view('klkh.loading-point.index', compact('loading'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();
        $superintendent = Personal::where('ROLETYPE', 4)->get();

        $users = [
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
        ];
        return view('klkh.loading-point.insert', compact('users'));
    }

    public function post(Request $request)
    {
        try {

            $data = $request->all();

            KLKHLoadingPoint::create([
                'pic' => Auth::user()->id,
                'uuid' => (string) Uuid::uuid4()->toString(),
                'statusenabled' => 'true',
                'pit' => $data['pit'],
                'shift' => $data['shift'],
                'date' => $data['date'],
                'time' => $data['time'],
                'loading_point_check' => $data['loading_point_check'],
                'loading_point_note' => $data['loading_point_note'] ?? null,
                'front_surface_check' => $data['front_surface_check'],
                'front_surface_note' => $data['front_surface_note'] ?? null,
                'bench_work_check' => $data['bench_work_check'],
                'bench_work_note' => $data['bench_work_note'] ?? null,
                'access_dike_check' => $data['access_dike_check'],
                'access_dike_note' => $data['access_dike_note'] ?? null,
                'loading_point_width_check' => $data['loading_point_width_check'],
                'loading_point_width_note' => $data['loading_point_width_note'] ?? null,
                'drainage_check' => $data['drainage_check'],
                'drainage_note' => $data['drainage_note'] ?? null,
                'no_waves_check' => $data['no_waves_check'],
                'no_waves_note' => $data['no_waves_note'] ?? null,
                'unit_placement_check' => $data['unit_placement_check'],
                'unit_placement_note' => $data['unit_placement_note'] ?? null,
                'material_stock_check' => $data['material_stock_check'],
                'material_stock_note' => $data['material_stock_note'] ?? null,
                'loading_hauling_check' => $data['loading_hauling_check'],
                'loading_hauling_note' => $data['loading_hauling_note'] ?? null,
                'dust_control_check' => $data['dust_control_check'],
                'dust_control_note' => $data['dust_control_note'] ?? null,
                'lighting_check' => $data['lighting_check'],
                'lighting_note' => $data['lighting_note'] ?? null,
                'housekeeping_check' => $data['housekeeping_check'],
                'housekeeping_note' => $data['housekeeping_note'] ?? null,
                'additional_notes' => $data['additional_notes'] ?? null,
                'supervisor' => $data['supervisor'] ?? null,
                'superintendent' => $data['superintendent'] ?? null,
            ]);

            return redirect()->route('klkh.loading-point')->with('success', 'KLKH Loading Point berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.loading-point')->with('info', nl2br('KLKH Loading Point gagal dibuat..\n' . $th->getMessage()));
        }

    }

    public function delete($id)
    {
        try {
            KLKHLoadingPoint::where('id', $id) ->update(['statusenabled' => 'false'])->update(['deleted_by' => Auth::user()->id]);

            return redirect()->route('klkh.loading-point')->with('success', 'KLKH Loading Point berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.loading-point')->with('info', nl2br('KLKH Loading Point gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
