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
        $tables = ['daily_report_t', 'front_loading_t', 'alat_support_t', 'catatan_pengawas_t'];
        foreach($tables as $table){
            Schema::table($table, function (Blueprint $table) {
                $table->boolean('is_draft')->default(0);
            });
        }

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = ['daily_report_t', 'front_loading_t', 'alat_support_t', 'catatan_pengawas_t'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('IsDraft');
            });
        }
    }
};
