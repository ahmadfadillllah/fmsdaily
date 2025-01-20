<?php

namespace App\Http\Controllers;

use App\Models\FuelServiceURL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuelServiceURLController extends Controller
{
    //
    public function serviceURL(Request $request, $token)
    {
        $data = FuelServiceURL::where('IS_ACTIVE', true)->where('TOKEN', $token)->first();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function operator()
    {
        $data = DB::table('focus.dbo.FUE_OPERATOR')
        ->select(
            'OPR_NRP',
            'OPR_NAME',
            )
        ->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function location()
    {
        $data = DB::table('focus.dbo.FUE_OBJECT')
        ->select(
            'OBJECTID',
            'OBJECTNAME',
            )
        ->where('OBJECTTYPEID', 97)->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function shift()
    {
        $data = DB::table('focus.dbo.FLT_SHIFT')
        ->select(
            'SHIFTNO as ID',
            'SHIFTDESC',
            )
        ->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function type()
    {
        $data = DB::table('focus.dbo.FUE_TRANSTYPE')
        ->select(
            'TRANSTYPE',
            'TRANSTYPEDESC',
            )
        ->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function unit()
    {
        $data = DB::table('focus.dbo.FUE_OBJECT')
        ->select(
            'OBJECTID',
            'OBJECTNAME',
            )
        ->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'Ahmad Fadillah, IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }
}
