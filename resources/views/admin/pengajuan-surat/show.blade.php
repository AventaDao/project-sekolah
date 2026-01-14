@extends('layouts.dashboard')
@section('title', 'Detail & Proses Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan-surat.index') }}">Kelola Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Detail Pengajuan -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Pengajuan Surat</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge {{ $pengajuanSurat->status_badge }} fs-6 px-3 py-2" id="statusBadge">
                            <i class="ti ti-file-check me-1"></i> Status: {{ $pengajuanSurat->status }}
                        </span>
                    </div>

                    <!-- Data Pengajuan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengajuan</h5>
                    <table class="table table-borderless">
                        <tr>
                            <td width="30%" class="text-muted">Nomor Pengajuan</td>
                            <td width="5%">:</td>
                            <td><strong>{{ $pengajuanSurat->nomor_pengajuan }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Nama Pemohon</td>
                            <td>:</td>
                            <td><strong>{{ $pengajuanSurat->user->name }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Email</td>
                            <td>:</td>
                            <td>{{ $pengajuanSurat->user->email }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jenis Surat</td>
                            <td>:</td>
                            <td><strong>{{ $pengajuanSurat->jenis_surat }}</strong></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Pengajuan</td>
                            <td>:</td>
                            <td>{{ $pengajuanSurat->created_at->format('d F Y H:i') }} WIB</td>
                        </tr>
                        @if($pengajuanSurat->tanggal_selesai)
                        <tr>
                            <td class="text-muted">Tanggal Selesai</td>
                            <td>:</td>
                            <td>{{ $pengajuanSurat->tanggal_selesai->format('d F Y H:i') }} WIB</td>
                        </tr>
                        @endif
                    </table>

                    <!-- Keperluan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Keperluan</h5>
                    <p class="text-muted">{{ $pengajuanSurat->keperluan }}</p>

                    <!-- Keterangan Tambahan -->
                    @if($pengajuanSurat->keterangan_tambahan)
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Keterangan Tambahan</h5>
                    <p class="text-muted">{{ $pengajuanSurat->keterangan_tambahan }}</p>
                    @endif

                    <!-- Detail Informasi Pengajuan (Field Teks) -->
                    @include('component.detail-pengajuan', ['pengajuanSurat' => $pengajuanSurat])

                    <!-- Surat Pengantar RW -->
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Surat Pengantar RW</h5>
                    <a href="{{ route('admin.pengajuan-surat.download-pengantar', $pengajuanSurat->id) }}" 
                       class="btn btn-outline-primary" target="_blank">
                        <i class="ti ti-download"></i> Download Surat Pengantar RW
                    </a>

                    <!-- Catatan Admin -->
                    @if($pengajuanSurat->catatan_admin)
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Catatan Admin</h5>
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle me-2"></i>
                        {{ $pengajuanSurat->catatan_admin }}
                    </div>
                    @endif

                    <!-- Surat Jadi -->
                    @if($pengajuanSurat->file_surat_jadi)
                    <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Surat Jadi</h5>
                    <a href="{{ route('admin.pengajuan-surat.download-surat-jadi', $pengajuanSurat->id) }}" 
                       class="btn btn-success" target="_blank">
                        <i class="ti ti-file-download"></i> Lihat Surat Jadi
                    </a>
                    @endif

                    <!-- Preview Dokumen yang Diunggah User -->
                    @include('component.dokumen-pengajuan', ['pengajuanSurat' => $pengajuanSurat])
                </div>
            </div>
        </div>

        <!-- Form Update Status -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Update Status Pengajuan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pengajuan-surat.update-status', $pengajuanSurat->id) }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          id="updateStatusForm">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror" required id="statusSelect">
                                <option value="Menunggu" {{ $pengajuanSurat->status == 'Menunggu' ? 'selected' : '' }}>
                                    Menunggu
                                </option>
                                <option value="Diproses" {{ $pengajuanSurat->status == 'Diproses' ? 'selected' : '' }}>
                                    Diproses
                                </option>
                                <option value="Selesai" {{ $pengajuanSurat->status == 'Selesai' ? 'selected' : '' }}>
                                    Selesai
                                </option>
                                <option value="Ditolak" {{ $pengajuanSurat->status == 'Ditolak' ? 'selected' : '' }}>
                                    Ditolak
                                </option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catatan untuk Pemohon</label>
                            <textarea name="catatan_admin" class="form-control @error('catatan_admin') is-invalid @enderror" 
                                      rows="4" placeholder="Masukkan catatan atau informasi untuk pemohon...">{{ old('catatan_admin', $pengajuanSurat->catatan_admin) }}</textarea>
                            @error('catatan_admin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Catatan akan dilihat oleh pemohon</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="ti ti-device-floppy"></i> Update Status
                            </button>
                            <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Info Card -->
            <div class="card mt-3">
                <div class="card-body">
                    <h6 class="mb-3">Panduan Status</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <span class="badge bg-warning">Menunggu</span>
                            <small class="d-block text-muted">Pengajuan baru masuk</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-info">Diproses</span>
                            <small class="d-block text-muted">Surat sedang dikerjakan</small>
                        </li>
                        <li class="mb-2">
                            <span class="badge bg-success">Selesai</span>
                            <small class="d-block text-muted">Surat sudah selesai</small>
                        </li>
                        <li class="mb-0">
                            <span class="badge bg-danger">Ditolak</span>
                            <small class="d-block text-muted">Pengajuan ditolak</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   ADMIN PENGAJUAN SURAT SHOW - MODERN STYLING
   ============================================ */

/* Breadcrumb Modern */
.breadcrumb {
    background: transparent !important;
    padding: 0 !important;
    margin-bottom: 20px;
}

.breadcrumb-item a {
    color: #4680ff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.breadcrumb-item a:hover {
    color: #357abd;
    transform: translateX(2px);
}

.breadcrumb-item.active {
    color: #6c757d;
}

/* Card Styling */
.card {
    border: 1px solid rgba(70, 128, 255, 0.1) !important;
    border-radius: 16px !important;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.card:hover {
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12) !important;
    transform: translateY(-4px);
}

.card-header {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.1) 0%, rgba(44, 168, 127, 0.08) 100%) !important;
    border-bottom: 1px solid rgba(70, 128, 255, 0.15) !important;
    padding: 24px !important;
    border-radius: 15px 15px 0 0 !important;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-header h5 {
    color: #2c3e50;
    font-weight: 700;
    font-size: 20px;
    margin: 0;
}

.card-body {
    padding: 32px !important;
}

/* Status Badge Styling */
.badge {
    padding: 10px 16px !important;
    border-radius: 10px !important;
    font-weight: 600;
    font-size: 12px;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.badge.bg-warning {
    background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%) !important;
    box-shadow: 0 6px 20px rgba(255, 152, 0, 0.3);
    color: white;
}

.badge.bg-info {
    background: linear-gradient(135deg, #17a2b8 0%, #0c7baa 100%) !important;
    box-shadow: 0 6px 20px rgba(23, 162, 184, 0.3);
    color: white;
}

.badge.bg-success {
    background: linear-gradient(135deg, #28a745 0%, #229070 100%) !important;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
    color: white;
}

.badge.bg-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.3);
    color: white;
}

.badge.bg-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.2);
    color: white;
}

/* Heading Styling */
h5.text-primary {
    color: #4680ff !important;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 24px !important;
    padding-bottom: 16px !important;
    border-bottom: 2px solid rgba(70, 128, 255, 0.2) !important;
}

h5.text-primary i {
    font-size: 20px;
}

h6 {
    color: #2c3e50;
    font-weight: 700;
}

/* Table Styling */
.table {
    margin-bottom: 0;
    border-collapse: separate;
    border-spacing: 0 8px;
    width: 100%;
    overflow-x: hidden;
}

.table-wrapper {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.table-wrapper::-webkit-scrollbar {
    display: none;
}

.table-wrapper {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.table td {
    padding: 12px 16px;
    border: none;
    vertical-align: middle;
    transition: all 0.3s ease;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.table tr {
    background: rgba(255, 255, 255, 0.7);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.table tr:hover {
    background: rgba(70, 128, 255, 0.08);
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.1);
}

.table tr:hover td {
    transform: translateX(4px);
}

.table td strong {
    color: #2c3e50;
    font-weight: 700;
}

.table td:first-child {
    color: #4680ff;
    font-weight: 600;
}

.table td.text-muted {
    color: #6c757d !important;
}

/* Alert Styling */
.alert {
    border: none !important;
    border-radius: 12px !important;
    padding: 18px 22px !important;
    margin-bottom: 24px;
    backdrop-filter: blur(10px);
    border-left: 4px solid transparent;
    transition: all 0.3s ease;
}

.alert:hover {
    transform: translateX(4px);
}

.alert-success {
    background: rgba(40, 167, 69, 0.1) !important;
    color: #28a745;
    border-left-color: #28a745;
}

.alert-info {
    background: rgba(70, 128, 255, 0.1) !important;
    color: #4680ff;
    border-left-color: #4680ff;
}

.alert-danger {
    background: rgba(220, 53, 69, 0.1) !important;
    color: #dc3545;
    border-left-color: #dc3545;
}

.alert i {
    font-size: 18px;
}

/* Form Styling */
.form-label {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 14px;
}

.form-control,
.form-select {
    border: 1px solid rgba(70, 128, 255, 0.2) !important;
    border-radius: 10px !important;
    padding: 12px 16px !important;
    font-size: 14px;
    transition: all 0.3s ease;
    background: rgba(255, 255, 255, 0.8);
}

.form-control:focus,
.form-select:focus {
    border-color: #4680ff !important;
    box-shadow: 0 0 0 0.2rem rgba(70, 128, 255, 0.15) !important;
    background: white;
}

.form-control::placeholder {
    color: #999;
}

.form-text {
    color: #999;
    font-size: 12px;
}

.text-danger {
    color: #dc3545;
}

/* Button Styling */
.btn {
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    padding: 12px 20px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(70, 128, 255, 0.35);
    color: white;
}

.btn-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(108, 117, 125, 0.15);
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(108, 117, 125, 0.25);
    color: white;
}

.btn-outline-primary {
    border: 2px solid #4680ff;
    color: #4680ff;
    background: transparent;
}

.btn-outline-primary:hover {
    background: #4680ff;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
}

.btn-success {
    background: linear-gradient(135deg, #28a745 0%, #229070 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(40, 167, 69, 0.25);
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(40, 167, 69, 0.35);
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
    box-shadow: 0 6px 20px rgba(220, 53, 69, 0.25);
}

.btn-danger:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(220, 53, 69, 0.35);
    color: white;
}

.btn-close {
    background-color: rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.btn-close:hover {
    background-color: rgba(0, 0, 0, 0.5);
}

.d-grid {
    display: grid;
    gap: 12px;
}

.d-grid .btn {
    width: 100%;
    justify-content: center;
}

/* List Styling */
.list-unstyled {
    padding: 0;
    margin: 0;
}

.list-unstyled li {
    padding: 12px;
    border-radius: 8px;
    background: rgba(70, 128, 255, 0.05);
    margin-bottom: 12px;
    transition: all 0.3s ease;
}

.list-unstyled li:hover {
    background: rgba(70, 128, 255, 0.1);
    transform: translateX(4px);
}

.list-unstyled small {
    display: block;
    margin-top: 4px;
}

/* Paragraph & Text */
p {
    color: #6c757d;
    line-height: 1.6;
    font-size: 14px;
}

p.mb-0 {
    margin-bottom: 0 !important;
}

p.text-muted {
    color: #6c757d !important;
}

/* Responsive */
@media (max-width: 768px) {
    .card-header {
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .card-header h5 {
        font-size: 18px;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    .btn {
        width: 100%;
        justify-content: center;
    }
    
    .table td {
        padding: 10px 12px;
        font-size: 13px;
    }
    
    h5.text-primary {
        font-size: 16px;
    }
    
    .row {
        margin-left: -12px;
        margin-right: -12px;
    }
    
    .col-lg-4,
    .col-lg-8 {
        padding-left: 12px;
        padding-right: 12px;
        margin-bottom: 20px;
    }
}

/* Utility Classes */
.mb-4 {
    margin-bottom: 28px !important;
}

.mb-3 {
    margin-bottom: 20px !important;
}

.mb-2 {
    margin-bottom: 12px !important;
}

.mb-0 {
    margin-bottom: 0 !important;
}

.mt-4 {
    margin-top: 28px !important;
}

.mt-3 {
    margin-top: 20px !important;
}

.pt-3 {
    padding-top: 20px !important;
}

.me-1 {
    margin-right: 6px !important;
}

.me-2 {
    margin-right: 8px !important;
}

.me-3 {
    margin-right: 12px !important;
}

.ms-2 {
    margin-left: 8px !important;
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}

.justify-content-between {
    justify-content: space-between;
}

.flex-grow-1 {
    flex-grow: 1;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('statusSelect');
    const statusBadge = document.getElementById('statusBadge');
    
    // Status badge classes
    const badgeClasses = {
        'Menunggu': 'bg-warning',
        'Diproses': 'bg-info',
        'Selesai': 'bg-success',
        'Ditolak': 'bg-danger'
    };
    
    // Listen to status change
    statusSelect.addEventListener('change', function() {
        const selectedStatus = this.value;
        const badgeClass = badgeClasses[selectedStatus];
        
        // Update badge class
        statusBadge.className = `badge ${badgeClass} fs-6 px-3 py-2`;
        
        // Update badge text
        statusBadge.innerHTML = `<i class="ti ti-file-check me-1"></i> Status: ${selectedStatus}`;
    });
});
</script>
@endsection