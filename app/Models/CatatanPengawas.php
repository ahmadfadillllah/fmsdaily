<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatatanPengawas extends Model
{
    //
    protected $table = 'catatan_pengawas_t';

    protected $fillable = [
        'daily_report_id',
        'jam_start',
        'jam_stop',
        'keterangan',
    ];

    protected $guarded = [];
}
