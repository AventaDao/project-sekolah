<?php $__env->startSection('title', 'Kelola Berita Desa'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Kelola Berita Desa</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kelola Berita Desa</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Berita Desa</h5>
                    <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Berita
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Judul</th>
                                    <th>Tanggal Publikasi</th>
                                    <th>Status</th>
                                    <th>Penulis</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($beritas->firstItem() + $key); ?></td>
                                    <td>
                                        <?php if($berita->gambar): ?>
                                        <img src="<?php echo e(Storage::disk('public')->url($berita->gambar)); ?>" 
                                             alt="<?php echo e($berita->judul); ?>" 
                                             class="img-fluid rounded" 
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                        <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                             style="width: 60px; height: 60px;">
                                            <i class="ti ti-photo f-24 text-muted"></i>
                                        </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?php echo e(Str::limit($berita->judul, 50)); ?></strong>
                                        <br>
                                        <small class="text-muted"><?php echo e(Str::limit($berita->isi, 80)); ?></small>
                                    </td>
                                    <td><?php echo e($berita->tanggal_publikasi->format('d M Y')); ?></td>
                                    <td>
                                        <?php if($berita->status === 'publish'): ?>
                                        <span class="badge bg-success">Publish</span>
                                        <?php else: ?>
                                        <span class="badge bg-warning">Draft</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($berita->user->name); ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.berita.show', $berita->id)); ?>" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.berita.edit', $berita->id)); ?>" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.berita.destroy', $berita->id)); ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"
                                                  class="d-inline">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="mb-3">
                                            <i class="ti ti-news-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">Belum ada berita</p>
                                            <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn btn-primary btn-sm mt-2">
                                            <i class="ti ti-plus"></i> Tambah Berita
                                        </a>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <?php echo e($beritas->links()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\Laravel\UKK\appsdesa\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>