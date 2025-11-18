<?php

namespace Database\Seeders;

use App\Models\PengajuanSurat;
use Illuminate\Database\Seeder;

/**
 * Demo seeder untuk menunjukkan struktur data form dinamis
 * 
 * Jalankan: php artisan db:seed --class=PengajuanSuratDemoSeeder
 */
class PengajuanSuratDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Demo: Pengajuan Surat KUA
        PengajuanSurat::create([
            'user_id' => 1,
            'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
            'jenis_surat' => 'Surat KUA',
            'keperluan' => 'Untuk mempersiapkan pernikahan saya dengan calon istri',
            'surat_pengantar_rw' => 'surat-pengantar-rw/demo.pdf',
            'tujuan_kua' => 'Nikah',
            'nama_calon_mempelai' => 'Budi Santoso',
            'tanggal_pernikahan' => now()->addMonths(2)->toDateString(),
            'nama_pasangan' => 'Siti Nurhaliza',
            'status' => 'Menunggu',
        ]);

        // Demo: Pengajuan SKTM
        PengajuanSurat::create([
            'user_id' => 1,
            'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
            'jenis_surat' => 'Surat Keterangan Tidak Mampu',
            'keperluan' => 'Untuk mengurus beasiswa pendidikan anak',
            'surat_pengantar_rw' => 'surat-pengantar-rw/demo.pdf',
            'nama_penerima_sktm' => 'Anak Budi Santoso',
            'alasan_tidak_mampu' => 'Penghasilan keluarga tidak mencukupi karena ayah adalah pengangguran dan ibu hanya bekerja sebagai pembantu rumah tangga dengan penghasilan tidak tetap',
            'keperluan_sktm' => 'Beasiswa',
            'status' => 'Diproses',
        ]);

        // Demo: Pengajuan Surat Domisili
        PengajuanSurat::create([
            'user_id' => 1,
            'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
            'jenis_surat' => 'Surat Domisili',
            'keperluan' => 'Untuk keperluan administrasi pembukaan rekening bank',
            'surat_pengantar_rw' => 'surat-pengantar-rw/demo.pdf',
            'alamat_domisili' => 'Jl. Raya Candi No. 123',
            'rt_domisili' => '001',
            'rw_domisili' => '002',
            'tanggal_mulai_tinggal' => now()->subYears(5)->toDateString(),
            'status_rumah' => 'Milik Sendiri',
            'status' => 'Selesai',
        ]);

        // Demo: Pengajuan Surat Keterangan Tanah
        PengajuanSurat::create([
            'user_id' => 1,
            'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
            'jenis_surat' => 'Surat Keterangan Tanah',
            'keperluan' => 'Untuk keperluan jual beli tanah',
            'surat_pengantar_rw' => 'surat-pengantar-rw/demo.pdf',
            'lokasi_tanah' => 'Jl. Merdeka RT 001 RW 002 Desa Candi',
            'luas_tanah' => 250.50,
            'status_tanah' => 'Milik',
            'nomor_sertifikat' => '123/2020/CANDI',
            'deskripsi_tanah' => 'Tanah kosong dengan bentuk persegi panjang, kondisi tanah datar dan tidak berbatasan dengan sungai',
            'status' => 'Menunggu',
        ]);

        // Demo: Pengajuan SKCK
        PengajuanSurat::create([
            'user_id' => 1,
            'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
            'jenis_surat' => 'SKCK',
            'keperluan' => 'Untuk melamar pekerjaan',
            'surat_pengantar_rw' => 'surat-pengantar-rw/demo.pdf',
            'tujuan_skck' => 'Melamar Pekerjaan',
            'institusi_tujuan' => 'PT Maju Jaya Indonesia',
            'tanggal_dibutuhkan' => now()->addWeek()->toDateString(),
            'status' => 'Diproses',
        ]);

        // Demo: Pengajuan Surat Permohonan Bantuan
        PengajuanSurat::create([
            'user_id' => 1,
            'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
            'jenis_surat' => 'Surat Permohonan Bantuan',
            'keperluan' => 'Untuk mengajukan bantuan renovasi rumah',
            'surat_pengantar_rw' => 'surat-pengantar-rw/demo.pdf',
            'jenis_bantuan' => 'Renovasi Rumah',
            'jumlah_bantuan' => 5000000,
            'latar_belakang_bantuan' => 'Rumah saya sudah sangat tua dengan kondisi atap bocor dan dinding retak. Karena keterbatasan biaya, saya tidak mampu melakukan renovasi sendiri',
            'prioritas_bantuan' => 'Mendesak',
            'status' => 'Menunggu',
        ]);
    }
}
