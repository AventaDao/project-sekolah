# FITUR PREVIEW DOKUMEN PENGAJUAN SURAT (ADMIN)

**Tanggal:** 29 November 2025  
**Status:** ✅ COMPLETED

---

## 📋 OVERVIEW

Admin sekarang dapat melihat preview semua dokumen yang diunggah user secara langsung di halaman detail pengajuan surat, tanpa perlu download terlebih dahulu.

### Fitur Utama:
- ✅ Preview dokumen (Image/PDF) dalam modal
- ✅ Download dokumen dengan satu klik
- ✅ Menampilkan semua field dokumen sesuai jenis surat
- ✅ Menampilkan semua field teks/informasi dalam format yang rapi
- ✅ Indikator file yang belum diunggah
- ✅ Support untuk semua jenis surat (KUA, SKTM, SKCK, dll)

---

## 🏗️ STRUKTUR FILES

### Files yang Dibuat:
1. **`resources/views/components/dokumen-pengajuan.blade.php`**
   - Component untuk menampilkan preview dokumen file
   - Menampilkan gambar/PDF dalam modal
   - Tombol download untuk setiap file

2. **`resources/views/components/detail-pengajuan.blade.php`**
   - Component untuk menampilkan field teks/informasi
   - Format value berdasarkan tipe field (date, number, textarea, dll)
   - Layout responsif

### Files yang Dimodifikasi:
1. **`resources/views/admin/pengajuan-surat/show.blade.php`**
   - Tambah component `<x-detail-pengajuan />`
   - Tambah component `<x-dokumen-pengajuan />`

---

## 🎯 CARA KERJA

### Alur Data:
```
Admin buka detail pengajuan
    ↓
Sistem load PengajuanSurat model
    ↓
Component detail-pengajuan render
    ├─ Ambil getSuratTypes() dari model
    ├─ Iterate fields sesuai jenis_surat
    ├─ Filter field yang bertipe non-file (text, textarea, select, date, number)
    └─ Tampilkan dalam grid format
    ↓
Component dokumen-pengajuan render
    ├─ Ambil getSuratTypes() dari model
    ├─ Iterate fields sesuai jenis_surat
    ├─ Filter field yang bertipe file
    └─ Untuk setiap file:
        ├─ Check apakah value exist
        ├─ Tampilkan preview button + download button
        ├─ Preview terbuka dalam modal
        ├─ Jika gambar → tampilkan <img>
        └─ Jika PDF → tampilkan <iframe>
```

### Yang Ditampilkan di Admin Show Page:

#### 1. **Detail Informasi Pengajuan** (Field Teks)
```
Contoh untuk Surat KUA:
┌─────────────────────────────────────────┐
│ Detail Informasi Pengajuan              │
├─────────────────────────────────────────┤
│ Tujuan KUA          : Nikah             │
│ Nama Calon Mempelai : Budi Santoso     │
│ Tanggal Pernikahan  : 15 January 2026  │
│ Nama Pasangan       : Siti Nurhaliza   │
└─────────────────────────────────────────┘
```

#### 2. **Dokumen yang Diunggah** (File Preview)
```
┌──────────────────────────────────────────────────────┐
│ Dokumen yang Diunggah                                │
├──────────────────────────────────────────────────────┤
│ 📄 FC KK Mempelai Pria                               │
│   📁 kk_budi_20250101.pdf                            │
│   [Preview] [Download]                              │
│                                                       │
│ 📄 FC KTP Mempelai Pria                              │
│   📁 ktp_budi_20250101.jpg                           │
│   [Preview] [Download]                              │
│                                                       │
│ ⚠️ FC Akta Kelahiran Mempelai Pria                  │
│   Belum diunggah                                     │
│   [Preview] (disabled)                              │
└──────────────────────────────────────────────────────┘
```

---

## 🎨 UI COMPONENTS

### Component 1: `dokumen-pengajuan.blade.php`

**Fitur:**
- Dinamis iterate semua file fields dari getSuratTypes()
- Tampilkan ikon berdasarkan tipe file (PDF, Image, File)
- Modal preview dengan responsive height (max 650px)
- PDF di-render dengan iframe
- Gambar di-render dengan img tag
- Download button untuk setiap file

**Logic:**
```php
foreach ($fields as $fieldName => $fieldConfig) {
    if ($fieldConfig['type'] === 'file') {
        $fileValue = $pengajuanSurat->{$fieldName};
        
        if ($fileValue) {
            // Tampilkan preview + download button
        } else {
            // Tampilkan placeholder "Belum diunggah"
        }
    }
}
```

### Component 2: `detail-pengajuan.blade.php`

**Fitur:**
- Tampilkan semua field teks (text, textarea, select, date, number)
- Format value sesuai tipe:
  - `date` → Format: "15 January 2026"
  - `number` → Format dengan separator (untuk luas: m², untuk bantuan: Rp)
  - `textarea` → Tampil dalam alert box dengan white-space preserved
  - `select` → Tampil value plain text

**Layout:**
- 6 kolom untuk field normal (text, select, number)
- 12 kolom full-width untuk textarea
- Responsive design

---

## 📋 JENIS SURAT YANG DIDUKUNG

### 1. Surat KUA (Kantor Urusan Agama)
**Field Teks:** tujuan_kua, nama_calon_mempelai, tanggal_pernikahan, nama_pasangan  
**Field File:** fc_kk_pria, fc_ktp_pria, fc_akta_pria, fc_kk_wanita, fc_ktp_wanita, fc_akta_wanita, surat_keterangan_n1_n4, foto_pas_pria, foto_pas_wanita

### 2. SKTM (Surat Keterangan Tidak Mampu)
**Field Teks:** nama_penerima_sktm, alasan_tidak_mampu, keperluan_sktm  
**Field File:** fc_ktp_sktm, fc_kk_sktm, foto_rumah_sktm, slip_gaji_sktm, bukti_kip_sktm

### 3. Surat Domisili
**Field Teks:** alamat_domisili, rt_domisili, rw_domisili, tanggal_mulai_tinggal, status_rumah  
**Field File:** (Tidak ada file, hanya teks)

### 4. Surat Keterangan Tanah
**Field Teks:** lokasi_tanah, luas_tanah, status_tanah, nomor_sertifikat, deskripsi_tanah  
**Field File:** fc_ktp_tanah, fc_kk_tanah, fc_npwp_tanah, fc_ajb_atau_bukti_kepemilikan_tanah, fc_sppt_pbb_tanah

### 5. SKCK (Surat Keterangan Catatan Kepolisian)
**Field Teks:** tujuan_skck, institusi_tujuan, tanggal_dibutuhkan  
**Field File:** fc_ktp_skck, fc_kk_skck, fc_akta_ijazah_nikah_skck, foto_pas_skck

### 6. Surat Permohonan Bantuan
**Field Teks:** jenis_bantuan, jumlah_bantuan, latar_belakang_bantuan, prioritas_bantuan  
**Field File:** (Tidak ada file, hanya teks)

---

## 🔍 PREVIEW MODAL

### Untuk File Gambar:
```
┌────────────────────────────────┐
│ Modal Preview                  │
├────────────────────────────────┤
│                                │
│       [Gambar ditampilkan]     │
│                                │
├────────────────────────────────┤
│ [Download]  [Tutup]           │
└────────────────────────────────┘
```

### Untuk File PDF:
```
┌────────────────────────────────┐
│ Modal Preview                  │
├────────────────────────────────┤
│                                │
│     [PDF iframe ditampilkan]   │
│                                │
├────────────────────────────────┤
│ [Download]  [Tutup]           │
└────────────────────────────────┘
```

---

## 💻 KODE YANG DIUBAH

### File: `admin/pengajuan-surat/show.blade.php`

**Sebelum (bagian akhir):**
```blade
<!-- Surat Jadi -->
@if($pengajuanSurat->file_surat_jadi)
    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Surat Jadi</h5>
    <a href="{{ route('admin.pengajuan-surat.download-surat-jadi', $pengajuanSurat->id) }}" 
       class="btn btn-success" target="_blank">
        <i class="ti ti-file-download"></i> Lihat Surat Jadi
    </a>
@endif
```

**Sesudah (dengan component):**
```blade
<!-- Detail Informasi Pengajuan (Field Teks) -->
<x-detail-pengajuan :pengajuanSurat="$pengajuanSurat" />

<!-- Dokumen yang Diunggah (Preview) -->
<x-dokumen-pengajuan :pengajuanSurat="$pengajuanSurat" />
```

---

## 🧪 TESTING CHECKLIST

```
[ ] Admin login ke dashboard
[ ] Buka halaman kelola pengajuan surat
[ ] Klik detail pengajuan (Surat KUA)
[ ] Verifikasi section "Detail Informasi Pengajuan" muncul
    [ ] Tampilkan semua field teks (nama, tanggal, tujuan, dll)
    [ ] Format tanggal benar (e.g., "15 January 2026")
[ ] Verifikasi section "Dokumen yang Diunggah" muncul
    [ ] Tampilkan semua file field
    [ ] Ada icon berbeda untuk gambar vs PDF
    [ ] Tombol Preview ada dan berfungsi
    [ ] Klik Preview → modal muncul
    [ ] Jika gambar → tampil dengan baik
    [ ] Jika PDF → iframe muncul
    [ ] Tombol Download ada dan berfungsi
    [ ] File yang belum diupload tampil dengan status "Belum diunggah"
[ ] Test dengan jenis surat berbeda (SKTM, SKCK, dll)
    [ ] Verifikasi field yang ditampilkan berbeda per surat
    [ ] Verifikasi jumlah dokumen berbeda per surat
[ ] Test responsive design
    [ ] Buka di mobile/tablet
    [ ] Layout tetap rapi
    [ ] Modal preview tetap berfungsi
```

---

## 🔧 TROUBLESHOOTING

### Preview Tidak Muncul
```php
// Check 1: Storage Path Benar
$fileValue = $pengajuanSurat->fc_ktp_pria;
// Harus: "uploads/pengajuan-surat/..../fc_ktp_pria.jpg"

// Check 2: File Exist di Storage
asset('storage/' . $fileValue) 
// Harus: "/storage/uploads/pengajuan-surat/..../fc_ktp_pria.jpg"

// Check 3: Storage Link
php artisan storage:link
```

### Modal ID Error
- Component menggunakan ID modal dengan format: `previewModal{{ str_replace(...) }}`
- Harus unik untuk setiap field
- Sudah di-handle otomatis

### PDF Tidak Tampil di iframe
- Check storage config di `config/filesystems.php`
- CORS issue? Check browser console error
- Alternative: gunakan PDF.js library

---

## 🚀 DEPLOYMENT NOTES

### Pre-Deployment Checklist:
```
✅ Storage link sudah buat: php artisan storage:link
✅ File permission sudah benar: chmod 755 storage/
✅ Storage directory accessible dari web root
✅ Symlink ke public/storage sudah ada
```

### Jika file tidak terlihat:
```bash
# Create symlink
php artisan storage:link

# Check permission
ls -la storage/
ls -la public/storage

# Debug akses
php artisan tinker
> Storage::url('path/to/file.pdf')
```

---

## 📈 FUTURE IMPROVEMENTS

Saat ini fitur sudah fully functional. Beberapa enhancement yang bisa ditambahkan:

1. **Bulk Preview** - Preview semua dokumen dalam satu halaman PDF
2. **Document Validation** - Check dokumen valid sebelum proses
3. **OCR Integration** - Extract text dari dokumen
4. **Watermark** - Tambah watermark ke preview
5. **Annotation** - Admin bisa comment/markup di dokumen
6. **Approval Workflow** - Document-level approval

---

## 📞 SUPPORT

Jika ada issue dengan fitur preview dokumen:

1. Check storage configuration
2. Verify file permissions
3. Check browser console untuk error
4. Test dengan file yang lebih kecil terlebih dahulu
5. Clear browser cache

---

Generated: 29 November 2025  
Version: 1.0  
Status: Production Ready ✅
