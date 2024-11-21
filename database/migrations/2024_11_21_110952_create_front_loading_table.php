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
        Schema::create('front_loading', function (Blueprint $table) {
            $table->id();
            $table->integer('daily_report_id');
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
        Schema::dropIfExists('front_loading');
    }
};
