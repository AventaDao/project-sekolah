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

    <!-- Alert Verifikasi -->
    <?php if(isset($user) && is_object($user) && !$user->is_verified): ?>
    <div class="col-12 mb-3">
        <div class="alert alert-warning d-flex align-items-center justify-content-between shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="ti ti-exclamation-triangle fs-4 me-3"></i>
                <div>
                    <strong>Akun Anda belum terverifikasi.</strong> Silakan verifikasi terlebih dahulu untuk mengakses semua fitur layanan desa.
                </div>
            </div>
            <a href="<?php echo e(route('verify.form')); ?>" id="verify-button" class="btn btn-warning btn-sm fw-bold">Verifikasi Sekarang</a>
        </div>
    </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
    <div class="col-12 mb-3">
        <div class="alert alert-success shadow-sm" role="alert">
            <i class="ti ti-circle-check me-2"></i><?php echo e(session('success')); ?>

        </div>
    </div>
    <?php endif; ?>

    <!-- Statistik Cards User -->
    <div class="col-md-6 col-xl-4">
        <div class="card stat-card border-0 shadow-sm" style="border-left: 4px solid #2ca87f !important;">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1">Pengajuan Saya</p>
                        <h3 class="mb-0 counter" data-count="<?php echo e($stats['my_pengajuan_menunggu'] + $stats['my_pengajuan_diproses'] + $stats['my_pengajuan_selesai']); ?>">0</h3>
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
                        <h3 class="mb-0 counter" data-count="<?php echo e($stats['my_pengaduan_menunggu'] + $stats['my_pengaduan_selesai']); ?>">0</h3>
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
                        <h3 class="mb-0 counter" data-count="<?php echo e($stats['surat_disetujui']); ?>">0</h3>
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
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['my_pengajuan_menunggu']); ?>">0</h4>
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
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['my_pengajuan_diproses']); ?>">0</h4>
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
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['my_pengajuan_selesai']); ?>">0</h4>
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
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['my_pengaduan_menunggu']); ?>">0</h4>
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
                        <h4 class="mb-0 counter" data-count="<?php echo e($stats['my_pengaduan_selesai']); ?>">0</h4>
                    </div>
                </div>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Berita Desa Section with Carousel -->
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0"><i class="ti ti-news me-2"></i>Berita Desa Terbaru</h5>
            </div>
            <div class="card-body p-0">
                <?php if(isset($beritas) && count($beritas) > 0): ?>
                    <div id="beritaCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item <?php if($index === 0): ?> active <?php endif; ?>">
                                <div class="berita-item">
                                    <div class="row align-items-center g-0">
                                        <?php if(!empty($berita->gambar)): ?>
                                        <div class="col-md-6">
                                            <img src="<?php echo e(asset('storage/' . $berita->gambar)); ?>" alt="<?php echo e($berita->judul); ?>" 
                                                 class="img-fluid w-100" style="height: 350px; object-fit: cover; display: block;">
                                        </div>
                                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between" style="height: 350px;">
                                        <?php else: ?>
                                        <div class="col-md-6 bg-light d-flex align-items-center justify-content-center" style="height: 350px;">
                                            <i class="ti ti-photo" style="font-size: 96px; color: #ccc;"></i>
                                        </div>
                                        <div class="col-md-6 p-4 d-flex flex-column justify-content-between" style="height: 350px;">
                                        <?php endif; ?>
                                            <div>
                                                <h4 class="mb-3">
                                                    <a href="<?php echo e(route('berita.show', $berita->id)); ?>" class="text-decoration-none text-dark">
                                                        <?php echo e($berita->judul); ?>

                                                    </a>
                                                </h4>
                                                <p class="text-muted mb-3" style="font-size: 14px; line-height: 1.6;">
                                                    <?php echo e(Str::limit($berita->isi, 150)); ?>

                                                </p>
                                                <small class="text-muted d-block">
                                                    <i class="ti ti-calendar me-1"></i> <?php echo e(optional($berita->tanggal_publikasi)->format('d M Y') ?? optional($berita->created_at)->format('d M Y')); ?>

                                                    <?php if($berita->user): ?>
                                                    <span class="ms-2">
                                                        <i class="ti ti-user me-1"></i> <?php echo e($berita->user->name); ?>

                                                    </span>
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Carousel Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#beritaCarousel" data-bs-slide="prev">
                            <i class="ti ti-chevron-left" style="font-size: 32px; color: #4680ff;"></i>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#beritaCarousel" data-bs-slide="next">
                            <i class="ti ti-chevron-right" style="font-size: 32px; color: #4680ff;"></i>
                        </button>
                    </div>
                <?php else: ?>
                <div class="p-5 text-center text-muted">
                    <i class="ti ti-inbox" style="font-size: 64px; opacity: 0.3;"></i>
                    <p class="mt-3">Belum ada berita desa</p>
                </div>
                <?php endif; ?>
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
                        <a href="<?php echo e(route('pengajuan-surat.create')); ?>" class="quick-action-card">
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
                        <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="quick-action-card">
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
                        <a href="<?php echo e(route('pengaduan.index')); ?>" class="quick-action-card">
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
    <?php if($recent_pengajuan->count() > 0): ?>
    <div class="col-12 mt-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-file-text me-2"></i>Pengajuan Surat Terbaru</h5>
                <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
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
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="ti ti-message-report me-2"></i>Pengaduan Terbaru</h5>
                <a href="<?php echo e(route('pengaduan.index')); ?>" class="btn btn-sm btn-outline-warning">Lihat Semua</a>
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
                            <?php $__currentLoopData = $recent_pengaduan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengaduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($pengaduan->nomor_pengaduan); ?></strong></td>
                                <td><?php echo e(Str::limit($pengaduan->judul, 40)); ?></td>
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

/* Berita Item Styles */
.berita-item {
    transition: all 0.2s ease;
}

.berita-item:hover {
    background-color: #f9fbff;
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
#beritaCarousel {
    position: relative;
}

#beritaCarousel .carousel-control-prev,
#beritaCarousel .carousel-control-next {
    background-color: rgba(255, 255, 255, 0.8);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    opacity: 0.7;
    transition: all 0.3s ease;
}

#beritaCarousel .carousel-control-prev:hover,
#beritaCarousel .carousel-control-next:hover {
    opacity: 1;
    background-color: rgba(70, 128, 255, 0.1);
}

#beritaCarousel .carousel-control-prev {
    left: 15px;
}

#beritaCarousel .carousel-control-next {
    right: 15px;
}

#beritaCarousel .carousel-indicators button {
    background-color: #ccc !important;
    opacity: 0.6;
    transition: all 0.3s ease;
    width: 10px !important;
    height: 10px !important;
    border-radius: 50% !important;
}

#beritaCarousel .carousel-indicators button.active {
    background-color: #4680ff !important;
    opacity: 1;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-image: none;
    display: none;
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
</script><?php /**PATH C:\ukk26\resources\views/user/dashboard.blade.php ENDPATH**/ ?>