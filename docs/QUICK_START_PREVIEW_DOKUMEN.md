# QUICK START - TESTING PREVIEW DOKUMEN ADMIN

## 🎯 5 MENIT SETUP & TEST

### Step 1: Verify Files
```bash
# Check files sudah ada
ls -la resources/views/components/dokumen-pengajuan.blade.php
ls -la resources/views/components/detail-pengajuan.blade.php
ls -la resources/views/admin/pengajuan-surat/show.blade.php

# Semua harus ada & tidak error
php -l resources/views/components/dokumen-pengajuan.blade.php
php -l resources/views/components/detail-pengajuan.blade.php
php -l resources/views/admin/pengajuan-surat/show.blade.php
```

### Step 2: Ensure Storage Link
```bash
# Jika symlink belum ada
php artisan storage:link

# Verify symlink
ls -la public/storage
# Harus link ke storage/app/public
```

### Step 3: Login & Navigate
```
1. Start Laravel: php artisan serve
2. Browser: http://localhost:8000/dashboard
3. Login as admin
4. Navigate to: Admin > Kelola Pengajuan Surat
```

### Step 4: View Detail Pengajuan
```
1. Klik detail pengajuan yang ada dokumen
2. Scroll down
3. Verifikasi sections:
   ✓ "Detail Informasi Pengajuan" - Field teks ditampilkan
   ✓ "Dokumen yang Diunggah" - Dokumen file ditampilkan
```

---

## 📋 TESTING CHECKLIST

### A. Component detail-pengajuan.blade.php

- [ ] Field teks ditampilkan dengan label
- [ ] Value ditampilkan dengan format yang benar
- [ ] Date field format: "15 January 2026"
- [ ] Number field dengan separator: "2.500.000" atau "1.234,56 m²"
- [ ] Textarea ditampilkan dalam alert box
- [ ] Layout 6 kolom untuk field normal
- [ ] Layout 12 kolom untuk textarea
- [ ] Responsive di mobile

### B. Component dokumen-pengajuan.blade.php

- [ ] Card "Dokumen yang Diunggah" muncul
- [ ] File yang uploaded ditampilkan dengan icon
- [ ] File yang belum upload tampil dengan status "Belum diunggah"
- [ ] Tombol Preview muncul untuk file yang ada
- [ ] Tombol Preview disabled untuk file yang kosong
- [ ] Tombol Download muncul untuk file yang ada
- [ ] Tombol Download hidden untuk file yang kosong

### C. Modal Preview Image

- [ ] Klik Preview untuk gambar → modal muncul
- [ ] Gambar ditampilkan dengan ukuran responsive
- [ ] Modal bisa di-close dengan button atau X
- [ ] Download button di modal berfungsi
- [ ] File terdownload dengan nama yang benar

### D. Modal Preview PDF

- [ ] Klik Preview untuk PDF → modal muncul
- [ ] PDF ditampilkan dalam iframe
- [ ] Bisa scroll di dalam iframe jika PDF panjang
- [ ] Download button berfungsi
- [ ] File terdownload dengan nama yang benar

### E. Different Surat Types

Test dengan jenis surat berbeda:

**Surat KUA:**
- [ ] Tampil 4+ field teks (Tujuan, Nama Calon, Tanggal, Nama Pasangan)
- [ ] Tampil 8+ dokumen file (KK, KTP, Akta, Foto, dll)

**SKTM:**
- [ ] Tampil 3+ field teks (Nama, Alasan, Keperluan)
- [ ] Tampil 5+ dokumen file (KTP, KK, Foto Rumah, dll)

**SKCK:**
- [ ] Tampil 3+ field teks (Tujuan, Institusi, Tanggal)
- [ ] Tampil 4+ dokumen file (KTP, KK, Akta, Foto, dll)

**Surat Tanah:**
- [ ] Tampil 5+ field teks (Lokasi, Luas, Status, Sertifikat, Deskripsi)
- [ ] Tampil 5+ dokumen file (KTP, KK, NPWP, AJB, SPPT)

---

## 🔍 DEBUGGING

### Jika Component Tidak Muncul

```php
// Check 1: Syntax error di component?
php -l resources/views/components/dokumen-pengajuan.blade.php
php -l resources/views/components/detail-pengajuan.blade.php

// Check 2: Component registered di show.blade.php?
// Buka resources/views/admin/pengajuan-surat/show.blade.php
// Cari: <x-dokumen-pengajuan> & <x-detail-pengajuan>

// Check 3: Component namespace
// Component harus di: resources/views/components/
// Usage: <x-dokumen-pengajuan>
// Blade auto-convert ke: components/dokumen-pengajuan.blade.php
```

### Jika File Tidak Terlihat di Preview

```php
// Check 1: Storage path benar?
$pengajuanSurat = PengajuanSurat::find(1);
dd($pengajuanSurat->fc_ktp_pria);
// Harus: "uploads/pengajuan-surat/...../fc_ktp_pria.jpg"

// Check 2: File ada di disk?
php artisan tinker
> Storage::disk('public')->exists('uploads/pengajuan-surat/.../fc_ktp_pria.jpg')
// Harus return: true

// Check 3: Symlink ada?
ls -la public/storage
// Harus: lrwxrwxrwx -> storage/app/public

// Check 4: Asset path correct?
asset('storage/uploads/pengajuan-surat/.../fc_ktp_pria.jpg')
// Harus: /storage/uploads/pengajuan-surat/.../fc_ktp_pria.jpg
```

### Jika Modal Tidak Muncul

```php
// Check 1: Modal ID unik?
// Component auto-generate ID dari field name
// Format: previewModal[fieldNameWithoutSpecialChar]
// Debug: buka browser console, check HTML

// Check 2: Bootstrap JS loaded?
// Check di browser console:
> typeof bootstrap
// Harus: 'object'

// Check 3: Data attribute correct?
// Check di browser:
// button harus punya: data-bs-toggle="modal" data-bs-target="#previewModal..."
```

---

## 🧪 TESTING SCENARIOS

### Scenario 1: Admin View KUA Pengajuan Lengkap
```
GIVEN: Pengajuan KUA dengan semua dokumen & data lengkap
WHEN:  Admin buka halaman detail pengajuan
THEN:
  ✓ Semua 4 field teks tampil
  ✓ Semua 8 dokumen tampil dengan icon PDF/Image
  ✓ Preview button untuk semua dokumen aktif
  ✓ Download button untuk semua dokumen aktif
  ✓ Klik preview dokumen → modal muncul dengan preview
```

### Scenario 2: Admin View KUA Pengajuan Belum Lengkap
```
GIVEN: Pengajuan KUA dengan beberapa dokumen kosong
WHEN:  Admin buka halaman detail pengajuan
THEN:
  ✓ File yang ada tampil dengan preview & download
  ✓ File yang kosong tampil dengan status "Belum diunggah"
  ✓ Preview button untuk file kosong disabled
  ✓ Download button untuk file kosong hidden
```

### Scenario 3: Preview Gambar
```
GIVEN: File yang diupload adalah gambar (JPG/PNG)
WHEN:  Admin klik Preview
THEN:
  ✓ Modal terbuka
  ✓ Gambar ditampilkan dengan jelas
  ✓ Responsive layout
  ✓ Download button berfungsi
  ✓ Close button berfungsi
```

### Scenario 4: Preview PDF
```
GIVEN: File yang diupload adalah PDF
WHEN:  Admin klik Preview
THEN:
  ✓ Modal terbuka
  ✓ PDF ditampilkan dalam iframe
  ✓ Bisa scroll jika PDF panjang
  ✓ Download button berfungsi
  ✓ Close button berfungsi
```

### Scenario 5: Download File
```
GIVEN: File ada di storage
WHEN:  Admin klik Download
THEN:
  ✓ Browser trigger download
  ✓ Filename correct
  ✓ File size correct
  ✓ File integrity OK (tidak corrupt)
```

### Scenario 6: Different Surat Types
```
GIVEN: Beberapa pengajuan dengan jenis surat berbeda
WHEN:  Admin buka detail masing-masing
THEN:
  ✓ Detail field berbeda per surat
  ✓ Dokumen field berbeda per surat
  ✓ Component auto-adapt based on jenis_surat
  ✓ Tidak ada field dari surat lain yang tampil
```

---

## 📊 TEST RESULTS TEMPLATE

```markdown
# Test Results - Document Preview Feature

**Date:** [Date]
**Tester:** [Name]
**Environment:** [Dev/Staging/Production]

## Test Summary
| Category | Total | Pass | Fail | Status |
|----------|-------|------|------|--------|
| Component Render | 10 | 10 | 0 | ✅ |
| File Preview | 15 | 15 | 0 | ✅ |
| Modal Function | 8 | 8 | 0 | ✅ |
| Responsive | 6 | 6 | 0 | ✅ |
| **TOTAL** | **39** | **39** | **0** | **✅ PASS** |

## Test Cases

### detail-pengajuan.blade.php
- [x] Field teks ditampilkan
- [x] Date formatting correct
- [x] Number formatting correct
- [x] Layout responsive
- [x] Empty field handling

### dokumen-pengajuan.blade.php
- [x] File dengan value ditampilkan
- [x] File kosong tampil placeholder
- [x] Preview button state correct
- [x] Download button state correct
- [x] Icon berbeda per file type

### Modal Preview
- [x] Image preview works
- [x] PDF preview works
- [x] Modal close works
- [x] Download from modal works
- [x] Responsive layout

### Integration
- [x] Component render di show page
- [x] Data binding correct
- [x] No JS errors
- [x] No console errors
- [x] Cross-browser compatible

## Issues Found
(none)

## Conclusion
✅ **APPROVED FOR PRODUCTION**
```

---

## 🚀 DEPLOYMENT CHECKLIST

Pre-Production:
- [ ] Storage link created: `php artisan storage:link`
- [ ] Storage permission correct: `chmod 755 storage/`
- [ ] File permission correct: `chmod 644 storage/app/public/**/*`
- [ ] Components created in correct path
- [ ] show.blade.php updated with components
- [ ] No syntax errors: `php -l ...`
- [ ] Cache cleared: `php artisan view:clear`
- [ ] Config cached: `php artisan config:cache`

Production:
- [ ] All tests passed
- [ ] No pending issues
- [ ] Documentation complete
- [ ] Team trained on feature
- [ ] Monitoring setup
- [ ] Rollback plan ready

---

## 📞 SUPPORT

**Common Issues & Solutions:**

| Issue | Solution |
|-------|----------|
| Modal tidak muncul | Check Bootstrap JS loaded, Check modal ID unique |
| File tidak terlihat | Check storage link, Check file permission |
| Preview blank | Check file path, Check disk permission |
| Styling jelek | Check CSS loaded, Clear cache |
| Component error | Check component path, Check PHP version |

---

Generated: 29 November 2025  
Quick Start v1.0 - Ready to Test ✅
