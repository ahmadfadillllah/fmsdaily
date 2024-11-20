<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KLKHDisposalController extends Controller
{
    //
    public function index()
    {
        return view('klkh.disposal');
    }

    public function insert(Request $request)
    {
        dd($request->all());
    }
}
