@extends('layouts.landing')

@section('title', 'Hubungi Kami')

@section('content')

    <header class="contact-hero"
        style="position: relative; padding: 100px 0; background: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)), url('{{ asset('assets/images/my/ppdesa.jpeg') }}') no-repeat center center; background-size: cover;">
        <div class="container">
            <div class="row justify-content-center text-center text-light">
                <div class="col-md-10 col-lg-8">
                    <h1 class="text-white display-4">Hubungi <span class="text-primary">Desa Kedung Kendo</span></h1>
                    <p class="text-white-75 lead">
                        Layanan resmi pengaduan, informasi dan layanan publik untuk warga Desa Kedung Kendo.
                        Gunakan formulir di bawah untuk menyampaikan aspirasi, laporan masalah, atau permintaan informasi.
                    </p>
                </div>
            </div>
        </div>
    </header>

    <section class="contact-form py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 mb-4">
                    <h5 class="text-primary mb-0">Kontak Desa</h5>
                    <h2 class="my-3">Kantor Pemerintah Desa Kedung Kendo</h2>
                    <p class="text-muted">Layanan informasi, pelaporan masalah, dan permintaan layanan publik.
                        Hubungi kami melalui telepon, email, atau kirim pesan melalui formulir.</p>

                    <div class="mt-4">
                        <p class="mb-1"><strong>Alamat:</strong> Jl. Raya Sugihwaras, Kecamatan Candi, Kabupaten Sidoarjo, Jawa Timur</p>
                        <p class="mb-1"><strong>Telepon:</strong> (031) 1234-5678</p>
                        <p class="mb-1"><strong>Email:</strong> <a href="mailto:info@desakdk.id" class="link-primary">info@desakdk.id</a></p>
                        <p class="mb-1"><strong>Jam Layanan:</strong> Senin - Jumat, 08:00 - 16:00</p>
                    </div>

                    <div class="mt-3">
                        <h6 class="mb-2">Lokasi</h6>
                        <div style="width:100%;height:200px;overflow:hidden;border-radius:6px;">
                            <!-- Ganti src iframe dengan embed maps desa Anda -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Kirim Pesan ke Pemerintahan Desa</h5>

                            @if(session('status'))
                                <div class="alert alert-success">{{ session('status') }}</div>
                            @endif

                            <form action="{{ route('contact.send') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input name="name" type="text" class="form-control" value="{{ old('name') }}" required>
                                        @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email</label>
                                        <input name="email" type="email" class="form-control" value="{{ old('email') }}" required>
                                        @error('email')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nomor Telepon</label>
                                        <input name="phone" type="text" class="form-control" value="{{ old('phone') }}">
                                        @error('phone')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kategori</label>
                                        <select name="category" class="form-select">
                                            <option value="Layanan Publik" {{ old('category')=='Layanan Publik' ? 'selected' : '' }}>Layanan Publik</option>
                                            <option value="Pelaporan" {{ old('category')=='Pelaporan' ? 'selected' : '' }}>Pelaporan</option>
                                            <option value="Permohonan Informasi" {{ old('category')=='Permohonan Informasi' ? 'selected' : '' }}>Permohonan Informasi</option>
                                            <option value="Lainnya" {{ old('category')=='Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                        </select>
                                        @error('category')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Subjek</label>
                                        <input name="subject" type="text" class="form-control" value="{{ old('subject') }}" required>
                                        @error('subject')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label">Pesan</label>
                                        <textarea name="message" class="form-control" rows="6" required>{{ old('message') }}</textarea>
                                        @error('message')<div class="text-danger small">{{ $message }}</div>@enderror
                                    </div>

                                    <div class="col-12 d-flex align-items-center">
                                        <div class="form-check">
                                            <input name="consent" class="form-check-input" type="checkbox" id="consent" {{ old('consent') ? 'checked' : '' }} required>
                                            <label class="form-check-label" for="consent">Saya setuju bahwa data yang saya kirim dapat diproses oleh Pemerintah Desa sesuai <a href="#" class="link-primary">Kebijakan Privasi</a>.</label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
