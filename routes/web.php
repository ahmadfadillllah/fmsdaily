<?php

use App\Http\Controllers\AlatSupportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanPengawasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormPengawasController;
use App\Http\Controllers\FrontLoadingController;
use App\Http\Controllers\KLKHBatuBaraController;
use App\Http\Controllers\KLKHDisposalController;
use App\Http\Controllers\KLKHHaulRoadController;
use App\Http\Controllers\KLKHLoadingPointController;
use App\Http\Controllers\KLKHLumpurController;
use App\Http\Controllers\KLKHOGSController;
use App\Http\Controllers\KLKHSimpangEmpatController;
use App\Http\Controllers\OprAssigntmentController;
use App\Http\Controllers\PayloadRitationController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/post', [AuthController::class, 'login_post'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//Payload & Ritation API
Route::get('/payloadritation/api', [PayloadRitationController::class, 'api'])->name('payloadritation.api');

//Operator Assignment
Route::get('/OprAssignment/B1', [OprAssigntmentController::class, 'b1'])->name('opr.b1');
Route::get('/OprAssignment/B1/api', [OprAssigntmentController::class, 'b1_api'])->name('opr.b1.api');
Route::get('/OprAssignment/B2', [OprAssigntmentController::class, 'b2'])->name('opr.b2');
Route::get('/OprAssignment/B2/api', [OprAssigntmentController::class, 'b2_api'])->name('opr.b2.api');
Route::get('/OprAssignment/A3', [OprAssigntmentController::class, 'a3'])->name('opr.a3');


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
    Route::get('/form-pengawas/preview/{uuid}', [FormPengawasController::class, 'preview'])->name('form-pengawas.preview');
    Route::post('/form-pengawas/post', [FormPengawasController::class, 'post'])->name('form-pengawas.post');

    //Front Loading
    Route::get('/front-loading/index', [FrontLoadingController::class, 'index'])->name('front-loading.index');
    Route::get('/front-loading/export/excel', [FrontLoadingController::class, 'excel'])->name('front-loading.excel');


    //Alat Support
    Route::get('/alat-support/index', [AlatSupportController::class, 'index'])->name('alat-support.index');

    //Catatan Pengawas
    Route::get('/catatan-pengawas/index', [CatatanPengawasController::class, 'index'])->name('catatan-pengawas.index');

    //KLKH Loading Point
    Route::get('/klkh/loading-point', [KLKHLoadingPointController::class, 'index'])->name('klkh.loading-point');
    Route::get('/klkh/loading-point/insert', [KLKHLoadingPointController::class, 'insert'])->name('klkh.loading-point.insert');
    Route::post('/klkh/loading-point/post', [KLKHLoadingPointController::class, 'post'])->name('klkh.loading-point.post');
    Route::get('/klkh/loading-point/delete/{id}', [KLKHLoadingPointController::class, 'delete'])->name('klkh.loading-point.delete');
    Route::get('/klkh/loading-point/preview/{uuid}', [KLKHLoadingPointController::class, 'preview'])->name('klkh.loading-point.preview');

    //KLKH Haul Road
    Route::get('/klkh/haul-road', [KLKHHaulRoadController::class, 'index'])->name('klkh.haul-road');
    Route::get('/klkh/haul-road/insert', [KLKHHaulRoadController::class, 'insert'])->name('klkh.haul-road.insert');
    Route::post('/klkh/haul-road/post', [KLKHHaulRoadController::class, 'post'])->name('klkh.haul-road.post');
    Route::get('/klkh/haul-road/delete/{id}', [KLKHHaulRoadController::class, 'delete'])->name('klkh.haul-road.delete');
    Route::get('/klkh/haul-road/preview/{uuid}', [KLKHHaulRoadController::class, 'preview'])->name('klkh.haul-road.preview');

    //KLKH Disposal
    Route::get('/klkh/disposal', [KLKHDisposalController::class, 'index'])->name('klkh.disposal');
    Route::get('/klkh/disposal/insert', [KLKHDisposalController::class, 'insert'])->name('klkh.disposal.insert');
    Route::post('/klkh/disposal/post', [KLKHDisposalController::class, 'post'])->name('klkh.disposal.post');
    Route::get('/klkh/disposal/delete/{id}', [KLKHDisposalController::class, 'delete'])->name('klkh.disposal.delete');
    Route::get('/klkh/disposal/preview/{uuid}', [KLKHDisposalController::class, 'preview'])->name('klkh.disposal.preview');

    //KLKH Lumpur
    Route::get('/klkh/lumpur', [KLKHLumpurController::class, 'index'])->name('klkh.lumpur');
    Route::get('/klkh/lumpur/insert', [KLKHLumpurController::class, 'insert'])->name('klkh.lumpur.insert');
    Route::post('/klkh/lumpur/post', [KLKHLumpurController::class, 'post'])->name('klkh.lumpur.post');
    Route::get('/klkh/lumpur/delete/{id}', [KLKHLumpurController::class, 'delete'])->name('klkh.lumpur.delete');
    Route::get('/klkh/lumpur/preview/{uuid}', [KLKHLumpurController::class, 'preview'])->name('klkh.lumpur.preview');

    //KLKH OGS
    Route::get('/klkh/ogs', [KLKHOGSController::class, 'index'])->name('klkh.ogs');
    Route::get('/klkh/ogs/insert', [KLKHOGSController::class, 'insert'])->name('klkh.ogs.insert');
    Route::post('/klkh/ogs/post', [KLKHOGSController::class, 'post'])->name('klkh.ogs.post');
    Route::get('/klkh/ogs/delete/{id}', [KLKHOGSController::class, 'delete'])->name('klkh.ogs.delete');
    Route::get('/klkh/ogs/preview/{uuid}', [KLKHOGSController::class, 'preview'])->name('klkh.ogs.preview');

    //KLKH Batu Bara
    Route::get('/klkh/batubara', [KLKHBatuBaraController::class, 'index'])->name('klkh.batubara');
    Route::get('/klkh/batubara/insert', [KLKHBatuBaraController::class, 'insert'])->name('klkh.batubara.insert');
    Route::post('/klkh/batubara/post', [KLKHBatuBaraController::class, 'post'])->name('klkh.batubara.post');
    Route::get('/klkh/batubara/delete/{id}', [KLKHBatuBaraController::class, 'delete'])->name('klkh.batubara.delete');
    Route::get('/klkh/batubara/preview/{uuid}', [KLKHBatuBaraController::class, 'preview'])->name('klkh.batubara.preview');

    //KLKH Simpang Empat
    Route::get('/klkh/simpangempat', [KLKHSimpangEmpatController::class, 'index'])->name('klkh.simpangempat');
    Route::get('/klkh/simpangempat/insert', [KLKHSimpangEmpatController::class, 'insert'])->name('klkh.simpangempat.insert');
    Route::post('/klkh/simpangempat/post', [KLKHSimpangEmpatController::class, 'post'])->name('klkh.simpangempat.post');
    Route::get('/klkh/simpangempat/delete/{id}', [KLKHSimpangEmpatController::class, 'delete'])->name('klkh.simpangempat.delete');
    Route::get('/klkh/simpangempat/preview/{uuid}', [KLKHSimpangEmpatController::class, 'preview'])->name('klkh.simpangempat.preview');

    //Paylaod & Ritation
    Route::get('/payloadritation/all', [PayloadRitationController::class, 'index'])->name('payloadritation.index');
    Route::get('/payloadritation/exa', [PayloadRitationController::class, 'exa'])->name('payloadritation.exa');

    // Profile
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    // User
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index');
    Route::post('/user/insert', [UserController::class, 'insert'])->name('user.insert');
    Route::post('/user/change-role/{id}', [UserController::class, 'changeRole'])->name('user.change-role');
    Route::get('/user/reset-password/{id}', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::get('/user/status-enabled/{id}', [UserController::class, 'statusEnabled'])->name('user.status-enabled');
});


