<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengajuanSurat->jenis_surat }} - {{ $pengajuanSurat->nomor_pengajuan }}</title>
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
                            <h5 class="mb-0">{{ $pengajuanSurat->jenis_surat }}</h5>
                            <small class="text-muted">{{ $pengajuanSurat->nomor_pengajuan }}</small>
                        </div>
                        <div>
                            <button class="btn btn-danger btn-sm me-2" onclick="downloadPDF()">
                                <i class="ti ti-download me-1"></i> Download PDF
                            </button>
                            <button class="btn btn-primary btn-sm me-2" onclick="window.print()">
                                <i class="ti ti-printer me-1"></i> Cetak
                            </button>
                            <a href="{{ route('pengajuan-surat.show', $pengajuanSurat->id) }}" class="btn btn-secondary btn-sm">
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
            <div id="letterContent" style="background: white; padding: 50px; min-height: 1100px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
                
                <!-- Letter Header -->
                <div style="text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 20px;">
                    <div style="margin-bottom: 10px;">
                        <h3 style="font-weight: 700; margin: 0; font-size: 18px;">PEMERINTAH DESA KEDUNGKENDO</h3>
                        <p style="margin: 5px 0; font-size: 13px;">Kecamatan Candi Kabupaten Sidoarjo</p>
                    </div>
                </div>

                <!-- Letter Title -->
                <div style="text-align: center; margin-bottom: 30px;">
                    <h2 style="font-weight: 700; margin: 0 0 10px 0; font-size: 18px; text-decoration: underline;">{{ $pengajuanSurat->jenis_surat }}</h2>
                    <p style="margin: 0; font-size: 12px;">No. {{ $pengajuanSurat->nomor_pengajuan }}</p>
                </div>

                <!-- Letter Body -->
                <div style="margin-bottom: 30px; line-height: 1.8; font-size: 12px;">
                    <p style="margin-bottom: 15px;">Dengan ini kami beritahukan bahwa:</p>

                    <!-- Data Pemohon -->
                    <table style="width: 100%; margin-bottom: 20px; font-size: 12px; border-collapse: collapse;">
                        <tr>
                            <td style="padding: 5px 0; width: 150px;">
                                <strong>Nama</strong>
                            </td>
                            <td style="padding: 5px 0; padding-left: 20px;">
                                : {{ $user->nama_lengkap ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0;">
                                <strong>NIK</strong>
                            </td>
                            <td style="padding: 5px 0; padding-left: 20px;">
                                : {{ $user->nik ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0;">
                                <strong>Tempat, Tgl Lahir</strong>
                            </td>
                            <td style="padding: 5px 0; padding-left: 20px;">
                                : {{ $user->tempat_lahir ?? '-' }}, {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0;">
                                <strong>Alamat</strong>
                            </td>
                            <td style="padding: 5px 0; padding-left: 20px;">
                                : {{ $user->alamat ?? '-' }} RT {{ $user->rt ?? '-' }} RW {{ $user->rw ?? '-' }}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px 0;">
                                <strong>No. Telepon</strong>
                            </td>
                            <td style="padding: 5px 0; padding-left: 20px;">
                                : {{ $user->no_telepon ?? '-' }}
                            </td>
                        </tr>
                    </table>

                    <p style="margin-bottom: 15px;">Dengan penuh tanggung jawab, kami nyatakan bahwa data tersebut di atas adalah benar adanya.</p>

                    <!-- Dynamic Fields Section -->
                    @php
                        $jenisSurat = $pengajuanSurat->jenis_surat;
                        $allSuratTypes = \App\Models\PengajuanSurat::getSuratTypes();
                        $fields = $allSuratTypes[$jenisSurat]['fields'] ?? [];
                        $textFields = [];
                        foreach ($fields as $fieldName => $fieldConfig) {
                            if ($fieldConfig['type'] !== 'file') {
                                $textFields[$fieldName] = $fieldConfig;
                            }
                        }
                    @endphp

                    @php
                        $hasFilledFields = false;
                        foreach ($textFields as $fieldName => $fieldConfig) {
                            if ($pengajuanSurat->{$fieldName} !== null && $pengajuanSurat->{$fieldName} !== '') {
                                $hasFilledFields = true;
                                break;
                            }
                        }
                    @endphp

                    @if($hasFilledFields)
                        <p style="margin-bottom: 15px; font-weight: 500;">Keterangan Pengajuan:</p>
                        <table style="width: 100%; margin-bottom: 20px; font-size: 12px; border-collapse: collapse;">
                            @foreach($textFields as $fieldName => $fieldConfig)
                                @php
                                    $fieldValue = $pengajuanSurat->{$fieldName};
                                    $isTextarea = $fieldConfig['type'] === 'textarea';
                                    $isSelect = $fieldConfig['type'] === 'select';
                                    $isDate = $fieldConfig['type'] === 'date';
                                    $isNumber = $fieldConfig['type'] === 'number';
                                @endphp
                                
                                @if($fieldValue !== null && $fieldValue !== '')
                                    <tr>
                                        <td style="padding: 5px 0; width: 150px; vertical-align: top;">
                                            <strong>{{ $fieldConfig['label'] }}</strong>
                                        </td>
                                        <td style="padding: 5px 0; padding-left: 20px;">
                                            :
                                            @if($isTextarea)
                                                <span style="white-space: pre-wrap; word-wrap: break-word;">{{ $fieldValue }}</span>
                                            @elseif($isDate)
                                                {{ \Carbon\Carbon::parse($fieldValue)->format('d F Y') }}
                                            @elseif($isNumber)
                                                @if(str_contains(strtolower($fieldConfig['label']), 'luas'))
                                                    {{ number_format($fieldValue, 2, ',', '.') }} m²
                                                @elseif(str_contains(strtolower($fieldConfig['label']), 'harga|nominal|jumlah'))
                                                    Rp. {{ number_format($fieldValue, 0, ',', '.') }}
                                                @else
                                                    {{ $fieldValue }}
                                                @endif
                                            @else
                                                {{ $fieldValue }}
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    @endif

                    @if($pengajuanSurat->keperluan)
                        <table style="width: 100%; margin-bottom: 20px; font-size: 12px; border-collapse: collapse;">
                            <tr>
                                <td style="padding: 5px 0; width: 150px; vertical-align: top;">
                                    <strong>Keperluan</strong>
                                </td>
                                <td style="padding: 5px 0; padding-left: 20px;">
                                    : {{ $pengajuanSurat->keperluan }}
                                </td>
                            </tr>
                            @if($pengajuanSurat->keterangan_tambahan)
                            <tr>
                                <td style="padding: 5px 0; width: 150px; vertical-align: top;">
                                    <strong>Keterangan</strong>
                                </td>
                                <td style="padding: 5px 0; padding-left: 20px;">
                                    : {{ $pengajuanSurat->keterangan_tambahan }}
                                </td>
                            </tr>
                            @endif
                        </table>
                    @endif
                </div>

                <!-- Signature Section -->
                <div style="margin-top: 50px; margin-bottom: 30px;">
                    <div style="display: flex; justify-content: space-between;">
                        <div style="width: 45%; text-align: center;">
                            <p style="margin: 0 0 50px 0; font-size: 12px;">Pemohon</p>
                            <p style="margin: 0; font-size: 12px; font-weight: 500;">{{ $user->nama_lengkap ?? '-' }}</p>
                        </div>
                        <div style="width: 45%; text-align: center;">
                            <p style="margin: 0 0 50px 0; font-size: 12px;">Kepala Desa Kedung Kendo</p>
                            <p style="margin: 0; font-size: 12px; font-weight: 500;">(...........................)</p>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div style="text-align: center; padding-top: 20px; border-top: 1px solid #ddd; margin-top: 30px; font-size: 11px; color: #999;">
                    <p style="margin: 5px 0;">Dokumen ini dicetak dari Sistem Informasi Desa Kedung Kendo</p>
                    <p style="margin: 5px 0;">Tanggal: {{ now()->format('d F Y') }} | Nomor: {{ $pengajuanSurat->nomor_pengajuan }}</p>
                </div>
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
            filename: '{{ $pengajuanSurat->nomor_pengajuan }}.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(element).save();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
