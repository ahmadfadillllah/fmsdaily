<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontLoading extends Model
{
    //
    protected $table = 'front_loading_t';

    protected $fillable = [
        'statusenabled',
        'daily_report_id',
        'nomor_unit',
        'siang',
        'malam',
    ];

    protected $guarded = [];
}
