<div class="row">
    <!-- Statistik Desa -->
    <div class="col-md-6 col-xl-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-primary">
                            <i class="ti ti-users f-24"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Total Penduduk Desa</h6>
                        <h3 class="mb-0 mt-2"><?php echo e(number_format($stats['total_penduduk'])); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-success">
                            <i class="ti ti-file-check f-24"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Surat Disetujui</h6>
                        <h3 class="mb-0 mt-2"><?php echo e(number_format($stats['surat_disetujui'])); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="avtar avtar-s bg-light-info">
                            <i class="ti ti-circle-check f-24"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0 text-muted">Pengaduan Selesai</h6>
                        <h3 class="mb-0 mt-2"><?php echo e(number_format($stats['pengaduan_selesai'])); ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Personal User -->
    <div class="col-12 mt-4">
        <h5 class="mb-3"><i class="ti ti-user me-2"></i>Statistik Aktivitas Saya</h5>
    </div>

    <!-- Pengajuan Surat Saya -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="ti ti-file-text me-2"></i>Pengajuan Surat Saya</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-4">
                        <div class="p-3">
                            <h4 class="mb-1 text-warning"><?php echo e($stats['my_pengajuan_menunggu']); ?></h4>
                            <p class="mb-0 text-muted">Menunggu</p>
                        </div>
                    </div>
                    <div class="col-4 border-start border-end">
                        <div class="p-3">
                            <h4 class="mb-1 text-info"><?php echo e($stats['my_pengajuan_diproses']); ?></h4>
                            <p class="mb-0 text-muted">Diproses</p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="p-3">
                            <h4 class="mb-1 text-success"><?php echo e($stats['my_pengajuan_selesai']); ?></h4>
                            <p class="mb-0 text-muted">Selesai</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-outline-primary btn-sm w-100">
                        <i class="ti ti-eye me-1"></i>Lihat Semua Pengajuan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Saya -->
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="ti ti-message-report me-2"></i>Pengaduan Saya</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-6">
                        <div class="p-3">
                            <h4 class="mb-1 text-warning"><?php echo e($stats['my_pengaduan_menunggu']); ?></h4>
                            <p class="mb-0 text-muted">Menunggu</p>
                        </div>
                    </div>
                    <div class="col-6 border-start">
                        <div class="p-3">
                            <h4 class="mb-1 text-success"><?php echo e($stats['my_pengaduan_selesai']); ?></h4>
                            <p class="mb-0 text-muted">Selesai</p>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="<?php echo e(route('pengaduan.index')); ?>" class="btn btn-outline-info btn-sm w-100">
                        <i class="ti ti-eye me-1"></i>Lihat Semua Pengaduan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Demografi Penduduk -->
    <div class="col-lg-6 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h6 class="mb-0"><i class="ti ti-chart-pie me-2"></i>Demografi Berdasarkan Jenis Kelamin</h6>
            </div>
            <div class="card-body">
                <canvas id="genderChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header">
                <h6 class="mb-0"><i class="ti ti-chart-donut me-2"></i>Demografi Berdasarkan Agama</h6>
            </div>
            <div class="card-body">
                <canvas id="agamaChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Pengajuan Surat Terbaru -->
    <?php if($recent_pengajuan->count() > 0): ?>
    <div class="col-12 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="ti ti-file-text me-2"></i>Pengajuan Surat Terbaru</h6>
                <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
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
                            <?php $__currentLoopData = $recent_pengajuan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengajuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($pengajuan->nomor_pengajuan); ?></strong></td>
                                <td><?php echo e($pengajuan->jenis_surat); ?></td>
                                <td><?php echo e($pengajuan->created_at->format('d M Y')); ?></td>
                                <td>
                                    <span class="badge <?php echo e($pengajuan->status_badge); ?>">
                                        <?php echo e($pengajuan->status); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('pengajuan-surat.show', $pengajuan->id)); ?>" class="btn btn-sm btn-info">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Pengaduan Terbaru -->
    <?php if($recent_pengaduan->count() > 0): ?>
    <div class="col-12 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0"><i class="ti ti-message-report me-2"></i>Pengaduan Terbaru</h6>
                <a href="<?php echo e(route('pengaduan.index')); ?>" class="btn btn-sm btn-info">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nomor Pengaduan</th>
                                <th>Kategori</th>
                                <th>Judul</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $recent_pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengaduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($pengaduan->nomor_pengaduan); ?></strong></td>
                                <td>
                                    <span class="badge bg-light text-dark">
                                        <i class="ti <?php echo e($pengaduan->kategori_icon); ?> me-1"></i>
                                        <?php echo e(Str::limit($pengaduan->kategori, 15)); ?>

                                    </span>
                                </td>
                                <td><?php echo e(Str::limit($pengaduan->judul, 30)); ?></td>
                                <td><?php echo e($pengaduan->created_at->format('d M Y')); ?></td>
                                <td>
                                    <span class="badge <?php echo e($pengaduan->status_badge); ?>">
                                        <?php echo e($pengaduan->status); ?>

                                    </span>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('pengaduan.show', $pengaduan->id)); ?>" class="btn btn-sm btn-info">
                                        <i class="ti ti-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Berita Desa Section -->
    <div class="col-12 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-news me-2"></i>Berita Terbaru Desa</h5>
                <span class="badge bg-light text-primary"><?php echo e($beritas->count()); ?> Berita</span>
            </div>
            <div class="card-body p-0">
                <?php if($beritas->count() > 0): ?>
                <div id="beritaCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <button type="button" data-bs-target="#beritaCarousel" data-bs-slide-to="<?php echo e($key); ?>" 
                                class="<?php echo e($key == 0 ? 'active' : ''); ?>" 
                                aria-current="<?php echo e($key == 0 ? 'true' : 'false'); ?>" 
                                aria-label="Slide <?php echo e($key + 1); ?>"></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                    <div class="carousel-inner">
                        <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="carousel-item <?php echo e($key == 0 ? 'active' : ''); ?>">
                            <div class="row g-0">
                                <?php if($berita->gambar): ?>
                                <div class="col-md-5">
                                    <img src="<?php echo e(asset('storage/' . $berita->gambar)); ?>" 
                                         class="d-block w-100" 
                                         alt="<?php echo e($berita->judul); ?>"
                                         style="height: 350px; object-fit: cover;">
                                </div>
                                <div class="col-md-7">
                                <?php else: ?>
                                <div class="col-md-12">
                                <?php endif; ?>
                                    <div class="card-body p-4">
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="badge bg-primary me-2">
                                                <i class="ti ti-calendar me-1"></i>
                                                <?php echo e($berita->tanggal_publikasi->format('d M Y')); ?>

                                            </span>
                                            <span class="badge bg-info">
                                                <i class="ti ti-user me-1"></i>
                                                <?php echo e($berita->user->name); ?>

                                            </span>
                                        </div>
                                        
                                        <h3 class="mb-3"><?php echo e($berita->judul); ?></h3>
                                        <p class="text-muted" style="text-align: justify; line-height: 1.8;">
                                            <?php echo e(Str::limit($berita->isi, 300)); ?>

                                        </p>
                                        
                                        <?php if(strlen($berita->isi) > 300): ?>
                                        <button type="button" class="btn btn-outline-primary btn-sm" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#beritaModal<?php echo e($berita->id); ?>">
                                            <i class="ti ti-book-2"></i> Baca Selengkapnya
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal untuk berita lengkap -->
                        <div class="modal fade" id="beritaModal<?php echo e($berita->id); ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"><?php echo e($berita->judul); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <?php if($berita->gambar): ?>
                                        <img src="<?php echo e(asset('storage/' . $berita->gambar)); ?>" 
                                             class="img-fluid rounded mb-3" 
                                             alt="<?php echo e($berita->judul); ?>">
                                        <?php endif; ?>
                                        
                                        <div class="d-flex align-items-center mb-3">
                                            <span class="badge bg-primary me-2">
                                                <i class="ti ti-calendar me-1"></i>
                                                <?php echo e($berita->tanggal_publikasi->format('d F Y')); ?>

                                            </span>
                                            <span class="badge bg-info">
                                                <i class="ti ti-user me-1"></i>
                                                <?php echo e($berita->user->name); ?>

                                            </span>
                                        </div>
                                        
                                        <div style="text-align: justify; line-height: 1.8; white-space: pre-line;">
                                            <?php echo e($berita->isi); ?>

                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#beritaCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#beritaCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <?php else: ?>
                <div class="text-center py-5">
                    <i class="ti ti-news-off f-40 text-muted mb-3"></i>
                    <p class="text-muted">Belum ada berita terbaru</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="col-12 mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h2 class="mb-3 text-primary">
                    Selamat Datang, <span class="fw-bold"><?php echo e(Auth::user()->name); ?></span>!
                </h2>

                <?php if(!$user->is_verified): ?>
                    <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm"
                        role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
                            <div>
                                <strong>Akun Anda belum terverifikasi.</strong> Silakan verifikasi terlebih dahulu untuk
                                mengakses semua fitur layanan desa.
                            </div>
                        </div>

                        <a href="<?php echo e(route('verify.form')); ?>" id="verify-button"
                            class="btn btn-warning btn-sm fw-bold">Verifikasi Sekarang</a>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <p class="lead mb-4">
                    Ini adalah <span class="fw-bold text-success">Dashboard Sistem Informasi Desa Candi</span>.  
                    Gunakan menu di samping untuk mengelola pengajuan surat, pengaduan, dan memantau berbagai informasi desa.
                </p>

                <div class="row mt-4">
                    <div class="col-md-4 mb-3">
                        <div class="card border-primary h-100">
                            <div class="card-body">
                                <i class="bi bi-file-text-fill fs-2 text-primary"></i>
                                <h5 class="card-title mt-2">Pengajuan Surat</h5>
                                <p class="card-text">Ajukan berbagai jenis surat administrasi desa secara online.</p>
                                <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-sm btn-primary">
                                    <i class="ti ti-arrow-right me-1"></i>Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-info h-100">
                            <div class="card-body">
                                <i class="bi bi-chat-left-dots-fill fs-2 text-info"></i>
                                <h5 class="card-title mt-2">Pengaduan</h5>
                                <p class="card-text">Sampaikan pengaduan atau aspirasi Anda kepada pemerintah desa.</p>
                                <a href="<?php echo e(route('pengaduan.index')); ?>" class="btn btn-sm btn-info">
                                    <i class="ti ti-arrow-right me-1"></i>Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card border-success h-100">
                            <div class="card-body">
                                <i class="bi bi-person-circle fs-2 text-success"></i>
                                <h5 class="card-title mt-2">Profil Saya</h5>
                                <p class="card-text">Kelola informasi akun dan data pribadi Anda.</p>
                                <a href="/myprofile" class="btn btn-sm btn-success">
                                    <i class="ti ti-arrow-right me-1"></i>Lihat
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Jenis Kelamin
        const genderCtx = document.getElementById('genderChart');
        if (genderCtx) {
            const genderData = <?php echo json_encode($penduduk_by_gender, 15, 512) ?>;
            new Chart(genderCtx, {
                type: 'pie',
                data: {
                    labels: genderData.map(item => item.jenis_kelamin),
                    datasets: [{
                        data: genderData.map(item => item.total),
                        backgroundColor: ['#4680ff', '#ff6b9d'],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Chart Agama
        const agamaCtx = document.getElementById('agamaChart');
        if (agamaCtx) {
            const agamaData = <?php echo json_encode($penduduk_by_agama, 15, 512) ?>;
            new Chart(agamaCtx, {
                type: 'doughnut',
                data: {
                    labels: agamaData.map(item => item.agama),
                    datasets: [{
                        data: agamaData.map(item => item.total),
                        backgroundColor: [
                            '#4680ff',
                            '#2ca87f',
                            '#ff6b9d',
                            '#f4bd0e',
                            '#9c27b0',
                            '#ff9800'
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }

        // Auto slide carousel
        var myCarousel = document.querySelector('#beritaCarousel');
        if (myCarousel) {
            var carousel = new bootstrap.Carousel(myCarousel, {
                interval: 5000,
                wrap: true
            });
        }

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
</script><?php /**PATH C:\LARAVEL12\appdesa\resources\views/user/dashboard.blade.php ENDPATH**/ ?>