<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KLKHLoadingPointController extends Controller
{
    //
    public function index()
    {
        return view('klkh.loading-point');
    }

    public function insert(Request $request)
    {
        dd($request->all());
    }
}
