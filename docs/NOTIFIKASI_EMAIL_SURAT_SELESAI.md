# Email Notifikasi Surat Selesai

## Fitur yang Ditambahkan

Sistem sekarang akan **otomatis mengirimkan email notifikasi** kepada user ketika surat mereka selesai disetujui oleh admin.

### Komponen yang Dibuat:

1. **Mailable Class**: `app/Mail/SuratSelesaiMail.php`
   - Menangani pembuatan email dan pengiriman
   - Menerima object PengajuanSurat

2. **Email Template**: `resources/views/emails/surat-selesai.blade.php`
   - Template HTML yang responsif
   - Desain professional seperti balasan support
   - Menampilkan detail surat dan catatan admin
   - Tombol CTA untuk download surat

3. **Controller Update**: `app/Http/Controllers/PengajuanSuratController.php`
   - Method `updateStatus()` diperbaharui
   - Email dikirim otomatis saat status berubah ke "Selesai"
   - Error handling agar tidak menggagalkan process

## Konfigurasi Email (Sudah Aktif)

Email sudah dikonfigurasi menggunakan Gmail SMTP:
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=daoadhalia@gmail.com
MAIL_FROM_NAME="Sistem Informasi Desa - Kedung Kendo"
```

## Alur Kerja

1. **Admin** memilih surat yang sudah selesai dikerjakan
2. **Admin** mengubah status menjadi "Selesai" dan upload file surat
3. **Sistem** otomatis:
   - Menyimpan data di database
   - Mengiriman email notifikasi ke email user
4. **User** menerima email dengan:
   - Notifikasi surat sudah selesai
   - Detail nomor pengajuan, jenis surat, tanggal selesai
   - Catatan dari admin (jika ada)
   - Tombol untuk langsung download surat

## Testing Email

### Test 1: Manual Testing di Admin Panel
1. Login sebagai admin
2. Buka detail pengajuan surat dengan status "Diproses"
3. Ubah status menjadi "Selesai"
4. Upload file surat jadi
5. Klik Submit
6. **Expected**: Email terkirim ke user

### Test 2: Cek Email Masuk
- Buka email user yang menerima notifikasi
- Verifikasi layout email sesuai (responsive & profesional)
- Klik tombol "Lihat & Unduh Surat" dan verifikasi linknya bekerja

### Test 3: Check Error Log (Jika Email Gagal)
```bash
tail -f storage/logs/laravel.log
```

## Troubleshooting

### Email Tidak Terkirim?

1. **Check SMTP Credentials**
   ```bash
   # Test dengan artisan tinker
   php artisan tinker
   >>> Mail::raw('Test', function($message) { $message->to('email@example.com'); });
   ```

2. **Gmail Less Secure Apps**
   - Pastikan "Less secure app access" diaktifkan di Google Account
   - Atau gunakan App Password jika 2FA aktif

3. **Check Logs**
   ```bash
   tail -f storage/logs/laravel.log
   ```

4. **Verifikasi .env**
   ```
   MAIL_USERNAME dan MAIL_PASSWORD harus benar
   MAIL_FROM_ADDRESS harus sesuai dengan MAIL_USERNAME
   ```

## Customization

### Mengubah Template Email
Edit `resources/views/emails/surat-selesai.blade.php`

### Mengubah Kondisi Pengiriman
Edit `app/Http/Controllers/PengajuanSuratController.php` method `updateStatus()`:
```php
if ($validated['status'] === 'Selesai' && $pengajuanSurat->status !== 'Selesai') {
    // Email hanya dikirim saat pertama kali status berubah ke Selesai
}
```

### Mengubah Subject Email
Edit `app/Mail/SuratSelesaiMail.php` method `envelope()`:
```php
subject: 'Surat ' . $this->pengajuanSurat->jenis_surat . ' Anda Sudah Selesai'
```

## Fitur Tambahan (Opsional)

### Menambah Email Preview
Untuk preview email di development, tambahkan di `routes/web.php`:
```php
Route::get('/test-email/{id}', function ($id) {
    $pengajuanSurat = \App\Models\PengajuanSurat::find($id);
    return new \App\Mail\SuratSelesaiMail($pengajuanSurat);
})->middleware('auth');
```

### Menambah Queue untuk Email
Jika performa menjadi masalah, enable queue:
```bash
php artisan queue:work
```

Update di `SuratSelesaiMail.php`:
```php
class SuratSelesaiMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
}
```

## Summary

✅ Email notifikasi **sudah terintegrasi penuh**
✅ Template profesional **sudah siap pakai**
✅ Error handling **sudah diterapkan**
✅ SMTP Gmail **sudah dikonfigurasi**

**Fitur siap untuk production!**
