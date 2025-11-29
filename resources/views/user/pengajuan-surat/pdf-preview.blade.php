@extends('layouts.dashboard')
@section('title', 'Print Preview - ' . $pengajuanSurat->nomor_pengajuan)

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengajuan-surat.index') }}">Pengajuan Surat</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('pengajuan-surat.show', $pengajuanSurat->id) }}">Detail</a></li>
                        <li class="breadcrumb-item" aria-current="page">Print Preview</li>
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
                    <h5>Preview Cetak Pengajuan Surat</h5>
                    <div>
                        <button class="btn btn-primary btn-sm" onclick="window.print()">
                            <i class="ti ti-printer me-1"></i> Cetak / Print
                        </button>
                        <a href="{{ route('pengajuan-surat.show', $pengajuanSurat->id) }}" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Print Content -->
                    <div id="printContent" style="background: white; padding: 40px; min-height: 800px;">
                        <!-- Header -->
                        <div style="text-align: center; border-bottom: 3px solid #333; padding-bottom: 20px; margin-bottom: 30px;">
                            <h1 style="font-size: 24px; margin-bottom: 5px;">LAPORAN PENGAJUAN SURAT</h1>
                            <p style="font-size: 14px; color: #666; margin: 0;">Sistem Informasi Desa Candi</p>
                        </div>

                        <!-- Nomor Pengajuan -->
                        <div style="margin-bottom: 25px;">
                            <div style="margin-bottom: 12px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Nomor Pengajuan</span>
                                <span>: <strong>{{ $pengajuanSurat->nomor_pengajuan }}</strong></span>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Status</span>
                                <span>:
                                    @if($pengajuanSurat->status == 'Menunggu')
                                        <span style="background-color: #f4bd0e; color: #333; padding: 3px 8px; border-radius: 3px; font-weight: bold;">{{ $pengajuanSurat->status }}</span>
                                    @elseif($pengajuanSurat->status == 'Diproses')
                                        <span style="background-color: #1ea8e0; color: white; padding: 3px 8px; border-radius: 3px; font-weight: bold;">{{ $pengajuanSurat->status }}</span>
                                    @elseif($pengajuanSurat->status == 'Selesai')
                                        <span style="background-color: #2ca87f; color: white; padding: 3px 8px; border-radius: 3px; font-weight: bold;">{{ $pengajuanSurat->status }}</span>
                                    @else
                                        {{ $pengajuanSurat->status }}
                                    @endif
                                </span>
                            </div>
                            <div style="margin-bottom: 12px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Tanggal Pengajuan</span>
                                <span>: {{ $pengajuanSurat->created_at->format('d F Y H:i') }} WIB</span>
                            </div>
                        </div>

                        <div style="border-top: 1px solid #ddd; margin: 20px 0;"></div>

                        <!-- Data Pemohon -->
                        <div style="margin-bottom: 25px;">
                            <div style="background-color: #f0f0f0; padding: 10px 15px; font-weight: bold; border-left: 4px solid #4680ff; margin-bottom: 15px;">
                                Data Pemohon
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">NIK</span>
                                <span>: {{ $user->nik ?? '-' }}</span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Nama Lengkap</span>
                                <span>: {{ $user->nama_lengkap ?? '-' }}</span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">No. Telepon</span>
                                <span>: {{ $user->no_telepon ?? '-' }}</span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Email</span>
                                <span>: {{ $user->email ?? '-' }}</span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Alamat</span>
                                <span>: {{ $user->alamat ?? '-' }} RT {{ $user->rt ?? '-' }} RW {{ $user->rw ?? '-' }}</span>
                            </div>
                        </div>

                        <div style="border-top: 1px solid #ddd; margin: 20px 0;"></div>

                        <!-- Informasi Surat -->
                        <div style="margin-bottom: 25px;">
                            <div style="background-color: #f0f0f0; padding: 10px 15px; font-weight: bold; border-left: 4px solid #4680ff; margin-bottom: 15px;">
                                Informasi Surat
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Jenis Surat</span>
                                <span>: <strong>{{ $pengajuanSurat->jenis_surat }}</strong></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Keperluan</span>
                                <span>: {{ $pengajuanSurat->keperluan ?? '-' }}</span>
                            </div>
                            @if($pengajuanSurat->keterangan_tambahan)
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Keterangan Tambahan</span>
                                <span>: {{ $pengajuanSurat->keterangan_tambahan }}</span>
                            </div>
                            @endif
                        </div>

                        <!-- Dynamic Fields -->
                        @if($pengajuanSurat->dynamic_fields && count(json_decode($pengajuanSurat->dynamic_fields, true)) > 0)
                        <div style="border-top: 1px solid #ddd; margin: 20px 0;"></div>
                        <div style="margin-bottom: 25px;">
                            <div style="background-color: #f0f0f0; padding: 10px 15px; font-weight: bold; border-left: 4px solid #4680ff; margin-bottom: 15px;">
                                Detail Pengajuan
                            </div>
                            <div style="background-color: #f9f9f9; padding: 15px; border-radius: 5px;">
                                @foreach(json_decode($pengajuanSurat->dynamic_fields, true) as $fieldName => $fieldValue)
                                <div style="margin-bottom: 12px;">
                                    <div style="font-weight: bold; color: #555; font-size: 13px;">
                                        {{ ucfirst(str_replace('_', ' ', $fieldName)) }}
                                    </div>
                                    <div style="color: #333; margin-top: 3px; word-wrap: break-word;">
                                        @if(is_array($fieldValue))
                                            {{ implode(', ', $fieldValue) }}
                                        @else
                                            {{ $fieldValue ?? '-' }}
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div style="border-top: 1px solid #ddd; margin: 20px 0;"></div>

                        <!-- Status Tracking -->
                        <div style="margin-bottom: 25px;">
                            <div style="background-color: #f0f0f0; padding: 10px 15px; font-weight: bold; border-left: 4px solid #4680ff; margin-bottom: 15px;">
                                Catatan Proses
                            </div>
                            <div>
                                @if($pengajuanSurat->catatan_admin)
                                    {{ $pengajuanSurat->catatan_admin }}
                                @else
                                    <em>Belum ada catatan dari admin</em>
                                @endif
                            </div>
                        </div>

                        <div style="border-top: 1px solid #ddd; margin: 20px 0;"></div>

                        <!-- Tanggal Update -->
                        <div style="margin-bottom: 25px;">
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Terakhir Diupdate</span>
                                <span>: {{ $pengajuanSurat->updated_at->format('d F Y H:i') }} WIB</span>
                            </div>
                            @if($pengajuanSurat->tanggal_selesai)
                            <div style="margin-bottom: 10px;">
                                <span style="font-weight: bold; width: 200px; display: inline-block;">Tanggal Selesai</span>
                                <span>: {{ $pengajuanSurat->tanggal_selesai->format('d F Y H:i') }} WIB</span>
                            </div>
                            @endif
                        </div>

                        <!-- Footer -->
                        <div style="text-align: center; padding-top: 20px; border-top: 1px solid #ddd; margin-top: 40px; font-size: 12px; color: #999;">
                            <p style="margin: 5px 0;">Dokumen ini dicetak otomatis dari Sistem Informasi Desa Candi</p>
                            <p style="margin: 5px 0;">Tanggal Cetak: {{ now()->format('d F Y H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body {
            margin: 0;
            padding: 0;
        }
        .page-header,
        .card-header {
            display: none;
        }
        #printContent {
            padding: 0 !important;
        }
    }
</style>
@endsection
