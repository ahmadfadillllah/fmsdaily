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
        Schema::create('klkh_loadingpoint_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('pic')->constrained('users');
            $table->string('statusenabled');
            $table->foreignId('pit_id')->constrained('area_m');
            $table->foreignId('shift_id')->constrained('shift_m');
            $table->date('date');
            $table->time('time');
            $table->string('loading_point_check');
            $table->text('loading_point_note')->nullable();
            $table->string('front_surface_check');
            $table->text('front_surface_note')->nullable();
            $table->string('bench_work_check');
            $table->text('bench_work_note')->nullable();
            $table->string('access_dike_check');
            $table->text('access_dike_note')->nullable();
            $table->string('loading_point_width_check');
            $table->text('loading_point_width_note')->nullable();
            $table->string('drainage_check');
            $table->text('drainage_note')->nullable();
            $table->string('no_waves_check');
            $table->text('no_waves_note')->nullable();
            $table->string('unit_placement_check');
            $table->text('unit_placement_note')->nullable();
            $table->string('material_stock_check');
            $table->text('material_stock_note')->nullable();
            $table->string('loading_hauling_check');
            $table->text('loading_hauling_note')->nullable();
            $table->string('dust_control_check');
            $table->text('dust_control_note')->nullable();
            $table->string('lighting_check');
            $table->text('lighting_note')->nullable();
            $table->string('housekeeping_check');
            $table->text('housekeeping_note')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('foreman')->nullable();
            $table->string('supervisor')->nullable();
            $table->text('superintendent')->nullable();
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
        Schema::dropIfExists('klkh_loadingpoint_t');
    }
};
