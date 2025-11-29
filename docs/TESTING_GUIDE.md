# 🧪 TESTING GUIDE - Form Pengajuan Surat Dinamis

## Panduan Testing Lengkap untuk Memastikan Semua Berfungsi dengan Baik

---

## 📋 Pre-Testing Checklist

- [ ] Database sudah di-backup
- [ ] Migration sudah dijalankan (`php artisan migrate`)
- [ ] Server sudah berjalan (`php artisan serve`)
- [ ] Browser console buka (F12)
- [ ] Database dapat diakses

---

## 🧪 Test Case 1: Membuat Pengajuan Surat KUA

### Prerequisites
- User sudah login
- User sudah terverifikasi

### Test Steps

1. **Buka halaman form**
   - Navigasi ke "Pengajuan Surat" → "Ajukan Surat Baru"
   - ✅ Halaman load tanpa error

2. **Pilih jenis surat KUA**
   - Klik dropdown "Jenis Surat"
   - Pilih "Surat KUA (Kantor Urusan Agama)"
   - ✅ Field spesifik muncul:
     - Tujuan KUA (dropdown)
     - Nama Calon Mempelai (text)
     - Tanggal Pernikahan (date)
     - Nama Pasangan (text)

3. **Isi keperluan**
   - Keperluan: "Untuk mempersiapkan pernikahan dengan calon istri saya"
   - ✅ Text berhasil diinput

4. **Isi field spesifik KUA**
   - Tujuan KUA: Pilih "Nikah"
   - Nama Calon Mempelai: "Budi Santoso"
   - Tanggal Pernikahan: Hari esok (atau 2 bulan depan)
   - Nama Pasangan: "Siti Nurhaliza"
   - ✅ Semua field terisi dengan benar

5. **Upload surat pengantar**
   - Klik input file
   - Pilih file PDF/JPG (max 2MB)
   - ✅ File terpilih

6. **Submit form**
   - Klik tombol "Ajukan Surat"
   - ✅ Redirect ke halaman daftar pengajuan
   - ✅ Notification muncul: "Pengajuan surat berhasil dibuat dengan nomor: ..."

7. **Verifikasi data tersimpan**
   - Klik pengajuan yang baru dibuat
   - ✅ Halaman detail menampilkan:
     - Semua field KUA terisi dengan benar
     - Tanggal dalam format "DD F YYYY"

### Expected Results
✅ Semua data tersimpan di database dengan benar

---

## 🧪 Test Case 2: Membuat Pengajuan SKTM

### Test Steps

1. **Buka form create**
   - Navigasi ke form pengajuan surat baru

2. **Pilih jenis surat SKTM**
   - Klik dropdown "Jenis Surat"
   - Pilih "SKTM (Surat Keterangan Tidak Mampu)"
   - ✅ Field spesifik muncul:
     - Nama Penerima SKTM (text)
     - Alasan Tidak Mampu (textarea)
     - Keperluan SKTM (dropdown)

3. **Isi field**
   - Keperluan: "Untuk mengurus beasiswa pendidikan anak"
   - Nama Penerima SKTM: "Anak Budi Santoso"
   - Alasan Tidak Mampu: "Penghasilan keluarga tidak mencukupi karena ayah pengangguran"
   - Keperluan SKTM: "Beasiswa"
   - ✅ Semua field terisi

4. **Submit**
   - ✅ Data berhasil tersimpan

### Expected Results
✅ Data SKTM tersimpan dengan benar di field yang sesuai

---

## 🧪 Test Case 3: Validation Error Handling

### Test Steps

1. **Pilih jenis surat**
   - Pilih "Surat KUA"
   - ✅ Field muncul

2. **Submit form tanpa mengisi field required**
   - Kosongkan "Tujuan KUA"
   - Kosongkan "Nama Calon Mempelai"
   - Kosongkan "Keperluan"
   - Klik "Ajukan Surat"
   - ✅ Error validation muncul:
     - "Tujuan KUA harus dipilih"
     - "Nama Calon Mempelai wajib diisi"
     - "Keperluan harus diisi"

3. **Upload file yang salah format**
   - Klik input file
   - Pilih file .exe atau format tidak diizinkan
   - Klik "Ajukan Surat"
   - ✅ Error: "Format file harus PDF, JPG, JPEG, atau PNG"

4. **Upload file > 2MB**
   - Upload file PDF > 2MB
   - ✅ Error: "Ukuran file maksimal 2MB"

### Expected Results
✅ Semua validasi error ditampilkan dengan benar dan field tetap terisi

---

## 🧪 Test Case 4: Old Values Preservation

### Test Steps

1. **Isi form dengan beberapa error**
   - Pilih "Surat Domisili"
   - Isi "Keperluan": "Untuk pembukaan rekening bank"
   - Isi "Alamat Domisili": "Jl. Raya Candi No. 123"
   - Isi "RT": "001"
   - Isi "RW": "002"
   - Kosongkan "Status Rumah" (required field)
   - Submit form
   - ✅ Error validation muncul

2. **Verifikasi old values**
   - ✅ Field sebelumnya masih terisi:
     - Keperluan: "Untuk pembukaan rekening bank"
     - Alamat Domisili: "Jl. Raya Candi No. 123"
     - RT: "001"
     - RW: "002"
   - ✅ User tidak perlu re-input semua

3. **Fix error dan submit**
   - Pilih "Status Rumah": "Milik Sendiri"
   - Submit form
   - ✅ Data berhasil tersimpan

### Expected Results
✅ Old values preserved dan dapat diodit kembali

---

## 🧪 Test Case 5: Jenis Surat Switching

### Test Steps

1. **Mulai dengan Surat KUA**
   - Pilih "Surat KUA"
   - ✅ Field KUA muncul

2. **Isi beberapa field KUA**
   - Isi "Tujuan KUA": "Nikah"
   - Isi "Nama Calon Mempelai": "Budi"

3. **Switch ke jenis surat lain**
   - Klik dropdown "Jenis Surat"
   - Pilih "Surat Domisili"
   - ✅ Field KUA hilang
   - ✅ Field Domisili muncul
   - ✅ Field sebelumnya (Tujuan KUA) tidak ada di DOM

4. **Switch kembali ke KUA**
   - Klik dropdown "Jenis Surat"
   - Pilih "Surat KUA" kembali
   - ✅ Field KUA muncul kembali
   - ✅ Data yang sudah diisi hilang (expected behavior)

### Expected Results
✅ Form berhasil switch antar jenis surat tanpa error

---

## 🧪 Test Case 6: Display Detail Pengajuan

### Test Steps

1. **Buat pengajuan Surat Tanah**
   - Isi form dengan data lengkap:
     - Keperluan: "Untuk jual beli tanah"
     - Lokasi Tanah: "Jl. Merdeka RT 001 RW 002"
     - Luas Tanah: "250.50"
     - Status Tanah: "Milik"
     - Nomor Sertifikat: "123/2020/CANDI"
     - Deskripsi Tanah: "Tanah kosong dengan kondisi datar"
   - Submit

2. **Buka detail pengajuan**
   - Klik pengajuan yang baru dibuat
   - ✅ Halaman detail load

3. **Verifikasi display format**
   - ✅ "Luas Tanah" ditampilkan: "250.50 m²"
   - ✅ Tanggal dalam format: "DD F YYYY"
   - ✅ Semua field muncul dengan label yang benar

### Expected Results
✅ Detail pengajuan ditampilkan dengan format yang sesuai

---

## 🧪 Test Case 7: All 6 Surat Types

Ulangi test Case 1-2 untuk 4 jenis surat yang tersisa:

### 1. Surat Domisili
- [ ] Field: Alamat, RT, RW, Tanggal Mulai Tinggal, Status Rumah
- [ ] Data tersimpan dengan benar

### 2. Surat Keterangan Tanah
- [ ] Field: Lokasi, Luas, Status, No Sertifikat, Deskripsi
- [ ] Format luas ditampilkan dengan "m²"
- [ ] Data tersimpan

### 3. SKCK
- [ ] Field: Tujuan SKCK, Institusi Tujuan, Tanggal Dibutuhkan
- [ ] Data tersimpan

### 4. Surat Permohonan Bantuan
- [ ] Field: Jenis Bantuan, Jumlah, Latar Belakang, Prioritas
- [ ] Jumlah ditampilkan format currency "Rp. 5.000.000"
- [ ] Data tersimpan

### Expected Results
✅ Semua 6 jenis surat berfungsi dengan sempurna

---

## 🧪 Test Case 8: Browser Compatibility

### Test di berbagai browser:
- [ ] Chrome/Edge (latest)
- [ ] Firefox (latest)
- [ ] Safari (jika Mac)

### Test di berbagai ukuran layar:
- [ ] Desktop (1920x1080)
- [ ] Laptop (1366x768)
- [ ] Tablet (768x1024)
- [ ] Mobile (375x667)

### Expected Results
✅ Form responsif dan berfungsi di semua browser/ukuran

---

## 🧪 Test Case 9: Database Verification

### Gunakan Tinker untuk verify:
```bash
php artisan tinker

// Test 1: Ambil pengajuan terakhir
$latest = App\Models\PengajuanSurat::latest()->first();
$latest->jenis_surat; // Should show the type
$latest->tujuan_kua; // Should show if KUA
$latest->getFilledFields(); // Should show all filled fields

// Test 2: Check field tersimpan
$latest->nama_calon_mempelai; // "Budi Santoso"
$latest->luas_tanah; // 250.50

// Test 3: Check trait methods
$latest->formatFieldValue('tanggal_pernikahan', $latest->tanggal_pernikahan);
// Output: "15 January 2025"

$latest->isComplete(); // true/false

// Test 4: Get summary
$latest->getSummaryArray();
// Should show complete summary with formatted values
```

### Expected Results
✅ Semua data tersimpan dan dapat diakses dengan benar

---

## 🧪 Test Case 10: Migration Rollback

### Test rollback:
```bash
php artisan migrate:rollback

// Verify: tabel pengajuan_surats masih ada tapi field baru hilang
php artisan tinker
>>> Schema::getColumnListing('pengajuan_surats')

// Field yang ada: id, user_id, nomor_pengajuan, jenis_surat, keperluan, etc
// Field baru NOT ada: nama_calon_mempelai, luas_tanah, dll
```

### Migrate kembali:
```bash
php artisan migrate
```

### Expected Results
✅ Rollback & remigrate berfungsi tanpa error

---

## 📊 Test Summary Form

Gunakan form ini untuk dokumentasi hasil testing:

```
Test Case: [Nomor]
Title: [Judul Test]
Status: [PASS / FAIL]
Notes: [Catatan atau error jika ada]
Screenshots: [Link atau attachment]
Date: [DD-MM-YYYY]
Tester: [Nama]

PASS: 0/10
FAIL: 0/10
TOTAL: 10/10
```

---

## 🐛 Bug Report Template

Jika menemukan bug:

```
Title: [Deskripsi singkat bug]
Severity: [Critical / Major / Minor]
Steps to Reproduce:
1. ...
2. ...
3. ...

Expected Result:
...

Actual Result:
...

Browser/Device: [Info]
Screenshot: [Jika ada]
```

---

## ✅ Sign Off

Setelah semua test case PASS:

- [ ] Testing selesai
- [ ] Semua 10 test case PASS
- [ ] Database clean dan ready
- [ ] Documentation lengkap
- [ ] Production ready ✅

---

## 🚀 Go Live Checklist

Sebelum production deployment:

- [ ] Final database backup
- [ ] Last testing round di production environment
- [ ] Team member sign off
- [ ] Rollback plan prepared
- [ ] Monitoring setup (logs, errors)
- [ ] User notification ready
- [ ] Support team trained

---

## 📞 Support Contact

Jika ada issue selama testing:
- Check error di Laravel logs: `storage/logs/`
- Check browser console (F12)
- Review PANDUAN_FORM_DINAMIS.md
- Contact development team

---

**Happy Testing! 🎉**

Selamat melakukan testing sistem pengajuan surat dinamis. Pastikan semua test case PASS sebelum go live.
