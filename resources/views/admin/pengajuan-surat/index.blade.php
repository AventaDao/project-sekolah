@extends('layouts.dashboard')
@section('title', 'Kelola Pengajuan Surat')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb dengan Styling Modern -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <nav aria-label="breadcrumb" class="breadcrumb-modern">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard" class="breadcrumb-link">
                                    <i class="ti ti-home"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <i class="ti ti-file-text"></i> Kelola Pengajuan Surat
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-12">
                    <div class="page-header-content">
                        <h2 class="page-title">
                            <i class="ti ti-file-text"></i> Kelola Pengajuan Surat
                        </h2>
                        <p class="page-subtitle">Kelola semua pengajuan surat warga dengan mudah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Statistics Cards dengan Modern Styling -->
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-menunggu border-0">
                <div class="card-body">
                    <div class="stat-card-bg"></div>
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="flex-shrink-0">
                            <div class="stat-icon stat-icon-warning">
                                <i class="ti ti-clock"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="stat-label mb-0">Menunggu</h6>
                            <p class="stat-value mb-0">
                                {{ $pengajuans->where('status', 'Menunggu')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-diproses border-0">
                <div class="card-body">
                    <div class="stat-card-bg"></div>
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="flex-shrink-0">
                            <div class="stat-icon stat-icon-info">
                                <i class="ti ti-settings"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="stat-label mb-0">Diproses</h6>
                            <p class="stat-value mb-0">
                                {{ $pengajuans->where('status', 'Diproses')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-selesai border-0">
                <div class="card-body">
                    <div class="stat-card-bg"></div>
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="flex-shrink-0">
                            <div class="stat-icon stat-icon-success">
                                <i class="ti ti-circle-check"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="stat-label mb-0">Selesai</h6>
                            <p class="stat-value mb-0">
                                {{ $pengajuans->where('status', 'Selesai')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card stat-card stat-card-ditolak border-0">
                <div class="card-body">
                    <div class="stat-card-bg"></div>
                    <div class="d-flex align-items-center position-relative" style="z-index: 1;">
                        <div class="flex-shrink-0">
                            <div class="stat-icon stat-icon-danger">
                                <i class="ti ti-x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="stat-label mb-0">Ditolak</h6>
                            <p class="stat-value mb-0">
                                {{ $pengajuans->where('status', 'Ditolak')->count() }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="col-sm-12">
            <div class="card main-card border-0">
                <div class="card-header-modern">
                    <div class="header-left">
                        <h5 class="card-title">
                            <i class="ti ti-list"></i> Daftar Pengajuan Surat Warga
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success-modern alert-dismissible fade show" role="alert">
                        <div class="alert-content">
                            <i class="ti ti-circle-check"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th class="col-num">No</th>
                                    <th>Nomor Pengajuan</th>
                                    <th>Nama Pemohon</th>
                                    <th>Jenis Surat</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th class="col-status">Status</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengajuans as $key => $pengajuan)
                                <tr class="table-row-modern">
                                    <td class="col-num">
                                        <span class="row-number">{{ $pengajuans->firstItem() + $key }}</span>
                                    </td>
                                    <td>
                                        <strong class="nomor-pengajuan">{{ $pengajuan->nomor_pengajuan }}</strong>
                                    </td>
                                    <td>
                                        <span class="pemohon-name">{{ $pengajuan->user->name }}</span>
                                    </td>
                                    <td>
                                        <span class="jenis-badge">{{ $pengajuan->jenis_surat }}</span>
                                    </td>
                                    <td>
                                        <span class="tanggal-text">
                                            <i class="ti ti-calendar"></i>
                                            {{ $pengajuan->created_at->format('d M Y') }}
                                        </span>
                                        <small class="text-muted d-block">{{ $pengajuan->created_at->format('H:i') }}</small>
                                    </td>
                                    <td class="col-status">
                                        <span class="badge status-badge {{ $pengajuan->status_badge }}">
                                            {{ $pengajuan->status }}
                                        </span>
                                    </td>
                                    <td class="col-action">
                                        <a href="{{ route('admin.pengajuan-surat.show', $pengajuan->id) }}" 
                                           class="btn-action btn-view" title="Detail & Proses">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        @if($pengajuan->surat_pengantar_rw)
                                        <a href="{{ route('admin.pengajuan-surat.download-pengantar', $pengajuan->id) }}" 
                                           class="btn-action btn-download" title="Download Surat Pengantar">
                                            <i class="ti ti-download"></i>
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-0">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <i class="ti ti-file-off"></i>
                                            </div>
                                            <p class="empty-state-title">Belum Ada Pengajuan Surat</p>
                                            <p class="empty-state-desc">Tidak ada pengajuan surat dari warga</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $pengajuans->links('vendor.pagination.modern') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   ADMIN PENGAJUAN SURAT INDEX - MODERN STYLING
   ============================================ */

/* Breadcrumb Modern */
.breadcrumb-modern {
    background: transparent !important;
    padding: 0 !important;
}

.breadcrumb-modern .breadcrumb {
    margin-bottom: 20px;
}

.breadcrumb-modern .breadcrumb-item {
    position: relative;
}

.breadcrumb-modern .breadcrumb-link {
    color: #4680ff;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.breadcrumb-modern .breadcrumb-link:hover {
    color: #357abd;
}

.breadcrumb-modern .breadcrumb-item.active {
    color: #6c757d;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* Page Header Content */
.page-header-content {
    margin: 0;
}

.page-title {
    font-size: 28px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
}

.page-title i {
    color: #4680ff;
    font-size: 32px;
}

.page-subtitle {
    color: #6c757d;
    font-size: 14px;
    margin: 0;
}

/* Stat Cards */
.stat-card {
    border-radius: 12px !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.85) !important;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
    backdrop-filter: blur(10px);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
}

.stat-card-bg {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 12px;
    z-index: 0;
}

.stat-card-menunggu .stat-card-bg {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
    opacity: 0.08;
}

.stat-card-diproses .stat-card-bg {
    background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
    opacity: 0.08;
}

.stat-card-selesai .stat-card-bg {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
    opacity: 0.08;
}

.stat-card-ditolak .stat-card-bg {
    background: linear-gradient(135deg, #ff5370 0%, #ff2d55 100%);
    opacity: 0.08;
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
}

.stat-icon-warning {
    background: linear-gradient(135deg, #ff9800 0%, #ff6f00 100%);
}

.stat-icon-info {
    background: linear-gradient(135deg, #00d4ff 0%, #00a8cc 100%);
}

.stat-icon-success {
    background: linear-gradient(135deg, #2ca87f 0%, #1e7e5d 100%);
}

.stat-icon-danger {
    background: linear-gradient(135deg, #ff5370 0%, #ff2d55 100%);
}

.stat-label {
    font-size: 13px;
    font-weight: 600;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 24px;
    font-weight: 700;
    color: #2c3e50;
}

/* Main Card */
.main-card {
    border-radius: 14px;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    background: rgba(255, 255, 255, 0.85) !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

/* Card Header Modern */
.card-header-modern {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(70, 128, 255, 0.05) 100%);
    border-bottom: 1px solid rgba(70, 128, 255, 0.1);
    padding: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-left .card-title {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.header-left .card-title i {
    color: #4680ff;
    font-size: 20px;
}

/* Alert Modern */
.alert-success-modern {
    border-radius: 10px;
    border: none;
    margin-bottom: 20px;
    padding: 14px 18px;
    backdrop-filter: blur(10px);
    background: rgba(44, 168, 127, 0.1);
    color: #2ca87f;
    border: 1px solid rgba(44, 168, 127, 0.2);
}

.alert-content {
    display: flex;
    align-items: center;
    gap: 10px;
    font-weight: 500;
}

.alert-content i {
    font-size: 18px;
}

/* Table Modern */
.table-modern {
    border-collapse: separate;
    border-spacing: 0 10px;
    margin-bottom: 0;
}

.table-modern thead th {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.08) 0%, rgba(44, 168, 127, 0.08) 100%);
    border: none;
    color: #4680ff;
    font-weight: 700;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 15px 12px;
}

.table-modern thead th:first-child {
    border-radius: 8px 0 0 0;
}

.table-modern thead th:last-child {
    border-radius: 0 8px 0 0;
}

.table-row-modern {
    background: rgba(255, 255, 255, 0.7);
    border: 1px solid rgba(70, 128, 255, 0.1);
    border-radius: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.table-row-modern:hover {
    background: rgba(70, 128, 255, 0.08);
    box-shadow: 0 8px 20px rgba(70, 128, 255, 0.1);
    transform: translateX(4px);
}

.table-modern td {
    border: none;
    padding: 16px 12px;
    vertical-align: middle;
}

.table-modern td:first-child {
    border-radius: 8px 0 0 8px;
}

.table-modern td:last-child {
    border-radius: 0 8px 8px 0;
}

.row-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    color: white;
    border-radius: 6px;
    font-weight: 600;
    font-size: 12px;
}

.nomor-pengajuan {
    color: #2c3e50;
    font-size: 14px;
}

.pemohon-name {
    color: #2c3e50;
    font-size: 14px;
    font-weight: 500;
}

.jenis-badge {
    background: rgba(70, 128, 255, 0.1);
    color: #4680ff;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    display: inline-block;
}

.tanggal-text {
    color: #6c757d;
    font-size: 14px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.tanggal-text i {
    color: #4680ff;
}

/* Status Badge */
.status-badge {
    padding: 6px 12px !important;
    border-radius: 20px !important;
    font-weight: 600 !important;
    font-size: 11px !important;
}

/* Button Action */
.btn-action {
    width: 36px;
    height: 36px;
    border-radius: 8px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    font-size: 16px;
    margin-right: 8px;
}

.btn-view {
    background: rgba(0, 212, 255, 0.15);
    color: #00d4ff;
}

.btn-view:hover {
    background: rgba(0, 212, 255, 0.25);
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.2);
    transform: translateY(-2px);
}

.btn-download {
    background: rgba(44, 168, 127, 0.15);
    color: #2ca87f;
}

.btn-download:hover {
    background: rgba(44, 168, 127, 0.25);
    box-shadow: 0 4px 12px rgba(44, 168, 127, 0.2);
    transform: translateY(-2px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 60px 30px;
}

.empty-state-icon {
    font-size: 80px;
    color: rgba(70, 128, 255, 0.2);
    margin-bottom: 20px;
}

.empty-state-title {
    font-size: 18px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
}

.empty-state-desc {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 0;
}

/* Pagination Wrapper */
.pagination-wrapper {
    margin-top: 32px;
    padding-top: 24px;
    border-top: 1px solid rgba(70, 128, 255, 0.08);
}

.pagination-modern {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.pagination-info {
    flex-shrink: 0;
}

.pagination-text {
    font-size: 13px;
    color: #6c757d;
    font-weight: 500;
}

.pagination-text strong {
    color: #2c3e50;
    font-weight: 700;
}

.pagination {
    display: flex;
    list-style: none;
    gap: 6px;
    margin: 0;
    padding: 0;
    flex-wrap: wrap;
}

.page-item {
    display: inline-block;
}

.page-item .page-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 8px;
    border-radius: 6px;
    border: 1px solid rgba(70, 128, 255, 0.2);
    color: #4680ff;
    background: rgba(255, 255, 255, 0.6);
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    text-decoration: none;
}

.page-item .page-link:hover:not(.disabled) {
    background: rgba(70, 128, 255, 0.15);
    border-color: #4680ff;
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.15);
    transform: translateY(-2px);
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    border-color: #4680ff;
    color: white;
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.3);
    font-weight: 600;
}

.page-item.disabled .page-link,
.page-item .page-link.disabled {
    opacity: 0.4;
    cursor: not-allowed;
    background: rgba(70, 128, 255, 0.03);
    color: #b0b8c1;
    border-color: rgba(70, 128, 255, 0.1);
}

.page-item .page-link i {
    font-size: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 22px;
    }
    
    .table-responsive {
        font-size: 13px;
    }
    
    .pagination-modern {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .pagination-info {
        text-align: center;
    }
    
    .pagination {
        justify-content: center;
    }
}
</style>
@endsection