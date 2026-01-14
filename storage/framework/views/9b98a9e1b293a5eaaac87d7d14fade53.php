<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pengajuanSurat->jenis_surat); ?> - <?php echo e($pengajuanSurat->nomor_pengajuan); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/tabler-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</head>
<body>
<div class="pc-content">
    <!-- Action Buttons -->
    <div class="page-header" id="actionBar">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h5 class="mb-0"><?php echo e($pengajuanSurat->jenis_surat); ?></h5>
                            <small class="text-muted"><?php echo e($pengajuanSurat->nomor_pengajuan); ?></small>
                        </div>
                        <div>
                            <button class="btn btn-danger btn-sm me-2" onclick="downloadPDF()">
                                <i class="ti ti-download me-1"></i> Download PDF
                            </button>
                            <button class="btn btn-primary btn-sm me-2" onclick="window.print()">
                                <i class="ti ti-printer me-1"></i> Cetak
                            </button>
                            <a href="<?php echo e(route('pengajuan-surat.show', $pengajuanSurat->id)); ?>" class="btn btn-secondary btn-sm">
                                <i class="ti ti-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Letter Content -->
    <div class="row mt-4">
        <div class="col-lg-8 offset-lg-2">
            <div id="letterContent" style="background: white; padding: 30px 35px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                
                <!-- Letter Header with Icon -->
                <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 15px; border-bottom: 2px solid #333; padding-bottom: 12px;">
                    <!-- Icon -->
                    <div style="flex-shrink: 0; margin-right: 15px;">
                        <img src="<?php echo e(asset('assets/images/my/icon-sda.png')); ?>" alt="Logo Sidoarjo" style="width: 70px; height: 70px; object-fit: contain;" crossorigin="anonymous">
                    </div>
                    <!-- Text -->
                    <div style="text-align: center; flex-grow: 1;">
                        <h3 style="font-weight: 700; margin: 0; font-size: 23px;">PEMERINTAH DESA KEDUNGKENDO</h3>
                        <p style="margin: 2px 0; font-size: 17px;">Kecamatan Candi Kabupaten Sidoarjo</p>
                    </div>
                    <!-- Spacer untuk balance -->
                    <div style="flex-shrink: 0; width: 70px; margin-left: 15px;"></div>
                </div>

                <!-- Letter Title -->
                <div style="text-align: center; margin-bottom: 15px;">
                    <h2 style="font-weight: 700; margin: 0 0 3px 0; font-size: 23px; text-decoration: underline;"><?php echo e($pengajuanSurat->jenis_surat); ?></h2>
                    <p style="margin: 0; font-size: 16px;">No. <?php echo e($pengajuanSurat->nomor_pengajuan); ?></p>
                </div>

                <!-- Letter Body -->
                <div style="margin-bottom: 12px; line-height: 1.5; font-size: 16px;">
                    <p style="margin-bottom: 8px;">Dengan ini kami beritahukan bahwa:</p>

                    <!-- Data Pemohon -->
                    <div style="margin-bottom: 18px; font-size: 16px;">
                        <div style="margin-bottom: 3px; line-height: 1.3;">
                            <span style="font-weight: bold; display: inline-block; width: 130px;">Nama</span>: <?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?>

                        </div>
                        <div style="margin-bottom: 3px; line-height: 1.3;">
                            <span style="font-weight: bold; display: inline-block; width: 130px;">NIK</span>: <?php echo e($pengajuanSurat->user->nik ?? '-'); ?>

                        </div>
                        <div style="margin-bottom: 3px; line-height: 1.3;">
                            <span style="font-weight: bold; display: inline-block; width: 130px;">Tempat, Tgl Lahir</span>: <?php echo e($pengajuanSurat->user->tempat_lahir ?? '-'); ?>, <?php echo e($pengajuanSurat->user->tanggal_lahir ? \Carbon\Carbon::parse($pengajuanSurat->user->tanggal_lahir)->format('d F Y') : '-'); ?>

                        </div>
                        <div style="margin-bottom: 3px; line-height: 1.3;">
                            <span style="font-weight: bold; display: inline-block; width: 130px;">Alamat</span>: <?php echo e($pengajuanSurat->user->alamat ?? '-'); ?> RT <?php echo e($pengajuanSurat->user->rt ?? '-'); ?> RW <?php echo e($pengajuanSurat->user->rw ?? '-'); ?>

                        </div>
                        <div style="margin-bottom: 3px; line-height: 1.3;">
                            <span style="font-weight: bold; display: inline-block; width: 130px;">No. Telepon</span>: <?php echo e($pengajuanSurat->user->no_telepon ?? '-'); ?>

                        </div>
                    </div>

                    <p style="margin-bottom: 14px;">Dengan penuh tanggung jawab, kami nyatakan bahwa data tersebut di atas adalah benar adanya.</p>

                    <!-- Dynamic Fields Section -->
                    <?php
                        $jenisSurat = $pengajuanSurat->jenis_surat;
                        $allSuratTypes = \App\Models\PengajuanSurat::getSuratTypes();
                        $fields = $allSuratTypes[$jenisSurat]['fields'] ?? [];
                        $textFields = [];
                        foreach ($fields as $fieldName => $fieldConfig) {
                            if ($fieldConfig['type'] !== 'file') {
                                $textFields[$fieldName] = $fieldConfig;
                            }
                        }
                    ?>

                    <?php
                        $hasFilledFields = false;
                        foreach ($textFields as $fieldName => $fieldConfig) {
                            if ($pengajuanSurat->{$fieldName} !== null && $pengajuanSurat->{$fieldName} !== '') {
                                $hasFilledFields = true;
                                break;
                            }
                        }
                    ?>

                    <?php if($hasFilledFields): ?>
                        <p style="margin-bottom: 14px; font-weight: 500; font-size: 16px;">Keterangan Pengajuan:</p>
                        <div style="margin-bottom: 12px;">
                            <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldName => $fieldConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $fieldValue = $pengajuanSurat->{$fieldName};
                                    $isTextarea = $fieldConfig['type'] === 'textarea';
                                    $isSelect = $fieldConfig['type'] === 'select';
                                    $isDate = $fieldConfig['type'] === 'date';
                                    $isNumber = $fieldConfig['type'] === 'number';
                                ?>
                                
                                <?php if($fieldValue !== null && $fieldValue !== ''): ?>
                                    <div style="margin-bottom: 3px; line-height: 1.3; font-size: 16px;">
                                        <span style="font-weight: bold; display: inline-block; width: 130px;"><?php echo e($fieldConfig['label']); ?></span>: 
                                        <?php if($isTextarea): ?>
                                            <span style="white-space: pre-wrap; word-wrap: break-word;"><?php echo e($fieldValue); ?></span>
                                        <?php elseif($isDate): ?>
                                            <?php echo e(\Carbon\Carbon::parse($fieldValue)->format('d F Y')); ?>

                                        <?php elseif($isNumber): ?>
                                            <?php if(str_contains(strtolower($fieldConfig['label']), 'luas')): ?>
                                                <?php echo e(number_format($fieldValue, 2, ',', '.')); ?> m²
                                            <?php elseif(str_contains(strtolower($fieldConfig['label']), 'harga|nominal|jumlah')): ?>
                                                Rp. <?php echo e(number_format($fieldValue, 0, ',', '.')); ?>

                                            <?php else: ?>
                                                <?php echo e($fieldValue); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e($fieldValue); ?>

                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if($pengajuanSurat->keperluan): ?>
                        <div style="margin-bottom: 12px; font-size: 16px;">
                            <div style="margin-bottom: 3px; line-height: 1.3;">
                                <span style="font-weight: bold; display: inline-block; width: 130px;">Keperluan</span>: <?php echo e($pengajuanSurat->keperluan); ?>

                            </div>
                            <?php if($pengajuanSurat->keterangan_tambahan): ?>
                            <div style="margin-bottom: 3px; line-height: 1.3;">
                                <span style="font-weight: bold; display: inline-block; width: 130px;">Keterangan</span>: <?php echo e($pengajuanSurat->keterangan_tambahan); ?>

                            </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Signature Section -->
                <div style="margin-top: 15px; margin-bottom: 0;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="width: 49%; text-align: center;">
                            <p style="margin: 0 0 10px 0; font-size: 16px;">Pemohon</p>
                            <div style="margin: 0 0 8px 0; min-height: 120px; display: flex; align-items: flex-end; justify-content: center;">
                            </div>
                            <p style="margin: 0; font-size: 16px; font-weight: 500;"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></p>
                        </div>
                        <div style="width: 49%; text-align: center;">
                            <p style="margin: 0 0 10px 0; font-size: 16px;">Mengetahui</p>
                            <div style="margin: 0 0 8px 0; min-height: 120px; display: flex; align-items: center; justify-content: center;">
                                <?php if($qrCodeUrl): ?>
                                    <img src="<?php echo e($qrCodeUrl); ?>" alt="QR Code Verifikasi" style="width: 100px; height: 100px; border: 1px solid #999; padding: 2px;" crossorigin="anonymous">
                                <?php endif; ?>
                            </div>
                            <p style="margin: 0; font-size: 16px; font-weight: 500;">Kepala Desa Kedung Kendo</p>
                            <p style="margin: 2px 0 0 0; font-size: 13px; color: #999;">(Scan untuk verifikasi)</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <!-- <div style="text-align: center; padding-top: 20px; border-top: 1px solid #ddd; margin-top: 30px; font-size: 11px; color: #999;">
                    <p style="margin: 5px 0;">Dokumen ini dicetak dari Sistem Informasi Desa Kedung Kendo</p>
                    <p style="margin: 5px 0;">Tanggal: <?php echo e(now()->format('d F Y')); ?> | Nomor: <?php echo e($pengajuanSurat->nomor_pengajuan); ?></p>
                </div> -->
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f5f5f5;
        padding: 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    @media print {
        body {
            margin: 0;
            padding: 0;
            background-color: white;
        }

        #actionBar {
            display: none;
        }

        #letterContent {
            box-shadow: none;
            width: 100%;
            margin: 0;
            padding: 40px;
            min-height: auto;
            page-break-after: avoid;
        }

        .row {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .col-lg-8,
        .offset-lg-2 {
            width: 100% !important;
            margin-left: 0 !important;
        }
    }

    @page {
        size: A4;
        margin: 0;
    }
</style>

<script>
    function downloadPDF() {
        const element = document.getElementById('letterContent');
        const opt = {
            margin: 5,
            filename: '<?php echo e($pengajuanSurat->nomor_pengajuan); ?>.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { 
                scale: 2,
                useCORS: true,
                allowTaint: true,
                logging: false
            },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/user/pengajuan-surat/pdf-preview.blade.php ENDPATH**/ ?>