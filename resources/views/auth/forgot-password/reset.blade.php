@extends('layouts.auth')

@section('title', 'Resetting Your Password ?')

@section('content')
    {{-- Form reset password - semua validasi token sudah dilakukan di backend --}}
    @if($credensial['token'] && $credensial['user'])
    <div class="card my-5">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{$credensial['token'] }}">
            <input type="hidden" name="email" value="{{ $credensial['user']->email }}">
            <div class="card-body">
                <div class="mb-4">
                    <h2 class="mb-4"><b>Reset Password</b></h2>
                    <div class="my-2">
                        <p class="mb-2"><b>{{ $credensial['user']->name }}</b>, kamu mau mengganti password untuk email
                            <b>{{ $credensial['user']->email }}</b> ya?
                        </p>
                        <p>Bikin password yang kuat dan mudah diingat ya</p>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>

                @endif
                <div class="form-group mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                        required>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </div>
            </div>
        </form>
    </div>
    @else
    <div class="card my-5">
        <div class="card-body text-center p-5">
            <i class="ti ti-alert-circle" style="font-size: 48px; color: #dc2626;"></i>
            <h3 class="mt-3 mb-2">Token Tidak Valid</h3>
            <p class="text-muted mb-4">Token reset password Anda tidak valid atau sudah kadaluarsa. Silakan request ulang reset password.</p>
            <a href="{{ route('forgot_password.email_form') }}" class="btn btn-primary">Request Reset Password Baru</a>
        </div>
    </div>
    @endif
@endsection
