<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alat_support_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->string('daily_report_uuid')->index();
            $table->foreignId('daily_report_id')->constrained('daily_report_t');
            $table->boolean('statusenabled')->default(1);
            $table->string('jenis_unit')->nullable();
            $table->string('alat_unit')->nullable();
            $table->string('nik_operator')->nullable();
            $table->string('nama_operator')->nullable();
            $table->date('tanggal_operator')->nullable();
            $table->foreignId('shift_operator_id')->nullable()->constrained('shift_m');
            $table->decimal('hm_awal')->nullable();
            $table->decimal('hm_akhir')->nullable();
            $table->decimal('hm_total')->nullable();
            $table->string('hm_cash')->nullable();
            $table->string('keterangan')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_support_t');
    }
};
