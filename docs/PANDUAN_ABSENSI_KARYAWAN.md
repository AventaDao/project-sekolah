# 📋 Panduan Testing Sistem Absensi Karyawan

## ✅ Persiapan Selesai
- ✅ Migration (karyawans + absensis) sudah berjalan
- ✅ 3 karyawan test sudah dibuat via seeder
- ✅ Login karyawan sudah siap (NIK atau email)
- ✅ Storage link sudah aktif

## 🔑 Akun Karyawan Test

| Nama | Email | NIK | Password | Jabatan |
|------|-------|-----|----------|---------|
| Budi Santoso | budi@example.test | 1234567890 | secret | Staff |
| Siti Nurhaliza | siti@example.test | 1234567891 | secret | Admin |
| Ahmad Wijaya | ahmad@example.test | 1234567892 | secret | Manager |

## 🚀 Langkah Testing

### 1. Login Karyawan
```
URL: https://your-app.test/karyawan/login
- Identifier: 1234567890 (atau email: budi@example.test)
- Password: secret
- Klik "Login"
```

### 2. Absen Datang
```
URL: https://your-app.test/karyawan/absensi
- Pilih "Datang"
- Upload foto selfie (JPG/PNG)
- Jam: akan terisi otomatis dengan waktu sekarang
- Klik "Kirim Absensi"
```

### 3. Absen Pulang
```
- Ulangi step 2 tapi pilih "Pulang"
- Catatan: Hanya bisa absen 1x per jenis per hari
```

### 4. Lihat Status Hari Ini
```
Di halaman /karyawan/absensi akan ditampilkan:
- Badge "Sudah (HH:MM)" = absen tercatat
- Badge "Belum" = belum absen
```

### 5. Admin Lihat Laporan
```
Login sebagai Admin
URL: https://your-app.test/admin/absensi
- Daftar semua karyawan dengan status absensi hari ini
- Kolom: Nama, Jabatan, Datang, Pulang
- Badge berwarna: Hijau (Sudah) / Kuning (Belum)
```

## 📁 File yang Dibuat

```
app/Http/Controllers/
  ├── AbsensiController.php
  └── KaryawanAuthController.php

app/Models/
  ├── Karyawan.php
  └── Absensi.php

database/migrations/
  ├── 2025_11_19_000001_create_karyawans_table.php
  ├── 2025_11_19_000002_create_absensis_table.php

database/seeders/
  └── KaryawanSeeder.php

resources/views/
  ├── auth/
  │   └── karyawan-login.blade.php
  ├── admin/
  │   └── absensi/index.blade.php
  └── karyawan/
      └── absensi.blade.php

routes/web.php
  └── (update: tambah karyawan login routes)
```

## 🔐 Middleware & Proteksi

- `/karyawan/login` — guest only (bisa diakses tanpa login)
- `/karyawan/absensi` — protected dengan `middleware(['auth','cekRole:karyawan'])`
- `/admin/absensi` — protected dengan `middleware(['auth','cekRole:admin'])`

## 🛠 Database Schema

### Tabel: karyawans
```
id, user_id (FK), nama, jabatan, nik, telepon, created_at, updated_at
```

### Tabel: absensis
```
id, karyawan_id (FK), jenis (Datang/Pulang), foto, jam, tanggal (indexed), 
lokasi, catatan, created_at, updated_at
```

## ⚙️ Fitur Tambahan (Opsional)

1. **Reset Password** — Tambahkan "Lupa Password" untuk karyawan
2. **Export Absensi** — Laporan harian/bulanan (CSV/PDF)
3. **Notifikasi** — Email/SMS saat absen tercatat
4. **Geolocation** — Simpan GPS saat absen (untuk validasi lokasi)
5. **Mobile API** — JSON endpoint untuk mobile app

## 📝 Catatan

- Foto disimpan di `storage/app/public/absensi`
- Prevent duplicate: Karyawan tidak bisa absen jenis sama 2x dalam sehari
- Jam otomatis: Default ke waktu server (bisa diubah manual saat absen)
- NIK bisa login karena `KaryawanAuthController` mencari via `karyawans.nik`

---

**Status**: ✅ **SIAP DIGUNAKAN**
