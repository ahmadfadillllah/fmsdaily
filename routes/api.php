<?php

use App\Http\Controllers\AlatSupportController;
use App\Http\Controllers\Api\LaporanHarianController;
use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/user', [LaporanHarianController::class, 'laporanPengawas'])->name('api.laporan-pengawas');
Route::get('/alat-support/api', [AlatSupportController::class, 'api'])->name('alat-support.apii');
// Route::get('/laporan-pengawas', [APIController::class, 'laporanPengawas'])->name('api.laporan-pengawas');
