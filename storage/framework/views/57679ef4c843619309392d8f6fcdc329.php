<?php $__env->startSection('title', 'Riwayat Aktivitas'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Riwayat Aktivitas</li>
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
                    <h5>Riwayat Aktivitas Anda</h5>
                </div>
                <div class="card-body">
                    <?php if($activities->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Aktivitas</th>
                                        <th>Deskripsi</th>
                                        <th>Waktu</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="cursor-pointer" data-activity-id="<?php echo e($activity->id); ?>">
                                        <td>
                                            <strong><?php echo e(($activities->currentPage() - 1) * $activities->perPage() + $loop->iteration); ?></strong>
                                        </td>
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
                                                    'pengaduan_create' => 'bg-primary',
                                                    'pengaduan_delete' => 'bg-danger',
                                                    'berita_view' => 'bg-secondary',
                                                    default => 'bg-secondary'
                                                };
                                            ?>
                                            <span class="badge <?php echo e($badgeClass); ?>">
                                                <?php echo e(\App\Models\Activity::getActivityTypes()[$activity->activity_type] ?? ucfirst($activity->activity_type)); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <small><?php echo e(Str::limit($activity->description, 50)); ?></small>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                <?php echo e($activity->created_at->format('d M Y H:i:s')); ?>

                                                <br>
                                                <em><?php echo e($activity->created_at->diffForHumans()); ?></em>
                                            </small>
                                        </td>
                                        <td>
                                            <small class="text-muted"><?php echo e($activity->ip_address); ?></small>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            <?php echo e($activities->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="ti ti-inbox" style="font-size: 48px; color: #ccc;"></i>
                            <p class="text-muted mt-3">Belum ada riwayat aktivitas</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    tr.cursor-pointer {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    
    tr.cursor-pointer:hover {
        background-color: #f5f5f5;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LARAVEL12\appdesa\resources\views/user/activities/index.blade.php ENDPATH**/ ?>