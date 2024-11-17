<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormPengawasController extends Controller
{
    //
    public function index()
    {
        $ex = DB::connection('sqlsrv')
        ->table('FLT_VEHICLE')
        ->select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
        ->where('VHC_ID', 'like', 'EX%')
        ->where('VHC_ACTIVE', true)
        ->get();

        $hd = DB::connection('sqlsrv')
        ->table('FLT_VEHICLE')
        ->select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
        ->where('VHC_ID', 'like', 'HD%')
        ->where('VHC_ACTIVE', true)
        ->get();

        $mg = DB::connection('sqlsrv')
        ->table('FLT_VEHICLE')
        ->select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
        ->where('VHC_ID', 'like', 'MG%')
        ->where('VHC_ACTIVE', true)
        ->get();

        $bd = DB::connection('sqlsrv')
        ->table('FLT_VEHICLE')
        ->select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
        ->where('VHC_ID', 'like', 'BD%')
        ->where('VHC_ACTIVE', true)
        ->get();

        $wt = DB::connection('sqlsrv')
        ->table('FLT_VEHICLE')
        ->select([
            'VHC_ID',
            'VHC_TYPEID',
            'VHC_GROUPID',
            'VHC_ACTIVE',
        ])
        ->where('VHC_ID', 'like', 'WT%')
        ->where('VHC_ACTIVE', true)
        ->get();

        $material = DB::connection('sqlsrv')
        ->table('PRD_MATERIAL')
        ->select([
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
}
