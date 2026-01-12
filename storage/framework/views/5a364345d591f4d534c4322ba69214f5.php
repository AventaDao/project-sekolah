<?php $__env->startSection('title', 'Pratayang TTD - ' . $pengajuanSurat->jenis_surat); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content" style="padding: 40px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header Section -->
                <div class="mb-4">
                    <h3 class="fw-bold text-primary mb-2">Pratayang TTD Lembar <?php echo e($pengajuanSurat->jenis_surat); ?></h3>
                    <p class="text-muted mb-3">Validasi dokumen <?php echo e($pengajuanSurat->jenis_surat); ?></p>
                    <a href="/" class="text-decoration-none">
                        <i class="ti ti-home me-1"></i>Beranda
                    </a>
                </div>

                <!-- Profil Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary mb-3">Profil Pemohon</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                        <p class="fw-bold mb-0"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <small class="text-muted d-block mb-1">NIK</small>
                                        <p class="fw-bold mb-0"><?php echo e($pengajuanSurat->user->nik ?? '-'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($pengajuanSurat->user->alamat || $pengajuanSurat->user->no_telepon): ?>
                        <div class="row mb-3">
                            <?php if($pengajuanSurat->user->alamat): ?>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Alamat</small>
                                <p class="mb-0"><?php echo e($pengajuanSurat->user->alamat); ?></p>
                            </div>
                            <?php endif; ?>
                            <?php if($pengajuanSurat->user->no_telepon): ?>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">No. Telepon</small>
                                <p class="fw-bold mb-0"><?php echo e($pengajuanSurat->user->no_telepon); ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Data Pengajuan Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary mb-3">Data Pengajuan</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Jenis Surat</small>
                                <p class="fw-bold mb-0"><?php echo e($pengajuanSurat->jenis_surat); ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Nomor Pengajuan</small>
                                <p class="fw-bold mb-0"><?php echo e($pengajuanSurat->nomor_pengajuan); ?></p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Tanggal Pengajuan</small>
                                <p class="mb-0"><?php echo e($pengajuanSurat->created_at->format('d M Y')); ?></p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Status Pengajuan</small>
                                <p class="mb-0"><span class="badge <?php echo e($pengajuanSurat->status_badge); ?>"><?php echo e($pengajuanSurat->status); ?></span></p>
                            </div>
                        </div>

                        <?php if($pengajuanSurat->tanggal_selesai): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Tanggal Selesai</small>
                                <p class="mb-0"><?php echo e($pengajuanSurat->tanggal_selesai->format('d M Y')); ?></p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- TTD Pejabat Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary mb-3">TTD Pejabat</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                <p class="fw-bold mb-0">Sugianto Kusuma</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Jabatan</small>
                                <p class="mb-0">Kepala Desa Kedung Kendo</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Verification Success Alert -->
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="ti ti-circle-check me-2" style="font-size: 24px;"></i>
                    <div>
                        <strong>Surat Terverifikasi</strong>
                        <p class="mb-0 small">Dokumen ini telah ditandatangani secara digital dan terdaftar dalam sistem.</p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="text-center mb-4">
                    <a href="/" class="btn btn-primary">
                        <i class="ti ti-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
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