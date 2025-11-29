<?php $__env->startSection('title', 'Detail Aktivitas User'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.activities.index')); ?>">Riwayat Aktivitas User</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
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
                    <h5>Detail Aktivitas User</h5>
                    <a href="<?php echo e(route('admin.activities.index')); ?>" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="text-primary mb-3"><strong>Informasi User</strong></h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nama User</td>
                                    <td width="5%">:</td>
                                    <td><strong><?php echo e($activity->user->nama_lengkap); ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">NIK</td>
                                    <td>:</td>
                                    <td><?php echo e($activity->user->nik); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>:</td>
                                    <td><?php echo e($activity->user->email); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Role</td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge bg-info"><?php echo e(ucfirst($activity->user->role)); ?></span>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-6 mb-4">
                            <h6 class="text-primary mb-3"><strong>Informasi Aktivitas</strong></h6>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Tipe Aktivitas</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <?php
                                            $badgeClass = match($activity->activity_type) {
                                                'login' => 'bg-success',
                                                'logout' => 'bg-warning',
                                                'register' => 'bg-info',
                                                'profile_update' => 'bg-primary',
                                                'password_change' => 'bg-danger',
                                                'email_verify' => 'bg-success',
                                                'pengajuan_surat_create' => 'bg-primary',
                                                'pengajuan_surat_update' => 'bg-primary',
                                                'pengajuan_surat_delete' => 'bg-danger',
                                                'pengajuan_surat_download' => 'bg-info',
                                                'berita_view' => 'bg-secondary',
                                                default => 'bg-secondary'
                                            };
                                        ?>
                                        <span class="badge <?php echo e($badgeClass); ?>">
                                            <?php echo e(\App\Models\Activity::getActivityTypes()[$activity->activity_type] ?? ucfirst($activity->activity_type)); ?>

                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Waktu Aktivitas</td>
                                    <td>:</td>
                                    <td><?php echo e($activity->created_at->format('d F Y H:i:s')); ?> WIB</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Waktu Relatif</td>
                                    <td>:</td>
                                    <td><?php echo e($activity->created_at->diffForHumans()); ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">IP Address</td>
                                    <td>:</td>
                                    <td><code><?php echo e($activity->ip_address); ?></code></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="text-primary mb-3"><strong>Deskripsi Aktivitas</strong></h6>
                    <div class="alert alert-light border">
                        <p class="mb-0"><?php echo e($activity->description); ?></p>
                    </div>

                    <?php if($activity->related_type): ?>
                    <hr class="my-4">
                    <h6 class="text-primary mb-3"><strong>Resource Terkait</strong></h6>
                    <table class="table table-borderless">
                        <tr>
                            <td width="40%" class="text-muted">Tipe Resource</td>
                            <td width="5%">:</td>
                            <td><?php echo e($activity->related_type); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">ID Resource</td>
                            <td>:</td>
                            <td><code><?php echo e($activity->related_id); ?></code></td>
                        </tr>
                    </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\Laravel\UKK\appsdesa\resources\views/admin/activities/show.blade.php ENDPATH**/ ?>