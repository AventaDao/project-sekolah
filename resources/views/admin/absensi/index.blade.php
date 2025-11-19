@extends('layouts.dashboard')
@section('title', 'Absensi Karyawan')

@section('content')
<div class="pc-content">
    <div class="page-header">
        <h3>Absensi Karyawan - {{ \Illuminate\Support\Carbon::parse($today)->format('d F Y') }}</h3>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.absensi.index') }}" class="d-flex gap-2">
                        <input type="date" name="tanggal" value="{{ $today }}" class="form-control" style="max-width: 200px;">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Reset</a>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <small class="text-muted">
                        <i class="ti ti-info-circle me-1"></i>
                        Data absensi direset setiap hari pada jam 00:00
                    </small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Datang</th>
                        <th>Pulang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $k)
                    @php
                        $datang = $k->absensis->firstWhere('jenis', 'Datang');
                        $pulang = $k->absensis->firstWhere('jenis', 'Pulang');
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama }}</td>
                        <td>{{ $k->jabatan }}</td>
                        <td>
                            @if($datang)
                                <span class="badge bg-success">Sudah ({{ \Carbon\Carbon::parse($datang->jam)->format('H:i') }})</span>
                            @else
                                <span class="badge bg-warning">Belum</span>
                            @endif
                        </td>
                        <td>
                            @if($pulang)
                                <span class="badge bg-success">Sudah ({{ \Carbon\Carbon::parse($pulang->jam)->format('H:i') }})</span>
                            @else
                                <span class="badge bg-warning">Belum</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
