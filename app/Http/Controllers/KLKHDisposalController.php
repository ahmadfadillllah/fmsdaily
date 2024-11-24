<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

class KLKHDisposalController extends Controller
{
    //
    public function index()
    {
        $users = Personal::where('ROLETYPE', 2)->get();

        return view('klkh.disposal', compact('users'));
    }

    public function insert(Request $request)
    {
        dd($request->all());
    }
}
