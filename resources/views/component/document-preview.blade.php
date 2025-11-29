<!-- Component untuk Preview File dengan Modal -->
@props(['label', 'fileName', 'fileType' => 'image'])

@php
    // Tentukan tipe file
    $isImage = in_array($fileType, ['image', 'photo']);
    $isPdf = $fileType === 'pdf';
    $isText = in_array($fileType, ['text', 'textarea']);
@endphp

<div class="document-preview-item mb-3 p-3 border rounded" style="background-color: #f9f9f9;">
    <div class="d-flex justify-content-between align-items-start">
        <div class="flex-grow-1">
            <h6 class="mb-1">
                @if($isImage)
                    <i class="ti ti-photo text-primary me-2"></i>
                @elseif($isPdf)
                    <i class="ti ti-file-pdf text-danger me-2"></i>
                @else
                    <i class="ti ti-file-text text-info me-2"></i>
                @endif
                <strong>{{ $label }}</strong>
            </h6>
            <small class="text-muted">{{ $fileName ?? 'File tidak tersedia' }}</small>
        </div>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-sm btn-outline-primary" 
                    data-bs-toggle="modal" data-bs-target="#previewModal{{ str_replace(' ', '-', $label) }}"
                    @if(!$fileName || $slot->isEmpty()) disabled @endif>
                <i class="ti ti-eye me-1"></i> Preview
            </button>
            @if($fileName && !$slot->isEmpty())
            <a href="{{ $slot }}" class="btn btn-sm btn-outline-info" download>
                <i class="ti ti-download me-1"></i> Download
            </a>
            @endif
        </div>
    </div>
</div>

<!-- Modal Preview -->
@if($fileName && !$slot->isEmpty())
<div class="modal fade" id="previewModal{{ str_replace(' ', '-', $label) }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $label }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
                @if($isImage)
                    <img src="{{ $slot }}" alt="{{ $label }}" class="img-fluid rounded">
                @elseif($isPdf)
                    <iframe src="{{ $slot }}" width="100%" height="500px" style="border: 1px solid #ddd; border-radius: 4px;"></iframe>
                @else
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle me-2"></i>
                        <strong>Konten Teks:</strong>
                    </div>
                    <p>{{ $slot }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <a href="{{ $slot }}" class="btn btn-primary" download>
                    <i class="ti ti-download me-1"></i> Download
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endif
