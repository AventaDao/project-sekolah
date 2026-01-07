<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class LetterVerificationController extends Controller
{
    public function verify($id)
    {
        $pengajuanSurat = PengajuanSurat::with('user')->findOrFail($id);
        
        return view('user.pengajuan-surat.verify', compact('pengajuanSurat'));
    }
}
