<?php $__env->startSection('title', 'Pratayang TTD - ' . $pengajuanSurat->jenis_surat); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content" style="padding: 40px 0; background-color: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- White Container -->
                <div class="bg-white rounded shadow-sm p-5">
                    <!-- Breadcrumb -->
                    <div class="mb-4">
                        <p class="text-muted small mb-0">
                            <a href="/" class="text-decoration-none text-muted">
                                <i class="ti ti-home me-1"></i> Beranda
                            </a>
                        </p>
                    </div>

                    <!-- Title -->
                    <h4 class="mb-2 fw-bold text-dark">Pratayang TTD <?php echo e($pengajuanSurat->jenis_surat); ?></h4>
                    <p class="text-muted small mb-4 pb-3" style="border-bottom: 2px solid #e9ecef;">
                        Validasi dokumen <?php echo e($pengajuanSurat->jenis_surat); ?>

                    </p>

                    <!-- Section: Detail Pengajuan -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-4">
                            <i class="ti ti-file-text me-2"></i> Detail Pengajuan
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nama Pengajuan</small>
                                <p class="mb-0 fw-500"><?php echo e($pengajuanSurat->jenis_surat); ?></p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Tanggal Pengajuan</small>
                                <p class="mb-0 fw-500"><?php echo e($pengajuanSurat->created_at->format('d M Y')); ?></p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nomor Pengajuan</small>
                                <p class="mb-0 fw-500"><?php echo e($pengajuanSurat->nomor_pengajuan); ?></p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Status</small>
                                <p class="mb-0">
                                    <span class="badge <?php echo e($pengajuanSurat->status_badge); ?>">
                                        <?php echo e($pengajuanSurat->status); ?>

                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>

                    <hr style="background-color: #e9ecef; height: 1px; border: none;">

                    <!-- Section: Data Pemohon -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-4">
                            <i class="ti ti-user me-2"></i> Data Pemohon
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nama Lengkap</small>
                                <p class="mb-0 fw-500"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">NIK</small>
                                <p class="mb-0 fw-500"><?php echo e($pengajuanSurat->user->nik ?? '-'); ?></p>
                            </div>
                        </div>
                    </div>

                    <hr style="background-color: #e9ecef; height: 1px; border: none;">

                    <!-- Section: TTD Pejabat -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-4">
                            <i class="ti ti-signature me-2"></i> TTD Pejabat
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nama Lengkap</small>
                                <p class="mb-0 fw-500">Sugianto Kusuma</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Jabatan</small>
                                <p class="mb-0 fw-500">Kepala Desa</p>
                            </div>
                            <?php if($pengajuanSurat->tanggal_selesai): ?>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Tanggal TTD</small>
                                <p class="mb-0 fw-500"><?php echo e($pengajuanSurat->tanggal_selesai->format('d M Y')); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <hr style="background-color: #e9ecef; height: 1px; border: none;">

                    <!-- Verification Message -->
                    <div class="alert alert-info mb-5 border-0">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-info-circle me-3 mt-1" style="font-size: 20px;"></i>
                            <div>
                                <strong class="d-block mb-2">Keaslian Surat</strong>
                                <small>Dokumen ini telah ditandatangani secara digital dan terverifikasi dalam sistem.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="d-flex gap-2 mb-4">
                        <a href="/" class="btn btn-primary">
                            <i class="ti ti-arrow-left me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

                <!-- Footer -->
                <div class="text-muted small text-center mt-5 pt-4">
                    <p class="mb-0">© 2026 Sistem Informasi Desa | versi: v1.0</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light py-3 mt-5 text-center text-muted small">
    <div class="container">
        <p class="mb-0">© 2026 Sistem Informasi Desa | Verifikasi Surat Resmi</p>
    </div>
</footer>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\UKK\project-sekolah\resources\views/user/pengajuan-surat/verify.blade.php ENDPATH**/ ?>