# Debug Email Notifikasi - Panduan Troubleshooting

## Checklist Debugging

### 1. Verifikasi Konfigurasi Email
```bash
php artisan config:show mail
```

**Expected output:**
- `mailers.smtp.host` = `smtp.gmail.com`
- `mailers.smtp.port` = `587`
- `mailers.smtp.username` = `daoadhalia@gmail.com`
- `from.address` = `daoadhalia@gmail.com`

### 2. Test SMTP Connection
```bash
php artisan tinker
```

```php
// Test send email
Mail::raw('Test email body', function($message) {
    $message->to('test@example.com');
});
```

**Expected:** Harus mengembalikan `SentMessage object`

### 3. Verifikasi Data di Database
```bash
php artisan tinker
```

```php
// Cek surat dengan status Selesai
PengajuanSurat::where('status', 'Selesai')->with('user')->latest()->first()

// Hasilnya harus menunjukkan:
// - nomor_pengajuan
// - status = "Selesai"
// - user.email (PENTING!)
```

### 4. Test Send Email Manual
Di browser, akses:
```
GET /debug-email-setup
```
Harus menunjukkan SMTP configuration loaded successfully

```
POST /debug-send-email/{id}
```
Ganti {id} dengan ID surat yang status Selesai. Harus return success.

### 5. Cek Log File
```bash
tail -f storage/logs/laravel.log
```

**Cari patterns:**
- ✓ "Email notifikasi surat selesai berhasil dikirim"
- ✗ "Failed to send email notification"
- "isChangingToSelesai" (seharusnya true saat status berubah ke Selesai)

## Masalah Umum & Solusi

### Problem 1: Email Tidak Terkirim Saat Admin Update Status

**Kemungkinan penyebab:**
1. User tidak punya email di database
2. Status surat sudah "Selesai" sebelumnya
3. Gmail requires "Less Secure Apps" enabled
4. SMTP credentials salah

**Solusi:**
```bash
# Cek user punya email
php artisan tinker
>>> User::find(3)->email

# Cek status surat
>>> PengajuanSurat::find(2)->status

# Cek logs
>>> tail -f storage/logs/laravel.log
```

### Problem 2: "Email notifikasi surat selesai berhasil dikirim" tapi email tidak masuk inbox

**Kemungkinan penyebab:**
1. Email masuk folder spam/junk
2. Gmail blocks 3rd party apps (non-SMTP)
3. Gmail "Less Secure Apps" harus diaktifkan

**Solusi:**

#### Untuk Gmail:
1. Login ke https://myaccount.google.com/
2. Buka "Security" (Keamanan)
3. Scroll ke bawah, cari "Less secure app access"
4. Toggle ON

**atau**

Gunakan Gmail App Password (lebih aman):
1. Enable 2FA di Google Account
2. Generate App Password di https://myaccount.google.com/apppasswords
3. Ganti `MAIL_PASSWORD` di `.env` dengan App Password

### Problem 3: Logs menunjukkan "isChangingToSelesai: false"

**Penyebab:** Status surat sudah "Selesai" sebelumnya

**Solusi:** 
- Buat pengajuan surat baru dengan status awal "Diproses"
- Baru ubah status menjadi "Selesai"
- Email akan dikirim pada perubahan PERTAMA saja

## Routes untuk Testing

### 1. Check SMTP Configuration
```
GET /debug-email-setup
```

**Response:**
```json
{
  "MAIL_MAILER": "smtp",
  "MAIL_HOST": "smtp.gmail.com",
  "MAIL_PORT": 587,
  "MAIL_USERNAME": "daoadhalia@gmail.com",
  "Status": "SMTP Configuration loaded successfully"
}
```

### 2. Get Last Selesai Surat
```
GET /debug-last-email
```

**Response:**
```json
{
  "nomor_pengajuan": "SRT/2026/01/0002",
  "jenis_surat": "Surat Domisili",
  "user_email": "daoadhalia@gmail.com",
  "status": "Selesai",
  "tanggal_selesai": "2026-01-13 08:19:56"
}
```

### 3. Test Send Email
```
POST /debug-send-email/{id}
```

Ganti `{id}` dengan ID pengajuan surat

**Response jika berhasil:**
```json
{
  "success": true,
  "message": "Email berhasil dikirim",
  "details": {
    "to": "daoadhalia@gmail.com",
    "subject": "Surat Domisili Anda Sudah Selesai - SRT/2026/01/0002"
  }
}
```

### 4. Preview Email Template
```
GET /test-email-preview/{id}
```

Akan menampilkan HTML email di browser

## Proses Debugging Step-by-Step

### Step 1: Pastikan SMTP bekerja
```bash
php artisan tinker
>>> Mail::raw('Test', fn($m) => $m->to('test@example.com'))
# Harus return SentMessage object
```

### Step 2: Cek surat dengan status Selesai ada
```bash
>>> PengajuanSurat::where('status', 'Selesai')->count()
# Harus > 0
```

### Step 3: Test send email langsung
```bash
curl -X POST "http://localhost:8000/debug-send-email/2" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Step 4: Buat surat baru dan ubah status ke Selesai
- Di admin panel, buat pengajuan baru (akan status "Diproses")
- Ubah status ke "Selesai"
- Lihat log file:
```bash
tail -f storage/logs/laravel.log
```

Harus ada message:
- "Update status pengajuan surat" dengan `isChangingToSelesai: true`
- "✓ Email notifikasi surat selesai berhasil dikirim" **atau** "✗ Failed to send email"

## Logs Pattern untuk Cari

### Email Berhasil Dikirim
```
[2026-01-13 ...] local.INFO: ✓ Email notifikasi surat selesai berhasil dikirim 
{"nomor_pengajuan":"SRT/2026/01/0002","ke_email":"daoadhalia@gmail.com"}
```

### Email Gagal Dikirim
```
[2026-01-13 ...] local.ERROR: ✗ Failed to send email notification 
{"nomor_pengajuan":"SRT/2026/01/0002",...,"error":"...error message..."}
```

## Testing Checklist

- [ ] SMTP configuration loaded (GET /debug-email-setup)
- [ ] Ada surat dengan status "Selesai" (GET /debug-last-email)
- [ ] Test send email berhasil (POST /debug-send-email/{id})
- [ ] Check logs ada message email terkirim
- [ ] Cek email masuk (atau folder spam)
- [ ] Buat surat baru, ubah status ke Selesai
- [ ] Check logs ada update status + email dikirim
- [ ] Verifikasi email diterima

## Quick Fix Checklist

Jika email masih tidak masuk:

- [ ] Cek `.env` - `MAIL_PASSWORD` benar?
- [ ] Gmail "Less Secure Apps" enabled?
- [ ] Email masuk folder spam/junk?
- [ ] User di database punya email?
- [ ] Surat status "Diproses" sebelum di-update ke "Selesai"?
- [ ] Cek logs ada error? (tail -f storage/logs/laravel.log)

## Summary

✅ Email sistem **sudah berfungsi** (tested dengan tinker)
✅ Controller logic **sudah benar** (log akan menunjukkan step-step)
✅ Routes debugging **sudah tersedia** untuk troubleshooting
✅ Pastikan saat update status pertama kali ke "Selesai" - email pasti dikirim
