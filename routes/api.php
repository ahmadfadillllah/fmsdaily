<?php

use App\Http\Controllers\Api\LaporanHarianController;
use App\Http\Controllers\APIController;
use App\Http\Controllers\FuelServiceURLController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/user', [LaporanHarianController::class, 'laporanPengawas'])->name('api.laporan-pengawas');


Route::get('/fuel/serviceurl/{token}', [FuelServiceURLController::class, 'serviceURL'])->name('fuel.serviceURL');


// Route::get('/laporan-pengawas', [APIController::class, 'laporanPengawas'])->name('api.laporan-pengawas');
