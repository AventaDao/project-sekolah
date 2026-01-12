@extends('layouts.landing')

<<<<<<< HEAD
@section('title', 'Pratayang TTD - ' . $pengajuanSurat->jenis_surat)
=======
@section('title', 'Verifikasi TTD - ' . $pengajuanSurat->jenis_surat)
>>>>>>> 13a5b85c94fa608d49215e890d83d237c858177b

@section('content')
<div class="pc-content" style="padding: 40px 0; background-color: #f8f9fa; min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
<<<<<<< HEAD
            <div class="col-lg-10">
                <!-- Header Section -->
                <div class="mb-4">
                    <h3 class="fw-bold text-primary mb-2">Pratayang TTD Lembar {{ $pengajuanSurat->jenis_surat }}</h3>
                    <p class="text-muted mb-3">Validasi dokumen {{ $pengajuanSurat->jenis_surat }}</p>
                    <a href="/" class="text-decoration-none">
                        <i class="ti ti-home me-1"></i>Beranda
                    </a>
                </div>

                <!-- Profil Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary mb-3">Profil Pemohon</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                        <p class="fw-bold mb-0">{{ $pengajuanSurat->user->nama_lengkap ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <small class="text-muted d-block mb-1">NIK</small>
                                        <p class="fw-bold mb-0">{{ $pengajuanSurat->user->nik ?? '-' }}</p>
                                    </div>
                                </div>
=======
            <div class="col-lg-8">
                <!-- White Container -->
                <div class="bg-white rounded shadow-sm p-5">
                    <!-- Breadcrumb -->
                    <div class="mb-4">
                        <p class="text-muted small mb-0">
                            <a href="/" class="text-decoration-none text-muted">
                                <i class="ti ti-home me-1"></i> Beranda
                            </a>
                        </p>
                    </div>

                    <!-- Title -->
                    <h4 class="mb-2 fw-bold text-dark">Pratayang TTD {{ $pengajuanSurat->jenis_surat }}</h4>
                    <p class="text-muted small mb-4 pb-3" style="border-bottom: 2px solid #e9ecef;">
                        Validasi dokumen {{ $pengajuanSurat->jenis_surat }}
                    </p>

                    <!-- Section: Detail Pengajuan -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-4">
                            <i class="ti ti-file-text me-2"></i> Detail Pengajuan
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nama Pengajuan</small>
                                <p class="mb-0 fw-500">{{ $pengajuanSurat->jenis_surat }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Tanggal Pengajuan</small>
                                <p class="mb-0 fw-500">{{ $pengajuanSurat->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nomor Pengajuan</small>
                                <p class="mb-0 fw-500">{{ $pengajuanSurat->nomor_pengajuan }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Status</small>
                                <p class="mb-0">
                                    <span class="badge {{ $pengajuanSurat->status_badge }}">
                                        {{ $pengajuanSurat->status }}
                                    </span>
                                </p>
>>>>>>> 13a5b85c94fa608d49215e890d83d237c858177b
                            </div>
                        </div>
                    </div>

<<<<<<< HEAD
                        @if($pengajuanSurat->user->alamat || $pengajuanSurat->user->no_telepon)
                        <div class="row mb-3">
                            @if($pengajuanSurat->user->alamat)
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Alamat</small>
                                <p class="mb-0">{{ $pengajuanSurat->user->alamat }}</p>
                            </div>
                            @endif
                            @if($pengajuanSurat->user->no_telepon)
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">No. Telepon</small>
                                <p class="fw-bold mb-0">{{ $pengajuanSurat->user->no_telepon }}</p>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Data Pengajuan Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary mb-3">Data Pengajuan</h5>
                        
                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Jenis Surat</small>
                                <p class="fw-bold mb-0">{{ $pengajuanSurat->jenis_surat }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Nomor Pengajuan</small>
                                <p class="fw-bold mb-0">{{ $pengajuanSurat->nomor_pengajuan }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Tanggal Pengajuan</small>
                                <p class="mb-0">{{ $pengajuanSurat->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Status Pengajuan</small>
                                <p class="mb-0"><span class="badge {{ $pengajuanSurat->status_badge }}">{{ $pengajuanSurat->status }}</span></p>
=======
                    <hr style="background-color: #e9ecef; height: 1px; border: none;">

                    <!-- Section: Data Pemohon -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-4">
                            <i class="ti ti-user me-2"></i> Data Pemohon
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nama Lengkap</small>
                                <p class="mb-0 fw-500">{{ $pengajuanSurat->user->nama_lengkap ?? '-' }}</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">NIK</small>
                                <p class="mb-0 fw-500">{{ $pengajuanSurat->user->nik ?? '-' }}</p>
>>>>>>> 13a5b85c94fa608d49215e890d83d237c858177b
                            </div>
                        </div>
                    </div>

<<<<<<< HEAD
                        @if($pengajuanSurat->tanggal_selesai)
                        <div class="row">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-1">Tanggal Selesai</small>
                                <p class="mb-0">{{ $pengajuanSurat->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- TTD Pejabat Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold text-primary mb-3">TTD Pejabat</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Nama Lengkap</small>
                                <p class="fw-bold mb-0">Sugianto Kusuma</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <small class="text-muted d-block mb-1">Jabatan</small>
                                <p class="mb-0">Kepala Desa Kedung Kendo</p>
                            </div>
=======
                    <hr style="background-color: #e9ecef; height: 1px; border: none;">

                    <!-- Section: TTD Pejabat -->
                    <div class="mb-5">
                        <h6 class="fw-bold text-dark mb-4">
                            <i class="ti ti-signature me-2"></i> TTD Pejabat
                        </h6>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Nama Lengkap</small>
                                <p class="mb-0 fw-500">Sugianto Kusuma</p>
                            </div>
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Jabatan</small>
                                <p class="mb-0 fw-500">Kepala Desa</p>
                            </div>
                            @if($pengajuanSurat->tanggal_selesai)
                            <div class="col-md-6">
                                <small class="text-muted d-block mb-2">Tanggal TTD</small>
                                <p class="mb-0 fw-500">{{ $pengajuanSurat->tanggal_selesai->format('d M Y') }}</p>
                            </div>
                            @endif
>>>>>>> 13a5b85c94fa608d49215e890d83d237c858177b
                        </div>
                    </div>

                    <hr style="background-color: #e9ecef; height: 1px; border: none;">

                    <!-- Verification Message -->
                    <div class="alert alert-info mb-5 border-0">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-info-circle me-3 mt-1" style="font-size: 20px;"></i>
                            <div>
                                <strong class="d-block mb-2">Keaslian Surat</strong>
                                <small>Dokumen ini telah ditandatangani secara digital dan terverifikasi dalam sistem.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Action Button -->
                    <div class="d-flex gap-2 mb-4">
                        <a href="/" class="btn btn-primary">
                            <i class="ti ti-arrow-left me-2"></i> Kembali ke Beranda
                        </a>
                    </div>
                </div>

<<<<<<< HEAD
                <!-- Verification Success Alert -->
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert">
                    <i class="ti ti-circle-check me-2" style="font-size: 24px;"></i>
                    <div>
                        <strong>Surat Terverifikasi</strong>
                        <p class="mb-0 small">Dokumen ini telah ditandatangani secara digital dan terdaftar dalam sistem.</p>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="text-center mb-4">
                    <a href="/" class="btn btn-primary">
                        <i class="ti ti-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
=======
                <!-- Footer -->
                <div class="text-muted small text-center mt-5 pt-4">
                    <p class="mb-0">© 2026 Sistem Informasi Desa | versi: v1.0</p>
>>>>>>> 13a5b85c94fa608d49215e890d83d237c858177b
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="bg-light py-3 mt-5 text-center text-muted small">
    <div class="container">
        <p class="mb-0">© 2026 Sistem Informasi Desa | Verifikasi Surat Resmi</p>
    </div>
</footer>
@endsection
