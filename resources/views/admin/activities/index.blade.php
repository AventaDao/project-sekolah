@extends('layouts.dashboard')

@section('title', 'Riwayat Aktivitas User')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Riwayat Aktivitas User</li>
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
                    <h5>Riwayat Aktivitas Semua User</h5>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#clearLogsModal">
                        <i class="ti ti-trash"></i> Clear Logs
                    </button>
                </div>
                <div class="card-body">
                    @if($activities && count($activities) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 4%;">No.</th>
                                        <th style="width: 15%;">Pengguna</th>
                                        <th style="width: 12%;">Aktivitas</th>
                                        <th style="width: 35%;">Deskripsi</th>
                                        <th style="width: 16%;">Waktu</th>
                                        <th style="width: 12%;">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $key => $activity)
                                    <tr>
                                        <td>
                                            <strong>{{ $key + 1 }}</strong>
                                        </td>
                                        <td>
                                            <!-- Info Pengguna (Admin atau User) -->
                                            <div>
                                                <strong>{{ $activity['user_name'] ?? $activity['user_email'] ?? 'Unknown' }}</strong>
                                                @if(!empty($activity['role']))
                                                    <br><span class="badge {{ $activity['role'] === 'admin' ? 'bg-danger' : 'bg-info' }}">
                                                        {{ ucfirst($activity['role']) }}
                                                    </span>
                                                @endif
                                                @if(!empty($activity['user_id']))
                                                    <br><small class="text-muted">ID: {{ $activity['user_id'] }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @php
                                                $badgeClass = match($activity['type'] ?? '') {
                                                    'authentication' => 'bg-success',
                                                    'document' => 'bg-primary',
                                                    'approval' => 'bg-warning',
                                                    'user' => 'bg-info',
                                                    'form' => 'bg-secondary',
                                                    default => 'bg-light text-dark'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ ucfirst($activity['action'] ?? 'Unknown') }}
                                            </span>
                                        </td>
                                        <td>
                                            <div>
                                                {{ $activity['description'] ?? $activity['message'] ?? 'N/A' }}
                                                @if(!empty($activity['login_method']))
                                                    <br><small class="text-muted">📱 Metode: {{ ucfirst(str_replace('_', ' ', $activity['login_method'])) }}</small>
                                                @endif
                                                @if(!empty($activity['nik']))
                                                    <br><small class="text-muted">📄 NIK: {{ $activity['nik'] }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <small>
                                                @if($activity['timestamp'])
                                                    @php
                                                        $timestamp = $activity['timestamp'];
                                                        if (is_string($timestamp)) {
                                                            $timestamp = \Carbon\Carbon::parse($timestamp);
                                                        }
                                                        echo $timestamp->diffForHumans();
                                                    @endphp
                                                    <br>
                                                    {{ $timestamp->format('d M Y H:i') ?? 'N/A' }}
                                                @endif
                                            </small>
                                        </td>
                                        <td>
                                            <code>{{ $activity['ip_address'] ?? 'N/A' }}</code>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <strong>Tidak ada data aktivitas</strong><br>
                            Belum ada aktivitas yang tercatat di Firebase.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    tr.cursor-pointer {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    
    tr.cursor-pointer:hover {
        background-color: #f5f5f5;
    }
</style>

<!-- Clear Logs Confirmation Modal -->
<div class="modal fade" id="clearLogsModal" tabindex="-1" role="dialog" aria-labelledby="clearLogsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="clearLogsModalLabel">
                    <i class="ti ti-alert-triangle me-2"></i>Konfirmasi Hapus Logs
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning mb-3">
                    <i class="ti ti-alert-circle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan. Semua activity logs akan dihapus permanen dari sistem.
                </div>
                <p>Apakah Anda yakin ingin menghapus <strong>semua activity logs</strong>? Data yang dihapus tidak dapat dipulihkan kembali.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form action="{{ route('admin.activities.clear-logs') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">
                        <i class="ti ti-trash me-1"></i>Ya, Hapus Semua Logs
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
