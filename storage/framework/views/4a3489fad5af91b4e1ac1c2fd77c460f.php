

<?php $__env->startSection('title', 'Verifikasi Surat - ' . $pengajuanSurat->jenis_surat); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <h2 class="text-primary mb-2">Verifikasi Surat Resmi</h2>
                            <p class="text-muted">Surat ini telah ditandatangani secara digital oleh Pemerintah Desa</p>
                        </div>

                        <!-- Verification Badge -->
                        <div class="alert alert-success text-center py-4 mb-4">
                            <i class="ti ti-circle-check" style="font-size: 48px; color: #28a745;"></i>
                            <h4 class="mt-3 mb-0">Surat Terverifikasi</h4>
                        </div>

                        <!-- Surat Details -->
                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">Detail Surat</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <small class="text-muted">Jenis Surat</small>
                                        <p class="fw-bold"><?php echo e($pengajuanSurat->jenis_surat); ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Nomor Surat</small>
                                        <p class="fw-bold"><?php echo e($pengajuanSurat->nomor_pengajuan); ?></p>
                                    </div>
                                    <div class="col-sm-4">
                                        <small class="text-muted">Status</small>
                                        <p><span class="badge <?php echo e($pengajuanSurat->status_badge); ?>"><?php echo e($pengajuanSurat->status); ?></span></p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-6">
                                        <small class="text-muted">Atas Nama</small>
                                        <p class="fw-bold"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></p>
                                    </div>
                                    <div class="col-sm-6">
                                        <small class="text-muted">NIK</small>
                                        <p class="fw-bold"><?php echo e($pengajuanSurat->user->nik ?? '-'); ?></p>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <small class="text-muted">Tanggal Pengajuan</small>
                                        <p><?php echo e($pengajuanSurat->created_at->format('d F Y H:i')); ?> WIB</p>
                                    </div>
                                    <?php if($pengajuanSurat->tanggal_selesai): ?>
                                    <div class="col-sm-6">
                                        <small class="text-muted">Tanggal Penyelesaian</small>
                                        <p><?php echo e($pengajuanSurat->tanggal_selesai->format('d F Y H:i')); ?> WIB</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Verification Info -->
                        <div class="alert alert-info">
                            <i class="ti ti-info-circle me-2"></i>
                            <strong>Keaslian Surat:</strong> Surat ini telah ditandatangani secara digital oleh Kepala Desa Kedung Kendo dan diterbitkan melalui Sistem Informasi Desa yang resmi.
                        </div>

                        <!-- Footer Info -->
                        <div class="text-center text-muted small">
                            <p class="mb-1">Kode Verifikasi: <code><?php echo e($pengajuanSurat->nomor_pengajuan); ?></code></p>
                            <p>Diverifikasi pada: <?php echo e(now()->format('d F Y H:i')); ?> WIB</p>
                        </div>

                        <!-- Action Buttons -->
                        <div class="text-center mt-5">
                            <a href="/" class="btn btn-primary">
                                <i class="ti ti-home me-1"></i> Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Security Note -->
                <div class="alert alert-light border mt-4 small">
                    <i class="ti ti-lock me-1"></i>
                    <strong>Catatan Keamanan:</strong> Halaman ini menampilkan verifikasi keaslian dokumen. Surat yang dilengkapi dengan QR code dapat diverifikasi secara langsung dari dokumen tercetak.
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ukk26\resources\views/user/pengajuan-surat/verify.blade.php ENDPATH**/ ?>