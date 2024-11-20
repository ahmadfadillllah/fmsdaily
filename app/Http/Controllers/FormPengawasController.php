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
        // For EX vehicles
        $ex = [
            ['VHC_ID' => 'EX001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX004', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX005', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX007', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX008', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX009', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'EX010', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
        ];

        // For HD vehicles
        $hd = [
            ['VHC_ID' => 'HD001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD004', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD005', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD007', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD008', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD009', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'HD010', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ];

        // For MG vehicles
        $mg = [
            ['VHC_ID' => 'MG001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG004', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG005', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG006', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG007', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG008', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG009', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'MG010', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ];

        // For BD vehicles
        $bd = [
            ['VHC_ID' => 'BD001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD004', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD005', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD006', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD007', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD008', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD009', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'BD010', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
        ];

        // For WT vehicles
        $wt = [
            ['VHC_ID' => 'WT001', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT002', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT003', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT004', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT005', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT006', 'VHC_TYPEID' => 3, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT007', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 3, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT008', 'VHC_TYPEID' => 4, 'VHC_GROUPID' => 1, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT009', 'VHC_TYPEID' => 1, 'VHC_GROUPID' => 2, 'VHC_ACTIVE' => true],
            ['VHC_ID' => 'WT010', 'VHC_TYPEID' => 2, 'VHC_GROUPID' => 4, 'VHC_ACTIVE' => true],
        ];

        // For materials
        $material = [
            ['MAT_ID' => 'M001', 'MAT_DESC' => 'Material 1', 'MAT_DENSITY' => 1.25],
            ['MAT_ID' => 'M002', 'MAT_DESC' => 'Material 2', 'MAT_DENSITY' => 1.50],
            ['MAT_ID' => 'M003', 'MAT_DESC' => 'Material 3', 'MAT_DENSITY' => 2.00],
            ['MAT_ID' => 'M004', 'MAT_DESC' => 'Material 4', 'MAT_DENSITY' => 0.75],
            ['MAT_ID' => 'M005', 'MAT_DESC' => 'Material 5', 'MAT_DENSITY' => 1.10],
            ['MAT_ID' => 'M006', 'MAT_DESC' => 'Material 6', 'MAT_DENSITY' => 1.80],
            ['MAT_ID' => 'M007', 'MAT_DESC' => 'Material 7', 'MAT_DENSITY' => 1.60],
            ['MAT_ID' => 'M008', 'MAT_DESC' => 'Material 8', 'MAT_DENSITY' => 2.25],
            ['MAT_ID' => 'M009', 'MAT_DESC' => 'Material 9', 'MAT_DENSITY' => 1.00],
            ['MAT_ID' => 'M010', 'MAT_DESC' => 'Material 10', 'MAT_DENSITY' => 1.35],
        ];

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
