<?php

namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use App\Models\Activity;
use App\Mail\SuratSelesaiMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\SvgWriter;

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
        $user = Auth::user();
        
        return view('user.pengajuan-surat.create', compact('suratTypes', 'user'));
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
                // Add max validation for numeric fields
                if (isset($fieldConfig['max'])) {
                    $rule .= '|max:' . $fieldConfig['max'];
                }
                // Add min validation for numeric fields
                if (isset($fieldConfig['min'])) {
                    $rule .= '|min:' . $fieldConfig['min'];
                }
            } elseif ($fieldConfig['type'] === 'date') {
                // Field tanggal bisa dipilih tanggal apa saja (lampau, sekarang, atau depan)
                $rule .= '|date';
            } elseif ($fieldConfig['type'] === 'file') {
                $rule .= '|file|max:5120';
                // Add mime type validation based on accept attribute
                if (isset($fieldConfig['accept'])) {
                    if (strpos($fieldConfig['accept'], 'pdf') !== false) {
                        $rule .= '|mimes:pdf,jpg,jpeg,png';
                    } elseif (strpos($fieldConfig['accept'], 'image') !== false) {
                        $rule .= '|mimes:jpg,jpeg,png';
                    }
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
            if ($fieldConfig['type'] === 'file' && $request->hasFile($fieldName)) {
                // Handle file upload
                $filePath = $request->file($fieldName)->store('pengajuan-surat-files', 'public');
                $dataToSave[$fieldName] = $filePath;
            } elseif (isset($validated[$fieldName])) {
                $dataToSave[$fieldName] = $validated[$fieldName];
            }
        }

        // Simpan data pengajuan
        $pengajuanSurat = PengajuanSurat::create($dataToSave);

        // Log activity
        Activity::log('pengajuan_surat_create', "Membuat pengajuan surat: $nomorPengajuan ($validated[jenis_surat])", $pengajuanSurat->id, 'PengajuanSurat');

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

        // Validasi: Status Selesai membutuhkan file surat jadi
        if ($validated['status'] === 'Selesai') {
            if (!$request->hasFile('file_surat_jadi') && !$pengajuanSurat->file_surat_jadi) {
                return redirect()->back()
                    ->withErrors(['file_surat_jadi' => 'Surat jadi harus diupload sebelum status dapat diubah menjadi "Selesai"'])
                    ->withInput();
            }
        }

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

        // Set tanggal diproses jika berubah dari Menunggu ke Diproses
        if ($validated['status'] === 'Diproses' && $pengajuanSurat->status !== 'Diproses') {
            $data['tanggal_diproses'] = now();
        }

        // Set tanggal selesai jika status selesai
        if ($validated['status'] === 'Selesai') {
            $data['tanggal_selesai'] = now();
            // Jika belum ada tanggal diproses, set sekarang (skip dari Menunggu langsung ke Selesai)
            if (!$pengajuanSurat->tanggal_diproses) {
                $data['tanggal_diproses'] = now();
            }
        }

        // Set tanggal ditolak jika status ditolak
        if ($validated['status'] === 'Ditolak') {
            $data['tanggal_ditolak'] = now();
            // Jika belum ada tanggal diproses, set sekarang (skip dari Menunggu langsung ke Ditolak)
            if (!$pengajuanSurat->tanggal_diproses) {
                $data['tanggal_diproses'] = now();
            }
        }

        // Check if status will change to "Selesai" BEFORE updating
        $isChangingToSelesai = ($validated['status'] === 'Selesai' && $pengajuanSurat->status !== 'Selesai');
        
        \Log::info('Update status pengajuan surat', [
            'nomor_pengajuan' => $pengajuanSurat->nomor_pengajuan,
            'status_lama' => $pengajuanSurat->status,
            'status_baru' => $validated['status'],
            'isChangingToSelesai' => $isChangingToSelesai,
            'user_email' => $pengajuanSurat->user->email ?? 'No email'
        ]);

        $pengajuanSurat->update($data);

        // Send email notification if status changed to "Selesai"
        if ($isChangingToSelesai) {
            try {
                // Refresh to get updated data
                $pengajuanSurat->refresh();
                Mail::to($pengajuanSurat->user->email)
                    ->send(new SuratSelesaiMail($pengajuanSurat));
                \Log::info('✓ Email notifikasi surat selesai berhasil dikirim', [
                    'nomor_pengajuan' => $pengajuanSurat->nomor_pengajuan,
                    'ke_email' => $pengajuanSurat->user->email
                ]);
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::error('✗ Failed to send email notification', [
                    'nomor_pengajuan' => $pengajuanSurat->nomor_pengajuan,
                    'ke_email' => $pengajuanSurat->user->email,
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]);
            }
        } else {
            \Log::info('Email tidak dikirim karena kondisi tidak terpenuhi', [
                'isChangingToSelesai' => $isChangingToSelesai
            ]);
        }

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

        // Log activity
        $nomorPengajuan = $pengajuanSurat->nomor_pengajuan;
        Activity::log('pengajuan_surat_delete', "Membatalkan pengajuan surat: $nomorPengajuan", $pengajuanSurat->id, 'PengajuanSurat');

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
        
        // Log activity
        Activity::log('pengajuan_surat_download', "Download surat pengantar RW: {$pengajuanSurat->nomor_pengajuan}", $pengajuanSurat->id, 'PengajuanSurat');

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
        // Replace "/" with "-" in nomor_pengajuan to avoid invalid filename characters
        $safeNomorPengajuan = str_replace('/', '-', $pengajuanSurat->nomor_pengajuan);
        $filename = 'Surat-Jadi-' . $safeNomorPengajuan . '.pdf';
        
        return response()->download($path, $filename);
    }

    /**
     * Export pengajuan surat ke PDF dengan dompdf
     */
    public function exportPdf($id)
    {
        $pengajuanSurat = PengajuanSurat::findOrFail($id);

        // Pastikan user hanya bisa export pengajuan miliknya
        if ($pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // Ambil data user untuk laporan
        $user = $pengajuanSurat->user;
        
        // Generate QR Code sebagai PNG base64 untuk html2pdf compatibility
        try {
            $qrCode = new QrCode(route('letter.verify', $pengajuanSurat->id));
            $writer = new PngWriter();
            $result = $writer->write($qrCode);
            $qrCodeBase64 = 'data:image/png;base64,' . base64_encode($result->getString());
        } catch (\Exception $e) {
            // Fallback ke SVG jika PNG gagal (GD extension tidak tersedia)
            $qrCode = new QrCode(route('letter.verify', $pengajuanSurat->id));
            $writer = new SvgWriter();
            $result = $writer->write($qrCode);
            $qrCodeBase64 = 'data:image/svg+xml;base64,' . base64_encode($result->getString());
        }
        
        // Generate PDF menggunakan dompdf dengan tampilan pdf-export yang rapi
        $pdf = Pdf::loadView('user.pengajuan-surat.pdf-export', compact('pengajuanSurat', 'user', 'qrCodeBase64'));
        
        // Setting ukuran kertas dan orientasi
        $pdf->setPaper('A4', 'portrait');
        
        // Return sebagai download
        // Sanitize nomor pengajuan untuk filename (ganti "/" dengan "-")
        $nomorSanitized = str_replace('/', '-', $pengajuanSurat->nomor_pengajuan);
        $filename = 'Pengajuan-Surat-' . $nomorSanitized . '.pdf';
        return $pdf->download($filename);
    }

    /**
     * Print preview pengajuan surat
     */
    public function printPreview($id)
    {
        $pengajuanSurat = PengajuanSurat::findOrFail($id);

        // Pastikan user hanya bisa preview pengajuan miliknya
        if ($pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $user = $pengajuanSurat->user;
        
        // Generate QR Code menggunakan online service
        // URL akan otomatis menyesuaikan dengan server yang sedang digunakan (localhost atau ngrok)
        $verifyUrl = route('letter.verify', $pengajuanSurat->id);
        $qrCodeUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' . urlencode($verifyUrl);
        
        return view('user.pengajuan-surat.pdf-preview', compact('pengajuanSurat', 'user', 'qrCodeUrl'));
    }

    /**
     * Preview file dinamis (untuk admin dan user view detail).
     */
    public function previewFile(PengajuanSurat $pengajuanSurat, $fieldName)
    {
        // Check authorization
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // Validasi fieldName hanya berisi alphanumeric dan underscore
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $fieldName)) {
            abort(400, 'Invalid field name');
        }

        // Get file value dari model
        $fileValue = $pengajuanSurat->{$fieldName} ?? null;

        if (!$fileValue || !Storage::disk('public')->exists($fileValue)) {
            abort(404, 'File tidak ditemukan');
        }

        $path = Storage::disk('public')->path($fileValue);
        $mimeType = 'application/octet-stream';
        
        // Detect MIME type berdasarkan extension
        $ext = strtolower(pathinfo($fileValue, PATHINFO_EXTENSION));
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'txt' => 'text/plain',
        ];
        
        if (isset($mimeTypes[$ext])) {
            $mimeType = $mimeTypes[$ext];
        }
        
        // Log activity
        Activity::log('pengajuan_surat_preview', "Preview file: {$fieldName} dari pengajuan {$pengajuanSurat->nomor_pengajuan}", $pengajuanSurat->id, 'PengajuanSurat');

        return response()->file($path, ['Content-Type' => $mimeType]);
    }

    /**
     * Download file dinamis (untuk admin dan user).
     */
    public function downloadFile(PengajuanSurat $pengajuanSurat, $fieldName)
    {
        // Check authorization
        if (Auth::user()->role !== 'admin' && $pengajuanSurat->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        // Validasi fieldName hanya berisi alphanumeric dan underscore
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $fieldName)) {
            abort(400, 'Invalid field name');
        }

        // Get file value dari model
        $fileValue = $pengajuanSurat->{$fieldName} ?? null;

        if (!$fileValue || !Storage::disk('public')->exists($fileValue)) {
            abort(404, 'File tidak ditemukan');
        }

        $path = Storage::disk('public')->path($fileValue);
        $filename = basename($fileValue);
        
        // Log activity
        Activity::log('pengajuan_surat_download', "Download file: {$fieldName} dari pengajuan {$pengajuanSurat->nomor_pengajuan}", $pengajuanSurat->id, 'PengajuanSurat');

        return response()->download($path, $filename);
    }
}