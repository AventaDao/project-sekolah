<?php $__env->startSection('title', 'Riwayat Aktivitas User'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Riwayat Aktivitas User</li>
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
                    <h5>Riwayat Aktivitas Semua User</h5>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#clearLogsModal">
                        <i class="ti ti-trash"></i> Clear Logs
                    </button>
                </div>
                <div class="card-body">
                    <?php if($activities->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama User</th>
                                        <th>Aktivitas</th>
                                        <th>Deskripsi</th>
                                        <th>Waktu</th>
                                        <th>IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="cursor-pointer" data-activity-id="<?php echo e($activity->id); ?>" onclick="window.location.href='<?php echo e(route('admin.activities.show', $activity->id)); ?>'">
                                        <td>
                                            <strong><?php echo e(($activities->currentPage() - 1) * $activities->perPage() + $loop->iteration); ?></strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark">
                                                <?php echo e($activity->user->nama_lengkap ?? 'N/A'); ?>

                                            </span>
                                            <small class="text-muted d-block"><?php echo e($activity->user->nik ?? 'N/A'); ?></small>
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
                            <?php echo e($activities->links('pagination::bootstrap-4')); ?>

                        </div>
                        
                        <style>
                            .pagination {
                                gap: 4px;
                            }
                            
                            .pagination .page-link {
                                padding: 0.375rem 0.75rem;
                                font-size: 0.875rem;
                                border-radius: 4px;
                                border: 1px solid #dee2e6;
                            }
                            
                            .pagination .page-item.active .page-link {
                                background-color: #4680ff;
                                border-color: #4680ff;
                                padding: 0.375rem 0.75rem;
                            }
                            
                            .pagination .page-item:first-child .page-link,
                            .pagination .page-item:last-child .page-link {
                                border-radius: 4px;
                            }
                        </style>
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

<!-- Clear Logs Confirmation Modal -->
<div class="modal fade" id="clearLogsModal" tabindex="-1" role="dialog" aria-labelledby="clearLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="clearLogsModalLabel">
                    <i class="ti ti-alert-triangle me-2"></i>Konfirmasi Hapus Logs
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning mb-3">
                    <i class="ti ti-alert-circle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan. Semua activity logs akan dihapus permanen dari sistem.
                </div>
                <p>Apakah Anda yakin ingin menghapus <strong>semua activity logs</strong>? Data yang dihapus tidak dapat dipulihkan kembali.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="<?php echo e(route('admin.activities.clear-logs')); ?>" method="POST" style="display: inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('POST'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-trash me-1"></i>Ya, Hapus Semua Logs
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\Laravel\UKK\appsdesa\resources\views/admin/activities/index.blade.php ENDPATH**/ ?>