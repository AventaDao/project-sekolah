<div class="row">
    <!-- Header Welcome Card -->
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

    <!-- Alert Verifikasi -->
    @if (!$user->is_verified)
    <div class="col-12 mb-3">
        <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-exclamation-triangle fs-4 me-3"></i>
                <div>
                    <strong>Akun Anda belum terverifikasi.</strong> Silakan verifikasi terlebih dahulu untuk mengakses semua fitur layanan desa.
                </div>
            </div>
            <a href="{{ route('verify.form') }}" id="verify-button" class="btn btn-warning btn-sm fw-bold">Verifikasi Sekarang</a>
        </div>
    </div>
    @endif

    @if (session('success'))
    <div class="col-12 mb-3">
        <div class="alert alert-success shadow-sm" role="alert">
            <i class="ti ti-circle-check me-2"></i>{{ session('success') }}
        </div>
    </div>
    @endif

    <!-- Statistik Cards User -->
    <div class="col-md-6 col-xl-4">
        <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #2ca87f !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Pengajuan Saya</p>
                        <h3 class="mb-0 counter" data-count="{{ $stats['my_pengajuan_menunggu'] + $stats['my_pengajuan_diproses'] + $stats['my_pengajuan_selesai'] }}">0</h3>
                        <small class="text-success">
                            <i class="ti ti-trending-up"></i> Total Pengajuan
                        </small>
                    </div>
                    <div class="avatar-lg bg-light-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-file-text text-success" style="font-size: 32px;"></i>
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
                        <p class="text-muted mb-1">Pengaduan Saya</p>
                        <h3 class="mb-0 counter" data-count="{{ $stats['my_pengaduan_menunggu'] + $stats['my_pengaduan_selesai'] }}">0</h3>
                        <small class="text-success">
                            <i class="ti ti-trending-up"></i> Total Pengaduan
                        </small>
                    </div>
                    <div class="avatar-lg bg-light-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-message-report text-success" style="font-size: 32px;"></i>
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
                        <p class="text-muted mb-1">Total Surat Disetujui (Global)</p>
                        <h3 class="mb-0 counter" data-count="{{ $stats['surat_disetujui'] }}">0</h3>
                        <small class="text-success">
                            <i class="ti ti-circle-check"></i> Status Selesai
                        </small>
                    </div>
                    <div class="avatar-lg bg-light-success rounded-circle d-flex align-items-center justify-content-center">
                        <i class="ti ti-file-check text-success" style="font-size: 32px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Surat Status Cards -->
    <div class="col-12 mt-3">
        <h5 class="mb-3"><i class="ti ti-file-text me-2"></i>Status Pengajuan Surat Saya</h5>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-warning rounded me-3">
                        <i class="ti ti-clock text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Menunggu</p>
                        <h4 class="mb-0 counter" data-count="{{ $stats['my_pengajuan_menunggu'] }}">0</h4>
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
                        <h4 class="mb-0 counter" data-count="{{ $stats['my_pengajuan_diproses'] }}">0</h4>
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
                        <h4 class="mb-0 counter" data-count="{{ $stats['my_pengajuan_selesai'] }}">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Status Cards -->
    <div class="col-12 mt-4">
        <h5 class="mb-3"><i class="ti ti-message-report me-2"></i>Status Pengaduan Saya</h5>
    </div>

    <div class="col-md-6 col-xl-6">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-warning rounded me-3">
                        <i class="ti ti-alert-circle text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Menunggu Respon</p>
                        <h4 class="mb-0 counter" data-count="{{ $stats['my_pengaduan_menunggu'] }}">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-6">
        <div class="card hover-card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="avatar-md bg-success rounded me-3">
                        <i class="ti ti-check text-white" style="font-size: 24px;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-muted mb-1">Terselesaikan</p>
                        <h4 class="mb-0 counter" data-count="{{ $stats['my_pengaduan_selesai'] }}">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="ti ti-bolt me-2"></i>Menu Cepat</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ route('pengajuan-surat.create') }}" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-primary rounded-circle mx-auto mb-3">
                                    <i class="ti ti-file-plus text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Ajukan Surat</h6>
                                <small class="text-muted">Buat pengajuan baru</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('pengajuan-surat.index') }}" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-success rounded-circle mx-auto mb-3">
                                    <i class="ti ti-file-text text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Riwayat Pengajuan</h6>
                                <small class="text-muted">Lihat semua pengajuan</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="{{ route('pengaduan.index') }}" class="quick-action-card">
                            <div class="text-center p-3">
                                <div class="avatar-lg bg-info rounded-circle mx-auto mb-3">
                                    <i class="ti ti-message-report text-white" style="font-size: 32px;"></i>
                                </div>
                                <h6 class="mb-0">Pengaduan Saya</h6>
                                <small class="text-muted">Kelola pengaduan</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengajuan Surat Terbaru -->
    @if($recent_pengajuan->count() > 0)
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-file-text me-2"></i>Pengajuan Surat Terbaru</h5>
                <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nomor Pengajuan</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_pengajuan as $pengajuan)
                            <tr>
                                <td><strong>{{ $pengajuan->nomor_pengajuan }}</strong></td>
                                <td>{{ $pengajuan->jenis_surat }}</td>
                                <td>{{ $pengajuan->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $pengajuan->status_badge }}">
                                        {{ $pengajuan->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pengajuan-surat.show', $pengajuan->id) }}" class="btn btn-sm btn-info">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Pengaduan Terbaru -->
    @if($recent_pengaduan->count() > 0)
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-message-report me-2"></i>Pengaduan Terbaru</h5>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-outline-warning">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nomor Pengaduan</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recent_pengaduan as $pengaduan)
                            <tr>
                                <td><strong>{{ $pengaduan->nomor_pengaduan }}</strong></td>
                                <td>{{ Str::limit($pengaduan->judul, 40) }}</td>
                                <td>{{ $pengaduan->created_at->format('d M Y') }}</td>
                                <td>
                                    <span class="badge {{ $pengaduan->status_badge }}">
                                        {{ $pengaduan->status }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('pengaduan.show', $pengaduan->id) }}" class="btn btn-sm btn-info">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
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
    font-size: 32px;
}

.avatar-md {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
}

.bg-light-primary {
    background-color: #e7f1ff !important;
}

.bg-light-success {
    background-color: #e6f7f3 !important;
}

.bg-light-danger {
    background-color: #ffe6e6 !important;
}

.bg-light-warning {
    background-color: #fff3cd !important;
}

.bg-light-info {
    background-color: #e1f5ff !important;
}

/* Quick Action Cards */
.quick-action-card {
    text-decoration: none;
    color: inherit;
    display: block;
    border: 2px solid #f0f0f0;
    border-radius: 8px;
    transition: all 0.3s ease;
    height: 100%;
}

.quick-action-card:hover {
    border-color: #4680ff;
    background-color: #f9fbff;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(70, 128, 255, 0.2);
}

/* Counter Animation */
.counter {
    font-weight: 600;
    color: #4680ff;
}

/* Carousel Styles */
.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    padding: 20px;
}

.carousel-indicators button {
    background-color: rgba(0, 0, 0, 0.5);
}

.carousel-indicators button.active {
    background-color: #4680ff;
}

.carousel-item {
    min-height: 350px;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Counter Animation
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const count = parseInt(counter.dataset.count);
            let current = 0;
            const increment = Math.ceil(count / 30);
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= count) {
                    current = count;
                    clearInterval(timer);
                }
                counter.textContent = current.toLocaleString('id-ID');
            }, 50);
        });

        // Verify button handler
        const verifyButton = document.getElementById('verify-button');
        if (verifyButton) {
            verifyButton.addEventListener('click', function() {
                this.classList.add('disabled');
                this.innerHTML = `
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Memproses...
                `;
            });
        }
    });
</script>