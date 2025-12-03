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
            // Check and add missing tracking dates
            if (!Schema::hasColumn('pengajuan_surats', 'tanggal_diproses')) {
                $table->timestamp('tanggal_diproses')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'tanggal_ditolak')) {
                $table->timestamp('tanggal_ditolak')->nullable();
            }
            
            // SURAT PERMOHONAN KK BARU columns
            if (!Schema::hasColumn('pengajuan_surats', 'fc_kk_lama_kk')) {
                $table->text('fc_kk_lama_kk')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_ktp_kk')) {
                $table->text('fc_ktp_kk')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_akta_nikah_kk')) {
                $table->text('fc_akta_nikah_kk')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'fc_akta_kelahiran_kk')) {
                $table->text('fc_akta_kelahiran_kk')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'surat_keterangan_pindah_datang_kk')) {
                $table->text('surat_keterangan_pindah_datang_kk')->nullable();
            }
            if (!Schema::hasColumn('pengajuan_surats', 'formulir_permohonan_kk')) {
                $table->text('formulir_permohonan_kk')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $columns = [
                'tanggal_diproses', 'tanggal_ditolak',
                'fc_kk_lama_kk', 'fc_ktp_kk', 'fc_akta_nikah_kk', 
                'fc_akta_kelahiran_kk', 'surat_keterangan_pindah_datang_kk', 
                'formulir_permohonan_kk'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('pengajuan_surats', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
