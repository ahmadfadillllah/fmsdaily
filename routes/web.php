<?php

use App\Http\Controllers\AlatSupportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanPengawasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormPengawasController;
use App\Http\Controllers\FrontLoadingController;
use App\Http\Controllers\KLKHDisposalController;
use App\Http\Controllers\KLKHHaulRoadController;
use App\Http\Controllers\KLKHLoadingPointController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){

    Route::get('/form-pengawas/search-users', [FormPengawasController::class, 'users'])->name('cariUsers');

    //Form Pengawas
    Route::get('/form-pengawas/index', [FormPengawasController::class, 'index'])->name('form-pengawas.index');
    Route::post('/form-pengawas/post', [FormPengawasController::class, 'post'])->name('form-pengawas.post');

    //dashboard
    Route::get('/dashboards/index', [DashboardController::class, 'index'])->name('dashboard.index');

    //Front Loading
    Route::get('/front-loading/index', [FrontLoadingController::class, 'index'])->name('front-loading.index');

    //Alat Support
    Route::get('/alat-support/index', [AlatSupportController::class, 'index'])->name('alat-support.index');

    //Catatan Pengawas
    Route::get('/catatan-pengawas/index', [CatatanPengawasController::class, 'index'])->name('catatan-pengawas.index');

    //KLKH Loading Point
    Route::get('/klkh/loading-point', [KLKHLoadingPointController::class, 'index'])->name('klkh.loading-point');
    Route::post('/klkh/loading-point/insert', [KLKHLoadingPointController::class, 'insert'])->name('klkh.loading-point.insert');

    //KLKH Haul Road
    Route::get('/klkh/haul-road', [KLKHHaulRoadController::class, 'index'])->name('klkh.haul-road');
    Route::post('/klkh/haul-road/insert', [KLKHHaulRoadController::class, 'insert'])->name('klkh.haul-road.insert');

    //KLKH Disposal
    Route::get('/klkh/disposal', [KLKHDisposalController::class, 'index'])->name('klkh.disposal');
    Route::get('/klkh/disposal/insert', [KLKHDisposalController::class, 'insert'])->name('klkh.disposal.insert');

    // Profile
    Route::post('/profile.change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});
