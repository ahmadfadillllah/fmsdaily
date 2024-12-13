<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $daily = DB::table('daily_report_t as dr')
    ->leftJoin('users as us', 'dr.foreman_id', '=', 'us.id')
    ->select(
        'us.id as user_id',
        'us.name',
        'us.role',
        'us.nik',
        'us.avatar',
        DB::raw('COUNT(dr.id) as jumlah')
    )
    ->whereDate('dr.tanggal_dasar', Carbon::now()->toDateString())
    ->where('dr.statusenabled', true)
    ->groupBy('us.id', 'us.name', 'us.nik', 'us.role', 'us.avatar')
    ->orderByDesc('jumlah')
    ->get();


        return view('dashboard.index', compact('daily'));
    }
}
