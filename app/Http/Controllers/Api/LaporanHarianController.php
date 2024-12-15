<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\User;

class LaporanHarianController extends Controller
{
    //
    public function laporanPengawas()
    {
        $users = User::all();

        // Menambahkan status dan message kustom
        return UserResource::collection($users)->additional([
            'status' => true,
            'message' => 'List Data Users'
        ]);
    }
}
