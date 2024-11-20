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
        // $ex = DB::connection('sqlsrv')
        // ->table('FLT_VEHICLE')
        // ->select([
        //     'VHC_ID',
        //     'VHC_TYPEID',
        //     'VHC_GROUPID',
        //     'VHC_ACTIVE',
        // ])
        // ->where('VHC_ID', 'like', 'EX%')
        // ->where('VHC_ACTIVE', true)
        // ->get();

        // $hd = DB::connection('sqlsrv')
        // ->table('FLT_VEHICLE')
        // ->select([
        //     'VHC_ID',
        //     'VHC_TYPEID',
        //     'VHC_GROUPID',
        //     'VHC_ACTIVE',
        // ])
        // ->where('VHC_ID', 'like', 'HD%')
        // ->where('VHC_ACTIVE', true)
        // ->get();

        // $mg = DB::connection('sqlsrv')
        // ->table('FLT_VEHICLE')
        // ->select([
        //     'VHC_ID',
        //     'VHC_TYPEID',
        //     'VHC_GROUPID',
        //     'VHC_ACTIVE',
        // ])
        // ->where('VHC_ID', 'like', 'MG%')
        // ->where('VHC_ACTIVE', true)
        // ->get();

        // $bd = DB::connection('sqlsrv')
        // ->table('FLT_VEHICLE')
        // ->select([
        //     'VHC_ID',
        //     'VHC_TYPEID',
        //     'VHC_GROUPID',
        //     'VHC_ACTIVE',
        // ])
        // ->where('VHC_ID', 'like', 'BD%')
        // ->where('VHC_ACTIVE', true)
        // ->get();

        // $wt = DB::connection('sqlsrv')
        // ->table('FLT_VEHICLE')
        // ->select([
        //     'VHC_ID',
        //     'VHC_TYPEID',
        //     'VHC_GROUPID',
        //     'VHC_ACTIVE',
        // ])
        // ->where('VHC_ID', 'like', 'WT%')
        // ->where('VHC_ACTIVE', true)
        // ->get();

        // $material = DB::connection('sqlsrv')
        // ->table('PRD_MATERIAL')
        // ->select([
        //     'MAT_ID',
        //     'MAT_DESC',
        //     'MAT_DENSITY',
        // ])->get();

        $ex = collect([
            (object) ['VHC_ID' => 'EX001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX002', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX003', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX004', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX005', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX007', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX008', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX009', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'EX010', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ]);

        $hd = collect([
            (object) ['VHC_ID' => 'HD001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD004', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD005', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD007', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD008', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD009', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'HD010', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ]);

        $mg = collect([
            (object) ['VHC_ID' => 'MG001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG004', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG005', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG007', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG008', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG009', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'MG010', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ]);

        $bd = collect([
            (object) ['VHC_ID' => 'BD001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD004', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD005', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD007', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD008', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD009', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'BD010', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ]);

        $wt = collect([
            (object) ['VHC_ID' => 'WT001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT004', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT005', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT007', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT008', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT009', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            (object) ['VHC_ID' => 'WT010', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ]);

        $material = collect([
            (object) ['MAT_ID' => 'M001', 'MAT_DESC' => 'Material 1', 'MAT_DENSITY' => 2.3],
            (object) ['MAT_ID' => 'M002', 'MAT_DESC' => 'Material 2', 'MAT_DENSITY' => 1.7],
            (object) ['MAT_ID' => 'M003', 'MAT_DESC' => 'Material 3', 'MAT_DENSITY' => 3.1],
            (object) ['MAT_ID' => 'M004', 'MAT_DESC' => 'Material 4', 'MAT_DENSITY' => 2.6],
            (object) ['MAT_ID' => 'M005', 'MAT_DESC' => 'Material 5', 'MAT_DENSITY' => 1.9],
            (object) ['MAT_ID' => 'M006', 'MAT_DESC' => 'Material 6', 'MAT_DENSITY' => 2.2],
            (object) ['MAT_ID' => 'M007', 'MAT_DESC' => 'Material 7', 'MAT_DENSITY' => 3.3],
            (object) ['MAT_ID' => 'M008', 'MAT_DESC' => 'Material 8', 'MAT_DENSITY' => 2.8],
            (object) ['MAT_ID' => 'M009', 'MAT_DESC' => 'Material 9', 'MAT_DENSITY' => 2.5],
            (object) ['MAT_ID' => 'M010', 'MAT_DESC' => 'Material 10', 'MAT_DENSITY' => 1.8],
        ]);

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
