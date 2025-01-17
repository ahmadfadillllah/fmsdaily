<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use App\Traits\HasDraft;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function frontLoading(): HasMany
    {
        return $this->hasMany(FrontLoading::class, 'daily_report_uuid', 'uuid');
    }

    public function alatSupport(): HasMany
    {
        return $this->hasMany(AlatSupport::class, 'daily_report_uuid', 'uuid');
    }

    public function catatanPengawas(): HasMany
    {
        return $this->hasMany(CatatanPengawas::class, 'daily_report_uuid', 'uuid');
    }

    // public static function boot()
    // {
    //     parent::boot();
    //     self::creating(function ($model) {
    //         $model->uuid = (string) Uuid::uuid4()->toString();
    //     });
    // }
}
