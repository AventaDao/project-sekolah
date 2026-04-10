@extends('layouts.auth')

@section('title', 'Register Page')

@section('content')
    <style>
        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Stepper Styles */
        .stepper-wrapper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            position: relative;
        }

        .stepper-item {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
        }

        .stepper-item::before {
            position: absolute;
            content: "";
            border-bottom: 2px solid #e0e0e0;
            width: 100%;
            top: 20px;
            left: -50%;
            z-index: 2;
        }

        .stepper-item::after {
            position: absolute;
            content: "";
            border-bottom: 2px solid #e0e0e0;
            width: 100%;
            top: 20px;
            left: 50%;
            z-index: 2;
        }

        .stepper-item .step-counter {
            position: relative;
            z-index: 5;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #e0e0e0;
            margin-bottom: 6px;
            color: #666;
            font-weight: bold;
            font-size: 14px;
        }

        .stepper-item.active .step-counter {
            background-color: var(--bs-primary);
            color: white;
        }

        .stepper-item.completed .step-counter {
            background-color: #28a745;
            color: white;
        }

        .stepper-item.completed::after,
        .stepper-item.completed::before {
            border-bottom: 2px solid #28a745;
        }

        .stepper-item:first-child::before {
            content: none;
        }

        .stepper-item:last-child::after {
            content: none;
        }

        .step-name {
            font-size: 12px;
            text-align: center;
            color: #666;
            margin-top: 4px;
        }

        .stepper-item.active .step-name {
            color: var(--bs-primary);
            font-weight: 600;
        }

        .stepper-item.completed .step-name {
            color: #28a745;
        }

        .form-step {
            display: none;
        }

        .form-step.active {
            display: block;
        }

        .step-buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            gap: 1rem;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .stepper-wrapper {
                margin-bottom: 1.5rem;
            }

            .step-name {
                font-size: 10px;
                max-width: 60px;
            }

            .stepper-item .step-counter {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }

            .stepper-item::before,
            .stepper-item::after {
                top: 16px;
            }
        }

        @media (max-width: 576px) {
            .step-name {
                display: none;
            }

            .stepper-item .step-counter {
                width: 28px;
                height: 28px;
                font-size: 11px;
            }

            .stepper-item::before,
            .stepper-item::after {
                top: 14px;
            }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Stepper functionality
            let currentStep = 1;
            const totalSteps = 5;

            function showStep(step) {
                // Hide all steps
                document.querySelectorAll('.form-step').forEach(el => {
                    el.classList.remove('active');
                });

                // Show current step
                const currentStepEl = document.getElementById('step-' + step);
                if (currentStepEl) {
                    currentStepEl.classList.add('active');
                }

                // Update stepper UI
                document.querySelectorAll('.stepper-item').forEach((item, index) => {
                    item.classList.remove('active', 'completed');
                    if (index + 1 < step) {
                        item.classList.add('completed');
                    } else if (index + 1 === step) {
                        item.classList.add('active');
                    }
                });

                // Update buttons
                const prevBtn = document.getElementById('prevBtn');
                const nextBtn = document.getElementById('nextBtn');
                const submitBtn = document.getElementById('submitBtn');

                if (prevBtn) prevBtn.style.display = step === 1 ? 'none' : 'block';
                if (nextBtn) nextBtn.style.display = step === totalSteps ? 'none' : 'block';
                if (submitBtn) submitBtn.style.display = step === totalSteps ? 'block' : 'none';

                // Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }

            function validateStep(step) {
                const stepElement = document.getElementById('step-' + step);
                if (!stepElement) return true;

                const requiredInputs = stepElement.querySelectorAll('[required]');
                let isValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        isValid = false;
                        input.classList.add('is-invalid');
                        
                        // Remove invalid class on input
                        input.addEventListener('input', function() {
                            this.classList.remove('is-invalid');
                        }, { once: true });
                    }
                });

                if (!isValid) {
                    // Show alert
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-warning alert-dismissible fade show';
                    alertDiv.innerHTML = `
                        <i class="ti ti-alert-circle me-2"></i>
                        <strong>Perhatian!</strong> Mohon lengkapi semua field yang wajib diisi (bertanda *).
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    `;
                    
                    const existingAlert = stepElement.querySelector('.alert');
                    if (existingAlert) {
                        existingAlert.remove();
                    }
                    
                    stepElement.insertBefore(alertDiv, stepElement.firstChild);
                    
                    // Auto dismiss after 5 seconds
                    setTimeout(() => {
                        alertDiv.remove();
                    }, 5000);
                }

                return isValid;
            }

            // Next button
            const nextBtn = document.getElementById('nextBtn');
            if (nextBtn) {
                nextBtn.addEventListener('click', function() {
                    if (validateStep(currentStep)) {
                        if (currentStep < totalSteps) {
                            currentStep++;
                            showStep(currentStep);
                        }
                    }
                });
            }

            // Previous button
            const prevBtn = document.getElementById('prevBtn');
            if (prevBtn) {
                prevBtn.addEventListener('click', function() {
                    if (currentStep > 1) {
                        currentStep--;
                        showStep(currentStep);
                    }
                });
            }

            // Initialize first step
            @if ($errors->any())
                @if ($errors->has('nik'))
                    currentStep = 1;
                @else
                    currentStep = 5;
                @endif
            @endif
            showStep(currentStep);

            // NIK validation - max 16 digits
            const nikInput = document.querySelector('input[name="nik"]');
            if (nikInput) {
                nikInput.addEventListener('input', function(e) {
                    // Limit to 16 digits by converting to string and trimming
                    if (this.value && this.value.length > 16) {
                        this.value = this.value.substring(0, 16);
                    }
                });
                
                nikInput.addEventListener('keypress', function(e) {
                    // Prevent input if already 16 digits
                    if (this.value && this.value.length >= 16 && e.key !== 'Backspace') {
                        e.preventDefault();
                    }
                });
            }
            
            // Only allow numbers for RT, RW, Kode Pos, and No. Telepon
            const numericInputs = document.querySelectorAll('input[name="rt"], input[name="rw"], input[name="kode_pos"], input[name="no_telepon"]');
            
            numericInputs.forEach(input => {
                // Prevent non-numeric characters
                input.addEventListener('keypress', function(e) {
                    if (!/[0-9]/.test(e.key)) {
                        e.preventDefault();
                    }
                });
                
                // Remove non-numeric characters on paste
                input.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasteData = (e.clipboardData || window.clipboardData).getData('text');
                    const numericOnly = pasteData.replace(/[^0-9]/g, '');
                    this.value = numericOnly.substring(0, this.maxLength);
                });
                
                // Clean up any existing non-numeric content
                input.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });

            // Toggle password visibility
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            
            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Ubah icon
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('ti-eye-off');
                        icon.classList.add('ti-eye');
                    } else {
                        icon.classList.remove('ti-eye');
                        icon.classList.add('ti-eye-off');
                    }
                });
            }

            // Toggle password confirmation visibility
            const togglePasswordConfirmBtn = document.getElementById('togglePasswordConfirm');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            
            if (togglePasswordConfirmBtn && passwordConfirmInput) {
                togglePasswordConfirmBtn.addEventListener('click', function() {
                    const type = passwordConfirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordConfirmInput.setAttribute('type', type);
                    
                    // Ubah icon
                    const icon = this.querySelector('i');
                    if (type === 'password') {
                        icon.classList.remove('ti-eye-off');
                        icon.classList.add('ti-eye');
                    } else {
                        icon.classList.remove('ti-eye');
                        icon.classList.add('ti-eye-off');
                    }
                });
            }
        });
    </script>
    <div class="card my-5">
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <div class="card-body" style="max-height: 80vh; overflow-y: auto;">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Daftar Akun</b></h3>
                    <a href="/login" class="link-primary">Already have an account?</a>
                </div>

                <!-- Stepper -->
                <div class="stepper-wrapper">
                    <div class="stepper-item">
                        <div class="step-counter">1</div>
                        <div class="step-name">Identitas</div>
                    </div>
                    <div class="stepper-item">
                        <div class="step-counter">2</div>
                        <div class="step-name">Alamat</div>
                    </div>
                    <div class="stepper-item">
                        <div class="step-counter">3</div>
                        <div class="step-name">Data Lain</div>
                    </div>
                    <div class="stepper-item">
                        <div class="step-counter">4</div>
                        <div class="step-name">Keluarga</div>
                    </div>
                    <div class="stepper-item">
                        <div class="step-counter">5</div>
                        <div class="step-name">Akun</div>
                    </div>
                </div>

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

                <!-- Info Social Auth -->
                @if (session('social_email'))
                <div class="alert alert-info mb-4">
                    <i class="ti ti-info-circle me-2"></i>
                    <strong>Login via {{ ucfirst(session('provider', 'Social')) }}:</strong>
                    <br>
                    Email <strong>{{ session('social_email') }}</strong> sudah terdaftar via {{ ucfirst(session('provider', 'Social')) }}.
                    <br>Silakan lengkapi data di bawah untuk menyelesaikan pendaftaran, khususnya NIK dan field yang wajib diisi.
                </div>
                @endif

                <!-- Step 1: Data Identitas -->
                <div class="form-step active" id="step-1">
                    <h5 class="mb-3 text-primary">Data Identitas</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="number" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                                   value="{{ old('nik') }}" maxlength="16" min="0" inputmode="numeric" required placeholder="16 digit">
                            @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                   value="{{ session('social_name') ?? old('nama_lengkap') }}" required>
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
                                   value="{{ old('tanggal_lahir') }}" 
                                   max="{{ date('Y-m-d', strtotime('-17 years')) }}" 
                                   required>
                            @error('tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Usia minimal 17 tahun</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">Pilih</option>
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
                <div class="form-step" id="step-2">
                    <h5 class="mb-3 text-primary">Data Alamat</h5>
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" 
                                      rows="2" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">RT <span class="text-danger">*</span></label>
                            <input type="text" name="rt" class="form-control @error('rt') is-invalid @enderror" 
                                   value="{{ old('rt') }}" maxlength="3" inputmode="numeric" pattern="[0-9]*" required>
                            @error('rt')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-2 mb-3">
                            <label class="form-label">RW <span class="text-danger">*</span></label>
                            <input type="text" name="rw" class="form-control @error('rw') is-invalid @enderror" 
                                   value="{{ old('rw') }}" maxlength="3" inputmode="numeric" pattern="[0-9]*" required>
                            @error('rw')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Desa <span class="text-danger">*</span></label>
                            <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" 
                                   value="{{ old('desa', 'Candi') }}" required>
                            @error('desa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                            <input type="text" name="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror" 
                                   value="{{ old('kecamatan', 'Sidoarjo') }}" required>
                            @error('kecamatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kabupaten <span class="text-danger">*</span></label>
                            <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" 
                                   value="{{ old('kabupaten', 'Sidoarjo') }}" required>
                            @error('kabupaten')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                            <input type="text" name="provinsi" class="form-control @error('provinsi') is-invalid @enderror" 
                                   value="{{ old('provinsi', 'Jawa Timur') }}" required>
                            @error('provinsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kode Pos <span class="text-danger">*</span></label>
                            <input type="text" name="kode_pos" class="form-control @error('kode_pos') is-invalid @enderror" 
                                   value="{{ old('kode_pos') }}" maxlength="5" inputmode="numeric" pattern="[0-9]*" required>
                            @error('kode_pos')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 3: Data Lainnya -->
                <div class="form-step" id="step-3">
                    <h5 class="mb-3 text-primary">Data Lainnya</h5>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Agama <span class="text-danger">*</span></label>
                            <select name="agama" class ="form-select @error('agama') is-invalid @enderror" required>
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
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kewarganegaraan <span class="text-danger">*</span></label>
                            <select name="kewarganegaraan" class="form-select @error('kewarganegaraan') is-invalid @enderror" required>
                                <option value="WNI" {{ old('kewarganegaraan', 'WNI') == 'WNI' ? 'selected' : '' }}>WNI</option>
                                <option value="WNA" {{ old('kewarganegaraan') == 'WNA' ? 'selected' : '' }}>WNA</option>
                            </select>
                            @error('kewarganegaraan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pendidikan Terakhir</label>
                            <input type="text" name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" 
                                   value="{{ old('pendidikan_terakhir') }}">
                            @error('pendidikan_terakhir')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">No. Telepon</label>
                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" 
                                   value="{{ old('no_telepon') }}" maxlength="15" inputmode="numeric" pattern="[0-9]*">
                            @error('no_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 4: Data Keluarga -->
                <div class="form-step" id="step-4">
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
                    <div class="alert alert-info">
                        <i class="ti ti-info-circle me-2"></i>
                        Data keluarga bersifat opsional, namun sangat membantu untuk kelengkapan data.
                    </div>
                </div>

                <!-- Step 5: Data Akun -->
                <div class="form-step" id="step-5">
                    <h5 class="mb-3 text-primary">Data Akun</h5>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ session('social_email') ?? old('email') }}" 
                                   placeholder="email@contoh.com" 
                                   {{ session('social_email') ? 'readonly' : 'required' }}>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Email digunakan untuk login dan verifikasi akun</small>
                        </div>
                        @if (!session('social_email'))
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                                       required placeholder="Minimal 6 karakter">
                                <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-left: none;">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                            @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                                       required placeholder="Ulangi password">
                                <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm" style="border-left: none;">
                                    <i class="ti ti-eye"></i>
                                </button>
                            </div>
                        </div>
                        @else
                        <!-- Hidden fields untuk social auth -->
                        <input type="hidden" name="provider" value="{{ session('provider') }}">
                        <input type="hidden" name="provider_id" value="{{ session('provider_id') }}">
                        <input type="hidden" name="avatar" value="{{ session('social_avatar') }}">
                        <input type="hidden" name="is_social_auth" value="1">
                        <div class="col-md-12 mb-3 p-3 bg-light rounded">
                            <p class="text-muted mb-0">
                                <i class="ti ti-check-circle text-success me-2"></i>
                                Password tidak diperlukan karena Anda login via {{ ucfirst(session('provider')) }}.
                            </p>
                        </div>
                        @endif
                    </div>

                    <p class="mt-4 text-sm text-muted">
                        Dengan mendaftar, Anda setuju dengan <a href="#" class="text-primary">Syarat & Ketentuan</a> 
                        dan <a href="#" class="text-primary">Kebijakan Privasi</a> kami.
                    </p>

                    {{-- reCAPTCHA Widget --}}
                    <div class="form-group mt-3">
                        {!! app('captcha')->display() !!}
                        @if ($errors->has('g-recaptcha-response'))
                            <div class="text-danger mt-1">
                                <small>{{ $errors->first('g-recaptcha-response') }}</small>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="step-buttons">
                    <button type="button" class="btn btn-secondary" id="prevBtn">
                        <i class="ti ti-arrow-left me-1"></i> Sebelumnya
                    </button>
                    <button type="button" class="btn btn-primary" id="nextBtn">
                        Selanjutnya <i class="ti ti-arrow-right ms-1"></i>
                    </button>
                    <button type="submit" class="btn btn-success" id="submitBtn" style="display: none;">
                        <i class="ti ti-check me-1"></i> Daftar Sekarang
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

{{-- reCAPTCHA Script --}}
@section('scripts_content')
    {!! app('captcha')->renderJs() !!}
@endsection