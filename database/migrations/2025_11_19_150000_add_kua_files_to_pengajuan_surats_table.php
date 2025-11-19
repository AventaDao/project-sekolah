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
            $table->string('fc_kk_pria')->nullable()->after('tujuan_kua');
            $table->string('fc_ktp_pria')->nullable()->after('fc_kk_pria');
            $table->string('fc_akta_pria')->nullable()->after('fc_ktp_pria');
            $table->string('fc_kk_wanita')->nullable()->after('fc_akta_pria');
            $table->string('fc_ktp_wanita')->nullable()->after('fc_kk_wanita');
            $table->string('fc_akta_wanita')->nullable()->after('fc_ktp_wanita');
            $table->string('surat_keterangan_n1_n4')->nullable()->after('fc_akta_wanita');
            $table->string('foto_pas_pria')->nullable()->after('surat_keterangan_n1_n4');
            $table->string('foto_pas_wanita')->nullable()->after('foto_pas_pria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'fc_kk_pria',
                'fc_ktp_pria',
                'fc_akta_pria',
                'fc_kk_wanita',
                'fc_ktp_wanita',
                'fc_akta_wanita',
                'surat_keterangan_n1_n4',
                'foto_pas_pria',
                'foto_pas_wanita',
            ]);
        });
    }
};
