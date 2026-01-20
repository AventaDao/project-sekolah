<div class="row">
    <!-- Header Welcome Card dengan Gradient Modern -->
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white border-0 shadow-lg" style="background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="text-white mb-2">
                            <i class="ti ti-dashboard me-2"></i>Selamat Datang, {{ Auth::user()->name }}!
                        </h3>
                        <p class="text-white-75 mb-0">
                            <i class="ti ti-calendar me-1"></i>{{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </p>
                    </div>
                    <div class="col-md-4 text-end d-none d-md-block">
                        <div class="dashboard-icon">
                            <i class="ti ti-chart-line" style="font-size: 80px; opacity: 0.3;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards Admin dengan Modern Styling -->
    <div class="col-md-6 col-xl-4">
        <div class="card stat-card stat-card-admin stat-card-penduduk border-0">
            <div class="stat-card-bg"></div>
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Total Penduduk</p>
                        <h3 class="mb-0 stat-number">{{ $stats['total_penduduk'] }}</h3>
                        <small class="stat-badge">
                            <i class="ti ti-trending-up"></i> Data Terkini
                        </small>
                    </div>
                    <div class="stat-icon stat-icon-blue">
                        <i class="ti ti-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card stat-card stat-card-admin stat-card-kelahiran border-0">
            <div class="stat-card-bg"></div>
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Kelahiran Bulan Ini</p>
                        <h3 class="mb-0 stat-number"><span class="text-success">+</span>{{ $stats['kelahiran_bulan_ini'] }}</h3>
                        <small class="stat-badge">
                            <i class="ti ti-arrow-up"></i> {{ now()->format('F Y') }}
                        </small>
                    </div>
                    <div class="stat-icon stat-icon-green">
                        <i class="ti ti-trending-up"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card stat-card stat-card-admin stat-card-kematian border-0">
            <div class="stat-card-bg"></div>
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="stat-label mb-1">Kematian Bulan Ini</p>
                        <h3 class="mb-0 stat-number"><span class="text-danger">−</span>{{ $stats['kematian_bulan_ini'] }}</h3>
                        <small class="stat-badge">
                            <i class="ti ti-circle-minus"></i> {{ now()->format('F Y') }}
                        </small>
                    </div>
                    <div class="stat-icon stat-icon-red">
                        <i class="ti ti-trending-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Pengajuan Surat -->
    <div class="col-12 mt-5">
        <h5 class="page-subtitle-header mb-4"><i class="ti ti-file-text me-2"></i>Status Pengajuan Surat</h5>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card status-card border-0" style="background: rgba(255, 152, 0, 0.08);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="status-label mb-1">Menunggu Verifikasi</p>
                        <h3 class="mb-0">{{ $stats['pengajuan_menunggu'] }}</h3>
                    </div>
                    <div class="status-icon" style="background: rgba(255, 152, 0, 0.12); border-radius: 12px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="ti ti-clock" style="color: #ff9800; font-size: 28px;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #ff9800, #ff6f00); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card status-card border-0" style="background: rgba(0, 212, 255, 0.08);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="status-label mb-1">Sedang Diproses</p>
                        <h3 class="mb-0">{{ $stats['pengajuan_diproses'] }}</h3>
                    </div>
                    <div class="status-icon" style="background: rgba(0, 212, 255, 0.12); border-radius: 12px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="ti ti-settings" style="color: #00d4ff; font-size: 28px;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #00d4ff, #00a8cc); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card status-card border-0" style="background: rgba(44, 168, 127, 0.08);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="status-label mb-1">Selesai</p>
                        <h3 class="mb-0">{{ $stats['pengajuan_selesai'] }}</h3>
                    </div>
                    <div class="status-icon" style="background: rgba(44, 168, 127, 0.12); border-radius: 12px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="ti ti-circle-check" style="color: #2ca87f; font-size: 28px;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #2ca87f, #1e7e5d); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Pengaduan Warga -->
    <div class="col-12 mt-5">
        <h5 class="page-subtitle-header mb-4"><i class="ti ti-message-report me-2"></i>Status Pengaduan Warga</h5>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card status-card border-0" style="background: rgba(255, 152, 0, 0.08);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="status-label mb-1">Perlu Ditanggapi</p>
                        <h3 class="mb-0">{{ $stats['pengaduan_menunggu'] }}</h3>
                    </div>
                    <div class="status-icon" style="background: rgba(255, 152, 0, 0.12); border-radius: 12px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="ti ti-alert-circle" style="color: #ff9800; font-size: 28px;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #ff9800, #ff6f00); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card status-card border-0" style="background: rgba(0, 212, 255, 0.08);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="status-label mb-1">Sedang Diproses</p>
                        <h3 class="mb-0">{{ $stats['pengaduan_diproses'] }}</h3>
                    </div>
                    <div class="status-icon" style="background: rgba(0, 212, 255, 0.12); border-radius: 12px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="ti ti-settings" style="color: #00d4ff; font-size: 28px;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #00d4ff, #00a8cc); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card status-card border-0" style="background: rgba(44, 168, 127, 0.08);">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="status-label mb-1">Terselesaikan</p>
                        <h3 class="mb-0">{{ $stats['pengaduan_selesai'] }}</h3>
                    </div>
                    <div class="status-icon" style="background: rgba(44, 168, 127, 0.12); border-radius: 12px; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="ti ti-check" style="color: #2ca87f; font-size: 28px;"></i>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="background: linear-gradient(90deg, #2ca87f, #1e7e5d); width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="col-lg-8 mt-4">
        <div class="card main-card border-0">
            <div class="card-header-modern">
                <div class="header-left">
                    <h5 class="card-title">
                        <i class="ti ti-chart-bar"></i> Statistik Pengajuan & Pengaduan
                    </h5>
                </div>
                <div class="header-right">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-primary active" onclick="updateMainChart('monthly')">Bulanan</button>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="updateMainChart('weekly')">Mingguan</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <canvas id="mainStatsChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mt-4">
        <div class="card main-card border-0">
            <div class="card-header-modern">
                <div class="header-left">
                    <h5 class="card-title">
                        <i class="ti ti-chart-pie"></i> Status Keseluruhan
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <canvas id="statusPieChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.js"></script>
    
    <script>
        let mainChart = null;
        let pieChart = null;
        const statsUrl = '{{ route("dashboard.stats") }}';

        // Wait for Chart.js to load
        function initCharts() {
            if (typeof Chart === 'undefined') {
                console.log('Chart.js loading...');
                setTimeout(initCharts, 100);
                return;
            }

            const mainCtx = document.getElementById('mainStatsChart');
            const pieCtx = document.getElementById('statusPieChart');

            if (mainCtx) {
                mainChart = new Chart(mainCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [
                            {
                                label: 'Pengajuan Surat',
                                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                                backgroundColor: 'rgba(70, 128, 255, 0.8)',
                                borderColor: 'rgba(70, 128, 255, 1)',
                                borderWidth: 2,
                                borderRadius: 5
                            },
                            {
                                label: 'Pengaduan',
                                data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                                backgroundColor: 'rgba(44, 168, 127, 0.8)',
                                borderColor: 'rgba(44, 168, 127, 1)',
                                borderWidth: 2,
                                borderRadius: 5
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top' },
                            tooltip: { mode: 'index', intersect: false }
                        },
                        scales: {
                            y: { beginAtZero: true, ticks: { stepSize: 1 } }
                        }
                    }
                });
            }

            if (pieCtx) {
                pieChart = new Chart(pieCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Menunggu', 'Diproses', 'Selesai'],
                        datasets: [{
                            data: [0, 0, 0],
                            backgroundColor: [
                                'rgba(255, 152, 0, 0.8)',
                                'rgba(0, 212, 255, 0.8)',
                                'rgba(44, 168, 127, 0.8)'
                            ],
                            borderColor: [
                                'rgba(255, 152, 0, 1)',
                                'rgba(0, 212, 255, 1)',
                                'rgba(44, 168, 127, 1)'
                            ],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { position: 'bottom' }
                        }
                    }
                });
            }

            // Fetch and update data
            fetchAndUpdateCharts();
            setInterval(fetchAndUpdateCharts, 5 * 60 * 1000);
        }

        async function fetchAndUpdateCharts() {
            try {
                const response = await fetch(statsUrl, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                if (!response.ok) {
                    console.error('Response status:', response.status);
                    return;
                }

                const data = await response.json();
                console.log('Stats data:', data);

                // Update bar chart
                if (mainChart && data.pengajuan && data.pengaduan) {
                    mainChart.data.datasets[0].data = data.pengajuan.monthly || new Array(12).fill(0);
                    mainChart.data.datasets[1].data = data.pengaduan.monthly || new Array(12).fill(0);
                    mainChart.update('none');
                }

                // Update pie chart
                if (pieChart && data.combined) {
                    pieChart.data.datasets[0].data = [
                        data.combined.menunggu || 0,
                        data.combined.diproses || 0,
                        data.combined.selesai || 0
                    ];
                    pieChart.update('none');
                }
            } catch (error) {
                console.error('Error fetching stats:', error);
            }
        }

        function updateMainChart(mode) {
            document.querySelectorAll('.btn-group button').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            fetchAndUpdateCharts();
        }

        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initCharts);
        } else {
            initCharts();
        }
    </script>

    <!-- Quick Actions -->
    <div class="col-12 mt-4">
        <div class="card main-card border-0">
            <div class="card-header-modern">
                <div class="header-left">
                    <h5 class="card-title">
                        <i class="ti ti-bolt"></i> Quick Actions
                    </h5>
                </div>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="{{ route('admin.penduduk.create') }}" class="quick-action-link">
                            <div class="quick-action-body">
                                <div class="quick-action-icon" style="background: linear-gradient(135deg, #4680ff, #357abd);">
                                    <i class="ti ti-user-plus"></i>
                                </div>
                                <h6 class="quick-action-title">Tambah Penduduk</h6>
                                <small class="quick-action-desc">Data kependudukan baru</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.berita.create') }}" class="quick-action-link">
                            <div class="quick-action-body">
                                <div class="quick-action-icon" style="background: linear-gradient(135deg, #2ca87f, #1e7e5d);">
                                    <i class="ti ti-news"></i>
                                </div>
                                <h6 class="quick-action-title">Buat Berita</h6>
                                <small class="quick-action-desc">Publikasi informasi desa</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.pengajuan-surat.index') }}" class="quick-action-link">
                            <div class="quick-action-body">
                                <div class="quick-action-icon" style="background: linear-gradient(135deg, #ff9800, #ff6f00);">
                                    <i class="ti ti-file-text"></i>
                                </div>
                                <h6 class="quick-action-title">Kelola Surat</h6>
                                <small class="quick-action-desc">Verifikasi pengajuan</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('admin.pengaduan.index') }}" class="quick-action-link">
                            <div class="quick-action-body">
                                <div class="quick-action-icon" style="background: linear-gradient(135deg, #00d4ff, #00a8cc);">
                                    <i class="ti ti-message-report"></i>
                                </div>
                                <h6 class="quick-action-title">Tanggapi Pengaduan</h6>
                                <small class="quick-action-desc">Respon laporan warga</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="col-lg-6 mt-4">
        <div class="card main-card border-0">
            <div class="card-header-modern">
                <div class="header-left">
                    <h5 class="card-title">
                        <i class="ti ti-activity"></i> Aktivitas Pengajuan Terbaru
                    </h5>
                </div>
                <div class="header-right">
                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="activity-timeline">
                    @php
                        $recent_activities = \App\Models\PengajuanSurat::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @forelse($recent_activities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon bg-light-primary">
                            <i class="ti ti-file-text text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">{{ $activity->user->name }}</h6>
                            <p class="mb-0 text-muted">Mengajukan {{ $activity->jenis_surat }}</p>
                            <small class="text-muted">
                                <i class="ti ti-clock me-1"></i>{{ $activity->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <span class="badge {{ $activity->status_badge }}">{{ $activity->status }}</span>
                    </div>
                    @empty
                    <div class="text-center p-4">
                        <i class="ti ti-info-circle f-40 text-muted"></i>
                        <p class="text-muted mb-0">Belum ada aktivitas</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4">
        <div class="card main-card border-0">
            <div class="card-header-modern">
                <div class="header-left">
                    <h5 class="card-title">
                        <i class="ti ti-alert-triangle"></i> Pengaduan Perlu Perhatian
                    </h5>
                </div>
                <div class="header-right">
                    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-outline-warning">Lihat Semua</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="activity-timeline">
                    @php
                        $recent_pengaduan = \App\Models\Pengaduan::with('user')
                            ->where('status', 'Menunggu')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    @endphp
                    
                    @forelse($recent_pengaduan as $pengaduan)
                    <div class="activity-item">
                        <div class="activity-icon bg-light-warning">
                            <i class="ti ti-message-report text-warning"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1">{{ $pengaduan->user->name }}</h6>
                            <p class="mb-0 text-muted">{{ Str::limit($pengaduan->judul, 40) }}</p>
                            <small class="text-muted">
                                <i class="ti ti-clock me-1"></i>{{ $pengaduan->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <span class="badge {{ $pengaduan->status_badge }}">{{ $pengaduan->status }}</span>
                    </div>
                    @empty
                    <div class="text-center p-4">
                        <i class="ti ti-circle-check f-40 text-success"></i>
                        <p class="text-muted mb-0">Tidak ada pengaduan menunggu</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   ADMIN DASHBOARD - MODERN GRADIENT STYLING
   ============================================ */

/* Page Subtitle Header */
.page-subtitle-header {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 8px;
}

.page-subtitle-header i {
    color: #4680ff;
    font-size: 18px;
}

/* Main Card Styling */
.main-card {
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.85) !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.main-card:hover {
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
}

/* Card Header Modern */
.card-header-modern {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(70, 128, 255, 0.05) 100%);
    border-bottom: 1px solid rgba(70, 128, 255, 0.1);
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
}

.header-left .card-title,
.header-right .card-title {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-left .card-title i,
.header-right .card-title i {
    color: #4680ff;
    font-size: 18px;
}

/* Stat Cards Styling */
.stat-card-admin {
    border-radius: 12px !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.85) !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.stat-card-admin:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
}

.stat-card-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 12px;
    z-index: 0;
    opacity: 0.08;
}

.stat-card-penduduk .stat-card-bg {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
}

.stat-card-kelahiran .stat-card-bg {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
}

.stat-card-kematian .stat-card-bg {
    background: linear-gradient(135deg, #ff5370 0%, #dc2626 100%);
}

.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-number {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    display: flex;
    align-items: center;
    gap: 6px;
}

.stat-number .text-success {
    font-size: 32px;
    font-weight: 800;
}

.stat-number .text-danger {
    font-size: 32px;
    font-weight: 800;
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 36px;
    color: white;
    box-shadow: 0 8px 30px rgba(70, 128, 255, 0.25);
}

.stat-icon-blue {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
}

.stat-icon-green {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
}

.stat-icon-red {
    background: linear-gradient(135deg, #ff5370 0%, #dc2626 100%);
}

/* Status Cards */
.status-card {
    border-radius: 12px;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.85) !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
}

.status-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
}

.status-label {
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
}

.status-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

/* Quick Action Link */
.quick-action-link {
    display: block;
    text-decoration: none;
    color: inherit;
    border: 1px solid rgba(70, 128, 255, 0.1);
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.7);
}

.quick-action-link:hover {
    border-color: rgba(70, 128, 255, 0.3);
    background: rgba(70, 128, 255, 0.05);
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(70, 128, 255, 0.15);
}

.quick-action-body {
    text-align: center;
}

.quick-action-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    margin: 0 auto 15px;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
    transition: all 0.3s ease;
}

.quick-action-link:hover .quick-action-icon {
    transform: scale(1.1) translateY(-3px);
}

.quick-action-title {
    font-size: 14px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 6px;
}

.quick-action-desc {
    font-size: 12px;
    color: #6c757d;
    display: block;
}

/* Activity Timeline */
.activity-timeline {
    padding: 0;
}

.activity-item {
    display: flex;
    align-items: center;
    padding: 20px;
    border-bottom: 1px solid rgba(70, 128, 255, 0.1);
    transition: all 0.3s ease;
}

.activity-item:hover {
    background: rgba(70, 128, 255, 0.03);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    flex-shrink: 0;
    font-size: 20px;
}

.bg-light-primary {
    background: rgba(70, 128, 255, 0.1);
}

.bg-light-warning {
    background: rgba(255, 152, 0, 0.1);
}

.text-primary {
    color: #4680ff !important;
}

.text-warning {
    color: #ff9800 !important;
}

.text-success {
    color: #2ca87f !important;
}

.activity-content {
    flex-grow: 1;
}

.activity-content h6 {
    font-weight: 700;
    color: #2c3e50;
    font-size: 14px;
}

.activity-content p {
    font-size: 13px;
    margin-bottom: 6px;
}

.activity-content small {
    font-size: 12px;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* Counter Animation */
.counter {
    display: inline-block;
}

/* Button Group */
.btn-group {
    gap: 6px;
}

.btn-outline-primary {
    border: 1px solid rgba(70, 128, 255, 0.3);
    color: #4680ff;
    transition: all 0.3s ease;
}

.btn-outline-primary:hover,
.btn-outline-primary.active {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    border-color: #4680ff;
    color: white;
}

.btn-outline-warning {
    border: 1px solid rgba(255, 152, 0, 0.3);
    color: #ff9800;
    transition: all 0.3s ease;
}

.btn-outline-warning:hover {
    background: rgba(255, 152, 0, 0.1);
    border-color: #ff9800;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header-modern {
        flex-direction: column;
        gap: 15px;
    }
    
    .header-left,
    .header-right {
        width: 100%;
    }
    
    .btn-group {
        width: 100%;
    }
    
    .btn-group button {
        flex: 1;
    }
}
</style>

</div>