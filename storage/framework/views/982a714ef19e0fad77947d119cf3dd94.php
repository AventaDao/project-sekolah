<div class="row">
    <!-- Header Welcome Card -->
    <div class="col-12 mb-4">
        <div class="card bg-primary text-white border-0 shadow-lg" style="background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="text-white mb-2">
                            <i class="ti ti-dashboard me-2"></i>Selamat Datang, <?php echo e(Auth::user()->name); ?>!
                        </h3>
                        <p class="text-white-75 mb-0">
                            <i class="ti ti-calendar me-1"></i><?php echo e(now()->locale('id')->isoFormat('dddd, D MMMM Y')); ?>

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

    <!-- Statistik Cards dengan Animasi -->
    <div class="col-md-6 col-xl-4">
        <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #4680ff !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Total Penduduk</p>
                        <h3 class="mb-0 counter" data-count="<?php echo e($stats['total_penduduk']); ?>">0</h3>
                        <small class="text-success">
                            <i class="ti ti-trending-up"></i> Data Terkini
                        </small>
                    </div>
                    <div class="avatar-lg bg-light-primary rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-users text-primary" style="font-size: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #2ca87f !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Kelahiran Bulan Ini</p>
                        <h3 class="mb-0 counter" data-count="<?php echo e($stats['kelahiran_bulan_ini']); ?>">0</h3>
                        <small class="text-success">
                            <i class="ti ti-arrow-up"></i> <?php echo e(now()->format('F Y')); ?>

                        </small>
                    </div>
                    <div class="avatar-lg bg-light-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-baby-bottle text-success" style="font-size: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #dc2626 !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Kematian Bulan Ini</p>
                        <h3 class="mb-0 counter" data-count="<?php echo e($stats['kematian_bulan_ini']); ?>">0</h3>
                        <small class="text-danger">
                            <i class="ti ti-circle-minus"></i> <?php echo e(now()->format('F Y')); ?>

                        </small>
                    </div>
                    <div class="avatar-lg bg-light-danger rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-heartbreak text-danger" style="font-size: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Surat Cards -->
    <div class="col-12 mt-3">
        <h5 class="mb-3"><i class="ti ti-file-text me-2"></i>Status Pengajuan Surat</h5>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-warning rounded me-3">
                        <i class="ti ti-clock text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Menunggu Verifikasi</p>
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['pengajuan_menunggu']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-info rounded me-3">
                        <i class="ti ti-settings text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Sedang Diproses</p>
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['pengajuan_diproses']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-success rounded me-3">
                        <i class="ti ti-circle-check text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Selesai</p>
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['pengajuan_selesai']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Cards -->
    <div class="col-12 mt-4">
        <h5 class="mb-3"><i class="ti ti-message-report me-2"></i>Status Pengaduan Warga</h5>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-warning rounded me-3">
                        <i class="ti ti-alert-circle text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Perlu Ditanggapi</p>
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['pengaduan_menunggu']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-info rounded me-3">
                        <i class="ti ti-progress text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Dalam Proses</p>
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['pengaduan_diproses']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-success rounded me-3">
                        <i class="ti ti-check text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Terselesaikan</p>
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['pengaduan_selesai']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="col-lg-8 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="mb-0"><i class="ti ti-chart-bar me-2"></i>Statistik Pengajuan & Pengaduan</h5>
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
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="ti ti-chart-pie me-2"></i>Status Keseluruhan</h5>
            </div>
            <div class="card-body">
                <canvas id="statusPieChart" height="280"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="ti ti-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.penduduk.create')); ?>" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-primary rounded-circle mx-auto mb-3">
                                    <i class="ti ti-user-plus text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Tambah Penduduk</h6>
                                <small class="text-muted">Data kependudukan baru</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.berita.create')); ?>" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-success rounded-circle mx-auto mb-3">
                                    <i class="ti ti-news text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Buat Berita</h6>
                                <small class="text-muted">Publikasi informasi desa</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.pengajuan-surat.index')); ?>" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-warning rounded-circle mx-auto mb-3">
                                    <i class="ti ti-file-text text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Kelola Surat</h6>
                                <small class="text-muted">Verifikasi pengajuan</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-info rounded-circle mx-auto mb-3">
                                    <i class="ti ti-message-report text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Tanggapi Pengaduan</h6>
                                <small class="text-muted">Respon laporan warga</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities -->
    <div class="col-lg-6 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-activity me-2"></i>Aktivitas Terbaru</h5>
                <a href="<?php echo e(route('admin.pengajuan-surat.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="activity-timeline">
                    <?php
                        $recent_activities = \App\Models\PengajuanSurat::with('user')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    ?>
                    
                    <?php $__empty_1 = true; $__currentLoopData = $recent_activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="activity-item">
                        <div class="activity-icon bg-light-primary">
                            <i class="ti ti-file-text text-primary"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1"><?php echo e($activity->user->name); ?></h6>
                            <p class="mb-0 text-muted">Mengajukan <?php echo e($activity->jenis_surat); ?></p>
                            <small class="text-muted">
                                <i class="ti ti-clock me-1"></i><?php echo e($activity->created_at->diffForHumans()); ?>

                            </small>
                        </div>
                        <span class="badge <?php echo e($activity->status_badge); ?>"><?php echo e($activity->status); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center p-4">
                        <i class="ti ti-info-circle f-40 text-muted"></i>
                        <p class="text-muted mb-0">Belum ada aktivitas</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-alert-triangle me-2"></i>Pengaduan Perlu Perhatian</h5>
                <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="btn btn-sm btn-outline-warning">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="activity-timeline">
                    <?php
                        $recent_pengaduan = \App\Models\Pengaduan::with('user')
                            ->where('status', 'Menunggu')
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
                    ?>
                    
                    <?php $__empty_1 = true; $__currentLoopData = $recent_pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengaduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="activity-item">
                        <div class="activity-icon bg-light-warning">
                            <i class="ti ti-message-report text-warning"></i>
                        </div>
                        <div class="activity-content">
                            <h6 class="mb-1"><?php echo e($pengaduan->user->name); ?></h6>
                            <p class="mb-0 text-muted"><?php echo e(Str::limit($pengaduan->judul, 40)); ?></p>
                            <small class="text-muted">
                                <i class="ti ti-clock me-1"></i><?php echo e($pengaduan->created_at->diffForHumans()); ?>

                            </small>
                        </div>
                        <span class="badge <?php echo e($pengaduan->status_badge); ?>"><?php echo e($pengaduan->status); ?></span>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center p-4">
                        <i class="ti ti-circle-check f-40 text-success"></i>
                        <p class="text-muted mb-0">Tidak ada pengaduan menunggu</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Card Animations */
.stat-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.hover-card {
    transition: all 0.3s ease;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

/* Avatar Styles */
.avatar-lg {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.avatar-md {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Quick Action Cards */
.quick-action-card {
    display: block;
    text-decoration: none;
    color: inherit;
    border: 2px solid #e9ecef;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.quick-action-card:hover {
    border-color: #4680ff;
    background: #f8f9ff;
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(70, 128, 255, 0.15);
}

/* Activity Timeline */
.activity-timeline {
    padding: 0;
}

.activity-item {
    display: flex;
    align-items: start;
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
    transition: background 0.3s ease;
}

.activity-item:hover {
    background: #f8f9fa;
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
}

.activity-content {
    flex-grow: 1;
}

/* Counter Animation */
.counter {
    display: inline-block;
}

/* Pulse Animation for Important Cards */
@keyframes pulse {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(70, 128, 255, 0.4);
    }
    50% {
        box-shadow: 0 0 0 10px rgba(70, 128, 255, 0);
    }
}

.stat-card:hover .avatar-lg {
    animation: pulse 2s infinite;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter Animation
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 1500;
        const increment = target / (duration / 16);
        let current = 0;
        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        updateCounter();
    });

    // Main Stats Chart (Harian, 7 hari terakhir)
    const mainCtx = document.getElementById('mainStatsChart');
    // Default label: 7 hari terakhir (akan diupdate dari backend)
    let defaultLabels = [];
    for (let i = 6; i >= 0; i--) {
        const d = new Date();
        d.setDate(d.getDate() - i);
        defaultLabels.push(d.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' }));
    }
    const mainChart = new Chart(mainCtx, {
        type: 'bar',
        data: {
            labels: defaultLabels,
            datasets: [
                {
                    label: 'Pengajuan Surat',
                    data: new Array(7).fill(0),
                    backgroundColor: 'rgba(70, 128, 255, 0.8)',
                    borderColor: 'rgba(70, 128, 255, 1)',
                    borderWidth: 2,
                    borderRadius: 5
                },
                {
                    label: 'Pengaduan',
                    data: new Array(7).fill(0),
                    backgroundColor: 'rgba(44, 202, 127, 0.8)',
                    borderColor: 'rgba(44, 202, 127, 1)',
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
                y: { beginAtZero: true, grid: { color: 'rgba(0, 0, 0, 0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // Status Pie Chart (tidak berubah)
    const pieCtx = document.getElementById('statusPieChart');
    const pieChart = new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: ['Menunggu', 'Diproses', 'Selesai'],
            datasets: [{
                data: [0, 0, 0],
                backgroundColor: [
                    'rgba(245, 158, 11, 0.8)',
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(34, 197, 94, 0.8)'
                ],
                borderWidth: 3,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Function to fetch stats via AJAX and update charts
    async function fetchAndUpdateStats() {
        try {
            const res = await fetch('<?php echo e(route('dashboard.stats')); ?>', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            if (!res.ok) throw new Error('Network response was not ok');
            const data = await res.json();

            // Update main chart datasets (harian)
            if (data.pengajuan && data.pengaduan && data.labels) {
                mainChart.data.labels = data.labels; // label: tanggal (misal 7 hari terakhir)
                mainChart.data.datasets[0].data = data.pengajuan.daily; // array jumlah pengajuan per hari
                mainChart.data.datasets[1].data = data.pengaduan.daily; // array jumlah pengaduan per hari
                mainChart.update();
            }

            // Update pie chart using combined totals
            if (data.combined) {
                pieChart.data.datasets[0].data = [
                    data.combined.menunggu || 0,
                    data.combined.diproses || 0,
                    data.combined.selesai || 0
                ];
                pieChart.update();
            }

            // Update numeric counters in the DOM (if present)
            const counters = document.querySelectorAll('.counter');
            counters.forEach(node => {
                const key = node.getAttribute('data-key');
                if (!key) return;
                let value = 0;
                if (key === 'total_penduduk' && data.totals) value = data.totals.total_penduduk || 0;
                // other keys can be added as needed
                node.textContent = value;
            });

        } catch (err) {
            console.error('Failed to fetch dashboard stats:', err);
        }
    }

    // Initial fetch and periodic refresh every 15s
    fetchAndUpdateStats();
    setInterval(fetchAndUpdateStats, 15000);

    // Function to update main chart
    window.updateMainChart = function(period) {
        // Toggle active button
        document.querySelectorAll('.btn-group button').forEach(btn => {
            btn.classList.remove('active');
        });
        event.target.classList.add('active');

        // Update chart data based on period
        if (period === 'weekly') {
            mainChart.data.labels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
            mainChart.data.datasets[0].data = [5, 7, 6, 9, 8, 4, 3];
            mainChart.data.datasets[1].data = [3, 4, 5, 6, 5, 2, 1];
        } else {
            mainChart.data.labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'];
            mainChart.data.datasets[0].data = [12, 19, 15, 25, 22, 30, 28, 35, 32, 38, 40, 45];
            mainChart.data.datasets[1].data = [8, 11, 9, 15, 12, 18, 15, 20, 18, 22, 25, 28];
        }
        mainChart.update();
    };
});
</script><?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>