<?php

use Illuminate\Support\Facades\Route;
use App\Models\PengajuanSurat;
use App\Mail\SuratSelesaiMail;
use Illuminate\Support\Facades\Mail;

Route::get('/debug-email-setup', function () {
    return response()->json([
        'MAIL_MAILER' => env('MAIL_MAILER'),
        'MAIL_HOST' => env('MAIL_HOST'),
        'MAIL_PORT' => env('MAIL_PORT'),
        'MAIL_USERNAME' => env('MAIL_USERNAME'),
        'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
        'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
        'Status' => 'SMTP Configuration loaded successfully'
    ]);
});

Route::get('/debug-last-email', function () {
    // Ambil surat terakhir yang status "Selesai"
    $pengajuan = PengajuanSurat::where('status', 'Selesai')
        ->orderBy('tanggal_selesai', 'desc')
        ->first();
    
    if (!$pengajuan) {
        return response()->json(['error' => 'Tidak ada surat dengan status Selesai'], 404);
    }

    return response()->json([
        'nomor_pengajuan' => $pengajuan->nomor_pengajuan,
        'jenis_surat' => $pengajuan->jenis_surat,
        'user_email' => $pengajuan->user->email ?? 'No email',
        'user_nama' => $pengajuan->user->nama_lengkap ?? 'No name',
        'status' => $pengajuan->status,
        'tanggal_selesai' => $pengajuan->tanggal_selesai,
        'catatan_admin' => $pengajuan->catatan_admin,
    ]);
});

Route::post('/debug-send-email/{id}', function ($id) {
    $pengajuan = PengajuanSurat::findOrFail($id);

    if (!$pengajuan->user->email) {
        return response()->json([
            'success' => false,
            'error' => 'User tidak memiliki email'
        ], 400);
    }

    try {
        Mail::to($pengajuan->user->email)
            ->send(new SuratSelesaiMail($pengajuan));

        return response()->json([
            'success' => true,
            'message' => 'Email berhasil dikirim',
            'details' => [
                'to' => $pengajuan->user->email,
                'subject' => 'Surat ' . $pengajuan->jenis_surat . ' Anda Sudah Selesai - ' . $pengajuan->nomor_pengajuan,
                'nomor_pengajuan' => $pengajuan->nomor_pengajuan
            ]
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine()
        ], 500);
    }
})->middleware('auth');

Route::get('/test-email-preview/{id}', function ($id) {
    $pengajuan = PengajuanSurat::findOrFail($id);
    return new SuratSelesaiMail($pengajuan);
})->middleware('auth');
