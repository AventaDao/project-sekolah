# QUICK REFERENCE - IMPLEMENTASI FITUR BARU

## 🎯 CARA MENGGUNAKAN FITUR-FITUR BARU

---

## 1. SWEETALERT2 NOTIFIKASI

### Dari Controller:
```php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

public function store(Request $request)
{
    // Process...
    
    // ✅ Redirect dengan notifikasi
    return redirect()->route('home')
        ->with('success', 'Data berhasil disimpan!');
    
    // atau error
    return back()->with('error', 'Terjadi kesalahan saat menyimpan');
    
    // atau warning
    return back()->with('warning', 'Data sudah ada, silakan periksa kembali');
    
    // atau info
    return back()->with('info', 'Proses memerlukan waktu 24 jam');
}
```

### Otomatis Menampilkan Notifikasi:
- Notifikasi akan muncul otomatis di halaman tujuan
- Tidak perlu code tambahan di view
- SweetAlert2 handle semuanya

---

## 2. AUTO-FILL FORM PENGAJUAN SURAT

### Tampilan di View:
- Data user sudah terisi otomatis saat load halaman create
- User tidak perlu input ulang data diri
- Field readonly = tidak bisa diubah

### Yang Terisi:
```
✅ NIK (dari auth()->user()->nik)
✅ Nama Lengkap (dari auth()->user()->nama_lengkap)
✅ No. Telepon (dari auth()->user()->no_telepon)
✅ Alamat (dari auth()->user()->alamat)
✅ RT (dari auth()->user()->rt)
✅ RW (dari auth()->user()->rw)
✅ Kode Pos (dari auth()->user()->kode_pos)
```

### Cara Kerja:
1. Controller `create()` mengirim `$user`
2. View render dengan `value="{{ $user->nik }}"`
3. Field set `readonly` di HTML

---

## 3. EXPORT & DOWNLOAD PDF SURAT

### Untuk User (Routes):
```
GET /pengajuan-surat/{id}/print         → Preview cetak (dalam browser)
GET /pengajuan-surat/{id}/export-pdf    → Download PDF
```

### Kapan Muncul:
- Tombol hanya tampil jika status pengajuan = **"Selesai"**
- User bisa print preview atau download PDF

### Proses Flow:
```
User Request → Admin Verifikasi & Approve 
→ Status Selesai → User Download PDF
```

### Kode di Controller:
```php
// Method exportPdf - download PDF
public function exportPdf($id)
{
    $pengajuanSurat = PengajuanSurat::findOrFail($id);
    
    // Validasi authorization
    if ($pengajuanSurat->user_id !== Auth::id()) {
        abort(403);
    }
    
    $user = $pengajuanSurat->user;
    $pdf = Pdf::loadView('user.pengajuan-surat.pdf-export', 
                         compact('pengajuanSurat', 'user'));
    
    return $pdf->download('Pengajuan-Surat-'.$pengajuanSurat->nomor_pengajuan.'.pdf');
}

// Method printPreview - tampilkan preview cetak
public function printPreview($id)
{
    $pengajuanSurat = PengajuanSurat::findOrFail($id);
    
    if ($pengajuanSurat->user_id !== Auth::id()) {
        abort(403);
    }
    
    $user = $pengajuanSurat->user;
    return view('user.pengajuan-surat.pdf-preview', 
                compact('pengajuanSurat', 'user'));
}
```

### Isi PDF:
```
✅ Nomor Pengajuan
✅ Status (dengan badge warna)
✅ Data Pemohon (NIK, Nama, Telepon, Email, Alamat)
✅ Informasi Surat (Jenis, Keperluan)
✅ Detail Pengajuan (Field dinamis)
✅ Catatan Admin
✅ Tanggal Update & Selesai
✅ Footer dengan info cetak
```

---

## 4. DASHBOARD RIWAYAT PENGADUAN

### Implementasi di Controller:
```php
private function userDashboard()
{
    $user = Auth::user();
    
    // Hanya pengaduan user yang login
    $recent_pengaduan = Pengaduan::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
    
    return view('dashboard', compact('recent_pengaduan'));
}
```

### Di Dashboard User Tampil:
```
Riwayat Pengaduan Terbaru (5 item terbaru)
- Nomor Pengaduan
- Kategori
- Judul
- Tanggal
- Status
- Tombol lihat detail
```

### Statistik yang Ditampilkan:
```php
'my_pengaduan_total'      // Total pengaduan user
'my_pengaduan_menunggu'   // Menunggu diproses
'my_pengaduan_selesai'    // Sudah selesai
```

---

## 5. DATA ISOLATION & SECURITY

### Pattern Authorization:

#### Pattern 1: Query Filter
```php
// ✅ BENAR - Hanya data user sendiri
$myData = Model::where('user_id', Auth::id())->get();

// ❌ SALAH - Expose semua data
$allData = Model::all();
```

#### Pattern 2: Check Authorization
```php
// ✅ BENAR - Cek di method
public function show(Model $record)
{
    // Tolak jika bukan admin dan bukan data user
    if (Auth::user()->role !== 'admin' && $record->user_id !== Auth::id()) {
        abort(403, 'Unauthorized');
    }
    
    return view('show', compact('record'));
}

// ❌ SALAH - Langsung return tanpa check
public function show(Model $record)
{
    return view('show', compact('record'));
}
```

#### Pattern 3: For Karyawan/Employee
```php
// Cek punya relationship dengan user
$karyawan = Karyawan::where('user_id', Auth::id())->first();

if (!$karyawan) {
    return redirect()->back()->with('error', 'Unauthorized');
}

// Proses lebih lanjut...
```

### Controllers yang Sudah Implement:
```
✅ PengajuanSuratController - 7 methods
✅ PengaduanController - 4 methods
✅ ActivityController - 2 methods
✅ AbsensiController - 2 methods
✅ DashboardController - 1 method
```

### Testing Authorization:
```php
// Simulasi akses dari user berbeda

// User A
Auth::loginAs(User::find(1));
GET /pengajuan-surat/5 // Pengajuan user A
// ✅ Berhasil

// User B  
Auth::loginAs(User::find(2));
GET /pengajuan-surat/5 // Pengajuan user A
// ❌ Error 403 - Unauthorized
```

---

## 🔍 VERIFICATION CHECKLIST

### Routes
```bash
php artisan route:list | grep pengajuan
# Harus ada:
# GET /pengajuan-surat/{pengajuanSurat}/print
# GET /pengajuan-surat/{pengajuanSurat}/export-pdf
```

### Controllers
```bash
grep -r "user_id.*Auth::id" app/Http/Controllers/
# Harus ada di setiap query untuk data pribadi
```

### Database
```php
// Check kolom users table
php artisan tinker
> Schema::getColumnListing('users')
# Harus ada: nik, nama_lengkap, alamat, rt, rw, kode_pos, no_telepon
```

### Dependencies
```bash
composer show barryvdh/laravel-dompdf
# Harus v3.1.1 atau sesuai di composer.lock
```

---

## 🚨 TROUBLESHOOTING

### SweetAlert2 Tidak Muncul
```php
// Pastikan view extends layouts.dashboard
@extends('layouts.dashboard')

// Pastikan session terkirim
return redirect()->with('success', 'Pesan');

// Check browser console untuk error
```

### Auto-fill Tidak Muncul
```php
// Pastikan controller mengirim $user
public function create()
{
    $user = Auth::user();
    return view('user.pengajuan-surat.create', compact('user'));
}

// Check database user punya nilai di kolom-kolom tsb
```

### PDF Tidak Download
```php
// Check file view ada di path yang benar
resources/views/user/pengajuan-surat/pdf-export.blade.php

// Check disk 'public' di config/filesystems.php

// Test command:
php artisan tinker
> Pdf::loadView('user.pengajuan-surat.pdf-export', [])->download('test.pdf');
```

### Authorization 403 Error
```php
// Debug - check Authorization
Auth::user()->role  // harus 'user', 'admin', atau 'karyawan'
$record->user_id   // harus sama dengan Auth::id()
Auth::id()          // harus ada value

// Test dengan dd()
dd([
    'auth_id' => Auth::id(),
    'record_user_id' => $record->user_id,
    'is_admin' => Auth::user()->role === 'admin'
]);
```

---

## 📚 DOKUMENTASI LENGKAP

Lihat file: `IMPLEMENTASI_FITUR_LENGKAP.md` untuk dokumentasi detail

---

## 💡 TIPS

1. **Notifikasi**: Gunakan SweetAlert untuk semua operasi CRUD
2. **Auto-fill**: Pastikan user selalu fill form dari dashboard
3. **PDF**: Test dengan data minimal dulu, baru kompleks
4. **Security**: SELALU check authorization sebelum return data
5. **Query**: SELALU filter `where('user_id', Auth::id())` untuk user data

---

Generated: 29 November 2025
Version: 1.0
