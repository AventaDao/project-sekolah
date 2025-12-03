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
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // SURAT PERMOHONAN AKTA KELAHIRAN columns
            if (!Schema::hasColumn('pengajuan_surats', 'surat_keterangan_kelahiran_acta')) {
                $table->text('surat_keterangan_kelahiran_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_kk_acta')) {
                $table->text('fc_kk_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_ktp_ayah_acta')) {
                $table->text('fc_ktp_ayah_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_ktp_ibu_acta')) {
                $table->text('fc_ktp_ibu_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_buku_nikah_acta')) {
                $table->text('fc_buku_nikah_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_ktp_saksi_1_acta')) {
                $table->text('fc_ktp_saksi_1_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_ktp_saksi_2_acta')) {
                $table->text('fc_ktp_saksi_2_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'formulir_f202_acta')) {
                $table->text('formulir_f202_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'formulir_f201_acta')) {
                $table->text('formulir_f201_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'sptjm_acta')) {
                $table->text('sptjm_acta')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_ibu_acta')) {
                $table->text('fc_akta_kelahiran_ibu_acta')->nullable();
            }
        });
        
        // Update jenis_surat enum if needed
        try {
            DB::statement("ALTER TABLE pengajuan_surats MODIFY jenis_surat ENUM('Surat KUA', 'Surat Keterangan Tidak Mampu', 'Surat Domisili', 'Surat Keterangan Tanah', 'SKCK', 'Surat Permohonan Bantuan', 'Surat Kematian', 'Surat Permohonan KK Baru', 'Surat Permohonan Akta Kelahiran')");
        } catch (\Exception $e) {
            // Already updated
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $columns = ['surat_keterangan_kelahiran_acta', 'fc_kk_acta', 'fc_ktp_ayah_acta', 'fc_ktp_ibu_acta', 'fc_buku_nikah_acta', 'fc_ktp_saksi_1_acta', 'fc_ktp_saksi_2_acta', 'formulir_f202_acta', 'formulir_f201_acta', 'sptjm_acta', 'fc_akta_kelahiran_ibu_acta'];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('pengajuan_surats', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
