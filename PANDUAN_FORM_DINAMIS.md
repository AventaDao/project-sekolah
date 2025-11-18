# Panduan Implementasi Form Pengajuan Surat Dinamis

## 📋 Ringkasan Perubahan

Saya telah memperbarui sistem pengajuan surat untuk mendukung form yang dinamis berdasarkan jenis surat yang dipilih. Setiap jenis surat memiliki field spesifik yang relevan dengan kebutuhan surat tersebut.

## 🔄 Perubahan yang Dilakukan

### 1. **Migrasi Database** (`2025_11_17_create_pengajuan_surat_fields.php`)
Menambahkan field spesifik untuk setiap jenis surat ke tabel `pengajuan_surats`:

- **Surat KUA**: `nama_calon_mempelai`, `tanggal_pernikahan`, `nama_pasangan`, `tujuan_kua`
- **SKTM**: `nama_penerima_sktm`, `alasan_tidak_mampu`, `keperluan_sktm`
- **Surat Domisili**: `alamat_domisili`, `rt_domisili`, `rw_domisili`, `tanggal_mulai_tinggal`, `status_rumah`
- **Surat Keterangan Tanah**: `deskripsi_tanah`, `lokasi_tanah`, `luas_tanah`, `status_tanah`, `nomor_sertifikat`
- **SKCK**: `tujuan_skck`, `institusi_tujuan`, `tanggal_dibutuhkan`
- **Surat Permohonan Bantuan**: `jenis_bantuan`, `jumlah_bantuan`, `latar_belakang_bantuan`, `prioritas_bantuan`

### 2. **Update Model** (`app/Models/PengajuanSurat.php`)
- Menambahkan semua field baru ke `$fillable`
- Menambahkan casting untuk date dan decimal
- Membuat method `getSuratTypes()` yang mendefinisikan struktur form untuk setiap jenis surat
- Membuat method `getFieldsForSuratType()` untuk mengambil field spesifik

### 3. **Update Controller** (`app/Http/Controllers/PengajuanSuratController.php`)
- Method `create()` sekarang mengirimkan `suratTypes` dengan struktur lengkap
- Method `store()` menggunakan validasi dinamis berdasarkan jenis surat
- Semua field dinamis disimpan ke database sesuai konfigurasi

### 4. **Update View** (`resources/views/user/pengajuan-surat/create.blade.php`)
- Form sekarang menggunakan JavaScript untuk menampilkan field dinamis
- Ketika pengguna memilih jenis surat, field relevan akan muncul secara otomatis
- Validasi error ditampilkan untuk setiap field dinamis
- Accordion menampilkan informasi lengkap tentang setiap jenis surat

### 5. **Update Show View** (`resources/views/user/pengajuan-surat/show.blade.php`)
- Menambahkan section untuk menampilkan detail spesifik berdasarkan jenis surat
- Data ditampilkan dalam format yang mudah dibaca

## 📝 Struktur Jenis Surat

### Surat KUA
**Deskripsi**: Surat pengantar untuk keperluan administrasi di Kantor Urusan Agama
**Field Spesifik**:
- Tujuan KUA (Nikah, Rujuk, Pembatalan Pernikahan, Lainnya)
- Nama Calon Mempelai
- Tanggal Pernikahan
- Nama Pasangan

### SKTM (Surat Keterangan Tidak Mampu)
**Deskripsi**: Surat keterangan kondisi ekonomi keluarga kurang mampu
**Field Spesifik**:
- Nama Penerima SKTM
- Alasan Tidak Mampu (textarea)
- Keperluan SKTM (Beasiswa, Bantuan Sosial, Keringanan Biaya, Kesehatan, Lainnya)

### Surat Domisili
**Deskripsi**: Surat keterangan tempat tinggal seseorang
**Field Spesifik**:
- Alamat Lengkap (textarea)
- RT
- RW
- Tanggal Mulai Tinggal
- Status Rumah (Milik Sendiri, Sewa, Menumpang, Lainnya)

### Surat Keterangan Tanah
**Deskripsi**: Surat keterangan kepemilikan atau penguasaan tanah
**Field Spesifik**:
- Lokasi Tanah
- Luas Tanah (m²)
- Status Tanah (Milik, Waris, Gadai, Sewa, Lainnya)
- Nomor Sertifikat (opsional)
- Deskripsi Tanah (textarea)

### SKCK (Surat Keterangan Catatan Kepolisian)
**Deskripsi**: Surat pengantar untuk mengurus SKCK di kepolisian
**Field Spesifik**:
- Tujuan SKCK (Melamar Pekerjaan, Pendaftaran Sekolah, Izin Usaha, Beasiswa, Lainnya)
- Institusi Tujuan
- Tanggal Dibutuhkan

### Surat Permohonan Bantuan
**Deskripsi**: Surat permohonan bantuan untuk berbagai keperluan
**Field Spesifik**:
- Jenis Bantuan (Bantuan Sosial, Renovasi Rumah, Kesehatan, Pendidikan, Bencana, Lainnya)
- Jumlah Bantuan (Rp) - opsional
- Latar Belakang / Alasan Bantuan (textarea)
- Prioritas (Sangat Mendesak, Mendesak, Normal)

## 🚀 Cara Menggunakan

### Sebagai Pengguna
1. Buka halaman "Ajukan Surat Baru"
2. Pilih jenis surat dari dropdown
3. Form akan menampilkan field spesifik untuk jenis surat tersebut
4. Isi semua field yang diperlukan (ditandai dengan *)
5. Upload surat pengantar dari RW
6. Klik "Ajukan Surat"

### Sebagai Developer - Menambah Jenis Surat Baru

Edit `app/Models/PengajuanSurat.php` dan tambahkan entry baru di method `getSuratTypes()`:

```php
'Nama Surat Baru' => [
    'label' => 'Nama Surat Baru (dengan deskripsi)',
    'deskripsi' => 'Deskripsi singkat surat ini',
    'fields' => [
        'nama_field_1' => [
            'label' => 'Label Field', 
            'type' => 'text|number|date|textarea|select', 
            'required' => true,
            'options' => [...] // jika type adalah select
        ],
        // field lainnya
    ]
]
```

### Contoh Menambah Field Baru

Jika ingin menambah field baru ke jenis surat yang sudah ada:

1. Buat migration baru:
```bash
php artisan make:migration add_new_field_to_pengajuan_surats
```

2. Tambahkan field ke migration:
```php
$table->string('field_baru')->nullable();
```

3. Update `$fillable` di Model dan `getSuratTypes()` method

## 🔐 Validasi

Validasi dilakukan secara dinamis:
- Field yang required harus diisi
- Date field harus tanggal valid dan setelah hari ini
- Number field harus berupa angka
- Select field harus sesuai dengan opsi yang tersedia
- Textarea harus berupa string

## 📱 Frontend Logic

JavaScript di `create.blade.php` menangani:
- Update field ketika jenis surat berubah
- Render field dengan tipe yang sesuai (text, number, date, textarea, select)
- Menampilkan error message untuk setiap field
- Preserve old values jika ada validation error

## 💾 Database

Field baru dapat dilihat dengan menjalankan migration:
```bash
php artisan migrate
```

## 📊 Admin Panel (Future Enhancement)

Untuk menampilkan detail pengajuan di admin panel, server akan menampilkan:
- Detail spesifik berdasarkan jenis surat
- Semua field dynamis dengan nilai yang diisi pengguna
- Format yang sesuai (e.g., tanggal, currency untuk bantuan)

## 🐛 Troubleshooting

### Field tidak muncul setelah pilih jenis surat
- Pastikan JavaScript tidak ada error (cek browser console)
- Pastikan jenis surat ada di `getSuratTypes()`

### Error validasi field tidak dikenal
- Pastikan field sudah di-update di Model `$fillable`
- Pastikan migration sudah dijalankan

### Data tidak tersimpan
- Check migration sudah berjalan: `php artisan migrate:status`
- Check field ada di database: `php artisan tinker` → `\Schema::getColumnListing('pengajuan_surats')`

## 📝 Catatan Penting

1. Ketika menjalankan migration, pastikan database sudah siap
2. Old values dipilih secara otomatis ketika ada validation error
3. Format tanggal untuk date input adalah `YYYY-MM-DD`
4. Field yang tidak relevan dengan jenis surat tidak ditampilkan

## 🎯 Next Steps (Optional)

1. Tambahkan tipe field baru (file, checkbox, radio button)
2. Buat admin panel untuk mengelola jenis surat
3. Tambahkan template print untuk setiap jenis surat
4. Implementasi workflow approval yang lebih kompleks
