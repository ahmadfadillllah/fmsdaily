<?php

namespace App\Http\Controllers;

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
        try {
            User::where('id', $id)->update([
                'password' => Hash::make('12345'),
                'updated_by' => Auth::user()->id,
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
        $user = User::where('nik', $request->nik)->first();

        if ($user) {
            return redirect()->back()->with('info', 'Maaf, NIK/User sudah ada');
        }

        try {
            User::create([
                'name' => $request->name,
                'nik' => $request->nik,
                'role' => $request->role,
                'statusenabled' => 'true',
                'created_by' => Auth::user()->id,
                'password' => Hash::make('12345'),
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

            if($user->statusenabled == 'true'){
                $statusenabled = 'false';

                User::where('id', $id)->update([
                    'statusenabled' => $statusenabled,
                    'remember_token' => null,
                    'deleted_by' => Auth::user()->id,
                ]);

            }else{
                $statusenabled = 'true';
                User::where('id', $id)->update([
                    'statusenabled' => $statusenabled,
                    'updated_by' => Auth::user()->id,
                ]);
            }

            return redirect()->back()->with('success', 'Ubah status berhasil');

        } catch (\Throwable $th) {
            return redirect()->back()->with('info', nl2br('Ubah status gagal...\n' . $th->getMessage()));
        }
    }
}
