<?php

namespace App\Http\Controllers;

use App\Models\KLKHLoadingPoint;
use App\Models\Personal;
use Illuminate\Http\Request;

class KLKHLoadingPointController extends Controller
{
    //
    public function index()
    {
        $users = Personal::where('ROLETYPE', 2)->get();

        return view('klkh.loading-point', compact('users'));
    }

    public function insert(Request $request)
    {
        try {

            $data = $request->all();

            KLKHLoadingPoint::create([
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
                return redirect()->route('klkh.loading-point')->with('info', 'KLKH Loading Point gagal dibuat.. \n'. $th->getMessage());
            }

    }
}
