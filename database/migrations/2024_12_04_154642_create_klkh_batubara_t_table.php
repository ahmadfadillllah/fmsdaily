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
        Schema::create('klkh_batubara_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('pic')->constrained('users');
            $table->boolean('statusenabled')->default(1);
            $table->foreignId('pit_id')->constrained('area_m');
            $table->foreignId('shift_id')->constrained('shift_m');
            $table->date('date');
            $table->time('time');
            $table->string('loading_point_check')->nullable();
            $table->text('loading_point_note')->nullable();
            $table->string('permukaan_front_check')->nullable();
            $table->text('permukaan_front_note')->nullable();
            $table->string('tinggi_bench_check')->nullable();
            $table->text('tinggi_bench_note')->nullable();
            $table->string('lebar_loading_check')->nullable();
            $table->text('lebar_loading_note')->nullable();
            $table->string('drainase_check')->nullable();
            $table->text('drainase_note')->nullable();
            $table->string('penempatan_unit_check')->nullable();
            $table->text('penempatan_unit_note')->nullable();
            $table->string('pelabelan_seam_check')->nullable();
            $table->text('pelabelan_seam_note')->nullable();
            $table->string('lampu_unit_check')->nullable();
            $table->text('lampu_unit_note')->nullable();
            $table->string('unit_bersih_check')->nullable();
            $table->text('unit_bersih_note')->nullable();
            $table->string('penerangan_area_check')->nullable();
            $table->text('penerangan_area_note')->nullable();
            $table->string('housekeeping_check')->nullable();
            $table->text('housekeeping_note')->nullable();
            $table->string('pengukuran_roof_check')->nullable();
            $table->text('pengukuran_roof_note')->nullable();
            $table->string('cleaning_batubara_check')->nullable();
            $table->text('cleaning_batubara_note')->nullable();
            $table->string('genangan_air_check')->nullable();
            $table->text('genangan_air_note')->nullable();
            $table->string('big_coal_check')->nullable();
            $table->text('big_coal_note')->nullable();
            $table->string('stock_material_check')->nullable();
            $table->text('stock_material_note')->nullable();
            $table->string('lebar_jalan_angkut_check')->nullable();
            $table->text('lebar_jalan_angkut_note')->nullable();
            $table->string('lebar_jalan_tikungan_check')->nullable();
            $table->text('lebar_jalan_tikungan_note')->nullable();
            $table->string('super_elevasi_check')->nullable();
            $table->text('super_elevasi_note')->nullable();
            $table->string('safety_berm_check')->nullable();
            $table->text('safety_berm_note')->nullable();
            $table->string('tinggi_tanggul_check')->nullable();
            $table->text('tinggi_tanggul_note')->nullable();
            $table->string('safety_post_check')->nullable();
            $table->text('safety_post_note')->nullable();
            $table->string('drainase_genangan_air_check')->nullable();
            $table->text('drainase_genangan_air_note')->nullable();
            $table->string('median_jalan_check')->nullable();
            $table->text('median_jalan_note')->nullable();
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
        Schema::dropIfExists('klkh_batubara_t');
    }
};
