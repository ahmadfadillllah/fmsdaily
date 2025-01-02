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
        Schema::create('log_t', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tanggal_loging');
            $table->string('jenis_loging');
            $table->foreignId('nama_user')->constrained('users');
            $table->string('nik');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_t');
    }
};
