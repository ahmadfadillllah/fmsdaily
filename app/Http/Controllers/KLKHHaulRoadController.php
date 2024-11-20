<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KLKHHaulRoadController extends Controller
{
    //
    public function index()
    {
        return view('klkh.haul-road');
    }

    public function insert(Request $request)
    {
        dd($request->all());
    }
}
