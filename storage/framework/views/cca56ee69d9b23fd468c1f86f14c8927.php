<?php $__env->startSection('title', 'Ajukan Surat Baru'); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* ============================================
           STEPPER STYLES - MODERN & RESPONSIVE
           ============================================ */
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #e0e0e0;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #e0e0e0;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            margin-bottom: 6px;
            color: #666;
            font-weight: bold;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .stepper-item.active .step-counter {
            background: linear-gradient(135deg, #4680ff 0%, #3a6fd8 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(70, 128, 255, 0.3);
            transform: scale(1.1);
        }

        .stepper-item.completed .step-counter {
            background: linear-gradient(135deg, #2ca87f 0%, #1e8a5f 100%);
            color: white;
            box-shadow: 0 4px 12px rgba(44, 168, 127, 0.3);
        }

        .stepper-item.completed::after,
        .stepper-item.completed::before {
            border-bottom: 2px solid #2ca87f;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

        .step-name {
            font-size: 12px;
            text-align: center;
            color: #666;
            margin-top: 4px;
            font-weight: 500;
        }

        .stepper-item.active .step-name {
            color: #4680ff;
            font-weight: 600;
        }

        .stepper-item.completed .step-name {
            color: #2ca87f;
            font-weight: 600;
        }

        /* Form Steps */
        .form-step {
            display: none;
            animation: fadeIn 0.3s ease-in;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Step Buttons */
        .step-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            gap: 1rem;
        }

        .btn-nav {
            min-width: 120px;
            font-weight: 600;
            padding: 10px 24px;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
        }

        .btn-nav:active {
            transform: translateY(0);
        }

        /* Step Headers */
        .step-header {
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .step-header h5 {
            color: #4680ff;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .step-header p {
            color: #666;
            font-size: 14px;
            margin-bottom: 0;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .stepper-wrapper {
                margin-bottom: 1.5rem;
            }

            .step-name {
                font-size: 10px;
                max-width: 60px;
            }

            .stepper-item .step-counter {
                width: 36px;
                height: 36px;
                font-size: 13px;
            }

            .stepper-item::before,
            .stepper-item::after {
                top: 18px;
            }

            .step-buttons {
                flex-direction: column-reverse;
            }

            .btn-nav {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .step-name {
                display: none;
            }

            .stepper-item .step-counter {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .stepper-item::before,
            .stepper-item::after {
                top: 16px;
            }
        }

        /* Info Box Styling */
        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid #4680ff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .info-box i {
            color: #4680ff;
        }

        /* Read-only field styling */
        input[readonly],
        textarea[readonly] {
            background-color: #f8f9fa;
            cursor: not-allowed;
        }
    </style>

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
                <div class="card">
                    <div class="card-header">
                        <h5>Form Pengajuan Surat</h5>
                    </div>
                    <div class="card-body">
                        <!-- Stepper -->
                        <div class="stepper-wrapper">
                            <div class="stepper-item">
                                <div class="step-counter">1</div>
                                <div class="step-name">Jenis Surat</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">2</div>
                                <div class="step-name">Data Pemohon</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">3</div>
                                <div class="step-name">Detail Pengajuan</div>
                            </div>
                            <div class="stepper-item">
                                <div class="step-counter">4</div>
                                <div class="step-name">Upload & Review</div>
                            </div>
                        </div>

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

                            <!-- Step 1: Pilih Jenis Surat -->
                            <div class="form-step active" id="step-1">
                                <div class="step-header">
                                    <h5><i class="ti ti-file-text me-2"></i>Pilih Jenis Surat</h5>
                                    <p>Pilih jenis surat yang ingin Anda ajukan</p>
                                </div>

                                <div class="info-box">
                                    <i class="ti ti-info-circle f-20 me-2"></i>
                                    <strong>Informasi:</strong> Setiap jenis surat memiliki persyaratan yang berbeda. Pastikan Anda memilih jenis surat yang sesuai dengan kebutuhan Anda.
                                </div>

                                <div class="row">
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

                                    <!-- Info Jenis Surat yang Dipilih -->
                                    <div class="col-md-12" id="suratInfoContainer" style="display: none;">
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading"><i class="ti ti-info-circle me-2"></i>Informasi Surat</h6>
                                            <p id="suratInfoDeskripsi" class="mb-2"></p>
                                            <hr>
                                            <p class="mb-1"><strong>Field yang Diperlukan:</strong></p>
                                            <ul id="suratInfoFields" class="mb-0"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 2: Data Pemohon -->
                            <div class="form-step" id="step-2">
                                <div class="step-header">
                                    <h5><i class="ti ti-user me-2"></i>Data Pemohon</h5>
                                    <p>Data pribadi Anda (otomatis terisi dari profil)</p>
                                </div>

                                <div class="info-box">
                                    <i class="ti ti-lock f-20 me-2"></i>
                                    <strong>Data Pribadi:</strong> Data di bawah ini diambil dari profil akun Anda dan tidak dapat diubah untuk menjaga keakuratan administratif.
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">NIK <span class="text-danger">*</span></label>
                                        <input type="text" name="nik_display" class="form-control" value="<?php echo e($user->nik ?? '-'); ?>" readonly>
                                        <small class="form-text text-muted">Data dari profil akun Anda</small>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_lengkap_display" class="form-control" value="<?php echo e($user->nama_lengkap ?? '-'); ?>" readonly>
                                        <small class="form-text text-muted">Data dari profil akun Anda</small>
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="text" name="no_telepon_display" class="form-control" value="<?php echo e($user->no_telepon ?? '-'); ?>" readonly>
                                        <small class="form-text text-muted">Data dari profil akun Anda</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Alamat</label>
                                        <textarea name="alamat_display" class="form-control" rows="3" readonly><?php echo e($user->alamat ?? '-'); ?></textarea>
                                        <small class="form-text text-muted">Data dari profil akun Anda</small>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">RT</label>
                                                <input type="text" name="rt_display" class="form-control" value="<?php echo e($user->rt ?? '-'); ?>" readonly>
                                                <small class="form-text text-muted">Data dari profil</small>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">RW</label>
                                                <input type="text" name="rw_display" class="form-control" value="<?php echo e($user->rw ?? '-'); ?>" readonly>
                                                <small class="form-text text-muted">Data dari profil</small>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Kode Pos</label>
                                                <input type="text" name="kode_pos_display" class="form-control" value="<?php echo e($user->kode_pos ?? '-'); ?>" readonly>
                                                <small class="form-text text-muted">Data dari profil</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Step 3: Detail Pengajuan -->
                            <div class="form-step" id="step-3">
                                <div class="step-header">
                                    <h5><i class="ti ti-edit me-2"></i>Detail Pengajuan</h5>
                                    <p>Lengkapi detail keperluan dan data yang diperlukan</p>
                                </div>

                                <div class="row">
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
unset($__errorArgs, $__bag); ?>" rows="4" required placeholder="Jelaskan keperluan pengajuan surat ini..."><?php echo e(old('keperluan')); ?></textarea>
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
unset($__errorArgs, $__bag); ?>" rows="3" placeholder="Masukkan keterangan tambahan jika ada..."><?php echo e(old('keterangan_tambahan')); ?></textarea>
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
                            </div>

                            <!-- Step 4: Upload & Review -->
                            <div class="form-step" id="step-4">
                                <div class="step-header">
                                    <h5><i class="ti ti-upload me-2"></i>Upload Dokumen & Review</h5>
                                    <p>Upload surat pengantar dan review data Anda</p>
                                </div>

                                <div class="row">
                                    <!-- Surat Pengantar dari RW -->
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Surat Pengantar dari RW <span class="text-danger">*</span></label>
                                        <input type="file" name="surat_pengantar_rw" class="form-control <?php $__errorArgs = ['surat_pengantar_rw'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" accept=".pdf,.jpg,.jpeg,.png" required>
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

                                    <!-- Review Summary -->
                                    <div class="col-md-12 mb-3">
                                        <div class="alert alert-info">
                                            <h6 class="alert-heading"><i class="ti ti-checklist me-2"></i>Review Data Pengajuan</h6>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Jenis Surat:</strong></p>
                                                    <p id="reviewJenisSurat" class="text-muted">-</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1"><strong>Nama Pemohon:</strong></p>
                                                    <p class="text-muted"><?php echo e($user->nama_lengkap ?? '-'); ?></p>
                                                </div>
                                                <div class="col-md-12">
                                                    <p class="mb-1"><strong>Keperluan:</strong></p>
                                                    <p id="reviewKeperluan" class="text-muted">-</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Warning Box -->
                                    <div class="col-md-12">
                                        <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                                            <i class="ti ti-alert-triangle f-24 me-3"></i>
                                            <div>
                                                <strong>Catatan:</strong> Pastikan semua data yang Anda masukkan sudah benar. Setelah diajukan, pengajuan akan diproses oleh admin desa.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="step-buttons">
                                <button type="button" class="btn btn-secondary btn-nav" id="prevBtn" style="display: none;">
                                    <i class="ti ti-arrow-left"></i> Sebelumnya
                                </button>
                                <div class="ms-auto d-flex gap-2">
                                    <a href="<?php echo e(route('pengajuan-surat.index')); ?>" class="btn btn-outline-secondary btn-nav">
                                        <i class="ti ti-x"></i> Batal
                                    </a>
                                    <button type="button" class="btn btn-primary btn-nav" id="nextBtn">
                                        Selanjutnya <i class="ti ti-arrow-right"></i>
                                    </button>
                                    <button type="submit" class="btn btn-success btn-nav" id="submitBtn" style="display: none;">
                                        <i class="ti ti-send"></i> Ajukan Surat
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Informasi Jenis Surat (Accordion) -->
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
                                                    <li><?php echo e($field['label']); ?>

                                                        <?php echo $field['required'] ? '<span class="text-danger">*</span>' : ''; ?></li>
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
    <?php
        $userAlamatValue = isset($user) && is_object($user) ? ($user->alamat ?? '') : '';
        $userRtValue = isset($user) && is_object($user) ? ($user->rt ?? '') : '';
        $userRwValue = isset($user) && is_object($user) ? ($user->rw ?? '') : '';
    ?>
    <script>
        const suratTypes = <?php echo json_encode($suratTypes, 15, 512) ?>;
        const oldValues = <?php echo json_encode(old(), 15, 512) ?>;
        const errors = <?php echo json_encode($errors->getMessages(), 15, 512) ?>;
        const userData = {
            alamat: "<?php echo e($userAlamatValue); ?>",
            rt: "<?php echo e($userRtValue); ?>",
            rw: "<?php echo e($userRwValue); ?>"
        };
    </script>

    <script>
        // ============================================
        // STEPPER FUNCTIONALITY
        // ============================================
        document.addEventListener('DOMContentLoaded', function() {
            let currentStep = 1;
            const totalSteps = 4;

            function showStep(step) {
                // Hide all steps
                document.querySelectorAll('.form-step').forEach(el => {
                    el.classList.remove('active');
                });

                // Show current step
                const currentStepEl = document.getElementById('step-' + step);
                if (currentStepEl) {
                    currentStepEl.classList.add('active');
                }

                // Update stepper UI
                document.querySelectorAll('.stepper-item').forEach((item, index) => {
                    item.classList.remove('active', 'completed');
                    if (index + 1 < step) {
                        item.classList.add('completed');
                    } else if (index + 1 === step) {
                        item.classList.add('active');
                    }
                });

                // Update buttons
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const submitBtn = document.getElementById('submitBtn');

                if (prevBtn) prevBtn.style.display = step === 1 ? 'none' : 'block';
                if (nextBtn) nextBtn.style.display = step === totalSteps ? 'none' : 'block';
                if (submitBtn) submitBtn.style.display = step === totalSteps ? 'block' : 'none';

                // Update review data on step 4
                if (step === 4) {
                    updateReviewData();
                }

                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            function validateStep(step) {
                const stepElement = document.getElementById('step-' + step);
                if (!stepElement) return true;

                const requiredInputs = stepElement.querySelectorAll('[required]');
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid');
                        
                        // Remove invalid class on input
                        input.addEventListener('input', function() {
                            this.classList.remove('is-invalid');
                        }, { once: true });
                    }
                });

                if (!isValid) {
                    // Show alert
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-warning alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="ti ti-alert-circle me-2"></i>
                        <strong>Perhatian!</strong> Mohon lengkapi semua field yang wajib diisi (bertanda *).
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    
                    const existingAlert = stepElement.querySelector('.alert-warning');
                    if (existingAlert) {
                        existingAlert.remove();
                    }
                    
                    stepElement.insertBefore(alertDiv, stepElement.firstChild);
                    
                    // Auto dismiss after 5 seconds
                    setTimeout(() => {
                        alertDiv.remove();
                    }, 5000);
                }

                return isValid;
            }

            function updateReviewData() {
                // Update jenis surat
                const jenisSuratSelect = document.getElementById('jenisSurat');
                const reviewJenisSurat = document.getElementById('reviewJenisSurat');
                if (jenisSuratSelect && reviewJenisSurat) {
                    const selectedOption = jenisSuratSelect.options[jenisSuratSelect.selectedIndex];
                    reviewJenisSurat.textContent = selectedOption.text || '-';
                }

                // Update keperluan
                const keperluanTextarea = document.querySelector('textarea[name="keperluan"]');
                const reviewKeperluan = document.getElementById('reviewKeperluan');
                if (keperluanTextarea && reviewKeperluan) {
                    reviewKeperluan.textContent = keperluanTextarea.value || '-';
                }
            }

            // Next button
            const nextBtn = document.getElementById('nextBtn');
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    if (validateStep(currentStep)) {
                        if (currentStep < totalSteps) {
                            currentStep++;
                            showStep(currentStep);
                        }
                    }
                });
            }

            // Previous button
            const prevBtn = document.getElementById('prevBtn');
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            }

            // Initialize first step
            showStep(1);
        });

        // ============================================
        // DYNAMIC FORM FIELDS
        // ============================================
        function updateFormFields() {
            const jenisSurat = document.getElementById('jenisSurat').value;
            const container = document.getElementById('dynamicFieldsContainer');
            const suratDeskripsi = document.getElementById('suratDeskripsi');
            const suratInfoContainer = document.getElementById('suratInfoContainer');
            const suratInfoDeskripsi = document.getElementById('suratInfoDeskripsi');
            const suratInfoFields = document.getElementById('suratInfoFields');

            // Clear container
            container.innerHTML = '';
            suratDeskripsi.textContent = '';
            suratInfoContainer.style.display = 'none';

            if (!jenisSurat) return;

            const suratType = suratTypes[jenisSurat];
            if (!suratType) return;

            // Set deskripsi
            suratDeskripsi.textContent = suratType.deskripsi;
            
            // Show info box
            suratInfoContainer.style.display = 'block';
            suratInfoDeskripsi.textContent = suratType.deskripsi;
            
            // Build fields list
            let fieldsListHTML = '';
            for (const [fieldName, fieldConfig] of Object.entries(suratType.fields)) {
                const requiredMark = fieldConfig.required ? '<span class="text-danger">*</span>' : '';
                fieldsListHTML += `<li>${fieldConfig.label} ${requiredMark}</li>`;
            }
            suratInfoFields.innerHTML = fieldsListHTML;

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

                // Check if field should be auto-filled from user data
                let autoFilledValue = fieldValue;
                let isAutoFilled = false;

                if (fieldConfig.autoFill) {
                    isAutoFilled = true;
                    switch (fieldName) {
                        case 'alamat_domisili':
                            autoFilledValue = userData.alamat;
                            break;
                        case 'rt_domisili':
                            autoFilledValue = userData.rt;
                            break;
                        case 'rw_domisili':
                            autoFilledValue = userData.rw;
                            break;
                    }
                }

                if (fieldConfig.type === 'text') {
                    const readonlyAttr = isAutoFilled ? 'readonly' : '';
                    fieldHTML += `
                        <input type="text" name="${fieldName}" class="form-control ${errorClass}" 
                               value="${autoFilledValue}" ${requiredAttr} ${readonlyAttr}>
                    `;
                    if (isAutoFilled) {
                        fieldHTML += `<small class="form-text text-muted">Data otomatis dari profil Anda</small>`;
                    }
                } else if (fieldConfig.type === 'number') {
                    const maxAttr = fieldConfig.max ? `max="${fieldConfig.max}"` : 'max="9999999999"';
                    const minAttr = fieldConfig.min ? `min="${fieldConfig.min}"` : 'min="0"';
                    fieldHTML += `
                        <input type="number" name="${fieldName}" class="form-control ${errorClass}" 
                               value="${autoFilledValue}" step="${fieldConfig.step || '1'}" ${minAttr} ${maxAttr} ${requiredAttr}>
                        <small class="form-text text-muted">Maksimal nilai: ${fieldConfig.max || '9.999.999.999'}</small>
                    `;
                } else if (fieldConfig.type === 'date') {
                    fieldHTML += `
                        <input type="date" name="${fieldName}" class="form-control ${errorClass}" 
                               value="${autoFilledValue}" ${requiredAttr}>
                    `;
                } else if (fieldConfig.type === 'file') {
                    const acceptAttr = fieldConfig.accept ? `accept="${fieldConfig.accept}"` : '';
                    fieldHTML += `
                        <input type="file" name="${fieldName}" class="form-control ${errorClass}" 
                               ${acceptAttr} ${requiredAttr}>
                        <small class="form-text text-muted">Maksimal ukuran file 5MB</small>
                    `;
                } else if (fieldConfig.type === 'textarea') {
                    const readonlyAttr = isAutoFilled ? 'readonly' : '';
                    fieldHTML += `
                        <textarea name="${fieldName}" class="form-control ${errorClass}" rows="4" ${requiredAttr} ${readonlyAttr}>${autoFilledValue}</textarea>
                    `;
                    if (isAutoFilled) {
                        fieldHTML += `<small class="form-text text-muted">Data otomatis dari profil Anda</small>`;
                    }
                } else if (fieldConfig.type === 'select') {
                    fieldHTML += `
                        <select name="${fieldName}" class="form-select ${errorClass}" ${requiredAttr}>
                            <option value="">-- Pilih --</option>
                    `;

                    fieldConfig.options.forEach(option => {
                        const selected = autoFilledValue === option ? 'selected' : '';
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
        document.addEventListener('DOMContentLoaded', function () {
            const jenisSurat = document.getElementById('jenisSurat').value;
            if (jenisSurat) {
                updateFormFields();
            }
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/user/pengajuan-surat/create.blade.php ENDPATH**/ ?>