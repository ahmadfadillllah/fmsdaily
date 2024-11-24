<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //
    public function changePassword(Request $request)
    {
        try {
            $request->validate([
                'password_lama' => ['required', 'min:4'],
                'password_baru' => ['required', 'min:4'],
            ],
            [
                'password_lama.min' => 'Password lama minimal 4 karakter',
                'password_baru.min' => 'Password baru minimal 4 karakter',
            ]);

            if(!Hash::check($request->password_lama, Auth::user()->password)){
                return back()->with("info", "Password lama salah");
            }

            User::whereId(Auth::user()->id)->update([
                'password' => Hash::make($request->password_baru)
            ]);

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('success', 'Password telah diubah, silakan login kembali');
        } catch (\Throwable $th) {
            return redirect()->back()->with('info', 'Maaf, terjadi kesalahan');
        }
    }
}
