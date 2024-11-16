<?php

use App\Http\Controllers\AlatSupportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanPengawasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormPengawasController;
use App\Http\Controllers\FrontLoadingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::group(['middleware' => ['auth']], function(){

    //Form Pengawas
    Route::get('/form-pengawas/index', [FormPengawasController::class, 'index'])->name('form-pengawas.index');

    //dashboard
    Route::get('/dashboards/index', [DashboardController::class, 'index'])->name('dashboard.index');

    //Front Loading
    Route::get('/front-loading/index', [FrontLoadingController::class, 'index'])->name('front-loading.index');

    //Alat Support
    Route::get('/alat-support/index', [AlatSupportController::class, 'index'])->name('alat-support.index');

    //Catatan Pengawas
    Route::get('/catatan-pengawas/index', [CatatanPengawasController::class, 'index'])->name('catatan-pengawas.index');
// });
