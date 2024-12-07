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
        Schema::create('klkh_disposal_t', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->foreignId('pic')->constrained('users');
            $table->string('statusenabled');
            $table->foreignId('pit_id')->constrained('area_m');
            $table->foreignId('shift_id')->constrained('shift_m');
            $table->date('date');
            $table->time('time');
            $table->string('dumping_point_1');
            $table->text('dumping_point_1_note')->nullable();
            $table->string('dumping_point_2');
            $table->text('dumping_point_2_note')->nullable();
            $table->string('dumping_point_3');
            $table->text('dumping_point_3_note')->nullable();
            $table->string('dumping_point_4');
            $table->text('dumping_point_4_note')->nullable();
            $table->string('dumping_point_5');
            $table->text('dumping_point_5_note')->nullable();
            $table->string('dumping_point_6');
            $table->text('dumping_point_6_note')->nullable();
            $table->string('dumping_point_7');
            $table->text('dumping_point_7_note')->nullable();
            $table->string('dumping_point_8');
            $table->text('dumping_point_8_note')->nullable();
            $table->string('dumping_point_9');
            $table->text('dumping_point_9_note')->nullable();
            $table->string('dumping_point_10');
            $table->text('dumping_point_10_note')->nullable();
            $table->string('dumping_point_11');
            $table->text('dumping_point_11_note')->nullable();
            $table->string('dumping_point_12');
            $table->text('dumping_point_12_note')->nullable();
            $table->string('dumping_point_13');
            $table->text('dumping_point_13_note')->nullable();
            $table->string('dumping_point_14');
            $table->text('dumping_point_14_note')->nullable();
            $table->string('dumping_point_15');
            $table->text('dumping_point_15_note')->nullable();
            $table->string('dumping_point_16');
            $table->text('dumping_point_16_note')->nullable();
            $table->string('dumping_point_17');
            $table->text('dumping_point_17_note')->nullable();
            $table->string('dumping_point_18');
            $table->text('dumping_point_18_note')->nullable();
            $table->string('dumping_point_19');
            $table->text('dumping_point_19_note')->nullable();
            $table->string('dumping_point_20');
            $table->text('dumping_point_20_note')->nullable();
            $table->string('dumping_point_21');
            $table->text('dumping_point_21_note')->nullable();
            $table->string('dumping_point_22');
            $table->text('dumping_point_22_note')->nullable();
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
        Schema::dropIfExists('klkh_disposal_t');
    }
};
