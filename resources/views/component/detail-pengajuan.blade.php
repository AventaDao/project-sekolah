@props(['pengajuanSurat'])

@php
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
@endphp

@if(!empty($textFields))
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="ti ti-form-checkbox me-2"></i>
            Detail Informasi Pengajuan
        </h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-borderless" style="text-align: left;">
                <tbody>
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
                                <td width="30%" class="text-muted fw-semibold">
                                    @if($fieldConfig['required'])
                                        <i class="ti ti-circle-filled me-1" style="font-size: 6px; vertical-align: middle;"></i>
                                    @endif
                                    {{ $fieldConfig['label'] }}
                                </td>
                                <td width="5%" style="text-align: center;">:</td>
                                <td style="text-align: left !important;">
                                    @if($isTextarea)
                                        <p class="mb-0" style="white-space: pre-wrap; word-wrap: break-word; text-align: left;">
                                            {{ $fieldValue }}
                                        </p>
                                    @elseif($isDate)
                                        <span class="badge bg-light text-dark">
                                            <i class="ti ti-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($fieldValue)->format('d F Y') }}
                                        </span>
                                    @elseif($isNumber)
                                        <strong style="display: block; text-align: left;">
                                            @if(str_contains(strtolower($fieldConfig['label']), 'luas') || 
                                                str_contains(strtolower($fieldConfig['label']), 'jumlah'))
                                                @if(str_contains(strtolower($fieldConfig['label']), 'luas'))
                                                    {{ number_format($fieldValue, 2, ',', '.') }} m²
                                                @else
                                                    Rp. {{ number_format($fieldValue, 0, ',', '.') }}
                                                @endif
                                            @else
                                                {{ $fieldValue }}
                                            @endif
                                        </strong>
                                    @else
                                        <strong style="display: block; text-align: left;">{{ $fieldValue }}</strong>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        @php
            // Check apakah ada field yang terisi
            $hasFilledFields = false;
            foreach ($textFields as $fieldName => $fieldConfig) {
                if ($pengajuanSurat->{$fieldName} !== null && $pengajuanSurat->{$fieldName} !== '') {
                    $hasFilledFields = true;
                    break;
                }
            }
        @endphp

        @if(!$hasFilledFields)
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                <strong>Tidak ada informasi</strong> yang ditampilkan untuk jenis surat ini.
            </div>
        @endif
    </div>
</div>
@endif
