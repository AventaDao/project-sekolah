

<?php $__env->startSection('title', 'Detail Pesan'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Detail Pesan</h5>
                    <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
                <div class="card-body">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success"><?php echo e(session('status')); ?></div>
                    <?php endif; ?>

                    <h6>Support ID</h6>
                    <p><strong><?php echo e($message->support_id); ?></strong></p>

                    <h6>Pengirim</h6>
                    <p><strong><?php echo e($message->name); ?></strong> &middot; <?php echo e($message->email); ?> &middot; <?php echo e($message->phone); ?></p>

                    <h6>Subjek</h6>
                    <p><?php echo e($message->subject); ?></p>

                    <h6>Pesan</h6>
                    <p><?php echo e($message->message); ?></p>

                    <h6>Status</h6>
                    <p><?php echo e(ucfirst($message->status)); ?> <?php if($message->replied_at): ?> &middot; Dibalas <?php echo e($message->replied_at->diffForHumans()); ?> <?php endif; ?></p>

                    <hr>

                    <h6>Balas Pesan</h6>
                    <form action="<?php echo e(route('admin.messages.reply', $message->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <textarea name="reply" class="form-control" rows="6"><?php echo e(old('reply', $message->reply)); ?></textarea>
                            <?php $__errorArgs = ['reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger small"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-primary" type="submit">Kirim Balasan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\ukk26\resources\views/admin/messages/show.blade.php ENDPATH**/ ?>