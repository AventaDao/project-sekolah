<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaryawanSeeder extends Seeder
{
    public function run(): void
    {
        // Create test karyawan users (sesuai struktur users table yang ada)
        $karyawanData = [
            [
                'nik' => '1234567890',
                'nama_lengkap' => 'Budi Santoso',
                'email' => 'budi@example.test',
                'password' => 'secret',
                'jabatan' => 'Staff',
            ],
            [
                'nik' => '1234567891',
                'nama_lengkap' => 'Siti Nurhaliza',
                'email' => 'siti@example.test',
                'password' => 'secret',
                'jabatan' => 'Admin',
            ],
            [
                'nik' => '1234567892',
                'nama_lengkap' => 'Ahmad Wijaya',
                'email' => 'ahmad@example.test',
                'password' => 'secret',
                'jabatan' => 'Manager',
            ],
        ];

        foreach ($karyawanData as $data) {
            $jabatan = $data['jabatan'];
            unset($data['jabatan']);
            
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                array_merge($data, [
                    'password' => Hash::make($data['password']),
                    'role' => 'karyawan',
                    'is_verified' => true,
                    'tempat_lahir' => 'Indonesia',
                    'tanggal_lahir' => now()->subYears(30)->toDateString(),
                    'jenis_kelamin' => 'Laki-laki',
                    'alamat' => 'Jl. Test No. 1',
                    'rt' => '01',
                    'rw' => '01',
                    'desa' => 'Test Desa',
                    'kecamatan' => 'Test Kecamatan',
                    'kabupaten' => 'Test Kabupaten',
                    'provinsi' => 'Test Provinsi',
                    'kode_pos' => '12345',
                    'agama' => 'Islam',
                    'status_perkawinan' => 'Belum Kawin',
                    'pekerjaan' => 'Karyawan',
                ])
            );

            Karyawan::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'user_id' => $user->id,
                    'nama' => $user->nama_lengkap,
                    'jabatan' => $jabatan,
                    'nik' => $user->nik,
                    'telepon' => '08123456789',
                ]
            );
        }

        $this->command->info('✅ Karyawan seeder berhasil dijalankan');
    }
}
