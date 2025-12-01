<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Kelahiran;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Penduduk::where('status_hidup', 'Hidup');

        // Filter berdasarkan status akun
        if ($request->has('filter_account')) {
            if ($request->filter_account === 'has_account') {
                $query->hasUserAccount();
            } elseif ($request->filter_account === 'no_account') {
                $query->noUserAccount();
            }
        }

        // Filter berdasarkan pencarian
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nik', 'like', "%{$search}%")
                  ->orWhere('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $penduduks = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('admin.penduduk.index', compact('penduduks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.penduduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:penduduks,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|size:5',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            // Validasi kelahiran
            'buat_kelahiran_baru' => 'nullable|boolean',
            'nomor_akta_kelahiran' => 'nullable|string|max:255',
            'tanggal_daftar_kelahiran' => 'nullable|date',
            'penolong_kelahiran' => 'nullable|in:Dokter,Bidan,Perawat,Dukun,Keluarga,Lainnya',
            'tempat_kelahiran' => 'nullable|in:Rumah Sakit,Klinik,Puskesmas,Rumah,Lainnya',
            'berat_bayi' => 'nullable|numeric|min:0|max:10',
            'panjang_bayi' => 'nullable|numeric|min:0|max:100',
        ]);

        // Pisahkan data penduduk dan kelahiran
        $pendudukData = [
            'nik' => $validated['nik'],
            'nama_lengkap' => $validated['nama_lengkap'],
            'tempat_lahir' => $validated['tempat_lahir'],
            'tanggal_lahir' => $validated['tanggal_lahir'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'alamat' => $validated['alamat'],
            'rt' => $validated['rt'],
            'rw' => $validated['rw'],
            'desa' => $validated['desa'],
            'kecamatan' => $validated['kecamatan'],
            'kabupaten' => $validated['kabupaten'],
            'provinsi' => $validated['provinsi'],
            'kode_pos' => $validated['kode_pos'],
            'agama' => $validated['agama'],
            'status_perkawinan' => $validated['status_perkawinan'],
            'pekerjaan' => $validated['pekerjaan'],
            'kewarganegaraan' => $validated['kewarganegaraan'],
            'pendidikan_terakhir' => $validated['pendidikan_terakhir'],
            'nama_ayah' => $validated['nama_ayah'],
            'nama_ibu' => $validated['nama_ibu'],
            'no_telepon' => $validated['no_telepon'],
        ];

        // Simpan penduduk
        $penduduk = Penduduk::create($pendudukData);

        // Jika checkbox buat_kelahiran_baru dicentang, simpan data kelahiran
        if ($request->has('buat_kelahiran_baru') && $request->buat_kelahiran_baru) {
            $kelahiranData = [
                'penduduk_id' => $penduduk->id,
                'nomor_akta' => $validated['nomor_akta_kelahiran'] ?? null,
                'tanggal_daftar' => $validated['tanggal_daftar_kelahiran'] ?? null,
                'penolong' => $validated['penolong_kelahiran'] ?? null,
                'tempat' => $validated['tempat_kelahiran'] ?? null,
                'berat' => $validated['berat_bayi'] ?? null,
                'panjang' => $validated['panjang_bayi'] ?? null,
            ];

            Kelahiran::create($kelahiranData);
        }

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penduduk $penduduk)
    {
        return view('admin.penduduk.show', compact('penduduk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penduduk $penduduk)
    {
        return view('admin.penduduk.edit', compact('penduduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Penduduk $penduduk)
    {
        $validated = $request->validate([
            'nik' => 'required|string|size:16|unique:penduduks,nik,' . $penduduk->id,
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|size:5',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'pekerjaan' => 'required|string|max:255',
            'kewarganegaraan' => 'required|in:WNI,WNA',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'no_telepon' => 'nullable|string|max:15',
            'status_hidup' => 'required|in:Hidup,Meninggal',
            'tanggal_meninggal' => 'nullable|date|required_if:status_hidup,Meninggal',
        ]);

        $penduduk->update($validated);

        // Sync data ke akun user jika penduduk memiliki akun
        if ($penduduk->hasAccount()) {
            $user = $penduduk->user();
            
            // Field yang akan disinkronkan
            $syncFields = [
                'nik',
                'nama_lengkap',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'alamat',
                'rt',
                'rw',
                'desa',
                'kecamatan',
                'kabupaten',
                'provinsi',
                'kode_pos',
                'agama',
                'status_perkawinan',
                'pekerjaan',
                'kewarganegaraan',
                'pendidikan_terakhir',
                'nama_ayah',
                'nama_ibu',
                'no_telepon',
            ];
            
            // Update user dengan data yang sama
            $syncData = [];
            foreach ($syncFields as $field) {
                $syncData[$field] = $validated[$field] ?? null;
            }
            
            $user->update($syncData);
        }

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui! Akun user juga telah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus!');
    }
}