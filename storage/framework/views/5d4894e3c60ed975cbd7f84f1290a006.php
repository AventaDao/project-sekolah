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
    
    // Mapping kolom non-file ke field config
    $textFields = [];
    foreach ($fields as $fieldName => $fieldConfig) {
        if ($fieldConfig['type'] !== 'file') {
            $textFields[$fieldName] = $fieldConfig;
        }
    }
?>

<?php if(!empty($textFields)): ?>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="ti ti-form-checkbox me-2"></i>
            Detail Informasi Pengajuan
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldName => $fieldConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $fieldValue = $pengajuanSurat->{$fieldName};
                    $isTextarea = $fieldConfig['type'] === 'textarea';
                    $isSelect = $fieldConfig['type'] === 'select';
                    $isDate = $fieldConfig['type'] === 'date';
                    $isNumber = $fieldConfig['type'] === 'number';
                ?>
                
                <?php if($fieldValue !== null && $fieldValue !== ''): ?>
                    <div class="col-md-<?php echo e($isTextarea ? '12' : '6'); ?> mb-3">
                        <div class="form-group">
                            <label class="form-label text-muted" style="font-size: 12px;">
                                <?php if($fieldConfig['required']): ?>
                                    <i class="ti ti-circle-filled me-1" style="font-size: 6px; vertical-align: middle;"></i>
                                <?php endif; ?>
                                <?php echo e($fieldConfig['label']); ?>

                            </label>
                            
                            <?php if($isTextarea): ?>
                                <div class="alert alert-light border" style="background-color: #f9f9f9;">
                                    <p class="mb-0" style="white-space: pre-wrap; word-wrap: break-word;">
                                        <?php echo e($fieldValue); ?>

                                    </p>
                                </div>
                            <?php elseif($isDate): ?>
                                <div class="badge bg-light text-dark">
                                    <i class="ti ti-calendar me-1"></i>
                                    <?php echo e(\Carbon\Carbon::parse($fieldValue)->format('d F Y')); ?>

                                </div>
                            <?php elseif($isNumber): ?>
                                <div class="fw-semibold">
                                    <?php if(str_contains(strtolower($fieldConfig['label']), 'luas') || 
                                        str_contains(strtolower($fieldConfig['label']), 'jumlah')): ?>
                                        <?php if(str_contains(strtolower($fieldConfig['label']), 'luas')): ?>
                                            <?php echo e(number_format($fieldValue, 2, ',', '.')); ?> m²
                                        <?php else: ?>
                                            Rp. <?php echo e(number_format($fieldValue, 0, ',', '.')); ?>

                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo e($fieldValue); ?>

                                    <?php endif; ?>
                                </div>
                            <?php else: ?>
                                <div class="fw-semibold">
                                    <?php echo e($fieldValue); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php
            // Check apakah ada field yang terisi
            $hasFilledFields = false;
            foreach ($textFields as $fieldName => $fieldConfig) {
                if ($pengajuanSurat->{$fieldName} !== null && $pengajuanSurat->{$fieldName} !== '') {
                    $hasFilledFields = true;
                    break;
                }
            }
        ?>

        <?php if(!$hasFilledFields): ?>
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                <strong>Tidak ada informasi</strong> yang ditampilkan untuk jenis surat ini.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\Users\User\Documents\Laravel\UKK\appsdesa\resources\views/component/detail-pengajuan.blade.php ENDPATH**/ ?>