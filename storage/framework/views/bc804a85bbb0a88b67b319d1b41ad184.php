<?php $__env->startSection('title', 'Ajukan Surat Baru'); ?>

<?php $__env->startSection('content'); ?>
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo e(route('pengajuan-surat.index')); ?>">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ajukan Surat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Alert Info -->
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="ti ti-info-circle f-24 me-3"></i>
                <div>
                    <strong>Perhatian!</strong> Pastikan Anda telah memiliki <strong>Surat Pengantar dari RW</strong> sebelum mengajukan surat. File yang diupload harus dalam format PDF, JPG, JPEG, atau PNG dengan ukuran maksimal 2MB.
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Form Pengajuan Surat</h5>
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

                    <form action="<?php echo e(route('pengajuan-surat.store')); ?>" method="POST" enctype="multipart/form-data" id="formPengajuanSurat">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Auto-filled User Data Section
                        <div class="row mb-4">
                            <div class="col-12">
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <i class="ti ti-info-circle f-24 me-3"></i>
                                    <div>
                                        <strong>Data Pribadi Anda</strong> telah otomatis terisi berdasarkan profil akun. Data ini tidak dapat diubah untuk memastikan keakuratan administratif.
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            Data Pribadi (Read-only)
                            <div class="col-md-4 mb-3">
                                <label class="form-label">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik_display" class="form-control" 
                                       value="<?php echo e($user->nik ?? '-'); ?>" readonly>
                                <small class="form-text text-muted">Data dari profil akun Anda</small>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama_lengkap_display" class="form-control" 
                                       value="<?php echo e($user->nama_lengkap ?? '-'); ?>" readonly>
                                <small class="form-text text-muted">Data dari profil akun Anda</small>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="text" name="no_telepon_display" class="form-control" 
                                       value="<?php echo e($user->no_telepon ?? '-'); ?>" readonly>
                                <small class="form-text text-muted">Data dari profil akun Anda</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat_display" class="form-control" rows="3" readonly><?php echo e($user->alamat ?? '-'); ?></textarea>
                                <small class="form-text text-muted">Data dari profil akun Anda</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">RT</label>
                                        <input type="text" name="rt_display" class="form-control" 
                                               value="<?php echo e($user->rt ?? '-'); ?>" readonly>
                                        <small class="form-text text-muted">Data dari profil</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">RW</label>
                                        <input type="text" name="rw_display" class="form-control" 
                                               value="<?php echo e($user->rw ?? '-'); ?>" readonly>
                                        <small class="form-text text-muted">Data dari profil</small>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" name="kode_pos_display" class="form-control" 
                                               value="<?php echo e($user->kode_pos ?? '-'); ?>" readonly>
                                        <small class="form-text text-muted">Data dari profil</small>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <hr class="my-4">
                        
                        <div class="row">
                            <!-- Pilih Jenis Surat -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_surat" id="jenisSurat" class="form-select <?php $__errorArgs = ['jenis_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required onchange="updateFormFields()">
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    <?php $__currentLoopData = $suratTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key); ?>" <?php echo e(old('jenis_surat') == $key ? 'selected' : ''); ?>>
                                        <?php echo e($type['label']); ?>

                                    </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['jenis_surat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="form-text text-muted" id="suratDeskripsi"></small>
                            </div>

                            <!-- Keperluan Umum -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keperluan <span class="text-danger">*</span></label>
                                <textarea name="keperluan" class="form-control <?php $__errorArgs = ['keperluan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          rows="4" required placeholder="Jelaskan keperluan pengajuan surat ini..."><?php echo e(old('keperluan')); ?></textarea>
                                <?php $__errorArgs = ['keperluan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="form-text text-muted">Jelaskan secara detail keperluan Anda mengajukan surat ini</small>
                            </div>

                            <!-- Dynamic Fields Container -->
                            <div id="dynamicFieldsContainer" class="col-md-12">
                                <!-- Fields akan di-generate oleh JavaScript -->
                            </div>

                            <!-- Surat Pengantar dari RW -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Surat Pengantar dari RW <span class="text-danger">*</span></label>
                                <input type="file" name="surat_pengantar_rw" 
                                       class="form-control <?php $__errorArgs = ['surat_pengantar_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       accept=".pdf,.jpg,.jpeg,.png" required>
                                <?php $__errorArgs = ['surat_pengantar_rw'];
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
                                    Format: PDF, JPG, JPEG, atau PNG. Maksimal 2MB.
                                </small>
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keterangan Tambahan (Opsional)</label>
                                <textarea name="keterangan_tambahan" class="form-control <?php $__errorArgs = ['keterangan_tambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                          rows="3" placeholder="Masukkan keterangan tambahan jika ada..."><?php echo e(old('keterangan_tambahan')); ?></textarea>
                                <?php $__errorArgs = ['keterangan_tambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <small class="form-text text-muted">Informasi tambahan yang perlu disampaikan (opsional)</small>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                            <i class="ti ti-alert-triangle f-24 me-3"></i>
                            <div>
                                <strong>Catatan:</strong> Pastikan semua data yang Anda masukkan sudah benar. Setelah diajukan, pengajuan akan diproses oleh admin desa.
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send"></i> Ajukan Surat
                            </button>
                            <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informasi Jenis Surat -->
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Jenis Surat</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionJenisSurat">
                        <?php $__currentLoopData = $suratTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat<?php echo e($loop->index); ?>">
                                    <?php echo e($type['label']); ?>

                                </button>
                            </h2>
                            <div id="surat<?php echo e($loop->index); ?>" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    <p><?php echo e($type['deskripsi']); ?></p>
                                    <h6 class="mt-3">Field yang Diperlukan:</h6>
                                    <ul>
                                        <?php $__currentLoopData = $type['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldKey => $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($field['label']); ?> <?php echo e($field['required'] ? '<span class="text-danger">*</span>' : ''); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Embed data untuk JavaScript -->
<script>
    const suratTypes = <?php echo json_encode($suratTypes, 15, 512) ?>;
    const oldValues = <?php echo json_encode(old(), 15, 512) ?>;
    const errors = <?php echo json_encode($errors->getMessages(), 15, 512) ?>;
</script>

<script>
    function updateFormFields() {
        const jenisSurat = document.getElementById('jenisSurat').value;
        const container = document.getElementById('dynamicFieldsContainer');
        const suratDeskripsi = document.getElementById('suratDeskripsi');
        
        // Clear container
        container.innerHTML = '';
        suratDeskripsi.textContent = '';
        
        if (!jenisSurat) return;
        
        const suratType = suratTypes[jenisSurat];
        if (!suratType) return;
        
        // Set deskripsi
        suratDeskripsi.textContent = suratType.deskripsi;
        
        // Generate fields
        const fields = suratType.fields;
        let fieldsHTML = '';
        
        for (const [fieldName, fieldConfig] of Object.entries(fields)) {
            const fieldValue = oldValues[fieldName] || '';
            const hasError = errors[fieldName] ? true : false;
            const errorClass = hasError ? 'is-invalid' : '';
            const requiredStr = fieldConfig.required ? '<span class="text-danger">*</span>' : '';
            const requiredAttr = fieldConfig.required ? 'required' : '';
            
            let fieldHTML = `
                <div class="col-md-12 mb-3">
                    <label class="form-label">${fieldConfig.label} ${requiredStr}</label>
            `;
            
            if (fieldConfig.type === 'text') {
                fieldHTML += `
                    <input type="text" name="${fieldName}" class="form-control ${errorClass}" 
                           value="${fieldValue}" ${requiredAttr}>
                `;
            } else if (fieldConfig.type === 'number') {
                const maxAttr = fieldConfig.max ? `max="${fieldConfig.max}"` : 'max="9999999999"';
                const minAttr = fieldConfig.min ? `min="${fieldConfig.min}"` : 'min="0"';
                fieldHTML += `
                    <input type="number" name="${fieldName}" class="form-control ${errorClass}" 
                           value="${fieldValue}" step="${fieldConfig.step || '1'}" ${minAttr} ${maxAttr} ${requiredAttr}>
                    <small class="form-text text-muted">Maksimal nilai: ${fieldConfig.max || '9.999.999.999'}</small>
                `;
            } else if (fieldConfig.type === 'date') {
                fieldHTML += `
                    <input type="date" name="${fieldName}" class="form-control ${errorClass}" 
                           value="${fieldValue}" ${requiredAttr}>
                `;
            } else if (fieldConfig.type === 'file') {
                const acceptAttr = fieldConfig.accept ? `accept="${fieldConfig.accept}"` : '';
                fieldHTML += `
                    <input type="file" name="${fieldName}" class="form-control ${errorClass}" 
                           ${acceptAttr} ${requiredAttr}>
                    <small class="form-text text-muted">Maksimal ukuran file 5MB</small>
                `;
            } else if (fieldConfig.type === 'textarea') {
                fieldHTML += `
                    <textarea name="${fieldName}" class="form-control ${errorClass}" rows="4" ${requiredAttr}>${fieldValue}</textarea>
                `;
            } else if (fieldConfig.type === 'select') {
                fieldHTML += `
                    <select name="${fieldName}" class="form-select ${errorClass}" ${requiredAttr}>
                        <option value="">-- Pilih --</option>
                `;
                
                fieldConfig.options.forEach(option => {
                    const selected = fieldValue === option ? 'selected' : '';
                    fieldHTML += `<option value="${option}" ${selected}>${option}</option>`;
                });
                
                fieldHTML += `</select>`;
            }
            
            // Add error message
            if (hasError) {
                fieldHTML += `
                    <div class="invalid-feedback" style="display: block;">
                        ${errors[fieldName][0]}
                    </div>
                `;
            }
            
            fieldHTML += `</div>`;
            fieldsHTML += fieldHTML;
        }
        
        container.innerHTML = fieldsHTML;
    }
    
    // Trigger update on page load if there's an old value
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSurat = document.getElementById('jenisSurat').value;
        if (jenisSurat) {
            updateFormFields();
        }
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\LARAVEL12\appdesa\resources\views/user/pengajuan-surat/create.blade.php ENDPATH**/ ?>