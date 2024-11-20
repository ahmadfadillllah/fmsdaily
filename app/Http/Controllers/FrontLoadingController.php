<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class FrontLoadingController extends Controller
{
    //
    public function index()
    {
        return view('front-loading.index');
    }

    public function download()
    {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();

        return view('front-loading.modal.download');
    }
}
