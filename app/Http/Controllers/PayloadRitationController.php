<?php

namespace App\Http\Controllers;

use App\Models\PayloadRitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PayloadRitationController extends Controller
{
    //
    public function index()
    {
        $data = DB::select('SET NOCOUNT ON;EXEC FOCUS_REPORTING.dbo.RPT_REALTIME_PAYLOAD_RITATION');

        $data = collect($data)->map(function ($item) {
            return (object) array_map(function ($value) {
                // Cek jika nilai adalah angka, lalu bulatkan ke 1 angka di belakang koma
                return is_numeric($value) ? round($value, 1) : $value;
            }, (array) $item);
        });


        return view('payloadritation.index', compact('data'));
    }

    public function api()
    {
        $data = DB::select('SET NOCOUNT ON;EXEC FOCUS_REPORTING.dbo.RPT_REALTIME_PAYLOAD_RITATION');

        $data = collect($data);

        // Return as JSON response
        return response()->json($data);

        return view('payloadritation.index', compact('data'));
    }
}
