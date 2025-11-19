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
            $table->string('fc_ktp_tanah')->nullable()->after('nomor_sertifikat');
            $table->string('fc_kk_tanah')->nullable()->after('fc_ktp_tanah');
            $table->string('fc_npwp_tanah')->nullable()->after('fc_kk_tanah');
            $table->string('fc_ajb_atau_bukti_kepemilikan_tanah')->nullable()->after('fc_npwp_tanah');
            $table->string('fc_sppt_pbb_tanah')->nullable()->after('fc_ajb_atau_bukti_kepemilikan_tanah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'fc_ktp_tanah',
                'fc_kk_tanah',
                'fc_npwp_tanah',
                'fc_ajb_atau_bukti_kepemilikan_tanah',
                'fc_sppt_pbb_tanah',
            ]);
        });
    }
};
