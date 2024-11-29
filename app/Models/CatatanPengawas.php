<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class CatatanPengawas extends Model
{
    //
    protected $table = 'catatan_pengawas_t';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'daily_report_id',
        'daily_report_uuid',
        'jam_start',
        'jam_stop',
        'keterangan',
    ];

    protected $guarded = [];

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::uuid4()->toString();
    //     });
    // }
}
