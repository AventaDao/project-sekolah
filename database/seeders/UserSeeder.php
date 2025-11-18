<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // User biasa
        DB::table('users')->insert([
            'nik' => '1234567812345678',
            'nama_lengkap' => 'userdao',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Jl. Raya Candi No. 123',
            'rt' => '001',
            'rw' => '002',
            'desa' => 'Candi',
            'kecamatan' => 'Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
            'kode_pos' => '61271',
            'agama' => 'Islam',
            'status_perkawinan' => 'Belum Kawin',
            'pekerjaan' => 'Pegawai Swasta',
            'kewarganegaraan' => 'WNI',
            'email' => 'usersatu@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Admin
        DB::table('users')->insert([
            'nik' => '1234567887654321',
            'nama_lengkap' => 'deezydao',
            'tempat_lahir' => 'Sidoarjo',
            'tanggal_lahir' => '1985-05-15',
            'jenis_kelamin' => 'Laki-laki',
            'alamat' => 'Kantor Desa Kedung Kendo',
            'rt' => '001',
            'rw' => '001',
            'desa' => 'Candi',
            'kecamatan' => 'Sidoarjo',
            'kabupaten' => 'Sidoarjo',
            'provinsi' => 'Jawa Timur',
            'kode_pos' => '61271',
            'agama' => 'Islam',
            'status_perkawinan' => 'Kawin',
            'pekerjaan' => 'Pegawai Negeri',
            'kewarganegaraan' => 'WNI',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('admin123'),
            'is_verified' => true,
        ]);
    }
}