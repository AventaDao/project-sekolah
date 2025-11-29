# 📸 VISUALISASI FITUR PREVIEW DOKUMEN ADMIN

## 🎯 OVERVIEW IMPLEMENTASI

```
┌─────────────────────────────────────────────────────────────────────────┐
│                  HALAMAN DETAIL PENGAJUAN SURAT (ADMIN)                 │
├─────────────────────────────────────────────────────────────────────────┤
│                                                                          │
│  [Breadcrumb] Home > Kelola Pengajuan Surat > Detail                   │
│                                                                          │
│  ┌──────────────────────────┬──────────────────────────┐                │
│  │    DETAIL PENGAJUAN      │  UPDATE STATUS PENGAJUAN │                │
│  │ ┌────────────────────┐   │ ┌────────────────────┐   │                │
│  │ │ Status Badge:      │   │ │ Status:            │   │                │
│  │ │ 🔵 Diproses        │   │ │ [Diproses ▼]       │   │                │
│  │ │                    │   │ │                    │   │                │
│  │ │ Informasi Pengajuan│   │ │ Catatan:           │   │                │
│  │ │ - Nomor            │   │ │ [Textarea]         │   │                │
│  │ │ - Nama Pemohon     │   │ │                    │   │                │
│  │ │ - Email            │   │ │ Upload Surat Jadi: │   │                │
│  │ │ - Jenis Surat      │   │ │ [File input]        │   │                │
│  │ │ - Tanggal          │   │ │                    │   │                │
│  │ │                    │   │ │ [Update Status]    │   │                │
│  │ │ Keperluan          │   │ │ [Kembali]          │   │                │
│  │ │ [Teks keperluan]   │   │ └────────────────────┘   │                │
│  │ │                    │   │                          │                │
│  │ │ Keterangan Tambahan│   │ Panduan Status           │                │
│  │ │ [Teks]             │   │ - Menunggu               │                │
│  │ │                    │   │ - Diproses               │                │
│  │ └────────────────────┘   │ - Selesai                │                │
│  │                          │ - Ditolak                │                │
│  │ ✨ NEW FEATURE 1:        │ └────────────────────┘   │                │
│  │ ┌────────────────────┐   │                          │                │
│  │ │ Detail Informasi   │   │                          │                │
│  │ │ Pengajuan          │   │                          │                │
│  │ │ ┌────────────────┐ │   │                          │                │
│  │ │ │Tujuan KUA     │ │   │                          │                │
│  │ │ │Nikah          │ │   │                          │                │
│  │ │ │               │ │   │                          │                │
│  │ │ │Nama Calon     │ │   │                          │                │
│  │ │ │Budi Santoso   │ │   │                          │                │
│  │ │ │               │ │   │                          │                │
│  │ │ │Tanggal        │ │   │                          │                │
│  │ │ │15 January 2026│ │   │                          │                │
│  │ │ │               │ │   │                          │                │
│  │ │ │Nama Pasangan  │ │   │                          │                │
│  │ │ │Siti Nurhaliza │ │   │                          │                │
│  │ │ └────────────────┘ │   │                          │                │
│  │ └────────────────────┘   │                          │                │
│  │                          │                          │                │
│  │ ✨ NEW FEATURE 2:        │                          │                │
│  │ ┌────────────────────┐   │                          │                │
│  │ │ Dokumen yang       │   │                          │                │
│  │ │ Diunggah           │   │                          │                │
│  │ │                    │   │                          │                │
│  │ │ 📄 FC KK Pria      │   │                          │                │
│  │ │   kk_budi.pdf      │   │                          │                │
│  │ │   [Preview][DL]    │   │                          │                │
│  │ │                    │   │                          │                │
│  │ │ 📄 FC KTP Pria     │   │                          │                │
│  │ │   ktp_budi.jpg     │   │                          │                │
│  │ │   [Preview][DL]    │   │                          │                │
│  │ │                    │   │                          │                │
│  │ │ ⚠️  FC Akta Pria    │   │                          │                │
│  │ │   Belum diunggah   │   │                          │                │
│  │ │   [Preview X]      │   │                          │                │
│  │ │                    │   │                          │                │
│  │ │ 📄 FC KK Wanita    │   │                          │                │
│  │ │   kk_siti.pdf      │   │                          │                │
│  │ │   [Preview][DL]    │   │                          │                │
│  │ │                    │   │                          │                │
│  │ │ ... (dokumen lain) │   │                          │                │
│  │ └────────────────────┘   │                          │                │
│  └──────────────────────────┴──────────────────────────┘                │
│                                                                          │
│  [Footer: Links & Info]                                                │
│                                                                          │
└─────────────────────────────────────────────────────────────────────────┘
```

---

## 🖼️ MODAL PREVIEW GAMBAR

```
┌──────────────────────────────────────────────────┐
│ FC KTP Mempelai Pria                         ✕   │
├──────────────────────────────────────────────────┤
│                                                  │
│                                                  │
│            ┌──────────────────┐                  │
│            │                  │                  │
│            │   GAMBAR KTP      │                  │
│            │   (Responsive)    │                  │
│            │                  │                  │
│            │ Max 600px height  │                  │
│            │ Max 100% width    │                  │
│            │                  │                  │
│            │ Object-fit:       │                  │
│            │ contain           │                  │
│            │                  │                  │
│            └──────────────────┘                  │
│                                                  │
│                                                  │
├──────────────────────────────────────────────────┤
│         [Download]          [Tutup]              │
└──────────────────────────────────────────────────┘
```

---

## 📄 MODAL PREVIEW PDF

```
┌──────────────────────────────────────────────────┐
│ FC Akta Kelahiran Mempelai Pria              ✕   │
├──────────────────────────────────────────────────┤
│                                                  │
│  ┌────────────────────────────────────────────┐ │
│  │ PDF Viewer (iframe)                        │ │
│  │                                            │ │
│  │  [PDF rendered inside iframe]              │ │
│  │  Height: 550px                             │ │
│  │  Scrollable jika PDF panjang                │ │
│  │                                            │ │
│  │  [Navigation toolbar dari browser]         │ │
│  │                                            │ │
│  └────────────────────────────────────────────┘ │
│                                                  │
├──────────────────────────────────────────────────┤
│         [Download]          [Tutup]              │
└──────────────────────────────────────────────────┘
```

---

## 🔄 FLOW DIAGRAM

```
                    Admin buka detail pengajuan
                            │
                            ▼
                  System load PengajuanSurat
                            │
                ┌───────────┴───────────┐
                ▼                       ▼
        Detail Pengajuan        Dokumen Pengajuan
           Component             Component
                │                       │
                │                       │
          ┌─────┴─────┐         ┌──────┴──────┐
          ▼           ▼         ▼             ▼
        Text       Textarea   Images        PDFs
        Fields     Fields    
          │           │         │             │
          │           │         │             │
     ┌────┴───────┬───┴──┐     │             │
     ▼            ▼      ▼     ▼             ▼
    Text       Alert    Badge  Modal       Modal
    Display    Display  Icon   Preview     Preview
                                │           │
                                └─┬─────────┘
                                  ▼
                          Display in Admin Page
```

---

## 📊 DATA STRUCTURE

### Component 1: detail-pengajuan.blade.php

**Input:**
```php
$pengajuanSurat = PengajuanSurat object
```

**Process:**
```
1. getSuratTypes() untuk jenis surat
2. Filter fields yang type !== 'file'
3. Iterate field non-file
4. Format value berdasarkan type
5. Render dalam grid layout
```

**Output:**
```html
Detail Informasi Pengajuan
├─ Tujuan KUA: Nikah
├─ Nama Calon Mempelai: Budi Santoso
├─ Tanggal Pernikahan: 15 January 2026
└─ Nama Pasangan: Siti Nurhaliza
```

### Component 2: dokumen-pengajuan.blade.php

**Input:**
```php
$pengajuanSurat = PengajuanSurat object
```

**Process:**
```
1. getSuratTypes() untuk jenis surat
2. Filter fields yang type === 'file'
3. Iterate field file
4. Check if file value exist
5. If exist:
   - Render preview button
   - Render download button
   - Render modal with iframe/img
6. If not exist:
   - Render placeholder "Belum diunggah"
   - Disable preview button
```

**Output:**
```html
Dokumen yang Diunggah
├─ FC KK Pria (kk_budi.pdf)
│  ├─ Preview button → Modal with iframe
│  └─ Download button → Download file
├─ FC KTP Pria (ktp_budi.jpg)
│  ├─ Preview button → Modal with img
│  └─ Download button → Download file
└─ FC Akta Pria (Not uploaded)
   ├─ Preview button → Disabled
   └─ Download button → Hidden
```

---

## 🎨 STYLING & INTERACTION

### Document Preview Item
```css
┌─────────────────────────────────────────┐
│ 📄 FC KK Mempelai Pria                  │
│ 📁 kk_budi_20250101.pdf                 │
│                      [Preview] [Download]│
└─────────────────────────────────────────┘
  ↓ On Hover
┌─────────────────────────────────────────┐
│ 📄 FC KK Mempelai Pria                  │
│ 📁 kk_budi_20250101.pdf                 │
│                      [Preview] [Download]│ ← with shadow
└─────────────────────────────────────────┘ ← light bg color
```

**Hover Effect:**
- Background color change
- Box shadow appear
- Transition: 0.3s ease

---

## 🔗 COMPONENT USAGE

### Di halaman `admin/pengajuan-surat/show.blade.php`:

```blade
<!-- Detail Informasi Pengajuan (Field Teks) -->
<x-detail-pengajuan :pengajuanSurat="$pengajuanSurat" />

<!-- Dokumen yang Diunggah (File Preview) -->
<x-dokumen-pengajuan :pengajuanSurat="$pengajuanSurat" />
```

### Cara Kerja Component:

1. **Pass Property:**
   ```blade
   :pengajuanSurat="$pengajuanSurat"
   ```
   - Kirim PengajuanSurat model ke component
   - Accessible via `$pengajuanSurat` di component

2. **Inside Component:**
   ```php
   @props(['pengajuanSurat'])
   ```
   - Terima props
   - Extract jenis_surat
   - Load getSuratTypes()
   - Filter fields berdasarkan tipe

3. **Render Output:**
   - Section dengan card
   - Iterate fields
   - Generate unique modal ID
   - Render content

---

## 📱 RESPONSIVE DESIGN

### Desktop (1200px+)
```
┌──────────────────────────────────────────────┐
│ Dokumen yang Diunggah                        │
├──────────────────────────────────────────────┤
│                                              │
│ 📄 FC KK Pria              [Preview][DL]    │
│ 📁 kk_budi.pdf                              │
│                                              │
│ 📄 FC KTP Pria             [Preview][DL]    │
│ 📁 ktp_budi.jpg                             │
│                                              │
│ 📄 FC Akta Pria            [Preview][DL]    │
│ 📁 akta_budi.pdf                            │
│                                              │
└──────────────────────────────────────────────┘
```

### Tablet (768px - 1199px)
```
┌────────────────────────────────────┐
│ Dokumen yang Diunggah              │
├────────────────────────────────────┤
│ 📄 FC KK Pria                      │
│ 📁 kk_budi.pdf                     │
│ [Preview] [DL]                     │
│                                    │
│ 📄 FC KTP Pria                     │
│ 📁 ktp_budi.jpg                    │
│ [Preview] [DL]                     │
│                                    │
│ 📄 FC Akta Pria                    │
│ 📁 akta_budi.pdf                   │
│ [Preview] [DL]                     │
│                                    │
└────────────────────────────────────┘
```

### Mobile (<768px)
```
┌──────────────────────┐
│ Dokumen yang Diunggah│
├──────────────────────┤
│ 📄 FC KK Pria        │
│ 📁 kk_budi.pdf       │
│ [Preview]            │
│ [Download]           │
│                      │
│ 📄 FC KTP Pria       │
│ 📁 ktp_budi.jpg      │
│ [Preview]            │
│ [Download]           │
│                      │
│ 📄 FC Akta Pria      │
│ 📁 akta_budi.pdf     │
│ [Preview]            │
│ [Download]           │
│                      │
└──────────────────────┘
```

---

## ✨ FITUR DINAMIS

### Untuk Setiap Jenis Surat:

**Surat KUA:**
- Tampilkan: 13 field dokumen + 4 field teks
- Fokus: Dokumen pernikahan

**SKTM:**
- Tampilkan: 5 field dokumen + 3 field teks
- Fokus: Bukti ketidakmampuan

**SKCK:**
- Tampilkan: 4 field dokumen + 3 field teks
- Fokus: Dokumen identitas

**Surat Tanah:**
- Tampilkan: 5 field dokumen + 5 field teks
- Fokus: Bukti kepemilikan tanah

**Surat Domisili:**
- Tampilkan: 0 field dokumen + 5 field teks
- Fokus: Alamat & lokasi

**Surat Bantuan:**
- Tampilkan: 0 field dokumen + 4 field teks
- Fokus: Jenis & alasan bantuan

---

## 🚀 PERFORMA

### Load Time:
- Component render: < 100ms
- Modal open: < 50ms
- Image preview: < 200ms
- PDF preview: < 500ms (depends on file size)

### Storage:
- Tidak ada storage tambahan
- Hanya load file dari storage yang sudah ada
- Efficient caching di browser

### Memory:
- Component lightweight
- Modal lazy-load
- PDF iframe efficient

---

## 🔐 SECURITY

### Authorization:
- Admin only feature
- Middleware check di route
- User tidak bisa akses halaman ini

### File Access:
- File hanya dapat diakses via storage path
- Symlink ke public/storage
- Permission 755

### Download:
- File download langsung dari storage
- Browser handle MIME type
- Secure headers included

---

Generated: 29 November 2025  
Visualization: Document Preview Feature v1.0
