# 📂 Aplikasi PPDB – UKK 2526

> **Progress Terakhir:** Membuat fitur **SSO Login** untuk autentikasi pengguna.

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.x-red" alt="Laravel Version">
<img src="https://img.shields.io/badge/Status-Development-orange" alt="Status">
</p>

---

## 📌 Tentang Proyek

Aplikasi **PPDB** (Penerimaan Peserta Didik Baru) adalah platform berbasis web yang membantu sekolah mengelola pendaftaran siswa baru secara **online**.

### 🎯 Tujuan Utama

-   **Efisiensi:** Mengurangi antrian dan pekerjaan manual saat proses pendaftaran.
-   **Transparansi:** Mempermudah verifikasi dan pelaporan data pendaftar.
-   **Kemudahan Akses:** Calon siswa dapat mendaftar dari mana saja.
-   **Mengurangi Human Error:** Mengurangi kesalahan input data.

### 👥 Pengguna Utama

-   **Calon Peserta Didik & Orang Tua/Wali:** Mengisi formulir, mengunggah dokumen, memantau hasil seleksi.
-   **Panitia PPDB (Admin Operator):** Memverifikasi data, mengelola jadwal, dan mengatur hasil seleksi.

### 🕒 Waktu Penggunaan

-   Pra-Pendaftaran (sosialisasi)
-   Masa Pendaftaran Online
-   Seleksi & Verifikasi Berkas
-   Pengumuman Hasil Seleksi
-   Daftar Ulang
-   Arsip & Pelaporan Data

### 🔑 Fitur Utama

-   Registrasi akun & login.
-   Formulir pendaftaran online.
-   Upload dokumen persyaratan.
-   Verifikasi berkas oleh admin.
-   Seleksi & penilaian otomatis/manual.
-   Pengumuman hasil & daftar ulang.
-   **SSO Login** (fitur terbaru).

---

## 🔄 Cara Clone Branch Ini

Gunakan perintah berikut untuk clone hanya branch ini saja:

```bash
git clone --branch aplikasi_ppdb --single-branch https://github.com/riskiputraalamzah/ukk_2526.git aplikasi_ppdb
```

Lalu masuk ke folder project:

```bash
cd aplikasi_ppdb
```

---

## 🚀 Cara Menjalankan Aplikasi

Pastikan environment Laravel sudah siap (PHP, Composer, dan database server). Lalu jalankan:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

---

## 💬 Penutup

Semangat untuk teman-teman kelas 12 RPL yang sedang mengerjakan **UKK 2526**! 💪
Kerjakan dengan teliti, update bagian _Progress Terakhir_ di README ini setiap ada fitur baru, dan jaga kerapihan kode agar mudah dipresentasikan dan dinilai dengan baik. 🚀
