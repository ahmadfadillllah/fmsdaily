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
        Schema::create('klkh_ogs_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('pic')->constrained('users');
            $table->boolean('statusenabled')->default(1);
            $table->foreignId('pit_id')->constrained('area_m');
            $table->foreignId('shift_id')->constrained('shift_m');
            $table->date('date');
            $table->time('time');
            $table->string('rata_padat_check')->nullable();
            $table->text('rata_padat_note')->nullable();
            $table->string('parkir_terpisah_check')->nullable();
            $table->text('parkir_terpisah_note')->nullable();
            $table->string('ceceran_oli_check')->nullable();
            $table->text('ceceran_oli_note')->nullable();
            $table->string('genangan_air_check')->nullable();
            $table->text('genangan_air_note')->nullable();
            $table->string('rambu_darurat_check')->nullable();
            $table->text('rambu_darurat_note')->nullable();
            $table->string('rambu_lalulintas_check')->nullable();
            $table->text('rambu_lalulintas_note')->nullable();
            $table->string('rambu_berhenti_check')->nullable();
            $table->text('rambu_berhenti_note')->nullable();
            $table->string('rambu_masuk_keluar_check')->nullable();
            $table->text('rambu_masuk_keluar_note')->nullable();
            $table->string('rambu_ogs_check')->nullable();
            $table->text('rambu_ogs_note')->nullable();
            $table->string('papan_nama_check')->nullable();
            $table->text('papan_nama_note')->nullable();
            $table->string('emergency_call_check')->nullable();
            $table->text('emergency_call_note')->nullable();
            $table->string('tempat_sampah_check')->nullable();
            $table->text('tempat_sampah_note')->nullable();
            $table->string('penyalur_petir_check')->nullable();
            $table->text('penyalur_petir_note')->nullable();
            $table->string('tempat_istirahat_check')->nullable();
            $table->text('tempat_istirahat_note')->nullable();
            $table->string('apar_check')->nullable();
            $table->text('apar_note')->nullable();
            $table->string('kotak_p3k_check')->nullable();
            $table->text('kotak_p3k_note')->nullable();
            $table->string('penerangan_check')->nullable();
            $table->text('penerangan_note')->nullable();
            $table->string('kamar_mandi_check')->nullable();
            $table->text('kamar_mandi_note')->nullable();
            $table->string('permukaan_tanah_check')->nullable();
            $table->text('permukaan_tanah_note')->nullable();
            $table->string('akses_jalan_check')->nullable();
            $table->text('akses_jalan_note')->nullable();
            $table->string('tinggi_tanggul_check')->nullable();
            $table->text('tinggi_tanggul_note')->nullable();
            $table->string('lebar_bus_check')->nullable();
            $table->text('lebar_bus_note')->nullable();
            $table->string('lebar_hd_check')->nullable();
            $table->text('lebar_hd_note')->nullable();
            $table->string('jalur_hd_check')->nullable();
            $table->text('jalur_hd_note')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('foreman')->nullable();
            $table->string('supervisor')->nullable();
            $table->string('superintendent')->nullable();
            $table->string('verified_foreman')->nullable();
            $table->string('verified_supervisor')->nullable();
            $table->string('verified_superintendent')->nullable();
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
        Schema::dropIfExists('klkh_ogs_t');
    }
};
