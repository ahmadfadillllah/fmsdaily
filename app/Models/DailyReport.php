<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Traits\HasDraft;

class DailyReport extends Model
{
    use HasDraft;
    //
    protected $table = 'daily_report_t';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'foreman_id',
        'tanggal_dasar',
        'shift_dasar_id',
        'area_id',
        'lokasi_id',
        'nik_foreman',
        'nama_foreman',
        'verified_foreman',
        'nik_supervisor',
        'nama_supervisor',
        'verified_supervisor',
        'nik_superintendent',
        'nama_superintendent',
        'verified_superintendent',
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
