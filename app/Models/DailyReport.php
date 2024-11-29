<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class DailyReport extends Model
{
    //
    protected $table = 'daily_report_t';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'foreman_id',
        'tanggal_dasar',
        'shift_dasar',
        'area',
        'lokasi',
        'nik_supervisor',
        'nama_supervisor',
        'nik_superintendent',
        'nama_superintendent',
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
