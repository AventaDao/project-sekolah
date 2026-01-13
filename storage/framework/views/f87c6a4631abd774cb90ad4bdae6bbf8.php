<?php $__env->startSection('title', 'Detail & Proses Pengajuan Surat'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.pengajuan-surat.index')); ?>">Kelola Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Detail Pengajuan -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Pengajuan Surat</h5>
                </div>
                <div class="card-body">
                    <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php endif; ?>

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge <?php echo e($pengajuanSurat->status_badge); ?> fs-6 px-3 py-2">
                            <i class="ti ti-file-check me-1"></i> Status: <?php echo e($pengajuanSurat->status); ?>

                        </span>
                    </div>

                    <!-- Data Pengajuan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengajuan</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%" class="text-muted">Nomor Pengajuan</td>
                            <td width="5%">:</td>
                            <td><strong><?php echo e($pengajuanSurat->nomor_pengajuan); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Pemohon</td>
                            <td>:</td>
                            <td><strong><?php echo e($pengajuanSurat->user->name); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>:</td>
                            <td><?php echo e($pengajuanSurat->user->email); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jenis Surat</td>
                            <td>:</td>
                            <td><strong><?php echo e($pengajuanSurat->jenis_surat); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Pengajuan</td>
                            <td>:</td>
                            <td><?php echo e($pengajuanSurat->created_at->format('d F Y H:i')); ?> WIB</td>
                        </tr>
                        <?php if($pengajuanSurat->tanggal_selesai): ?>
                        <tr>
                            <td class="text-muted">Tanggal Selesai</td>
                            <td>:</td>
                            <td><?php echo e($pengajuanSurat->tanggal_selesai->format('d F Y H:i')); ?> WIB</td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <!-- Keperluan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Keperluan</h5>
                    <p class="text-muted"><?php echo e($pengajuanSurat->keperluan); ?></p>

                    <!-- Keterangan Tambahan -->
                    <?php if($pengajuanSurat->keterangan_tambahan): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Keterangan Tambahan</h5>
                    <p class="text-muted"><?php echo e($pengajuanSurat->keterangan_tambahan); ?></p>
                    <?php endif; ?>

                    <!-- Detail Informasi Pengajuan (Field Teks) -->
                    <?php echo $__env->make('component.detail-pengajuan', ['pengajuanSurat' => $pengajuanSurat], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                    <!-- Surat Pengantar RW -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Surat Pengantar RW</h5>
                    <a href="<?php echo e(route('admin.pengajuan-surat.download-pengantar', $pengajuanSurat->id)); ?>" 
                       class="btn btn-outline-primary" target="_blank">
                        <i class="ti ti-download"></i> Download Surat Pengantar RW
                    </a>

                    <!-- Catatan Admin -->
                    <?php if($pengajuanSurat->catatan_admin): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Catatan Admin</h5>
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle me-2"></i>
                        <?php echo e($pengajuanSurat->catatan_admin); ?>

                    </div>
                    <?php endif; ?>

                    <!-- Surat Jadi -->
                    <?php if($pengajuanSurat->file_surat_jadi): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Surat Jadi</h5>
                    <a href="<?php echo e(route('admin.pengajuan-surat.download-surat-jadi', $pengajuanSurat->id)); ?>" 
                       class="btn btn-success" target="_blank">
                        <i class="ti ti-file-download"></i> Lihat Surat Jadi
                    </a>
                    <?php endif; ?>

                    <!-- Preview Dokumen yang Diunggah User -->
                    <?php echo $__env->make('component.dokumen-pengajuan', ['pengajuanSurat' => $pengajuanSurat], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        <!-- Form Update Status -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Update Status Pengajuan</h5>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.pengajuan-surat.update-status', $pengajuanSurat->id)); ?>" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="updateStatusForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required id="statusSelect">
                                <option value="Menunggu" <?php echo e($pengajuanSurat->status == 'Menunggu' ? 'selected' : ''); ?>>
                                    Menunggu
                                </option>
                                <option value="Diproses" <?php echo e($pengajuanSurat->status == 'Diproses' ? 'selected' : ''); ?>>
                                    Diproses
                                </option>
                                <option value="Selesai" <?php echo e($pengajuanSurat->status == 'Selesai' ? 'selected' : ''); ?>>
                                    Selesai
                                </option>
                                <option value="Ditolak" <?php echo e($pengajuanSurat->status == 'Ditolak' ? 'selected' : ''); ?>>
                                    Ditolak
                                </option>
                            </select>
                            <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted d-block mt-1" id="statusWarning" style="color: #dc3545;">
                                <i class="ti ti-alert-circle"></i> Surat jadi harus diupload sebelum status "Selesai" dapat dipilih
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan untuk Pemohon</label>
                            <textarea name="catatan_admin" class="form-control <?php $__errorArgs = ['catatan_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="4" placeholder="Masukkan catatan atau informasi untuk pemohon..."><?php echo e(old('catatan_admin', $pengajuanSurat->catatan_admin)); ?></textarea>
                            <?php $__errorArgs = ['catatan_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted">Catatan akan dilihat oleh pemohon</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Upload Surat Jadi (PDF)</label>
                            <input type="file" name="file_surat_jadi" 
                                   class="form-control <?php $__errorArgs = ['file_surat_jadi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   accept=".pdf"
                                   id="fileSuratJadi">
                            <?php $__errorArgs = ['file_surat_jadi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted">
                                Upload surat yang sudah jadi (format PDF, max 5MB)
                            </small>
                            <?php if($pengajuanSurat->file_surat_jadi): ?>
                            <div class="mt-2">
                                <small class="text-success">
                                    <i class="ti ti-circle-check"></i> Surat sudah diupload sebelumnya
                                </small>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="ti ti-device-floppy"></i> Update Status
                            </button>
                            <a href="<?php echo e(route('admin.pengajuan-surat.index')); ?>" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Panduan Status</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="badge bg-warning">Menunggu</span>
                            <small class="d-block text-muted">Pengajuan baru masuk</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-info">Diproses</span>
                            <small class="d-block text-muted">Surat sedang dikerjakan</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success">Selesai</span>
                            <small class="d-block text-muted">Surat sudah selesai</small>
                        </li>
                        <li class="mb-0">
                            <span class="badge bg-danger">Ditolak</span>
                            <small class="d-block text-muted">Pengajuan ditolak</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    const fileSuratJadi = document.getElementById('fileSuratJadi');
    const statusWarning = document.getElementById('statusWarning');
    const submitBtn = document.getElementById('submitBtn');
    const updateStatusForm = document.getElementById('updateStatusForm');
    
    // Check if surat jadi exists
    const suratJadiExists = <?php echo e($pengajuanSurat->file_surat_jadi ? 'true' : 'false'); ?>;
    
    // Function to check if status can be set to "Selesai"
    function validateStatus() {
        const selectedStatus = statusSelect.value;
        const hasNewFile = fileSuratJadi.files.length > 0;
        const hasExistingFile = suratJadiExists;
        
        if (selectedStatus === 'Selesai' && !hasNewFile && !hasExistingFile) {
            statusWarning.style.display = 'block';
            submitBtn.disabled = true;
            return false;
        } else {
            statusWarning.style.display = 'none';
            submitBtn.disabled = false;
            return true;
        }
    }
    
    // Listen to status change
    statusSelect.addEventListener('change', validateStatus);
    
    // Listen to file input change
    fileSuratJadi.addEventListener('change', validateStatus);
    
    // Validate on form submit
    updateStatusForm.addEventListener('submit', function(e) {
        if (!validateStatus()) {
            e.preventDefault();
            alert('Surat jadi harus diupload sebelum status dapat diubah menjadi "Selesai"');
        }
    });
    
    // Initial check
    validateStatus();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/admin/pengajuan-surat/show.blade.php ENDPATH**/ ?>