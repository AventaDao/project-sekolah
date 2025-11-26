@extends('layouts.dashboard')
@section('title', 'Detail Pengaduan')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Detail Pengaduan</h5>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary btn-sm">
                        <i class="ti ti-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <!-- Status Badge -->
                    <div class="mb-4">
                        <span class="badge {{ $pengaduan->status_badge }} fs-6 px-3 py-2">
                            <i class="ti ti-circle-check me-1"></i> Status: {{ $pengaduan->status }}
                        </span>
                    </div>

                    <!-- Data Pengaduan -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Informasi Pengaduan</h5>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nomor Pengaduan</td>
                                    <td width="5%">:</td>
                                    <td><strong>{{ $pengaduan->nomor_pengaduan }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Kategori</td>
                                    <td>:</td>
                                    <td>
                                        <span class="badge bg-light text-dark">
                                            <i class="ti {{ $pengaduan->kategori_icon }} me-1"></i>
                                            {{ $pengaduan->kategori }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Pengaduan</td>
                                    <td>:</td>
                                    <td>{{ $pengaduan->created_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Status</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge {{ $pengaduan->status_badge }}">
                                            {{ $pengaduan->status }}
                                        </span>
                                    </td>
                                </tr>
                                @if($pengaduan->tanggal_tanggapan)
                                <tr>
                                    <td class="text-muted">Tanggal Tanggapan</td>
                                    <td>:</td>
                                    <td>{{ $pengaduan->tanggal_tanggapan->format('d F Y H:i') }} WIB</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td>{{ $pengaduan->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Judul -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Judul Pengaduan</h5>
                    <div class="mb-4">
                        <p class="lead mb-0">{{ $pengaduan->judul }}</p>
                    </div>

                    <!-- Timeline Status -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Tracking Status</h5>
                    <div class="mb-4">
                        <div class="timeline timeline-left">
                            <!-- Step 1: Pengaduan Diterima -->
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot bg-success">
                                    <i class="ti ti-check"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Pengaduan Diterima</strong></h6>
                                        <span class="badge bg-success ms-2">Selesai</span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-clock me-1"></i>
                                        {{ $pengaduan->created_at->format('d F Y H:i') }} WIB
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2: Diproses -->
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot {{ $pengaduan->tanggal_diproses ? 'bg-success' : 'bg-secondary' }}">
                                    <i class="ti {{ $pengaduan->tanggal_diproses ? 'ti-check' : 'ti-hourglass' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Dalam Proses</strong></h6>
                                        <span class="badge {{ $pengaduan->tanggal_diproses ? 'bg-success' : 'bg-secondary' }} ms-2">
                                            {{ $pengaduan->tanggal_diproses ? 'Selesai' : 'Menunggu' }}
                                        </span>
                                    </div>
                                    @if($pengaduan->tanggal_diproses)
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-clock me-1"></i>
                                            {{ $pengaduan->tanggal_diproses->format('d F Y H:i') }} WIB
                                        </p>
                                        <small class="text-muted">
                                            Waktu pemrosesan: {{ $pengaduan->tanggal_diproses->diffForHumans($pengaduan->created_at, ['parts' => 2]) }}
                                        </small>
                                    @else
                                        <p class="text-muted mb-0">
                                            <i class="ti ti-hourglass me-1"></i>
                                            Menunggu pemrosesan...
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Step 3: Selesai/Ditolak -->
                            @if($pengaduan->status === 'Selesai' || $pengaduan->status === 'Ditolak')
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot {{ $pengaduan->status === 'Selesai' ? 'bg-success' : 'bg-danger' }}">
                                    <i class="ti {{ $pengaduan->status === 'Selesai' ? 'ti-check' : 'ti-x' }}"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>{{ $pengaduan->status === 'Selesai' ? 'Selesai' : 'Ditolak' }}</strong></h6>
                                        <span class="badge {{ $pengaduan->status === 'Selesai' ? 'bg-success' : 'bg-danger' }} ms-2">
                                            {{ $pengaduan->status }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-clock me-1"></i>
                                        {{ ($pengaduan->status === 'Selesai' ? $pengaduan->tanggal_tanggapan : $pengaduan->tanggal_ditolak)->format('d F Y H:i') }} WIB
                                    </p>
                                    @if($pengaduan->tanggal_diproses && ($pengaduan->status === 'Selesai' ? $pengaduan->tanggal_tanggapan : $pengaduan->tanggal_ditolak))
                                        <small class="text-muted">
                                            Waktu penyelesaian: {{ ($pengaduan->status === 'Selesai' ? $pengaduan->tanggal_tanggapan : $pengaduan->tanggal_ditolak)->diffForHumans($pengaduan->tanggal_diproses, ['parts' => 2]) }}
                                        </small>
                                    @endif
                                </div>
                            </div>
                            @else
                            <div class="timeline-item">
                                <div class="timeline-bar"></div>
                                <div class="timeline-dot bg-secondary">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="d-flex align-items-center mb-1">
                                        <h6 class="mb-0"><strong>Selesai</strong></h6>
                                        <span class="badge bg-secondary ms-2">Menunggu</span>
                                    </div>
                                    <p class="text-muted mb-0">
                                        <i class="ti ti-hourglass me-1"></i>
                                        Menunggu penyelesaian...
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <style>
                        .timeline {
                            position: relative;
                            padding: 20px 0;
                        }

                        .timeline-left {
                            padding-left: 0;
                        }

                        .timeline-item {
                            display: flex;
                            margin-bottom: 30px;
                            position: relative;
                        }

                        .timeline-bar {
                            position: absolute;
                            left: 15px;
                            top: 50px;
                            width: 2px;
                            height: calc(100% + 30px);
                            background: #e0e0e0;
                        }

                        .timeline-item:last-child .timeline-bar {
                            display: none;
                        }

                        .timeline-dot {
                            min-width: 32px;
                            width: 32px;
                            height: 32px;
                            border-radius: 50%;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: white;
                            font-weight: bold;
                            z-index: 1;
                            flex-shrink: 0;
                        }

                        .timeline-content {
                            margin-left: 20px;
                            flex-grow: 1;
                        }

                        .timeline-content h6 {
                            font-size: 15px;
                            margin-bottom: 5px;
                        }

                        .timeline-content p {
                            font-size: 13px;
                            margin: 5px 0;
                        }

                        .timeline-content small {
                            font-size: 11px;
                            display: block;
                        }
                    </style>

                    <!-- Deskripsi -->
                    <h5 class="mb-3 text-primary border-bottom pb-2">Deskripsi</h5>
                    <div class="mb-4">
                        <p class="text-muted mb-0" style="white-space: pre-line; line-height: 1.8;">{{ $pengaduan->deskripsi }}</p>
                    </div>

                    <!-- Lampiran -->
                    @if($pengaduan->lampiran)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Lampiran</h5>
                    <div class="mb-4">
                        @php
                            $extension = pathinfo($pengaduan->lampiran, PATHINFO_EXTENSION);
                        @endphp
                        
                        @if(in_array($extension, ['jpg', 'jpeg', 'png']))
                        <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" 
                             alt="Lampiran" 
                             class="img-fluid rounded mb-2" 
                             style="max-height: 400px; cursor: pointer;"
                             onclick="window.open(this.src, '_blank')">
                        <p class="text-muted text-sm">Klik gambar untuk memperbesar</p>
                        @else
                        <div class="alert alert-info">
                            <i class="ti ti-file-text f-20 me-2"></i>
                            <strong>File PDF:</strong> {{ basename($pengaduan->lampiran) }}
                        </div>
                        @endif
                        
                        <a href="{{ route('pengaduan.download-lampiran', $pengaduan->id) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-download"></i> Download Lampiran
                        </a>
                    </div>
                    @endif

                    <!-- Tanggapan Admin -->
                    @if($pengaduan->tanggapan_admin)
                    <h5 class="mb-3 text-primary border-bottom pb-2">Tanggapan dari Admin</h5>
                    <div class="alert alert-success mb-4">
                        <div class="d-flex align-items-start">
                            <i class="ti ti-message-circle f-24 me-3"></i>
                            <div class="flex-grow-1">
                                <h6 class="alert-heading mb-2">Tanggapan:</h6>
                                <p class="mb-0" style="white-space: pre-line; line-height: 1.8;">{{ $pengaduan->tanggapan_admin }}</p>
                                @if($pengaduan->adminPenanggap)
                                <hr class="my-2">
                                <small class="text-muted">
                                    <strong>Ditanggapi oleh:</strong> {{ $pengaduan->adminPenanggap->name }}<br>
                                    <strong>Tanggal:</strong> {{ $pengaduan->tanggal_tanggapan->format('d F Y H:i') }} WIB
                                </small>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        <i class="ti ti-clock me-2"></i>
                        <strong>Pengaduan Anda sedang menunggu tanggapan dari admin.</strong>
                        <p class="mb-0 mt-2">Kami akan segera menindaklanjuti pengaduan Anda. Terima kasih atas kesabaran Anda.</p>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    @if($pengaduan->status === 'Menunggu')
                    <div class="mt-4 border-top pt-3">
                        <form action="{{ route('pengaduan.destroy', $pengaduan->id) }}" 
                              method="POST" 
                              onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengaduan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="ti ti-trash"></i> Batalkan Pengaduan
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection