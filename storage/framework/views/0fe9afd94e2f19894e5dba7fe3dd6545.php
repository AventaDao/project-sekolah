<?php $__env->startSection('title', 'Resetting Your Password ?'); ?>

<?php $__env->startSection('content'); ?>
    
    <?php if($credensial['token'] && $credensial['user']): ?>
    <div class="card my-5">
        <form method="POST" action="<?php echo e(route('password.update')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="token" value="<?php echo e($credensial['token']); ?>">
            <input type="hidden" name="email" value="<?php echo e($credensial['user']->email); ?>">
            <div class="card-body">
                <div class="mb-4">
                    <h2 class="mb-4"><b>Reset Password</b></h2>
                    <div class="my-2">
                        <p class="mb-2"><b><?php echo e($credensial['user']->name); ?></b>, kamu mau mengganti password untuk email
                            <b><?php echo e($credensial['user']->email); ?></b> ya?
                        </p>
                        <p>Bikin password yang kuat dan mudah diingat ya</p>
                    </div>
                </div>

                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">

                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($error); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                <?php endif; ?>
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                        required>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
    <?php else: ?>
    <div class="card my-5">
        <div class="card-body text-center p-5">
            <i class="ti ti-alert-circle" style="font-size: 48px; color: #dc2626;"></i>
            <h3 class="mt-3 mb-2">Token Tidak Valid</h3>
            <p class="text-muted mb-4">Token reset password Anda tidak valid atau sudah kadaluarsa. Silakan request ulang reset password.</p>
            <a href="<?php echo e(route('forgot_password.email_form')); ?>" class="btn btn-primary">Request Reset Password Baru</a>
        </div>
    </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\User\Documents\Laravel\UKK\appsdesa\resources\views/auth/forgot-password/reset.blade.php ENDPATH**/ ?>