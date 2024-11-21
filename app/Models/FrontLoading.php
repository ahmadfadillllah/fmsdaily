<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontLoading extends Model
{
    //
    protected $table = 'front_loading';

    protected $fillable = [
        'daily_report_id',
        'nomor_unit',
        'siang',
        'malam',
    ];

    protected $guarded = [];
}
