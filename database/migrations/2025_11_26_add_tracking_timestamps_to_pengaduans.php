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
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->timestamp('tanggal_diproses')->nullable()->after('status');
            $table->timestamp('tanggal_ditolak')->nullable()->after('tanggal_tanggapan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->dropColumn(['tanggal_diproses', 'tanggal_ditolak']);
        });
    }
};
