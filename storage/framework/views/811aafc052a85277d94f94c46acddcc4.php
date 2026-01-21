<?php $__env->startSection('title', 'My Profile'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* Ensure avatar is always square and not stretched */
        .chat-avtar img {
            width: 70px !important;
            height: 70px !important;
            object-fit: cover !important;
            object-position: center !important;
        }

        /* Performance Optimization */
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
            padding: 20px !important;
            border-radius: 15px 15px 0 0 !important;
        }

        .card-header h5 {
            color: #4680ff;
            font-weight: 700;
            font-size: 18px;
            margin: 0;
        }

        .card-body {
            padding: 24px !important;
        }

        .badge {
            padding: 8px 14px !important;
            border-radius: 8px !important;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .badge.bg-primary {
            background: linear-gradient(135deg, #4680ff 0%, #357abd 100%) !important;
            color: white;
        }

        .badge.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #229070 100%) !important;
            color: white;
        }

        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4680ff 0%, #357abd 100%) !important;
            border: none;
            border-radius: 10px;
            color: white;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(70, 128, 255, 0.35);
            color: white;
        }

        .page-header-title h2 {
            color: #2c3e50;
            font-weight: 700;
        }

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
        }

        .breadcrumb-item a:hover {
            color: #357abd;
            transform: translateX(2px);
        }

        .breadcrumb-item.active {
            color: #6c757d;
        }

        p.text-muted {
            color: #6c757d !important;
        }

        p.text-muted strong {
            color: #4680ff;
            font-weight: 700;
        }

        hr {
            border-color: rgba(70, 128, 255, 0.1) !important;
            margin: 16px 0 !important;
        }

        .text-sm {
            font-size: 13px !important;
        }

        .text-center {
            text-align: center;
        }

        h5.mb-0 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 0;
        }

        /* Profile Avatar Enhancement */
        .profile-avatar-container {
            position: relative;
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }

        .profile-avatar {
            width: 180px;
            height: 180px;
            border-radius: 20px;
            object-fit: cover;
            object-position: center;
            box-shadow: 0 15px 40px rgba(70, 128, 255, 0.25);
            border: 4px solid white;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, rgba(70, 128, 255, 0.1) 0%, rgba(44, 168, 127, 0.08) 100%);
        }

        .profile-avatar:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(70, 128, 255, 0.35);
        }

        .profile-card-header {
            background: linear-gradient(135deg, rgba(70, 128, 255, 0.15) 0%, rgba(44, 168, 127, 0.12) 100%);
            padding: 32px 24px 24px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }

        /* Lazy load shimmer effect */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: calc(200% + 100px) 0; }
        }
    </style>
    
    <?php
        // Data sudah di-cache dari ProfileController
        // Tidak perlu parsing ulang di sini
    ?>

    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">User Profile</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">User Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-xxl-3">
                                <div class="card">
                                    <div class="profile-card-header">
                                        <div class="profile-avatar-container">
                                            <img class="profile-avatar"
                                                src="<?php echo e($avatarUrl); ?>"
                                                alt="<?php echo e($user->nama_lengkap); ?>"
                                                width="180"
                                                height="180"
                                                loading="eager"
                                                decoding="async">
                                        </div>
                                        <h5 class="mb-0" style="font-size: 22px; margin-bottom: 8px;"><?php echo e($user->nama_lengkap); ?></h5>
                                        <p class="text-muted text-sm" style="margin-bottom: 0;"><?php echo e($user->pekerjaan ?? 'N/A'); ?></p>
                                    </div>
                                    <div class="card-body">
                                        <hr class="my-3">
                                        <div class="mb-3">
                                            <i class="ti ti-mail me-2"></i>
                                            <p class="mb-0 text-truncate"><small><?php echo e($user->email); ?></small></p>
                                        </div>
                                        <div class="mb-3">
                                            <i class="ti ti-phone me-2"></i>
                                            <p class="mb-0"><?php echo e($user->no_telepon ?? 'N/A'); ?></p>
                                        </div>
                                        <div class="mb-3">
                                            <i class="ti ti-id me-2"></i>
                                            <p class="mb-0"><?php echo e($user->nik); ?></p>
                                        </div>
                                        <hr class="my-3">
                                        <div class="mb-3" style="text-align: center;">
                                            <span class="badge bg-primary"><?php echo e(ucfirst($user->role)); ?></span>
                                            <?php if($user->is_verified): ?>
                                                <span class="badge bg-success">Terverifikasi</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning">Belum Terverifikasi</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="mt-3">
                                            <a href="<?php echo e(route('profile.edit')); ?>" class="btn btn-primary btn-sm w-100">
                                                <i class="ti ti-edit me-1"></i> Edit Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xxl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Pribadi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Nama Lengkap</strong></p>
                                                <p class="mb-0"><?php echo e($user->nama_lengkap); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>NIK</strong></p>
                                                <p class="mb-0"><?php echo e($user->nik); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Tempat Lahir</strong></p>
                                                <p class="mb-0"><?php echo e($user->tempat_lahir ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Tanggal Lahir</strong></p>
                                                <p class="mb-0"><?php echo e($formatTanggal); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Umur</strong></p>
                                                <p class="mb-0"><?php echo e($umur ? $umur . ' tahun' : 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Jenis Kelamin</strong></p>
                                                <p class="mb-0">
                                                    <?php if($user->jenis_kelamin === 'L'): ?>
                                                        Laki-laki
                                                    <?php elseif($user->jenis_kelamin === 'P'): ?>
                                                        Perempuan
                                                    <?php else: ?>
                                                        <?php echo e($user->jenis_kelamin ?? 'N/A'); ?>

                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Agama</strong></p>
                                                <p class="mb-0"><?php echo e($user->agama ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Status Perkawinan</strong></p>
                                                <p class="mb-0"><?php echo e($user->status_perkawinan ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kewarganegaraan</strong></p>
                                                <p class="mb-0"><?php echo e($user->kewarganegaraan ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Pekerjaan</strong></p>
                                                <p class="mb-0"><?php echo e($user->pekerjaan ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Pendidikan Terakhir</strong></p>
                                                <p class="mb-0"><?php echo e($user->pendidikan_terakhir ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card mt-4">
                                    <div class="card-header">
                                        <h5>Alamat</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Alamat Lengkap</strong></p>
                                                <p class="mb-0"><?php echo e($user->alamat ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>RT</strong></p>
                                                <p class="mb-0"><?php echo e($user->rt ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>RW</strong></p>
                                                <p class="mb-0"><?php echo e($user->rw ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Desa</strong></p>
                                                <p class="mb-0"><?php echo e($user->desa ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kecamatan</strong></p>
                                                <p class="mb-0"><?php echo e($user->kecamatan ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kabupaten</strong></p>
                                                <p class="mb-0"><?php echo e($user->kabupaten ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Provinsi</strong></p>
                                                <p class="mb-0"><?php echo e($user->provinsi ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kode Pos</strong></p>
                                                <p class="mb-0"><?php echo e($user->kode_pos ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Identitas Orang Tua</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Nama Ayah</strong></p>
                                                <p class="mb-0"><?php echo e($user->nama_ayah ?? 'N/A'); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Nama Ibu</strong></p>
                                                <p class="mb-0"><?php echo e($user->nama_ibu ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Informasi Kontak</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Email</strong></p>
                                                <p class="mb-0"><?php echo e($user->email); ?></p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>No. Telepon</strong></p>
                                                <p class="mb-0"><?php echo e($user->no_telepon ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/myprofile.blade.php ENDPATH**/ ?>