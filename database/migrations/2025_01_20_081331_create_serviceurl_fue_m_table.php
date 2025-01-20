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
        Schema::create('serviceurl_fue_m', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->boolean('IS_ACTIVE')->default(1);
            $table->string('NAMA')->nullable();
            $table->string('IP_ADDRESS')->nullable();
            $table->string('TYPE')->nullable();
            $table->string('USE')->nullable();
            $table->string('TOKEN')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serviceurl_fue_m');
    }
};
