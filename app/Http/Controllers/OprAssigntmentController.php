<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OprAssigntmentController extends Controller
{
    //
    public function b1()
    {
        // $data = DB::select('SET NOCOUNT ON;EXEC FOCUS_REPORTING.dbo.RPT_REALTIME_SETTING_FLEET');
        // $data = collect($data)->where('PIT', 'SM-B1')->groupBy('ASG_LOADERID');

        // dd($data)

        return view('opr-assignment.b1.index');
    }
}
