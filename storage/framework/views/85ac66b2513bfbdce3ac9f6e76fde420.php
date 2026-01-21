<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($pengajuanSurat->jenis_surat); ?> - <?php echo e($pengajuanSurat->nomor_pengajuan); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/tabler-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    
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

        /* ============================================
           ACTION BAR - RESPONSIVE (NOT IN PDF)
           ============================================ */
        .no-pdf {
            /* This class will be excluded from PDF */
        }

        #actionBar {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            position: sticky;
            top: 10px;
            z-index: 100;
        }

        .action-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .action-title h5 {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .action-title small {
            display: block;
            color: #666;
            font-size: 13px;
            margin-top: 2px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-action i {
            font-size: 16px;
        }

        /* ============================================
           LETTER CONTENT - PDF OPTIMIZED
           ============================================ */
        .letter-wrapper {
            max-width: 900px;
            margin: 0 auto;
        }

        #letterContent {
            background: white;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 8px;
            margin: 0 auto;
            width: 100%;
            max-width: 210mm; /* A4 width */
        }

        /* Letter Header - TABLE BASED (PDF FRIENDLY) */
        .letter-header {
            width: 100%;
            margin-bottom: 20px;
            border-bottom: 3px solid #000;
            padding-bottom: 15px;
        }

        .letter-header table {
            width: 100%;
            border-collapse: collapse;
        }

        .letter-header td {
            vertical-align: middle;
            padding: 0;
        }

        .letter-logo {
            width: 80px;
            text-align: center;
        }

        .letter-logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .letter-header-text {
            text-align: center;
            padding: 0 10px;
        }

        .letter-header-text h3 {
            font-weight: 700;
            margin: 0;
            font-size: 22px;
            color: #000;
            line-height: 1.2;
        }

        .letter-header-text p {
            margin: 4px 0 0 0;
            font-size: 15px;
            color: #333;
            line-height: 1.2;
        }

        .letter-spacer {
            width: 80px;
        }

        /* Letter Title */
        .letter-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .letter-title h2 {
            font-weight: 700;
            margin: 0 0 5px 0;
            font-size: 20px;
            text-decoration: underline;
            color: #000;
        }

        .letter-title p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        /* Letter Body */
        .letter-body {
            margin-bottom: 15px;
            line-height: 1.6;
            font-size: 14px;
            color: #000;
        }

        .letter-body p {
            margin-bottom: 10px;
        }

        /* Data Fields - TABLE BASED (PDF FRIENDLY) */
        .data-section {
            margin-bottom: 20px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table tr {
            vertical-align: top;
        }

        .data-table td {
            padding: 3px 0;
            font-size: 14px;
            line-height: 1.5;
        }

        .data-label {
            width: 180px;
            font-weight: 600;
            color: #000;
            padding-right: 10px;
        }

        .data-separator {
            width: 10px;
            text-align: center;
            color: #000;
        }

        .data-value {
            color: #000;
            word-wrap: break-word;
        }

        /* Signature Section - TABLE BASED */
        .signature-section {
            margin-top: 30px;
            margin-bottom: 0;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0 10px;
        }

        .signature-title {
            margin: 0 0 10px 0;
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }

        .signature-space {
            margin: 0 0 10px 0;
            min-height: 100px;
            display: block;
            text-align: center;
        }

        .signature-space img {
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #999;
            padding: 3px;
            display: inline-block;
        }

        .signature-name {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            color: #000;
        }

        .signature-note {
            margin: 3px 0 0 0;
            font-size: 11px;
            color: #666;
        }

        /* ============================================
           MOBILE RESPONSIVE STYLES
           ============================================ */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            #actionBar {
                padding: 12px;
                position: static;
                margin-bottom: 15px;
            }

            .action-header {
                flex-direction: column;
                align-items: stretch;
            }

            .action-title {
                text-align: center;
                margin-bottom: 10px;
            }

            .action-title h5 {
                font-size: 16px;
            }

            .action-title small {
                font-size: 12px;
            }

            .action-buttons {
                justify-content: center;
            }

            .btn-action {
                flex: 1;
                min-width: 0;
                justify-content: center;
                font-size: 13px;
                padding: 8px 12px;
            }

            .btn-action span {
                display: none;
            }

            .btn-action i {
                margin: 0 !important;
            }

            /* Letter Content Mobile */
            #letterContent {
                padding: 20px 15px;
                border-radius: 6px;
            }

            /* Letter Header Mobile */
            .letter-header table {
                display: block;
            }

            .letter-header tr {
                display: block;
            }

            .letter-header td {
                display: block;
                width: 100% !important;
                text-align: center !important;
                margin-bottom: 10px;
            }

            .letter-logo {
                width: 100%;
            }

            .letter-logo img {
                width: 60px;
                height: 60px;
            }

            .letter-spacer {
                display: none;
            }

            .letter-header-text h3 {
                font-size: 16px;
            }

            .letter-header-text p {
                font-size: 13px;
            }

            /* Letter Title Mobile */
            .letter-title h2 {
                font-size: 16px;
            }

            .letter-title p {
                font-size: 12px;
            }

            /* Letter Body Mobile */
            .letter-body {
                font-size: 13px;
            }

            /* Data Fields Mobile */
            .data-table tr {
                display: block;
                margin-bottom: 12px;
            }

            .data-table td {
                display: block;
                width: 100% !important;
                padding: 2px 0;
            }

            .data-label {
                font-weight: 700;
                color: #4680ff;
                margin-bottom: 3px;
            }

            .data-separator {
                display: none;
            }

            .data-value {
                padding-left: 0;
                color: #333;
            }

            /* Signature Section Mobile */
            .signature-section {
                margin-top: 20px;
            }

            .signature-table {
                display: block;
            }

            .signature-table tr {
                display: block;
            }

            .signature-table td {
                display: block;
                width: 100% !important;
                margin-bottom: 25px;
            }

            .signature-title {
                font-size: 13px;
            }

            .signature-space {
                min-height: 80px;
            }

            .signature-name {
                font-size: 13px;
            }

            .signature-note {
                font-size: 10px;
            }
        }

        /* Extra Small Mobile */
        @media (max-width: 480px) {
            body {
                padding: 5px;
            }

            #letterContent {
                padding: 15px 10px;
            }

            .letter-header-text h3 {
                font-size: 14px;
            }

            .letter-header-text p {
                font-size: 12px;
            }

            .letter-title h2 {
                font-size: 14px;
            }

            .letter-body {
                font-size: 12px;
            }

            .data-table td {
                font-size: 12px;
            }
        }

        /* ============================================
           PRINT STYLES
           ============================================ */
        @media print {
            /* Force color printing for all elements */
            * {
                print-color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            body {
                margin: 0;
                padding: 0;
                background-color: white;
                print-color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
            }

            .no-pdf {
                display: none !important;
            }

            #actionBar {
                display: none !important;
            }

            .letter-wrapper {
                max-width: 100%;
            }

            #letterContent {
                box-shadow: none;
                border-radius: 0;
                width: 100%;
                margin: 0;
                padding: 40px;
                min-height: auto;
                page-break-after: avoid;
            }

            /* Restore desktop layout for print - Override mobile styles */
            .letter-header table,
            .data-table,
            .signature-table {
                display: table !important;
                width: 100% !important;
                border-collapse: collapse !important;
            }

            .letter-header tr,
            .data-table tr,
            .signature-table tr {
                display: table-row !important;
            }

            .letter-header td,
            .data-table td,
            .signature-table td {
                display: table-cell !important;
                width: auto !important;
                margin-bottom: 0 !important;
                padding: 3px 0 !important;
            }

            /* Override: data tables and signature cells should be left-aligned */
            .data-table td,
            .signature-table td {
                text-align: left !important;
            }

            /* Specific fixes for letter header */
            .letter-logo {
                width: 80px !important;
                text-align: center !important;
            }

            .letter-header-text {
                text-align: center !important;
            }

            .letter-spacer {
                width: 80px !important;
                display: table-cell !important;
            }

            /* Force images to display in FULL COLOR */
            img {
                display: block !important;
                print-color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                filter: none !important;
                opacity: 1 !important;
            }

            .letter-logo img {
                width: 70px !important;
                height: 70px !important;
                display: block !important;
                margin: 0 auto !important;
                print-color-adjust: exact !important;
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
                filter: none !important;
            }

            /* Data table specific fixes */
            .data-label {
                width: 180px !important;
                font-weight: 600 !important;
                color: #000 !important;
                padding-right: 10px !important;
            }

            .data-separator {
                width: 10px !important;
                text-align: center !important;
                color: #000 !important;
                display: table-cell !important;
            }

            .data-value {
                color: #000 !important;
                padding-left: 0 !important;
            }

            /* Signature table specific fixes */
            .signature-table td {
                width: 50% !important;
                text-align: center !important;
                vertical-align: top !important;
                padding: 0 10px !important;
            }
        }

        @page {
            size: A4;
            margin: 0;
        }

        /* Loading Indicator */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-overlay.active {
            display: flex;
        }

        .loading-content {
            background: white;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
        }

        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #4680ff;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay no-pdf" id="loadingOverlay">
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <p style="margin: 0; font-weight: 600; color: #333;">Mengunduh PDF...</p>
            <small style="color: #666;">Mohon tunggu sebentar</small>
        </div>
    </div>

    <div class="pc-content">
        <!-- Action Buttons (NOT IN PDF) -->
        <div id="actionBar" class="no-pdf">
            <div class="action-header">
                <div class="action-title">
                    <h5><?php echo e($pengajuanSurat->jenis_surat); ?></h5>
                    <small><?php echo e($pengajuanSurat->nomor_pengajuan); ?></small>
                </div>
                <div class="action-buttons">
                    <button class="btn btn-danger btn-action" onclick="downloadPDF()">
                        <i class="ti ti-download"></i>
                        <span>Download PDF</span>
                    </button>
                    <button class="btn btn-primary btn-action" onclick="printPDF()">
                        <i class="ti ti-printer"></i>
                        <span>Cetak</span>
                    </button>
                    <a href="<?php echo e(route('pengajuan-surat.show', $pengajuanSurat->id)); ?>" class="btn btn-secondary btn-action">
                        <i class="ti ti-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Letter Content (ONLY THIS IN PDF) -->
        <div class="letter-wrapper">
            <div id="letterContent">
                <!-- Letter Header with Icon -->
                <div class="letter-header">
                    <table>
                        <tr>
                            <td class="letter-logo">
                                <img src="<?php echo e(asset('assets/images/my/icon-sda.png')); ?>" alt="Logo Sidoarjo" crossorigin="anonymous">
                            </td>
                            <td class="letter-header-text">
                                <h3>PEMERINTAH DESA KEDUNGKENDO</h3>
                                <p>Kecamatan Candi Kabupaten Sidoarjo</p>
                            </td>
                            <td class="letter-spacer"></td>
                        </tr>
                    </table>
                </div>

                <!-- Letter Title -->
                <div class="letter-title">
                    <h2><?php echo e($pengajuanSurat->jenis_surat); ?></h2>
                    <p>No. <?php echo e($pengajuanSurat->nomor_pengajuan); ?></p>
                </div>

                <!-- Letter Body -->
                <div class="letter-body">
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
                        $isSuratKematian = str_contains(strtolower($jenisSurat), 'kematian');
                    ?>

                    <?php if($isSuratKematian): ?>
                        
                        <p>Yang bertanda tangan di bawah ini Kepala Desa Kedung Kendo menerangkan sesungguhnya bahwa:</p>

                        <div class="data-section">
                            <table class="data-table">
                                
                                <tr>
                                    <td class="data-label">Nama</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Tempat / Tanggal Lahir</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->tempat_lahir ?? '-'); ?>, <?php echo e($pengajuanSurat->user->tanggal_lahir ? \Carbon\Carbon::parse($pengajuanSurat->user->tanggal_lahir)->format('d F Y') : '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Jenis Kelamin</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->jenis_kelamin ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Kewarganegaraan</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value">Indonesia</td>
                                </tr>
                                <tr>
                                    <td class="data-label">Agama</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->agama ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Status Perkawinan</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->status_perkawinan ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Pekerjaan</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->pekerjaan ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Alamat</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->alamat ?? '-'); ?> RT <?php echo e($pengajuanSurat->user->rt ?? '-'); ?> RW <?php echo e($pengajuanSurat->user->rw ?? '-'); ?></td>
                                </tr>

                                
                                <tr>
                                    <td colspan="3" style="height: 12px;"></td>
                                </tr>

                                
                                <tr>
                                    <td class="data-label">Memberitahukan bahwa Telah Meninggal</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"></td>
                                </tr>

                                
                                <?php if($hasFilledFields): ?>
                                    <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldName => $fieldConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $fieldValue = $pengajuanSurat->{$fieldName};
                                            $isDate = $fieldConfig['type'] === 'date';
                                        ?>

                                        <?php if($fieldValue !== null && $fieldValue !== ''): ?>
                                            <tr>
                                                <td class="data-label" style="padding-left: 30px;"><?php echo e($fieldConfig['label']); ?></td>
                                                <td class="data-separator">:</td>
                                                <td class="data-value">
                                                    <?php if($isDate): ?>
                                                        <?php echo e(\Carbon\Carbon::parse($fieldValue)->format('d F Y')); ?>

                                                    <?php else: ?>
                                                        <?php echo e($fieldValue); ?>

                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </table>
                        </div>

                        <p style="margin-top: 15px;">Demikian surat keterangan ini kami buat sebenar-benarnya agar digunakan seperlunya.</p>
                    <?php else: ?>
                        
                        <p>Dengan ini kami beritahukan bahwa:</p>

                        <!-- Unified Data Table - All fields in one table for consistent alignment -->
                        <div class="data-section">
                            <table class="data-table">
                                
                                <tr>
                                    <td class="data-label">Nama</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">NIK</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->nik ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Tempat, Tgl Lahir</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->tempat_lahir ?? '-'); ?>, <?php echo e($pengajuanSurat->user->tanggal_lahir ? \Carbon\Carbon::parse($pengajuanSurat->user->tanggal_lahir)->format('d F Y') : '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">Alamat</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->alamat ?? '-'); ?> RT <?php echo e($pengajuanSurat->user->rt ?? '-'); ?> RW <?php echo e($pengajuanSurat->user->rw ?? '-'); ?></td>
                                </tr>
                                <tr>
                                    <td class="data-label">No. Telepon</td>
                                    <td class="data-separator">:</td>
                                    <td class="data-value"><?php echo e($pengajuanSurat->user->no_telepon ?? '-'); ?></td>
                                </tr>

                                <?php if($hasFilledFields || $pengajuanSurat->keperluan): ?>
                                    
                                    <tr>
                                        <td colspan="3" style="height: 12px;"></td>
                                    </tr>

                                    
                                    <?php if($hasFilledFields): ?>
                                        <?php $__currentLoopData = $textFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fieldName => $fieldConfig): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $fieldValue = $pengajuanSurat->{$fieldName};
                                                $isTextarea = $fieldConfig['type'] === 'textarea';
                                                $isSelect = $fieldConfig['type'] === 'select';
                                                $isDate = $fieldConfig['type'] === 'date';
                                                $isNumber = $fieldConfig['type'] === 'number';
                                            ?>

                                            <?php if($fieldValue !== null && $fieldValue !== ''): ?>
                                                <tr>
                                                    <td class="data-label"><?php echo e($fieldConfig['label']); ?></td>
                                                    <td class="data-separator">:</td>
                                                    <td class="data-value">
                                                        <?php if($isTextarea): ?>
                                                            <?php echo e($fieldValue); ?>

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
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>

                                    
                                    <?php if($pengajuanSurat->keperluan): ?>
                                        <?php if($hasFilledFields): ?>
                                            <tr>
                                                <td colspan="3" style="height: 8px;"></td>
                                            </tr>
                                        <?php endif; ?>
                                        <tr>
                                            <td class="data-label">Keperluan</td>
                                            <td class="data-separator">:</td>
                                            <td class="data-value"><?php echo e($pengajuanSurat->keperluan); ?></td>
                                        </tr>
                                        <?php if($pengajuanSurat->keterangan_tambahan): ?>
                                            <tr>
                                                <td class="data-label">Keterangan</td>
                                                <td class="data-separator">:</td>
                                                <td class="data-value"><?php echo e($pengajuanSurat->keterangan_tambahan); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </table>
                        </div>

                        <p style="margin-top: 15px;">Dengan penuh tanggung jawab, kami nyatakan bahwa data tersebut di atas adalah benar adanya.</p>
                    <?php endif; ?>
                </div>

                <!-- Signature Section -->
                <div class="signature-section">
                    <table class="signature-table">
                        <tr>
                            <td>
                                <p class="signature-title">Pemohon</p>
                                <div class="signature-space"></div>
                                <p class="signature-name"><?php echo e($pengajuanSurat->user->nama_lengkap ?? '-'); ?></p>
                            </td>
                            <td>
                                <p class="signature-title">Mengetahui</p>
                                <div class="signature-space">
                                    <?php if($qrCodeUrl): ?>
                                        <img src="<?php echo e($qrCodeUrl); ?>" alt="QR Code Verifikasi" crossorigin="anonymous">
                                    <?php endif; ?>
                                </div>
                                <p class="signature-name">Kepala Desa Kedung Kendo</p>
                                <p class="signature-note">(Scan untuk verifikasi)</p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-download jika parameter autoDownload=true
        const urlParams = new URLSearchParams(window.location.search);
        const autoDownload = urlParams.get('autoDownload');

        function downloadPDF() {
            // Show loading overlay
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');

            const element = document.getElementById('letterContent');
            
            // Clone element to avoid modifying original
            const clonedElement = element.cloneNode(true);
            
            const opt = {
                margin: [10, 10, 10, 10],
                filename: '<?php echo e($pengajuanSurat->nomor_pengajuan); ?>.pdf',
                image: { 
                    type: 'jpeg', 
                    quality: 0.98 
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    allowTaint: false,
                    logging: false,
                    letterRendering: true,
                    scrollY: 0,
                    scrollX: 0
                },
                jsPDF: { 
                    unit: 'mm', 
                    format: 'a4', 
                    orientation: 'portrait',
                    compress: true
                },
                pagebreak: { 
                    mode: ['avoid-all', 'css', 'legacy'] 
                }
            };

            html2pdf().set(opt).from(clonedElement).save().then(() => {
                // Hide loading overlay after download
                setTimeout(() => {
                    loadingOverlay.classList.remove('active');
                }, 500);
            }).catch((error) => {
                console.error('PDF generation error:', error);
                loadingOverlay.classList.remove('active');
                alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
            });
        }

        function printPDF() {
            // Show loading overlay
            const loadingOverlay = document.getElementById('loadingOverlay');
            loadingOverlay.classList.add('active');
            loadingOverlay.querySelector('p').textContent = 'Mempersiapkan Cetak...';

            const element = document.getElementById('letterContent');
            
            // Clone element to avoid modifying original
            const clonedElement = element.cloneNode(true);
            
            const opt = {
                margin: [10, 10, 10, 10],
                filename: '<?php echo e($pengajuanSurat->nomor_pengajuan); ?>.pdf',
                image: { 
                    type: 'jpeg', 
                    quality: 0.98 
                },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    allowTaint: false,
                    logging: false,
                    letterRendering: true,
                    scrollY: 0,
                    scrollX: 0
                },
                jsPDF: { 
                    unit: 'mm', 
                    format: 'a4', 
                    orientation: 'portrait',
                    compress: true
                },
                pagebreak: { 
                    mode: ['avoid-all', 'css', 'legacy'] 
                }
            };

            // Generate PDF and get the blob for printing
            html2pdf().set(opt).from(clonedElement).toPdf().get('pdf').then(function(pdf) {
                // Convert to blob and create URL
                const blob = pdf.output('blob');
                const url = URL.createObjectURL(blob);
                
                // Open in new window and trigger print
                const printWindow = window.open(url, '_blank');
                
                if (printWindow) {
                    printWindow.onload = function() {
                        printWindow.print();
                        // Clean up after printing
                        setTimeout(() => {
                            URL.revokeObjectURL(url);
                        }, 1000);
                    };
                } else {
                    alert('Mohon izinkan popup untuk mencetak dokumen.');
                    URL.revokeObjectURL(url);
                }
                
                // Hide loading overlay
                setTimeout(() => {
                    loadingOverlay.classList.remove('active');
                    loadingOverlay.querySelector('p').textContent = 'Mengunduh PDF...';
                }, 500);
            }).catch((error) => {
                console.error('PDF generation error:', error);
                loadingOverlay.classList.remove('active');
                loadingOverlay.querySelector('p').textContent = 'Mengunduh PDF...';
                alert('Terjadi kesalahan saat membuat PDF. Silakan coba lagi.');
            });
        }

        // Auto-download on page load jika parameter autoDownload=true
        if (autoDownload === 'true') {
            window.addEventListener('load', function () {
                setTimeout(downloadPDF, 500);
                // Redirect back after 3 seconds
                setTimeout(function () {
                    window.location.href = '<?php echo e(route('pengajuan-surat.index')); ?>';
                }, 3000);
            });
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html><?php /**PATH C:\project-sekolah\resources\views/user/pengajuan-surat/pdf-preview.blade.php ENDPATH**/ ?>