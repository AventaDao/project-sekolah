@extends('layouts.dashboard')

@section('title', 'Edit Profile')

@section('content')
    <style>
        /* Ensure avatar is always square and not stretched */
        #avatarPreview {
            width: 150px !important;
            height: 150px !important;
            object-fit: cover !important;
            object-position: center !important;
        }
        
        .cropper-container {
            position: relative;
        }
        
        #cropperImage {
            max-width: 100%;
            max-height: 400px;
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
                                            <div class="d-flex gap-2 mb-2">
                                                <button type="button" id="openCropButton" class="btn btn-sm btn-info flex-grow-1" style="display: none;">
                                                    <i class="ti ti-crop"></i> Crop & Sesuaikan
                                                </button>
                                            </div>
                                            <button type="button" id="resetAvatar" class="btn btn-sm btn-outline-secondary w-100">
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

    <!-- Crop Modal -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Sesuaikan Foto Profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div style="max-height: 600px; display: flex; align-items: center; justify-content: center; background: #f5f5f5; border-radius: 8px; padding: 20px;">
                        <img id="cropperImage" src="" alt="Crop Image" style="max-width: 100%; max-height: 550px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="ti ti-x"></i> Batalkan
                    </button>
                    <button type="button" id="cropButton" class="btn btn-primary">
                        <i class="ti ti-check"></i> Simpan Crop
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- CDN Cropper.js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script>
        let cropper = null;
        let currentFile = null;

        document.addEventListener('DOMContentLoaded', function() {
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatarPreview');
            const resetButton = document.getElementById('resetAvatar');
            const openCropButton = document.getElementById('openCropButton');
            const cropModal = new bootstrap.Modal(document.getElementById('cropModal'));
            const cropperImage = document.getElementById('cropperImage');
            const cropButton = document.getElementById('cropButton');
            const originalPreview = avatarPreview.src;

            // Preview avatar when file is selected
            avatarInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    currentFile = file;
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        // Show crop button
                        openCropButton.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Open crop modal when button is clicked
            openCropButton.addEventListener('click', function(e) {
                e.preventDefault();
                if (currentFile) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        cropperImage.src = event.target.result;
                        
                        // Destroy old cropper if exists
                        if (cropper) {
                            cropper.destroy();
                        }
                        
                        // Initialize cropper
                        setTimeout(() => {
                            cropper = new Cropper(cropperImage, {
                                aspectRatio: 1,
                                viewMode: 1,
                                autoCropArea: 1,
                                responsive: true,
                                restore: true,
                                guides: true,
                                center: true,
                                highlight: true,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                                toggleDragModeOnDblclick: true,
                            });
                        }, 100);
                        
                        // Show crop modal
                        cropModal.show();
                    };
                    reader.readAsDataURL(currentFile);
                }
            });

            // Save crop
            cropButton.addEventListener('click', function() {
                if (cropper) {
                    const canvas = cropper.getCroppedCanvas({
                        maxWidth: 500,
                        maxHeight: 500,
                        fillColor: '#fff',
                        imageSmoothingEnabled: true,
                        imageSmoothingQuality: 'high',
                    });

                    // Convert canvas to blob and update preview
                    canvas.toBlob(function(blob) {
                        const url = URL.createObjectURL(blob);
                        avatarPreview.src = url;
                        
                        // Update file input with cropped image
                        const dt = new DataTransfer();
                        const file = new File([blob], currentFile.name, { type: 'image/png' });
                        dt.items.add(file);
                        avatarInput.files = dt.files;
                        
                        // Close modal
                        cropModal.hide();
                    }, 'image/png');
                }
            });

            // Reset avatar preview
            resetButton.addEventListener('click', function() {
                avatarInput.value = '';
                avatarPreview.src = originalPreview;
                openCropButton.style.display = 'none';
                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                currentFile = null;
            });
        });
    </script>
@endsection
