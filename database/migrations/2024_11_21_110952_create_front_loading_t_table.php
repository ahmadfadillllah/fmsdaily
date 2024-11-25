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
        Schema::create('front_loading_t', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_report_id')->constrained('daily_report_t');
            $table->string('statusenabled');
            $table->string('nomor_unit')->nullable();
            $table->string('siang')->nullable();
            $table->string('malam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('front_loading_t');
    }
};
