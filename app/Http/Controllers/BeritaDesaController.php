<?php

namespace App\Http\Controllers;

use App\Models\BeritaDesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaDesaController extends Controller
{
    /**
     * Display a listing of berita (public and admin)
     */
    public function index()
    {
        // Check if admin or public user based on route
        if (request()->is('admin/*') || Auth::check() && Auth::user()->role === 'admin') {
            // Admin view with all beritas (draft + publish)
            $beritas = BeritaDesa::with('user')
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('admin.berita.index', compact('beritas'));
        }
        
        // Public view with only published beritas
        $beritas = BeritaDesa::with('user')
            ->where('status', 'publish')
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(10);
        
        return view('admin.berita.index', compact('beritas'));
    }

    /**
     * Show the form for creating a new berita
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Store a newly created berita
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:draft,publish',
        ], [
            'judul.required' => 'Judul berita harus diisi',
            'isi.required' => 'Isi berita harus diisi',
            'gambar.image' => 'File harus berupa gambar',
            'gambar.mimes' => 'Format gambar harus JPEG, PNG, atau JPG',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'tanggal_publikasi.required' => 'Tanggal publikasi harus diisi',
        ]);

        // Upload gambar jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        BeritaDesa::create([
            'judul' => $validated['judul'],
            'isi' => $validated['isi'],
            'gambar' => $gambarPath,
            'tanggal_publikasi' => $validated['tanggal_publikasi'],
            'status' => $validated['status'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Display the specified berita (public and admin)
     */
    public function show(BeritaDesa $beritum)
    {
        // Get related beritas (different id, same status)
        $related_beritas = BeritaDesa::where('status', 'publish')
            ->where('id', '!=', $beritum->id)
            ->orderBy('tanggal_publikasi', 'desc')
            ->get();
        
        // Check if admin route
        if (request()->is('admin/*') || Auth::check() && Auth::user()->role === 'admin') {
            return view('admin.berita.show', compact('beritum'));
        }
        
        // Public route - only show published beritas
        if ($beritum->status !== 'publish') {
            abort(404);
        }
        
        return view('admin.berita.show', compact('beritum', 'related_beritas'));
    }

    /**
     * Show the form for editing berita
     */
    public function edit(BeritaDesa $beritum)
    {
        return view('admin.berita.edit', compact('beritum'));
    }

    /**
     * Update the specified berita
     */
    public function update(Request $request, BeritaDesa $beritum)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:draft,publish',
        ]);

        // Upload gambar baru jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama
            if ($beritum->gambar) {
                Storage::disk('public')->delete($beritum->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        $beritum->update($validated);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Remove the specified berita
     */
    public function destroy(BeritaDesa $beritum)
    {
        // Hapus gambar jika ada
        if ($beritum->gambar) {
            Storage::disk('public')->delete($beritum->gambar);
        }

        $beritum->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}