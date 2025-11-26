# Dokumentasi Perubahan: Pemisahan Data Registrasi dari Data Kelahiran

## Ringkasan Masalah
Sebelumnya, ketika user melakukan registrasi, data mereka masuk ke tabel `penduduks` dan dihitung sebagai "Kelahiran Bulan Ini" di dashboard admin, padahal seharusnya user yang register hanya masuk ke "Total Penduduk" saja.

## Solusi yang Diimplementasikan

### 1. **Penambahan Field `source_type`**
- **File Migration**: `database/migrations/2025_11_26_add_source_type_to_penduduks_table.php`
- **Deskripsi**: Menambahkan kolom `source_type` ke tabel `penduduks`
- **Tipe Data**: ENUM dengan nilai:
  - `'manual'` = Data kelahiran/kematian yang diinput manual oleh admin (dihitung di statistik)
  - `'registrasi'` = User yang baru melakukan registrasi (tidak dihitung di statistik kelahiran)

### 2. **Update Model Penduduk**
- **File**: `app/Models/Penduduk.php`
- **Perubahan**: Menambahkan `'source_type'` ke array `$fillable` agar field dapat diisi saat membuat record

### 3. **Update AuthController**
- **File**: `app/Http/Controllers/AuthController.php`
- **Method**: `register()`
- **Perubahan**: Saat user melakukan registrasi, field `source_type` diset ke `'registrasi'`
- **Kode**:
```php
Penduduk::create([
    // ... data lainnya ...
    'status_hidup' => 'Hidup', // Default status
    'source_type' => 'registrasi', // User registration, bukan data kelahiran
]);
```

### 4. **Update DashboardController**
- **File**: `app/Http/Controllers/DashboardController.php`
- **Method**: `adminDashboard()`
- **Perubahan**: Query untuk "Kelahiran Bulan Ini" sekarang hanya menghitung data dengan `source_type = 'manual'`
- **Kode**:
```php
'kelahiran_bulan_ini' => Penduduk::whereMonth('created_at', now()->month)
    ->whereYear('created_at', now()->year)
    ->where('status_hidup', 'Hidup')
    ->where('source_type', 'manual')
    ->count(),
```

## Status Migrasi
✅ Migration berhasil dijalankan dengan batch 2

## Hasil yang Diharapkan
- ✅ User yang register akan masuk ke **Total Penduduk**
- ✅ User yang register **TIDAK** akan dihitung di **Kelahiran Bulan Ini**
- ✅ Hanya data kelahiran yang diinput manual admin yang dihitung di **Kelahiran Bulan Ini**

## Catatan Tambahan
- Field default adalah `'registrasi'` untuk backward compatibility
- Untuk data kelahiran yang diinput manual admin di masa depan, pastikan set `source_type = 'manual'`
- Data lama yang sudah ada akan memiliki `source_type = 'registrasi'` (default)
