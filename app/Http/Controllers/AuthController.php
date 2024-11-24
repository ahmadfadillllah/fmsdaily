<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        if (Auth::attempt($credentials, $request->has('remember'))) {
            return redirect()->route('production.index')->with('alert','Selamat Datang');
        }

        return back()->withErrors([
            'nik' => 'NIK atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar');
    }
}
