@props(['pengajuanSurat'])

@php
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
@endphp

@if(!empty($fileFields))
<div class="card mt-4">
    <div class="card-header">
        <h5 class="mb-0">
            <i class="ti ti-folder-open me-2"></i>
            Dokumen yang Diunggah
        </h5>
    </div>
    <div class="card-body">
        @forelse($fileFields as $fieldName => $fieldConfig)
            @php
                $fileValue = $pengajuanSurat->{$fieldName};
                $isImage = strpos($fieldConfig['accept'], 'image') !== false;
                $isPdf = strpos($fieldConfig['accept'], 'pdf') !== false;
            @endphp
            
            @if($fileValue)
                <div class="document-preview-item mb-3 p-3 border rounded" style="background-color: #f9f9f9;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                @if($isImage && !$isPdf)
                                    <i class="ti ti-photo text-primary me-2"></i>
                                @elseif($isPdf)
                                    <i class="ti ti-file-pdf text-danger me-2"></i>
                                @else
                                    <i class="ti ti-file me-2"></i>
                                @endif
                                <strong>{{ $fieldConfig['label'] }}</strong>
                            </h6>
                            <small class="text-muted d-block" style="word-break: break-all;">
                                📁 {{ basename($fileValue) }}
                            </small>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#previewModal{{ str_replace('-', '', str_replace('_', '', $fieldName)) }}">
                                <i class="ti ti-eye me-1"></i> Preview
                            </button>
                            <a href="{{ route($routePrefix . 'download-file', [$pengajuanSurat->id, $fieldName]) }}" 
                               class="btn btn-sm btn-outline-info">
                                <i class="ti ti-download me-1"></i> Download
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Modal Preview -->
                <div class="modal fade" id="previewModal{{ str_replace('-', '', str_replace('_', '', $fieldName)) }}" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $fieldConfig['label'] }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body" style="max-height: 650px; overflow-y: auto;">
                                @if($isImage && !$isPdf)
                                    <!-- Preview Gambar -->
                                    <div class="text-center">
                                        <img src="{{ route($routePrefix . 'preview-file', [$pengajuanSurat->id, $fieldName]) }}" 
                                             alt="{{ $fieldConfig['label'] }}" 
                                             class="img-fluid rounded"
                                             style="max-width: 100%; max-height: 600px; object-fit: contain;">
                                    </div>
                                @elseif($isPdf)
                                    <!-- Preview PDF -->
                                    <div style="position: relative; width: 100%; height: 550px; border: 1px solid #ddd; border-radius: 4px; overflow: hidden;">
                                        <iframe src="{{ route($routePrefix . 'preview-file', [$pengajuanSurat->id, $fieldName]) }}" 
                                                width="100%" 
                                                height="100%" 
                                                style="border: none;"></iframe>
                                    </div>
                                @else
                                    <!-- Format Lain -->
                                    <div class="alert alert-info">
                                        <i class="ti ti-info-circle me-2"></i>
                                        File ini tidak dapat dipratinjau langsung di browser.
                                    </div>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route($routePrefix . 'download-file', [$pengajuanSurat->id, $fieldName]) }}" 
                                   class="btn btn-primary">
                                    <i class="ti ti-download me-1"></i> Download
                                </a>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- File Tidak Ada -->
                <div class="document-preview-item mb-3 p-3 border rounded" style="background-color: #f0f0f0; opacity: 0.6;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="flex-grow-1">
                            <h6 class="mb-1">
                                <i class="ti ti-file-x text-muted me-2"></i>
                                <strong>{{ $fieldConfig['label'] }}</strong>
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
            @endif
        @empty
            <div class="alert alert-info">
                <i class="ti ti-info-circle me-2"></i>
                <strong>Tidak ada dokumen</strong> untuk jenis surat ini.
            </div>
        @endforelse
    </div>
</div>
@endif

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
