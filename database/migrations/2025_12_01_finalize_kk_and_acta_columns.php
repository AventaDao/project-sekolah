<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add the missing column
        if (!Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ibu_acta')) {
            Schema::table('pengajuan_surats', function (Blueprint $table) {
                $table->text('fc_akta_kelahiran_ibu_acta')->nullable()->after('sptjm_acta');
            });
        }

        // Update the enum if needed
        DB::statement("ALTER TABLE pengajuan_surats MODIFY jenis_surat ENUM('Surat KUA', 'Surat Keterangan Tidak Mampu', 'Surat Domisili', 'Surat Keterangan Tanah', 'SKCK', 'Surat Permohonan Bantuan', 'Surat Kematian', 'Surat Permohonan KK Baru', 'Surat Permohonan Akta Kelahiran')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ibu_acta')) {
            Schema::table('pengajuan_surats', function (Blueprint $table) {
                $table->dropColumn('fc_akta_kelahiran_ibu_acta');
            });
        }

        DB::statement("ALTER TABLE pengajuan_surats MODIFY jenis_surat ENUM('Surat KUA', 'Surat Keterangan Tidak Mampu', 'Surat Domisili', 'Surat Keterangan Tanah', 'SKCK', 'Surat Permohonan Bantuan', 'Surat Kematian')");
    }
};
