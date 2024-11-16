<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormPengawasController extends Controller
{
    //
    public function index()
    {
        $exa = DB::connection('sqlsrv')
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

        $data = [
            'exa' => $exa
        ];

        return view('form-pengawas.index', compact('data'));
    }
}
