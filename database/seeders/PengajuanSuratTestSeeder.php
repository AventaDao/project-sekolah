<?php

namespace Database\Seeders;

use App\Models\PengajuanSurat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class PengajuanSuratTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil user pertama yang ada (atau buat dummy file)
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'password' => bcrypt('password'),
                'role' => 'user',
                'is_verified' => true,
            ]);
        }

        // Buat dummy file surat pengantar
        $dummyFilePath = 'surat-pengantar-rw/dummy-surat-pengantar-' . time() . '.txt';
        Storage::disk('public')->put($dummyFilePath, 'Ini adalah file dummy surat pengantar RW untuk keperluan testing.');

        // Create sample pengajuan surat with all types
        $suratTypes = PengajuanSurat::getSuratTypes();

        foreach ($suratTypes as $jenisSurat => $config) {
            PengajuanSurat::create([
                'user_id' => $user->id,
                'nomor_pengajuan' => PengajuanSurat::generateNomorPengajuan(),
                'jenis_surat' => $jenisSurat,
                'keperluan' => $faker->text(100),
                'surat_pengantar_rw' => $dummyFilePath,
                'keterangan_tambahan' => $faker->optional()->text(50),
                'status' => 'Menunggu',
                // Add sample dynamic fields based on type
                'nama_calon_mempelai' => $jenisSurat === 'Surat KUA' ? $faker->name() : null,
                'tanggal_pernikahan' => $jenisSurat === 'Surat KUA' ? now()->addDays(30)->format('Y-m-d') : null,
                'nama_pasangan' => $jenisSurat === 'Surat KUA' ? $faker->name() : null,
                'tujuan_kua' => $jenisSurat === 'Surat KUA' ? 'Nikah' : null,
                'nama_penerima_sktm' => $jenisSurat === 'Surat Keterangan Tidak Mampu' ? $faker->name() : null,
                'alasan_tidak_mampu' => $jenisSurat === 'Surat Keterangan Tidak Mampu' ? $faker->text(50) : null,
                'keperluan_sktm' => $jenisSurat === 'Surat Keterangan Tidak Mampu' ? 'Beasiswa' : null,
                'alamat_domisili' => $jenisSurat === 'Surat Domisili' ? $faker->address() : null,
                'rt_domisili' => $jenisSurat === 'Surat Domisili' ? $faker->numberBetween(1, 10) : null,
                'rw_domisili' => $jenisSurat === 'Surat Domisili' ? $faker->numberBetween(1, 5) : null,
                'tanggal_mulai_tinggal' => $jenisSurat === 'Surat Domisili' ? now()->subMonths(6)->format('Y-m-d') : null,
                'status_rumah' => $jenisSurat === 'Surat Domisili' ? 'Sewa' : null,
                'deskripsi_tanah' => $jenisSurat === 'Surat Keterangan Tanah' ? $faker->text(50) : null,
                'lokasi_tanah' => $jenisSurat === 'Surat Keterangan Tanah' ? $faker->address() : null,
                'luas_tanah' => $jenisSurat === 'Surat Keterangan Tanah' ? $faker->numberBetween(100, 1000) : null,
                'status_tanah' => $jenisSurat === 'Surat Keterangan Tanah' ? 'Milik' : null,
                'nomor_sertifikat' => $jenisSurat === 'Surat Keterangan Tanah' ? $faker->numerify('###/###/###') : null,
                'tujuan_skck' => $jenisSurat === 'SKCK' ? 'Melamar Pekerjaan' : null,
                'institusi_tujuan' => $jenisSurat === 'SKCK' ? $faker->company() : null,
                'tanggal_dibutuhkan' => $jenisSurat === 'SKCK' ? now()->addDays(14)->format('Y-m-d') : null,
                'jenis_bantuan' => $jenisSurat === 'Surat Permohonan Bantuan' ? 'Bantuan Sosial' : null,
                'jumlah_bantuan' => $jenisSurat === 'Surat Permohonan Bantuan' ? $faker->numberBetween(1000000, 5000000) : null,
                'latar_belakang_bantuan' => $jenisSurat === 'Surat Permohonan Bantuan' ? $faker->text(50) : null,
                'prioritas_bantuan' => $jenisSurat === 'Surat Permohonan Bantuan' ? 'Mendesak' : null,
            ]);
        }

        $this->command->info('✅ Test pengajuan surat berhasil dibuat untuk semua jenis surat!');
    }
}
