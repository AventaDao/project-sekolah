<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['pengajuanSurat']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['pengajuanSurat']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Ambil jenis surat dan field yang harus ditampilkan
    $jenisSurat = $pengajuanSurat->jenis_surat;
    $allSuratTypes = \App\Models\PengajuanSurat::getSuratTypes();
    $fields = $allSuratTypes[$jenisSurat]['fields'] ?? [];
    
    // Tentukan prefix route berdasarkan role user
    $isAdmin = Auth::user()->role === 'admin';
    $routePrefix = $isAdmin ? 'admin.pengajuan-surat.' : 'pengajuan-surat.';
    
    // Mapping kolom file ke field config
    $fileFields = [];
    foreach ($fields as $fieldName => $fieldConfig) {
        if ($fieldConfig['type'] === 'file') {
            $fileFields[$fieldName] = $fieldConfig;
        }
    }
?>

<?php if(!empty($fileFields)): ?>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="ti ti-folder-open me-2"></i>
            Dokumen yang Diunggah
        </h5>
    </div>
    <div class="card-body">
        <?php $__empty_1 = true; $__currentLoopData = $fileFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldName => $fieldConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $fileValue = $pengajuanSurat->{$fieldName};
                $isImage = strpos($fieldConfig['accept'], 'image') !== false;
                $isPdf = strpos($fieldConfig['accept'], 'pdf') !== false;
            ?>
            
            <?php if($fileValue): ?>
                <div class="document-preview-item mb-3 p-3 border rounded" style="background-color: #f9f9f9;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <?php if($isImage && !$isPdf): ?>
                                    <i class="ti ti-photo text-primary me-2"></i>
                                <?php elseif($isPdf): ?>
                                    <i class="ti ti-file-pdf text-danger me-2"></i>
                                <?php else: ?>
                                    <i class="ti ti-file me-2"></i>
                                <?php endif; ?>
                                <strong><?php echo e($fieldConfig['label']); ?></strong>
                            </h6>
                            <small class="text-muted d-block" style="word-break: break-all;">
                                📁 <?php echo e(basename($fileValue)); ?>

                            </small>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#previewModal<?php echo e(str_replace('-', '', str_replace('_', '', $fieldName))); ?>">
                                <i class="ti ti-eye me-1"></i> Preview
                            </button>
                            <a href="<?php echo e(route($routePrefix . 'download-file', [$pengajuanSurat->id, $fieldName])); ?>" 
                               class="btn btn-sm btn-outline-info">
                                <i class="ti ti-download me-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal Preview -->
                <div class="modal fade" id="previewModal<?php echo e(str_replace('-', '', str_replace('_', '', $fieldName))); ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?php echo e($fieldConfig['label']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" style="max-height: 650px; overflow-y: auto;">
                                <?php if($isImage && !$isPdf): ?>
                                    <!-- Preview Gambar -->
                                    <div class="text-center">
                                        <img src="<?php echo e(route($routePrefix . 'preview-file', [$pengajuanSurat->id, $fieldName])); ?>" 
                                             alt="<?php echo e($fieldConfig['label']); ?>" 
                                             class="img-fluid rounded"
                                             style="max-width: 100%; max-height: 600px; object-fit: contain;">
                                    </div>
                                <?php elseif($isPdf): ?>
                                    <!-- Preview PDF -->
                                    <div style="position: relative; width: 100%; height: 550px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                                        <iframe src="<?php echo e(route($routePrefix . 'preview-file', [$pengajuanSurat->id, $fieldName])); ?>" 
                                                width="100%" 
                                                height="100%" 
                                                style="border: none;"></iframe>
                                    </div>
                                <?php else: ?>
                                    <!-- Format Lain -->
                                    <div class="alert alert-info">
                                        <i class="ti ti-info-circle me-2"></i>
                                        File ini tidak dapat dipratinjau langsung di browser.
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="modal-footer">
                                <a href="<?php echo e(route($routePrefix . 'download-file', [$pengajuanSurat->id, $fieldName])); ?>" 
                                   class="btn btn-primary">
                                    <i class="ti ti-download me-1"></i> Download
                                </a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- File Tidak Ada -->
                <div class="document-preview-item mb-3 p-3 border rounded" style="background-color: #f0f0f0; opacity: 0.6;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <i class="ti ti-file-x text-muted me-2"></i>
                                <strong><?php echo e($fieldConfig['label']); ?></strong>
                            </h6>
                            <small class="text-muted">
                                <em>Belum diunggah</em>
                            </small>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" disabled>
                            <i class="ti ti-eye me-1"></i> Preview
                        </button>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                <strong>Tidak ada dokumen</strong> untuk jenis surat ini.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<style>
    .document-preview-item {
        transition: all 0.3s ease;
    }
    
    .document-preview-item:hover {
        background-color: #fff !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .btn-group .btn {
        border-radius: 0.375rem;
        margin-right: 2px;
    }
</style>
<?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/component/dokumen-pengajuan.blade.php ENDPATH**/ ?>