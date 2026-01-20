<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Selesai - Sistem Informasi Desa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #2ca87f 0%, #1e8449 100%);
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
        }

        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .icon {
            font-size: 48px;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px 20px;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            color: #333;
        }

        .greeting strong {
            color: #2ca87f;
        }

        .status-box {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            border-left: 4px solid #2ca87f;
            padding: 20px;
            margin-bottom: 25px;
            border-radius: 4px;
            text-align: center;
        }

        .status-icon {
            font-size: 40px;
            margin-bottom: 10px;
        }

        .status-text {
            font-size: 18px;
            color: #1e8449;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .status-subtext {
            font-size: 13px;
            color: #155724;
        }

        .details-section {
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 14px;
            color: #2ca87f;
            text-transform: uppercase;
            font-weight: 700;
            margin-bottom: 12px;
            border-bottom: 2px solid #2ca87f;
            padding-bottom: 8px;
        }

        .detail-item {
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-label {
            color: #999;
            font-weight: 600;
            display: inline-block;
            width: 130px;
        }

        .detail-value {
            color: #555;
            font-weight: 500;
        }

        .cta-button {
            display: inline-block;
            background-color: #2ca87f;
            color: #ffffff !important;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 14px;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }

        .cta-button:hover {
            background-color: #1e8449;
        }

        .button-container {
            text-align: center;
            margin-bottom: 25px;
        }

        .notes-section {
            background-color: #f9f9f9;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .notes-title {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .notes-content {
            font-size: 14px;
            color: #555;
            word-break: break-word;
            line-height: 1.5;
        }

        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #999;
            text-align: center;
        }

        .footer-text {
            margin-bottom: 10px;
        }

        .divider {
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .badge {
            display: inline-block;
            background-color: #2ca87f;
            color: #ffffff;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: 600;
        }

        @media (max-width: 600px) {
            .container {
                border-radius: 0;
            }

            .header {
                padding: 20px 15px;
            }

            .content {
                padding: 20px 15px;
            }

            .detail-label {
                display: block;
                margin-bottom: 3px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="icon">✅</div>
            <h1>Surat Anda Selesai!</h1>
            <p>Sistem Informasi Desa</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Greeting -->
            <div class="greeting">
                Halo <strong><?php echo e($userName); ?></strong>,
            </div>

            <!-- Status Box -->
            <div class="status-box">
                <div class="status-icon">✓</div>
                <div class="status-text">Surat Selesai</div>
                <div class="status-subtext">Surat Anda sudah ditandatangani dan siap diunduh</div>
            </div>

            <!-- Details -->
            <div class="details-section">
                <div class="section-title">Informasi Surat</div>

                <div class="detail-item">
                    <span class="detail-label">Nomor Pengajuan:</span>
                    <span class="detail-value">
                        <span class="badge"><?php echo e($pengajuanSurat->nomor_pengajuan); ?></span>
                    </span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Jenis Surat:</span>
                    <span class="detail-value"><?php echo e($pengajuanSurat->jenis_surat); ?></span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Tanggal Selesai:</span>
                    <span class="detail-value"><?php echo e($pengajuanSurat->tanggal_selesai?->format('d F Y H:i') ?? '-'); ?> WIB</span>
                </div>

                <div class="detail-item">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value" style="color: #2ca87f; font-weight: 600;">✓ Selesai</span>
                </div>
            </div>

            <hr class="divider">

            <!-- Catatan Admin (jika ada) -->
            <?php if($pengajuanSurat->catatan_admin): ?>
            <div class="notes-section">
                <div class="notes-title">📝 Catatan dari Admin</div>
                <div class="notes-content">
                    <?php echo e($pengajuanSurat->catatan_admin); ?>

                </div>
            </div>

            <hr class="divider">
            <?php endif; ?>

            <!-- CTA Button -->
            <div class="button-container">
                <p style="margin-bottom: 15px; font-size: 14px; color: #555;">
                    Silakan klik tombol di bawah untuk melihat dan mengunduh surat Anda:
                </p>
                <a href="<?php echo e(route('pengajuan-surat.show', $pengajuanSurat->id)); ?>" class="cta-button">
                    Lihat & Unduh Surat
                </a>
            </div>

            <!-- Info Text -->
            <p style="font-size: 13px; color: #999; line-height: 1.6; margin-top: 20px;">
                Surat Anda dapat diunduh langsung dari sistem atau melalui link di atas. 
                Surat ini sudah ditandatangani secara digital oleh pejabat yang berwenang dan valid untuk digunakan.
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="footer-text">
                © 2026 Sistem Informasi Desa | Verifikasi Surat Resmi
            </div>
            <div class="footer-text">
                Jika Anda tidak melakukan permintaan ini, abaikan email ini.
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\Users\PC_\Documents\New folder\project-sekolah\resources\views/emails/surat-selesai.blade.php ENDPATH**/ ?>