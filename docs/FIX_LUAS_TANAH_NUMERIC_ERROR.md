# SOLUSI: NUMERIC VALUE OUT OF RANGE ERROR - KOLOM LUAS_TANAH

## 🔍 Identifikasi Masalah

### Error Message:
```
SQLSTATE[22003]: Numeric value out of range: 1264 Out of range value for column 'luas_tanah' at row 1
```

### Penyebab:
Kolom `luas_tanah` di database didefinisikan sebagai `decimal(8, 2)` yang memiliki kapasitas:
- **8 digit total** dengan **2 digit desimal**
- **Maximum value: 999,999.99 m²**
- **Minimum value: 0.01 m²**

User mencoba menginput nilai **1,111,111,111** (10 digit) yang jauh melebihi batas maksimal!

## ✅ Solusi yang Diterapkan

### 1. **Migration: Ubah Tipe Data Kolom** 
📁 File: `database/migrations/2026_01_20_modify_luas_tanah_column.php`

**Sebelum:**
```php
$table->decimal('luas_tanah', 8, 2)->nullable();  // Max: 999,999.99
```

**Sesudah:**
```php
$table->decimal('luas_tanah', 12, 2)->nullable();  // Max: 9,999,999,999.99
```

**Penjelasan:**
- Mengubah dari `decimal(8, 2)` menjadi `decimal(12, 2)`
- Kapasitas baru: hingga **9.999.999.999,99 m²**
- Format: `12 digit total, 2 digit desimal`

**Perintah Migration:**
```bash
php artisan migrate
```

### 2. **Update Model: Tambahkan Validasi Field**
📁 File: `app/Models/PengajuanSurat.php`

**Sebelum:**
```php
'luas_tanah' => ['label' => 'Luas Tanah (m²)', 'type' => 'number', 'step' => '0.01', 'required' => true],
```

**Sesudah:**
```php
'luas_tanah' => [
    'label' => 'Luas Tanah (m²)', 
    'type' => 'number', 
    'step' => '0.01', 
    'min' => '0.01',                          // Nilai minimum
    'max' => '9999999999.99',                 // Nilai maksimum
    'required' => true
],
```

**Manfaat:**
- Validasi di sisi client (HTML5 input validation)
- Validasi di sisi server (Laravel validation rules)
- User tidak bisa input nilai di luar range

## 🛡️ Validasi yang Dilakukan

### Validasi HTML5 (Frontend):
Kolom input akan menampilkan pesan error jika user mencoba input:
- Nilai **di bawah 0.01 m²**
- Nilai **di atas 9,999,999,999.99 m²**

### Validasi Laravel (Backend):
Di `PengajuanSuratController.php`:
```php
elseif ($fieldConfig['type'] === 'number') {
    $rule .= '|numeric';
    // Add max validation for numeric fields
    if (isset($fieldConfig['max'])) {
        $rule .= '|max:' . $fieldConfig['max'];
    }
    // Add min validation for numeric fields
    if (isset($fieldConfig['min'])) {
        $rule .= '|min:' . $fieldConfig['min'];
    }
}
```

## 📊 Kapasitas Kolom

| Tipe Data | Kapasitas | Penggunaan |
|-----------|-----------|-----------|
| `decimal(8, 2)` | 999,999.99 | ❌ Terlalu kecil |
| `decimal(12, 2)` | 9,999,999,999.99 | ✅ Cukup besar |
| `decimal(15, 2)` | 9,999,999,999,999.99 | Overkill |

## 🚀 Testing & Verifikasi

### Tes Input yang Valid:
```
✅ 100 m²
✅ 1,000 m² 
✅ 10,000 m²
✅ 100,000 m²
✅ 1,000,000 m²
✅ 100,000,000 m²
✅ 1,000,000,000 m²
✅ 9,999,999,999.99 m² (maksimal)
```

### Tes Input yang Invalid:
```
❌ -100 m² (negatif)
❌ 0 m² (kurang dari minimum)
❌ 10,000,000,000 m² (melebihi maksimal)
❌ aaaaaa (bukan angka)
```

## 📝 Catatan Penting

1. **Migration sudah dijalankan**: Struktur database sudah diupdate
2. **Data lama aman**: Semua data `luas_tanah` yang ada tetap aman (masih fit dalam decimal(12,2))
3. **Form sudah diupdate**: Validasi min/max sudah ditambahkan ke konfigurasi field
4. **Validasi berlapis**: 
   - Client-side (HTML5)
   - Server-side (Laravel validation)

## 🔄 Jika Perlu Rollback

Jika diperlukan untuk mengembalikan ke ukuran sebelumnya:
```bash
php artisan migrate:rollback
```

---

**Status:** ✅ **SELESAI**  
**Tanggal:** 20 Januari 2026  
**Verified:** Migration executed successfully
