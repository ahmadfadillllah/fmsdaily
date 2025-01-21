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
Route::get('/fuel/operator', [FuelServiceURLController::class, 'operator'])->name('fuel.operator');
Route::get('/fuel/location', [FuelServiceURLController::class, 'location'])->name('fuel.location');
Route::get('/fuel/shift', [FuelServiceURLController::class, 'shift'])->name('fuel.shift');
Route::get('/fuel/type', [FuelServiceURLController::class, 'type'])->name('fuel.type');
Route::get('/fuel/unit', [FuelServiceURLController::class, 'unit'])->name('fuel.unit');
Route::get('/fuel/transfrom', [FuelServiceURLController::class, 'transfrom'])->name('fuel.transfrom');
Route::get('/fuel/transto', [FuelServiceURLController::class, 'transto'])->name('fuel.transto');
Route::post('/fuel/sendPostFuel', [FuelServiceURLController::class, 'sendPostFuel'])->name('fuel.post');


// Route::get('/laporan-pengawas', [APIController::class, 'laporanPengawas'])->name('api.laporan-pengawas');
