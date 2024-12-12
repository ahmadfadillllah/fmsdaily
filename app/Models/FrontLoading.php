<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Traits\HasDraft;

class FrontLoading extends Model
{
    use HasDraft;
    //
    protected $table = 'front_loading_t';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'daily_report_uuid',
        'daily_report_id',
        'nomor_unit',
        'checked',
        'keterangan',
        'siang',
        'malam',
        'is_draft',
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
