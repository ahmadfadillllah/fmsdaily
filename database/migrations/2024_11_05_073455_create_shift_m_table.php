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
        if (!Schema::hasTable('shift_m')) {
            Schema::create('shift_m', function (Blueprint $table) {
                $table->id();
                $table->boolean('statusenabled')->default(1);
                // $table->string('statusenabled');
                $table->string('keterangan');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_m');
    }
};
