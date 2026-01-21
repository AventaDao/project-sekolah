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
        <div class="card stat-card stat-card-pengajuan border-0 shadow-md">
            <div class="stat-card-bg"></div>
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-600">Pengajuan Saya</p>
                        <h3 class="mb-0 counter stat-number" data-count="<?php echo e($stats['my_pengajuan_menunggu'] + $stats['my_pengajuan_diproses'] + $stats['my_pengajuan_selesai']); ?>">0</h3>
                        <small class="stat-badge">
                            <i class="ti ti-trending-up"></i> Total Pengajuan
                        </small>
                    </div>
                    <div class="stat-icon stat-icon-green">
                        <i class="ti ti-file-text"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card stat-card stat-card-pengaduan border-0 shadow-md">
            <div class="stat-card-bg"></div>
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-600">Pengaduan Saya</p>
                        <h3 class="mb-0 counter stat-number" data-count="<?php echo e($stats['my_pengaduan_menunggu'] + $stats['my_pengaduan_selesai']); ?>">0</h3>
                        <small class="stat-badge">
                            <i class="ti ti-trending-up"></i> Total Pengaduan
                        </small>
                    </div>
                    <div class="stat-icon stat-icon-orange">
                        <i class="ti ti-message-report"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-4">
        <div class="card stat-card stat-card-surat border-0 shadow-md">
            <div class="stat-card-bg"></div>
            <div class="card-body position-relative z-1">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted mb-1 fw-600">Surat Disetujui (Global)</p>
                        <h3 class="mb-0 counter stat-number" data-count="<?php echo e($stats['surat_disetujui']); ?>">0</h3>
                        <small class="stat-badge">
                            <i class="ti ti-circle-check"></i> Status Selesai
                        </small>
                    </div>
                    <div class="stat-icon stat-icon-cyan">
                        <i class="ti ti-file-check"></i>
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
                <div class="row g-4">
                    <div class="col-md-4">
                        <a href="<?php echo e(route('pengajuan-surat.create')); ?>" class="quick-action-card quick-action-ajukan">
                            <div class="quick-action-content">
                                <div class="quick-action-icon-wrapper">
                                    <div class="quick-action-icon bg-gradient-primary">
                                        <i class="ti ti-file-plus"></i>
                                    </div>
                                </div>
                                <h6 class="quick-action-title">Ajukan Surat</h6>
                                <p class="quick-action-desc">Buat pengajuan baru</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="ti ti-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="quick-action-card quick-action-riwayat">
                            <div class="quick-action-content">
                                <div class="quick-action-icon-wrapper">
                                    <div class="quick-action-icon bg-gradient-success">
                                        <i class="ti ti-file-text"></i>
                                    </div>
                                </div>
                                <h6 class="quick-action-title">Riwayat Pengajuan</h6>
                                <p class="quick-action-desc">Lihat semua pengajuan</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="ti ti-arrow-right"></i>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('pengaduan.index')); ?>" class="quick-action-card quick-action-pengaduan">
                            <div class="quick-action-content">
                                <div class="quick-action-icon-wrapper">
                                    <div class="quick-action-icon bg-gradient-info">
                                        <i class="ti ti-message-report"></i>
                                    </div>
                                </div>
                                <h6 class="quick-action-title">Pengaduan Saya</h6>
                                <p class="quick-action-desc">Kelola pengaduan</p>
                            </div>
                            <div class="quick-action-arrow">
                                <i class="ti ti-arrow-right"></i>
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
/* ============================================
   MODERN GRADIENT + GLASSMORPHISM DASHBOARD
   ============================================ */

/* Statistik Cards dengan Gradient Unik */
.stat-card {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.7) !important;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 100% 0%, rgba(255,255,255,0.3) 0%, transparent 70%);
    pointer-events: none;
}

.stat-card-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0.1;
    z-index: 0;
}

.stat-card-pengajuan .stat-card-bg {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
}

.stat-card-pengaduan .stat-card-bg {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
}

.stat-card-surat .stat-card-bg {
    background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
}

.stat-card:hover .stat-icon {
    transform: scale(1.15) rotate(5deg);
}

.stat-number {
    background: linear-gradient(135deg, #4680ff 0%, #667eea 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 28px;
}

.stat-icon {
    width: 70px;
    height: 70px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    color: white;
    font-weight: 600;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
}

.stat-icon::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 16px;
    background: inherit;
    filter: blur(10px);
    opacity: 0.5;
    z-index: -1;
}

.stat-icon-green {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
    box-shadow: 0 8px 30px rgba(44, 168, 127, 0.3);
}

.stat-icon-orange {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
    box-shadow: 0 8px 30px rgba(255, 152, 0, 0.3);
}

.stat-icon-cyan {
    background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
    box-shadow: 0 8px 30px rgba(0, 212, 255, 0.3);
}

.stat-badge {
    color: #6c757d;
    font-weight: 500;
    display: inline-block;
    margin-top: 8px;
}

.stat-card:hover .stat-badge {
    color: #4680ff;
}

/* Shadow Enhancement */
.shadow-md {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
}

/* Status Cards dengan Warna Vibrant */
.hover-card {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.8) !important;
}

.hover-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s ease;
}

.hover-card:hover::before {
    left: 100%;
}

.hover-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
}

/* Avatar dengan Gradient */
.avatar-md {
    min-width: 50px;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    font-weight: 600;
    color: white;
    transition: all 0.3s ease;
}

.avatar-md.bg-warning {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
    box-shadow: 0 8px 20px rgba(255, 152, 0, 0.25);
}

.avatar-md.bg-info {
    background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
    box-shadow: 0 8px 20px rgba(0, 212, 255, 0.25);
}

.avatar-md.bg-success {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
    box-shadow: 0 8px 20px rgba(44, 168, 127, 0.25);
}

.hover-card:hover .avatar-md {
    transform: scale(1.1) rotate(-5deg);
}

/* Progress Bar Gradient */
.progress {
    background-color: rgba(0, 0, 0, 0.05);
    border-radius: 10px;
    overflow: hidden;
    height: 8px;
}

.progress-bar {
    background: linear-gradient(90deg, #4680ff 0%, #667eea 100%);
    border-radius: 10px;
    transition: width 0.6s ease;
}

.progress-bar.bg-warning {
    background: linear-gradient(90deg, #ff9800 0%, #ff6f00 100%) !important;
}

.progress-bar.bg-info {
    background: linear-gradient(90deg, #00d4ff 0%, #00a8cc 100%) !important;
}

.progress-bar.bg-success {
    background: linear-gradient(90deg, #2ca87f 0%, #1e7e5d 100%) !important;
}

/* Quick Action Cards - Enhanced 3D Design */
.quick-action-card {
    text-decoration: none;
    color: inherit;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    border: none;
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    backdrop-filter: blur(10px);
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9) 0%, rgba(255, 255, 255, 0.7) 100%);
    position: relative;
    overflow: hidden;
    padding: 28px 24px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.4);
}

.quick-action-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(70, 128, 255, 0) 0%, rgba(102, 126, 234, 0.15) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 0;
}

.quick-action-card::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(70, 128, 255, 0.3), transparent);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.quick-action-content {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 16px;
}

.quick-action-icon-wrapper {
    margin-bottom: 20px;
    position: relative;
}

.quick-action-icon {
    width: 80px;
    height: 80px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 40px;
    color: white;
    font-weight: 700;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
}

.quick-action-icon::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 20px;
    background: inherit;
    filter: blur(15px);
    opacity: 0.6;
    z-index: -1;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
}

.quick-action-title {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.quick-action-desc {
    font-size: 13px;
    color: #6c757d;
    margin: 0;
    transition: all 0.3s ease;
}

.quick-action-arrow {
    position: relative;
    z-index: 2;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(70, 128, 255, 0.1);
    color: #4680ff;
    font-size: 18px;
    font-weight: 600;
    transition: all 0.3s ease;
    margin-top: auto;
}

/* Hover Effects */
.quick-action-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 25px 60px rgba(70, 128, 255, 0.25);
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.8) 100%);
}

.quick-action-card:hover::before {
    opacity: 1;
}

.quick-action-card:hover::after {
    opacity: 1;
}

.quick-action-card:hover .quick-action-icon {
    transform: scale(1.12) translateY(-8px);
}

.quick-action-card:hover .quick-action-title {
    color: #4680ff;
    transform: translateY(-2px);
}

.quick-action-card:hover .quick-action-desc {
    color: #4680ff;
}

.quick-action-card:hover .quick-action-arrow {
    background: rgba(70, 128, 255, 0.2);
    transform: translateX(4px);
}

.quick-action-ajukan:hover .bg-gradient-primary {
    filter: brightness(1.15);
}

.quick-action-riwayat:hover .bg-gradient-success {
    filter: brightness(1.15);
}

.quick-action-pengaduan:hover .bg-gradient-info {
    filter: brightness(1.15);
}

/* Card Header Styling */
.card {
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.8) !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
}

/* Exclude Welcome Card from generic card styling */
.card.bg-primary {
    background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%) !important;
    border: none !important;
    backdrop-filter: none;
}

.card.bg-primary .card-body {
    padding: 2rem !important;
}

.card:hover {
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
}

.card-header {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(70, 128, 255, 0.05) 100%) !important;
    border-bottom: 1px solid rgba(70, 128, 255, 0.1) !important;
    border-radius: 12px 12px 0 0;
}

/* Alert Styling */
.alert {
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.8) !important;
}

.alert-warning {
    background: rgba(255, 152, 0, 0.08) !important;
    border-color: rgba(255, 152, 0, 0.2) !important;
}

.alert-success {
    background: rgba(44, 168, 127, 0.08) !important;
    border-color: rgba(44, 168, 127, 0.2) !important;
}

/* Title Styling */
h5 {
    color: #2c3e50;
    font-weight: 600;
    background: linear-gradient(135deg, #4680ff 0%, #667eea 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Counter Animation Enhanced */
.counter {
    font-weight: 700;
    color: #4680ff;
}

/* Carousel Styles */
#beritaCarousel {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
}

#beritaCarousel .carousel-control-prev,
#beritaCarousel .carousel-control-next {
    background: rgba(70, 128, 255, 0.15);
    width: 50px;
    height: 50px;
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    border: 2px solid rgba(70, 128, 255, 0.3);
    opacity: 0.7;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

#beritaCarousel .carousel-control-prev:hover,
#beritaCarousel .carousel-control-next:hover {
    opacity: 1;
    background: rgba(70, 128, 255, 0.25);
    border-color: #4680ff;
    transform: translateY(-50%) scale(1.1);
}

#beritaCarousel .carousel-control-prev {
    left: 15px;
}

#beritaCarousel .carousel-control-next {
    right: 15px;
}

.berita-item {
    transition: all 0.3s ease;
}

.berita-item:hover {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.05) 0%, rgba(102, 126, 234, 0.05) 100%);
}

/* Table Styling */
.table {
    border-collapse: separate;
    border-spacing: 0 8px;
}

.table tbody tr {
    background: rgba(255, 255, 255, 0.6);
    border: 1px solid rgba(70, 128, 255, 0.1);
    border-radius: 8px;
    transition: all 0.3s ease;
    backdropfilter: blur(10px);
}

.table tbody tr:hover {
    background: rgba(70, 128, 255, 0.08);
    transform: translateX(5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
}

.table thead {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.1) 0%, rgba(102, 126, 234, 0.05) 100%);
}

.table thead th {
    color: #4680ff;
    font-weight: 600;
    border: none;
    padding-top: 15px;
    padding-bottom: 15px;
}

/* Badge Styling */
.badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 11px;
}

/* Responsive */
@media (max-width: 768px) {
    .stat-card {
        margin-bottom: 15px;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
        font-size: 24px;
    }
    
    .stat-number {
        font-size: 22px;
    }
}

/* Z-index helper */
.z-1 {
    position: relative;
    z-index: 1;
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
</script><?php /**PATH C:\project-sekolah\resources\views/user/dashboard.blade.php ENDPATH**/ ?>