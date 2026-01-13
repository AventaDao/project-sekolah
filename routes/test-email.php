<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Models\PengajuanSurat;

// Route untuk preview email tanpa harus mengirim
Route::get('/test-email-preview/{id}', function ($id) {
    $pengajuanSurat = PengajuanSurat::findOrFail($id);
    return new \App\Mail\SuratSelesaiMail($pengajuanSurat);
})->middleware('auth');

// Route untuk test mengirim email
Route::post('/test-send-email/{id}', function ($id) {
    $pengajuanSurat = PengajuanSurat::findOrFail($id);
    
    try {
        Mail::to($pengajuanSurat->user->email)
            ->send(new \App\Mail\SuratSelesaiMail($pengajuanSurat));
        
        return response()->json([
            'success' => true,
            'message' => 'Email berhasil dikirim ke ' . $pengajuanSurat->user->email
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage()
        ], 500);
    }
})->middleware('auth');
