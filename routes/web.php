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
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){
    //dashboard
    Route::get('/dashboards/index', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/form-pengawas/search-users', [FormPengawasController::class, 'users'])->name('cariUsers');
    Route::get('/operator/{nik}', [FormPengawasController::class, 'getOperatorByNIK']);

    Route::get('/production/index', [ProductionController::class, 'index'])->name('production.index');

    //Form Pengawas
    Route::get('/form-pengawas/show', [FormPengawasController::class, 'show'])->name('form-pengawas.show');
    Route::get('/form-pengawas/index', [FormPengawasController::class, 'index'])->name('form-pengawas.index');
    Route::get('/form-pengawas/download/{uuid}', [FormPengawasController::class, 'download'])->name('form-pengawas.download');
    Route::post('/form-pengawas/post', [FormPengawasController::class, 'post'])->name('form-pengawas.post');

    //Front Loading
    Route::get('/front-loading/index', [FrontLoadingController::class, 'index'])->name('front-loading.index');
    Route::get('/front-loading/download', [FrontLoadingController::class, 'download'])->name('front-loading.download');


    //Alat Support
    Route::get('/alat-support/index', [AlatSupportController::class, 'index'])->name('alat-support.index');

    //Catatan Pengawas
    Route::get('/catatan-pengawas/index', [CatatanPengawasController::class, 'index'])->name('catatan-pengawas.index');

    //KLKH Loading Point
    Route::get('/klkh/loading-point', [KLKHLoadingPointController::class, 'index'])->name('klkh.loading-point');
    Route::get('/klkh/loading-point/insert', [KLKHLoadingPointController::class, 'insert'])->name('klkh.loading-point.insert');
    Route::post('/klkh/loading-point/post', [KLKHLoadingPointController::class, 'post'])->name('klkh.loading-point.post');
    Route::get('/klkh/loading-point/delete/{id}', [KLKHLoadingPointController::class, 'delete'])->name('klkh.loading-point.delete');

    //KLKH Haul Road
    Route::get('/klkh/haul-road', [KLKHHaulRoadController::class, 'index'])->name('klkh.haul-road');
    Route::get('/klkh/haul-road/insert', [KLKHHaulRoadController::class, 'insert'])->name('klkh.haul-road.insert');
    Route::post('/klkh/haul-road/post', [KLKHHaulRoadController::class, 'post'])->name('klkh.haul-road.post');
    Route::get('/klkh/haul-road/delete/{id}', [KLKHHaulRoadController::class, 'delete'])->name('klkh.haul-road.delete');

    //KLKH Disposal
    Route::get('/klkh/disposal', [KLKHDisposalController::class, 'index'])->name('klkh.disposal');
    Route::get('/klkh/disposal/insert', [KLKHDisposalController::class, 'insert'])->name('klkh.disposal.insert');
    Route::post('/klkh/disposal/post', [KLKHDisposalController::class, 'post'])->name('klkh.disposal.post');
    Route::get('/klkh/disposal/delete/{id}', [KLKHDisposalController::class, 'delete'])->name('klkh.disposal.delete');

    // Profile
    Route::post('/profile.change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});
