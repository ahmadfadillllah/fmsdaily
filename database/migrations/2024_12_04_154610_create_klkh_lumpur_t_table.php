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
        Schema::create('klkh_lumpur_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('pic')->constrained('users');
            $table->boolean('statusenabled')->default(1);
            $table->foreignId('pit_id')->constrained('area_m');
            $table->foreignId('shift_id')->constrained('shift_m');
            $table->date('date');
            $table->time('time');
            $table->string('unit_breakdown_check')->nullable();
            $table->text('unit_breakdown_note')->nullable();
            $table->string('rambu_check')->nullable();
            $table->text('rambu_note')->nullable();
            $table->string('grade_check')->nullable();
            $table->text('grade_note')->nullable();
            $table->string('unit_maintenance_check')->nullable();
            $table->text('unit_maintenance_note')->nullable();
            $table->string('debu_check')->nullable();
            $table->text('debu_note')->nullable();
            $table->string('lebar_jalan_check')->nullable();
            $table->text('lebar_jalan_note')->nullable();
            $table->string('blind_spot_check')->nullable();
            $table->text('blind_spot_note')->nullable();
            $table->string('kondisi_jalan_check')->nullable();
            $table->text('kondisi_jalan_note')->nullable();
            $table->string('tanggul_jalan_check')->nullable();
            $table->text('tanggul_jalan_note')->nullable();
            $table->string('pengelolaan_air_check')->nullable();
            $table->text('pengelolaan_air_note')->nullable();
            $table->string('crack_check')->nullable();
            $table->text('crack_note')->nullable()->nullable();
            $table->string('luas_area_check')->nullable();
            $table->text('luas_area_note')->nullable();
            $table->string('tanggul_check')->nullable();
            $table->text('tanggul_note')->nullable();
            $table->string('free_dump_check')->nullable();
            $table->text('free_dump_note')->nullable();
            $table->string('alokasi_material_check')->nullable();
            $table->text('alokasi_material_note')->nullable();
            $table->string('beda_level_check')->nullable();
            $table->text('beda_level_note')->nullable();
            $table->string('tinggi_dumpingan_check')->nullable();
            $table->text('tinggi_dumpingan_note')->nullable();
            $table->string('genangan_air_check')->nullable();
            $table->text('genangan_air_note')->nullable();
            $table->string('dumpingan_bergelombang_check')->nullable();
            $table->text('dumpingan_bergelombang_note')->nullable();
            $table->string('bendera_acuan_check')->nullable();
            $table->text('bendera_acuan_note')->nullable();
            $table->string('rambu_jarak_check')->nullable();
            $table->text('rambu_jarak_note')->nullable();
            $table->string('tower_lamp_check')->nullable();
            $table->text('tower_lamp_note')->nullable();
            $table->string('penyalur_petir_check')->nullable();
            $table->text('penyalur_petir_note')->nullable();
            $table->string('muster_point_check')->nullable();
            $table->text('muster_point_note')->nullable();
            $table->string('safety_bundwall_check')->nullable();
            $table->text('safety_bundwall_note')->nullable();
            $table->string('ring_buoy_check')->nullable();
            $table->text('ring_buoy_note')->nullable();
            $table->string('sling_ware_check')->nullable();
            $table->text('sling_ware_note')->nullable();
            $table->string('pondok_pengawas_check')->nullable();
            $table->text('pondok_pengawas_note')->nullable();
            $table->string('struktur_pengawas_check')->nullable();
            $table->text('struktur_pengawas_note')->nullable();
            $table->string('life_jacket_bulldozer_check')->nullable();
            $table->text('life_jacket_bulldozer_note')->nullable();
            $table->string('emergency_number_check')->nullable();
            $table->text('emergency_number_note')->nullable();
            $table->string('life_jacket_spotter_check')->nullable();
            $table->text('life_jacket_spotter_note')->nullable();
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
        Schema::dropIfExists('klkh_lumpur_t');
    }
};
