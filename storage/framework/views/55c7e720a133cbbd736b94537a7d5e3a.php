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
                    <?php if($activities && count($activities) > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No.</th>
                                        <th style="width: 20%;">Aktivitas</th>
                                        <th style="width: 40%;">Deskripsi</th>
                                        <th style="width: 18%;">Waktu</th>
                                        <th style="width: 15%;">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo e($key + 1); ?></strong>
                                        </td>
                                        <td>
                                            <?php
                                                $badgeClass = match($activity['type'] ?? '') {
                                                    'authentication' => 'bg-success',
                                                    'document' => 'bg-primary',
                                                    'approval' => 'bg-warning',
                                                    'user' => 'bg-info',
                                                    'form' => 'bg-secondary',
                                                    default => 'bg-light text-dark'
                                                };
                                            ?>
                                            <span class="badge <?php echo e($badgeClass); ?>">
                                                <?php echo e(ucfirst($activity['action'] ?? 'Unknown')); ?>

                                            </span>
                                        </td>
                                        <td>
                                            <?php echo e($activity['description'] ?? $activity['message'] ?? 'N/A'); ?>

                                            <?php if(!empty($activity['login_method'])): ?>
                                            <small class="text-muted d-block">Metode: <?php echo e(ucfirst(str_replace('_', ' ', $activity['login_method']))); ?></small>
                                            <?php endif; ?>
                                            <?php if(!empty($activity['role'])): ?>
                                            <small class="text-muted d-block">Role: <?php echo e(ucfirst($activity['role'])); ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <small>
                                                <?php if($activity['timestamp']): ?>
                                                    <?php
                                                        $timestamp = $activity['timestamp'];
                                                        if (is_string($timestamp)) {
                                                            $timestamp = \Carbon\Carbon::parse($timestamp);
                                                        }
                                                        echo $timestamp->diffForHumans();
                                                    ?>
                                                    <br>
                                                    <?php echo e($timestamp->format('d M Y H:i') ?? 'N/A'); ?>

                                                <?php endif; ?>
                                            </small>
                                        </td>
                                        <td>
                                            <code><?php echo e($activity['ip_address'] ?? 'N/A'); ?></code>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="alert alert-info" role="alert">
                            <strong>Tidak ada data aktivitas</strong><br>
                            Belum ada aktivitas yang tercatat untuk Anda di Firebase.
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

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/user/activities/index.blade.php ENDPATH**/ ?>