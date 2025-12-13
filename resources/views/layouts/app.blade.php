<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Tower Management & Service')</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Swiper --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

    {{-- AOS --}}
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    {{-- Lightbox --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css"/>

    @stack('styles')

    <style>
        /* -------------------------------------
           COLOR THEME: SOFT LIGHT (WHITE & AMBER)
        ---------------------------------------*/
        :root {
            --accent: #FFC300; /* Aksen Kuning Emas */
            --bg-light: #F2F4F8; /* Latar Belakang Utama (Putih keabu-abuan lembut) */
            --bg-card: #FCFDFE; /* Latar belakang card/elemen putih */
            --text-dark: #2C3E50; /* Teks Utama (Biru tua lembut) */
            --text-muted: #7F8C8D; /* Teks Sekunder/Muted */
            --border-subtle: #DDE1E8; /* Border tipis */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        /* NAVBAR (Tema Putih/Transparan) */
        .navbar {
            background: rgba(255, 255, 255, 0.9); /* Latar belakang putih transparan */
            backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--border-subtle);
            padding: 15px 0;
            transition: padding .3s, background .3s;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .navbar.scrolled {
            padding: 10px 0;
            background: var(--bg-card); /* Lebih solid saat di-scroll */
        }

        /* BRANDING */
        .navbar-brand strong {
            color: var(--accent) !important;
            transition: color .3s;
        }
        .navbar-brand span {
            color: var(--text-dark) !important;
        }

        /* Nav Links */
        .nav-link {
            color: var(--text-dark) !important; /* Teks gelap di latar putih */
            font-weight: 500;
            font-size: 0.95rem;
            padding: 10px 18px !important;
            transition: .3s;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent) !important; /* Hover ke Kuning Emas */
            opacity: 0.9;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            background: var(--bg-card); /* Latar belakang putih */
            border: 1px solid var(--border-subtle);
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            display: none;
            margin-top: 0;
        }
        .dropdown:hover .dropdown-menu {
             display: block;
        }

        .dropdown-item {
            color: var(--text-dark);
            font-weight: 400;
            padding: 10px 18px;
            font-size: 0.9rem;
            transition: .2s;
        }

        .dropdown-item:hover {
            background: var(--accent);
            color: var(--text-dark) !important; /* Teks gelap saat hover kuning */
        }

        /* Tombol Aksi */
        .btn-warning {
            background: var(--accent);
            border: 1px solid var(--accent);
            color: var(--text-dark) !important; /* Teks gelap pada tombol kuning */
            font-weight: 600;
            transition: all .3s ease;
        }
        .btn-warning:hover {
            background: #FFD700;
            border-color: #FFD700;
            box-shadow: 0 4px 10px rgba(255, 195, 0, 0.4);
        }
        /* Ikon Nav-toggler (diperjelas untuk latar putih) */
        .navbar-toggler {
            color: var(--text-dark) !important;
            border-color: var(--border-subtle) !important;
        }
        .navbar-toggler:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 195, 0, 0.25);
        }

        /* Footer */
        footer {
            background: var(--bg-card); /* Latar putih untuk footer */
            border-top: 1px solid var(--border-subtle);
            color: var(--text-muted) !important; /* Teks muted */
        }
        footer p {
             color: var(--text-muted) !important;
        }

        /* Mobile Adjustments */
        @media (max-width:991px) {
            .nav-link { padding: 12px 10px !important; }
            .dropdown-menu {
                position: relative;
                float: none;
                margin-top: 5px;
            }
        }
    </style>

</head>
<body>

{{-- ✅ NAVBAR --}}
<nav class="navbar navbar-expand-lg sticky-top" data-aos="fade-down" id="mainNav">
    <div class="container">

        {{-- BRANDING "TOWER" (Teks Gelap & Kuning Emas) --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logotower.png') }}" height="45" class="me-2 rounded-circle" alt="Tower Logo">
            <strong style="font-size: 1.25rem;">TOWER</strong>
            <span class="ms-2 d-none d-sm-inline" style="font-weight: 400; font-size: 0.8rem;">Management</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="nav">
            {{-- Link Navigasi --}}
            <ul class="navbar-nav ms-auto me-3">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs(['about', 'gallery.index', 'faq', 'syaratketentuan', 'kontak']) ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Informasi</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a class="dropdown-item" href="{{ route('gallery.index') }}">Gallery</a></li>
                        <li><a class="dropdown-item" href="{{ route('faq') }}">FAQs</a></li>
                        <li><a class="dropdown-item" href="{{ route('syaratketentuan') }}">Syarat & Ketentuan</a></li>
                        <li><a class="dropdown-item" href="{{ route('kontak') }}">Kontak Kami</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs(['products', 'services']) ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Layanan</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('products') }}">Produk Kami</a></li>
                        <li><a class="dropdown-item" href="{{ route('services') }}">Layanan Kami</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('booking') }}" class="nav-link {{ request()->routeIs('booking') ? 'active' : '' }}">Reservasi</a>
                </li>
            </ul>

            {{-- Tombol Aksi (Kuning Emas di Latar Putih) --}}
            <div class="d-flex align-items-center mt-2 mt-lg-0">

                {{-- Tombol Dukungan/Kontak --}}
                <a href="{{ route('contact') }}" class="btn btn-warning rounded-pill px-4 py-2">
                    <i class="fas fa-headset me-2"></i> Dukungan
                </a>
            </div>

        </div>
    </div>
</nav>

{{-- CONTENT --}}
<main>
    @yield('content')
</main>

{{-- FOOTER ELEGAN MODERN --}}
<footer class="py-5 mt-5" style="background: var(--bg-card); border-top: 1px solid var(--border-subtle); color: var(--text-dark);">
    <div class="container">
        <div class="row g-5">

            {{-- KOLOM 1: BRANDING & DESKRIPSI SINGKAT --}}
            <div class="col-lg-4 col-md-6">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('assets/img/logotower.png') }}" height="50" class="me-3 rounded-circle" alt="Tower Logo">
                    <h4 class="mb-0 fw-bolder" style="color: var(--accent);">TOWER<span class="ms-1 fw-light text-dark" style="font-size: 0.9rem;">Management</span></h4>
                </div>
                <p class="small text-muted mb-4">
                    Penyedia solusi terdepan untuk tower management, konstruksi, dan engineering di Indonesia. Kami membangun fondasi yang kokoh untuk masa depan Anda.
                </p>
                {{-- Tautan Sosial --}}
                <div class="d-flex gap-3">
                    <a href="#" class="text-decoration-none text-muted" style="transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">
                        <i class="fab fa-facebook-f fa-lg"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-muted" style="transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-muted" style="transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">
                        <i class="fab fa-linkedin-in fa-lg"></i>
                    </a>
                    <a href="#" class="text-decoration-none text-muted" style="transition: color 0.2s;" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </a>
                </div>
            </div>

            {{-- KOLOM 2: QUICK LINKS (Navigasi Cepat) --}}
            <div class="col-lg-2 col-md-6">
                <h6 class="fw-bold mb-3 text-dark">Navigasi Cepat</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Home</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Tentang Kami</a></li>
                    <li class="mb-2"><a href="{{ route('gallery.index') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Gallery</a></li>
                    <li class="mb-2"><a href="{{ route('faq') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">FAQs</a></li>
                    <li class="mb-2"><a href="{{ route('syaratketentuan') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            {{-- KOLOM 3: LAYANAN & KONTAK --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3 text-dark">Layanan Utama</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="{{ route('products') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Produk Tower</a></li>
                    <li class="mb-2"><a href="{{ route('services') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Jasa Engineering</a></li>
                    <li class="mb-2"><a href="{{ route('booking') }}" class="text-decoration-none text-muted" onmouseover="this.style.color='var(--accent)'" onmouseout="this.style.color='var(--text-muted)'">Reservasi Konsultasi</a></li>
                </ul>
            </div>

            {{-- KOLOM 4: KONTAK TERAKHIR --}}
            <div class="col-lg-3 col-md-6">
                <h6 class="fw-bold mb-3 text-dark">Hubungi Kami</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2 d-flex align-items-start">
                        <i class="fas fa-map-marker-alt text-accent me-2 mt-1"></i>
                        <span class="text-muted">Jl. Jenderal Sudirman No.10, Jakarta Pusat 10220</span>
                    </li>
                    <li class="mb-2 d-flex align-items-start">
                        <i class="fas fa-phone-alt text-accent me-2 mt-1"></i>
                        <span class="text-muted">(021) 1234-TOWER</span>
                    </li>
                    <li class="mb-2 d-flex align-items-start">
                        <i class="fas fa-envelope text-accent me-2 mt-1"></i>
                        <span class="text-muted">info@towerindo.com</span>
                    </li>
                </ul>
            </div>

        </div>

        {{-- COPYRIGHT BAR (Pemisah) --}}
        <div class="text-center pt-4 mt-4 border-top" style="border-color: var(--border-subtle) !important;">
            <p class="mb-0 small text-muted">© {{ date('Y') }} Tower Management. All rights reserved. Managed by Tower Group.</p>
        </div>
    </div>
</footer>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<script>
    AOS.init({ duration:800, once:true });

    // JavaScript untuk menambahkan kelas 'scrolled' pada Navbar saat di-scroll
    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $('#mainNav').addClass('scrolled');
        } else {
            $('#mainNav').removeClass('scrolled');
        }
    });
    // Menambahkan fungsionalitas Bootstrap Dropdown pada hover (untuk desktop)
    $('.dropdown').hover(function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(200);
    }, function() {
        $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(200);
    });
</script>

@stack('scripts')

</body>
</html>
