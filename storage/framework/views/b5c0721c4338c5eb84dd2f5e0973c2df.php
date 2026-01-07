<?php $__env->startSection('title', 'Detail Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('pengaduan.index')); ?>">Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Detail Pengaduan</h5>
                    <a href="<?php echo e(route('pengaduan.index')); ?>" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge <?php echo e($pengaduan->status_badge); ?> fs-6 px-3 py-2">
                            <i class="ti ti-circle-check me-1"></i> Status: <?php echo e($pengaduan->status); ?>

                        </span>
                    </div>

                    <!-- Data Pengaduan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengaduan</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nomor Pengaduan</td>
                                    <td width="5%">:</td>
                                    <td><strong><?php echo e($pengaduan->nomor_pengaduan); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kategori</td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="ti <?php echo e($pengaduan->kategori_icon); ?> me-1"></i>
                                            <?php echo e($pengaduan->kategori); ?>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Pengaduan</td>
                                    <td>:</td>
                                    <td><?php echo e($pengaduan->created_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge <?php echo e($pengaduan->status_badge); ?>">
                                            <?php echo e($pengaduan->status); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php if($pengaduan->tanggal_tanggapan): ?>
                                <tr>
                                    <td class="text-muted">Tanggal Tanggapan</td>
                                    <td>:</td>
                                    <td><?php echo e(optional($pengaduan->tanggal_tanggapan)->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td><?php echo e($pengaduan->updated_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Judul Pengaduan</h5>
                    <div class="mb-4">
                        <p class="lead mb-0"><?php echo e($pengaduan->judul); ?></p>
                    </div>

                    <!-- Timeline Status -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Tracking Status</h5>
                    <div class="mb-4">
                        <div class="timeline timeline-left">
                            <!-- Step 1: Pengaduan Diterima -->
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot bg-success">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Pengaduan Diterima</strong></h6>
                                        <span class="badge bg-success ms-2">Selesai</span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-clock me-1"></i>
                                        <?php echo e($pengaduan->created_at->format('d F Y H:i')); ?> WIB
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2: Diproses -->
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot <?php echo e($pengaduan->tanggal_diproses ? 'bg-success' : 'bg-secondary'); ?>">
                                    <i class="ti <?php echo e($pengaduan->tanggal_diproses ? 'ti-check' : 'ti-hourglass'); ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Dalam Proses</strong></h6>
                                        <span class="badge <?php echo e($pengaduan->tanggal_diproses ? 'bg-success' : 'bg-secondary'); ?> ms-2">
                                            <?php echo e($pengaduan->tanggal_diproses ? 'Selesai' : 'Menunggu'); ?>

                                        </span>
                                    </div>
                                    <?php if($pengaduan->tanggal_diproses): ?>
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-clock me-1"></i>
                                            <?php echo e(optional($pengaduan->tanggal_diproses)->format('d F Y H:i')); ?> WIB
                                        </p>
                                        <small class="text-muted">
                                            Waktu pemrosesan: <?php echo e($pengaduan->tanggal_diproses->diffForHumans($pengaduan->created_at, ['parts' => 2])); ?>

                                        </small>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-hourglass me-1"></i>
                                            Menunggu pemrosesan...
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Step 3: Selesai/Ditolak -->
                            <?php if($pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak'): ?>
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot <?php echo e($pengaduan->status === 'Selesai' ? 'bg-success' : 'bg-danger'); ?>">
                                    <i class="ti <?php echo e($pengaduan->status === 'Selesai' ? 'ti-check' : 'ti-x'); ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong><?php echo e($pengaduan->status === 'Selesai' ? 'Selesai' : 'Ditolak'); ?></strong></h6>
                                        <span class="badge <?php echo e($pengaduan->status === 'Selesai' ? 'bg-success' : 'bg-danger'); ?> ms-2">
                                            <?php echo e($pengaduan->status); ?>

                                        </span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-clock me-1"></i>
                                        <?php echo e(optional($pengaduan->status === 'Selesai' ? $pengaduan->tanggal_tanggapan : $pengaduan->tanggal_ditolak)->format('d F Y H:i')); ?> WIB
                                    </p>
                                    <?php if($pengaduan->tanggal_diproses && ($pengaduan->status === 'Selesai' ? $pengaduan->tanggal_tanggapan : $pengaduan->tanggal_ditolak)): ?>
                                        <small class="text-muted">
                                            Waktu penyelesaian: <?php echo e(($pengaduan->status === 'Selesai' ? $pengaduan->tanggal_tanggapan : $pengaduan->tanggal_ditolak)->diffForHumans($pengaduan->tanggal_diproses, ['parts' => 2])); ?>

                                        </small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php else: ?>
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot bg-secondary">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Selesai</strong></h6>
                                        <span class="badge bg-secondary ms-2">Menunggu</span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-hourglass me-1"></i>
                                        Menunggu penyelesaian...
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <style>
                        .timeline {
                            position: relative;
                            padding: 20px 0;
                        }

                        .timeline-left {
                            padding-left: 0;
                        }

                        .timeline-item {
                            display: flex;
                            margin-bottom: 30px;
                            position: relative;
                        }

                        .timeline-bar {
                            position: absolute;
                            left: 15px;
                            top: 50px;
                            width: 2px;
                            height: calc(100% + 30px);
                            background: #e0e0e0;
                        }

                        .timeline-item:last-child .timeline-bar {
                            display: none;
                        }

                        .timeline-dot {
                            min-width: 32px;
                            width: 32px;
                            height: 32px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            font-weight: bold;
                            z-index: 1;
                            flex-shrink: 0;
                        }

                        .timeline-content {
                            margin-left: 20px;
                            flex-grow: 1;
                        }

                        .timeline-content h6 {
                            font-size: 15px;
                            margin-bottom: 5px;
                        }

                        .timeline-content p {
                            font-size: 13px;
                            margin: 5px 0;
                        }

                        .timeline-content small {
                            font-size: 11px;
                            display: block;
                        }
                    </style>

                    <!-- Deskripsi -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Deskripsi</h5>
                    <div class="mb-4">
                        <p class="text-muted mb-0" style="white-space: pre-line; line-height: 1.8;"><?php echo e($pengaduan->deskripsi); ?></p>
                    </div>

                    <!-- Lampiran -->
                    <?php if($pengaduan->lampiran): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2">Lampiran</h5>
                    <div class="mb-4">
                        <?php
                            $extension = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                        ?>
                        
                        <?php if(in_array($extension, ['jpg', 'jpeg', 'png'])): ?>
                        <img src="<?php echo e(asset('storage/' . $pengaduan->lampiran)); ?>" 
                             alt="Lampiran" 
                             class="img-fluid rounded mb-2" 
                             style="max-height: 400px; cursor: pointer;"
                             onclick="window.open(this.src, '_blank')">
                        <p class="text-muted text-sm">Klik gambar untuk memperbesar</p>
                        <?php else: ?>
                        <div class="alert alert-info">
                            <i class="ti ti-file-text f-20 me-2"></i>
                            <strong>File PDF:</strong> <?php echo e(basename($pengaduan->lampiran)); ?>

                        </div>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('pengaduan.download-lampiran', $pengaduan->id)); ?>" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-download"></i> Download Lampiran
                        </a>
                    </div>
                    <?php endif; ?>

                    <!-- Tanggapan Admin -->
                    <?php if($pengaduan->tanggapan_admin): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2">Tanggapan dari Admin</h5>
                    <div class="alert alert-success mb-4">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-message-circle f-24 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="alert-heading mb-2">Tanggapan:</h6>
                                <p class="mb-0" style="white-space: pre-line; line-height: 1.8;"><?php echo e($pengaduan->tanggapan_admin); ?></p>
                                <?php if($pengaduan->adminPenanggap): ?>
                                <hr class="my-2">
                                <small class="text-muted">
                                    <strong>Ditanggapi oleh:</strong> <?php echo e($pengaduan->adminPenanggap->name); ?><br>
                                    <strong>Tanggal:</strong> <?php echo e(optional($pengaduan->tanggal_tanggapan)->format('d F Y H:i')); ?> WIB
                                </small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning">
                        <i class="ti ti-clock me-2"></i>
                        <strong>Pengaduan Anda sedang menunggu tanggapan dari admin.</strong>
                        <p class="mb-0 mt-2">Kami akan segera menindaklanjuti pengaduan Anda. Terima kasih atas kesabaran Anda.</p>
                    </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <?php if($pengaduan->status === 'Menunggu'): ?>
                    <div class="mt-4 border-top pt-3">
                        <form action="<?php echo e(route('pengaduan.destroy', $pengaduan->id)); ?>" 
                              method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengaduan ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i> Batalkan Pengaduan
                            </button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ukk26\resources\views/user/pengaduan/show.blade.php ENDPATH**/ ?>