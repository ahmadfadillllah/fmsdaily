<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

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

    public function users(Request $request)
    {
        $nik = $request->query('nik');

        // Data dummy di $data['users']
        $data['users'] = collect([
            (object) ['nik' => '0123S1', 'name' => 'Andi'],
            (object) ['nik' => '0123S2', 'name' => 'Budi'],
            (object) ['nik' => '0123S3', 'name' => 'Citra'],
            (object) ['nik' => '0123S4', 'name' => 'Dewi'],
            (object) ['nik' => '0123S5', 'name' => 'Eko'],
            (object) ['nik' => '0123S6', 'name' => 'Fajar'],
            (object) ['nik' => '0123S7', 'name' => 'Gita'],
            (object) ['nik' => '0123S8', 'name' => 'Hendra'],
            (object) ['nik' => '0123S9', 'name' => 'Indah'],
            (object) ['nik' => '0123S10', 'name' => 'Joko'],
            (object) ['nik' => '0123S11', 'name' => 'Kiki'],
            (object) ['nik' => '0123S12', 'name' => 'Lina'],
            (object) ['nik' => '0123S13', 'name' => 'Mira'],
            (object) ['nik' => '0123S14', 'name' => 'Nina'],
            (object) ['nik' => '0123S15', 'name' => 'Oki'],
            (object) ['nik' => '0123S16', 'name' => 'Putra'],
            (object) ['nik' => '0123S17', 'name' => 'Qori'],
            (object) ['nik' => '0123S18', 'name' => 'Rina'],
            (object) ['nik' => '0123S19', 'name' => 'Sari'],
            (object) ['nik' => '0123S20', 'name' => 'Tono'],
        ]);

        // Mencari user berdasarkan NIK
        $user = $data['users']->firstWhere('nik', $nik);

        if ($user) {
            return Response::json([
                'success' => true,
                'name' => $user->name,
            ]);
        } else {
            return Response::json([
                'success' => false,
                'message' => 'User tidak ditemukan',
            ]);
        }
    }

    public function post(Request $request)
    {
        dd($request->all());
    }
}
