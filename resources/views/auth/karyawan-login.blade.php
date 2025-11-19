@extends('layouts.auth')

@section('title', 'Login Karyawan')

@section('content')
    <div class="card my-5">
        <form method="POST" action="{{ route('karyawan.login.post') }}">
            @csrf
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end mb-4">
                    <h3 class="mb-0"><b>Login Karyawan</b></h3>
                    <a href="{{ route('login') }}" class="link-primary">Login Umum</a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label class="form-label">Email atau NIK</label>
                    <input type="text" class="form-control" name="identifier" 
                        placeholder="Masukkan Email atau NIK" 
                        value="{{ old('identifier') }}" 
                        autocomplete="off" required>
                    <small class="text-muted">Contoh: 1234567890 atau budi@example.test</small>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" 
                        placeholder="Masukkan Password" required>
                </div>
                <div class="d-flex mt-1 justify-content-between">
                    <div class="form-check">
                        <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" name="remember">
                        <label class="form-check-label text-muted" for="customCheckc1">Ingat saya</label>
                    </div>
                    <a href="{{ route('forgot_password.email_form') }}" class="text-secondary f-w-400">Lupa Password?</a>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </div>
        </form>
    </div>
@endsection
