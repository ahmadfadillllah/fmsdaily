<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatatanPengawasController extends Controller
{
    //
    public function index()
    {
        return view('catatan-pengawas.index');
    }
}
