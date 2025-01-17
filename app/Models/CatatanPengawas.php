<?php

namespace App\Models;

use App\Traits\HasDraft;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class CatatanPengawas extends Model
{
    use HasDraft;
    protected $table = 'catatan_pengawas_t';

    protected $fillable = [
        'statusenabled',
        'uuid',
        'daily_report_id',
        'daily_report_uuid',
        'jam_start',
        'jam_stop',
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
