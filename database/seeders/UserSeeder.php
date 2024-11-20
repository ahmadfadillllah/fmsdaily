<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('users')->insert([
            'name' => 'Ahmad Fadillah',
            'nik' => '0738ABM',
            'role' => 'Admin',
            'password' => Hash::make('1234qwer'),
        ]);

        DB::table('users')->insert([
            'name' => 'Abdul Wahab',
            'nik' => '01234S1',
            'role' => 'Foreman',
            'password' => Hash::make('12345'),
        ]);
    }
}
