<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Desa Kedung Kendo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/tabler-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }

        .contact-section {
            padding: 80px 0 60px;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Contact Section -->
    <section class="contact-section">
        <div class="container">
            <div class="mb-5">
                <h2 class="fw-bold mb-2" style="color: #333; font-size: 32px;">Hubungi Kami</h2>
                <p class="text-muted" style="font-size: 16px;">Layanan informasi, pelaporan masalah, dan permintaan layanan publik. Hubungi kami melalui telepon, email, atau kirim pesan melalui formulir.</p>
            </div>
            <div class="row g-4 mb-5">
                <!-- Card Alamat -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-card h-100 p-4" style="background: white; border-radius: 15px; border-left: 5px solid #667eea; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; font-size: 28px;">
                            📍
                        </div>
                        <h6 class="fw-bold mb-2" style="color: #333;">Alamat</h6>
                        <p class="text-muted small mb-0">Jl. Raya Sugihwaras, Kecamatan Candi, Kabupaten Sidoarjo, Jawa Timur</p>
                    </div>
                </div>

                <!-- Card Telepon -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-card h-100 p-4" style="background: white; border-radius: 15px; border-left: 5px solid #764ba2; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #764ba2 0%, #f093fb 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; font-size: 28px;">
                            📞
                        </div>
                        <h6 class="fw-bold mb-2" style="color: #333;">Telepon</h6>
                        <p class="text-muted small mb-0"><strong>(031) 1234-5678</strong></p>
                        <p class="text-muted small">Tersedia: Senin - Jumat</p>
                    </div>
                </div>

                <!-- Card Email -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-card h-100 p-4" style="background: white; border-radius: 15px; border-left: 5px solid #f093fb; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; font-size: 28px;">
                            📧
                        </div>
                        <h6 class="fw-bold mb-2" style="color: #333;">Email</h6>
                        <p class="text-muted small mb-0"><a href="mailto:info@desakdk.id" class="text-decoration-none" style="color: #667eea;">info@desakdk.id</a></p>
                        <p class="text-muted small">Respons 24 jam</p>
                    </div>
                </div>

                <!-- Card Jam Layanan -->
                <div class="col-md-6 col-lg-3">
                    <div class="contact-card h-100 p-4" style="background: white; border-radius: 15px; border-left: 5px solid #f5576c; box-shadow: 0 5px 20px rgba(0,0,0,0.08); transition: all 0.3s ease;">
                        <div style="width: 50px; height: 50px; background: linear-gradient(135deg, #f5576c 0%, #ffa500 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 15px; font-size: 28px;">
                            🕐
                        </div>
                        <h6 class="fw-bold mb-2" style="color: #333;">Jam Layanan</h6>
                        <p class="text-muted small mb-0"><strong>08:00 - 16:00 WIB</strong></p>
                        <p class="text-muted small">Senin - Jumat</p>
                    </div>
                </div>
            </div>

            <style>
                .contact-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2) !important;
                }
            </style>

            <div class="row g-4 align-items-center">
                <!-- Kolom Kiri - Map & Info -->
                <div class="col-lg-5">
                    <div style="margin-bottom: 30px;">
                        <h3 class="fw-bold mb-3" style="color: #333;">Lokasi Kantor Desa</h3>
                        <div style="width:100%; height:300px; overflow:hidden; border-radius:15px; box-shadow: 0 10px 40px rgba(0,0,0,0.12);">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.7619!2d110.8136!3d-7.4089!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a3c5c5c5c5c5d%3A0x1234567890abcdef!2sDesa%20Kedung%20Kendo!5e0!3m2!1sid!2sid!4v1609459200000" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>

                    <div style="background: white; padding: 25px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
                        <h6 class="fw-bold mb-3" style="color: #333; border-bottom: 2px solid #667eea; padding-bottom: 10px;">Info Tambahan</h6>
                        <div class="mb-3">
                            <p class="small text-muted mb-2">
                                <strong style="color: #333;">Pemerintahan Desa Kedung Kendo</strong> adalah lembaga pemerintahan terendah yang bertanggung jawab langsung kepada masyarakat lokal. Kami berkomitmen untuk memberikan pelayanan publik terbaik.
                            </p>
                        </div>
                        <div style="padding-top: 15px; border-top: 1px solid #eee;">
                            <p class="small text-muted mb-1"><span style="color: #667eea;">✓</span> Respons Cepat</p>
                            <p class="small text-muted mb-1"><span style="color: #667eea;">✓</span> Profesional & Terpercaya</p>
                            <p class="small text-muted mb-0"><span style="color: #667eea;">✓</span> Transparansi Penuh</p>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan - Form -->
                <div class="col-lg-7">
                    <div style="background: white; padding: 35px; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.12);">
                        <div class="mb-4">
                            <h4 class="fw-bold mb-2" style="color: #333;">Kirim Pesan ke Kami</h4>
                            <p class="text-muted">Isi formulir di bawah dan kami akan segera merespons pertanyaan atau laporan Anda.</p>
                        </div>

                        @if(session('status'))
                            <div class="alert alert-success d-flex align-items-center" style="background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), rgba(76, 175, 80, 0.05)); border: 1px solid #4caf50; border-radius: 10px;">
                                <i class="ti ti-check" style="font-size: 20px; color: #4caf50; margin-right: 12px;"></i>
                                <span style="color: #333;">{{ session('status') }}</span>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-500 mb-2" style="color: #333; font-size: 14px;">Nama Lengkap</label>
                                    <input name="name" type="text" class="form-control" value="{{ old('name') }}" style="border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; transition: all 0.3s ease;" required>
                                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500 mb-2" style="color: #333; font-size: 14px;">Email</label>
                                    <input name="email" type="email" class="form-control" value="{{ old('email') }}" style="border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; transition: all 0.3s ease;" required>
                                    @error('email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500 mb-2" style="color: #333; font-size: 14px;">Nomor Telepon</label>
                                    <input name="phone" type="text" class="form-control" value="{{ old('phone') }}" style="border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; transition: all 0.3s ease;">
                                    @error('phone')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-500 mb-2" style="color: #333; font-size: 14px;">Kategori</label>
                                    <select name="category" class="form-select" style="border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; transition: all 0.3s ease;">
                                        <option value="Layanan Publik" {{ old('category')=='Layanan Publik' ? 'selected' : '' }}>📋 Layanan Publik</option>
                                        <option value="Pelaporan" {{ old('category')=='Pelaporan' ? 'selected' : '' }}>📢 Pelaporan</option>
                                        <option value="Permohonan Informasi" {{ old('category')=='Permohonan Informasi' ? 'selected' : '' }}>📖 Permohonan Informasi</option>
                                        <option value="Lainnya" {{ old('category')=='Lainnya' ? 'selected' : '' }}>❓ Lainnya</option>
                                    </select>
                                    @error('category')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-500 mb-2" style="color: #333; font-size: 14px;">Subjek</label>
                                    <input name="subject" type="text" class="form-control" value="{{ old('subject') }}" style="border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; transition: all 0.3s ease;" required>
                                    @error('subject')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-500 mb-2" style="color: #333; font-size: 14px;">Pesan</label>
                                    <textarea name="message" class="form-control" rows="5" style="border-radius: 8px; border: 1.5px solid #e0e0e0; padding: 10px 14px; transition: all 0.3s ease; resize: vertical; font-family: inherit;" required>{{ old('message') }}</textarea>
                                    @error('message')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                                </div>

                                <div class="col-12">
                                    <div class="form-check">
                                        <input name="consent" class="form-check-input" type="checkbox" id="consent" {{ old('consent') ? 'checked' : '' }} required style="width: 18px; height: 18px; cursor: pointer;">
                                        <label class="form-check-label" for="consent" style="color: #666; font-size: 14px; cursor: pointer;">
                                            Saya setuju bahwa data yang saya kirim dapat diproses oleh Pemerintah Desa sesuai <a href="#" class="text-decoration-none" style="color: #667eea;">Kebijakan Privasi</a>.
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 pt-2">
                                    <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 600; transition: all 0.3s ease; cursor: pointer;">
                                        <i class="ti ti-send" style="margin-right: 8px;"></i> Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .form-control:focus, .form-select:focus {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15) !important;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3) !important;
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
