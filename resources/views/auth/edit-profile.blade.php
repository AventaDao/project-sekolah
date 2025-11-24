@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('content')
    <div class="pc-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('myprofile') }}">User Profile</a></li>
                            <li class="breadcrumb-item" aria-current="page">Edit Profile</li>
                        </ul>
                    </div>
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h2 class="mb-0">Edit Profile</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->

        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Update Profil Anda</h5>
                        <a href="{{ route('myprofile') }}" class="btn btn-secondary btn-sm">
                            <i class="ti ti-arrow-left"></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Terdapat kesalahan:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Avatar Section -->
                                <div class="col-md-4 mb-4">
                                    <div class="card border">
                                        <div class="card-body text-center">
                                            <div class="mb-3">
                                                <img id="avatarPreview" 
                                                     src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/images/avatar-default.png') }}" 
                                                     alt="Avatar" 
                                                     class="img-fluid rounded-circle" 
                                                     style="width: 150px; height: 150px; object-fit: cover;">
                                            </div>
                                            <div class="mb-3">
                                                <label for="avatar" class="form-label">Foto Profil</label>
                                                <input type="file" name="avatar" id="avatar" class="form-control @error('avatar') is-invalid @enderror" accept="image/*">
                                                <small class="text-muted">Max 2MB. Format: JPG, PNG, GIF</small>
                                                @error('avatar')
                                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <button type="button" id="resetAvatar" class="btn btn-sm btn-outline-secondary">
                                                <i class="ti ti-x"></i> Batalkan
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Data -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                                   value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                                            @error('nama_lengkap')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Email <span class="text-danger">*</span></label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                                   value="{{ old('email', $user->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">No. Telepon</label>
                                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                                                   value="{{ old('no_telepon', $user->no_telepon) }}" maxlength="15">
                                            @error('no_telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                                   value="{{ old('pekerjaan', $user->pekerjaan) }}">
                                            @error('pekerjaan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <div class="d-flex gap-2">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="ti ti-check"></i> Simpan Perubahan
                                                </button>
                                                <a href="{{ route('myprofile') }}" class="btn btn-outline-secondary">
                                                    <i class="ti ti-x"></i> Batal
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4">

                        <!-- Read-only sections -->
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Informasi Identitas (Tidak dapat diubah)</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted"><strong>NIK</strong></td>
                                        <td width="2%">:</td>
                                        <td>{{ $user->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Jenis Kelamin</strong></td>
                                        <td>:</td>
                                        <td>
                                            @if($user->jenis_kelamin === 'Laki-laki')
                                                Laki-laki
                                            @elseif($user->jenis_kelamin === 'Perempuan')
                                                Perempuan
                                            @else
                                                {{ $user->jenis_kelamin ?? 'N/A' }}
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Tanggal Lahir</strong></td>
                                        <td>:</td>
                                        <td>{{ $user->tanggal_lahir ? $user->tanggal_lahir->format('d-m-Y') : 'N/A' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Alamat (Tidak dapat diubah)</h6>
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="40%" class="text-muted"><strong>Alamat</strong></td>
                                        <td width="2%">:</td>
                                        <td>{{ $user->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Desa</strong></td>
                                        <td>:</td>
                                        <td>{{ $user->desa }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted"><strong>Kecamatan</strong></td>
                                        <td>:</td>
                                        <td>{{ $user->kecamatan }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatarPreview');
            const resetButton = document.getElementById('resetAvatar');
            const originalPreview = avatarPreview.src;

            // Preview avatar when file is selected
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        avatarPreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Reset avatar preview
            resetButton.addEventListener('click', function() {
                avatarInput.value = '';
                avatarPreview.src = originalPreview;
            });
        });
    </script>
@endsection
