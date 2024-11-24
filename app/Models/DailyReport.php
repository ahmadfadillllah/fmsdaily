<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyReport extends Model
{
    //
    protected $table = 'daily_report_t';

    protected $fillable = [
        'foreman_id',
        'tanggal_dasar',
        'shift_dasar',
        'area',
        'nik_supervisor',
        'nama_supervisor',
        'nik_superintendent',
        'nama_superintendent',
    ];

    protected $guarded = [];
}
