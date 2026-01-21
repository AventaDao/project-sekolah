# � Sistem Informasi Desa Kedung Kendo

**https://docs.google.com/document/d/1wlX3q9g3f8YDE5FMyjcLWJfy4nE_BOBZ9NUEKhONGpI/edit?usp=sharing**

> **Aplikasi Web Manajemen Administrasi Desa dengan Fitur Pengajuan Surat Digital**

<p align="center">
<img src="https://img.shields.io/badge/Laravel-12.x-red" alt="Laravel Version">
<img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP Version">
<img src="https://img.shields.io/badge/Status-Active-green" alt="Status">
<img src="https://img.shields.io/badge/License-MIT-orange" alt="License">
</p>

---

## 📌 Tentang Aplikasi

**Sistem Informasi Desa Kedung Kendo** adalah platform digital yang dirancang untuk mempermudah layanan administrasi desa. Aplikasi ini memungkinkan masyarakat untuk mengajukan berbagai jenis surat desa secara online, upload dokumen pendukung, dan melacak status pengajuan mereka secara real-time.

### 🎯 Tujuan Utama

- **Digitalisasi Layanan:** Mengubah layanan administrasi manual menjadi digital
- **Efisiensi:** Mengurangi waktu antrian dan proses berbelit-belit
- **Transparansi:** Masyarakat dapat memantau status pengajuan kapan saja
- **Aksesibilitas:** Layanan dapat diakses 24/7 dari mana saja
- **Keamanan Data:** Melindungi data pribadi masyarakat dengan enkripsi

### 👥 Pengguna Sistem

| Pengguna | Hak Akses |
|----------|-----------|
| **Masyarakat (User)** | Daftar, login, ajukan surat, upload dokumen, download surat, lacak status |
| **Admin** | Kelola pengajuan, verifikasi dokumen, ubah status, unduh surat, manajemen pengguna |
| **Kepala Desa** | Tanda tangan digital, verifikasi surat selesai |

---

## 🔑 Fitur Utama

### 📄 Pengajuan Surat
- ✅ Jenis surat dinamis (dapat dikonfigurasi)
- ✅ Form dinamis sesuai jenis surat
- ✅ Upload dokumen pendukung (PDF, JPG, PNG)
- ✅ Real-time validation
- ✅ Nomor pengajuan otomatis

### 📑 Jenis Surat yang Didukung
- Surat Domisili
- Surat Keterangan Pendapatan
- Surat Nikah/Kawin
- Surat Izin Usaha
- Surat Keterangan Lainnya
- *Dan jenis surat lainnya sesuai kebutuhan desa*

### 👤 Manajemen Pengguna
- Registrasi self-service dengan verifikasi email
- Login dengan email atau NIK
- Social Authentication (Google, GitHub, dll)
- Profil pengguna lengkap (biodata penduduk)
- Two-factor authentication (opsional)

### 🔍 Tracking & Status
- Status real-time: Menunggu → Diproses → Selesai
- Notifikasi email otomatis
- History pengajuan lengkap
- QR Code verifikasi untuk keamanan

### 📊 Dashboard Admin
- Dashboard dengan statistik
- Daftar pengajuan dengan filter
- Bulk action untuk perubahan status
- Export laporan

### 📥 Preview & Download
- Preview PDF online sebelum download
- Download langsung sebagai file PDF
- Print-friendly layout
- QR code embedded untuk verifikasi

---

## 🛠 Tech Stack

| Komponen | Teknologi |
|----------|-----------|
| **Backend** | Laravel 12.x |
| **Frontend** | Blade Templates, Bootstrap 5, HTML5 |
| **Database** | MySQL 8.0+ |
| **PDF Generation** | DomPDF, html2pdf.js |
| **QR Code** | Endroid QR Code |
| **Authentication** | Laravel Auth, Socialite |
| **Storage** | Laravel Storage (Local/Cloud) |
| **Mailing** | Laravel Mail |
| **Icons** | Tabler Icons |

---

## 📦 Instalasi & Setup

### Prerequisites
```bash
- PHP 8.2+
- Composer
- MySQL 8.0+
- Node.js & NPM (untuk assets)
```

### 1. Clone Repository
```bash
git clone https://github.com/yourusername/sistem-desa.git
cd sistem-desa
```

### 2. Install Dependencies
```bash
composer install --ignore-platform-req=ext-grpc // pakai ini karena composer install biasa mengharuskan install dependensi grpc
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_desa
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations & Seeder
```bash
php artisan migrate --seed
```

### 6. Setup Storage Link
```bash
php artisan storage:link
```

### 7. Build Assets
```bash
npm run dev
# atau untuk production
npm run build
```

### 8. Jalankan Aplikasi
```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

---

## 📁 Struktur Folder

```
project-sekolah/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PengajuanSuratController.php    # Kelola pengajuan surat
│   │       ├── AuthController.php              # Autentikasi
│   │       ├── AdminController.php             # Admin dashboard
│   │       └── ...
│   ├── Models/
│   │   ├── PengajuanSurat.php                 # Model surat
│   │   ├── User.php                           # Model user
│   │   └── ...
│   └── Mail/
│       └── SuratSelesaiMail.php               # Email notification
│
├── resources/
│   ├── views/
│   │   ├── user/
│   │   │   └── pengajuan-surat/
│   │   │       ├── index.blade.php            # Daftar surat
│   │   │       ├── create.blade.php           # Form buat surat
│   │   │       ├── show.blade.php             # Detail surat
│   │   │       └── pdf-preview.blade.php      # Preview PDF
│   │   ├── admin/
│   │   │   └── pengajuan-surat/
│   │   ├── layouts/
│   │   └── ...
│   ├── css/
│   └── js/
│
├── database/
│   ├── migrations/                            # Database schema
│   └── seeders/                               # Sample data
│
├── routes/
│   └── web.php                                # Route definitions
│
├── config/
│   └── ...
│
└── storage/
    └── app/
        └── public/
            ├── pengajuan-surat-files/         # Upload surat pengantar
            └── surat-jadi/                    # Surat yang sudah diproses
```

---

## 🚀 Panduan Penggunaan

### Untuk Masyarakat

#### 1. Registrasi & Login
```
1. Buka halaman login
2. Klik "Belum punya akun? Daftar di sini"
3. Isi formulir registrasi dengan data lengkap
4. Verifikasi email
5. Login dengan email dan password
```

#### 2. Mengajukan Surat
```
1. Masuk ke Dashboard → Pengajuan Surat
2. Klik "Ajukan Surat Baru"
3. Pilih jenis surat yang diinginkan
4. Isi formulir sesuai jenis surat
5. Upload surat pengantar dari RW (wajib)
6. Klik "Ajukan"
7. Tunggu notifikasi status
```

#### 3. Lacak Status
```
1. Di halaman Pengajuan Surat, lihat status di kolom Status
2. Status: Menunggu → Diproses → Selesai
3. Ketika Selesai, klik tombol Download PDF
```

#### 4. Download Surat
```
1. Pastikan status surat adalah "Selesai"
2. Klik tombol Download (ikon unduh)
3. File PDF akan otomatis didownload
4. Cetak atau simpan sesuai kebutuhan
```

### Untuk Admin

#### 1. Login Admin
```
1. Login dengan akun admin
2. Akses menu Admin di dashboard
```

#### 2. Kelola Pengajuan
```
1. Klik Admin → Pengajuan Surat
2. Lihat daftar surat yang masuk
3. Klik detail untuk melihat dokumen
4. Ubah status dengan dropdown
5. Simpan perubahan
```

#### 3. Verifikasi Dokumen
```
1. Download dokumen pendukung
2. Cek kelengkapan data
3. Jika lengkap → Ubah status ke "Selesai"
4. Sistem akan mengirim notifikasi ke user
```

---

## 🔄 Alur Kerja Pengajuan Surat

```
┌─────────────────────────────────────────────────────────┐
│ MASYARAKAT                                              │
├─────────────────────────────────────────────────────────┤
│ 1. Isi form & upload dokumen                            │
│ 2. Klik "Ajukan"                                        │
│ 3. Tunggu notifikasi                                    │
└──────────────────┬──────────────────────────────────────┘
                   │ (Pengajuan masuk)
                   ↓
┌──────────────────────────────────────────────────────────┐
│ ADMIN                                                    │
├──────────────────────────────────────────────────────────┤
│ 1. Cek pengajuan status "Menunggu"                       │
│ 2. Verifikasi dokumen                                   │
│ 3. Ubah status ke "Selesai"                             │
│ 4. Sistem kirim email notifikasi                        │
└──────────────────┬───────────────────────────────────────┘
                   │ (Surat siap diambil)
                   ↓
┌──────────────────────────────────────────────────────────┐
│ MASYARAKAT                                               │
├──────────────────────────────────────────────────────────┤
│ 1. Terima notifikasi email                               │
│ 2. Login & lihat status "Selesai"                        │
│ 3. Klik Download PDF                                    │
│ 4. Terima file PDF surat                                │
└──────────────────────────────────────────────────────────┘
```

---

## 🔐 Fitur Keamanan

- ✅ Hash password dengan bcrypt
- ✅ CSRF Protection
- ✅ XSS Prevention
- ✅ SQL Injection Protection
- ✅ Role-based Access Control (RBAC)
- ✅ Encrypted file storage
- ✅ QR Code verification untuk dokumen
- ✅ Activity logging untuk audit trail

---

## 📧 Konfigurasi Email

Edit `.env` untuk konfigurasi email:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@desakedungkendo.id
MAIL_FROM_NAME="Desa Kedung Kendo"
```

---

## 📊 Database Schema (Ringkas)

### Tabel Utama

```sql
-- Users (Masyarakat)
CREATE TABLE users (
    id, email, password, nama_lengkap, nik, 
    tempat_lahir, tanggal_lahir, alamat, rt, rw,
    no_telepon, is_verified, role, timestamps
);

-- Pengajuan Surat
CREATE TABLE pengajuan_surats (
    id, user_id, jenis_surat, nomor_pengajuan,
    keperluan, keterangan_tambahan, status,
    file_surat_pengantar, file_surat_jadi,
    dynamic_fields (JSON), timestamps
);

-- Activity Log
CREATE TABLE activities (
    id, user_id, action, description, 
    model_type, model_id, timestamps
);
```

---

## 🐛 Troubleshooting

### ❌ Error: "SQLSTATE[HY000]: General error: 1030 Got error..."
**Solusi:** Pastikan database sudah dibuat dan permissions sudah benar
```bash
php artisan migrate:fresh --seed
```

### ❌ Error: "Class PengajuanSuratController not found"
**Solusi:** Clear cache
```bash
php artisan cache:clear
php artisan config:clear
```

### ❌ File upload tidak tersimpan
**Solusi:** Setup storage link
```bash
php artisan storage:link
chmod -R 755 storage/
```

### ❌ Email tidak terkirim
**Solusi:** Cek konfigurasi `.env` dan test dengan:
```bash
php artisan tinker
Mail::raw('Test email', fn($msg) => $msg->to('test@example.com'));
```

---

## 📚 Dokumentasi Lengkap

Untuk dokumentasi lebih detail, lihat folder `/docs`:

- [COMPLETE_PASSWORD_RESET_FIX.md](docs/COMPLETE_PASSWORD_RESET_FIX.md) - Reset password
- [NOTIFIKASI_EMAIL_SURAT_SELESAI.md](docs/NOTIFIKASI_EMAIL_SURAT_SELESAI.md) - Email notifications
- [PANDUAN_FORM_DINAMIS.md](docs/PANDUAN_FORM_DINAMIS.md) - Dynamic forms
- [SOCIAL_AUTH_REGISTRATION_COMPLETE.md](docs/SOCIAL_AUTH_REGISTRATION_COMPLETE.md) - Social login

---

## 🎨 Tampilan Aplikasi

### Fitur-fitur UI/UX:
- Modern gradient design
- Responsive mobile-first
- Dark/Light mode ready
- Smooth animations
- Accessible color scheme
- Clean and intuitive navigation

---

## 🔄 API Endpoints (Public)

```
POST   /register                    - Registrasi pengguna
POST   /login                       - Login
POST   /logout                      - Logout
GET    /pengajuan-surat             - Daftar surat user
POST   /pengajuan-surat             - Buat pengajuan surat
GET    /pengajuan-surat/:id         - Detail surat
GET    /pengajuan-surat/:id/print   - Preview PDF
DELETE /pengajuan-surat/:id         - Hapus pengajuan
```

---

## 📝 Panduan Kontribusi

1. Fork repository
2. Buat branch fitur baru (`git checkout -b feature/NamaFitur`)
3. Commit changes (`git commit -m 'Add feature'`)
4. Push ke branch (`git push origin feature/NamaFitur`)
5. Buat Pull Request

---

## ✅ Checklist Development

- [x] Setup Laravel project
- [x] Database design & migration
- [x] User authentication
- [x] Pengajuan surat module
- [x] Admin dashboard
- [x] Email notifications
- [x] PDF generation & download
- [x] Dynamic forms
- [x] File upload
- [x] Status tracking
- [ ] Mobile app version
- [ ] Payment gateway (optional)
- [ ] SMS notifications (optional)

---

## 📞 Support & Contact

**Hubungi Admin:**
- Email: admin@desakedungkendo.id
- WhatsApp: +62-XXX-XXXX-XXXX
- Lokasi: Desa Kedung Kendo, Kecamatan Candi, Kabupaten Sidoarjo

---

## 📄 Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE)

---

## 👨‍💻 Developer

Dibuat dengan ❤️ untuk kemajuan administrasi desa

**Last Updated:** 19 Januari 2026  
**Version:** 1.0.0  
**Status:** 🟢 Active & Maintained
