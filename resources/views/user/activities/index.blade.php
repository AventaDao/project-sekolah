@extends('layouts.dashboard')

@section('title', 'Riwayat Aktivitas')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page">Riwayat Aktivitas</li>
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
                    <h5>Riwayat Aktivitas Anda</h5>
                </div>
                <div class="card-body">
                    @if($activities && count($activities) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No.</th>
                                        <th style="width: 20%;">Aktivitas</th>
                                        <th style="width: 40%;">Deskripsi</th>
                                        <th style="width: 18%;">Waktu</th>
                                        <th style="width: 15%;">IP Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $key => $activity)
                                    <tr>
                                        <td>
                                            <strong>{{ $key + 1 }}</strong>
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
                                            {{ $activity['description'] ?? $activity['message'] ?? 'N/A' }}
                                            @if(!empty($activity['login_method']))
                                            <small class="text-muted d-block">Metode: {{ ucfirst(str_replace('_', ' ', $activity['login_method'])) }}</small>
                                            @endif
                                            @if(!empty($activity['role']))
                                            <small class="text-muted d-block">Role: {{ ucfirst($activity['role']) }}</small>
                                            @endif
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
                            Belum ada aktivitas yang tercatat untuk Anda di Firebase.
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
@endsection
