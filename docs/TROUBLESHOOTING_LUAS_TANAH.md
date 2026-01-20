# 🆘 TROUBLESHOOTING - LUAS TANAH ERROR

## Error Message
```
SQLSTATE[22003]: Numeric value out of range: 1264 
Out of range value for column 'luas_tanah' at row 1
```

## Root Cause
Kolom `luas_tanah` terlalu kecil untuk menampung nilai yang user input.

---

## Solusi Cepat ⚡

### Opsi 1: Jalankan Migration (RECOMMENDED)
```bash
cd "c:\Users\PC_\Documents\New folder\project-sekolah"
php artisan migrate
```
✅ Ini sudah selesai! Migration sudah dijalankan.

### Opsi 2: Manual Database (Jika perlu)
```sql
ALTER TABLE pengajuan_surats 
MODIFY luas_tanah DECIMAL(12, 2) NULL;
```

---

## Verifikasi Solusi ✅

### Check Database Schema
```bash
php artisan tinker
```

```php
// Dalam tinker shell:
DB::select("DESCRIBE pengajuan_surats" )
    |> collect()
    |> each(function($col) { 
        if ($col->Field == 'luas_tanah') 
            dd($col); 
    })
```

Expected output:
```
Type: decimal(12,2)  ✅
Null: YES
Default: NULL
```

### Verify Form Config
```bash
php artisan tinker
```

```php
$fields = \App\Models\PengajuanSurat::getFieldsForSuratType('Surat Keterangan Tanah');
dd($fields['luas_tanah']);
```

Expected output:
```php
[
  'label' => 'Luas Tanah (m²)',
  'type' => 'number',
  'step' => '0.01',
  'min' => '0.01',
  'max' => '9999999999.99',     ✅
  'required' => true
]
```

---

## Jika Masih Error

### 1. Cache Lama?
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### 2. Composer Autoload?
```bash
composer dump-autoload
```

### 3. Cek Migration Status
```bash
php artisan migrate:status
```

Output harus:
```
2026_01_20_modify_luas_tanah_column ... Ran
```

### 4. Jika belum, jalankan:
```bash
php artisan migrate
```

### 5. Jika masih error, cek database:
```bash
mysql -u root -p
use nama_database;
DESCRIBE pengajuan_surats;
```

Cari baris `luas_tanah`:
```
| luas_tanah      | decimal(12,2) | YES  | MUL |      | NULL    |
```

Should be `decimal(12,2)`, not `decimal(8,2)`

---

## FAQ

### Q: Apakah data lama akan hilang?
**A:** Tidak! Migration hanya mengubah tipe data, bukan menghapus data. Data lama tetap aman.

### Q: Berapa nilai maksimum sekarang?
**A:** 9,999,999,999.99 m² (10 digit sebelum desimal)

### Q: Bisa input nilai negatif?
**A:** Tidak, ada validasi `min: 0.01`

### Q: Apa itu decimal(12, 2)?
**A:** 
- 12 = total digit keseluruhan
- 2 = digit setelah koma
- Jadi: 9999999999.99 (maksimal)

### Q: Jika ingin rollback?
**A:** 
```bash
php artisan migrate:rollback
```
Akan kembali ke `decimal(8,2)` (sebelumnya)

---

## Success Indicators ✅

Jika sudah berhasil, Anda bisa:

1. ✅ Input luas tanah: **1,111,111,111** m²
2. ✅ Form tidak error saat submit
3. ✅ Database insert berhasil
4. ✅ Data muncul di database tanpa error

---

## Contoh Data yang Bisa Disimpan Sekarang

| Luas Tanah | Status |
|-----------|--------|
| 100 m² | ✅ OK |
| 1,000 m² | ✅ OK |
| 1,000,000 m² | ✅ OK |
| 100,000,000 m² | ✅ OK |
| 1,000,000,000 m² | ✅ OK |
| 1,111,111,111 m² | ✅ OK |
| 9,999,999,999.99 m² | ✅ OK (MAKSIMAL) |
| 10,000,000,000 m² | ❌ REJECTED |

---

## Contact & Support
- Check documentation: `/docs/FIX_LUAS_TANAH_NUMERIC_ERROR.md`
- Visual guide: `/docs/VISUAL_EXPLANATION_LUAS_TANAH_FIX.md`
- Quick ref: `/docs/QUICK_REFERENCE_LUAS_TANAH.md`

---
**Last Updated:** 2026-01-20  
**Status:** RESOLVED ✅
