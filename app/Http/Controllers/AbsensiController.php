<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    // Admin: list karyawan dan status absensi hari ini
    public function adminIndex(Request $request)
    {
        $today = $request->query('tanggal') ? $request->query('tanggal') : now()->toDateString();
        $karyawans = Karyawan::with(['absensis' => function($q) use ($today) {
            $q->where('tanggal', $today);
        }])->get();

        return view('admin.absensi.index', compact('karyawans', 'today'));
    }

    // Karyawan dashboard / form absensi
    public function employeeDashboard(Request $request)
    {
        // Get related karyawan record by authenticated user
        $karyawan = Karyawan::where('user_id', Auth::id())->first();
        if (!$karyawan) {
            return redirect()->back()->with('error', 'Profil karyawan belum terdaftar.');
        }

        $today = now()->toDateString();
        $absenDatang = $karyawan->absensis()->where('tanggal', $today)->where('jenis', 'Datang')->first();
        $absenPulang = $karyawan->absensis()->where('tanggal', $today)->where('jenis', 'Pulang')->first();

        return view('karyawan.absensi', compact('karyawan', 'absenDatang', 'absenPulang'));
    }

    // Store attendance
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:Datang,Pulang',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'jam' => 'nullable|date_format:H:i',
            'lokasi' => 'nullable|string',
        ]);

        $karyawan = Karyawan::where('user_id', Auth::id())->first();
        if (!$karyawan) return redirect()->back()->with('error', 'Profil karyawan belum terdaftar.');

        // Prevent duplicate same jenis for the same date
        $tanggal = now()->toDateString();
        $exists = Absensi::where('karyawan_id', $karyawan->id)
            ->where('jenis', $request->jenis)
            ->where('tanggal', $tanggal)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Anda sudah melakukan absen ' . $request->jenis . ' hari ini');
        }

        $path = $request->file('foto')->store('absensi', 'public');

        $jam = $request->jam ? now()->setTimeFromTimeString($request->jam) : now();

        Absensi::create([
            'karyawan_id' => $karyawan->id,
            'jenis' => $request->jenis,
            'foto' => $path,
            'jam' => $jam,
            'tanggal' => $tanggal,
            'lokasi' => $request->lokasi,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Absensi ' . $request->jenis . ' berhasil disimpan');
    }
}
