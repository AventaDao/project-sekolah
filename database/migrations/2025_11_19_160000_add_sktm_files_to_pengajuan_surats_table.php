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
            $table->string('fc_ktp_sktm')->nullable()->after('keperluan_sktm');
            $table->string('fc_kk_sktm')->nullable()->after('fc_ktp_sktm');
            $table->string('foto_rumah_sktm')->nullable()->after('fc_kk_sktm');
            $table->string('slip_gaji_sktm')->nullable()->after('foto_rumah_sktm');
            $table->string('bukti_kip_sktm')->nullable()->after('slip_gaji_sktm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'fc_ktp_sktm',
                'fc_kk_sktm',
                'foto_rumah_sktm',
                'slip_gaji_sktm',
                'bukti_kip_sktm',
            ]);
        });
    }
};
