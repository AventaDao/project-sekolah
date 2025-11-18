# 📋 Implementasi Form Pengajuan Surat Dinamis

## 🎯 Ringkasan

Sistem pengajuan surat telah diperbarui dengan form yang **dinamis berdasarkan jenis surat**. Setiap jenis surat memiliki field spesifik yang sesuai dengan kebutuhan administrasi.

---

## ✅ Checklist Implementasi

### File yang Dimodifikasi:
- ✅ `app/Models/PengajuanSurat.php` - Update model dengan field baru dan method dinamis
- ✅ `app/Http/Controllers/PengajuanSuratController.php` - Update controller dengan validasi dinamis
- ✅ `resources/views/user/pengajuan-surat/create.blade.php` - Update form dengan JavaScript dinamis
- ✅ `resources/views/user/pengajuan-surat/show.blade.php` - Tambah display field dinamis

### File yang Dibuat:
- ✅ `database/migrations/2025_11_17_create_pengajuan_surat_fields.php` - Migrasi database
- ✅ `database/seeders/PengajuanSuratDemoSeeder.php` - Demo data
- ✅ `app/Traits/FormatPengajuanSurat.php` - Trait untuk formatting
- ✅ `PANDUAN_FORM_DINAMIS.md` - Dokumentasi lengkap

---

## 🚀 Instalasi & Setup

### Step 1: Jalankan Migration
```bash
php artisan migrate
```

Ini akan menambahkan field baru ke tabel `pengajuan_surats`:
- Field untuk Surat KUA
- Field untuk SKTM
- Field untuk Surat Domisili
- Field untuk Surat Keterangan Tanah
- Field untuk SKCK
- Field untuk Surat Permohonan Bantuan

### Step 2: Opsional - Seeding Demo Data
```bash
php artisan db:seed --class=PengajuanSuratDemoSeeder
```

Ini akan membuat 6 contoh pengajuan surat dengan berbagai jenis untuk testing.

### Step 3: Test Form

1. Login ke aplikasi
2. Buka halaman "Pengajuan Surat" → "Ajukan Surat Baru"
3. Pilih jenis surat dari dropdown
4. Amati field yang muncul sesuai jenis surat yang dipilih
5. Isi form dan submit

---

## 📋 Jenis-Jenis Surat yang Didukung

### 1. **Surat KUA** (Kantor Urusan Agama)
- Untuk pernikahan, rujuk, pembatalan pernikahan
- **Field Tambahan**: Tujuan, Nama Calon Mempelai, Tanggal Pernikahan, Nama Pasangan

### 2. **SKTM** (Surat Keterangan Tidak Mampu)
- Untuk beasiswa, bantuan sosial, keringanan biaya
- **Field Tambahan**: Nama Penerima, Alasan, Keperluan

### 3. **Surat Domisili**
- Untuk administrasi dan verifikasi alamat tinggal
- **Field Tambahan**: Alamat, RT, RW, Tanggal Mulai Tinggal, Status Rumah

### 4. **Surat Keterangan Tanah**
- Untuk jual beli, waris, administrasi tanah
- **Field Tambahan**: Lokasi, Luas, Status, Nomor Sertifikat, Deskripsi

### 5. **SKCK** (Surat Keterangan Catatan Kepolisian)
- Untuk melamar pekerjaan, sekolah, izin usaha
- **Field Tambahan**: Tujuan, Institusi Tujuan, Tanggal Dibutuhkan

### 6. **Surat Permohonan Bantuan**
- Untuk bantuan sosial, renovasi, kesehatan, pendidikan, bencana
- **Field Tambahan**: Jenis Bantuan, Jumlah, Latar Belakang, Prioritas

---

## 🎨 Fitur Utama

### ✨ Form Dinamis
```
User memilih jenis surat
        ↓
JavaScript menampilkan field spesifik
        ↓
User mengisi data
        ↓
Server validasi dinamis
        ↓
Data tersimpan di database
```

### 🔍 JavaScript Otomatis
- Ketika pilihan jenis surat berubah, field yang ditampilkan otomatis berubah
- Old values dipilih kembali jika ada error validasi
- Error message ditampilkan per field

### 📝 Tipe Field yang Didukung
- **Text**: Input teks biasa
- **Number**: Input angka
- **Date**: Datepicker
- **Textarea**: Text area multiline
- **Select**: Dropdown dengan pilihan

---

## 💻 Contoh Penggunaan di Controller

```php
// Mengambil semua jenis surat
$suratTypes = PengajuanSurat::getSuratTypes();

// Mengambil field untuk jenis surat tertentu
$fields = PengajuanSurat::getFieldsForSuratType('Surat KUA');

// Menggunakan trait untuk format data
$pengajuan = PengajuanSurat::find(1);
echo $pengajuan->formatFieldValue('tanggal_pernikahan', '2025-01-15');
// Output: 15 January 2025

// Mendapatkan field yang terisi
$filledFields = $pengajuan->getFilledFields();

// Check kelengkapan data
if ($pengajuan->isComplete()) {
    // Semua field required sudah diisi
}
```

---

## 📊 Database Schema

Tabel `pengajuan_surats` sekarang memiliki struktur:

```
id: integer (primary key)
user_id: integer (foreign key)
nomor_pengajuan: string
jenis_surat: string
keperluan: text
surat_pengantar_rw: string (file path)
keterangan_tambahan: text
status: string (Menunggu|Diproses|Selesai|Ditolak)
catatan_admin: text
file_surat_jadi: string (file path)
tanggal_selesai: timestamp

// Field Surat KUA
nama_calon_mempelai: string | null
tanggal_pernikahan: date | null
nama_pasangan: string | null
tujuan_kua: string | null

// Field SKTM
nama_penerima_sktm: string | null
alasan_tidak_mampu: text | null
keperluan_sktm: string | null

// Field Surat Domisili
alamat_domisili: string | null
rt_domisili: string | null
rw_domisili: string | null
tanggal_mulai_tinggal: date | null
status_rumah: string | null

// Field Surat Keterangan Tanah
deskripsi_tanah: text | null
lokasi_tanah: string | null
luas_tanah: decimal(8,2) | null
status_tanah: string | null
nomor_sertifikat: string | null

// Field SKCK
tujuan_skck: string | null
institusi_tujuan: string | null
tanggal_dibutuhkan: date | null

// Field Surat Permohonan Bantuan
jenis_bantuan: string | null
jumlah_bantuan: decimal(12,2) | null
latar_belakang_bantuan: text | null
prioritas_bantuan: string | null

created_at: timestamp
updated_at: timestamp
```

---

## 🎯 Frontend - JavaScript Behavior

### Event Handler
```javascript
// Ketika jenis surat berubah
document.getElementById('jenisSurat').addEventListener('change', updateFormFields);

// Function ini:
// 1. Ambil konfigurasi field dari suratTypes
// 2. Generate HTML input berdasarkan tipe field
// 3. Tampilkan error jika ada dari server
// 4. Restore old values jika ada
```

### Data yang Dikirim ke View
```javascript
const suratTypes = {
    'Surat KUA': {
        label: '...',
        deskripsi: '...',
        fields: {
            tujuan_kua: { label: '...', type: 'select', ... },
            ...
        }
    },
    ...
}

const oldValues = { jenis_surat: 'Surat KUA', ... }
const errors = { tujuan_kua: ['Error message'] }
```

---

## 🔒 Validasi

### Backend Validation
```php
// Validasi dinamis berdasarkan jenis surat
foreach ($fields as $fieldName => $fieldConfig) {
    $rule = $fieldConfig['required'] ? 'required' : 'nullable';
    
    // Tambah rule berdasarkan tipe
    if ($fieldConfig['type'] === 'date') {
        $rule .= '|date|after:today';
    }
    // ... rule lainnya
    
    $rules[$fieldName] = $rule;
}

$validated = $request->validate($rules);
```

---

## 📱 Responsive Design

Form sudah responsive dan bekerja baik di:
- Desktop
- Tablet
- Mobile

---

## 🐛 Troubleshooting

### Masalah: Field tidak muncul setelah pilih jenis surat

**Solusi**:
1. Cek browser console (F12 → Console tab)
2. Pastikan JavaScript tidak ada error
3. Verifikasi data `suratTypes` sudah ter-embed di view

```blade
<script>
    const suratTypes = @json($suratTypes);
    console.log(suratTypes); // Debug
</script>
```

### Masalah: Error validasi tidak ditampilkan

**Solusi**:
1. Pastikan server mengirim error dengan benar
2. Check Laravel validation di Controller
3. Verifikasi error ditampilkan di HTML:

```blade
@if(errors.fieldName)
    // Error message muncul
@endif
```

### Masalah: Data tidak tersimpan

**Solusi**:
1. Cek migration sudah dijalankan: `php artisan migrate:status`
2. Verifikasi field ada di `$fillable` Model
3. Check database punya kolom yang sesuai:

```bash
php artisan tinker
>>> Schema::getColumnListing('pengajuan_surats')
```

---

## 📚 File Referensi

- **Model**: `app/Models/PengajuanSurat.php` - Definisi jenis surat & validasi
- **Controller**: `app/Http/Controllers/PengajuanSuratController.php` - Logic bisnis
- **View Create**: `resources/views/user/pengajuan-surat/create.blade.php` - Form dengan JS
- **View Show**: `resources/views/user/pengajuan-surat/show.blade.php` - Display detail
- **Trait**: `app/Traits/FormatPengajuanSurat.php` - Helper formatting
- **Migration**: `database/migrations/2025_11_17_create_pengajuan_surat_fields.php` - DB schema
- **Seeder**: `database/seeders/PengajuanSuratDemoSeeder.php` - Test data

---

## 🚀 Next Steps

### Untuk Admin Panel:
```blade
@php
    $filledFields = $pengajuan->getFilledFields();
@endphp

@foreach($filledFields as $fieldName => $field)
    <tr>
        <td>{{ $field['label'] }}</td>
        <td>{!! $field['formatted_value'] !!}</td>
    </tr>
@endforeach
```

### Untuk Report/Export:
```php
$summary = $pengajuan->getSummaryArray();
// Gunakan untuk generate PDF, Excel, dll
```

### Untuk API:
```php
Route::get('/api/pengajuan-surat/{id}', function(PengajuanSurat $pengajuan) {
    return response()->json($pengajuan->getSummaryArray());
});
```

---

## 💡 Tips & Best Practices

1. **Selalu validate di backend** - Jangan andalkan validation client-side saja
2. **Gunakan trait FormatPengajuanSurat** - Untuk konsistensi formatting data
3. **Test semua jenis surat** - Sebelum go live di production
4. **Dokumentasi jenis surat** - Update accordion info jika tambah jenis surat
5. **Backup database** - Sebelum run migration di production

---

## 📞 Support

Jika ada pertanyaan atau issue, silakan:
1. Baca `PANDUAN_FORM_DINAMIS.md` untuk dokumentasi lengkap
2. Check browser console untuk error message
3. Cek Laravel logs di `storage/logs/`

---

**Last Updated**: 17 November 2025
**Version**: 1.0.0
