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
            $table->string('uuid')->index();
            $table->foreignId('foreman_id')->constrained('users');
            $table->boolean('statusenabled')->default(1);
            $table->date('tanggal_dasar')->nullable();
            $table->foreignId('shift_dasar_id')->nullable()->constrained('shift_m');
            $table->foreignId('area_id')->nullable()->constrained('area_m');
            $table->foreignId('lokasi_id')->nullable()->constrained('lokasi_m');
            $table->string('nik_foreman')->nullable();
            $table->string('nama_foreman')->nullable();
            $table->string('verified_foreman')->nullable();
            $table->string('nik_supervisor')->nullable();
            $table->string('nama_supervisor')->nullable();
            $table->string('verified_supervisor')->nullable();
            $table->string('nik_superintendent')->nullable();
            $table->string('nama_superintendent')->nullable();
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
        Schema::dropIfExists('daily_report_t');
    }
};
