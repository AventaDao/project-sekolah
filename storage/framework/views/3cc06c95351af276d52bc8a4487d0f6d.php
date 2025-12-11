<?php $__env->startSection('title', 'Detail Pengajuan Surat'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('pengajuan-surat.index')); ?>">Pengajuan Surat</a></li>
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
                    <h5>Detail Pengajuan Surat</h5>
                    <div>
                        <?php if($pengajuanSurat->status == 'Selesai'): ?>
                            <a href="<?php echo e(route('pengajuan-surat.print', $pengajuanSurat->id)); ?>" class="btn btn-primary btn-sm me-2" target="_blank">
                                <i class="ti ti-printer me-1"></i> Cetak
                            </a>
                            <a href="<?php echo e(route('pengajuan-surat.export-pdf', $pengajuanSurat->id)); ?>" class="btn btn-info btn-sm me-2">
                                <i class="ti ti-download me-1"></i> Download PDF
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge <?php echo e($pengajuanSurat->status_badge); ?> fs-6 px-3 py-2">
                            <i class="ti ti-file-check me-1"></i> Status: <?php echo e($pengajuanSurat->status); ?>

                        </span>
                    </div>

                    <!-- Informasi Pengajuan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengajuan</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nomor Pengajuan</td>
                                    <td width="5%">:</td>
                                    <td><strong><?php echo e($pengajuanSurat->nomor_pengajuan); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Surat</td>
                                    <td>:</td>
                                    <td><strong><?php echo e($pengajuanSurat->jenis_surat); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Pengajuan</td>
                                    <td>:</td>
                                    <td><?php echo e($pengajuanSurat->created_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Status</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge <?php echo e($pengajuanSurat->status_badge); ?>">
                                            <?php echo e($pengajuanSurat->status); ?>

                                        </span>
                                    </td>
                                </tr>
                                <?php if($pengajuanSurat->tanggal_selesai): ?>
                                <tr>
                                    <td class="text-muted">Tanggal Selesai</td>
                                    <td>:</td>
                                    <td><?php echo e($pengajuanSurat->tanggal_selesai->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                                <?php endif; ?>
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td><?php echo e($pengajuanSurat->updated_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Timeline Status -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Tracking Status</h5>
                    <div class="mb-4">
                        <div class="timeline timeline-left">
                            <!-- Step 1: Pengajuan -->
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot bg-success">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Pengajuan Diterima</strong></h6>
                                        <span class="badge bg-success ms-2">Selesai</span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-clock me-1"></i>
                                        <?php echo e($pengajuanSurat->created_at->format('d F Y H:i')); ?> WIB
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2: Diproses -->
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot <?php echo e(($pengajuanSurat->tanggal_diproses || $pengajuanSurat->status === 'Selesai' || $pengajuanSurat->status === 'Ditolak') ? 'bg-success' : 'bg-secondary'); ?>">
                                    <i class="ti <?php echo e(($pengajuanSurat->tanggal_diproses || $pengajuanSurat->status === 'Selesai' || $pengajuanSurat->status === 'Ditolak') ? 'ti-check' : 'ti-hourglass'); ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Dalam Proses</strong></h6>
                                        <span class="badge <?php echo e(($pengajuanSurat->tanggal_diproses || $pengajuanSurat->status === 'Selesai' || $pengajuanSurat->status === 'Ditolak') ? 'bg-success' : 'bg-secondary'); ?> ms-2">
                                            <?php echo e(($pengajuanSurat->tanggal_diproses || $pengajuanSurat->status === 'Selesai' || $pengajuanSurat->status === 'Ditolak') ? 'Selesai' : 'Menunggu'); ?>

                                        </span>
                                    </div>
                                    <?php if($pengajuanSurat->tanggal_diproses || $pengajuanSurat->status === 'Selesai' || $pengajuanSurat->status === 'Ditolak'): ?>
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-clock me-1"></i>
                                            <?php echo e(($pengajuanSurat->tanggal_diproses ?? $pengajuanSurat->updated_at)->format('d F Y H:i')); ?> WIB
                                        </p>
                                        <?php if($pengajuanSurat->tanggal_diproses && $pengajuanSurat->created_at): ?>
                                        <small class="text-muted">
                                            Waktu pemrosesan: <?php echo e($pengajuanSurat->tanggal_diproses->diffForHumans($pengajuanSurat->created_at, ['parts' => 2])); ?>

                                        </small>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-hourglass me-1"></i>
                                            Menunggu pemrosesan...
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Step 3: Selesai/Ditolak -->
                            <?php if($pengajuanSurat->status === 'Selesai' || $pengajuanSurat->status === 'Ditolak'): ?>
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot <?php echo e($pengajuanSurat->status === 'Selesai' ? 'bg-success' : 'bg-danger'); ?>">
                                    <i class="ti <?php echo e($pengajuanSurat->status === 'Selesai' ? 'ti-check' : 'ti-x'); ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong><?php echo e($pengajuanSurat->status === 'Selesai' ? 'Selesai' : 'Ditolak'); ?></strong></h6>
                                        <span class="badge <?php echo e($pengajuanSurat->status === 'Selesai' ? 'bg-success' : 'bg-danger'); ?> ms-2">
                                            <?php echo e($pengajuanSurat->status); ?>

                                        </span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-clock me-1"></i>
                                        <?php echo e(($pengajuanSurat->status === 'Selesai' ? $pengajuanSurat->tanggal_selesai : $pengajuanSurat->tanggal_ditolak)->format('d F Y H:i')); ?> WIB
                                    </p>
                                    <?php if($pengajuanSurat->tanggal_diproses && ($pengajuanSurat->status === 'Selesai' ? $pengajuanSurat->tanggal_selesai : $pengajuanSurat->tanggal_ditolak)): ?>
                                        <small class="text-muted">
                                            Waktu penyelesaian: <?php echo e(($pengajuanSurat->status === 'Selesai' ? $pengajuanSurat->tanggal_selesai : $pengajuanSurat->tanggal_ditolak)->diffForHumans($pengajuanSurat->tanggal_diproses, ['parts' => 2])); ?>

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

                    <!-- Keperluan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Keperluan</h5>
                    <div class="mb-4">
                        <p class="text-muted"><?php echo e($pengajuanSurat->keperluan); ?></p>
                    </div>

                    <!-- Detail Spesifik Berdasarkan Jenis Surat -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Detail <?php echo e($pengajuanSurat->jenis_surat); ?></h5>
                    <div class="mb-4">
                        <?php
                            $suratTypes = \App\Models\PengajuanSurat::getSuratTypes();
                            $fields = $suratTypes[$pengajuanSurat->jenis_surat]['fields'] ?? [];
                        ?>
                        
                        <?php if(count($fields) > 0): ?>
                            <table class="table table-striped">
                                <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldName => $fieldConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $fieldValue = $pengajuanSurat->$fieldName;
                                    ?>
                                    <?php if($fieldValue): ?>
                                    <tr>
                                        <td width="30%" class="text-muted fw-5"><strong><?php echo e($fieldConfig['label']); ?></strong></td>
                                        <td width="70%">
                                            <?php if($fieldConfig['type'] === 'textarea'): ?>
                                                <p class="mb-0"><?php echo e(nl2br($fieldValue)); ?></p>
                                            <?php elseif($fieldConfig['type'] === 'date'): ?>
                                                <?php echo e(\Carbon\Carbon::parse($fieldValue)->format('d F Y')); ?>

                                            <?php elseif($fieldConfig['type'] === 'number' && strpos($fieldName, 'jumlah') !== false): ?>
                                                Rp. <?php echo e(number_format($fieldValue, 0, ',', '.')); ?>

                                            <?php else: ?>
                                                <?php echo e($fieldValue); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        <?php else: ?>
                            <p class="text-muted">Tidak ada detail spesifik untuk jenis surat ini.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Keterangan Tambahan -->
                    <?php if($pengajuanSurat->keterangan_tambahan): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2">Keterangan Tambahan</h5>
                    <div class="mb-4">
                        <p class="text-muted"><?php echo e($pengajuanSurat->keterangan_tambahan); ?></p>
                    </div>
                    <?php endif; ?>

                    <!-- Surat Pengantar RW -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Surat Pengantar RW</h5>
                    <div class="mb-4">
                        <a href="<?php echo e(route('pengajuan-surat.download-pengantar', $pengajuanSurat->id)); ?>" 
                           class="btn btn-outline-primary">
                            <i class="ti ti-download"></i> Download Surat Pengantar RW
                        </a>
                    </div>

                    <!-- Catatan Admin -->
                    <?php if($pengajuanSurat->catatan_admin): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2">Catatan dari Admin</h5>
                    <div class="alert alert-info mb-4">
                        <i class="ti ti-info-circle me-2"></i>
                        <?php echo e($pengajuanSurat->catatan_admin); ?>

                    </div>
                    <?php endif; ?>

                    <!-- Surat Jadi -->
                    <?php if($pengajuanSurat->file_surat_jadi): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2">Surat Jadi</h5>
                    <div class="alert alert-success d-flex align-items-center mb-4">
                        <i class="ti ti-circle-check f-24 me-3"></i>
                        <div class="flex-grow-1">
                            <strong>Surat Anda sudah selesai!</strong>
                            <p class="mb-0">Silakan download surat jadi melalui tombol di bawah ini.</p>
                        </div>
                    </div>
                    <div class="mb-4">
                        <a href="<?php echo e(route('pengajuan-surat.download-surat-jadi', $pengajuanSurat->id)); ?>" 
                           class="btn btn-success">
                            <i class="ti ti-download"></i> Download Surat Jadi
                        </a>
                    </div>
                    <?php endif; ?>

                    <!-- Action Buttons -->
                    <?php if($pengajuanSurat->status === 'Menunggu'): ?>
                    <div class="mt-4 border-top pt-3">
                        <form action="<?php echo e(route('pengajuan-surat.destroy', $pengajuanSurat->id)); ?>" 
                              method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i> Batalkan Pengajuan
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
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\Laravel\UKK\desapp\resources\views/user/pengajuan-surat/show.blade.php ENDPATH**/ ?>