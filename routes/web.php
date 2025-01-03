<?php

use App\Http\Controllers\AlatSupportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanPengawasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormPengawasController;
use App\Http\Controllers\FormPengawasOldController;
use App\Http\Controllers\FrontLoadingController;
use App\Http\Controllers\KLKHBatuBaraController;
use App\Http\Controllers\KLKHDisposalController;
use App\Http\Controllers\KLKHHaulRoadController;
use App\Http\Controllers\KLKHLoadingPointController;
use App\Http\Controllers\KLKHLumpurController;
use App\Http\Controllers\KLKHOGSController;
use App\Http\Controllers\KLKHSimpangEmpatController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\OprAssigntmentController;
use App\Http\Controllers\PayloadRitationController;
use App\Http\Controllers\ProductionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifikasiKLKHBatubaraController;
use App\Http\Controllers\VerifikasiKLKHController;
use App\Http\Controllers\VerifikasiKLKHDisposalController;
use App\Http\Controllers\VerifikasiKLKHHaulRoadController;
use App\Http\Controllers\VerifikasiKLKHLoadingPointController;
use App\Http\Controllers\VerifikasiKLKHLumpurController;
use App\Http\Controllers\VerifikasiKLKHOGSController;
use App\Http\Controllers\VerifikasiKLKHSimpangEmpatController;
use App\Http\Controllers\VerifikasiLaporanKerja;
use App\Http\Controllers\VerifikasiLaporanKerjaController;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\isAdmin;
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
Route::get('/OprAssignment/A3/api', [OprAssigntmentController::class, 'a3_api'])->name('opr.a3.api');


Route::group(['middleware' => ['auth']], function(){
    //dashboard
    Route::get('/dashboards/index', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/form-pengawas/search-users', [FormPengawasController::class, 'users'])->name('cariUsers');
    Route::get('/operator/{nik}', [FormPengawasController::class, 'getOperatorByNIK']);

    Route::get('/production/index', [ProductionController::class, 'index'])->name('production.index');

    //Form Pengawas Lama
    Route::get('/form-pengawas-old/show', [FormPengawasOldController::class, 'show'])->name('form-pengawas-old.show');
    Route::get('/form-pengawas-old/index', [FormPengawasOldController::class, 'index'])->name('form-pengawas-old.index')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::get('/form-pengawas-old/download/{uuid}', [FormPengawasOldController::class, 'download'])->name('form-pengawas-old.download');
    Route::get('/form-pengawas-old/preview/{uuid}', [FormPengawasOldController::class, 'preview'])->name('form-pengawas-old.preview');
    Route::post('/form-pengawas-old/post', [FormPengawasOldController::class, 'post'])->name('form-pengawas-old.post');
    // Route::post('/form-pengawas-old/auto-save', [FormPengawasOldController::class, 'autoSave'])->name('form-pengawas-old.auto-save');

    //Verifikasi Form Pengawas
    Route::get('/form-pengawas/verified/all/{uuid}', [FormPengawasController::class, 'verifiedAll'])->name('form-pengawas.verified.all');
    Route::get('/form-pengawas/verified/foreman/{uuid}', [FormPengawasController::class, 'verifiedForeman'])->name('form-pengawas.verified.foreman');
    Route::get('/form-pengawas/verified/supervisor/{uuid}', [FormPengawasController::class, 'verifiedSupervisor'])->name('form-pengawas.verified.supervisor');
    Route::get('/form-pengawas/verified/superintendent/{uuid}', [FormPengawasController::class, 'verifiedSuperintendent'])->name('form-pengawas.verified.superintendent');

    //Form Pengawas
    Route::get('/form-pengawas/show', [FormPengawasController::class, 'show'])->name('form-pengawas.show');
    Route::get('/form-pengawas/index', [FormPengawasController::class, 'index'])->name('form-pengawas.index');

    Route::get('/form-pengawas/index', function () {
        return redirect()->route('form-pengawas-old.index');
    });

    Route::get('/form-pengawas/download/{uuid}', [FormPengawasController::class, 'download'])->name('form-pengawas.download');
    Route::get('/form-pengawas/preview/{uuid}', [FormPengawasController::class, 'preview'])->name('form-pengawas.preview');
    Route::post('/form-pengawas/post', [FormPengawasController::class, 'post'])->name('form-pengawas.post');
    Route::post('/form-pengawas/auto-save', [FormPengawasController::class, 'autoSave'])->name('form-pengawas.auto-save');

    //Front Loading
    Route::get('/front-loading/index', [FrontLoadingController::class, 'index'])->name('front-loading.index');
    Route::get('/front-loading/export/excel', [FrontLoadingController::class, 'excel'])->name('front-loading.excel');


    //Alat Support
    Route::get('/alat-support/index', [AlatSupportController::class, 'index'])->name('alat-support.index');
    Route::delete('/alat-support/{id}', [AlatSupportController::class, 'destroy']);

    //Catatan Pengawas
    Route::get('/catatan-pengawas/index', [CatatanPengawasController::class, 'index'])->name('catatan-pengawas.index');
    Route::delete('/catatan-pengawas/{id}/delete', [CatatanPengawasController::class, 'destroy'])->name('catatan-pengawas.destroy');

    //KLKH Loading Point
    Route::get('/klkh/loading-point', [KLKHLoadingPointController::class, 'index'])->name('klkh.loading-point');
    Route::get('/klkh/loading-point/insert', [KLKHLoadingPointController::class, 'insert'])->name('klkh.loading-point.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/loading-point/post', [KLKHLoadingPointController::class, 'post'])->name('klkh.loading-point.post');
    Route::get('/klkh/loading-point/delete/{id}', [KLKHLoadingPointController::class, 'delete'])->name('klkh.loading-point.delete');
    Route::get('/klkh/loading-point/preview/{uuid}', [KLKHLoadingPointController::class, 'preview'])->name('klkh.loading-point.preview');
    Route::get('/klkh/loading-point/verified/all/{uuid}', [KLKHLoadingPointController::class, 'verifiedAll'])->name('klkh.loading-point.verified.all');
    Route::get('/klkh/loading-point/verified/foreman/{uuid}', [KLKHLoadingPointController::class, 'verifiedForeman'])->name('klkh.loading-point.verified.foreman');
    Route::get('/klkh/loading-point/verified/supervisor/{uuid}', [KLKHLoadingPointController::class, 'verifiedSupervisor'])->name('klkh.loading-point.verified.supervisor');
    Route::get('/klkh/loading-point/verified/superintendent/{uuid}', [KLKHLoadingPointController::class, 'verifiedSuperintendent'])->name('klkh.loading-point.verified.superintendent');

    //KLKH Haul Road
    Route::get('/klkh/haul-road', [KLKHHaulRoadController::class, 'index'])->name('klkh.haul-road');
    Route::get('/klkh/haul-road/insert', [KLKHHaulRoadController::class, 'insert'])->name('klkh.haul-road.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/haul-road/post', [KLKHHaulRoadController::class, 'post'])->name('klkh.haul-road.post');
    Route::get('/klkh/haul-road/delete/{id}', [KLKHHaulRoadController::class, 'delete'])->name('klkh.haul-road.delete');
    Route::get('/klkh/haul-road/preview/{uuid}', [KLKHHaulRoadController::class, 'preview'])->name('klkh.haul-road.preview');
    Route::get('/klkh/haul-road/verified/all/{uuid}', [KLKHHaulRoadController::class, 'verifiedAll'])->name('klkh.haul-road.verified.all');
    Route::get('/klkh/haul-road/verified/foreman/{uuid}', [KLKHHaulRoadController::class, 'verifiedForeman'])->name('klkh.haul-road.verified.foreman');
    Route::get('/klkh/haul-road/verified/supervisor/{uuid}', [KLKHHaulRoadController::class, 'verifiedSupervisor'])->name('klkh.haul-road.verified.supervisor');
    Route::get('/klkh/haul-road/verified/superintendent/{uuid}', [KLKHHaulRoadController::class, 'verifiedSuperintendent'])->name('klkh.haul-road.verified.superintendent');

    //KLKH Disposal
    Route::get('/klkh/disposal', [KLKHDisposalController::class, 'index'])->name('klkh.disposal');
    Route::get('/klkh/disposal/insert', [KLKHDisposalController::class, 'insert'])->name('klkh.disposal.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/disposal/post', [KLKHDisposalController::class, 'post'])->name('klkh.disposal.post');
    Route::get('/klkh/disposal/delete/{id}', [KLKHDisposalController::class, 'delete'])->name('klkh.disposal.delete');
    Route::get('/klkh/disposal/preview/{uuid}', [KLKHDisposalController::class, 'preview'])->name('klkh.disposal.preview');
    Route::get('/klkh/disposal/verified/all/{uuid}', [KLKHDisposalController::class, 'verifiedAll'])->name('klkh.disposal.verified.all');
    Route::get('/klkh/disposal/verified/foreman/{uuid}', [KLKHDisposalController::class, 'verifiedForeman'])->name('klkh.disposal.verified.foreman');
    Route::get('/klkh/disposal/verified/supervisor/{uuid}', [KLKHDisposalController::class, 'verifiedSupervisor'])->name('klkh.disposal.verified.supervisor');
    Route::get('/klkh/disposal/verified/superintendent/{uuid}', [KLKHDisposalController::class, 'verifiedSuperintendent'])->name('klkh.disposal.verified.superintendent');

    //KLKH Lumpur
    Route::get('/klkh/lumpur', [KLKHLumpurController::class, 'index'])->name('klkh.lumpur');
    Route::get('/klkh/lumpur/insert', [KLKHLumpurController::class, 'insert'])->name('klkh.lumpur.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/lumpur/post', [KLKHLumpurController::class, 'post'])->name('klkh.lumpur.post');
    Route::get('/klkh/lumpur/delete/{id}', [KLKHLumpurController::class, 'delete'])->name('klkh.lumpur.delete');
    Route::get('/klkh/lumpur/preview/{uuid}', [KLKHLumpurController::class, 'preview'])->name('klkh.lumpur.preview');
    Route::get('/klkh/lumpur/verified/all/{uuid}', [KLKHLumpurController::class, 'verifiedAll'])->name('klkh.lumpur.verified.all');
    Route::get('/klkh/lumpur/verified/foreman/{uuid}', [KLKHLumpurController::class, 'verifiedForeman'])->name('klkh.lumpur.verified.foreman');
    Route::get('/klkh/lumpur/verified/supervisor/{uuid}', [KLKHLumpurController::class, 'verifiedSupervisor'])->name('klkh.lumpur.verified.supervisor');
    Route::get('/klkh/lumpur/verified/superintendent/{uuid}', [KLKHLumpurController::class, 'verifiedSuperintendent'])->name('klkh.lumpur.verified.superintendent');

    //KLKH OGS
    Route::get('/klkh/ogs', [KLKHOGSController::class, 'index'])->name('klkh.ogs');
    Route::get('/klkh/ogs/insert', [KLKHOGSController::class, 'insert'])->name('klkh.ogs.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/ogs/post', [KLKHOGSController::class, 'post'])->name('klkh.ogs.post');
    Route::get('/klkh/ogs/delete/{id}', [KLKHOGSController::class, 'delete'])->name('klkh.ogs.delete');
    Route::get('/klkh/ogs/preview/{uuid}', [KLKHOGSController::class, 'preview'])->name('klkh.ogs.preview');
    Route::get('/klkh/ogs/verified/all/{uuid}', [KLKHOGSController::class, 'verifiedAll'])->name('klkh.ogs.verified.all');
    Route::get('/klkh/ogs/verified/foreman/{uuid}', [KLKHOGSController::class, 'verifiedForeman'])->name('klkh.ogs.verified.foreman');
    Route::get('/klkh/ogs/verified/supervisor/{uuid}', [KLKHOGSController::class, 'verifiedSupervisor'])->name('klkh.ogs.verified.supervisor');
    Route::get('/klkh/ogs/verified/superintendent/{uuid}', [KLKHOGSController::class, 'verifiedSuperintendent'])->name('klkh.ogs.verified.superintendent');

    //KLKH Batu Bara
    Route::get('/klkh/batubara', [KLKHBatuBaraController::class, 'index'])->name('klkh.batubara');
    Route::get('/klkh/batubara/insert', [KLKHBatuBaraController::class, 'insert'])->name('klkh.batubara.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/batubara/post', [KLKHBatuBaraController::class, 'post'])->name('klkh.batubara.post');
    Route::get('/klkh/batubara/delete/{id}', [KLKHBatuBaraController::class, 'delete'])->name('klkh.batubara.delete');
    Route::get('/klkh/batubara/preview/{uuid}', [KLKHBatuBaraController::class, 'preview'])->name('klkh.batubara.preview');
    Route::get('/klkh/batubara/verified/all/{uuid}', [KLKHBatuBaraController::class, 'verifiedAll'])->name('klkh.batubara.verified.all');
    Route::get('/klkh/batubara/verified/foreman/{uuid}', [KLKHBatuBaraController::class, 'verifiedForeman'])->name('klkh.batubara.verified.foreman');
    Route::get('/klkh/batubara/verified/supervisor/{uuid}', [KLKHBatuBaraController::class, 'verifiedSupervisor'])->name('klkh.batubara.verified.supervisor');
    Route::get('/klkh/batubara/verified/superintendent/{uuid}', [KLKHBatuBaraController::class, 'verifiedSuperintendent'])->name('klkh.batubara.verified.superintendent');

    //KLKH Simpang Empat
    Route::get('/klkh/simpangempat', [KLKHSimpangEmpatController::class, 'index'])->name('klkh.simpangempat');
    Route::get('/klkh/simpangempat/insert', [KLKHSimpangEmpatController::class, 'insert'])->name('klkh.simpangempat.insert')->middleware('checkRole'.':FOREMAN,SUPERVISOR');
    Route::post('/klkh/simpangempat/post', [KLKHSimpangEmpatController::class, 'post'])->name('klkh.simpangempat.post');
    Route::get('/klkh/simpangempat/delete/{id}', [KLKHSimpangEmpatController::class, 'delete'])->name('klkh.simpangempat.delete');
    Route::get('/klkh/simpangempat/preview/{uuid}', [KLKHSimpangEmpatController::class, 'preview'])->name('klkh.simpangempat.preview');
    Route::get('/klkh/simpangempat/verified/all/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedAll'])->name('klkh.simpangempat.verified.all');
    Route::get('/klkh/simpangempat/verified/foreman/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedForeman'])->name('klkh.simpangempat.verified.foreman');
    Route::get('/klkh/simpangempat/verified/supervisor/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedSupervisor'])->name('klkh.simpangempat.verified.supervisor');
    Route::get('/klkh/simpangempat/verified/superintendent/{uuid}', [KLKHSimpangEmpatController::class, 'verifiedSuperintendent'])->name('klkh.simpangempat.verified.superintendent');

    //Paylaod & Ritation
    Route::get('/payloadritation/all', [PayloadRitationController::class, 'index'])->name('payloadritation.index');
    Route::get('/payloadritation/exa', [PayloadRitationController::class, 'exa_new'])->name('payloadritation.exa');

    // Profile
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    //Verifikasi Laporan Kerja
    Route::get('/verifikasi/laporan-kerja', [VerifikasiLaporanKerjaController::class, 'index'])->name('verifikasi.laporankerja');

    //Verifikasi Semua KLKH
    Route::get('/verifikasi/klkh', [VerifikasiKLKHController::class, 'index'])->name('verifikasi.klkh');
    Route::get('/verifikasi/klkh/preview/{uuid}', [VerifikasiKLKHController::class, 'preview'])->name('verifikasi.klkh.preview');
    Route::get('/verifikasi/klkh/all', [VerifikasiKLKHController::class, 'all'])->name('verifikasi.klkh.all');

    //Verifikasi KLKH Loading Point
    Route::get('/verifikasi/klkh/loading-point', [VerifikasiKLKHLoadingPointController::class, 'index'])->name('verifikasi.klkh.loadingpoint');
    Route::get('/verifikasi/klkh/loading-point/all', [VerifikasiKLKHLoadingPointController::class, 'all'])->name('verifikasi.klkh.loadingpoint.all');

    //Verifikasi KLKH Haul Road
    Route::get('/verifikasi/klkh/haul-road', [VerifikasiKLKHHaulRoadController::class, 'index'])->name('verifikasi.klkh.haulroad');

    //Verifikasi KLKH Disposal/Dumping Point
    Route::get('/verifikasi/klkh/disposal', [VerifikasiKLKHDisposalController::class, 'index'])->name('verifikasi.klkh.disposal');

    //Verifikasi KLKH Dumping di Lumpur
    Route::get('/verifikasi/klkh/lumpur', [VerifikasiKLKHLumpurController::class, 'index'])->name('verifikasi.klkh.lumpur');

    //Verifikasi KLKH OGS
    Route::get('/verifikasi/klkh/ogs', [VerifikasiKLKHOGSController::class, 'index'])->name('verifikasi.klkh.ogs');

    //Verifikasi KLKH Batu Bara
    Route::get('/verifikasi/klkh/batu-bara', [VerifikasiKLKHBatubaraController::class, 'index'])->name('verifikasi.klkh.batubara');

    //Verifikasi KLKH Intersection/Simpang Empat
    Route::get('/verifikasi/klkh/simpang-empat', [VerifikasiKLKHSimpangEmpatController::class, 'index'])->name('verifikasi.klkh.simpangempat');

    // User
    Route::get('/user/index', [UserController::class, 'index'])->name('user.index')->middleware('checkRole'.':ADMIN');
    Route::post('/user/insert', [UserController::class, 'insert'])->name('user.insert');
    Route::post('/user/change-role/{id}', [UserController::class, 'changeRole'])->name('user.change-role');
    Route::get('/user/reset-password/{id}', [UserController::class, 'resetPassword'])->name('user.reset-password');
    Route::get('/user/status-enabled/{id}', [UserController::class, 'statusEnabled'])->name('user.status-enabled');

    // Log
    Route::get('/log/index', [LogController::class, 'index'])->name('log.index')->middleware('checkRole'.':ADMIN');
});


