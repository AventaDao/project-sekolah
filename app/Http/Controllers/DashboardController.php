<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penduduk;
use App\Models\PengajuanSurat;
use App\Models\Pengaduan;
use App\Models\BeritaDesa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } else {
            return $this->userDashboard();
        }
    }

    /**
     * Return JSON stats for dashboard (used by AJAX for real-time updates)
     */
    public function stats(Request $request)
    {
        // Monthly data for current year
        $year = now()->year;
        $pengajuanMonthly = [];
        $pengaduanMonthly = [];

        for ($m = 1; $m <= 12; $m++) {
            $pengajuanMonthly[] = PengajuanSurat::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->count();

            $pengaduanMonthly[] = Pengaduan::whereYear('created_at', $year)
                ->whereMonth('created_at', $m)
                ->count();
        }

        // Status totals
        $pengajuanTotals = [
            'menunggu' => PengajuanSurat::where('status', 'Menunggu')->count(),
            'diproses' => PengajuanSurat::where('status', 'Diproses')->count(),
            'selesai'  => PengajuanSurat::where('status', 'Selesai')->count(),
        ];

        $pengaduanTotals = [
            'menunggu' => Pengaduan::where('status', 'Menunggu')->count(),
            'diproses' => Pengaduan::where('status', 'Diproses')->count(),
            'selesai'  => Pengaduan::where('status', 'Selesai')->count(),
        ];

        // Combined totals used by pie chart
        $combined = [
            'menunggu' => $pengajuanTotals['menunggu'] + $pengaduanTotals['menunggu'],
            'diproses' => $pengajuanTotals['diproses'] + $pengaduanTotals['diproses'],
            'selesai'  => $pengajuanTotals['selesai'] + $pengaduanTotals['selesai'],
        ];

        return response()->json([
            'year' => $year,
            'pengajuan' => [
                'monthly' => $pengajuanMonthly,
                'totals' => $pengajuanTotals,
            ],
            'pengaduan' => [
                'monthly' => $pengaduanMonthly,
                'totals' => $pengaduanTotals,
            ],
            'combined' => $combined,
        ]);
    }

    private function adminDashboard()
    {
        $user = Auth::user();
        
        // Statistik untuk admin
        $stats = [
            // Data Penduduk
            'total_penduduk' => Penduduk::where('status_hidup', 'Hidup')->count(),
            'total_kk' => 0, // Sementara dinonaktifkan karena tidak ada data KK yang valid
            'kelahiran_bulan_ini' => Penduduk::whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->where('status_hidup', 'Hidup')
                ->count(),
            'kematian_bulan_ini' => Penduduk::where('status_hidup', 'Meninggal')
                ->whereMonth('tanggal_meninggal', now()->month)
                ->whereYear('tanggal_meninggal', now()->year)
                ->count(),
            
            // Pengajuan Surat
            'pengajuan_menunggu' => PengajuanSurat::where('status', 'Menunggu')->count(),
            'pengajuan_diproses' => PengajuanSurat::where('status', 'Diproses')->count(),
            'pengajuan_selesai' => PengajuanSurat::where('status', 'Selesai')->count(),
            
            // Pengaduan
            'pengaduan_menunggu' => Pengaduan::where('status', 'Menunggu')->count(),
            'pengaduan_diproses' => Pengaduan::where('status', 'Diproses')->count(),
            'pengaduan_selesai' => Pengaduan::where('status', 'Selesai')->count(),
        ];

        return view('dashboard', compact('stats', 'user'));
    }

    private function userDashboard()
    {
        $user = Auth::user();
        
        // Statistik umum desa
        $stats = [
            'total_penduduk' => Penduduk::where('status_hidup', 'Hidup')->count(),
            'surat_disetujui' => PengajuanSurat::where('status', 'Selesai')->count(),
            'pengaduan_selesai' => Pengaduan::where('status', 'Selesai')->count(),
            
            // Statistik personal user - Pengajuan Surat
            'my_pengajuan_total' => PengajuanSurat::where('user_id', $user->id)->count(),
            'my_pengajuan_menunggu' => PengajuanSurat::where('user_id', $user->id)
                ->where('status', 'Menunggu')->count(),
            'my_pengajuan_diproses' => PengajuanSurat::where('user_id', $user->id)
                ->where('status', 'Diproses')->count(),
            'my_pengajuan_selesai' => PengajuanSurat::where('user_id', $user->id)
                ->where('status', 'Selesai')->count(),
            
            // Statistik personal user - Pengaduan
            'my_pengaduan_total' => Pengaduan::where('user_id', $user->id)->count(),
            'my_pengaduan_menunggu' => Pengaduan::where('user_id', $user->id)
                ->where('status', 'Menunggu')->count(),
            'my_pengaduan_selesai' => Pengaduan::where('user_id', $user->id)
                ->where('status', 'Selesai')->count(),
        ];

        // Data penduduk berdasarkan kategori untuk chart
        $penduduk_by_gender = Penduduk::where('status_hidup', 'Hidup')
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->get();

        $penduduk_by_agama = Penduduk::where('status_hidup', 'Hidup')
            ->select('agama', DB::raw('count(*) as total'))
            ->groupBy('agama')
            ->get();

        // Berita terbaru
        $beritas = BeritaDesa::published()->take(5)->get();

        // Pengajuan surat terbaru user
        $recent_pengajuan = PengajuanSurat::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Pengaduan terbaru user
        $recent_pengaduan = Pengaduan::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'stats', 
            'beritas', 
            'user', 
            'penduduk_by_gender',
            'penduduk_by_agama',
            'recent_pengajuan',
            'recent_pengaduan'
        ));
    }
}