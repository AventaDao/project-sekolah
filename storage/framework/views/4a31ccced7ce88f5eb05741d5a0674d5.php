<?php $__env->startSection('title', 'Pengaduan Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Pengaduan Saya</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengaduan Saya</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Info Card -->
            <div class="card bg-light-info border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <i class="ti ti-info-circle f-28 text-info me-3"></i>
                        <div>
                            <h5 class="mb-2">Informasi Pengaduan</h5>
                            <p class="mb-0 text-muted">
                                Anda dapat melaporkan kendala sistem, meminta bantuan, atau melaporkan kejadian lapangan melalui fitur ini. 
                                Tim kami akan menanggapi pengaduan Anda secepatnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Pengaduan</h5>
                    <a href="<?php echo e(route('pengaduan.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Buat Pengaduan Baru
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
                                    <th>Nomor Pengaduan</th>
                                    <th>Kategori</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $pengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pengaduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($pengaduans->firstItem() + $key); ?></td>
                                    <td><strong><?php echo e($pengaduan->nomor_pengaduan); ?></strong></td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="ti <?php echo e($pengaduan->kategori_icon); ?> me-1"></i>
                                            <?php echo e(Str::limit($pengaduan->kategori, 20)); ?>

                                        </span>
                                    </td>
                                    <td><?php echo e(Str::limit($pengaduan->judul, 40)); ?></td>
                                    <td><?php echo e($pengaduan->created_at->format('d M Y H:i')); ?></td>
                                    <td>
                                        <span class="badge <?php echo e($pengaduan->status_badge); ?>">
                                            <?php echo e($pengaduan->status); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('pengaduan.show', $pengaduan->id)); ?>" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            <?php if($pengaduan->status === 'Menunggu'): ?>
                                            <form action="<?php echo e(route('pengaduan.destroy', $pengaduan->id)); ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"
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
                                    <td colspan="7" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-message-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada pengaduan</p>
                                        <a href="<?php echo e(route('pengaduan.create')); ?>" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus"></i> Buat Pengaduan
                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <?php echo e($pengaduans->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LARAVEL12\appdesa\resources\views/user/pengaduan/index.blade.php ENDPATH**/ ?>