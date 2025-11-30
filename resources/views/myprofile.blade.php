@extends('layouts.dashboard')

@section('title', 'My Profile')

@section('content')
    <style>
        /* Ensure avatar is always square and not stretched */
        .chat-avtar img {
            width: 70px !important;
            height: 70px !important;
            object-fit: cover !important;
            object-position: center !important;
        }
    </style>
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">User Profile</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">User Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-xxl-3">
                                <div class="card">
                                    <div class="card-body position-relative text-center">
                                        <div class="chat-avtar d-inline-flex mx-auto mb-3 mt-3">
                                            <img class="rounded-circle img-fluid wid-70"
                                                src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/avatar-default.png') }}"
                                                alt="{{ auth()->user()->nama_lengkap }}"
                                                onerror="this.src='{{ asset('assets/images/avatar-default.png') }}'">
                                        </div>
                                        <h5 class="mb-0">{{ auth()->user()->nama_lengkap }}</h5>
                                        <p class="text-muted text-sm">{{ auth()->user()->pekerjaan ?? 'N/A' }}</p>
                                        <hr class="my-3">
                                        <div class="mb-3">
                                            <i class="ti ti-mail me-2"></i>
                                            <p class="mb-0 text-truncate"><small>{{ auth()->user()->email }}</small></p>
                                        </div>
                                        <div class="mb-3">
                                            <i class="ti ti-phone me-2"></i>
                                            <p class="mb-0">{{ auth()->user()->no_telepon ?? 'N/A' }}</p>
                                        </div>
                                        <div class="mb-3">
                                            <i class="ti ti-id me-2"></i>
                                            <p class="mb-0">{{ auth()->user()->nik }}</p>
                                        </div>
                                        <hr class="my-3">
                                        <div class="mb-3">
                                            <span class="badge bg-primary">{{ ucfirst(auth()->user()->role) }}</span>
                                            @if(auth()->user()->is_verified)
                                                <span class="badge bg-success">Terverifikasi</span>
                                            @else
                                                <span class="badge bg-warning">Belum Terverifikasi</span>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm w-100">
                                                <i class="ti ti-edit me-1"></i> Edit Profil
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-xxl-9">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Pribadi</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Nama Lengkap</strong></p>
                                                <p class="mb-0">{{ auth()->user()->nama_lengkap }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>NIK</strong></p>
                                                <p class="mb-0">{{ auth()->user()->nik }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Tempat Lahir</strong></p>
                                                <p class="mb-0">{{ auth()->user()->tempat_lahir ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Tanggal Lahir</strong></p>
                                                <p class="mb-0">
                                                    @if(auth()->user()->tanggal_lahir)
                                                        {{ \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('d-m-Y') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Umur</strong></p>
                                                <p class="mb-0">
                                                    @if(auth()->user()->tanggal_lahir)
                                                        {{ \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->age }} tahun
                                                    @else
                                                        N/A
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Jenis Kelamin</strong></p>
                                                <p class="mb-0">
                                                    @if(auth()->user()->jenis_kelamin === 'L')
                                                        Laki-laki
                                                    @elseif(auth()->user()->jenis_kelamin === 'P')
                                                        Perempuan
                                                    @else
                                                        {{ auth()->user()->jenis_kelamin ?? 'N/A' }}
                                                    @endif
                                                </p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Agama</strong></p>
                                                <p class="mb-0">{{ auth()->user()->agama ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Status Perkawinan</strong></p>
                                                <p class="mb-0">{{ auth()->user()->status_perkawinan ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kewarganegaraan</strong></p>
                                                <p class="mb-0">{{ auth()->user()->kewarganegaraan ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Pekerjaan</strong></p>
                                                <p class="mb-0">{{ auth()->user()->pekerjaan ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Pendidikan Terakhir</strong></p>
                                                <p class="mb-0">{{ auth()->user()->pendidikan_terakhir ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Alamat</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Alamat Lengkap</strong></p>
                                                <p class="mb-0">{{ auth()->user()->alamat ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>RT</strong></p>
                                                <p class="mb-0">{{ auth()->user()->rt ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>RW</strong></p>
                                                <p class="mb-0">{{ auth()->user()->rw ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Desa</strong></p>
                                                <p class="mb-0">{{ auth()->user()->desa ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kecamatan</strong></p>
                                                <p class="mb-0">{{ auth()->user()->kecamatan ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kabupaten</strong></p>
                                                <p class="mb-0">{{ auth()->user()->kabupaten ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Provinsi</strong></p>
                                                <p class="mb-0">{{ auth()->user()->provinsi ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Kode Pos</strong></p>
                                                <p class="mb-0">{{ auth()->user()->kode_pos ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Identitas Orang Tua</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Nama Ayah</strong></p>
                                                <p class="mb-0">{{ auth()->user()->nama_ayah ?? 'N/A' }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Nama Ibu</strong></p>
                                                <p class="mb-0">{{ auth()->user()->nama_ibu ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h5>Informasi Kontak</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>Email</strong></p>
                                                <p class="mb-0">{{ auth()->user()->email }}</p>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <p class="text-muted text-sm mb-1"><strong>No. Telepon</strong></p>
                                                <p class="mb-0">{{ auth()->user()->no_telepon ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
@endsection
