<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatSupport extends Model
{
    //
    protected $table = 'alat_support';

    protected $fillable = [
        'daily_report_id',
        'jenis_unit',
        'alat_unit',
        'nik_operator',
        'nama_operator',
        'tanggal_operator',
        'shift_operator',
        'hm_awal',
        'hm_akhir',
        'hm_total',
        'hm_cash',
        'material',
    ];

    protected $guarded = [];
}
