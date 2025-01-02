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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dp.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dp.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dp.superintendent', '=', 'spt.NRP')
        ->select(
            'dp.id',
            'dp.uuid',
            'dp.pic as pic_id',
            'us.name as pic',
            DB::raw('CONVERT(varchar, dp.created_at, 120) as tanggal_pembuatan'),
            'dp.statusenabled',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'dp.foreman as nik_foreman',
            'gl.PERSONALNAME as nama_foreman',
            'dp.supervisor as nik_supervisor',
            'spv.PERSONALNAME as nama_supervisor',
            'dp.superintendent as nik_superintendent',
            'spt.PERSONALNAME as nama_superintendent',
            'dp.verified_foreman',
            'dp.verified_supervisor',
            'dp.verified_superintendent',
            'dp.date',
            'dp.time',
        )
        ->where('dp.statusenabled', true)
        ->whereBetween(DB::raw('CONVERT(varchar, dp.created_at, 23)'), [$startTimeFormatted, $endTimeFormatted]);

        if (Auth::user()->role == 'FOREMAN') {
            $baseQuery->where('foreman', Auth::user()->nik);
        }
        if (Auth::user()->role == 'SUPERVISOR') {
            $baseQuery->where('supervisor', Auth::user()->nik);
        }
        if (Auth::user()->role == 'SUPERINTENDENT') {
            $baseQuery->where('superintendent', Auth::user()->nik);
        }
        if (Auth::user()->role == 'ADMIN') {
            $baseQuery->orWhere('pic', Auth::user()->id);
        }

        $disposal = $baseQuery->get();

        return view('klkh.disposal.index', compact('disposal'));
    }

    public function insert()
    {
        $supervisor = Personal::where('ROLETYPE', 3)->get();
        $superintendent = Personal::whereIn('ROLETYPE', [3, 4])
        ->select('*', DB::raw("CASE WHEN ROLETYPE = 3 THEN 'SUPERVISOR' WHEN ROLETYPE = 4 THEN 'SUPERINTENDENT' ELSE 'UNKNOWN' END as JABATAN "))
        ->orderBy(DB::raw("CASE WHEN ROLETYPE = 3 THEN 1 WHEN ROLETYPE = 4 THEN 2 ELSE 3 END "))->get();
        $pit = Area::where('statusenabled', true)->get();
        $shift = Shift::where('statusenabled', true)->get();

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

            $dataToInsert = [
                    'pic' => Auth::user()->id,
                    'uuid' => (string) Uuid::uuid4()->toString(),
                    'statusenabled' => true,
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
                    'superintendent' => $data['superintendent'] ?? null,
            ];

            if (Auth::user()->role == 'SUPERVISOR') {
                $dataToInsert['supervisor'] = Auth::user()->nik;
                $dataToInsert['verified_supervisor'] = Auth::user()->nik;
            }

            if (Auth::user()->role == 'FOREMAN') {
                $dataToInsert['supervisor'] = $data['supervisor'] ?? null;
                $dataToInsert['foreman'] = Auth::user()->nik;
                $dataToInsert['verified_foreman'] = Auth::user()->nik;
            }

            KLKHDisposal::create($dataToInsert);

            return redirect()->route('klkh.disposal')->with('success', 'KLKH Disposal/Dumping Point berhasil dibuat');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.disposal')->with('info', nl2br('KLKH Disposal/Dumping Point gagal dibuat..\n' . $th->getMessage()));
        }
    }

    public function preview($uuid)
    {
        $dp = DB::table('klkh_disposal_t as dp')
        ->leftJoin('users as us', 'dp.pic', '=', 'us.id')
        ->leftJoin('area_m as ar', 'dp.pit_id', '=', 'ar.id')
        ->leftJoin('shift_m as sh', 'dp.shift_id', '=', 'sh.id')
        ->leftJoin('focus.dbo.PRS_PERSONAL as gl', 'dp.foreman', '=', 'gl.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spv', 'dp.supervisor', '=', 'spv.NRP')
        ->leftJoin('focus.dbo.PRS_PERSONAL as spt', 'dp.superintendent', '=', 'spt.NRP')
        ->select(
            'dp.*',
            'ar.keterangan as pit',
            'sh.keterangan as shift',
            'us.name as nama_pic',
            'gl.PERSONALNAME as nama_foreman',
            'spv.PERSONALNAME as nama_supervisor',
            'spt.PERSONALNAME as nama_superintendent'
            )
        ->where('dp.statusenabled', true)
        ->where('dp.uuid', $uuid)->first();

        if($dp == null){
            return redirect()->back()->with('info', 'Maaf, data tidak ditemukan');
        }else {
            $dp->verified_foreman = $dp->verified_foreman != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $dp->nama_foreman) : null;
            $dp->verified_supervisor = $dp->verified_supervisor != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $dp->nama_supervisor) : null;
            $dp->verified_superintendent = $dp->verified_superintendent != null ? QrCode::size(70)->generate('Telah diverifikasi oleh: ' . $dp->nama_superintendent) : null;
        }

        return view('klkh.disposal.preview', compact('dp'));
    }

    public function delete($id)
    {
        try {
            KLKHDisposal::where('id', $id)->update([
                'statusenabled' => false,
                'deleted_by' => Auth::user()->id,
            ]);

            return redirect()->route('klkh.disposal')->with('success', 'KLKH Disposal berhasil dihapus');

        } catch (\Throwable $th) {
            return redirect()->route('klkh.disposal')->with('info', nl2br('KLKH Disposal gagal dihapus..\n' . $th->getMessage()));
        }
    }

    public function verifiedAll($uuid)
    {
        $klkh =  KLKHDisposal::where('uuid', $uuid)->first();

        try {
            KLKHDisposal::where('id', $klkh->id)->update([
                'verified_foreman' => $klkh->foreman,
                'verified_supervisor' => $klkh->supervisor,
                'verified_superintendent' => $klkh->superintendent,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Disposal berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Disposal gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedForeman($uuid)
    {
        $klkh =  KLKHDisposal::where('uuid', $uuid)->first();

        try {
            KLKHDisposal::where('id', $klkh->id)->update([
                'verified_foreman' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Disposal berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Disposal gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedSupervisor($uuid)
    {
        $klkh =  KLKHDisposal::where('uuid', $uuid)->first();

        try {
            KLKHDisposal::where('id', $klkh->id)->update([
                'verified_supervisor' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Disposal berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Disposal gagal diverifikasi..\n' . $th->getMessage()));
        }
    }

    public function verifiedSuperintendent($uuid)
    {
        $klkh =  KLKHDisposal::where('uuid', $uuid)->first();

        try {
            KLKHDisposal::where('id', $klkh->id)->update([
                'verified_superintendent' => (string)Auth::user()->nik,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'KLKH Disposal berhasil diverifikasi');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('KLKH Disposal gagal diverifikasi..\n' . $th->getMessage()));
        }
    }
}
