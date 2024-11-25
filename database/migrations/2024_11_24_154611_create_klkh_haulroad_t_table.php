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
        Schema::create('klkh_haulroad_t', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pic')->constrained('users');
            $table->string('statusenabled');
            $table->string('pit');
            $table->string('shift');
            $table->date('date');
            $table->time('time');
            $table->string('road_width_check');
            $table->text('road_width_note')->nullable();
            $table->string('curve_width_check');
            $table->text('curve_width_note')->nullable();
            $table->string('super_elevation_check');
            $table->text('super_elevation_note')->nullable();
            $table->string('safety_berm_check');
            $table->text('safety_berm_note')->nullable();
            $table->string('tanggul_check');
            $table->text('tanggul_note')->nullable();
            $table->string('safety_patok_check');
            $table->text('safety_patok_note')->nullable();
            $table->string('drainage_check');
            $table->text('drainage_note')->nullable();
            $table->string('median_check');
            $table->text('median_note')->nullable();
            $table->string('intersection_check');
            $table->text('intersection_note')->nullable();
            $table->string('traffic_sign_check');
            $table->text('traffic_sign_note')->nullable();
            $table->string('night_work_sign_check');
            $table->text('night_work_sign_note')->nullable();
            $table->string('road_condition_check');
            $table->text('road_condition_note')->nullable();
            $table->string('divider_check');
            $table->text('divider_note')->nullable();
            $table->string('haul_route_check');
            $table->text('haul_route_note')->nullable();
            $table->string('dust_control_check');
            $table->text('dust_control_note')->nullable();
            $table->string('intersection_officer_check');
            $table->text('intersection_officer_note')->nullable();
            $table->string('red_light_check');
            $table->text('red_light_note')->nullable();
            $table->text('additional_notes')->nullable();
            $table->string('supervisor')->nullable();
            $table->text('superintendent')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klkh_haulroad_t');
    }
};
