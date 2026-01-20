@extends('layouts.dashboard')
@section('title', 'Pengaduan Saya')

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
                                <i class="ti ti-message-circle"></i> Pengaduan Saya
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-12">
                    <div class="page-header-content">
                        <h2 class="page-title">
                            <i class="ti ti-message-circle"></i> Pengaduan Saya
                        </h2>
                        <p class="page-subtitle">Kelola semua pengaduan Anda dengan mudah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Info Card dengan Gradient -->
            <div class="card info-card border-0 mb-3">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <div class="info-icon">
                            <i class="ti ti-info-circle"></i>
                        </div>
                        <div class="info-content">
                            <h5 class="info-title">Informasi Pengaduan</h5>
                            <p class="info-text">
                                Anda dapat melaporkan kendala sistem, meminta bantuan, atau melaporkan kejadian lapangan melalui fitur ini. 
                                Tim kami akan menanggapi pengaduan Anda secepatnya.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="card main-card border-0">
                <!-- Card Header -->
                <div class="card-header-modern">
                    <div class="header-left">
                        <h5 class="card-title">
                            <i class="ti ti-list"></i> Daftar Pengaduan
                        </h5>
                    </div>
                    <div class="header-right">
                        <a href="{{ route('pengaduan.create') }}" class="btn btn-create-new">
                            <i class="ti ti-plus"></i> Buat Pengaduan Baru
                        </a>
                    </div>
                </div>

                <!-- Card Body -->
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

                    @if(session('error'))
                    <div class="alert alert-danger-modern alert-dismissible fade show" role="alert">
                        <div class="alert-content">
                            <i class="ti ti-alert-circle"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-modern">
                            <thead>
                                <tr>
                                    <th class="col-num">No</th>
                                    <th>Nomor Pengaduan</th>
                                    <th>Kategori</th>
                                    <th>Judul</th>
                                    <th>Tanggal</th>
                                    <th class="col-status">Status</th>
                                    <th class="col-action">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduans as $key => $pengaduan)
                                <tr class="table-row-modern">
                                    <td class="col-num">
                                        <span class="row-number">{{ $pengaduans->firstItem() + $key }}</span>
                                    </td>
                                    <td>
                                        <strong class="nomor-pengaduan">{{ $pengaduan->nomor_pengaduan }}</strong>
                                    </td>
                                    <td>
                                        <span class="kategori-badge">
                                            <i class="ti {{ $pengaduan->kategori_icon }}"></i>
                                            {{ Str::limit($pengaduan->kategori, 20) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="judul-text">{{ Str::limit($pengaduan->judul, 40) }}</span>
                                    </td>
                                    <td>
                                        <span class="tanggal-text">
                                            <i class="ti ti-calendar"></i>
                                            {{ $pengaduan->created_at->format('d M Y') }}
                                        </span>
                                        <small class="text-muted d-block">{{ $pengaduan->created_at->format('H:i') }}</small>
                                    </td>
                                    <td class="col-status">
                                        <span class="badge status-badge {{ $pengaduan->status_badge }}">
                                            {{ $pengaduan->status }}
                                        </span>
                                    </td>
                                    <td class="col-action">
                                        <div class="btn-group-modern" role="group">
                                            <a href="{{ route('pengaduan.show', $pengaduan->id) }}" 
                                               class="btn-action btn-view" title="Lihat Detail">
                                                <i class="ti ti-eye"></i>
                                            </a>

                                            @if($pengaduan->status === 'Menunggu')
                                            <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" 
                                                  method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-0">
                                        <div class="empty-state">
                                            <div class="empty-state-icon">
                                                <i class="ti ti-message-off"></i>
                                            </div>
                                            <p class="empty-state-title">Belum Ada Pengaduan</p>
                                            <p class="empty-state-desc">Mulai dengan membuat pengaduan baru</p>
                                            <a href="{{ route('pengaduan.create') }}" class="btn btn-create-empty">
                                                <i class="ti ti-plus"></i> Buat Pengaduan Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{ $pengaduans->links('vendor.pagination.modern') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   PENGADUAN INDEX - MODERN STYLING
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

/* Info Card dengan Gradient */
.info-card {
    background: linear-gradient(135deg, rgba(70, 128, 255, 0.1) 0%, rgba(44, 168, 127, 0.1) 100%) !important;
    border: 1px solid rgba(70, 128, 255, 0.2) !important;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(70, 128, 255, 0.08);
    backdrop-filter: blur(10px);
}

.info-icon {
    width: 50px;
    height: 50px;
    min-width: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-right: 20px;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
}

.info-content {
    flex: 1;
}

.info-title {
    font-size: 16px;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 8px;
}

.info-text {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 0;
    line-height: 1.6;
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

/* Button Create New */
.btn-create-new {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.btn-create-new:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(70, 128, 255, 0.35);
    color: white;
}

/* Alert Modern */
.alert-success-modern,
.alert-danger-modern {
    border-radius: 10px;
    border: none;
    margin-bottom: 20px;
    padding: 14px 18px;
    backdrop-filter: blur(10px);
}

.alert-success-modern {
    background: rgba(44, 168, 127, 0.1);
    color: #2ca87f;
    border: 1px solid rgba(44, 168, 127, 0.2);
}

.alert-danger-modern {
    background: rgba(255, 83, 112, 0.1);
    color: #ff5370;
    border: 1px solid rgba(255, 83, 112, 0.2);
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
    border-radius: 8px 0 0 8px;
}

.table-modern thead th:last-child {
    border-radius: 0 8px 8px 0;
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

.nomor-pengaduan {
    color: #2c3e50;
    font-size: 14px;
}

.kategori-badge {
    background: rgba(70, 128, 255, 0.1);
    color: #4680ff;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.kategori-badge i {
    font-size: 14px;
}

.judul-text {
    color: #2c3e50;
    font-size: 14px;
    font-weight: 500;
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

/* Button Group Modern */
.btn-group-modern {
    display: flex;
    gap: 6px;
}

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

.btn-delete {
    background: rgba(255, 83, 112, 0.15);
    color: #ff5370;
}

.btn-delete:hover {
    background: rgba(255, 83, 112, 0.25);
    box-shadow: 0 4px 12px rgba(255, 83, 112, 0.2);
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
    margin-bottom: 20px;
}

.btn-create-empty {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    border: none;
    color: white;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
}

.btn-create-empty:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(70, 128, 255, 0.35);
    color: white;
}

/* Pagination Wrapper */
.pagination-wrapper {
    margin-top: 24px;
    display: flex;
    justify-content: flex-end;
}

.pagination-wrapper .pagination {
    gap: 6px;
}

.pagination-wrapper .page-item .page-link {
    border-radius: 6px;
    border: 1px solid rgba(70, 128, 255, 0.2);
    color: #4680ff;
    background: rgba(70, 128, 255, 0.05);
    transition: all 0.3s ease;
}

.pagination-wrapper .page-item .page-link:hover {
    background: rgba(70, 128, 255, 0.15);
    border-color: #4680ff;
}

.pagination-wrapper .page-item.active .page-link {
    background: linear-gradient(135deg, #4680ff 0%, #357abd 100%);
    border-color: #4680ff;
    box-shadow: 0 4px 12px rgba(70, 128, 255, 0.25);
}

/* Responsive */
@media (max-width: 768px) {
    .header-right {
        margin-top: 15px;
    }
    
    .btn-create-new {
        width: 100%;
        justify-content: center;
    }
    
    .card-header-modern {
        flex-direction: column;
        gap: 15px;
    }
    
    .page-title {
        font-size: 22px;
    }
    
    .table-responsive {
        font-size: 13px;
    }
}
</style>
@endsection