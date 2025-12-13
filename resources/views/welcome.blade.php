@extends('layouts.app')
@section('title', 'Tower Management – Solusi Layanan & Produk Premium')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* -------------------------------------
                           COLOR THEME: MODERN LIGHT MODE (WHITE & AMBER)
                        ---------------------------------------*/
        :root {
            --accent: #FFC300;
            /* Kuning Emas */
            --bg-light: #F8F9FB;
            /* Latar Belakang Utama (Sedikit Off-white) */
            --bg-card: #FFFFFF;
            /* Latar belakang card/elemen putih bersih */
            --text-dark: #2C3E50;
            /* Teks Utama */
            --text-muted: #7F8C8D;
            /* Teks Sekunder/Muted */
            --border-subtle: #E9ECEF;
            /* Border tipis, sangat halus */
        }

        /* GLOBAL & KEPADATAN */
        body {
            background: var(--bg-light);
            color: var(--text-dark);
            font-family: 'Poppins', sans-serif;
        }

        section {
            padding: 70px 0;
        }

        h3.fw-bold {
            font-weight: 800 !important;
            /* Ditebalkan */
            font-size: 2.2rem;
            /* Ukuran disesuaikan */
        }

        .text-accent {
            color: var(--accent) !important;
        }

        /* HERO */
        .hero {
            padding: 130px 0 80px;
            background: linear-gradient(180deg, var(--bg-light), #F1F3F7);
        }

        .hero h1 {
            font-weight: 800;
            font-size: 3.2rem;
        }

        /* BUTTONS */
        .btn-main,
        .btn-soft {
            padding: 12px 28px;
            font-weight: 600;
            border-radius: 8px;
            transition: .3s;
        }

        .btn-main {
            background: var(--accent);
            border: none;
            color: var(--text-dark);
            box-shadow: 0 4px 10px rgba(255, 195, 0, 0.2);
        }

        .btn-main:hover {
            background: #ffaa00;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(255, 195, 0, 0.3);
        }

        .btn-soft {
            border: 1px solid var(--border-subtle);
            color: var(--text-dark);
            background: var(--bg-card);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        .btn-soft:hover {
            background: var(--accent);
            color: var(--text-dark);
            border-color: var(--accent);
            transform: translateY(-1px);
        }

        /* FITUR/LAYANAN */
        .feature-box {
            background: var(--bg-card);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-subtle);
            transition: .3s;
            min-height: 220px;
        }

        .feature-box:hover {
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }

        .feature-icon-wrapper {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .feature-icon-accent {
            width: 8px;
            height: 30px;
            background: var(--accent);
            margin-right: 15px;
            border-radius: 4px;
        }

        .feature-box i {
            font-size: 2rem;
            color: var(--accent);
            margin-right: 15px;
        }

        .feature-box h5 {
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .feature-box p {
            font-size: 0.9rem;
            color: var(--text-muted);
        }

        /* CARD PRODUK & LAYANAN */
        .card-item {
            background: var(--bg-card);
            border-radius: 12px;
            overflow: hidden;
            height: 440px;
            /* FIXED HEIGHT untuk kesejajaran */
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            transition: .3s;
            border: 1px solid var(--border-subtle);
        }

        .card-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .card-item .media {
            height: 200px;
            overflow: hidden;
        }

        .card-item .media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .5s;
        }

        .card-content-wrapper {
            padding: 15px 20px 20px;
            display: flex;
            flex-direction: column;
            height: calc(100% - 200px);
        }

        .card-content-wrapper h6 {
            font-weight: 600;
            font-size: 1.05rem;
            margin-bottom: 5px;
        }

        .card-content-wrapper p {
            font-size: .85rem;
            flex-grow: 1;
            margin-bottom: 10px;
        }

        .card-content-wrapper .price {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .btn-detail {
            border-radius: 6px;
            border: 1px solid var(--accent);
            background: transparent;
            color: var(--accent);
            font-weight: 600;
            padding: 8px 18px;
            transition: .3s;
        }

        .btn-detail:hover {
            background: var(--accent);
            color: var(--text-dark);
        }

        /* CTA BANNER (Perbaikan CSS) */
        .cta-banner {
            background: var(--accent);
            color: var(--text-dark);
            padding: 50px 40px;
            border-radius: 16px;
            margin: 40px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .cta-banner h2 {
            font-weight: 800;
        }

        .btn-cta {
            display: inline-block;
            background: var(--text-dark);
            color: white;
            padding: 12px 30px;
            border-radius: 6px;
            font-weight: 600;
            text-decoration: none;
            transition: .3s;
        }

        .btn-cta:hover {
            background: #000;
            transform: translateY(-1px);
        }

        /* ABOUT BOX */
        .about-box {
            background: var(--bg-card);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* TESTIMONI */
        .testi-card {
            background: var(--bg-card);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            border: 1px solid var(--border-subtle);
            min-height: 250px;
            /* Minimal tinggi agar sejajar */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .testi-card .message {
            font-style: italic;
            color: var(--text-dark);
            line-height: 1.6;
            flex-grow: 1;
        }

        .btn-testi-add {
            background: var(--bg-light);
            border: 2px dashed var(--accent);
            color: var(--accent);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-weight: 600;
            height: 250px;
            /* Sejajar dengan testi-card */
            border-radius: 12px;
        }

        .btn-testi-add:hover {
            background: var(--accent);
            color: var(--text-dark);
            border-color: var(--accent);
        }

        /* GALERI */
        .gallery-img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: .3s;
        }

        .gallery-img:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        /* MAPS */
        .maps-box {
            padding: 30px;
            background: var(--bg-card);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .map-container {
            width: 100%;
            height: 350px;
            border-radius: 12px;
            overflow: hidden;
            position: relative;
            border: 1px solid var(--border-subtle);
            margin-bottom: 20px;
        }

        .map-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(80%) brightness(1.1);
        }

        /* TESTIMONIAL CTA CARD */
        .testimonial-cta-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 40px 30px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--border-subtle);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .testimonial-cta-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), #ffaa00);
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent), #ffaa00);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: var(--text-dark);
            box-shadow: 0 6px 20px rgba(255, 195, 0, 0.3);
        }

        .cta-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .cta-description {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.6;
            margin-bottom: 25px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta-testimonial {
            background: var(--accent);
            color: var(--text-dark);
            border: none;
            padding: 14px 30px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 195, 0, 0.3);
            margin-bottom: 15px;
        }

        .btn-cta-testimonial:hover {
            background: #ffaa00;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 195, 0, 0.4);
            color: var(--text-dark);
        }

        .cta-note {
            color: var(--text-muted);
            font-size: 0.85rem;
            display: block;
        }

        /* SCROLL TO TOP BUTTON */
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--accent);
            color: var(--text-dark);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 10px rgba(255, 195, 0, 0.3);
        }

        .scroll-to-top.show {
            opacity: 1;
            visibility: visible;
        }

        .scroll-to-top:hover {
            background: #ffaa00;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 195, 0, 0.4);
        }

        /* RESPONSIVE */
        @media(max-width:991px) {
            section {
                padding: 50px 0;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            h3.fw-bold {
                font-size: 1.8rem;
            }

            .card-item {
                height: 420px;
            }
        }

        @media(max-width:576px) {
            .hero h1 {
                font-size: 1.8rem;
            }

            .btn-main,
            .btn-soft {
                padding: 10px 20px;
                font-size: 0.9rem;
                border-radius: 6px;
            }

            .card-item {
                height: 380px;
            }

            .card-item .media {
                height: 180px;
            }

            .testi-card {
                min-height: 200px;
                height: 200px;
            }

            .gallery-img {
                height: 200px;
            }
        }
    </style>
@endpush


@section('content')

    {{-- HERO --}}
    <section class="hero pb-0">
        <div class="container">
            <div class="row align-items-center gy-5">

                <div class="col-lg-6" data-aos="fade-right">
                    <h1>Tower Management — Solusi Premium untuk Layanan & Produk Anda</h1>
                    <p class="mt-3 fs-5">Kami menyediakan berbagai produk unggulan dan layanan profesional untuk mendukung
                        kebutuhan bisnis dan pribadi Anda dengan kualitas tak tertandingi.</p>

                    <div class="mt-4 d-flex gap-3">
                        <a href="{{ route('booking') }}" class="btn-main">Jadwal Booking <i
                                class="fas fa-rocket ms-2"></i></a>
                        <a href="{{ route('kontak') }}" class="btn-soft">Contact</a>
                    </div>
                </div>

                <div class="col-lg-6 text-center" data-aos="fade-left">

                    <img src="{{ asset('assets/img/logotower.png') }}" class="img-fluid"
                        style="max-width:500px;">
                </div>

            </div>
        </div>
    </section>

    {{-- FITUR/LAYANAN UTAMA (Statis) --}}
    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <h3 class="fw-bold text-center mb-5">Layanan Inti Kami</h3>
            <div class="row g-4">
                {{-- Data Statis: Jasa Konstruksi --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-accent"></div>
                            <i class="fas fa-hammer"></i>
                            <h5>Jasa Konstruksi</h5>
                        </div>
                        <p>Tim kami bertanggung jawab atas semua fase siklus hidup proyek mulai dari evaluasi awal hingga
                            *commissioning*.</p>
                    </div>
                </div>

                {{-- Data Statis: Layanan Engineering --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-accent"></div>
                            <i class="fas fa-tools"></i>
                            <h5>Layanan Engineering</h5>
                        </div>
                        <p>Towerindo memiliki kapasitas besar untuk memproses *site* dengan jumlah yang banyak dalam waktu
                            singkat.</p>
                    </div>
                </div>

                {{-- Data Statis: Manufaktur & Produksi --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-accent"></div>
                            <i class="fas fa-industry"></i>
                            <h5>Manufaktur & Produksi</h5>
                        </div>
                        <p>Kami menghadirkan produk-produk industri terkemuka dengan tingkat layanan pelanggan tertinggi.
                        </p>
                    </div>
                </div>

                {{-- Data Statis: Desain & Otomatisasi Jaringan --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-box">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-accent"></div>
                            <i class="fas fa-network-wired"></i>
                            <h5>Desain & Otomatisasi Jaringan</h5>
                        </div>
                        <p>Menyediakan solusi *one vendor* yang dimiliki dan dioperasikan sepenuhnya, dari konsep hingga
                            konektivitas.</p>
                    </div>
                </div>

                {{-- Data Statis: Layanan Inspeksi & Pemeliharaan --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-box">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-accent"></div>
                            <i class="fas fa-search-dollar"></i>
                            <h5>Layanan Inspeksi & Pemeliharaan</h5>
                        </div>
                        <p>Menawarkan layanan inspeksi pondasi yang memvalidasi pemasangan pondasi memenuhi standar desain.
                        </p>
                    </div>
                </div>

                {{-- Data Statis: Site Development (Baru) --}}
                <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-box">
                        <div class="feature-icon-wrapper">
                            <div class="feature-icon-accent"></div>
                            <i class="fas fa-code"></i>
                            <h5>Site Development (Baru)</h5>
                        </div>
                        <p>Memastikan kecepatan dan kualitas melalui akuntabilitas bersama atas kecepatan on *air* klien
                            kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- PRODUK UNGGULAN (Data dari $products) --}}
    <section class="py-5">
        <div class="container">

            <div class="d-flex justify-content-between mb-4 align-items-center">
                <h3 class="fw-bold">Produk Unggulan</h3>
                <a href="{{ route('products') }}" class="btn-soft">Lihat Semua Produk <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>

            <div class="swiper productSwiper">
                <div class="swiper-wrapper">
                    @forelse($products as $p)
                        <div class="swiper-slide">
                            <div class="card-item" data-aos="zoom-in">
                                <div class="media">
                                    <img src="{{ $p->image ? asset('storage/' . $p->image) : asset('assets/img/placeholder.png') }}"
                                        alt="{{ $p->name }}">
                                </div>
                                <div class="card-content-wrapper">
                                    <h6>{{ $p->name }}</h6>
                                    <p>{{ Str::limit(strip_tags($p->description), 80) }}</p>
                                    <div class="price text-accent">Rp {{ number_format($p->price ?? 0, 0, ',', '.') }}</div>
                                    <a href="{{ route('product.show', $p->slug ?? $p->id) }}" class="btn-detail w-100">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-muted text-center">Belum ada produk unggulan yang ditampilkan.</p>
                        </div>
                    @endforelse
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
    </section>


    {{-- LAYANAN PROFESIONAL (Data dari $services) --}}
    <section class="pt-5 pb-5 bg-light">
        <div class="container">

            <div class="d-flex justify-content-between mb-4">
                <h3 class="fw-bold">Layanan Profesional Kami</h3>
                <a href="{{ route('services') }}" class="btn-soft">Jelajahi Semua Layanan <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>

            <div class="swiper serviceSwiper">
                <div class="swiper-wrapper">
                    @forelse($services as $s)
                        <div class="swiper-slide">
                            <div class="card-item" data-aos="zoom-in">
                                <div class="media">
                                    <img src="{{ $s->image ? asset('storage/' . $s->image) : asset('assets/img/placeholder.png') }}"
                                        alt="{{ $s->name }}">
                                </div>
                                <div class="card-content-wrapper">
                                    <h6>{{ $s->name }}</h6>
                                    <p>{{ Str::limit(strip_tags($s->description), 90) }}</p>
                                    {{-- Placeholder untuk menjaga kesejajaran dengan harga produk di section sebelumnya --}}
                                    <div class="price text-white mb-2" style="visibility: hidden;">Rp 0</div>
                                    <a href="{{ route('service.show', $s->slug ?? $s->id) }}"
                                        class="btn-detail w-100">Pelajari Lebih Lanjut</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-muted text-center">Belum ada layanan profesional yang tersedia.</p>
                        </div>
                    @endforelse
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

        </div>
    </section>


    {{-- CTA BANNER --}}
    <section class="py-0">
        <div class="container">
            <div class="cta-banner text-center" data-aos="zoom-in">
                <h2>Siap Mengembangkan Bisnis Anda?</h2>
                <p class="mt-3 mb-4 fs-5">Tim ahli Tower siap membantu Anda mencapai target ambisius. Hubungi kami
                    sekarang!</p>
                <a href="{{ route('kontak') }}" class="btn-cta">Hubungi Tower Sekarang</a>
            </div>
        </div>
    </section>


    {{-- ABOUT --}}
    <section class="py-5 bg-white">
        <div class="container">
            <div class="about-box" data-aos="fade-up">
                <h3 class="fw-bold mb-3">Mengenal Tower Management</h3>
                <p>Tower Management adalah mitra terpercaya Anda, menyediakan solusi manajemen dan layanan teknis yang
                    didukung oleh tim ahli berpengalaman. Kami bertekad memberikan hasil terbaik dan nilai tambah untuk
                    setiap klien, mendorong pertumbuhan dan efisiensi.</p>
                <a href="{{ route('about') }}" class="btn-main mt-3">Tentang Kami Selengkapnya <i
                        class="fas fa-arrow-right ms-2"></i></a>
            </div>
        </div>
    </section>


    {{-- TESTIMONI (Data dari $testimonials) --}}
    <section class="py-5">
        <div class="container">
            <h3 class="fw-bold mb-5 text-center">Apa Kata Klien Kami?</h3>

            <div class="swiper testiSwiper">
                <div class="swiper-wrapper">
                    @forelse($testimonials as $t)
                        <div class="swiper-slide">
                            <div class="testi-card" data-aos="fade-up">
                                <div class="message">
                                    <i class="fas fa-quote-left text-accent me-2"></i>
                                    “{{ Str::limit($t->message, 160) }}”
                                </div>
                                <div class="mt-3">
                                    <div class="fw-bold">{{ $t->name }}</div>
                                    <small class="text-muted">{{ $t->company ?? 'Klien Terpercaya' }}</small>
                                </div>
                            </div>
                        </div>
                    @empty
                        {{-- Jika tidak ada testimoni, tampilkan placeholder --}}
                        <div class="swiper-slide">
                            <div class="testi-card text-center d-flex justify-content-center align-items-center">
                                <p class="text-muted">Belum ada testimoni yang disetujui untuk ditampilkan.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>

    {{-- KIRIM TESTIMONI ANDA --}}
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="testimonial-cta-card" data-aos="zoom-in">
                        <div class="cta-content">
                            <div class="cta-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h4 class="cta-title">Bagikan Pengalaman Anda</h4>
                            <p class="cta-description">Testimoni Anda sangat berarti bagi kami. Ceritakan pengalaman Anda
                                bekerja sama dengan Tower Management.</p>
                            <button class="btn-cta-testimonial" data-bs-toggle="modal"
                                data-bs-target="#testimonialModal">
                                <i class="fas fa-edit me-2"></i>Kirim Testimoni Anda
                            </button>
                            <small class="cta-note">Testimoni akan dimoderasi sebelum ditampilkan</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- GALERI (Data dari $galleryItems) --}}
    <section class="pt-5 pb-5 bg-white">
        <div class="container">
            <h3 class="fw-bold text-center mb-5">Portofolio & Galeri Proyek Kami</h3>

            <div class="swiper gallerySwiper">
                <div class="swiper-wrapper">
                    @forelse($galleryItems as $g)
                        <div class="swiper-slide">
                            <a href="{{ asset('storage/' . $g->image) }}" data-lightbox="gallery"
                                data-title="Galeri Tower Management" data-aos="zoom-in">
                                <img src="{{ asset('storage/' . $g->image) }}" class="gallery-img" alt="Proyek Galeri">
                            </a>
                        </div>
                    @empty
                        <div class="swiper-slide">
                            <p class="text-muted text-center">Belum ada foto galeri yang diunggah.</p>
                        </div>
                    @endforelse
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('gallery.index') }}" class="btn-soft">Lihat Selengkapnya <i
                        class="fas fa-camera-retro ms-2"></i></a>
            </div>
        </div>
    </section>


    {{-- LOKASI KAMI --}}
    <section class="py-5">
        <div class="container">
            <h3 class="fw-bold text-center mb-5">Temukan Kantor Pusat Kami</h3>

            <div class="maps-box" data-aos="zoom-in">
                <div class="map-container">

                    {{-- Placeholder Gambar Alamat/Map. Ganti dengan iframe Google Maps jika ada --}}
                    <img src="{{ asset('assets/img/map-placeholder.png') }}" alt="Lokasi Kantor Tower">
                    <div
                        style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.1);">
                        <i class="fas fa-map-marker-alt" style="font-size: 3rem; color: var(--accent);"></i>
                    </div>
                </div>

                <div class="text-center">
                    <p class="fw-bold mb-1">Kantor Pusat Tower Management</p>
                    <p class="text-muted mb-3">Jl. Jenderal Sudirman No. 123, Central Business District, Jakarta</p>

                    <a href="https://maps.app.goo.gl/Your+Address+Here" target="_blank" class="btn-main">
                        <i class="fas fa-external-link-alt me-2"></i> Buka di Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>


    {{-- Modal Form Testimoni (Mengirim ke Admin untuk Moderasi) --}}
    <div class="modal fade" id="testimonialModal" tabindex="-1" aria-labelledby="testimonialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="testimonialModalLabel">Kirim Testimoni Anda</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('testimonial.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-muted small">Testimoni akan ditinjau oleh Admin (CRUD) sebelum ditampilkan di
                            website.</p>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan Testimoni Anda</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-soft" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-main">Kirim Testimoni</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Scroll to Top Button --}}
    <button id="scrollToTopBtn" class="scroll-to-top" title="Kembali ke Atas">
        <i class="fas fa-building"></i>
    </button>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi Swiper diperbarui untuk inisiasi
            function initSwiper(el, breaks = {}) {
                const container = document.querySelector(el);
                if (!container) return; // Stop if element doesn't exist

                new Swiper(el, {
                    slidesPerView: 1.2,
                    spaceBetween: 20,
                    loop: true,
                    centeredSlides: false,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false
                    },
                    navigation: {
                        nextEl: el + ' .swiper-button-next',
                        prevEl: el + ' .swiper-button-prev'
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                            spaceBetween: 24
                        },
                        768: {
                            slidesPerView: 3,
                            spaceBetween: 28
                        },
                        1200: {
                            slidesPerView: 4,
                            spaceBetween: 30
                        },
                        ...breaks
                    }
                });
            }

            // Inisiasi Swiper untuk Produk & Layanan (4 kolom di desktop)
            initSwiper('.productSwiper');
            initSwiper('.serviceSwiper');

            // Inisiasi Swiper untuk Testimoni (3 kolom di desktop, tanpa loop agar card "Kirim Testimoni" tetap di akhir)
            initSwiper('.testiSwiper', {
                loop: false,
                breakpoints: {
                    768: {
                        slidesPerView: 2.2,
                        spaceBetween: 28
                    },
                    1200: {
                        slidesPerView: 3.2,
                        spaceBetween: 30
                    }
                }
            });

            // Inisiasi Swiper untuk Galeri (4 kolom di desktop)
            initSwiper('.gallerySwiper');

            // Scroll to Top Functionality
            const scrollToTopBtn = document.getElementById('scrollToTopBtn');

            // Show/hide button based on scroll position
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    scrollToTopBtn.classList.add('show');
                } else {
                    scrollToTopBtn.classList.remove('show');
                }
            });

            // Smooth scroll to top when button is clicked
            scrollToTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endpush
