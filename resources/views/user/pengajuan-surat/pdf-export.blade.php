<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengajuan Surat</title>
    <style>
        @page {
            size: A4;
            margin: 10mm 10mm 10mm 10mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        
        body {
            font-family: 'Calibri', Arial, sans-serif;
            color: #000;
            font-size: 11px;
            line-height: 1.3;
            background: white;
        }
        
        .container {
            width: 100%;
            padding: 0;
            height: 100%;
        }
        
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 10px;
        }
        
        .header h1 {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        
        .header p {
            font-size: 10px;
            margin: 1px 0 0 0;
            color: #000;
        }
        
        .section {
            margin-bottom: 8px;
        }
        
        .section-title {
            font-weight: bold;
            font-size: 11px;
            background-color: #e8e8e8;
            padding: 3px 5px;
            margin-bottom: 5px;
            border-left: 3px solid #000;
        }
        
        .row {
            display: flex;
            margin-bottom: 3px;
            page-break-inside: avoid;
        }
        
        .col-label {
            width: 28%;
            font-weight: bold;
            color: #000;
            word-wrap: break-word;
            font-size: 10px;
        }
        
        .col-value {
            width: 72%;
            color: #000;
            padding-left: 3px;
            word-wrap: break-word;
            font-size: 10px;
        }
        
        .col-value:before {
            content: ": ";
        }
        
        .badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 2px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .badge-warning {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .badge-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        
        .separator {
            border-top: 1px solid #999;
            margin: 6px 0;
            padding: 0;
            page-break-inside: avoid;
        }
        
        .dynamic-fields {
            margin-bottom: 5px;
        }
        
        .dynamic-field {
            margin-bottom: 4px;
            page-break-inside: avoid;
            padding: 2px 3px;
            font-size: 10px;
        }
        
        .field-label {
            font-weight: bold;
            color: #000;
            font-size: 10px;
        }
        
        .field-value {
            color: #000;
            margin-left: 10px;
            font-size: 10px;
            word-wrap: break-word;
        }
        
        .footer {
            text-align: center;
            margin-top: 8px;
            padding-top: 5px;
            border-top: 1px solid #999;
            font-size: 9px;
            color: #666;
            page-break-inside: avoid;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 3px;
        }
        
        table td {
            padding: 3px;
            border: 1px solid #ccc;
            font-size: 10px;
        }
        
        table th {
            background-color: #e8e8e8;
            padding: 4px 3px;
            text-align: left;
            border: 1px solid #ccc;
            font-weight: bold;
            font-size: 10px;
        }
        
        .empty-msg {
            font-style: italic;
            color: #666;
            font-size: 10px;
        }
        
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>LAPORAN PENGAJUAN SURAT</h1>
            <p>Desa Candi</p>
        </div>

        <!-- Nomor & Status -->
        <div class="section">
            <div class="row">
                <div class="col-label">No. Pengajuan</div>
                <div class="col-value"><strong>{{ $pengajuanSurat->nomor_pengajuan }}</strong></div>
            </div>
            <div class="row">
                <div class="col-label">Jenis Surat</div>
                <div class="col-value"><strong>{{ $pengajuanSurat->jenis_surat }}</strong></div>
            </div>
            <div class="row">
                <div class="col-label">Status</div>
                <div class="col-value">
                    @if($pengajuanSurat->status == 'Menunggu')
                        <span class="badge badge-warning">{{ $pengajuanSurat->status }}</span>
                    @elseif($pengajuanSurat->status == 'Diproses')
                        <span class="badge badge-info">{{ $pengajuanSurat->status }}</span>
                    @elseif($pengajuanSurat->status == 'Selesai')
                        <span class="badge badge-success">{{ $pengajuanSurat->status }}</span>
                    @else
                        {{ $pengajuanSurat->status }}
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-label">Tanggal</div>
                <div class="col-value">{{ $pengajuanSurat->created_at->format('d F Y') }}</div>
            </div>
        </div>

        <div class="separator"></div>

        <!-- Data Pemohon -->
        <div class="section">
            <div class="section-title">Data Pemohon</div>
            <div class="row">
                <div class="col-label">NIK</div>
                <div class="col-value">{{ $user->nik ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col-label">Nama</div>
                <div class="col-value">{{ $user->nama_lengkap ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col-label">No. Telepon</div>
                <div class="col-value">{{ $user->no_telepon ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col-label">Alamat</div>
                <div class="col-value">{{ $user->alamat ?? '-' }} RT {{ $user->rt ?? '-' }} RW {{ $user->rw ?? '-' }}</div>
            </div>
        </div>

        <div class="separator"></div>

        <!-- Informasi Surat -->
        <div class="section">
            <div class="section-title">Informasi Pengajuan</div>
            <div class="row">
                <div class="col-label">Keperluan</div>
                <div class="col-value">{{ $pengajuanSurat->keperluan ?? '-' }}</div>
            </div>
            @if($pengajuanSurat->keterangan_tambahan)
            <div class="row">
                <div class="col-label">Keterangan</div>
                <div class="col-value">{{ $pengajuanSurat->keterangan_tambahan }}</div>
            </div>
            @endif
        </div>

        <!-- Dynamic Fields -->
        @if($pengajuanSurat->dynamic_fields && count(json_decode($pengajuanSurat->dynamic_fields, true)) > 0)
        <div class="separator"></div>
        <div class="section">
            <div class="section-title">Detail Tambahan</div>
            <div class="dynamic-fields">
                @foreach(json_decode($pengajuanSurat->dynamic_fields, true) as $fieldName => $fieldValue)
                <div class="dynamic-field">
                    <div class="field-label">{{ ucfirst(str_replace(['_', '-'], ' ', $fieldName)) }}</div>
                    <div class="field-value">
                        @if(is_array($fieldValue))
                            {{ implode(', ', $fieldValue) }}
                        @elseif(strlen($fieldValue) > 0)
                            {{ $fieldValue }}
                        @else
                            <span class="empty-msg">-</span>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="separator"></div>

        <!-- Catatan & Status -->
        <div class="section">
            <div class="section-title">Catatan</div>
            <div class="field-value">
                @if($pengajuanSurat->catatan_admin)
                    {{ $pengajuanSurat->catatan_admin }}
                @else
                    <span class="empty-msg">-</span>
                @endif
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Sistem Informasi Desa Candi | {{ now()->format('d F Y H:i') }} WIB</p>
        </div>
    </div>
</body>
</html>
