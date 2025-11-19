@extends('layouts.dashboard')
@section('title', 'Absensi Saya')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <h3>Absensi - {{ $karyawan->nama }}</h3>
    </div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('karyawan.absensi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Jenis Absen</label>
                            <select name="jenis" class="form-select" required>
                                <option value="Datang">Datang</option>
                                <option value="Pulang">Pulang</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Foto Selfie</label>
                            <input type="file" name="foto" class="form-control" accept="image/*" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jam (HH:MM)</label>
                            <input type="time" name="jam" class="form-control" value="{{ now()->format('H:i') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Lokasi (opsional)</label>
                            <input type="text" name="lokasi" class="form-control">
                        </div>

                        <div>
                            <button class="btn btn-primary" type="submit">Kirim Absensi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5>Status Hari Ini</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Absen Datang
                            @if($absenDatang)
                                <span class="badge bg-success">Sudah ({{ \Carbon\Carbon::parse($absenDatang->jam)->format('H:i') }})</span>
                            @else
                                <span class="badge bg-warning">Belum</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Absen Pulang
                            @if($absenPulang)
                                <span class="badge bg-success">Sudah ({{ \Carbon\Carbon::parse($absenPulang->jam)->format('H:i') }})</span>
                            @else
                                <span class="badge bg-warning">Belum</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
