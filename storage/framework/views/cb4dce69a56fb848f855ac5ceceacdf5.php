<?php $__env->startSection('title', 'Pesan Masuk'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Pesan Masuk</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Support ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Dikirim</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong><?php echo e($msg->support_id); ?></strong></td>
                                <td><?php echo e($msg->name); ?></td>
                                <td><?php echo e($msg->email); ?></td>
                                <td><?php echo e($msg->subject); ?></td>
                                <td><?php echo e($msg->category); ?></td>
                                <td><?php echo e(ucfirst($msg->status)); ?></td>
                                <td><?php echo e($msg->created_at->diffForHumans()); ?></td>
                                <td><a href="<?php echo e(route('admin.messages.show', $msg->id)); ?>" class="btn btn-sm btn-primary">Lihat</a></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <?php echo e($messages->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\UKK\project-sekolah\resources\views/admin/messages/index.blade.php ENDPATH**/ ?>