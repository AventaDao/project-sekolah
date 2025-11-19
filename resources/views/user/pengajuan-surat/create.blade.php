@extends('layouts.dashboard')
@section('title', 'Ajukan Surat Baru')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengajuan-surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Ajukan Surat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Alert Info -->
            <div class="alert alert-info d-flex align-items-center" role="alert">
                <i class="ti ti-info-circle f-24 me-3"></i>
                <div>
                    <strong>Perhatian!</strong> Pastikan Anda telah memiliki <strong>Surat Pengantar dari RW</strong> sebelum mengajukan surat. File yang diupload harus dalam format PDF, JPG, JPEG, atau PNG dengan ukuran maksimal 2MB.
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5>Form Pengajuan Surat</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terdapat kesalahan:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('pengajuan-surat.store') }}" method="POST" enctype="multipart/form-data" id="formPengajuanSurat">
                        @csrf
                        
                        <div class="row">
                            <!-- Pilih Jenis Surat -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jenis Surat <span class="text-danger">*</span></label>
                                <select name="jenis_surat" id="jenisSurat" class="form-select @error('jenis_surat') is-invalid @enderror" required onchange="updateFormFields()">
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    @foreach($suratTypes as $key => $type)
                                    <option value="{{ $key }}" {{ old('jenis_surat') == $key ? 'selected' : '' }}>
                                        {{ $type['label'] }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('jenis_surat')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted" id="suratDeskripsi"></small>
                            </div>

                            <!-- Keperluan Umum -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keperluan <span class="text-danger">*</span></label>
                                <textarea name="keperluan" class="form-control @error('keperluan') is-invalid @enderror" 
                                          rows="4" required placeholder="Jelaskan keperluan pengajuan surat ini...">{{ old('keperluan') }}</textarea>
                                @error('keperluan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Jelaskan secara detail keperluan Anda mengajukan surat ini</small>
                            </div>

                            <!-- Dynamic Fields Container -->
                            <div id="dynamicFieldsContainer" class="col-md-12">
                                <!-- Fields akan di-generate oleh JavaScript -->
                            </div>

                            <!-- Surat Pengantar dari RW -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Surat Pengantar dari RW <span class="text-danger">*</span></label>
                                <input type="file" name="surat_pengantar_rw" 
                                       class="form-control @error('surat_pengantar_rw') is-invalid @enderror" 
                                       accept=".pdf,.jpg,.jpeg,.png" required>
                                @error('surat_pengantar_rw')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Format: PDF, JPG, JPEG, atau PNG. Maksimal 2MB.
                                </small>
                            </div>

                            <!-- Keterangan Tambahan -->
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keterangan Tambahan (Opsional)</label>
                                <textarea name="keterangan_tambahan" class="form-control @error('keterangan_tambahan') is-invalid @enderror" 
                                          rows="3" placeholder="Masukkan keterangan tambahan jika ada...">{{ old('keterangan_tambahan') }}</textarea>
                                @error('keterangan_tambahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Informasi tambahan yang perlu disampaikan (opsional)</small>
                            </div>
                        </div>

                        <!-- Info Box -->
                        <div class="alert alert-warning d-flex align-items-center mb-3" role="alert">
                            <i class="ti ti-alert-triangle f-24 me-3"></i>
                            <div>
                                <strong>Catatan:</strong> Pastikan semua data yang Anda masukkan sudah benar. Setelah diajukan, pengajuan akan diproses oleh admin desa.
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-send"></i> Ajukan Surat
                            </button>
                            <a href="{{ route('pengajuan-surat.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Informasi Jenis Surat -->
            <div class="card">
                <div class="card-header">
                    <h5>Informasi Jenis Surat</h5>
                </div>
                <div class="card-body">
                    <div class="accordion" id="accordionJenisSurat">
                        @foreach($suratTypes as $key => $type)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#surat{{ $loop->index }}">
                                    {{ $type['label'] }}
                                </button>
                            </h2>
                            <div id="surat{{ $loop->index }}" class="accordion-collapse collapse" data-bs-parent="#accordionJenisSurat">
                                <div class="accordion-body">
                                    <p>{{ $type['deskripsi'] }}</p>
                                    <h6 class="mt-3">Field yang Diperlukan:</h6>
                                    <ul>
                                        @foreach($type['fields'] as $fieldKey => $field)
                                        <li>{{ $field['label'] }} {{ $field['required'] ? '<span class="text-danger">*</span>' : '' }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Embed data untuk JavaScript -->
<script>
    const suratTypes = @json($suratTypes);
    const oldValues = @json(old());
    const errors = @json($errors->getMessages());
</script>

<script>
    function updateFormFields() {
        const jenisSurat = document.getElementById('jenisSurat').value;
        const container = document.getElementById('dynamicFieldsContainer');
        const suratDeskripsi = document.getElementById('suratDeskripsi');
        
        // Clear container
        container.innerHTML = '';
        suratDeskripsi.textContent = '';
        
        if (!jenisSurat) return;
        
        const suratType = suratTypes[jenisSurat];
        if (!suratType) return;
        
        // Set deskripsi
        suratDeskripsi.textContent = suratType.deskripsi;
        
        // Generate fields
        const fields = suratType.fields;
        let fieldsHTML = '';
        
        for (const [fieldName, fieldConfig] of Object.entries(fields)) {
            const fieldValue = oldValues[fieldName] || '';
            const hasError = errors[fieldName] ? true : false;
            const errorClass = hasError ? 'is-invalid' : '';
            const requiredStr = fieldConfig.required ? '<span class="text-danger">*</span>' : '';
            const requiredAttr = fieldConfig.required ? 'required' : '';
            
            let fieldHTML = `
                <div class="col-md-12 mb-3">
                    <label class="form-label">${fieldConfig.label} ${requiredStr}</label>
            `;
            
            if (fieldConfig.type === 'text') {
                fieldHTML += `
                    <input type="text" name="${fieldName}" class="form-control ${errorClass}" 
                           value="${fieldValue}" ${requiredAttr}>
                `;
            } else if (fieldConfig.type === 'number') {
                fieldHTML += `
                    <input type="number" name="${fieldName}" class="form-control ${errorClass}" 
                           value="${fieldValue}" step="${fieldConfig.step || '1'}" ${requiredAttr}>
                `;
            } else if (fieldConfig.type === 'date') {
                fieldHTML += `
                    <input type="date" name="${fieldName}" class="form-control ${errorClass}" 
                           value="${fieldValue}" ${requiredAttr}>
                `;
            } else if (fieldConfig.type === 'file') {
                const acceptAttr = fieldConfig.accept ? `accept="${fieldConfig.accept}"` : '';
                fieldHTML += `
                    <input type="file" name="${fieldName}" class="form-control ${errorClass}" 
                           ${acceptAttr} ${requiredAttr}>
                    <small class="form-text text-muted">Maksimal ukuran file 5MB</small>
                `;
            } else if (fieldConfig.type === 'textarea') {
                fieldHTML += `
                    <textarea name="${fieldName}" class="form-control ${errorClass}" rows="4" ${requiredAttr}>${fieldValue}</textarea>
                `;
            } else if (fieldConfig.type === 'select') {
                fieldHTML += `
                    <select name="${fieldName}" class="form-select ${errorClass}" ${requiredAttr}>
                        <option value="">-- Pilih --</option>
                `;
                
                fieldConfig.options.forEach(option => {
                    const selected = fieldValue === option ? 'selected' : '';
                    fieldHTML += `<option value="${option}" ${selected}>${option}</option>`;
                });
                
                fieldHTML += `</select>`;
            }
            
            // Add error message
            if (hasError) {
                fieldHTML += `
                    <div class="invalid-feedback" style="display: block;">
                        ${errors[fieldName][0]}
                    </div>
                `;
            }
            
            fieldHTML += `</div>`;
            fieldsHTML += fieldHTML;
        }
        
        container.innerHTML = fieldsHTML;
    }
    
    // Trigger update on page load if there's an old value
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSurat = document.getElementById('jenisSurat').value;
        if (jenisSurat) {
            updateFormFields();
        }
    });
</script>
@endsection