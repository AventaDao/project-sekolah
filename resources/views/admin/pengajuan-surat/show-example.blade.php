{{-- 
    File: resources/views/admin/pengajuan-surat/show-example.blade.php
    
    Ini adalah contoh bagaimana menampilkan detail pengajuan surat dinamis
    di halaman admin dengan semua field spesifik berdasarkan jenis surat.
    
    COPY KE: resources/views/admin/pengajuan-surat/show.blade.php
--}}

@extends('layouts.dashboard')
@section('title', 'Detail Pengajuan Surat - Admin')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.pengajuan-surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item" aria-current="page">Detail</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <!-- Data Pemohon -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Data Pemohon</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%" class="text-muted">Nama</td>
                                    <td width="5%">:</td>
                                    <td><strong>{{ $pengajuanSurat->user->nama_lengkap }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">NIK</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->user->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Email</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->user->email }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="30%" class="text-muted">Alamat</td>
                                    <td width="5%">:</td>
                                    <td>{{ $pengajuanSurat->user->alamat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">RT/RW</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->user->rt }}/{{ $pengajuanSurat->user->rw }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Desa</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->user->desa }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Pengajuan -->
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Detail Pengajuan Surat</h5>
                    <span class="badge {{ $pengajuanSurat->status_badge }} fs-6 px-3 py-2">
                        {{ $pengajuanSurat->status }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Nomor Pengajuan</td>
                                    <td width="5%">:</td>
                                    <td><strong>{{ $pengajuanSurat->nomor_pengajuan }}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Jenis Surat</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->jenis_surat }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Tanggal Pengajuan</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->created_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td width="40%" class="text-muted">Status</td>
                                    <td width="5%">:</td>
                                    <td>
                                        <span class="badge {{ $pengajuanSurat->status_badge }}">
                                            {{ $pengajuanSurat->status }}
                                        </span>
                                    </td>
                                </tr>
                                @if($pengajuanSurat->tanggal_selesai)
                                <tr>
                                    <td class="text-muted">Tanggal Selesai</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->tanggal_selesai->format('d F Y H:i') }} WIB</td>
                                </tr>
                                @endif
                                <tr>
                                    <td class="text-muted">Terakhir Diupdate</td>
                                    <td>:</td>
                                    <td>{{ $pengajuanSurat->updated_at->format('d F Y H:i') }} WIB</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Keperluan -->
                    <div class="mt-3 pt-3 border-top">
                        <h6 class="text-muted mb-2">Keperluan</h6>
                        <p class="mb-0">{{ $pengajuanSurat->keperluan }}</p>
                    </div>
                </div>
            </div>

            <!-- Detail Spesifik Surat (Dinamis) -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Detail {{ $pengajuanSurat->jenis_surat }}</h5>
                </div>
                <div class="card-body">
                    @php
                        $suratTypes = \App\Models\PengajuanSurat::getSuratTypes();
                        $fields = $suratTypes[$pengajuanSurat->jenis_surat]['fields'] ?? [];
                        $filledFields = $pengajuanSurat->getFilledFields();
                    @endphp

                    @if(count($filledFields) > 0)
                        <table class="table table-striped">
                            <tbody>
                                @foreach($filledFields as $fieldName => $field)
                                <tr>
                                    <td width="30%" class="text-muted fw-bold">{{ $field['label'] }}</td>
                                    <td width="70%">
                                        @if($field['type'] === 'textarea')
                                            <p class="mb-0" style="white-space: pre-wrap;">{{ $field['value'] }}</p>
                                        @else
                                            {{ $field['formatted_value'] }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Tidak ada detail spesifik untuk jenis surat ini.</p>
                    @endif
                </div>
            </div>

            <!-- Dokumen Pendukung -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Dokumen Pendukung</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="mb-2">Surat Pengantar RW</h6>
                        <a href="{{ route('pengajuan-surat.download-pengantar', $pengajuanSurat->id) }}" 
                           class="btn btn-outline-primary btn-sm">
                            <i class="ti ti-download"></i> Download
                        </a>
                    </div>

                    @if($pengajuanSurat->file_surat_jadi)
                    <div class="mt-3 pt-3 border-top">
                        <h6 class="mb-2">Surat Jadi</h6>
                        <a href="{{ route('pengajuan-surat.download-surat-jadi', $pengajuanSurat->id) }}" 
                           class="btn btn-success btn-sm">
                            <i class="ti ti-download"></i> Download Surat Jadi
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Catatan Tambahan -->
            @if($pengajuanSurat->keterangan_tambahan)
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Keterangan Tambahan dari Pemohon</h5>
                </div>
                <div class="card-body">
                    <p class="mb-0">{{ $pengajuanSurat->keterangan_tambahan }}</p>
                </div>
            </div>
            @endif

            <!-- Form Update Status -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Update Status & Catatan</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <strong>Error:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('pengajuan-surat.update-status', $pengajuanSurat->id) }}" 
                          method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Menunggu" {{ $pengajuanSurat->status === 'Menunggu' ? 'selected' : '' }}>
                                        Menunggu
                                    </option>
                                    <option value="Diproses" {{ $pengajuanSurat->status === 'Diproses' ? 'selected' : '' }}>
                                        Diproses
                                    </option>
                                    <option value="Selesai" {{ $pengajuanSurat->status === 'Selesai' ? 'selected' : '' }}>
                                        Selesai
                                    </option>
                                    <option value="Ditolak" {{ $pengajuanSurat->status === 'Ditolak' ? 'selected' : '' }}>
                                        Ditolak
                                    </option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Catatan Admin</label>
                                <textarea name="catatan_admin" class="form-control @error('catatan_admin') is-invalid @enderror" 
                                          rows="4" placeholder="Masukkan catatan untuk pemohon...">{{ $pengajuanSurat->catatan_admin }}</textarea>
                                @error('catatan_admin')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="form-label">Upload Surat Jadi (Jika Status = Selesai)</label>
                                <input type="file" name="file_surat_jadi" 
                                       class="form-control @error('file_surat_jadi') is-invalid @enderror"
                                       accept=".pdf">
                                @error('file_surat_jadi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Format: PDF. Max: 5MB</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">
                                    <i class="ti ti-check"></i> Update Status
                                </button>
                                <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn btn-secondary">
                                    <i class="ti ti-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Catatan Admin -->
            @if($pengajuanSurat->catatan_admin)
            <div class="card">
                <div class="card-header">
                    <h5>Catatan Admin Terakhir</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <i class="ti ti-info-circle me-2"></i>
                        {{ $pengajuanSurat->catatan_admin }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
