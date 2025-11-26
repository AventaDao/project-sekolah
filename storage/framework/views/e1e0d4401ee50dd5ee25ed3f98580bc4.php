<?php $__env->startSection('title', 'Detail Data Penduduk'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.penduduk.index')); ?>">Data Penduduk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail Penduduk</li>
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
                    <h5>Detail Data Penduduk</h5>
                    <div>
                        <a href="<?php echo e(route('admin.penduduk.edit', $penduduk->id)); ?>" class="btn btn-warning btn-sm">
                            <i class="ti ti-edit"></i> Edit
                        </a>
                        <a href="<?php echo e(route('admin.penduduk.index')); ?>" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <?php
                        $userAccount = \App\Models\User::where('nik', $penduduk->nik)->first();
                    ?>

                    <!-- Status Akun -->
                    <?php if($userAccount): ?>
                    <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                        <i class="ti ti-user-check f-24 me-3"></i>
                        <div>
                            <strong>Status Akun: Terdaftar</strong>
                            <p class="mb-0">Penduduk ini telah memiliki akun sistem dengan email: <strong><?php echo e($userAccount->email ?? 'Tidak ada email'); ?></strong></p>
                            <small class="text-muted">Role: <?php echo e(ucfirst($userAccount->role)); ?> | Verifikasi: <?php echo e($userAccount->is_verified ? 'Terverifikasi' : 'Belum Terverifikasi'); ?></small>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                        <i class="ti ti-user-x f-24 me-3"></i>
                        <div>
                            <strong>Status Akun: Belum Terdaftar</strong>
                            <p class="mb-0">Penduduk ini belum memiliki akun sistem</p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Data Identitas -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Identitas</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">NIK</td>
                                    <td width="5%">:</td>
                                    <td><strong><?php echo e($penduduk->nik); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Nama Lengkap</td>
                                    <td>:</td>
                                    <td><strong><?php echo e($penduduk->nama_lengkap); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->jenis_kelamin); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Tempat Lahir</td>
                                    <td width="5%">:</td>
                                    <td><?php echo e($penduduk->tempat_lahir); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->tanggal_lahir->format('d F Y')); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Umur</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->umur); ?> Tahun</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Alamat -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Alamat</h5>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="20%" class="text-muted">Alamat</td>
                                    <td width="2%">:</td>
                                    <td><?php echo e($penduduk->alamat); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">RT / RW</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->rt); ?> / <?php echo e($penduduk->rw); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Desa / Kelurahan</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->desa); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kecamatan</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->kecamatan); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kabupaten / Kota</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->kabupaten); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Provinsi</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->provinsi); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kode Pos</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->kode_pos); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Lainnya -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Lainnya</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Agama</td>
                                    <td width="5%">:</td>
                                    <td><?php echo e($penduduk->agama); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status Perkawinan</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->status_perkawinan); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Pekerjaan</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->pekerjaan); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kewarganegaraan</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->kewarganegaraan); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Pendidikan Terakhir</td>
                                    <td width="5%">:</td>
                                    <td><?php echo e($penduduk->pendidikan_terakhir ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">No. Telepon</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->no_telepon ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Status</td>
                                    <td>:</td>
                                    <td>
                                        <?php if($penduduk->status_hidup == 'Hidup'): ?>
                                            <span class="badge bg-success">Hidup</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Meninggal</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if($penduduk->status_hidup == 'Meninggal' && $penduduk->tanggal_meninggal): ?>
                                <tr>
                                    <td class="text-muted">Tanggal Meninggal</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->tanggal_meninggal->format('d F Y')); ?></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>

                    <!-- Data Keluarga -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Data Keluarga</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nama Ayah</td>
                                    <td width="5%">:</td>
                                    <td><?php echo e($penduduk->nama_ayah ?? '-'); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nama Ibu</td>
                                    <td width="5%">:</td>
                                    <td><?php echo e($penduduk->nama_ibu ?? '-'); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Data Sistem -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Sistem</h5>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="20%" class="text-muted">Data Dibuat</td>
                                    <td width="2%">:</td>
                                    <td><?php echo e($penduduk->created_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td><?php echo e($penduduk->updated_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                                <?php if($userAccount): ?>
                                <tr>
                                    <td class="text-muted">Akun Dibuat</td>
                                    <td>:</td>
                                    <td><?php echo e($userAccount->created_at->format('d F Y H:i')); ?> WIB</td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LARAVEL12\inidesa\resources\views/admin/penduduk/show.blade.php ENDPATH**/ ?>