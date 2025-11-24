<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\BeritaDesaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InfografisController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/contact-us', function () {
    return view('contact');
})->name('contact');

// Public Infografis route (if controller/view exists)
Route::get('/infografis', [InfografisController::class, 'index'])->name('infografis.index');

/*
|--------------------------------------------------------------------------
| Email Verification Routes
|--------------------------------------------------------------------------
*/
Route::get('/verify-email', [AuthController::class, 'showVerifyForm'])->name('verify.form');
Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name('send.otp');
Route::post('/verify-email', [AuthController::class, 'verify'])->name('verify.otp');

/*
|--------------------------------------------------------------------------
| Guest Routes (Login, Register, Password Reset)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {
    // Login Routes
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    // Karyawan (employee) login - allow NIK or email
    Route::get('/karyawan/login', [\App\Http\Controllers\KaryawanAuthController::class, 'showLoginForm'])->name('karyawan.login');
    Route::post('/karyawan/login', [\App\Http\Controllers\KaryawanAuthController::class, 'login'])->name('karyawan.login.post');

    // Register Routes
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');

    // Social Auth Routes
    Route::get('/auth/{provider}', [AuthController::class, 'redirect'])->name('sso.redirect');
    Route::get('/auth/{provider}/callback', [AuthController::class, 'callback'])->name('sso.callback');

    // Password Reset Routes
    Route::get('/forgot-password', [AuthController::class, 'showRequestForm'])->name('forgot_password.email_form');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('forgot_password.send_link');
    Route::get('/password-reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password-reset', [AuthController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'web'])->group(function () {
    
    // Dashboard Route (using DashboardController)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Logout Route
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile Route
    Route::get('/myprofile', function () {
        return view('myprofile');
    })->name('myprofile');

    Route::get('/edit-profile', [AuthController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['cekRole:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Berita Desa Management
        Route::resource('berita', BeritaDesaController::class)->except(['show']);
        Route::get('berita/{beritum}', [BeritaDesaController::class, 'show'])->name('berita.show');
        
        // Data Penduduk Management
        Route::resource('penduduk', PendudukController::class);

        // Pengajuan Surat Management
        Route::prefix('pengajuan-surat')->name('pengajuan-surat.')->group(function () {
            Route::get('/', [PengajuanSuratController::class, 'adminIndex'])->name('index');
            Route::get('/{pengajuanSurat}', [PengajuanSuratController::class, 'show'])->name('show');
            Route::patch('/{pengajuanSurat}/status', [PengajuanSuratController::class, 'updateStatus'])->name('update-status');
            Route::get('/{pengajuanSurat}/download-pengantar', [PengajuanSuratController::class, 'downloadSuratPengantar'])->name('download-pengantar');
            Route::get('/{pengajuanSurat}/download-surat-jadi', [PengajuanSuratController::class, 'downloadSuratJadi'])->name('download-surat-jadi');
        });

        // Admin Absensi Management
        Route::prefix('absensi')->name('absensi.')->group(function () {
            Route::get('/', [\App\Http\Controllers\AbsensiController::class, 'adminIndex'])->name('index');
        });

        // Pengaduan Management
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/', [PengaduanController::class, 'adminIndex'])->name('index');
            Route::get('/{pengaduan}', [PengaduanController::class, 'show'])->name('show');
            Route::patch('/{pengaduan}/tanggapan', [PengaduanController::class, 'updateTanggapan'])->name('update-tanggapan');
        });

        // Other Admin Routes (placeholder)
        Route::get('/verifikasi', function () {
            return view('admin.verifikasi');
        })->name('verifikasi');
        
        Route::get('/seleksi', function () {
            return view('admin.seleksi');
        })->name('seleksi');
        
        Route::get('/pengumuman', function () {
            return view('admin.pengumuman');
        })->name('pengumuman');
        
        Route::get('/laporan', function () {
            return view('admin.laporan');
        })->name('laporan');
    });

    // Karyawan routes (attendance) - protected for role karyawan
    Route::middleware(['cekRole:karyawan'])->prefix('karyawan')->name('karyawan.')->group(function () {
        Route::get('/absensi', [\App\Http\Controllers\AbsensiController::class, 'employeeDashboard'])->name('absensi.dashboard');
        Route::post('/absensi', [\App\Http\Controllers\AbsensiController::class, 'store'])->name('absensi.store');
    });

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['cekRole:user'])->group(function () {
        
        // Biodata Route
        Route::get('/biodata', [BiodataController::class, 'index'])->name('user.biodata');
        
        // Other User Routes (placeholder)
        Route::get('/dokumen', function () {
            return view('user.dokumen');
        })->name('user.dokumen');
        
        Route::get('/status', function () {
            return view('user.status');
        })->name('user.status');
        
        Route::get('/daftar-ulang', function () {
            return view('user.daftar_ulang');
        })->name('user.daftar_ulang');

        /*
        | Pengajuan Surat Routes (User)
        */
        Route::prefix('pengajuan-surat')->name('pengajuan-surat.')->group(function () {
            Route::get('/', [PengajuanSuratController::class, 'index'])->name('index');
            Route::get('/create', [PengajuanSuratController::class, 'create'])->name('create');
            Route::post('/', [PengajuanSuratController::class, 'store'])->name('store');
            Route::get('/{pengajuanSurat}', [PengajuanSuratController::class, 'show'])->name('show');
            Route::delete('/{pengajuanSurat}', [PengajuanSuratController::class, 'destroy'])->name('destroy');
            Route::get('/{pengajuanSurat}/download-pengantar', [PengajuanSuratController::class, 'downloadSuratPengantar'])->name('download-pengantar');
            Route::get('/{pengajuanSurat}/download-surat-jadi', [PengajuanSuratController::class, 'downloadSuratJadi'])->name('download-surat-jadi');
        });

        

        /*
        | Pengaduan Routes (User)
        */
        Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
            Route::get('/', [PengaduanController::class, 'index'])->name('index');
            Route::get('/create', [PengaduanController::class, 'create'])->name('create');
            Route::post('/', [PengaduanController::class, 'store'])->name('store');
            Route::get('/{pengaduan}', [PengaduanController::class, 'show'])->name('show');
            Route::delete('/{pengaduan}', [PengaduanController::class, 'destroy'])->name('destroy');
            Route::get('/{pengaduan}/download-lampiran', [PengaduanController::class, 'downloadLampiran'])->name('download-lampiran');
        });

        // AJAX endpoint for dashboard real-time stats
        Route::get('/dashboard/stats', [\App\Http\Controllers\DashboardController::class, 'stats'])->name('dashboard.stats');
    });
});