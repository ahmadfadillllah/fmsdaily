<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        $user = User::where('role', '!=', 'ADMIN')->get();
        return view('user.index', compact('user'));
    }

    public function resetPassword($id)
    {
        $user = User::where('id', $id)->first();
        try {
            User::where('id', $id)->update([
                'password' => Hash::make('12345'),
                'updated_by' => Auth::user()->id,
            ]);

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'User',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Reset password user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', Role: '. $user->role . ', direset oleh: '. Auth::user()->name,
            ]);

            return redirect()->back()->with('success', 'Reset password berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Reset password gagal...\n' . $th->getMessage()));
        }
    }

    public function changeRole(Request $request, $id)
    {
        // dd($request->all());
        try {
            User::where('id', $id)->update([
                'role' => $request->role,
                'updated_by' => Auth::user()->id,
            ]);

            return redirect()->back()->with('success', 'Ganti role berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Ganti role gagal...\n' . $th->getMessage()));
        }
    }

    public function insert(Request $request)
    {
        $user = User::where('nik', strtoupper($request->nik))->first();

        if ($user) {
            return redirect()->back()->with('info', 'Maaf, NIK/User sudah ada');
        }

        try {
            User::create([
                'name' => $request->name,
                'nik' => strtoupper($request->nik),
                'role' => $request->role,
                'statusenabled' => true,
                'created_by' => Auth::user()->id,
                'password' => Hash::make('12345'),
            ]);

            Log::create([
                'tanggal_loging' => now(),
                'jenis_loging' => 'User',
                'nama_user' => Auth::user()->id,
                'nik' => Auth::user()->nik,
                'keterangan' => 'Pendaftaran user dengan nama: '. $request->name . ', NIK: '. $request->nik . ', Role: '. $request->role . ', didaftarkan oleh: '. Auth::user()->name,
            ]);

            return redirect()->back()->with('success', 'User berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('User gagal ditambahn..\n' . $th->getMessage()));
        }
    }

    public function statusEnabled($id)
    {
        $user = User::where('id', $id)->first();

        try {

            if($user->statusenabled == true){

                User::where('id', $id)->update([
                    'statusenabled' => false,
                    'remember_token' => null,
                    'deleted_by' => Auth::user()->id,
                ]);

                Log::create([
                    'tanggal_loging' => now(),
                    'jenis_loging' => 'User',
                    'nama_user' => Auth::user()->id,
                    'nik' => Auth::user()->nik,
                    'keterangan' => 'Disabled user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', dieksekusi oleh: '. Auth::user()->name,
                ]);

            }else{
                User::where('id', $id)->update([
                    'statusenabled' => true,
                    'updated_by' => Auth::user()->id,
                ]);

                Log::create([
                    'tanggal_loging' => now(),
                    'jenis_loging' => 'User',
                    'nama_user' => Auth::user()->id,
                    'nik' => Auth::user()->nik,
                    'keterangan' => 'Enabled user dengan nama: '. $user->name . ', NIK: '. $user->nik . ', dieksekusi oleh: '. Auth::user()->name,
                ]);
            }

            return redirect()->back()->with('success', 'Ubah status berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Ubah status gagal...\n' . $th->getMessage()));
        }
    }
}
