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
                                <i class="ti ti-eye me-1"></i> Preview
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

                                            <?php elseif($fieldConfig['type'] === 'file'): ?>
                                                <div class="file-preview-container">
                                                    <?php
                                                        $filePath = $fieldValue;
                                                        $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                                        $isImage = in_array($fileExt, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                                                        $isPdf = $fileExt === 'pdf';
                                                    ?>
                                                    
                                                    <?php if($isImage): ?>
                                                        <!-- Image Preview -->
                                                        <div style="margin-bottom: 10px;">
                                                            <img src="<?php echo e(Storage::disk('public')->url($filePath)); ?>" 
                                                                 alt="<?php echo e($fieldConfig['label']); ?>"
                                                                 style="max-width: 300px; max-height: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                                                        </div>
                                                    <?php elseif($isPdf): ?>
                                                        <!-- PDF Preview with Embed -->
                                                        <div style="margin-bottom: 10px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden;">
                                                            <embed src="<?php echo e(Storage::disk('public')->url($filePath)); ?>" 
                                                                   type="application/pdf" 
                                                                   width="100%" 
                                                                   height="400px" 
                                                                   style="border: none;">
                                                        </div>
                                                    <?php else: ?>
                                                        <!-- Generic File Preview -->
                                                        <div style="padding: 15px; background: #f5f5f5; border-radius: 8px; border-left: 4px solid #667eea;">
                                                            <i class="ti ti-file" style="font-size: 24px; color: #667eea;"></i>
                                                            <p style="margin: 10px 0 0 0; color: #333;">
                                                                <strong>File:</strong> <?php echo e(basename($filePath)); ?>

                                                            </p>
                                                        </div>
                                                    <?php endif; ?>
                                                    
                                                    <!-- Download Button -->
                                                    <a href="<?php echo e(Storage::disk('public')->url($filePath)); ?>" 
                                                       download 
                                                       class="btn btn-sm btn-outline-primary mt-2">
                                                        <i class="ti ti-download"></i> Download <?php echo e($fieldConfig['label']); ?>

                                                    </a>
                                                </div>
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

<style>
/* ============================================
   PENGAJUAN SURAT USER SHOW - MODERN STYLING
   ============================================ */

/* Breadcrumb Modern */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
    margin-bottom: 20px;
}

.breadcrumb-item a {
    color: #4680ff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.breadcrumb-item a:hover {
    color: #357abd;
    transform: translateX(2px);
}

.breadcrumb-item.active {
    color: #6c757d;
}

/* Card Styling */
.card {
    border: 1px solid rgba(70, 128, 255, 0.1) !important;
    border-radius: 16px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.card:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12) !important;
    transform: translateY(-4px);
}

.card-header {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.1) 0%, rgba(44, 168, 127, 0.08) 100%) !important;
    border-bottom: 1px solid rgba(70, 128, 255, 0.15) !important;
    padding: 24px !important;
    border-radius: 15px 15px 0 0 !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h5 {
    color: #2c3e50;
    font-weight: 700;
    font-size: 20px;
    margin: 0;
}

.card-body {
    padding: 32px !important;
}

/* Status Badge Styling */
.badge {
    padding: 10px 16px !important;
    border-radius: 10px !important;
    font-weight: 600;
    font-size: 12px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.badge.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
    box-shadow: 0 6px 20px rgba(255, 152, 0, 0.3);
}

.badge.bg-info {
    background: linear-gradient(135deg, #17a2b8 0%, #0c7baa 100%) !important;
    box-shadow: 0 6px 20px rgba(23, 162, 184, 0.3);
}

.badge.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #229070 100%) !important;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
}

.badge.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
}

.badge.bg-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.2);
}

/* Heading Styling */
h5.text-primary {
    color: #4680ff !important;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px !important;
    padding-bottom: 16px !important;
    border-bottom: 2px solid rgba(70, 128, 255, 0.2) !important;
}

h5.text-primary i {
    font-size: 20px;
}

h6 {
    color: #2c3e50;
    font-weight: 700;
}

/* Table Styling */
.table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.table td {
    padding: 12px 16px;
    border: none;
    vertical-align: middle;
    transition: all 0.3s ease;
}

.table tr {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.table tr:hover {
    background: rgba(70, 128, 255, 0.08);
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.1);
}

.table tr:hover td {
    transform: translateX(4px);
}

.table-striped tbody tr:first-child td {
    border-top-left-radius: 8px;
    border-bottom-left-radius: 8px;
}

.table-striped tbody tr:first-child td:last-child {
    border-top-right-radius: 8px;
    border-bottom-right-radius: 8px;
}

.table td strong {
    color: #2c3e50;
    font-weight: 700;
}

.table td:first-child {
    color: #4680ff;
    font-weight: 600;
}

.table td.text-muted {
    color: #6c757d !important;
}

/* Row Styling */
.row {
    margin-bottom: 0;
}

.row .col-md-6 {
    margin-bottom: 24px;
}

/* Timeline Styling */
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-left {
    padding-left: 0;
}

.timeline-item {
    display: flex;
    margin-bottom: 32px;
    position: relative;
    animation: fadeInUp 0.6s ease-out forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.timeline-item:nth-child(1) { animation-delay: 0.1s; }
.timeline-item:nth-child(2) { animation-delay: 0.2s; }
.timeline-item:nth-child(3) { animation-delay: 0.3s; }

.timeline-bar {
    position: absolute;
    left: 15px;
    top: 50px;
    width: 3px;
    height: calc(100% + 32px);
    background: linear-gradient(180deg, rgba(70, 128, 255, 0.3) 0%, rgba(44, 168, 127, 0.3) 100%);
}

.timeline-item:last-child .timeline-bar {
    display: none;
}

.timeline-dot {
    min-width: 40px;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 18px;
    z-index: 1;
    flex-shrink: 0;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

.timeline-dot:hover {
    transform: scale(1.1);
}

.timeline-dot.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #229070 100%);
}

.timeline-dot.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
}

.timeline-dot.bg-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
}

.timeline-content {
    margin-left: 24px;
    flex-grow: 1;
    background: rgba(255, 255, 255, 0.6);
    padding: 16px 20px;
    border-radius: 10px;
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
}

.timeline-item:hover .timeline-content {
    background: rgba(70, 128, 255, 0.08);
    border-left-color: #4680ff;
}

.timeline-content h6 {
    font-size: 16px;
    margin-bottom: 8px;
    color: #2c3e50;
}

.timeline-content p {
    font-size: 14px;
    margin: 6px 0;
    color: #6c757d;
}

.timeline-content small {
    font-size: 12px;
    display: block;
    color: #999;
    margin-top: 6px;
}

/* Alert Styling */
.alert {
    border: none !important;
    border-radius: 12px !important;
    padding: 18px 22px !important;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}

.alert:hover {
    transform: translateX(4px);
}

.alert-success {
    background: rgba(40, 167, 69, 0.1) !important;
    color: #28a745;
    border-left-color: #28a745;
}

.alert-info {
    background: rgba(70, 128, 255, 0.1) !important;
    color: #4680ff;
    border-left-color: #4680ff;
}

.alert-danger {
    background: rgba(220, 53, 69, 0.1) !important;
    color: #dc3545;
    border-left-color: #dc3545;
}

.alert i {
    font-size: 18px;
}

/* Button Styling */
.btn {
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    padding: 12px 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(70, 128, 255, 0.35);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.15);
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(108, 117, 125, 0.25);
    color: white;
}

.btn-outline-primary {
    border: 2px solid #4680ff;
    color: #4680ff;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #4680ff;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #229070 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.25);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(40, 167, 69, 0.35);
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.25);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(220, 53, 69, 0.35);
    color: white;
}

.btn-sm {
    padding: 8px 16px;
    font-size: 12px;
}

/* Paragraph & Text */
p {
    color: #6c757d;
    line-height: 1.6;
    font-size: 14px;
}

p.mb-0 {
    margin-bottom: 0 !important;
}

/* File Preview */
.file-preview-container {
    padding: 16px;
    background: rgba(70, 128, 255, 0.05);
    border-radius: 10px;
    border: 1px solid rgba(70, 128, 255, 0.1);
}

.file-preview-container img,
.file-preview-container embed {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.file-preview-container img:hover {
    transform: scale(1.02);
    box-shadow: 0 8px 24px rgba(70, 128, 255, 0.2);
}

/* Border Top */
.border-top {
    border-top: 1px solid rgba(70, 128, 255, 0.1) !important;
}

/* Utility Classes */
.mb-4 {
    margin-bottom: 28px !important;
}

.mb-3 {
    margin-bottom: 20px !important;
}

.mt-4 {
    margin-top: 28px !important;
}

.pt-3 {
    padding-top: 20px !important;
}

.me-2 {
    margin-right: 8px !important;
}

.me-3 {
    margin-right: 12px !important;
}

.ms-2 {
    margin-left: 8px !important;
}

.flex-grow-1 {
    flex-grow: 1;
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.justify-content-between {
    justify-content: space-between;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .card-header h5 {
        font-size: 18px;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .timeline-content {
        margin-left: 16px;
        padding: 12px 16px;
    }
    
    .table td {
        padding: 10px 12px;
        font-size: 13px;
    }
    
    h5.text-primary {
        font-size: 16px;
    }
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/user/pengajuan-surat/show.blade.php ENDPATH**/ ?>