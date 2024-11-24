<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

class KLKHHaulRoadController extends Controller
{
    //
    public function index()
    {
        $users = Personal::where('ROLETYPE', 2)->get();
        return view('klkh.haul-road', compact('users'));
    }

    public function insert(Request $request)
    {
        dd($request->all());
    }
}
