<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\KLKHDisposal;
use App\Models\Personal;
use App\Models\Shift;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;

class KLKHDisposalController extends Controller
{
    //
    public function index(Request $request)
    {
        if (empty($request->rangeStart) || empty($request->rangeEnd)){
            $time = new DateTime();
            $startDate = $time->format('Y-m-d');
            $endDate = $time->format('Y-m-d');

            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");

        }else{
            $start = new DateTime("$request->rangeStart");
            $end = new DateTime("$request->rangeEnd");
        }


        $startTimeFormatted = $start->format('Y-m-d');
        $endTimeFormatted = $end->format('Y-m-d');


        $baseQuery = DB::table('klkh_disposal_t as dp')
        ->leftJoin('users as us', 'dp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'dp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'dp.shift_id', '=', 'sh.id')
        ->select(
            'dp.id',
            'dp.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, dp.created_at, 120) as tanggal_pembuatan'),
            'dp.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'dp.date',
            'dp.time',
        )
        ->where('dp.statusenabled', 'true')
        ->whereBetween(DB::raw('CONVERT(varchar, dp.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role !== 'ADMIN') {
            $baseQuery->where('pic', Auth::user()->id);
        }

        $disposal = $baseQuery->get();

        return view('klkh.disposal.index', compact('disposal'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();
        $superintendent = Personal::where('ROLETYPE', 4)->get();
        $pit = Area::where('statusenabled', 'true')->get();
        $shift = Shift::where('statusenabled', 'true')->get();

        $users = [
            'supervisor' => $supervisor,
            'superintendent' => $superintendent,
            'pit' => $pit,
            'shift' => $shift,
        ];
        return view('klkh.disposal.insert', compact('users'));
    }

    public function post(Request $request)
    {
        // dd($request->all());

        try {

            $data = $request->all();

            KLKHDisposal::create([
                'pic' => Auth::user()->id,
                'uuid' => (string) Uuid::uuid4()->toString(),
                'statusenabled' => 'true',
                'pit_id' => $data['pit'],
                'shift_id' => $data['shift'],
                'date' => $data['date'],
                'time' => $data['time'],
                'dumping_point_1' => $data['dumping_point_1'],
                'dumping_point_1_note' => $data['dumping_point_1_note'] ?? null,
                'dumping_point_2' => $data['dumping_point_2'],
                'dumping_point_2_note' => $data['dumping_point_2_note'] ?? null,
                'dumping_point_3' => $data['dumping_point_3'],
                'dumping_point_3_note' => $data['dumping_point_3_note'] ?? null,
                'dumping_point_4' => $data['dumping_point_4'],
                'dumping_point_4_note' => $data['dumping_point_4_note'] ?? null,
                'dumping_point_5' => $data['dumping_point_5'],
                'dumping_point_5_note' => $data['dumping_point_5_note'] ?? null,
                'dumping_point_6' => $data['dumping_point_6'],
                'dumping_point_6_note' => $data['dumping_point_6_note'] ?? null,
                'dumping_point_7' => $data['dumping_point_7'],
                'dumping_point_7_note' => $data['dumping_point_7_note'] ?? null,
                'dumping_point_8' => $data['dumping_point_8'],
                'dumping_point_8_note' => $data['dumping_point_8_note'] ?? null,
                'dumping_point_9' => $data['dumping_point_9'],
                'dumping_point_9_note' => $data['dumping_point_9_note'] ?? null,
                'dumping_point_10' => $data['dumping_point_10'],
                'dumping_point_10_note' => $data['dumping_point_10_note'] ?? null,
                'dumping_point_11' => $data['dumping_point_11'],
                'dumping_point_11_note' => $data['dumping_point_11_note'] ?? null,
                'dumping_point_12' => $data['dumping_point_12'],
                'dumping_point_12_note' => $data['dumping_point_12_note'] ?? null,
                'dumping_point_13' => $data['dumping_point_13'],
                'dumping_point_13_note' => $data['dumping_point_13_note'] ?? null,
                'dumping_point_14' => $data['dumping_point_14'],
                'dumping_point_14_note' => $data['dumping_point_14_note'] ?? null,
                'dumping_point_15' => $data['dumping_point_15'],
                'dumping_point_15_note' => $data['dumping_point_15_note'] ?? null,
                'dumping_point_16' => $data['dumping_point_16'],
                'dumping_point_16_note' => $data['dumping_point_16_note'] ?? null,
                'dumping_point_17' => $data['dumping_point_17'],
                'dumping_point_17_note' => $data['dumping_point_17_note'] ?? null,
                'dumping_point_18' => $data['dumping_point_18'],
                'dumping_point_18_note' => $data['dumping_point_18_note'] ?? null,
                'dumping_point_19' => $data['dumping_point_19'],
                'dumping_point_19_note' => $data['dumping_point_19_note'] ?? null,
                'dumping_point_20' => $data['dumping_point_20'],
                'dumping_point_20_note' => $data['dumping_point_20_note'] ?? null,
                'dumping_point_21' => $data['dumping_point_21'],
                'dumping_point_21_note' => $data['dumping_point_21_note'] ?? null,
                'dumping_point_22' => $data['dumping_point_22'],
                'dumping_point_22_note' => $data['dumping_point_22_note'] ?? null,
                'additional_notes' => $data['additional_notes'] ?? null,
                'supervisor' => $data['supervisor'] ?? null,
                'superintendent' => $data['superintendent'] ?? null,
            ]);

            return redirect()->route('klkh.disposal')->with('success', 'KLKH Disposal/Dumping Point berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.disposal')->with('info', nl2br('KLKH Disposal/Dumping Point gagal dibuat..\n' . $th->getMessage()));
        }
    }

    public function delete($id)
    {
        try {
            KLKHDisposal::where('id', $id)->update([
                'statusenabled' => 'false',
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.disposal')->with('success', 'KLKH Disposal berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.disposal')->with('info', nl2br('KLKH Disposal gagal dihapus..\n' . $th->getMessage()));
        }
    }
}
