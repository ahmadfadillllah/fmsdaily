<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class FrontLoading extends Model
{
    //
    protected $table = 'front_loading_t';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'daily_report_uuid',
        'daily_report_id',
        'nomor_unit',
        'siang',
        'malam',
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
