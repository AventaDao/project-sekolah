@extends('layouts.landing')

@section('title', 'Selamat Datang di Sistem Informasi Desa')

@section('content')
    <!-- [ Header ] start -->
    <header id="home" class="hero-section d-flex align-items-center"
        style="position: relative; min-height: 100vh; background: url('{{ asset('assets/images/my/ppdesa.jpeg') }}') no-repeat center center; background-size: cover; background-attachment: fixed;">
        
        <!-- Animated Overlay -->
        <div class="hero-overlay"></div>
        
        <!-- Floating Particles -->
        <div class="particles-container">
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
            <div class="particle"></div>
        </div>

        <div class="container mt-5 pt-5" style="position: relative; z-index: 10;">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center">
                    <!-- Animated Badge -->
                    <div class="badge-container wow fadeInDown" data-wow-delay="0.1s">
                        <span class="animated-badge">
                            <i class="ti ti-sparkles me-2"></i>
                            Sistem Informasi Desa Digital
                        </span>
                    </div>

                    <h1 class="hero-title mt-4 mb-4 wow fadeInUp" data-wow-delay="0.2s">
                        Selamat Datang di
                        <br>
                        <span class="text-gradient">Aplikasi Sistem Informasi Desa</span>
                    </h1>
                    
                    <h5 class="hero-subtitle mb-4 wow fadeInUp" data-wow-delay="0.4s">
                        Transparansi dan Kemudahan Akses Data untuk Masyarakat Desa.
                        <br class="d-none d-md-block">
                        Akses informasi desa, data penduduk, surat menyurat, dan pengaduan secara online.
                    </h5>
                    
                    <div class="my-5 wow fadeInUp" data-wow-delay="0.6s">
                        <a href="{{ route('login') }}"
                            class="btn btn-primary btn-lg btn-animated d-inline-flex align-items-center me-3 mb-3 mb-md-0">
                            Masuk Sistem 
                            <i class="ti ti-arrow-right ms-2 arrow-icon"></i>
                        </a>
                        <a href="#fitur" class="btn btn-outline-light btn-lg btn-animated mb-3 mb-md-0">
                            Lihat Fitur Utama
                        </a>
                    </div>

                    <!-- Scroll Indicator -->
                    <div class="scroll-indicator wow fadeInUp" data-wow-delay="0.8s">
                        <a href="#fitur" class="scroll-link">
                            <i class="ti ti-chevron-down"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- [ Header ] End -->

    <!-- [ Stats Counter ] start -->
    <section class="stats-section">
        <div class="container">
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-card wow fadeInUp" data-wow-delay="0.1s">
                        <div class="stat-icon">
                            <i class="ti ti-users"></i>
                        </div>
                        <h2 class="stat-number" data-count="1250">0</h2>
                        <p class="stat-label">Penduduk Terdata</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="stat-icon">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h2 class="stat-number" data-count="50">0</h2>
                        <p class="stat-label">Layanan Surat</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card wow fadeInUp" data-wow-delay="0.3s">
                        <div class="stat-icon">
                            <i class="ti ti-chart-line"></i>
                        </div>
                        <h2 class="stat-number" data-count="10">0</h2>
                        <p class="stat-label">Program Desa</p>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="stat-icon">
                            <i class="ti ti-clock"></i>
                        </div>
                        <h2 class="stat-number" data-count="24">0</h2>
                        <p class="stat-label">Jam Layanan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Stats Counter ] End -->

    <!-- [ Fitur Utama ] start -->
    <section id="fitur" class="features-section">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <span class="section-badge">Inovasi Desa Digital</span>
                    <h2 class="section-title">Mengapa Memilih Sistem Ini?</h2>
                    <p class="section-subtitle">Sistem Informasi Desa membantu pemerintah dan masyarakat mengelola data kependudukan,
                        pelayanan publik, serta laporan desa dengan mudah dan transparan.</p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row align-items-center justify-content-center g-4">
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="feature-icon">
                            <i class="ti ti-database"></i>
                        </div>
                        <div class="feature-content">
                            <h5 class="feature-title">Manajemen Data Desa</h5>
                            <p class="feature-description">Kelola data penduduk, kelahiran, kematian, dan potensi desa secara
                                terpusat dan efisien.</p>
                            <a href="#" class="feature-link">
                                Pelajari Lebih Lanjut <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="feature-icon">
                            <i class="ti ti-file-check"></i>
                        </div>
                        <div class="feature-content">
                            <h5 class="feature-title">Pelayanan Surat Online</h5>
                            <p class="feature-description">Warga dapat mengajukan berbagai surat seperti domisili, kematian,
                                dan lainnya secara daring.</p>
                            <a href="#" class="feature-link">
                                Pelajari Lebih Lanjut <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="feature-card wow fadeInUp" data-wow-delay="0.8s">
                        <div class="feature-icon">
                            <i class="ti ti-message-report"></i>
                        </div>
                        <div class="feature-content">
                            <h5 class="feature-title">Laporan & Pengaduan</h5>
                            <p class="feature-description">Warga dapat menyampaikan aspirasi dan pengaduan langsung melalui
                                sistem secara cepat dan transparan.</p>
                            <a href="#" class="feature-link">
                                Pelajari Lebih Lanjut <i class="ti ti-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Fitur Utama ] End -->

    <!-- [ Alur Penggunaan ] start -->
    <section class="process-section" id="alur">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <span class="section-badge">Langkah Mudah</span>
                    <h2 class="section-title">Cara Menggunakan Sistem</h2>
                    <p class="section-subtitle">Hanya empat langkah untuk menikmati kemudahan layanan administrasi desa secara digital.</p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row align-items-center justify-content-center g-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="process-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="process-number">01</div>
                        <div class="process-icon">
                            <i class="ti ti-user-plus"></i>
                        </div>
                        <h5 class="process-title">Login</h5>
                        <p class="process-description">Masuk sebagai admin atau warga untuk mengakses fitur sesuai peran.</p>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="process-line wow fadeIn" data-wow-delay="0.3s"></div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="process-card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="process-number">02</div>
                        <div class="process-icon">
                            <i class="ti ti-file-text"></i>
                        </div>
                        <h5 class="process-title">Kelola Data</h5>
                        <p class="process-description">Lengkapi dan perbarui data penduduk, surat, dan pengajuan secara
                            online.</p>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="process-line wow fadeIn" data-wow-delay="0.5s"></div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="process-card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="process-number">03</div>
                        <div class="process-icon">
                            <i class="ti ti-search"></i>
                        </div>
                        <h5 class="process-title">Proses Verifikasi</h5>
                        <p class="process-description">Admin desa memverifikasi dan menyetujui data atau pengajuan Anda.</p>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="process-line wow fadeIn" data-wow-delay="0.7s"></div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="process-card wow fadeInUp" data-wow-delay="0.8s">
                        <div class="process-number">04</div>
                        <div class="process-icon">
                            <i class="ti ti-circle-check"></i>
                        </div>
                        <h5 class="process-title">Selesai</h5>
                        <p class="process-description">Data dan surat dapat diunduh atau dicetak langsung dari sistem.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Alur Penggunaan ] End -->

    <!-- [ Lokasi Desa ] start -->
    <section class="location-section" id="lokasi">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <span class="section-badge">Temukan Kami</span>
                    <h2 class="section-title">Lokasi Desa Kami</h2>
                    <p class="section-subtitle">Kunjungi kantor desa kami atau lihat lokasi desa di peta interaktif di bawah ini.</p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="location-info wow fadeInLeft" data-wow-delay="0.2s">
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="ti ti-map-pin"></i>
                            </div>
                            <div class="info-content">
                                <h5 class="info-title">Alamat Kantor Desa</h5>
                                <p class="info-text" id="village-address">Jl. Raya Candi, Desa Candi, Kecamatan Candi, Kabupaten Sidoarjo, Jawa Timur</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="ti ti-phone"></i>
                            </div>
                            <div class="info-content">
                                <h5 class="info-title">Telepon</h5>
                                <p class="info-text">(021) 3193-7190</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="ti ti-mail"></i>
                            </div>
                            <div class="info-content">
                                <h5 class="info-title">Email</h5>
                                <p class="info-text">info@desaku.id</p>
                            </div>
                        </div>
                        <div class="info-card">
                            <div class="info-icon">
                                <i class="ti ti-clock"></i>
                            </div>
                            <div class="info-content">
                                <h5 class="info-title">Jam Operasional</h5>
                                <p class="info-text">Senin - Jumat: 08:00 - 17:00<br>Sabtu: 08:00 - 12:00</p>
                            </div>
                        </div>
                        <a href="https://maps.app.goo.gl/fD3sp77vSd5vpUYv7" class="btn btn-primary btn-lg mt-4 wow fadeInUp" data-wow-delay="0.4s" id="open-maps" target="_blank">
                            <i class="ti ti-map me-2"></i> Buka di Google Maps
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-container wow fadeInRight" data-wow-delay="0.2s">
                        <div id="map" style="width: 100%; height: 500px; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);"></div>
                        <p class="map-info text-center mt-3">
                            <small class="text-muted">
                                <i class="ti ti-info-circle me-1"></i>
                                Perbesar, perkecil, atau geser peta untuk melihat lokasi lebih detail
                            </small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Lokasi Desa ] End -->

    <!-- [ CTA ] start -->
    <section class="cta-section"
        style="position: relative; padding: 120px 0; background: url('{{ asset('assets/images/my/join-us.png') }}') no-repeat center center; background-size: cover; background-attachment: fixed;">
        <div class="cta-overlay"></div>
        <div class="container" style="position: relative; z-index: 2;">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h2 class="cta-title wow fadeInUp" data-wow-delay="0.2s">
                        Tingkatkan Layanan Desa dengan
                        <span class="text-gradient-light">Sistem Informasi Digital</span>
                    </h2>
                    <p class="cta-subtitle wow fadeInUp" data-wow-delay="0.4s">
                        Wujudkan tata kelola desa yang modern, transparan, dan efisien bersama aplikasi kami.
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-light btn-lg btn-animated wow fadeInUp" data-wow-delay="0.6s">
                        Masuk Sistem <i class="ti ti-arrow-right ms-2 arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- [ CTA ] End -->

    <!-- [ Testimoni ] start -->
    <section class="testimonial-section">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-6">
                    <span class="section-badge">Testimoni</span>
                    <h2 class="section-title">Apa Kata Warga?</h2>
                    <p class="section-subtitle">Kami bangga memberikan pelayanan terbaik. Simak pengalaman warga dalam menggunakan Sistem Informasi Desa.</p>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card wow fadeInUp" data-wow-delay="0.2s">
                        <div class="testimonial-rating">
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                        </div>
                        <p class="testimonial-text">
                            "Proses pengurusan surat jauh lebih mudah dan cepat melalui sistem ini. Sangat membantu warga!"
                        </p>
                        <div class="testimonial-author">
                            <img src="../assets/images/user/avatar-1.jpg" alt="Dao Rachel Lie" class="author-image">
                            <div class="author-info">
                                <h6 class="author-name">Dao Rachel Lie</h6>
                                <p class="author-role">Warga Desa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card wow fadeInUp" data-wow-delay="0.4s">
                        <div class="testimonial-rating">
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-half-filled"></i>
                        </div>
                        <p class="testimonial-text">
                            "Sekarang semua informasi desa bisa diakses dengan mudah dan terbuka. Sangat bagus untuk warga."
                        </p>
                        <div class="testimonial-author">
                            <img src="../assets/images/user/avatar-2.jpg" alt="deezydaoo" class="author-image">
                            <div class="author-info">
                                <h6 class="author-name">deezydaoo</h6>
                                <p class="author-role">Warga Desa</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testimonial-card wow fadeInUp" data-wow-delay="0.6s">
                        <div class="testimonial-rating">
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                            <i class="ti ti-star-filled"></i>
                        </div>
                        <p class="testimonial-text">
                            "Sistem ini benar-benar membantu warga mengurus layanan tanpa harus datang ke kantor desa."
                        </p>
                        <div class="testimonial-author">
                            <img src="../assets/images/user/avatar-3.jpg" alt="dao" class="author-image">
                            <div class="author-info">
                                <h6 class="author-name">dao</h6>
                                <p class="author-role">Warga Desa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ Testimoni ] End -->

    <style>
        /* Hero Section Enhancements */
        .hero-section {
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(70, 128, 255, 0.8) 0%, rgba(44, 62, 80, 0.9) 100%);
            animation: gradientShift 10s ease infinite;
        }

        @keyframes gradientShift {
            0%, 100% { opacity: 0.8; }
            50% { opacity: 0.6; }
        }

        /* Floating Particles */
        .particles-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }

        .particle:nth-child(1) {
            width: 80px;
            height: 80px;
            left: 10%;
            top: 20%;
            animation-delay: 0s;
        }

        .particle:nth-child(2) {
            width: 60px;
            height: 60px;
            right: 15%;
            top: 30%;
            animation-delay: 2s;
        }

        .particle:nth-child(3) {
            width: 100px;
            height: 100px;
            left: 20%;
            bottom: 20%;
            animation-delay: 4s;
        }

        .particle:nth-child(4) {
            width: 70px;
            height: 70px;
            right: 25%;
            bottom: 30%;
            animation-delay: 6s;
        }

        .particle:nth-child(5) {
            width: 90px;
            height: 90px;
            left: 50%;
            top: 50%;
            animation-delay: 8s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0) rotate(0deg);
            }
            25% {
                transform: translateY(-30px) translateX(30px) rotate(90deg);
            }
            50% {
                transform: translateY(-60px) translateX(-30px) rotate(180deg);
            }
            75% {
                transform: translateY(-30px) translateX(-60px) rotate(270deg);
            }
        }

        /* Animated Badge */
        .animated-badge {
            display: inline-block;
            padding: 12px 24px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            color: white;
            font-size: 14px;
            font-weight: 600;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 20px 10px rgba(255, 255, 255, 0);
            }
        }

        /* Hero Title */
        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            color: white;
            line-height: 1.2;
        }

        .text-gradient {
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .text-gradient-light {
            background: linear-gradient(135deg, #ffffff 0%, #82b1ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(1rem, 2vw, 1.25rem);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
        }

        /* Animated Buttons */
        .btn-animated {
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-animated::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-animated:hover::before {
            width: 300px;
            height: 300px;
        }

        .btn-animated:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .arrow-icon {
            transition: transform 0.3s ease;
        }

        .btn-animated:hover .arrow-icon {
            transform: translateX(5px);
        }

        /* Scroll Indicator */
        .scroll-indicator {
            margin-top: 60px;
        }

        .scroll-link {
            display: inline-block;
            width: 40px;
            height: 60px;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            position: relative;
            animation: bounce 2s infinite;
        }

        .scroll-link i {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 20px;
            animation: scrollDown 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }

        @keyframes scrollDown {
            0% {
                opacity: 0;
                top: 10px;
            }
            50% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                top: 30px;
            }
        }

        /* Stats Section */
        .stats-section {
            padding: 60px 0;
            background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }

        .stat-card {
            text-align: center;
            color: white;
            padding: 20px;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
        }

        .stat-icon {
            font-size: 48px;
            margin-bottom: 15px;
            opacity: 0.8;
        }

        .stat-number {
            font-size: 48px;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-label {
            font-size: 16px;
            margin: 0;
            opacity: 0.9;
        }

        /* Section Styling */
        .section-badge {
            display: inline-block;
            padding: 8px 20px;
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            color: white;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 2.5rem);
            font-weight: 700;
            color: #2c3e50;
            margin: 20px 0;
        }

        .section-subtitle {
            font-size: 18px;
            color: #6c757d;
            line-height: 1.8;
        }

        /* Feature Cards */
        .feature-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            height: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #4680ff 0%, #82b1ff 100%);
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 60px rgba(70, 128, 255, 0.2);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            transition: all 0.4s ease;
        }

        .feature-icon i {
            font-size: 40px;
            color: white;
        }

        .feature-card:hover .feature-icon {
            transform: rotateY(360deg);
        }

        .feature-title {
            font-size: 22px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .feature-description {
            font-size: 16px;
            color: #6c757d;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .feature-link {
            color: #4680ff;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .feature-link:hover {
            color: #2c3e50;
            transform: translateX(5px);
        }

        /* Process Cards */
        .process-section {
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
            padding: 80px 0;
            position: relative;
            overflow: hidden;
        }

        .process-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
        }

        .process-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(70, 128, 255, 0.15);
        }

        .process-number {
            position: absolute;
            top: -20px;
            right: 20px;
            font-size: 60px;
            font-weight: 700;
            color: #4680ff;
            opacity: 0.1;
            transition: all 0.4s ease;
        }

        .process-card:hover .process-number {
            opacity: 0.3;
            transform: scale(1.2);
        }

        .process-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
        }

        .process-icon i {
            font-size: 40px;
            color: white;
        }

        .process-card:hover .process-icon {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 10px 30px rgba(70, 128, 255, 0.4);
        }

        .process-title {
            font-size: 20px;
            font-weight: 700;
            color: #2c3e50;
            margin: 20px 0 15px;
        }

        .process-description {
            font-size: 15px;
            color: #6c757d;
            line-height: 1.6;
            margin: 0;
        }

        .process-line {
            height: 2px;
            background: linear-gradient(90deg, #4680ff 0%, #82b1ff 100%);
            margin: 60px 0;
            position: relative;
        }

        .process-line::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 15px solid #82b1ff;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
        }

        /* CTA Section */
        .cta-section {
            position: relative;
        }

        .cta-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(70, 128, 255, 0.9) 0%, rgba(44, 62, 80, 0.95) 100%);
        }

        .cta-title {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            color: white;
            line-height: 1.3;
            margin-bottom: 25px;
        }

        .cta-subtitle {
            font-size: 20px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.8;
            margin-bottom: 40px;
        }

        /* Testimonial Cards */
        .testimonial-section {
            padding: 80px 0;
            background: white;
        }

        .testimonial-card {
            background: white;
            border-radius: 20px;
            padding: 35px;
            height: 100%;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
        }

        .testimonial-card::before {
            content: '"';
            position: absolute;
            top: -20px;
            left: 20px;
            font-size: 150px;
            color: rgba(70, 128, 255, 0.05);
            font-family: Georgia, serif;
            line-height: 1;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(70, 128, 255, 0.15);
        }

        .testimonial-rating {
            display: flex;
            gap: 5px;
            margin-bottom: 20px;
            font-size: 18px;
            color: #ffc107;
        }

        .testimonial-text {
            font-size: 16px;
            color: #2c3e50;
            line-height: 1.8;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }

        .author-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #4680ff;
        }

        .author-name {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 5px;
        }

        .author-role {
            font-size: 14px;
            color: #6c757d;
            margin: 0;
        }

        /* Location Section */
        .location-section {
            padding: 80px 0;
            background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
        }

        .location-info {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            gap: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-left: 5px solid transparent;
        }

        .info-card:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(70, 128, 255, 0.15);
            border-left-color: #4680ff;
        }

        .info-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .info-icon i {
            font-size: 28px;
            color: white;
        }

        .info-content {
            flex-grow: 1;
        }

        .info-title {
            font-size: 18px;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 10px;
        }

        .info-text {
            font-size: 15px;
            color: #6c757d;
            line-height: 1.6;
            margin: 0;
        }

        .map-container {
            position: relative;
        }

        #map {
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            border: 3px solid #f0f0f0;
            transition: all 0.3s ease;
        }

        #map:hover {
            box-shadow: 0 15px 50px rgba(70, 128, 255, 0.2);
        }

        .map-info {
            margin-top: 15px;
            font-size: 13px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .stats-section {
                margin-top: 0;
            }

            .stat-number {
                font-size: 36px;
            }

            .stat-label {
                font-size: 14px;
            }

            .feature-card,
            .process-card,
            .testimonial-card {
                margin-bottom: 20px;
            }

            .process-line {
                display: none;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .cta-title {
                font-size: 1.8rem;
            }

            #map {
                height: 350px !important;
            }

            .location-info {
                order: 2;
            }

            .map-container {
                order: 1;
                margin-bottom: 30px;
            }
        }

        /* Additional Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Loading Animation for Stats Counter */
        .stat-number {
            display: inline-block;
        }
    </style>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDummyKeyForNow&libraries=places"></script>

    <script>
        // Initialize Google Maps
        function initializeMap() {
            // Default location: Based on Google Maps link provided
            // Link: https://maps.app.goo.gl/fD3sp77vSd5vpUYv7
            const desaLocation = {
                lat: -7.2575,
                lng: 112.7521
            };

            // Create map
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: desaLocation,
                mapTypeControl: true,
                fullscreenControl: true,
                streetViewControl: true,
                zoomControl: true,
                mapTypeId: 'roadmap',
                styles: [
                    {
                        "featureType": "all",
                        "elementType": "geometry.fill",
                        "stylers": [
                            {
                                "weight": "2.00"
                            }
                        ]
                    },
                    {
                        "featureType": "all",
                        "elementType": "geometry.stroke",
                        "stylers": [
                            {
                                "color": "#9c9c9c"
                            }
                        ]
                    }
                ]
            });

            // Add marker
            const marker = new google.maps.Marker({
                position: desaLocation,
                map: map,
                title: 'Lokasi Desa',
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 12,
                    fillColor: '#4680ff',
                    fillOpacity: 1,
                    strokeColor: '#ffffff',
                    strokeWeight: 2
                }
            });

            // Add info window
            const infoWindow = new google.maps.InfoWindow({
                content: `
                    <div style="padding: 15px; font-family: Arial, sans-serif;">
                        <h3 style="margin: 0 0 10px; color: #2c3e50; font-size: 16px;">Kantor Desa Candi</h3>
                        <p style="margin: 5px 0; color: #6c757d; font-size: 13px;">
                            <strong>Alamat:</strong> Jl. Raya Candi, Desa Candi, Kabupaten Sidoarjo
                        </p>
                        <p style="margin: 5px 0; color: #6c757d; font-size: 13px;">
                            <strong>Telepon:</strong> (031) 1234-5678
                        </p>
                        <p style="margin: 0; color: #6c757d; font-size: 13px;">
                            <strong>Email:</strong> info@desacandi.id
                        </p>
                    </div>
                `
            });

            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });

            // Open info window by default
            infoWindow.open(map, marker);

            // Store map reference for updating location
            window.desaMap = map;
            window.desaMarker = marker;
            window.desaInfoWindow = infoWindow;
        }

        // Initialize map when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for Google Maps to load
            if (typeof google !== 'undefined' && google.maps) {
                initializeMap();
            } else {
                // Retry if Google Maps not loaded yet
                setTimeout(initializeMap, 1000);
            }

            // Handle open maps button
            const openMapsBtn = document.getElementById('open-maps');
            if (openMapsBtn) {
                openMapsBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.open('https://maps.app.goo.gl/fD3sp77vSd5vpUYv7', '_blank');
                });
            }
        });

        // Function to update map location (call this with Google Maps link)
        window.updateMapLocation = function(lat, lng, address, mapLink) {
            if (window.desaMap) {
                const newLocation = { lat: parseFloat(lat), lng: parseFloat(lng) };
                window.desaMap.setCenter(newLocation);
                window.desaMarker.setPosition(newLocation);
                
                document.getElementById('village-address').textContent = address;
                
                if (mapLink) {
                    document.getElementById('open-maps').href = mapLink;
                    document.getElementById('open-maps').target = '_blank';
                }
                
                window.desaInfoWindow.setContent(`
                    <div style="padding: 15px; font-family: Arial, sans-serif;">
                        <h3 style="margin: 0 0 10px; color: #2c3e50; font-size: 16px;">Kantor Desa</h3>
                        <p style="margin: 5px 0; color: #6c757d; font-size: 13px;">
                            <strong>Alamat:</strong> ${address}
                        </p>
                        <p style="margin: 5px 0; color: #6c757d; font-size: 13px;">
                            <strong>Telepon:</strong> (021) 3193-7190
                        </p>
                        <p style="margin: 0; color: #6c757d; font-size: 13px;">
                            <strong>Email:</strong> info@desaku.id
                        </p>
                    </div>
                `);
                window.desaInfoWindow.open(window.desaMap, window.desaMarker);
            }
        };

    </script>

    <script>
        // Counter Animation
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.stat-number');
            const speed = 200;

            const animateCounter = (counter) => {
                const target = +counter.getAttribute('data-count');
                const count = +counter.innerText;
                const increment = target / speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count + increment);
                    setTimeout(() => animateCounter(counter), 1);
                } else {
                    counter.innerText = target + '+';
                }
            };

            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        animateCounter(counter);
                        observer.unobserve(counter);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => {
                observer.observe(counter);
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.hero-section');
                if (parallax) {
                    parallax.style.transform = 'translateY(' + scrolled * 0.5 + 'px)';
                }
            });

            // Add hover effect sound (optional)
            const cards = document.querySelectorAll('.feature-card, .process-card, .testimonial-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });
        });
    </script>
@endsection