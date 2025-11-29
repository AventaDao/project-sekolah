<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        
        .header h1 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 12px;
            color: #666;
        }
        
        .section {
            margin-bottom: 25px;
        }
        
        .section-title {
            background-color: #f0f0f0;
            padding: 10px 15px;
            font-weight: bold;
            border-left: 4px solid #4680ff;
            margin-bottom: 15px;
            font-size: 14px;
        }
        
        .row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }
        
        .col {
            display: table-cell;
            padding: 8px 0;
            vertical-align: top;
        }
        
        .col-label {
            width: 35%;
            font-weight: bold;
            color: #555;
        }
        
        .col-value {
            width: 65%;
            color: #333;
        }
        
        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
            font-weight: bold;
        }
        
        .badge-success {
            background-color: #2ca87f;
            color: white;
        }
        
        .badge-warning {
            background-color: #f4bd0e;
            color: #333;
        }
        
        .badge-primary {
            background-color: #4680ff;
            color: white;
        }
        
        .badge-info {
            background-color: #1ea8e0;
            color: white;
        }
        
        .separator {
            border-top: 1px solid #ddd;
            margin: 20px 0;
        }
        
        .dynamic-fields {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
        }
        
        .dynamic-field {
            margin-bottom: 12px;
        }
        
        .field-label {
            font-weight: bold;
            color: #555;
            font-size: 13px;
        }
        
        .field-value {
            color: #333;
            margin-top: 3px;
            word-wrap: break-word;
        }
        
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            margin-top: 40px;
            font-size: 11px;
            color: #999;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
        
        table th {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>LAPORAN PENGAJUAN SURAT</h1>
            <p>Sistem Informasi Desa Candi</p>
        </div>

        <!-- Nomor Pengajuan -->
        <div class="section">
            <div class="row">
                <div class="col col-label">Nomor Pengajuan</div>
                <div class="col col-value">: <strong>{{ $pengajuanSurat->nomor_pengajuan }}</strong></div>
            </div>
            <div class="row">
                <div class="col col-label">Status</div>
                <div class="col col-value">
                    : 
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
                <div class="col col-label">Tanggal Pengajuan</div>
                <div class="col col-value">: {{ $pengajuanSurat->created_at->format('d F Y H:i') }} WIB</div>
            </div>
        </div>

        <div class="separator"></div>

        <!-- Data Pemohon -->
        <div class="section">
            <div class="section-title">Data Pemohon</div>
            <div class="row">
                <div class="col col-label">NIK</div>
                <div class="col col-value">: {{ $user->nik ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col col-label">Nama Lengkap</div>
                <div class="col col-value">: {{ $user->nama_lengkap ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col col-label">No. Telepon</div>
                <div class="col col-value">: {{ $user->no_telepon ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col col-label">Email</div>
                <div class="col col-value">: {{ $user->email ?? '-' }}</div>
            </div>
            <div class="row">
                <div class="col col-label">Alamat</div>
                <div class="col col-value">: {{ $user->alamat ?? '-' }} RT {{ $user->rt ?? '-' }} RW {{ $user->rw ?? '-' }}</div>
            </div>
        </div>

        <div class="separator"></div>

        <!-- Informasi Surat -->
        <div class="section">
            <div class="section-title">Informasi Surat</div>
            <div class="row">
                <div class="col col-label">Jenis Surat</div>
                <div class="col col-value">: <strong>{{ $pengajuanSurat->jenis_surat }}</strong></div>
            </div>
            <div class="row">
                <div class="col col-label">Keperluan</div>
                <div class="col col-value">: {{ $pengajuanSurat->keperluan ?? '-' }}</div>
            </div>
            
            @if($pengajuanSurat->keterangan_tambahan)
            <div class="row">
                <div class="col col-label">Keterangan Tambahan</div>
                <div class="col col-value">: {{ $pengajuanSurat->keterangan_tambahan }}</div>
            </div>
            @endif
        </div>

        <!-- Dynamic Fields -->
        @if($pengajuanSurat->dynamic_fields && count(json_decode($pengajuanSurat->dynamic_fields, true)) > 0)
        <div class="separator"></div>
        <div class="section">
            <div class="section-title">Detail Pengajuan</div>
            <div class="dynamic-fields">
                @foreach(json_decode($pengajuanSurat->dynamic_fields, true) as $fieldName => $fieldValue)
                <div class="dynamic-field">
                    <div class="field-label">{{ ucfirst(str_replace('_', ' ', $fieldName)) }}</div>
                    <div class="field-value">
                        @if(is_array($fieldValue))
                            {{ implode(', ', $fieldValue) }}
                        @else
                            {{ $fieldValue ?? '-' }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="separator"></div>

        <!-- Status Tracking -->
        <div class="section">
            <div class="section-title">Catatan Proses</div>
            @if($pengajuanSurat->catatan_admin)
            <div class="row">
                <div class="col col-value">{{ $pengajuanSurat->catatan_admin }}</div>
            </div>
            @else
            <div class="row">
                <div class="col col-value"><em>Belum ada catatan dari admin</em></div>
            </div>
            @endif
        </div>

        <div class="separator"></div>

        <!-- Tanggal Update -->
        <div class="section">
            <div class="row">
                <div class="col col-label">Terakhir Diupdate</div>
                <div class="col col-value">: {{ $pengajuanSurat->updated_at->format('d F Y H:i') }} WIB</div>
            </div>
            @if($pengajuanSurat->tanggal_selesai)
            <div class="row">
                <div class="col col-label">Tanggal Selesai</div>
                <div class="col col-value">: {{ $pengajuanSurat->tanggal_selesai->format('d F Y H:i') }} WIB</div>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Dokumen ini dicetak otomatis dari Sistem Informasi Desa Candi</p>
            <p>Tanggal Cetak: {{ now()->format('d F Y H:i') }} WIB</p>
        </div>
    </div>
</body>
</html>
