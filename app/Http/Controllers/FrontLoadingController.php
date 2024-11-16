<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontLoadingController extends Controller
{
    //
    public function index()
    {
        return view('front-loading.index');
    }
}
