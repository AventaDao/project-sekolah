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
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->string('fc_ktp_skck')->nullable()->after('tanggal_dibutuhkan');
            $table->string('fc_kk_skck')->nullable()->after('fc_ktp_skck');
            $table->string('fc_akta_ijazah_nikah_skck')->nullable()->after('fc_kk_skck');
            $table->string('foto_pas_skck')->nullable()->after('fc_akta_ijazah_nikah_skck');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'fc_ktp_skck',
                'fc_kk_skck',
                'fc_akta_ijazah_nikah_skck',
                'foto_pas_skck',
            ]);
        });
    }
};
