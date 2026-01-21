<?php $__env->startSection('title', 'Data Penduduk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="pc-content">
        <!-- Breadcrumb dengan Styling Modern -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <nav aria-label="breadcrumb" class="breadcrumb-modern">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/dashboard" class="breadcrumb-link">
                                        <i class="ti ti-home"></i> Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <i class="ti ti-users"></i> Data Penduduk
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-content">
                            <h2 class="page-title">
                                <i class="ti ti-users"></i> Data Penduduk
                            </h2>
                            <p class="page-subtitle">Kelola data penduduk desa dengan mudah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Statistics Cards dengan Modern Styling -->
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card stat-card-penduduk border-0">
                    <div class="card-body">
                        <div class="stat-card-bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                            <div class="flex-shrink-0">
                                <div class="stat-icon stat-icon-primary">
                                    <i class="ti ti-users"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="stat-label mb-0">Total Penduduk</h6>
                                <p class="stat-value mb-0">
                                    <?php echo e(\App\Models\Penduduk::where('status_hidup', 'Hidup')->count()); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card stat-card-akun border-0">
                    <div class="card-body">
                        <div class="stat-card-bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                            <div class="flex-shrink-0">
                                <div class="stat-icon stat-icon-success">
                                    <i class="ti ti-user-check"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="stat-label mb-0">Memiliki Akun</h6>
                                <p class="stat-value mb-0">
                                    <?php echo e(\App\Models\User::where('role', 'user')->count()); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card stat-card-belum-akun border-0">
                    <div class="card-body">
                        <div class="stat-card-bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                            <div class="flex-shrink-0">
                                <div class="stat-icon stat-icon-warning">
                                    <i class="ti ti-user-x"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="stat-label mb-0">Belum Punya Akun</h6>
                                <p class="stat-value mb-0">
                                    <?php echo e(\App\Models\Penduduk::where('status_hidup', 'Hidup')->whereNotIn('nik', \App\Models\User::pluck('nik'))->count()); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-card stat-card-meninggal border-0">
                    <div class="card-body">
                        <div class="stat-card-bg"></div>
                        <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                            <div class="flex-shrink-0">
                                <div class="stat-icon stat-icon-danger">
                                    <i class="ti ti-heart-broken"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="stat-label mb-0">Meninggal</h6>
                                <p class="stat-value mb-0">
                                    <?php echo e(\App\Models\Penduduk::where('status_hidup', 'Meninggal')->count()); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="col-sm-12">
                <div class="card main-card border-0">
                    <div class="card-header-modern">
                        <div class="header-left">
                            <h5 class="card-title">
                                <i class="ti ti-list"></i> Daftar Penduduk
                            </h5>
                        </div>
                        <div class="header-right">
                            <a href="<?php echo e(route('admin.penduduk.create')); ?>" class="btn btn-primary btn-sm">
                                <i class="ti ti-plus me-1"></i> Tambah Penduduk
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(session('success')): ?>
                            <div class="alert alert-success-modern alert-dismissible fade show" role="alert">
                                <div class="alert-content">
                                    <i class="ti ti-circle-check"></i>
                                    <span><?php echo e(session('success')); ?></span>
                                </div>
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
                                            placeholder="Cari NIK, Nama, atau Alamat..." value="<?php echo e(request('search')); ?>">
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
                            <table class="table table-modern">
                                <thead>
                                    <tr>
                                        <th class="col-num">No</th>
                                        <th>NIK</th>
                                        <th>Nama Lengkap</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th class="col-action">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $penduduks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $penduduk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="table-row-modern">
                                            <td class="col-num">
                                                <span class="row-number"><?php echo e($penduduks->firstItem() + $key); ?></span>
                                            </td>
                                            <td>
                                                <strong class="nik-text"><?php echo e($penduduk->nik); ?></strong>
                                            </td>
                                            <td>
                                                <span class="nama-text"><?php echo e($penduduk->nama_lengkap); ?></span>
                                                <?php
                                                    $hasAccount = \App\Models\User::where('nik', $penduduk->nik)->exists();
                                                ?>
                                                <?php if($hasAccount): ?>
                                                    <br><span class="badge bg-success mt-1" title="Memiliki akun sistem">
                                                        <i class="ti ti-user-check"></i> Pengguna Terdaftar
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="jk-badge"><?php echo e($penduduk->jenis_kelamin); ?></span>
                                            </td>
                                            <td>
                                                <span class="ttl-text"><?php echo e($penduduk->tempat_lahir); ?>,
                                                    <?php echo e($penduduk->tanggal_lahir->format('d-m-Y')); ?></span>
                                            </td>
                                            <td>
                                                <span class="alamat-text"><?php echo e(Str::limit($penduduk->alamat, 30)); ?></span>
                                            </td>
                                            <td class="col-action">
                                                <a href="<?php echo e(route('admin.penduduk.show', $penduduk->id)); ?>"
                                                    class="btn-action btn-view" title="Detail">
                                                    <i class="ti ti-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('admin.penduduk.edit', $penduduk->id)); ?>"
                                                    class="btn-action btn-edit" title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="<?php echo e(route('admin.penduduk.destroy', $penduduk->id)); ?>"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                                                    class="d-inline">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" class="p-0">
                                                <div class="empty-state">
                                                    <div class="empty-state-icon">
                                                        <i class="ti ti-users-off"></i>
                                                    </div>
                                                    <p class="empty-state-title">Belum Ada Data Penduduk</p>
                                                    <p class="empty-state-desc">
                                                        <?php if(request('search') || request('filter_account')): ?>
                                                            Tidak ada data penduduk dengan kriteria pencarian tersebut
                                                        <?php else: ?>
                                                            Belum ada data penduduk
                                                        <?php endif; ?>
                                                    </p>
                                                    <?php if(request('search') || request('filter_account')): ?>
                                                        <a href="<?php echo e(route('admin.penduduk.index')); ?>"
                                                            class="btn btn-secondary btn-sm mt-2">
                                                            <i class="ti ti-refresh"></i> Reset Filter
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="pagination-wrapper">
                            <?php echo e($penduduks->links('vendor.pagination.modern')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ============================================
       ADMIN PENDUDUK INDEX - MODERN STYLING
       ============================================ */

        /* Breadcrumb Modern */
        .breadcrumb-modern {
            background: transparent !important;
            padding: 0 !important;
        }

        .breadcrumb-modern .breadcrumb {
            margin-bottom: 20px;
        }

        .breadcrumb-modern .breadcrumb-item {
            position: relative;
        }

        .breadcrumb-modern .breadcrumb-link {
            color: #4680ff;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .breadcrumb-modern .breadcrumb-link:hover {
            color: #357abd;
        }

        .breadcrumb-modern .breadcrumb-item.active {
            color: #6c757d;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* Page Header Content */
        .page-header-content {
            margin: 0;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .page-title i {
            color: #4680ff;
            font-size: 32px;
        }

        .page-subtitle {
            color: #6c757d;
            font-size: 14px;
            margin: 0;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 12px !important;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            background: rgba(255, 255, 255, 0.85) !important;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }

        .stat-card-bg {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 12px;
            z-index: 0;
        }

        .stat-card-penduduk .stat-card-bg {
            background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
            opacity: 0.08;
        }

        .stat-card-akun .stat-card-bg {
            background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
            opacity: 0.08;
        }

        .stat-card-belum-akun .stat-card-bg {
            background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
            opacity: 0.08;
        }

        .stat-card-meninggal .stat-card-bg {
            background: linear-gradient(135deg, #ff5370 0%, #ff2d55 100%);
            opacity: 0.08;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
            box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
        }

        .stat-icon-primary {
            background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
        }

        .stat-icon-success {
            background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
        }

        .stat-icon-warning {
            background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
        }

        .stat-icon-danger {
            background: linear-gradient(135deg, #ff5370 0%, #ff2d55 100%);
        }

        .stat-label {
            font-size: 13px;
            font-weight: 600;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Main Card */
        .main-card {
            border-radius: 14px;
            border: 1px solid rgba(255, 255, 255, 0.3) !important;
            background: rgba(255, 255, 255, 0.85) !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        /* Card Header Modern */
        .card-header-modern {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(70, 128, 255, 0.05) 100%);
            border-bottom: 1px solid rgba(70, 128, 255, 0.1);
            padding: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left .card-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header-left .card-title i {
            color: #4680ff;
            font-size: 20px;
        }

        /* Alert Modern */
        .alert-success-modern {
            border-radius: 10px;
            border: none;
            margin-bottom: 20px;
            padding: 14px 18px;
            backdrop-filter: blur(10px);
            background: rgba(44, 168, 127, 0.1);
            color: #2ca87f;
            border: 1px solid rgba(44, 168, 127, 0.2);
        }

        .alert-content {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .alert-content i {
            font-size: 18px;
        }

        /* Table Modern */
        .table-modern {
            border-collapse: separate;
            border-spacing: 0 10px;
            margin-bottom: 0;
        }

        .table-modern thead th {
            background: linear-gradient(135deg, rgba(70, 128, 255, 0.08) 0%, rgba(44, 168, 127, 0.08) 100%);
            border: none;
            color: #4680ff;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 15px 12px;
        }

        .table-modern thead th:first-child {
            border-radius: 8px 0 0 8px;
        }

        .table-modern thead th:last-child {
            border-radius: 0 8px 8px 0;
        }

        .table-row-modern {
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(70, 128, 255, 0.1);
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .table-row-modern:hover {
            background: rgba(70, 128, 255, 0.08);
            box-shadow: 0 8px 20px rgba(70, 128, 255, 0.1);
            transform: translateX(4px);
        }

        .table-modern td {
            border: none;
            padding: 16px 12px;
            vertical-align: middle;
        }

        .table-modern td:first-child {
            border-radius: 8px 0 0 8px;
        }

        .table-modern td:last-child {
            border-radius: 0 8px 8px 0;
        }

        .row-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
            color: white;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
        }

        .nik-text {
            color: #2c3e50;
            font-size: 14px;
        }

        .nama-text {
            color: #2c3e50;
            font-size: 14px;
            font-weight: 500;
        }

        .jk-badge {
            background: rgba(70, 128, 255, 0.1);
            color: #4680ff;
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            display: inline-block;
        }

        .ttl-text {
            color: #6c757d;
            font-size: 14px;
            font-weight: 500;
        }

        .alamat-text {
            color: #6c757d;
            font-size: 14px;
        }

        /* Button Action */
        .btn-action {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            margin-right: 8px;
        }

        .btn-view {
            background: rgba(0, 212, 255, 0.15);
            color: #00d4ff;
        }

        .btn-view:hover {
            background: rgba(0, 212, 255, 0.25);
            box-shadow: 0 4px 12px rgba(0, 212, 255, 0.2);
            transform: translateY(-2px);
        }

        .btn-edit {
            background: rgba(255, 152, 0, 0.15);
            color: #ff9800;
        }

        .btn-edit:hover {
            background: rgba(255, 152, 0, 0.25);
            box-shadow: 0 4px 12px rgba(255, 152, 0, 0.2);
            transform: translateY(-2px);
        }

        .btn-delete {
            background: rgba(255, 83, 112, 0.15);
            color: #ff5370;
        }

        .btn-delete:hover {
            background: rgba(255, 83, 112, 0.25);
            box-shadow: 0 4px 12px rgba(255, 83, 112, 0.2);
            transform: translateY(-2px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
        }

        .empty-state-icon {
            font-size: 80px;
            color: rgba(70, 128, 255, 0.2);
            margin-bottom: 20px;
        }

        .empty-state-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .empty-state-desc {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 0;
        }

        /* Pagination Wrapper */
        .pagination-wrapper {
            margin-top: 24px;
            display: flex;
            justify-content: flex-end;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .page-title {
                font-size: 22px;
            }

            .table-responsive {
                font-size: 13px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/admin/penduduk/index.blade.php ENDPATH**/ ?>