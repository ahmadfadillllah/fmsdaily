<?php

namespace App\Http\Controllers;

use App\Models\FueJournal;
use App\Models\FuelServiceURL;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FuelServiceURLController extends Controller
{
    //
    public function serviceURL(Request $request, $token)
    {
        $data = FuelServiceURL::where('IS_ACTIVE', true)->where('TOKEN', $token)->first();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
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
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
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
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
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
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
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
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
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
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function transfrom()
    {
        $data = DB::table('focus.dbo.FUE_OBJECTTYPE as objecttype')
        ->leftJoin('focus.dbo.FUE_OBJECT as object', 'objecttype.OBJECTTYPEID', 'object.OBJECTTYPEID')
        ->select(
            'objecttype.TRANSGROUPFROM',
            'object.OBJECTNAME',
            )
        ->where('objecttype.TRANSGROUPFROM', '!=', null)
        ->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function transto()
    {
        $data = DB::table('focus.dbo.FUE_OBJECTTYPE as objecttype')
        ->leftJoin('focus.dbo.FUE_OBJECT as object', 'objecttype.OBJECTTYPEID', 'object.OBJECTTYPEID')
        ->select(
            'objecttype.TRANSGROUPTO',
            'object.OBJECTNAME',
            )
        ->where('objecttype.TRANSGROUPTO', '!=', null)
        ->get();

        if (!$data) {
            return response()->json([
                'message' => 'Data not found.',
                'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
            ], 404);
        }

        return response()->json([
            'data' => $data,
            'by' => 'IT_FMS @ PT. SIMS JAYA KALTIM',
        ]);
    }

    public function sendPostFuel(Request $request)
    {

        $checkHeader = FuelServiceURL::where('TOKEN', $request->header('Access-Token'))
        ->where('TYPE', $request->header('Network-Type'))
        ->where('IS_ACTIVE', true)
        ->first();

        if (!$request->isJson()) {
            return response()->json([
                'error' => 'Format data harus JSON.',
                'code' => 400
            ], 400);
        }

        if (!$request->header('Access-Token')) {
            return response()->json([
                'error' => 'Token tidak ditemukan',
                'code' => 401
            ], 401);
        }

        if (!$request->header('Network-Type')) {
            return response()->json([
                'error' => 'Network Type tidak ditemukan',
                'code' => 401
            ], 401);
        }

        if (!$checkHeader) {
            return response()->json([
                'error' => 'service URL tidak ditemukan.',
                'code' => 401
            ], 401);
        }


        $validated = $request->validate([
            '*' => 'required|array',
            '*.TRANSTYPE' => 'required|integer',
            '*.TRANSGROUPFROM' => 'required|integer',
            '*.TRANSGROUPTO' => 'required|integer',
            '*.VOLUME' => 'required|numeric',
            '*.TRANSDESC' => 'nullable|string|max:100',
            '*.TRANSREF' => 'nullable|string|max:40',
            '*.MEMO' => 'nullable|string',
            '*.TRANSFROM' => 'nullable|string|max:20',
            '*.TRANSTO' => 'nullable|string|max:20',
            '*.HOURMETER' => 'nullable|numeric',
            '*.FLOWMETEREND' => 'nullable|numeric',
            '*.TRANSTIMESTART' => 'nullable|date_format:Y-m-d H:i:s',
            '*.TRANSTIMEEND' => 'nullable|date_format:Y-m-d H:i:s',
            '*.TRANSSHIFT' => 'nullable|integer',
            '*.TRANSTIMESTAMP' => 'nullable|date_format:Y-m-d H:i:s',
            '*.TRANSID' => 'nullable|string|max:26',
            '*.TRANSUSERNAME' => 'nullable|string|max:16',
        ]);
        try {
            $journals = [];
            $maxJournalID = FueJournal::max('JOURNALID') + 1;

            foreach ($validated as $journalData) {

                $journalData['JOURNALID'] = $maxJournalID++;
                $journalData['TRANSDATE'] = now()->toDateString();

                $journals[] = FueJournal::create($journalData);
            }

            return response()->json([
                'message' => 'Data berhasil disimpan!',
                'data' => $journals,
                'code' => 201
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Terjadi kesalahan saat menyimpan data.',
                'message' => $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}
