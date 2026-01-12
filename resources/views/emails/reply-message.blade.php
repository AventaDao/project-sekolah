<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan Pesan - Sistem Informasi Desa</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

        .content {
            padding: 30px 20px;
        }

        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            color: #333;
        }

        .greeting strong {
            color: #667eea;
        }

        .message-info {
            background-color: #f9f9f9;
            border-left: 4px solid #667eea;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }

        .message-info-title {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .message-info-content {
            font-size: 14px;
            color: #555;
            word-break: break-word;
        }

        .support-id {
            display: inline-block;
            background-color: #667eea;
            color: #ffffff;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .original-message {
            background-color: #f0f0f0;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            border-left: 4px solid #999;
        }

        .original-message-title {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .original-message-content {
            font-size: 13px;
            color: #555;
            line-height: 1.6;
            word-break: break-word;
            white-space: pre-wrap;
        }

        .reply-section {
            background-color: #f9fafb;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .reply-title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 12px;
        }

        .reply-content {
            font-size: 14px;
            color: #555;
            line-height: 1.8;
            word-break: break-word;
            white-space: pre-wrap;
        }

        .divider {
            border-top: 1px solid #e0e0e0;
            margin: 20px 0;
        }

        .footer {
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
            font-size: 12px;
            color: #999;
        }

        .footer-link {
            color: #667eea;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer-link:hover {
            text-decoration: underline;
        }

        .button-group {
            text-align: center;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #667eea;
            color: #ffffff;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
            margin: 5px;
        }

        .button:hover {
            background-color: #5568d3;
            text-decoration: none;
        }

        .status-badge {
            display: inline-block;
            background-color: #4caf50;
            color: #ffffff;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-left: 10px;
        }

        .note {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 12px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 12px;
            color: #856404;
        }

        @media (max-width: 600px) {
            .container {
                border-radius: 0;
            }

            .header {
                padding: 20px 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content {
                padding: 20px 15px;
            }

            .button {
                display: block;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Balasan Pesan Anda</h1>
            <p>Sistem Informasi Desa Kedung Kendo</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Support ID -->
            <div style="margin-bottom: 20px;">
                <span class="support-id">{{ $supportId }}</span>
                <span class="status-badge">Sudah Dibalas</span>
            </div>

            <!-- Greeting -->
            <div class="greeting">
                Halo <strong>{{ $messageName }}</strong>,
                <br><br>
                Kami telah menerima pesan Anda dan telah membalas pertanyaan atau masalah yang Anda sampaikan. Silakan baca balasan kami di bawah ini.
            </div>

            <!-- Original Message Info -->
            <div class="message-info">
                <div class="message-info-title">Pesan Anda</div>
                <div class="message-info-content">
                    <strong>Subjek:</strong> {{ $messageSubject }}<br>
                    <strong>Tanggal:</strong> {{ $messageCreatedAt->format('d F Y H:i') }} WIB
                </div>
            </div>

            <!-- Original Message -->
            <div class="original-message">
                <div class="original-message-title">Isi Pesan Asli Anda</div>
                <div class="original-message-content">{{ $messageBody }}</div>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Reply Section -->
            <div class="reply-section">
                <div class="reply-title">Balasan Admin</div>
                <div class="reply-content">{{ $reply }}</div>
            </div>

            <!-- Note -->
            <div class="note">
                <strong>💡 Informasi Penting:</strong> Jika Anda memiliki pertanyaan lebih lanjut, silakan hubungi kami melalui halaman kontak atau balas email ini.
            </div>

            <!-- Button -->
            <!-- <div class="button-group">
                <a href="{{ route('home') }}" class="button">Kembali ke Beranda</a>
            </div> -->
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>
                © 2026 Sistem Informasi Desa Kedung Kendo. Semua Hak Dilindungi.
                <br><br>
                Email ini dibuat otomatis. Mohon tidak membalas email ini. Gunakan halaman kontak untuk menghubungi kami.
                <br><br>
                <a href="{{ route('contact') }}" class="footer-link">Hubungi Kami</a> | 
                <a href="{{ route('home') }}" class="footer-link">Beranda</a>
            </p>
        </div>
    </div>
</body>
</html>
