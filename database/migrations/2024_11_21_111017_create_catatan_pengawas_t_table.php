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
        Schema::create('catatan_pengawas_t', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_report_id')->constrained('daily_report_t');
            $table->boolean('statusenabled');
            $table->time('jam_start')->nullable();
            $table->time('jam_stop')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_pengawas_t');
    }
};
