<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public function index()
    {
        $user = User::all();
        $jenis = collect([
            (object)['jenis' => 'KLKH'],
            (object)['jenis' => 'Laporan Harian'],
        ]);

        $data = [
            'user' => $user,
            'jenis' => $jenis,
        ];

        return view('log.index', compact('data'));
    }

    public function search(Request $request)
    {
        return redirect()->back()->with('info', 'Maaf, fitur masih dalam tahap pengembangan');
    }
}
