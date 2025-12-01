<?php $__env->startSection('title', 'Edit Profile'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* Ensure avatar is always square and not stretched */
        #avatarPreview {
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            object-position: center !important;
        }
        
        .cropper-container {
            position: relative;
        }
        
        #cropperImage {
            max-width: 100%;
            max-height: 400px;
        }
    </style>
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('myprofile')); ?>">User Profile</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Profile</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Edit Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Update Profil Anda</h5>
                        <a href="<?php echo e(route('myprofile')); ?>" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <strong>Terdapat kesalahan:</strong>
                                <ul class="mb-0">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo e(session('success')); ?>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="row">
                                <!-- Avatar Section -->
                                <div class="col-md-4 mb-4">
                                    <div class="card border">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <img id="avatarPreview" 
                                                     src="<?php echo e(auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/avatar-default.png')); ?>" 
                                                     alt="Avatar" 
                                                     class="img-fluid rounded-circle" 
                                                     style="width: 150px; height: 150px; object-fit: cover;">
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatar" class="form-label">Foto Profil</label>
                                                <input type="file" name="avatar" id="avatar" class="form-control <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept="image/*">
                                                <small class="text-muted">Max 2MB. Format: JPG, PNG, GIF</small>
                                                <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <div class="d-flex gap-2 mb-2">
                                                <button type="button" id="openCropButton" class="btn btn-sm btn-info flex-grow-1" style="display: none;">
                                                    <i class="ti ti-crop"></i> Crop & Sesuaikan
                                                </button>
                                            </div>
                                            <button type="button" id="resetAvatar" class="btn btn-sm btn-outline-secondary w-100">
                                                <i class="ti ti-x"></i> Batalkan
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Data -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_lengkap" class="form-control <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                   value="<?php echo e(old('nama_lengkap', $user->nama_lengkap)); ?>" required>
                                            <?php $__errorArgs = ['nama_lengkap'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                   value="<?php echo e(old('email', $user->email)); ?>" required>
                                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No. Telepon</label>
                                            <input type="text" name="no_telepon" class="form-control <?php $__errorArgs = ['no_telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                   value="<?php echo e(old('no_telepon', $user->no_telepon)); ?>" maxlength="15">
                                            <?php $__errorArgs = ['no_telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" class="form-control <?php $__errorArgs = ['pekerjaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                                   value="<?php echo e(old('pekerjaan', $user->pekerjaan)); ?>">
                                            <?php $__errorArgs = ['pekerjaan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ti ti-check"></i> Simpan Perubahan
                                                </button>
                                                <a href="<?php echo e(route('myprofile')); ?>" class="btn btn-outline-secondary">
                                                    <i class="ti ti-x"></i> Batal
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Read-only sections -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Informasi Identitas (Tidak dapat diubah)</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted"><strong>NIK</strong></td>
                                        <td width="2%">:</td>
                                        <td><?php echo e($user->nik); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Jenis Kelamin</strong></td>
                                        <td>:</td>
                                        <td>
                                            <?php if($user->jenis_kelamin === 'Laki-laki'): ?>
                                                Laki-laki
                                            <?php elseif($user->jenis_kelamin === 'Perempuan'): ?>
                                                Perempuan
                                            <?php else: ?>
                                                <?php echo e($user->jenis_kelamin ?? 'N/A'); ?>

                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Tanggal Lahir</strong></td>
                                        <td>:</td>
                                        <td><?php echo e($user->tanggal_lahir ? $user->tanggal_lahir->format('d-m-Y') : 'N/A'); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Alamat (Tidak dapat diubah)</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted"><strong>Alamat</strong></td>
                                        <td width="2%">:</td>
                                        <td><?php echo e($user->alamat); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Desa</strong></td>
                                        <td>:</td>
                                        <td><?php echo e($user->desa); ?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Kecamatan</strong></td>
                                        <td>:</td>
                                        <td><?php echo e($user->kecamatan); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <!-- Crop Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Sesuaikan Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="max-height: 600px; display: flex; align-items: center; justify-content: center; background: #f5f5f5; border-radius: 8px; padding: 20px;">
                        <img id="cropperImage" src="" alt="Crop Image" style="max-width: 100%; max-height: 550px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i> Batalkan
                    </button>
                    <button type="button" id="cropButton" class="btn btn-primary">
                        <i class="ti ti-check"></i> Simpan Crop
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- CDN Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        let cropper = null;
        let currentFile = null;

        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatarPreview');
            const resetButton = document.getElementById('resetAvatar');
            const openCropButton = document.getElementById('openCropButton');
            const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
            const cropperImage = document.getElementById('cropperImage');
            const cropButton = document.getElementById('cropButton');
            const originalPreview = avatarPreview.src;

            // Preview avatar when file is selected
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    currentFile = file;
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        // Show crop button
                        openCropButton.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Open crop modal when button is clicked
            openCropButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentFile) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        cropperImage.src = event.target.result;
                        
                        // Destroy old cropper if exists
                        if (cropper) {
                            cropper.destroy();
                        }
                        
                        // Initialize cropper
                        setTimeout(() => {
                            cropper = new Cropper(cropperImage, {
                                aspectRatio: 1,
                                viewMode: 1,
                                autoCropArea: 1,
                                responsive: true,
                                restore: true,
                                guides: true,
                                center: true,
                                highlight: true,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                                toggleDragModeOnDblclick: true,
                            });
                        }, 100);
                        
                        // Show crop modal
                        cropModal.show();
                    };
                    reader.readAsDataURL(currentFile);
                }
            });

            // Save crop
            cropButton.addEventListener('click', function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        maxWidth: 500,
                        maxHeight: 500,
                        fillColor: '#fff',
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    // Convert canvas to blob and update preview
                    canvas.toBlob(function(blob) {
                        const url = URL.createObjectURL(blob);
                        avatarPreview.src = url;
                        
                        // Update file input with cropped image
                        const dt = new DataTransfer();
                        const file = new File([blob], currentFile.name, { type: 'image/png' });
                        dt.items.add(file);
                        avatarInput.files = dt.files;
                        
                        // Close modal
                        cropModal.hide();
                    }, 'image/png');
                }
            });

            // Reset avatar preview
            resetButton.addEventListener('click', function() {
                avatarInput.value = '';
                avatarPreview.src = originalPreview;
                openCropButton.style.display = 'none';
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                currentFile = null;
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LARAVEL12\appdesa\resources\views/auth/edit-profile.blade.php ENDPATH**/ ?>