<?php $__env->startSection('title', 'Data Penduduk'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data Penduduk</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Data Penduduk</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Statistics Cards -->
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-primary">
                                <i class="ti ti-users f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Total Penduduk</h6>
                            <p class="text-muted mb-0">
                                <strong><?php echo e(\App\Models\Penduduk::where('status_hidup', 'Hidup')->count()); ?></strong> orang
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-success">
                                <i class="ti ti-user-check f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Memiliki Akun</h6>
                            <p class="text-muted mb-0">
                                <strong><?php echo e(\App\Models\User::where('role', 'user')->count()); ?></strong> orang
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-warning">
                                <i class="ti ti-user-x f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Belum Punya Akun</h6>
                            <p class="text-muted mb-0">
                                <strong><?php echo e(\App\Models\Penduduk::where('status_hidup', 'Hidup')->whereNotIn('nik', \App\Models\User::pluck('nik'))->count()); ?></strong> orang
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-s bg-light-danger">
                                <i class="ti ti-heart-broken f-20"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Meninggal</h6>
                            <p class="text-muted mb-0">
                                <strong><?php echo e(\App\Models\Penduduk::where('status_hidup', 'Meninggal')->count()); ?></strong> orang
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Daftar Penduduk</h5>
                    <a href="<?php echo e(route('admin.penduduk.create')); ?>" class="btn btn-primary">
                        <i class="ti ti-plus"></i> Tambah Penduduk
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <!-- Filter dan Search -->
                    <form method="GET" action="<?php echo e(route('admin.penduduk.index')); ?>" class="mb-3">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ti ti-search"></i></span>
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Cari NIK, Nama, atau Alamat..." 
                                           value="<?php echo e(request('search')); ?>">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select name="filter_account" class="form-select">
                                    <option value="">Semua Status Akun</option>
                                    <option value="has_account" <?php echo e(request('filter_account') == 'has_account' ? 'selected' : ''); ?>>
                                        ✓ Memiliki Akun Sistem
                                    </option>
                                    <option value="no_account" <?php echo e(request('filter_account') == 'no_account' ? 'selected' : ''); ?>>
                                        ✗ Belum Memiliki Akun
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="ti ti-filter"></i> Filter
                                </button>
                                <a href="<?php echo e(route('admin.penduduk.index')); ?>" class="btn btn-secondary">
                                    <i class="ti ti-refresh"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Tempat, Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $penduduks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $penduduk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($penduduks->firstItem() + $key); ?></td>
                                    <td><?php echo e($penduduk->nik); ?></td>
                                    <td>
                                        <?php echo e($penduduk->nama_lengkap); ?>

                                        <?php
                                            $hasAccount = \App\Models\User::where('nik', $penduduk->nik)->exists();
                                        ?>
                                        <?php if($hasAccount): ?>
                                            <br><span class="badge bg-success mt-1" title="Memiliki akun sistem">
                                                <i class="ti ti-user-check"></i> Pengguna Terdaftar
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($penduduk->jenis_kelamin); ?></td>
                                    <td><?php echo e($penduduk->tempat_lahir); ?>, <?php echo e($penduduk->tanggal_lahir->format('d-m-Y')); ?></td>
                                    <td><?php echo e(Str::limit($penduduk->alamat, 30)); ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="<?php echo e(route('admin.penduduk.show', $penduduk->id)); ?>" 
                                               class="btn btn-sm btn-info" title="Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>
                                            <a href="<?php echo e(route('admin.penduduk.edit', $penduduk->id)); ?>" 
                                               class="btn btn-sm btn-warning" title="Edit">
                                                <i class="ti ti-edit"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.penduduk.destroy', $penduduk->id)); ?>" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
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
                                            <i class="ti ti-users-off f-40 text-muted"></i>
                                        </div>
                                        <p class="text-muted">
                                            <?php if(request('search') || request('filter_account')): ?>
                                                Tidak ada data penduduk dengan kriteria pencarian tersebut
                                            <?php else: ?>
                                                Belum ada data penduduk
                                            <?php endif; ?>
                                        </p>
                                        <?php if(request('search') || request('filter_account')): ?>
                                            <a href="<?php echo e(route('admin.penduduk.index')); ?>" class="btn btn-secondary btn-sm mt-2">
                                                <i class="ti ti-refresh"></i> Reset Filter
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Menampilkan <?php echo e($penduduks->firstItem() ?? 0); ?> - <?php echo e($penduduks->lastItem() ?? 0); ?> dari <?php echo e($penduduks->total()); ?> data
                        </div>
                        <div>
                            <?php echo e($penduduks->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LARAVEL12\inidesa\resources\views/admin/penduduk/index.blade.php ENDPATH**/ ?>