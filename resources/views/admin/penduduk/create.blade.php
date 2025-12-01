@extends('layouts.dashboard')
@section('title', 'Tambah Data Penduduk')

@section('content')
<div class="pc-content">
    <!-- Breadcrumb -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.penduduk.index') }}">Data Penduduk</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tambah Data</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Form Tambah Data Penduduk</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terdapat kesalahan input:</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Stepper -->
                    <div class="stepper-wrapper mb-4">
                        <div class="stepper-item active" data-step="1">
                            <div class="step-counter">1</div>
                            <div class="step-name">Data Identitas</div>
                        </div>
                        <div class="stepper-item" data-step="2">
                            <div class="step-counter">2</div>
                            <div class="step-name">Data Alamat</div>
                        </div>
                        <div class="stepper-item" data-step="3">
                            <div class="step-counter">3</div>
                            <div class="step-name">Data Lainnya</div>
                        </div>
                        <div class="stepper-item" data-step="4">
                            <div class="step-counter">4</div>
                            <div class="step-name">Data Keluarga</div>
                        </div>
                        <div class="stepper-item" data-step="5">
                            <div class="step-counter">5</div>
                            <div class="step-name">Data Kelahiran</div>
                        </div>
                    </div>

                    <form action="{{ route('admin.penduduk.store') }}" method="POST" id="formPenduduk">
                        @csrf
                        <!-- Step 1: Data Identitas -->
                        <div class="step-content active" data-step="1">
                            <h5 class="mb-3 text-primary">Data Identitas</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                    <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                                           value="{{ old('nik') }}" maxlength="16" required>
                                    @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">16 digit angka</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                           value="{{ old('nama_lengkap') }}" required>
                                    @error('nama_lengkap')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                           value="{{ old('tempat_lahir') }}" required>
                                    @error('tempat_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                           value="{{ old('tanggal_lahir') }}" required>
                                    @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                    <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Data Alamat -->
                        <div class="step-content" data-step="2">
                            <h5 class="mb-3 text-primary">Data Alamat</h5>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                              rows="3" required>{{ old('alamat') }}</textarea>
                                    @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">RT <span class="text-danger">*</span></label>
                                    <input type="number" name="rt" class="form-control @error('rt') is-invalid @enderror" 
                                           value="{{ old('rt') }}" min="1" max="999" required>
                                    @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label class="form-label">RW <span class="text-danger">*</span></label>
                                    <input type="number" name="rw" class="form-control @error('rw') is-invalid @enderror" 
                                           value="{{ old('rw') }}" min="1" max="999" required>
                                    @error('rw')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Desa <span class="text-danger">*</span></label>
                                    <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" 
                                           value="{{ old('desa') }}" required>
                                    @error('desa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" 
                                           value="{{ old('kecamatan') }}" required>
                                    @error('kecamatan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kabupaten <span class="text-danger">*</span></label>
                                    <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" 
                                           value="{{ old('kabupaten') }}" required>
                                    @error('kabupaten')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                    <input type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" 
                                           value="{{ old('provinsi') }}" required>
                                    @error('provinsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                    <input type="number" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" 
                                           value="{{ old('kode_pos') }}" min="10000" max="99999" required>
                                    @error('kode_pos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Data Lainnya -->
                        <div class="step-content" data-step="3">
                            <h5 class="mb-3 text-primary">Data Lainnya</h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label>
                                    <select name="agama" class="form-select @error('agama') is-invalid @enderror" required>
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                    @error('agama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                    <select name="status_perkawinan" class="form-select @error('status_perkawinan') is-invalid @enderror" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                        <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                        <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                        <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                    </select>
                                    @error('status_perkawinan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Pekerjaan <span class="text-danger">*</span></label>
                                    <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" 
                                           value="{{ old('pekerjaan') }}" required>
                                    @error('pekerjaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                                    <select name="kewarganegaraan" class="form-select @error('kewarganegaraan') is-invalid @enderror" required>
                                        <option value="WNI" {{ old('kewarganegaraan') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                        <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                                    </select>
                                    @error('kewarganegaraan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Pendidikan Terakhir</label>
                                    <input type="text" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" 
                                           value="{{ old('pendidikan_terakhir') }}">
                                    @error('pendidikan_terakhir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">No. Telepon</label>
                                    <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                                           value="{{ old('no_telepon') }}" maxlength="15">
                                    @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Status Hidup <span class="text-danger">*</span></label>
                                    <select name="status_hidup" class="form-select @error('status_hidup') is-invalid @enderror" id="statusHidup" required>
                                        <option value="Hidup" {{ old('status_hidup') == 'Hidup' ? 'selected' : 'selected' }}>Hidup</option>
                                        <option value="Meninggal" {{ old('status_hidup') == 'Meninggal' ? 'selected' : '' }}>Meninggal</option>
                                    </select>
                                    @error('status_hidup')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" id="tanggalMeninggalField" style="display: {{ old('status_hidup') == 'Meninggal' ? 'block' : 'none' }}">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Tanggal Meninggal</label>
                                    <input type="date" name="tanggal_meninggal" class="form-control @error('tanggal_meninggal') is-invalid @enderror" 
                                           value="{{ old('tanggal_meninggal') }}">
                                    @error('tanggal_meninggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 4: Data Keluarga -->
                        <div class="step-content" data-step="4">
                            <h5 class="mb-3 text-primary">Data Keluarga</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Ayah</label>
                                    <input type="text" name="nama_ayah" class="form-control @error('nama_ayah') is-invalid @enderror" 
                                           value="{{ old('nama_ayah') }}">
                                    @error('nama_ayah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Ibu</label>
                                    <input type="text" name="nama_ibu" class="form-control @error('nama_ibu') is-invalid @enderror" 
                                           value="{{ old('nama_ibu') }}">
                                    @error('nama_ibu')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Step 5: Data Kelahiran -->
                        <div class="step-content" data-step="5">
                            <h5 class="mb-3 text-primary">Data Kelahiran (Opsional)</h5>
                            <div class="alert alert-info mb-3">
                                <i class="ti ti-info-circle me-2"></i>
                                <strong>Catatan:</strong> Bagian ini bersifat opsional. Anda dapat membiarkannya kosong jika tidak ingin membuat data kelahiran baru sekarang.
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="buat_kelahiran_baru" id="buatKelahiranBaru" class="form-check-input" value="1">
                                        <label class="form-check-label" for="buatKelahiranBaru">
                                            Buat kelahiran baru untuk penduduk ini
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div id="kelahiranFields" style="display: none;">
                                <hr class="my-4">
                                <h6 class="text-secondary mb-3">Informasi Kelahiran</h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nomor Akta Kelahiran</label>
                                        <input type="text" name="nomor_akta_kelahiran" class="form-control @error('nomor_akta_kelahiran') is-invalid @enderror" 
                                               value="{{ old('nomor_akta_kelahiran') }}" placeholder="Kosongkan jika belum memiliki nomor">
                                        @error('nomor_akta_kelahiran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tanggal Pendaftaran Kelahiran</label>
                                        <input type="date" name="tanggal_daftar_kelahiran" class="form-control @error('tanggal_daftar_kelahiran') is-invalid @enderror" 
                                               value="{{ old('tanggal_daftar_kelahiran') }}">
                                        @error('tanggal_daftar_kelahiran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Penolong Kelahiran</label>
                                        <select name="penolong_kelahiran" class="form-select @error('penolong_kelahiran') is-invalid @enderror">
                                            <option value="">Pilih Penolong</option>
                                            <option value="Dokter" {{ old('penolong_kelahiran') == 'Dokter' ? 'selected' : '' }}>Dokter</option>
                                            <option value="Bidan" {{ old('penolong_kelahiran') == 'Bidan' ? 'selected' : '' }}>Bidan</option>
                                            <option value="Dukun" {{ old('penolong_kelahiran') == 'Dukun' ? 'selected' : '' }}>Dukun</option>
                                            <option value="Lainnya" {{ old('penolong_kelahiran') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('penolong_kelahiran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Tempat Kelahiran</label>
                                        <select name="tempat_kelahiran" class="form-select @error('tempat_kelahiran') is-invalid @enderror">
                                            <option value="">Pilih Tempat</option>
                                            <option value="Rumah Sakit" {{ old('tempat_kelahiran') == 'Rumah Sakit' ? 'selected' : '' }}>Rumah Sakit</option>
                                            <option value="Klinik" {{ old('tempat_kelahiran') == 'Klinik' ? 'selected' : '' }}>Klinik</option>
                                            <option value="Puskesmas" {{ old('tempat_kelahiran') == 'Puskesmas' ? 'selected' : '' }}>Puskesmas</option>
                                            <option value="Rumah" {{ old('tempat_kelahiran') == 'Rumah' ? 'selected' : '' }}>Rumah</option>
                                            <option value="Lainnya" {{ old('tempat_kelahiran') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('tempat_kelahiran')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Berat Bayi (kg)</label>
                                        <input type="number" name="berat_bayi" class="form-control @error('berat_bayi') is-invalid @enderror" 
                                               value="{{ old('berat_bayi') }}" step="0.1" min="0" max="10">
                                        @error('berat_bayi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Panjang Bayi (cm)</label>
                                        <input type="number" name="panjang_bayi" class="form-control @error('panjang_bayi') is-invalid @enderror" 
                                               value="{{ old('panjang_bayi') }}" step="0.1" min="0" max="100">
                                        @error('panjang_bayi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">Opsional</small>
                                    </div>
                                </div>
                            </div>

                            <!-- Informasi untuk step terakhir -->
                            <div class="alert alert-info mt-3">
                                <i class="ti ti-info-circle me-2"></i>
                                <strong>Informasi:</strong> Pastikan semua data yang Anda masukkan sudah benar sebelum menyimpan.
                            </div>
                        </div>

                        <!-- Stepper Buttons -->
                        <div class="mt-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                                <i class="ti ti-arrow-left"></i> Sebelumnya
                            </button>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.penduduk.index') }}" class="btn btn-outline-secondary">
                                    <i class="ti ti-x"></i> Batal
                                </a>
                                <button type="button" class="btn btn-primary" id="nextBtn">
                                    Selanjutnya <i class="ti ti-arrow-right"></i>
                                </button>
                                <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                                    <i class="ti ti-device-floppy"></i> Simpan Data
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Stepper Styles */
.stepper-wrapper {
    display: flex;
    justify-content: space-between;
    margin-bottom: 2rem;
    position: relative;
}

.stepper-wrapper::before {
    content: '';
    position: absolute;
    top: 20px;
    left: 0;
    right: 0;
    height: 2px;
    background: #e9ecef;
    z-index: 0;
}

.stepper-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    position: relative;
    z-index: 1;
}

.step-counter {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #e9ecef;
    color: #6c757d;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: bold;
    margin-bottom: 8px;
    transition: all 0.3s ease;
}

.step-name {
    text-align: center;
    font-size: 14px;
    color: #6c757d;
    font-weight: 500;
}

.stepper-item.active .step-counter {
    background: #4680ff;
    color: white;
}

.stepper-item.active .step-name {
    color: #4680ff;
}

.stepper-item.completed .step-counter {
    background: #2ca87f;
    color: white;
}

.stepper-item.completed .step-counter::after {
    content: '✓';
}

.stepper-item.completed .step-name {
    color: #2ca87f;
}

/* Step Content */
.step-content {
    display: none;
    animation: fadeIn 0.3s ease-in-out;
}

.step-content.active {
    display: block;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 768px) {
    .stepper-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .stepper-wrapper::before {
        display: none;
    }
    
    .stepper-item {
        flex-direction: row;
        width: 100%;
        margin-bottom: 1rem;
    }
    
    .step-counter {
        margin-right: 12px;
        margin-bottom: 0;
    }
    
    .step-name {
        text-align: left;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 5;
    
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const submitBtn = document.getElementById('submitBtn');
    const form = document.getElementById('formPenduduk');
    const statusHidup = document.getElementById('statusHidup');
    const tanggalMeninggalField = document.getElementById('tanggalMeninggalField');
    const buatKelahiranBaru = document.getElementById('buatKelahiranBaru');
    const kelahiranFields = document.getElementById('kelahiranFields');
    
    // Toggle tanggal meninggal field
    statusHidup.addEventListener('change', function() {
        if (this.value === 'Meninggal') {
            tanggalMeninggalField.style.display = 'block';
        } else {
            tanggalMeninggalField.style.display = 'none';
        }
    });

    // Toggle kelahiran fields
    buatKelahiranBaru.addEventListener('change', function() {
        if (this.checked) {
            kelahiranFields.style.display = 'block';
        } else {
            kelahiranFields.style.display = 'none';
        }
    });
    
    // Update stepper UI
    function updateStepper() {
        // Update step items
        document.querySelectorAll('.stepper-item').forEach((item, index) => {
            const step = index + 1;
            item.classList.remove('active', 'completed');
            
            if (step < currentStep) {
                item.classList.add('completed');
            } else if (step === currentStep) {
                item.classList.add('active');
            }
        });
        
        // Update step content
        document.querySelectorAll('.step-content').forEach((content, index) => {
            content.classList.remove('active');
            if (index + 1 === currentStep) {
                content.classList.add('active');
            }
        });
        
        // Update buttons
        prevBtn.style.display = currentStep === 1 ? 'none' : 'block';
        nextBtn.style.display = currentStep === totalSteps ? 'none' : 'block';
        submitBtn.style.display = currentStep === totalSteps ? 'block' : 'none';
        
        // Scroll to top of card
        document.querySelector('.card').scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
    
    // Validate current step
    function validateStep() {
        const currentStepContent = document.querySelector(`.step-content[data-step="${currentStep}"]`);
        const requiredFields = currentStepContent.querySelectorAll('[required]');
        let isValid = true;
        let firstInvalidField = null;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('is-invalid');
                
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
                
                // Remove invalid class on input
                field.addEventListener('input', function() {
                    this.classList.remove('is-invalid');
                }, { once: true });
            }
        });
        
        if (!isValid) {
            alert('Mohon lengkapi semua field yang wajib diisi (bertanda *)');
            if (firstInvalidField) {
                firstInvalidField.focus();
            }
        }
        
        return isValid;
    }
    
    // Next button
    nextBtn.addEventListener('click', function() {
        if (validateStep()) {
            currentStep++;
            updateStepper();
        }
    });
    
    // Previous button
    prevBtn.addEventListener('click', function() {
        currentStep--;
        updateStepper();
    });
    
    // Form submit
    form.addEventListener('submit', function(e) {
        if (!validateStep()) {
            e.preventDefault();
        }
    });
    
    // Initialize
    updateStepper();
});
</script>
@endsection