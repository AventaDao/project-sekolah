<?php $__env->startSection('title', 'Selamat Datang di Sistem Informasi Desa'); ?>

<?php $__env->startSection('content'); ?>
    <!-- [ Header ] start -->
    <header id="home" class="hero-section d-flex align-items-center"
        style="position: relative; min-height: 100vh; background: url('<?php echo e(asset('assets/images/my/ppdesa.jpeg')); ?>') no-repeat center center; background-size: cover; background-attachment: scroll;">
        
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
                        <a href="<?php echo e(route('login')); ?>"
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
                <!-- <div class="col-6 col-md-3">
                    <div class="stat-card wow fadeInUp" data-wow-delay="0.3s">
                        <div class="stat-icon">
                            <i class="ti ti-chart-line"></i>
                        </div>
                        <h2 class="stat-number" data-count="10">0</h2>
                        <p class="stat-label">Program Desa</p>
                    </div>
                </div> -->
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

    <!-- [ FAQ Section ] start -->
    <section class="faq-section" id="faq">
        <div class="container title">
            <div class="row justify-content-center text-center wow fadeInUp" data-wow-delay="0.2s">
                <div class="col-md-10 col-xl-7">
                    <span class="section-badge">Bantuan & Panduan</span>
                    <h2 class="section-title">Pertanyaan yang Sering Diajukan</h2>
                    <p class="section-subtitle">Temukan jawaban untuk pertanyaan umum seputar penggunaan Sistem Informasi Desa. Jika tidak menemukan jawaban yang Anda cari, silakan hubungi kami.</p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="container mt-4">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-md-8 col-lg-6">
                    <div class="faq-search-box">
                        <i class="ti ti-search search-icon"></i>
                        <input type="text" id="faqSearch" class="faq-search-input" placeholder="Cari pertanyaan...">
                        <span class="search-result-count" id="searchResultCount"></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FAQ Categories Tabs -->
        <div class="container mt-5">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.4s">
                <div class="col-12">
                    <ul class="nav nav-pills faq-tabs justify-content-center mb-5" id="faqTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#tab-account" type="button" role="tab">
                                <i class="ti ti-user-circle me-2"></i>Tentang Akun
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-letter" type="button" role="tab">
                                <i class="ti ti-file-text me-2"></i>Pengajuan Surat
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-status" type="button" role="tab">
                                <i class="ti ti-chart-line me-2"></i>Status & Tracking
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="pill" data-bs-target="#tab-download" type="button" role="tab">
                                <i class="ti ti-download me-2"></i>Download & Cetak
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- FAQ Content -->
            <div class="tab-content wow fadeInUp" data-wow-delay="0.5s" id="faqTabContent">
                <!-- Tab 1: Tentang Akun -->
                <div class="tab-pane fade show active" id="tab-account" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accordion faq-accordion" id="accordionAccount">
                                <!-- Question 1 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Bagaimana cara mendaftar akun?
                                        </button>
                                    </h2>
                                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#accordionAccount">
                                        <div class="accordion-body">
                                            <p><strong>Untuk mendaftar akun, ikuti langkah berikut:</strong></p>
                                            <ol>
                                                <li>Klik tombol <strong>"Login"</strong> di pojok kanan atas halaman</li>
                                                <li>Pilih <strong>"Belum punya akun? Daftar di sini"</strong></li>
                                                <li>Isi formulir registrasi dengan data lengkap Anda (terdiri dari 5 step):
                                                    <ul>
                                                        <li><strong>Step 1:</strong> Data Identitas (NIK, Nama, Tempat/Tanggal Lahir, Jenis Kelamin)</li>
                                                        <li><strong>Step 2:</strong> Data Alamat lengkap</li>
                                                        <li><strong>Step 3:</strong> Data Lainnya (Agama, Status Perkawinan, Pekerjaan, dll)</li>
                                                        <li><strong>Step 4:</strong> Data Keluarga (opsional)</li>
                                                        <li><strong>Step 5:</strong> Data Akun (Email & Password)</li>
                                                    </ul>
                                                </li>
                                                <li>Verifikasi email Anda dengan klik link yang dikirim ke email</li>
                                                <li>Setelah verifikasi berhasil, Anda bisa login dan menggunakan sistem</li>
                                            </ol>
                                            <div class="alert alert-info mt-3 mb-0">
                                                <i class="ti ti-info-circle me-2"></i>
                                                <strong>Tips:</strong> Pastikan email yang Anda masukkan aktif karena akan digunakan untuk notifikasi status surat.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Apakah bisa login dengan akun Google?
                                        </button>
                                    </h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                                        <div class="accordion-body">
                                            <p><strong>Ya, sistem kami mendukung Social Authentication!</strong></p>
                                            <p>Anda dapat login menggunakan akun Google atau GitHub. Namun, untuk login pertama kali dengan akun sosial, Anda tetap perlu melengkapi data penduduk (NIK, alamat, dll) untuk keperluan administrasi desa.</p>
                                            <p><strong>Cara login dengan Google:</strong></p>
                                            <ol>
                                                <li>Di halaman login, klik tombol <strong>"Login with Google"</strong></li>
                                                <li>Pilih akun Google Anda</li>
                                                <li>Jika ini pertama kali, Anda akan diarahkan untuk melengkapi form registrasi</li>
                                                <li>Setelah data lengkap, Anda dapat langsung menggunakan sistem</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Lupa password, bagaimana cara reset?
                                        </button>
                                    </h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                                        <div class="accordion-body">
                                            <p><strong>Untuk mereset password yang terlupa:</strong></p>
                                            <ol>
                                                <li>Klik <strong>"Lupa Password?"</strong> di halaman login</li>
                                                <li>Masukkan email yang terdaftar</li>
                                                <li>Cek email Anda, klik link reset password yang dikirimkan</li>
                                                <li>Masukkan password baru Anda</li>
                                                <li>Login dengan password baru</li>
                                            </ol>
                                            <div class="alert alert-warning mt-3 mb-0">
                                                <i class="ti ti-alert-triangle me-2"></i>
                                                <strong>Perhatian:</strong> Link reset password hanya berlaku selama 60 menit. Jika tidak dapat email, cek folder spam/junk Anda.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 4 -->
                                <!-- <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Lupa NIK untuk login, bagaimana?
                                        </button>
                                    </h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#accordionAccount">
                                        <div class="accordion-body">
                                            <p>Jika Anda lupa NIK, Anda tetap bisa login menggunakan <strong>email</strong> yang terdaftar. Sistem kami mendukung login dengan 2 metode:</p>
                                            <ul>
                                                <li><strong>Login dengan Email:</strong> Gunakan email dan password Anda</li>
                                                <li><strong>Login dengan NIK:</strong> Gunakan NIK dan password Anda</li>
                                            </ul>
                                            <p class="mb-0">Jika tetap tidak bisa login, hubungi admin desa melalui kontak yang tersedia di halaman Kontak.</p>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Pengajuan Surat -->
                <div class="tab-pane fade" id="tab-letter" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accordion faq-accordion" id="accordionLetter">
                                <!-- Question 1 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#letter1">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Apa saja jenis surat yang bisa diajukan?
                                        </button>
                                    </h2>
                                    <div id="letter1" class="accordion-collapse collapse show" data-bs-parent="#accordionLetter">
                                        <div class="accordion-body">
                                            <p><strong>Saat ini kami melayani berbagai jenis surat, antara lain:</strong></p>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <ul>
                                                        <li>Surat Keterangan Domisili</li>
                                                        <li>Surat Keterangan Pendapatan</li>
                                                        <li>Surat Keterangan Usaha</li>
                                                        <li>Surat Pengantar Nikah/Kawin</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <ul>
                                                        <li>Surat Keterangan Tidak Mampu</li>
                                                        <li>Surat Izin Usaha</li>
                                                        <li>Surat Keterangan Kelahiran</li>
                                                        <li>Dan berbagai surat lainnya</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <p class="mb-0 mt-3">Jenis surat yang tersedia akan muncul saat Anda mengklik menu <strong>"Ajukan Surat Baru"</strong> di dashboard Anda.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#letter2">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Bagaimana cara mengajukan surat?
                                        </button>
                                    </h2>
                                    <div id="letter2" class="accordion-collapse collapse" data-bs-parent="#accordionLetter">
                                        <div class="accordion-body">
                                            <p><strong>Langkah-langkah mengajukan surat:</strong></p>
                                            <ol>
                                                <li>Login ke sistem menggunakan akun Anda</li>
                                                <li>Masuk ke menu <strong>"Pengajuan Surat"</strong> di dashboard</li>
                                                <li>Klik tombol <strong>"Ajukan Surat Baru"</strong></li>
                                                <li>Pilih jenis surat yang Anda inginkan</li>
                                                <li>Isi formulir sesuai kebutuhan surat (tiap jenis surat memiliki form berbeda)</li>
                                                <li>Upload surat pengantar dari RT/RW (wajib, format PDF/JPG/PNG, max 2MB)</li>
                                                <li>Periksa kembali data yang Anda masukkan</li>
                                                <li>Klik <strong>"Ajukan"</strong></li>
                                                <li>Anda akan mendapat notifikasi email konfirmasi pengajuan</li>
                                            </ol>
                                            <div class="alert alert-success mt-3 mb-0">
                                                <i class="ti ti-check-circle me-2"></i>
                                                <strong>Selamat!</strong> Pengajuan Anda berhasil dikirim. Tunggu proses verifikasi dari admin desa.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#letter3">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Dokumen apa saja yang harus disiapkan?
                                        </button>
                                    </h2>
                                    <div id="letter3" class="accordion-collapse collapse" data-bs-parent="#accordionLetter">
                                        <div class="accordion-body">
                                            <p><strong>Dokumen yang wajib disiapkan:</strong></p>
                                            <ul>
                                                <li><strong>Surat Pengantar RT/RW</strong> (wajib untuk semua jenis surat)
                                                    <ul>
                                                        <li>Format: PDF, JPG, atau PNG</li>
                                                        <li>Ukuran maksimal: 2MB</li>
                                                        <li>Harus sudah ditandatangani RT/RW setempat</li>
                                                    </ul>
                                                </li>
                                                <li><strong>KTP/NIK</strong> (data sudah otomatis terisi dari profil Anda)</li>
                                                <li><strong>Dokumen pendukung lainnya</strong> (tergantung jenis surat, misalnya:
                                                    <ul>
                                                        <li>Surat nikah: Kartu Tanda Penduduk calon pasangan, Surat Keterangan dari RT/RW</li>
                                                        <li>Surat tidak mampu: Bukti penghasilan (jika ada)</li>
                                                        <li>Surat izin usaha: Foto tempat usaha, NPWP (jika ada)</li>
                                                    </ul>
                                                </li>
                                            </ul>
                                            <div class="alert alert-info mt-3 mb-0">
                                                <i class="ti ti-info-circle me-2"></i>
                                                <strong>Tips:</strong> Scan atau foto dokumen dengan jelas dan pastikan semua teks dapat dibaca dengan baik.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 4 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#letter4">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Berapa lama proses pengajuan surat?
                                        </button>
                                    </h2>
                                    <div id="letter4" class="accordion-collapse collapse" data-bs-parent="#accordionLetter">
                                        <div class="accordion-body">
                                            <p><strong>Waktu proses pengajuan surat bervariasi tergantung jenis surat:</strong></p>
                                            <ul>
                                                <li><strong>Surat Domisili:</strong> 1-3 hari kerja</li>
                                                <li><strong>Surat Keterangan Usaha:</strong> 2-5 hari kerja</li>
                                                <li><strong>Surat Pengantar Nikah:</strong> 3-7 hari kerja</li>
                                                <li><strong>Surat Keterangan Pendapatan:</strong> 2-4 hari kerja</li>
                                                <li><strong>Surat lainnya:</strong> 1-5 hari kerja</li>
                                            </ul>
                                            <p class="mb-0">Waktu tersebut dihitung sejak status berubah menjadi <span class="badge bg-warning">"Diproses"</span>. Jika dokumen Anda tidak lengkap, proses akan lebih lama atau pengajuan bisa ditolak.</p>
                                            <div class="alert alert-warning mt-3 mb-0">
                                                <i class="ti ti-clock me-2"></i>
                                                <strong>Catatan:</strong> Pengajuan yang masuk di hari Sabtu/Minggu atau hari libur akan diproses pada hari kerja berikutnya.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 3: Status & Tracking -->
                <div class="tab-pane fade" id="tab-status" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accordion faq-accordion" id="accordionStatus">
                                <!-- Question 1 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#status1">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Apa arti status "Menunggu", "Diproses", "Selesai"?
                                        </button>
                                    </h2>
                                    <div id="status1" class="accordion-collapse collapse show" data-bs-parent="#accordionStatus">
                                        <div class="accordion-body">
                                            <p><strong>Penjelasan setiap status:</strong></p>
                                            <div class="status-explanation">
                                                <div class="d-flex align-items-start mb-3">
                                                    <span class="badge bg-secondary me-3" style="min-width: 90px;">Menunggu</span>
                                                    <div>
                                                        <strong>Pengajuan masih dalam antrian</strong><br>
                                                        Dokumen Anda sudah diterima sistem dan menunggu untuk diverifikasi oleh admin desa. Ini adalah status awal setelah Anda submit pengajuan.
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start mb-3">
                                                    <span class="badge bg-warning me-3" style="min-width: 90px;">Diproses</span>
                                                    <div>
                                                        <strong>Sedang dalam proses verifikasi</strong><br>
                                                        Admin sedang memeriksa kelengkapan dokumen dan data Anda. Biasanya dalam 1-5 hari kerja akan selesai.
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start mb-3">
                                                    <span class="badge bg-success me-3" style="min-width: 90px;">Selesai</span>
                                                    <div>
                                                        <strong>Surat sudah siap diunduh</strong><br>
                                                        Surat Anda telah ditandatangani dan siap untuk diunduh/dicetak. Anda akan menerima notifikasi email.
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-start">
                                                    <span class="badge bg-danger me-3" style="min-width: 90px;">Ditolak</span>
                                                    <div>
                                                        <strong>Pengajuan tidak dapat diproses</strong><br>
                                                        Dokumen tidak lengkap atau ada data yang tidak sesuai. Anda bisa mengajukan kembali setelah melengkapi persyaratan.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#status2">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Bagaimana cara cek status pengajuan surat?
                                        </button>
                                    </h2>
                                    <div id="status2" class="accordion-collapse collapse" data-bs-parent="#accordionStatus">
                                        <div class="accordion-body">
                                            <p><strong>Untuk mengecek status pengajuan:</strong></p>
                                            <ol>
                                                <li>Login ke dashboard Anda</li>
                                                <li>Klik menu <strong>"Pengajuan Surat"</strong></li>
                                                <li>Anda akan melihat daftar semua pengajuan surat Anda</li>
                                                <li>Status akan ditampilkan di kolom <strong>"Status"</strong> dengan badge berwarna</li>
                                                <li>Klik <strong>"Detail"</strong> untuk melihat informasi lengkap pengajuan</li>
                                            </ol>
                                            <p class="mt-3 mb-0">Anda juga akan menerima <strong>notifikasi email otomatis</strong> setiap kali ada perubahan status pada pengajuan Anda.</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#status3">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Kenapa surat saya masih "Menunggu" lama?
                                        </button>
                                    </h2>
                                    <div id="status3" class="accordion-collapse collapse" data-bs-parent="#accordionStatus">
                                        <div class="accordion-body">
                                            <p><strong>Beberapa alasan mengapa status masih "Menunggu":</strong></p>
                                            <ul>
                                                <li><strong>Antrian pengajuan sedang banyak</strong> - Banyak warga yang mengajukan surat di waktu bersamaan</li>
                                                <li><strong>Hari libur/akhir pekan</strong> - Admin desa hanya bekerja di hari kerja (Senin-Jumat)</li>
                                                <li><strong>Dokumen tidak lengkap</strong> - Admin butuh waktu untuk menghubungi Anda terkait kelengkapan</li>
                                                <li><strong>Proses verifikasi membutuhkan waktu</strong> - Beberapa jenis surat memerlukan verifikasi tambahan</li>
                                            </ul>
                                            <p class="mt-3"><strong>Jika sudah lebih dari 7 hari kerja:</strong></p>
                                            <p class="mb-0">Silakan hubungi admin desa melalui:</p>
                                            <ul>
                                                <li>Email: <a href="mailto:info@desakdk.id">info@desakdk.id</a></li>
                                                <li>Telepon: (031) 1234-5678</li>
                                                <li>Datang langsung ke kantor desa</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 4: Download & Cetak -->
                <div class="tab-pane fade" id="tab-download" role="tabpanel">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="accordion faq-accordion" id="accordionDownload">
                                <!-- Question 1 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#download1">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Bagaimana cara download surat yang sudah selesai?
                                        </button>
                                    </h2>
                                    <div id="download1" class="accordion-collapse collapse show" data-bs-parent="#accordionDownload">
                                        <div class="accordion-body">
                                            <p><strong>Untuk mendownload surat:</strong></p>
                                            <ol>
                                                <li>Pastikan status surat Anda sudah <span class="badge bg-success">Selesai</span></li>
                                                <li>Masuk ke menu <strong>"Pengajuan Surat"</strong></li>
                                                <li>Cari surat yang statusnya sudah selesai</li>
                                                <li>Klik tombol <strong><i class="ti ti-download"></i> Download PDF</strong></li>
                                                <li>File PDF akan otomatis terunduh ke perangkat Anda</li>
                                                <li>Anda bisa membuka dan mencetak file PDF tersebut</li>
                                            </ol>
                                            <div class="alert alert-success mt-3 mb-0">
                                                <i class="ti ti-check-circle me-2"></i>
                                                <strong>Info:</strong> File PDF dilengkapi dengan tanda tangan digital dan QR Code untuk verifikasi keaslian.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 2 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#download2">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Apakah bisa cetak surat langsung dari sistem?
                                        </button>
                                    </h2>
                                    <div id="download2" class="accordion-collapse collapse" data-bs-parent="#accordionDownload">
                                        <div class="accordion-body">
                                            <p><strong>Ya, Anda bisa mencetak langsung!</strong></p>
                                            <p><strong>Cara Cetak Surat:</strong></p>
                                            <ol>
                                                <li>Download file PDF surat terlebih dahulu</li>
                                                <li>Buka file PDF menggunakan PDF Reader (Adobe Acrobat, Foxit, atau browser)</li>
                                                <li>Klik menu <strong>"Print"</strong> atau tekan <kbd>Ctrl + P</kbd></li>
                                                <li>Pilih printer yang tersedia</li>
                                                <li>Atur pengaturan cetak:
                                                    <ul>
                                                        <li>Ukuran kertas: <strong>A4</strong></li>
                                                        <li>Orientasi: <strong>Portrait</strong></li>
                                                        <li>Warna: <strong>Color</strong> (untuk logo dan cap resmi)</li>
                                                    </ul>
                                                </li>
                                                <li>Klik <strong>"Print"</strong></li>
                                            </ol>
                                            <div class="alert alert-info mt-3 mb-0">
                                                <i class="ti ti-printer me-2"></i>
                                                <strong>Rekomendasi:</strong> Gunakan kertas putih berkualitas baik (HVS 80 gram) untuk hasil cetak yang optimal.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 3 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#download3">
                                            <i class="ti ti-help-circle me-3"></i>
                                            Apa fungsi QR Code di surat?
                                        </button>
                                    </h2>
                                    <div id="download3" class="accordion-collapse collapse" data-bs-parent="#accordionDownload">
                                        <div class="accordion-body">
                                            <p><strong>QR Code berfungsi untuk verifikasi keaslian surat.</strong></p>
                                            <p><strong>Kegunaan QR Code:</strong></p>
                                            <ul>
                                                <li><strong>Verifikasi Keaslian</strong> - Pihak yang menerima surat dapat memverifikasi apakah surat tersebut asli atau palsu</li>
                                                <li><strong>Akses Cepat</strong> - Scan QR Code untuk langsung melihat detail surat di sistem</li>
                                                <li><strong>Anti-Pemalsuan</strong> - QR Code unik untuk setiap surat, tidak bisa dipalsukan</li>
                                                <li><strong>Transparansi</strong> - Siapa saja bisa mengecek keaslian surat tanpa perlu login</li>
                                            </ul>
                                            <p><strong>Cara verifikasi surat dengan QR Code:</strong></p>
                                            <ol>
                                                <li>Scan QR Code menggunakan kamera smartphone atau aplikasi QR scanner</li>
                                                <li>Anda akan diarahkan ke halaman verifikasi surat</li>
                                                <li>Sistem akan menampilkan detail surat: nomor pengajuan, nama pemohon, jenis surat, status, dan tanda tangan digital</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- Question 4 -->
                                <div class="accordion-item faq-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#download4">
                                            <i class="ti ti-help-circle me-3"></i>
                                            File tidak bisa didownload, kenapa?
                                        </button>
                                    </h2>
                                    <div id="download4" class="accordion-collapse collapse" data-bs-parent="#accordionDownload">
                                        <div class="accordion-body">
                                            <p><strong>Beberapa penyebab file tidak bisa didownload:</strong></p>
                                            <ul>
                                                <li><strong>Status belum Selesai</strong> - Pastikan status surat sudah <span class="badge bg-success">Selesai</span></li>
                                                <li><strong>Koneksi internet lambat/terputus</strong> - Coba refresh halaman dan download ulang</li>
                                                <li><strong>Browser tidak support</strong> - Gunakan browser modern (Chrome, Firefox, Edge)</li>
                                                <li><strong>Pop-up blocker aktif</strong> - Izinkan pop-up dari website ini</li>
                                                <li><strong>Cache browser</strong> - Clear cache browser dan coba lagi</li>
                                            </ul>
                                            <p class="mt-3"><strong>Solusi yang bisa dicoba:</strong></p>
                                            <ol>
                                                <li>Refresh halaman dengan menekan <kbd>Ctrl + F5</kbd></li>
                                                <li>Coba menggunakan browser lain</li>
                                                <li>Pastikan koneksi internet stabil</li>
                                                <li>Clear cache dan cookies browser</li>
                                                <li>Coba download di waktu lain (mungkin server sedang sibuk)</li>
                                            </ol>
                                            <p class="mb-0"><strong>Jika masih bermasalah:</strong> Hubungi admin desa dan minta dikirimkan via email atau ambil langsung di kantor desa.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact CTA -->
        <div class="container mt-5">
            <div class="row justify-content-center wow fadeInUp" data-wow-delay="0.6s">
                <div class="col-lg-8">
                    <div class="faq-contact-box text-center">
                        <i class="ti ti-message-circle-question contact-icon"></i>
                        <h4 class="mb-3">Tidak Menemukan Jawaban yang Anda Cari?</h4>
                        <p class="mb-4">Tim kami siap membantu menjawab pertanyaan Anda. Hubungi kami melalui kontak di bawah ini.</p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="/contact-us" class="btn btn-primary btn-lg">
                                <i class="ti ti-mail me-2"></i>Hubungi Kami
                            </a>
                            <a href="tel:03112345678" class="btn btn-outline-primary btn-lg">
                                <i class="ti ti-phone me-2"></i>(031) 1234-5678
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- [ FAQ Section ] End -->

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
                                <p class="info-text" id="village-address">Kantor Kepala Desa Kedung Kendo</p>
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
                        <a href="https://maps.app.goo.gl/y3gv2H7DLMvdzSSi7" class="btn btn-primary btn-lg mt-4 wow fadeInUp" data-wow-delay="0.4s" id="open-maps" target="_blank">
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
        style="position: relative; padding: 120px 0; background: url('<?php echo e(asset('assets/images/my/join-us.png')); ?>') no-repeat center center; background-size: cover; background-attachment: scroll;">
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
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-light btn-lg btn-animated wow fadeInUp" data-wow-delay="0.6s">
                        Masuk Sistem <i class="ti ti-arrow-right ms-2 arrow-icon"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- [ CTA ] End -->

    <!-- [ Testimoni ] start -->
    <!-- <section class="testimonial-section">
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
    </section> -->
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
            margin-bottom: 30px;
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
            margin-bottom: 60px;
            font-weight: 500;
            letter-spacing: 0.3px;
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
            padding-top: 40px;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
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
            padding: 80px 0;
            background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);
            margin-top: 0;
            position: relative;
            z-index: 10;
        }

        .stats-section .row {
            display: flex;
            justify-content: center;
            align-items: stretch;
        }

        .stats-section .col-6.col-md-3 {
            flex: 0 1 calc(33.333% - 15px);
            max-width: 280px;
        }

        @media (max-width: 768px) {
            .stats-section .col-6.col-md-3 {
                flex: 0 1 calc(50% - 8px);
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .stats-section .col-6.col-md-3 {
                flex: 0 1 100%;
                max-width: 100%;
            }
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
            color: white;
        }

        .stat-label {
            font-size: 16px;
            margin: 0;
            opacity: 0.9;
        }

        /* Section Styling */
        .section-badge {
            display: inline-block;
            padding: 10px 24px;
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            color: white;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 700;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 15px rgba(70, 128, 255, 0.25);
            animation: slideDown 0.6s ease;
        }

        .section-title {
            font-size: clamp(2.2rem, 5vw, 3rem);
            font-weight: 800;
            color: #1a2332;
            margin: 20px 0 15px;
            letter-spacing: -0.5px;
            line-height: 1.2;
            animation: slideUp 0.8s ease 0.1s both;
        }

        .section-subtitle {
            font-size: 18px;
            color: #4a5a6f;
            line-height: 1.9;
            margin: 0;
            font-weight: 500;
            animation: slideUp 0.8s ease 0.2s both;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Features Section Background */
        .features-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f0f4ff 0%, #ffffff 50%, #f8f9ff 100%);
            position: relative;
            overflow: hidden;
        }

        .features-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(70, 128, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .features-section::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(130, 177, 255, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
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
            z-index: 1;
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

        /* Title Container Styling */
        .container.title {
            padding-top: 20px;
            padding-bottom: 30px;
            position: relative;
            z-index: 2;
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
                padding: 60px 0;
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

            .section-subtitle {
                font-size: 16px;
            }

            .section-badge {
                padding: 8px 18px;
                font-size: 12px;
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
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(env('GOOGLE_MAPS_API_KEY')); ?>&libraries=places"></script>

    <script>
        // Initialize Google Maps
        function initializeMap() {
            // Default location: Based on Google Maps link provided
            // Link: https://maps.app.goo.gl/y3gv2H7DLMvdzSSi7
            const desaLocation = {
                lat: -7.4760844,
                lng: 112.695031
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

            // Parallax effect removed for better performance

            // Add hover effect sound (optional)
            const cards = document.querySelectorAll('.feature-card, .process-card, .testimonial-card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });

            // FAQ Search Functionality
            const faqSearch = document.getElementById('faqSearch');
            const searchResultCount = document.getElementById('searchResultCount');
            
            if (faqSearch) {
                faqSearch.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    const allFaqItems = document.querySelectorAll('.faq-item');
                    let visibleCount = 0;

                    allFaqItems.forEach(item => {
                        const question = item.querySelector('.accordion-button').textContent.toLowerCase();
                        const answer = item.querySelector('.accordion-body').textContent.toLowerCase();
                        
                        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                            item.style.display = 'block';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    // Update result count
                    if (searchTerm) {
                        searchResultCount.textContent = visibleCount + ' hasil';
                    } else {
                        searchResultCount.textContent = '';
                    }
                });
            }

            // Auto-expand first question on tab change
            document.querySelectorAll('#faqTabs button[data-bs-toggle="pill"]').forEach(button => {
                button.addEventListener('shown.bs.tab', function(e) {
                    const targetTab = document.querySelector(this.getAttribute('data-bs-target'));
                    const firstItem = targetTab.querySelector('.accordion-item:first-child .accordion-collapse');
                    if (firstItem && !firstItem.classList.contains('show')) {
                        const collapseInstance = new bootstrap.Collapse(firstItem, {
                            toggle: true
                        });
                    }
                });
            });
        });
    </script>

    <style>
        /* ========================================
           FAQ SECTION STYLES
           ======================================== */

        .faq-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f5f7ff 0%, #ffffff 50%, #f0f4ff 100%);
            position: relative;
            overflow: hidden;
        }

        .faq-section::before {
            content: '';
            position: absolute;
            top: 0;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(70, 128, 255, 0.05) 0%, transparent 70%);
            border-radius: 50%;
            animation: float 20s infinite ease-in-out;
        }

        /* FAQ Search Box */
        .faq-search-box {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }

        .faq-search-input {
            width: 100%;
            padding: 18px 60px 18px 55px;
            font-size: 16px;
            border: 2px solid #e0e7ff;
            border-radius: 50px;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(70, 128, 255, 0.08);
        }

        .faq-search-input:focus {
            outline: none;
            border-color: #4680ff;
            box-shadow: 0 6px 25px rgba(70, 128, 255, 0.15);
            transform: translateY(-2px);
        }

        .search-icon {
            position: absolute;
            left: 22px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 20px;
            color: #4680ff;
        }

        .search-result-count {
            position: absolute;
            right: 22px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            color: #6c757d;
            font-weight: 600;
            background: #f0f4ff;
            padding: 5px 12px;
            border-radius: 20px;
        }

        /* FAQ Tabs */
        .faq-tabs {
            border-bottom: 2px solid #e9ecef;
            flex-wrap: wrap;
            gap: 10px;
            padding-bottom: 10px;
        }

        .faq-tabs .nav-link {
            border: 2px solid transparent;
            border-radius: 12px;
            padding: 12px 24px;
            font-weight: 600;
            font-size: 14px;
            color: #4a5a6f;
            background: white;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .faq-tabs .nav-link:hover {
            background: #f8f9ff;
            color: #4680ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(70, 128, 255, 0.12);
        }

        .faq-tabs .nav-link.active {
            background: linear-gradient(135deg, #4680ff 0%, #82b1ff 100%);
            color: white;
            border-color: #4680ff;
            box-shadow: 0 6px 20px rgba(70, 128, 255, 0.25);
        }

        .faq-tabs .nav-link i {
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .faq-tabs {
                justify-content: flex-start;
                overflow-x: auto;
                white-space: nowrap;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
            }

            .faq-tabs::-webkit-scrollbar {
                display: none;
            }

            .faq-tabs .nav-link {
                padding: 10px 18px;
                font-size: 13px;
            }

            .faq-tabs .nav-link i {
                font-size: 16px;
            }
        }

        /* FAQ Accordion */
        .faq-accordion {
            --bs-accordion-border-color: #e9ecef;
            --bs-accordion-border-radius: 12px;
        }

        .faq-item {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            margin-bottom: 16px;
            background: white;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .faq-item:hover {
            border-color: #4680ff;
            box-shadow: 0 6px 20px rgba(70, 128, 255, 0.12);
            transform: translateY(-2px);
        }

        .faq-item .accordion-button {
            padding: 20px 24px;
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            background: white;
            border: none;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .faq-item .accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #f0f4ff 0%, #e8f1ff 100%);
            color: #4680ff;
            box-shadow: none;
        }

        .faq-item .accordion-button:focus {
            box-shadow: none;
            border-color: transparent;
        }

        .faq-item .accordion-button::after {
            width: 30px;
            height: 30px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%234680ff'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-size: 16px;
            background-position: center;
            background-repeat: no-repeat;
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }

        .faq-item .accordion-button:not(.collapsed)::after {
            transform: rotate(-180deg);
        }

        .faq-item .accordion-button .ti-help-circle {
            font-size: 22px;
            color: #4680ff;
        }

        .faq-item .accordion-body {
            padding: 24px;
            font-size: 15px;
            line-height: 1.8;
            color: #4a5a6f;
            background: white;
        }

        .faq-item .accordion-body strong {
            color: #2c3e50;
        }

        .faq-item .accordion-body ol,
        .faq-item .accordion-body ul {
            padding-left: 20px;
            margin-bottom: 16px;
        }

        .faq-item .accordion-body li {
            margin-bottom: 10px;
        }

        .faq-item .accordion-body .alert {
            border-radius: 10px;
            border-left: 4px solid;
        }

        .faq-item .accordion-body .alert-info {
            border-left-color: #4680ff;
            background: #f0f4ff;
        }

        .faq-item .accordion-body .alert-warning {
            border-left-color: #f59e0b;
            background: #fffbeb;
        }

        .faq-item .accordion-body .alert-success {
            border-left-color: #10b981;
            background: #f0fdf4;
        }

        .faq-item .accordion-body .badge {
            padding: 6px 12px;
            font-size: 13px;
            font-weight: 600;
        }

        .faq-item .accordion-body kbd {
            background: #2c3e50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
        }

        /* Status Explanation Styling */
        .status-explanation {
            padding: 12px 0;
        }

        .status-explanation .badge {
            padding: 8px 16px;
            font-size: 13px;
            border-radius: 8px;
        }

        /* FAQ Contact Box */
        .faq-contact-box {
            background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%);
            color: white;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(70, 128, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .faq-contact-box::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .faq-contact-box .contact-icon {
            font-size: 64px;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .faq-contact-box h4 {
            font-size: 26px;
            font-weight: 700;
            color: white;
        }

        .faq-contact-box p {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
        }

        .faq-contact-box .btn {
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .faq-contact-box .btn-primary {
            background: white;
            color: #4680ff;
            border: 2px solid white;
        }

        .faq-contact-box .btn-primary:hover {
            background: #f0f4ff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .faq-contact-box .btn-outline-primary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .faq-contact-box .btn-outline-primary:hover {
            background: white;
            color: #4680ff;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        /* Responsive FAQ */
        @media (max-width: 992px) {
            .faq-section {
                padding: 70px 0;
            }

            .faq-contact-box {
                padding: 40px 30px;
            }

            .faq-contact-box .contact-icon {
                font-size: 52px;
            }

            .faq-contact-box h4 {
                font-size: 22px;
            }

            .faq-item .accordion-button {
                padding: 16px 20px;
                font-size: 15px;
            }

            .faq-item .accordion-body {
                padding: 20px;
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .faq-search-input {
                padding: 15px 50px 15px 50px;
                font-size: 14px;
            }

            .search-icon {
                left: 18px;
                font-size: 18px;
            }

            .search-result-count {
                right: 18px;
                font-size: 12px;
                padding: 4px 10px;
            }

            .faq-item .accordion-button {
                padding: 14px 16px;
                font-size: 14px;
            }

            .faq-item .accordion-button .ti-help-circle {
                font-size: 18px;
                margin-right: 8px !important;
            }

            .faq-item .accordion-body {
                padding: 16px;
                font-size: 13px;
            }

            .faq-contact-box {
                padding: 30px 20px;
            }

            .faq-contact-box .contact-icon {
                font-size: 40px;
            }

            .faq-contact-box h4 {
                font-size: 20px;
            }

            .faq-contact-box .btn {
                padding: 10px 20px;
                font-size: 14px;
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Smooth Fade Animation for Tab Content */
        .tab-pane {
            animation: fadeIn 0.4s ease-in-out;
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
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.landing', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project-sekolah\resources\views/welcome.blade.php ENDPATH**/ ?>