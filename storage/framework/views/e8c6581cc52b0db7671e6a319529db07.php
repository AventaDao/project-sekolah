<?php $__env->startSection('title', 'Detail & Tanggapi Pengaduan'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.pengaduan.index')); ?>">Kelola Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Detail Pengaduan -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Pengaduan</h5>
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
                        <span class="badge <?php echo e($pengaduan->status_badge); ?> fs-6 px-3 py-2">
                            <i class="ti ti-circle-check me-1"></i> Status: <?php echo e($pengaduan->status); ?>

                        </span>
                    </div>

                    <!-- Data Pengaduan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengaduan</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%" class="text-muted">Nomor Pengaduan</td>
                            <td width="5%">:</td>
                            <td><strong><?php echo e($pengaduan->nomor_pengaduan); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Pelapor</td>
                            <td>:</td>
                            <td><strong><?php echo e($pengaduan->user->name); ?></strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email Pelapor</td>
                            <td>:</td>
                            <td><?php echo e($pengaduan->user->email); ?></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Kategori</td>
                            <td>:</td>
                            <td>
                                <span class="badge bg-light text-dark">
                                    <i class="ti <?php echo e($pengaduan->kategori_icon); ?> me-1"></i>
                                    <?php echo e($pengaduan->kategori); ?>

                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Pengaduan</td>
                            <td>:</td>
                            <td><?php echo e($pengaduan->created_at->format('d F Y H:i')); ?> WIB</td>
                        </tr>
                        <?php if($pengaduan->tanggal_tanggapan): ?>
                        <tr>
                            <td class="text-muted">Tanggal Tanggapan</td>
                            <td>:</td>
                            <td><?php echo e($pengaduan->tanggal_tanggapan?->format('d F Y H:i')); ?> WIB</td>
                        </tr>
                        <?php endif; ?>
                        <?php if($pengaduan->adminPenanggap): ?>
                        <tr>
                            <td class="text-muted">Ditanggapi Oleh</td>
                            <td>:</td>
                            <td><?php echo e($pengaduan->adminPenanggap->name); ?></td>
                        </tr>
                        <?php endif; ?>
                    </table>

                    <!-- Judul -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Judul Pengaduan</h5>
                    <p class="lead"><?php echo e($pengaduan->judul); ?></p>

                    <!-- Deskripsi -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Deskripsi</h5>
                    <p class="text-muted" style="white-space: pre-line;"><?php echo e($pengaduan->deskripsi); ?></p>

                    <!-- Lampiran -->
                    <?php if($pengaduan->lampiran): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Lampiran</h5>
                    <div class="mb-4">
                        <?php
                            $extension = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                        ?>
                        
                        <?php if(in_array($extension, ['jpg', 'jpeg', 'png'])): ?>
                        <img src="<?php echo e(asset('storage/' . $pengaduan->lampiran)); ?>" 
                             alt="Lampiran" 
                             class="img-fluid rounded mb-2" 
                             style="max-height: 400px;">
                        <?php else: ?>
                        <div class="alert alert-info">
                            <i class="ti ti-file-text f-20 me-2"></i>
                            <strong>File PDF:</strong> <?php echo e(basename($pengaduan->lampiran)); ?>

                        </div>
                        <?php endif; ?>
                        
                        <a href="<?php echo e(route('pengaduan.download-lampiran', $pengaduan->id)); ?>" 
                           class="btn btn-outline-primary btn-sm mt-2">
                            <i class="ti ti-download"></i> Download Lampiran
                        </a>
                    </div>
                    <?php endif; ?>

                    <!-- Tanggapan Admin -->
                    <?php if($pengaduan->tanggapan_admin): ?>
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Tanggapan Admin</h5>
                    <div class="alert alert-info">
                        <i class="ti ti-message-circle me-2"></i>
                        <div style="white-space: pre-line;"><?php echo e($pengaduan->tanggapan_admin); ?></div>
                        <?php if($pengaduan->adminPenanggap): ?>
                        <hr>
                        <small class="text-muted">
                            Ditanggapi oleh: <strong><?php echo e($pengaduan->adminPenanggap->name); ?></strong><br>
                            Tanggal: <?php echo e($pengaduan->tanggal_tanggapan?->format('d F Y H:i')); ?> WIB
                        </small>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Form Tanggapan -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Berikan Tanggapan</h5>
                </div>
                <div class="card-body">
                    <?php
                        // Progressive Status Workflow Logic
                        // Menunggu → Diproses, Ditolak
                        // Diproses → Selesai, Ditolak
                        // Selesai → Final (tidak bisa diubah)
                        // Ditolak → Final (tidak bisa diubah)
                        
                        $currentStatus = $pengaduan->status;
                        $availableStatuses = [];
                        
                        switch($currentStatus) {
                            case 'Menunggu':
                                $availableStatuses = ['Menunggu', 'Diproses', 'Ditolak'];
                                break;
                            case 'Diproses':
                                $availableStatuses = ['Diproses', 'Selesai', 'Ditolak'];
                                break;
                            case 'Selesai':
                            case 'Ditolak':
                                $availableStatuses = [$currentStatus]; // Hanya status saat ini
                                break;
                        }
                        
                        $isFinalStatus = in_array($currentStatus, ['Selesai', 'Ditolak']);
                    ?>

                    <?php if($isFinalStatus): ?>
                        
                        <div class="alert alert-info mb-3">
                            <i class="ti ti-info-circle me-2"></i>
                            <strong>Status Tidak Dapat Diubah</strong><br>
                            <small>Pengaduan dengan status "<?php echo e($currentStatus); ?>" tidak dapat diubah lagi. Status sudah final.</small>
                        </div>
                    <?php else: ?>
                        
                        <div class="alert alert-warning mb-3">
                            <i class="ti ti-alert-triangle me-2"></i>
                            <strong>Perhatian!</strong><br>
                            <small>Status hanya dapat maju ke depan, tidak dapat dikembalikan ke status sebelumnya.</small>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('admin.pengaduan.update-tanggapan', $pengaduan->id)); ?>" 
                          method="POST"
                          id="updateStatusForm">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" 
                                    class="form-select <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    required 
                                    id="statusSelect"
                                    <?php echo e($isFinalStatus ? 'disabled' : ''); ?>>
                                <?php $__currentLoopData = ['Menunggu', 'Diproses', 'Selesai', 'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(in_array($status, $availableStatuses)): ?>
                                        <option value="<?php echo e($status); ?>" <?php echo e($currentStatus == $status ? 'selected' : ''); ?>>
                                            <?php echo e($status); ?>

                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <small class="form-text text-muted">
                                <?php if($currentStatus == 'Menunggu'): ?>
                                    Status dapat diubah ke: <strong>Diproses</strong> atau <strong>Ditolak</strong>
                                <?php elseif($currentStatus == 'Diproses'): ?>
                                    Status dapat diubah ke: <strong>Selesai</strong> atau <strong>Ditolak</strong>
                                <?php else: ?>
                                    Status sudah final dan tidak dapat diubah
                                <?php endif; ?>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggapan untuk Pelapor</label>
                            <textarea name="tanggapan_admin" 
                                      class="form-control <?php $__errorArgs = ['tanggapan_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="6" 
                                      placeholder="Tulis tanggapan atau solusi untuk pengaduan ini..."
                                      <?php echo e($isFinalStatus ? 'disabled' : ''); ?>><?php echo e(old('tanggapan_admin', $pengaduan->tanggapan_admin)); ?></textarea>
                            <?php $__errorArgs = ['tanggapan_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="form-text text-muted">Tanggapan akan dilihat oleh pelapor</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" 
                                    class="btn btn-primary" 
                                    id="submitBtn"
                                    <?php echo e($isFinalStatus ? 'disabled' : ''); ?>>
                                <i class="ti ti-device-floppy"></i> Simpan Tanggapan
                            </button>
                            <a href="<?php echo e(route('admin.pengaduan.index')); ?>" class="btn btn-secondary">
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
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <span class="badge bg-warning">Menunggu</span>
                            <small class="d-block text-muted">Pengaduan baru masuk</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-info">Diproses</span>
                            <small class="d-block text-muted">Sedang ditindaklanjuti</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success">Selesai</span>
                            <small class="d-block text-muted">Pengaduan sudah diselesaikan</small>
                        </li>
                        <li class="mb-0">
                            <span class="badge bg-danger">Ditolak</span>
                            <small class="d-block text-muted">Pengaduan ditolak</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/admin/pengaduan/show.blade.php ENDPATH**/ ?>