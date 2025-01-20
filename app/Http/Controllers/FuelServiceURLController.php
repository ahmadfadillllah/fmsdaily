<?php

namespace App\Http\Controllers;

use App\Models\FuelServiceURL;
use Illuminate\Http\Request;

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
}
