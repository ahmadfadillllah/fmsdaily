<?php

namespace App\Models;

use App\Traits\HasDraft;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class AlatSupport extends Model
{

    use HasDraft;
    protected $table = 'alat_support_t';

    protected $fillable = [
        'statusenabled',
        'daily_report_id',
        'uuid',
        'daily_report_uuid',
        'jenis_unit',
        'alat_unit',
        'nik_operator',
        'nama_operator',
        'tanggal_operator',
        'shift_operator_id',
        'hm_awal',
        'hm_akhir',
        'hm_total',
        'hm_cash',
        'keterangan',
        'is_draft',
    ];

    protected $guarded = [];

    public function dailyReport()
    {
        return $this->belongsTo(DailyReport::class, 'daily_report_uuid');
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::uuid4()->toString();
    //     });
    // }
}
