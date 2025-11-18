<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanSuratController extends Controller
{
    /**
     * Display a listing of the resource for users.
     */
    public function index()
    {
        $pengajuans = PengajuanSurat::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        $is_verified_user = Auth::user()->is_verified;
        
        return view('user.pengajuan-surat.index', compact('pengajuans', 'is_verified_user'));
    }

    /**
     * Display a listing of the resource for admin.
     */
    public function adminIndex()
    {
        $pengajuans = PengajuanSurat::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('admin.pengajuan-surat.index', compact('pengajuans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suratTypes = PengajuanSurat::getSuratTypes();
        
        return view('user.pengajuan-surat.create', compact('suratTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi dasar
        $suratTypes = PengajuanSurat::getSuratTypes();
        $jenisSuratList = array_keys($suratTypes);
        
        $rules = [
            'jenis_surat' => 'required|in:' . implode(',', $jenisSuratList),
            'keperluan' => 'required|string|min:10',
            'surat_pengantar_rw' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'keterangan_tambahan' => 'nullable|string',
        ];

        // Tambahkan validasi dinamis berdasarkan jenis surat
        $jenisSurat = $request->input('jenis_surat');
        $fields = PengajuanSurat::getFieldsForSuratType($jenisSurat);

        foreach ($fields as $fieldName => $fieldConfig) {
            $rule = $fieldConfig['required'] ? 'required' : 'nullable';
            
            if ($fieldConfig['type'] === 'textarea') {
                $rule .= '|string';
            } elseif ($fieldConfig['type'] === 'number') {
                $rule .= '|numeric';
            } elseif ($fieldConfig['type'] === 'date') {
                // Jika field adalah tanggal pernikahan atau tanggal dibutuhkan, harus di masa depan
                // Jika field adalah tanggal mulai tinggal, bisa tanggal apa saja
                if (in_array($fieldName, ['tanggal_pernikahan', 'tanggal_dibutuhkan'])) {
                    $rule .= '|date|after:today';
                } else {
                    $rule .= '|date';
                }
            } elseif ($fieldConfig['type'] === 'select') {
                $rule .= '|in:' . implode(',', $fieldConfig['options']);
            } elseif ($fieldConfig['type'] === 'text') {
                $rule .= '|string';
            }
            
            $rules[$fieldName] = $rule;
        }

        $validated = $request->validate($rules, [
            'jenis_surat.required' => 'Jenis surat harus dipilih',
            'jenis_surat.in' => 'Jenis surat tidak valid',
            'keperluan.required' => 'Keperluan harus diisi',
            'keperluan.min' => 'Keperluan minimal 10 karakter',
            'surat_pengantar_rw.required' => 'Surat pengantar RW wajib dilampirkan',
            'surat_pengantar_rw.mimes' => 'Format file harus PDF, JPG, JPEG, atau PNG',
            'surat_pengantar_rw.max' => 'Ukuran file maksimal 2MB',
        ]);

        // Upload surat pengantar RW
        $filePath = $request->file('surat_pengantar_rw')->store('surat-pengantar-rw', 'public');

        // Generate nomor pengajuan
        $nomorPengajuan = PengajuanSurat::generateNomorPengajuan();

        // Siapkan data untuk disimpan
        $dataToSave = [
            'user_id' => Auth::id(),
            'nomor_pengajuan' => $nomorPengajuan,
            'jenis_surat' => $validated['jenis_surat'],
            'keperluan' => $validated['keperluan'],
            'surat_pengantar_rw' => $filePath,
            'keterangan_tambahan' => $validated['keterangan_tambahan'] ?? null,
        ];

        // Tambahkan field dinamis
        foreach ($fields as $fieldName => $fieldConfig) {
            if (isset($validated[$fieldName])) {
                $dataToSave[$fieldName] = $validated[$fieldName];
            }
        }

        // Simpan data pengajuan
        PengajuanSurat::create($dataToSave);

        return redirect()->route('pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dibuat dengan nomor: ' . $nomorPengajuan);
    }

    /**
     * Display the specified resource.
     */
    public function show(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $viewPath = Auth::user()->role === 'admin' 
            ? 'admin.pengajuan-surat.show' 
            : 'user.pengajuan-surat.show';

        return view($viewPath, compact('pengajuanSurat'));
    }

    /**
     * Update status pengajuan (Admin only).
     */
    public function updateStatus(Request $request, PengajuanSurat $pengajuanSurat)
    {
        $validated = $request->validate([
            'status' => 'required|in:Menunggu,Diproses,Selesai,Ditolak',
            'catatan_admin' => 'nullable|string',
            'file_surat_jadi' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        $data = [
            'status' => $validated['status'],
            'catatan_admin' => $validated['catatan_admin'],
        ];

        // Upload file surat jadi jika ada
        if ($request->hasFile('file_surat_jadi')) {
            // Hapus file lama jika ada
            if ($pengajuanSurat->file_surat_jadi) {
                Storage::disk('public')->delete($pengajuanSurat->file_surat_jadi);
            }
            
            $data['file_surat_jadi'] = $request->file('file_surat_jadi')->store('surat-jadi', 'public');
        }

        // Set tanggal selesai jika status selesai
        if ($validated['status'] === 'Selesai') {
            $data['tanggal_selesai'] = now();
        }

        $pengajuanSurat->update($data);

        return redirect()->back()
            ->with('success', 'Status pengajuan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized
        if ($pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Hanya bisa dihapus jika status masih Menunggu
        if ($pengajuanSurat->status !== 'Menunggu') {
            return redirect()->back()
                ->with('error', 'Pengajuan yang sudah diproses tidak dapat dihapus');
        }

        // Hapus file surat pengantar
        if ($pengajuanSurat->surat_pengantar_rw) {
            Storage::disk('public')->delete($pengajuanSurat->surat_pengantar_rw);
        }

        // Hapus file surat jadi jika ada
        if ($pengajuanSurat->file_surat_jadi) {
            Storage::disk('public')->delete($pengajuanSurat->file_surat_jadi);
        }

        $pengajuanSurat->delete();

        return redirect()->route('pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus');
    }

    /**
     * Download file surat pengantar RW.
     */
    public function downloadSuratPengantar(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized: admin bisa download semua, user hanya miliknya sendiri
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validasi bahwa file ada
        if (!$pengajuanSurat->surat_pengantar_rw || !Storage::disk('public')->exists($pengajuanSurat->surat_pengantar_rw)) {
            return redirect()->back()->with('error', 'File surat pengantar tidak ditemukan');
        }

        $path = Storage::disk('public')->path($pengajuanSurat->surat_pengantar_rw);
        // Hapus karakter "/" dan "\" dari nomor pengajuan untuk filename
        $nomorClean = str_replace(['/', '\\'], '-', $pengajuanSurat->nomor_pengajuan);
        $filename = 'Surat-Pengantar-RW-' . $nomorClean . '.' . pathinfo($pengajuanSurat->surat_pengantar_rw, PATHINFO_EXTENSION);
        
        return response()->download($path, $filename);
    }

    /**
     * Download file surat jadi.
     */
    public function downloadSuratJadi(PengajuanSurat $pengajuanSurat)
    {
        // Check if user is authorized: admin bisa download semua, user hanya miliknya sendiri
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        if (!$pengajuanSurat->file_surat_jadi) {
            return redirect()->back()->with('error', 'Surat belum tersedia');
        }

        // Validasi bahwa file ada
        if (!Storage::disk('public')->exists($pengajuanSurat->file_surat_jadi)) {
            return redirect()->back()->with('error', 'File surat tidak ditemukan');
        }

        $path = Storage::disk('public')->path($pengajuanSurat->file_surat_jadi);
        $filename = 'Surat-Jadi-' . $pengajuanSurat->nomor_pengajuan . '.pdf';
        
        return response()->download($path, $filename);
    }
}