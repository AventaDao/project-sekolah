@extends('layouts.auth')

@section('title', 'Login Page')

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
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>
    <div class="card my-5">
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Login</b></h3>
                    <a href="/register" class="link-primary">Don't have an account?</a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label class="form-label">NIK</label>
                    <input type="number" class="form-control" name="nik" placeholder="Masukkan NIK 16 digit"
                        value="{{ session('registered_nik') }}" autocomplete="off" maxlength="16" min="0" inputmode="numeric" required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        @if (session('registered_nik'))
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                                autofocus required>
                        @else
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password"
                                required>
                        @endif
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-left: none;">
                            <i class="ti ti-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" name="remember">
                        <label class="form-check-label text-muted" for="customCheckc1">Keep me sign in</label>
                    </div>
                    <a href="{{ route('forgot_password.email_form') }}" class="text-secondary f-w-400">Forgot Password?</a>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="saprator mt-3">
                    <span>Login with</span>
                </div>
                @include('auth.sso')
            </div>
        </form>
    </div>
@endsection