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
        Schema::create('daily_report_t', function (Blueprint $table) {
            $table->id();
            $table->foreignId('foreman_id')->constrained('users');
            $table->string('statusenabled');
            $table->date('tanggal_dasar')->nullable();
            $table->string('shift_dasar')->nullable();
            $table->string('area')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('nik_supervisor')->nullable();
            $table->string('nama_supervisor')->nullable();
            $table->string('nik_superintendent')->nullable();
            $table->string('nama_superintendent')->nullable();
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
        Schema::dropIfExists('daily_report_t');
    }
};
