<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // Field untuk SURAT KUA
            $table->string('nama_calon_mempelai')->nullable();
            $table->date('tanggal_pernikahan')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->string('tujuan_kua')->nullable(); // nikah, rujuk, dll

            // Field untuk SKTM (Surat Keterangan Tidak Mampu)
            $table->string('nama_penerima_sktm')->nullable();
            $table->text('alasan_tidak_mampu')->nullable();
            $table->string('keperluan_sktm')->nullable(); // beasiswa, bantuan, dll

            // Field untuk SURAT DOMISILI
            $table->string('alamat_domisili')->nullable();
            $table->string('rt_domisili')->nullable();
            $table->string('rw_domisili')->nullable();
            $table->date('tanggal_mulai_tinggal')->nullable();
            $table->string('status_rumah')->nullable(); // milik sendiri, sewa, dll

            // Field untuk SURAT KETERANGAN TANAH
            $table->text('deskripsi_tanah')->nullable();
            $table->string('lokasi_tanah')->nullable();
            $table->decimal('luas_tanah', 8, 2)->nullable();
            $table->string('status_tanah')->nullable(); // milik, waris, gadai, dll
            $table->string('nomor_sertifikat')->nullable();

            // Field untuk SKCK
            $table->string('tujuan_skck')->nullable(); // kerja, sekolah, dll
            $table->string('institusi_tujuan')->nullable();
            $table->date('tanggal_dibutuhkan')->nullable();

            // Field untuk SURAT PERMOHONAN BANTUAN
            $table->string('jenis_bantuan')->nullable(); // sosial, kesehatan, renovasi, dll
            $table->decimal('jumlah_bantuan', 12, 2)->nullable();
            $table->text('latar_belakang_bantuan')->nullable();
            $table->string('prioritas_bantuan')->nullable(); // biaya, waktu, dll
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan_surats', function (Blueprint $table) {
            // SURAT KUA
            $table->dropColumn(['nama_calon_mempelai', 'tanggal_pernikahan', 'nama_pasangan', 'tujuan_kua']);

            // SKTM
            $table->dropColumn(['nama_penerima_sktm', 'alasan_tidak_mampu', 'keperluan_sktm']);

            // SURAT DOMISILI
            $table->dropColumn(['alamat_domisili', 'rt_domisili', 'rw_domisili', 'tanggal_mulai_tinggal', 'status_rumah']);

            // SURAT KETERANGAN TANAH
            $table->dropColumn(['deskripsi_tanah', 'lokasi_tanah', 'luas_tanah', 'status_tanah', 'nomor_sertifikat']);

            // SKCK
            $table->dropColumn(['tujuan_skck', 'institusi_tujuan', 'tanggal_dibutuhkan']);

            // SURAT PERMOHONAN BANTUAN
            $table->dropColumn(['jenis_bantuan', 'jumlah_bantuan', 'latar_belakang_bantuan', 'prioritas_bantuan']);
        });
    }
};
