<?php $__env->startSection('title', 'Pengajuan Surat'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengajuan Surat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengajuan Surat Desa</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if(!$is_verified_user): ?>
        <?php echo $__env->make('component.verif-content', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php else: ?>
    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Info Card -->
            <div class="card bg-light-primary border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-info-circle f-28 text-primary me-3"></i>
                        <div>
                            <h5 class="mb-2">Syarat Pengajuan Surat</h5>
                            <p class="mb-0 text-muted">
                                Setiap pengajuan surat <strong>wajib melampirkan Surat Pengantar dari RW</strong>. 
                                Pastikan file dalam format PDF, JPG, JPEG, atau PNG dengan ukuran maksimal 2MB.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Pengajuan Surat</h5>
                    <a href="<?php echo e(route('pengajuan-surat.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Ajukan Surat Baru
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Pengajuan</th>
                                    <th>Jenis Surat</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $pengajuans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pengajuan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($pengajuans->firstItem() + $key); ?></td>
                                    <td><strong><?php echo e($pengajuan->nomor_pengajuan); ?></strong></td>
                                    <td><?php echo e($pengajuan->jenis_surat); ?></td>
                                    <td><?php echo e($pengajuan->created_at->format('d M Y H:i')); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($pengajuan->status_badge); ?>">
                                            <?php echo e($pengajuan->status); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('pengajuan-surat.show', $pengajuan->id)); ?>" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            
                                            <?php if($pengajuan->file_surat_jadi): ?>
                                            <a href="<?php echo e(route('pengajuan-surat.download-surat-jadi', $pengajuan->id)); ?>" 
                                               class="btn btn-sm btn-success" title="Download Surat">
                                                <i class="ti ti-download"></i>
                                            </a>
                                            <?php endif; ?>

                                            <?php if($pengajuan->status === 'Menunggu'): ?>
                                            <form action="<?php echo e(route('pengajuan-surat.destroy', $pengajuan->id)); ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')"
                                                  class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-file-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada pengajuan surat</p>
                                        <a href="<?php echo e(route('pengajuan-surat.create')); ?>" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus"></i> Buat Pengajuan
                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <?php echo e($pengajuans->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\Laravel\UKK\desapp\resources\views/user/pengajuan-surat/index.blade.php ENDPATH**/ ?>