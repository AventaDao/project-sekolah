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
                                <div class="timeline-dot <?php echo e(($pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak' || $pengaduan->tanggal_diproses) ? 'bg-success' : 'bg-secondary'); ?>">
                                    <i class="ti <?php echo e(($pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak' || $pengaduan->tanggal_diproses) ? 'ti-check' : 'ti-hourglass'); ?>"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Dalam Proses</strong></h6>
                                        <span class="badge <?php echo e(($pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak' || $pengaduan->tanggal_diproses) ? 'bg-success' : 'bg-secondary'); ?> ms-2">
                                            <?php echo e(($pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak' || $pengaduan->tanggal_diproses) ? 'Selesai' : 'Menunggu'); ?>

                                        </span>
                                    </div>
                                    <?php if($pengaduan->tanggal_diproses || $pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak'): ?>
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-clock me-1"></i>
                                            <?php echo e(optional($pengaduan->tanggal_diproses ?? $pengaduan->updated_at)->format('d F Y H:i')); ?> WIB
                                        </p>
                                        <?php if($pengaduan->tanggal_diproses): ?>
                                        <small class="text-muted">
                                            Waktu pemrosesan: <?php echo e($pengaduan->tanggal_diproses->diffForHumans($pengaduan->created_at, ['parts' => 2])); ?>

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

<style>
/* ============================================
   USER PENGADUAN SHOW - MODERN STYLING
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

.badge.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #229070 100%) !important;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
    color: white;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
    color: white;
}

.badge.bg-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.2);
    color: white;
}

.badge.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
    box-shadow: 0 6px 20px rgba(255, 152, 0, 0.3);
    color: white;
}

.badge.bg-info {
    background: linear-gradient(135deg, #17a2b8 0%, #0c7baa 100%) !important;
    box-shadow: 0 6px 20px rgba(23, 162, 184, 0.3);
    color: white;
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

.alert-warning {
    background: rgba(255, 193, 7, 0.1) !important;
    color: #ff9800;
    border-left-color: #ff9800;
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

p.lead {
    font-size: 16px;
    font-weight: 500;
    color: #2c3e50;
}

/* Border Top */
.border-top {
    border-top: 1px solid rgba(70, 128, 255, 0.1) !important;
}

/* Image Styling */
.img-fluid {
    max-width: 100%;
    height: auto;
}

/* Utility Classes */
.mb-4 {
    margin-bottom: 28px !important;
}

.mb-3 {
    margin-bottom: 20px !important;
}

.mb-2 {
    margin-bottom: 12px !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mt-4 {
    margin-top: 28px !important;
}

.pt-3 {
    padding-top: 20px !important;
}

.me-1 {
    margin-right: 6px !important;
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

.my-2 {
    margin-top: 8px !important;
    margin-bottom: 8px !important;
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.align-items-start {
    align-items: flex-start;
}

.justify-content-between {
    justify-content: space-between;
}

.flex-grow-1 {
    flex-grow: 1;
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
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/user/pengaduan/show.blade.php ENDPATH**/ ?>