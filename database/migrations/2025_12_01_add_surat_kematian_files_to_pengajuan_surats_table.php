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
            $table->string('nama_almarhum_almarhumah')->nullable()->after('prioritas_bantuan');
            $table->date('tanggal_kematian')->nullable()->after('nama_almarhum_almarhumah');
            $table->string('fc_ktp_almarhum')->nullable()->after('tanggal_kematian');
            $table->string('fc_kk_almarhum')->nullable()->after('fc_ktp_almarhum');
            $table->string('surat_keterangan_dokter_paramedis')->nullable()->after('fc_kk_almarhum');
            $table->string('surat_pengantar_rt_rw')->nullable()->after('surat_keterangan_dokter_paramedis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            $table->dropColumn([
                'nama_almarhum_almarhumah',
                'tanggal_kematian',
                'fc_ktp_almarhum',
                'fc_kk_almarhum',
                'surat_keterangan_dokter_paramedis',
                'surat_pengantar_rt_rw',
            ]);
        });
    }
};
