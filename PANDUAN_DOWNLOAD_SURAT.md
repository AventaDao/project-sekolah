# Panduan Download Surat Pengantar RW - Admin

## ✅ Route yang Telah Ditambahkan

Berikut route yang sudah dikonfigurasi untuk download surat pengantar RW:

### Route Admin (Authenticated Admin Only)
```
GET  /admin/pengajuan-surat/{pengajuanSurat}/download-pengantar
GET  /admin/pengajuan-surat/{pengajuanSurat}/download-surat-jadi
```

### Route User (Authenticated User Only)
```
GET  /pengajuan-surat/{pengajuanSurat}/download-pengantar
GET  /pengajuan-surat/{pengajuanSurat}/download-surat-jadi
```

## 📋 Authorization

### Download Surat Pengantar RW
- **Admin**: ✅ Bisa download semua pengajuan surat
- **User**: ✅ Hanya bisa download milik sendiri

### Download Surat Jadi
- **Admin**: ✅ Bisa download semua surat jadi
- **User**: ✅ Hanya bisa download milik sendiri

## 🔗 URL untuk Testing

### Admin URL (sesuai request Anda)
```
https://unfavouring-unhutched-ji.ngrok-free.dev/admin/pengajuan-surat/1/download-pengantar
```

### User URL
```
https://unfavouring-unhutched-ji.ngrok-free.dev/pengajuan-surat/1/download-pengantar
```

## 📝 Update Controller

### Method `downloadSuratPengantar()`
```php
public function downloadSuratPengantar(PengajuanSurat $pengajuanSurat)
{
    // Authorization: Admin bisa akses semua, User hanya miliknya sendiri
    if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    // Validasi file ada
    if (!$pengajuanSurat->surat_pengantar_rw || !Storage::disk('public')->exists($pengajuanSurat->surat_pengantar_rw)) {
        return redirect()->back()->with('error', 'File surat pengantar tidak ditemukan');
    }

    $path = Storage::disk('public')->path($pengajuanSurat->surat_pengantar_rw);
    $filename = 'Surat-Pengantar-RW-' . $pengajuanSurat->nomor_pengajuan . '.' . pathinfo($pengajuanSurat->surat_pengantar_rw, PATHINFO_EXTENSION);
    
    return response()->download($path, $filename);
}
```

### Method `downloadSuratJadi()`
```php
public function downloadSuratJadi(PengajuanSurat $pengajuanSurat)
{
    // Authorization: Admin bisa akses semua, User hanya miliknya sendiri
    if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
        abort(403, 'Unauthorized action.');
    }

    if (!$pengajuanSurat->file_surat_jadi) {
        return redirect()->back()->with('error', 'Surat belum tersedia');
    }

    // Validasi file ada
    if (!Storage::disk('public')->exists($pengajuanSurat->file_surat_jadi)) {
        return redirect()->back()->with('error', 'File surat tidak ditemukan');
    }

    $path = Storage::disk('public')->path($pengajuanSurat->file_surat_jadi);
    $filename = 'Surat-Jadi-' . $pengajuanSurat->nomor_pengajuan . '.pdf';
    
    return response()->download($path, $filename);
}
```

## 🎯 Update View Admin

### Update Button di `show.blade.php`
Tombol download surat pengantar RW di halaman detail admin:

```blade
<!-- Surat Pengantar RW -->
<h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Surat Pengantar RW</h5>
<a href="{{ route('admin.pengajuan-surat.download-pengantar', $pengajuanSurat->id) }}" 
   class="btn btn-outline-primary" target="_blank">
    <i class="ti ti-download"></i> Download Surat Pengantar RW
</a>
```

## ✨ Fitur

✅ Admin bisa download surat pengantar dari semua pengajuan  
✅ User bisa download surat pengantar milik sendiri  
✅ File error handling - jika file tidak ditemukan, tampil pesan error  
✅ Filename otomatis berdasarkan nomor pengajuan  
✅ Support berbagai format file (PDF, JPG, PNG)  
✅ Authorization check - user tidak bisa akses pengajuan orang lain  

## 🧪 Testing

1. **Login sebagai Admin**
   - Buka: `https://unfavouring-unhutched-ji.ngrok-free.dev/admin/pengajuan-surat`
   - Klik detail pengajuan (ID 1)
   - Klik tombol "Download Surat Pengantar RW"
   - File akan didownload dengan nama: `Surat-Pengantar-RW-SRT/2025/11/0001.png` (atau format file lainnya)

2. **Login sebagai User**
   - Buka: `https://unfavouring-unhutched-ji.ngrok-free.dev/pengajuan-surat`
   - Klik detail pengajuan milik Anda
   - Klik tombol "Download Surat Pengantar RW"
   - Hanya bisa download milik sendiri

3. **Test Error Handling**
   - Coba akses URL user dengan ID pengajuan milik user lain → 403 Unauthorized
   - Jika file tidak ada → Error message ditampilkan

## 📁 Files yang Diupdate

1. ✅ `routes/web.php` - Route admin untuk download
2. ✅ `app/Http/Controllers/PengajuanSuratController.php` - Update method download
3. ✅ `resources/views/admin/pengajuan-surat/show.blade.php` - Update button link

---

**Status**: ✅ SIAP UNTUK TESTING
