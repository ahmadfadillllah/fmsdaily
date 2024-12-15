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
        Schema::create('klkh_simpangempat_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('pic')->constrained('users');
            $table->boolean('statusenabled')->default(1);
            $table->foreignId('pit_id')->constrained('area_m');
            $table->foreignId('shift_id')->constrained('shift_m');
            $table->date('date');
            $table->time('time');
            $table->string('intersection_name_check')->nullable();
            $table->text('intersection_name_note')->nullable();
            $table->string('speed_limit_sign_check')->nullable();
            $table->text('speed_limit_sign_note')->nullable();
            $table->string('intersection_sign_check')->nullable();
            $table->text('intersection_sign_note')->nullable();
            $table->string('caution_sign_check')->nullable();
            $table->text('caution_sign_note')->nullable();
            $table->string('stop_sign_check')->nullable();
            $table->text('stop_sign_note')->nullable();
            $table->string('horn_sign_unit_check')->nullable();
            $table->text('horn_sign_unit_note')->nullable();
            $table->string('double_sign_check')->nullable();
            $table->text('double_sign_note')->nullable();
            $table->string('right_turn_prohibited_check')->nullable();
            $table->text('right_turn_prohibited_note')->nullable();
            $table->string('traffic_light_check')->nullable();
            $table->text('traffic_light_note')->nullable();
            $table->string('intersection_officer_check')->nullable();
            $table->text('intersection_officer_note')->nullable();
            $table->string('radio_communication_check')->nullable();
            $table->text('radio_communication_note')->nullable();
            $table->string('intersection_monitoring_check')->nullable();
            $table->text('intersection_monitoring_note')->nullable();
            $table->string('standard_road_medium_check')->nullable();
            $table->text('standard_road_medium_note')->nullable();
            $table->string('road_width_check')->nullable();
            $table->text('road_width_note')->nullable();
            $table->string('smooth_transport_path_check')->nullable();
            $table->text('smooth_transport_path_note')->nullable();
            $table->string('blind_spot_check')->nullable();
            $table->text('blind_spot_note')->nullable();
            $table->string('radius_check')->nullable();
            $table->text('radius_note')->nullable();
            $table->string('trash_bin_check')->nullable();
            $table->text('trash_bin_note')->nullable();
            $table->string('toilet_facility_check')->nullable();
            $table->text('toilet_facility_note')->nullable();
            $table->string('lighting_check')->nullable();
            $table->text('lighting_note')->nullable();
            $table->string('first_aid_box_check')->nullable();
            $table->text('first_aid_box_note')->nullable();
            $table->string('fire_extinguisher_check')->nullable();
            $table->text('fire_extinguisher_note')->nullable();
            $table->string('parking_area_check')->nullable();
            $table->text('parking_area_note')->nullable();
            $table->string('lightning_rod_check')->nullable();
            $table->text('lightning_rod_note')->nullable();
            $table->string('sop_check')->nullable();
            $table->text('sop_note')->nullable();
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
        Schema::dropIfExists('klkh_simpangempat_t');
    }
};
