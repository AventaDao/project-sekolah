<!DOCTYPE html>
<html lang="id">

<head>
    <title><?php echo $__env->yieldContent('title'); ?> - Aplikasi Sistem Informasi Desa Kedung Kendo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Aplikasi Sistem Informasi Desa Kedung Kendo membantu pengelolaan data dan informasi desa secara digital.">
    <meta name="keywords" content="Sistem Informasi Desa, Desa Kedung Kendo, SID, Data Desa, Pemerintahan Desa">
    <meta name="author" content="Desa Kedung Kendo">

    <link rel="icon" href="<?php echo e(asset('assets/images/favicon.svg')); ?>" type="image/x-icon">

    <!-- CSS -->
    <link href="<?php echo e(asset('assets/css/plugins/animate.min.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/feather.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/fontawesome.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/fonts/material.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>" id="main-style-link">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style-preset.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/landing.css')); ?>">

    <style>
        .navbar {
            transition: background .2s ease-in-out;
            background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%) !important;
            box-shadow: 0 5px 20px rgba(70, 128, 255, 0.15);
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .navbar.default {
            transition: background .2s ease-in-out;
            background: linear-gradient(135deg, #4680ff 0%, #2c3e50 100%) !important;
        }
        .navbar-dark .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .navbar-dark .navbar-nav .nav-link:hover,
        .navbar-dark .navbar-nav .nav-link.active {
            color: white !important;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar-dark .navbar-brand {
            filter: brightness(1.2);
        }
    </style>
</head>

<body class="landing-page">
    <!-- Loader -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark top-nav-collapse default py-0">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img width="70" src="<?php echo e(asset('assets/images/my/icon-sda.png')); ?>" alt="logo Desa Candi">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item pe-1">
                        <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="/#home">Beranda</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link" href="/#fitur">Fitur</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link" href="/#faq">FAQ</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link" href="/#lokasi">Lokasi</a>
                    </li>
                    <li class="nav-item pe-1">
                        <a class="nav-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" href="/dashboard">Dashboard</a>
                    </li>
                    <!-- <li class="nav-item pe-1">
                        <a class="nav-link <?php echo e(request()->is('profil-desa') ? 'active' : ''); ?>" href="/profil-desa">Profil Desa</a>
                    </li> -->
                    <li class="nav-item pe-1">
                        <a class="nav-link <?php echo e(request()->is('kontak') ? 'active' : ''); ?>" href="/contact-us">Kontak</a>
                    </li>
                    <?php if(auth()->check()): ?>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="/myprofile">Hai, <?php echo e(auth()->user()->name); ?></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="btn btn-primary" href="/login">Login</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <footer class="footer bg-dark text-white py-4">
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?php echo e(asset('assets/images/my/icon-sda.png')); ?>" alt="Logo Desa Candi" class="img-fluid mb-3" style="max-width: 200px;">
                        <p class="opacity-75">Desa Kedung Kendo berkomitmen untuk membangun tata kelola pemerintahan desa yang transparan, akuntabel, dan berorientasi pada pelayanan masyarakat.</p>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-sm-4">
                                <h5 class="text-white mb-4">Navigasi</h5>
                                <ul class="list-unstyled footer-link">
                                    <li><a href="/">Beranda</a></li>
                                    <li><a href="/dashboard">Dashboard</a></li>
                                    <li><a href="/profil-desa">Profil Desa</a></li>
                                    <li><a href="/kontak">Kontak</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-white mb-4">Alamat Kantor</h5>
                                <ul class="list-unstyled footer-link">
                                    <li class="d-flex">
                                        <i class="ti ti-map-pin me-2 mt-1"></i>
                                        <span>Jl. Raya Sugihwaras , Kecamatan Candi, Kabupaten Sidoarjo, Jawa Timur</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="ti ti-mail me-2 mt-1"></i>
                                        <span>info@desakdk.id</span>
                                    </li>
                                    <li class="d-flex">
                                        <i class="ti ti-phone me-2 mt-1"></i>
                                        <span>(031) 1234-5678</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-4">
                                <h5 class="text-white mb-4">Tautan Lainnya</h5>
                                <ul class="list-unstyled footer-link">
                                    <li><a href="#">Kebijakan Privasi</a></li>
                                    <li><a href="#">Syarat & Ketentuan</a></li>
                                    <li><a href="#">Peta Desa</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-footer">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col my-1">
                        <p class="text-white mb-0">© <?php echo e(date('Y')); ?> Pemerintah Desa Kedung Kendo. Semua hak dilindungi.</p>
                    </div>
                    <div class="col-auto my-1">
                        <ul class="list-inline footer-sos-link mb-0">
                            <li class="list-inline-item"><a href="#"><i class="ph-duotone ph-facebook-logo f-20"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ph-duotone ph-instagram-logo f-20"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="ph-duotone ph-youtube-logo f-20"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS -->
    <script src="../assets/js/plugins/popper.min.js"></script>
    <script src="../assets/js/plugins/simplebar.min.js"></script>
    <script src="../assets/js/plugins/bootstrap.min.js"></script>
    <script src="../assets/js/fonts/custom-font.js"></script>
    <script src="../assets/js/pcoded.js"></script>
    <script src="../assets/js/plugins/feather.min.js"></script>
    <script src="<?php echo e(asset('assets/js/plugins/wow.min.js')); ?>"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.marquee/1.4.0/jquery.marquee.min.js"></script>

    <script>
        layout_change('light');
        change_box_container('false');
        layout_rtl_change('false');
        preset_change("preset-1");
        font_change("Public-Sans");

        let ost = 0;
        document.addEventListener('scroll', function() {
            let cOst = document.documentElement.scrollTop;
            if (cOst == 0) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
            } else if (cOst > ost) {
                document.querySelector(".navbar").classList.add("top-nav-collapse");
                document.querySelector(".navbar").classList.remove("default");
            } else {
                document.querySelector(".navbar").classList.add("default");
                document.querySelector(".navbar").classList.remove("top-nav-collapse");
            }
            ost = cOst;
        });

        new WOW().init();
    </script>
</body>
</html>
<?php /**PATH C:\project-sekolah\resources\views/layouts/landing.blade.php ENDPATH**/ ?>