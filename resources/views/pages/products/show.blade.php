@extends('layouts.app')

@section('title', $service->name ?? 'Detail Layanan')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* -------------------------------------
            COLOR THEME: SOFT LIGHT (WHITE & AMBER)
        ---------------------------------------*/
        :root {
            --accent: #FFC300;
            /* Kuning Emas */
            --accent-dark: #FFAA00;
            /* Kuning Lebih Gelap */
            --bg-light: #F8F9FB;
            /* Latar Belakang Utama */
            --bg-card: #FFFFFF;
            /* Latar Belakang Card */
            --text-dark: #2C3E50;
            /* Teks Utama (Dark Accent) */
            --text-muted: #7F8C8D;
            /* Teks Sekunder */
            --border-subtle: #E9ECEF;
            /* Border tipis */
            --shadow-subtle: 0 4px 15px rgba(0, 0, 0, 0.08);
            --success: #28a745;
        }

        body {
            background: var(--bg-light);
            color: var(--text-dark);
            font-family: 'Poppins', sans-serif;
        }

        /* Page background section */
        .service-wrap {
            padding: 120px 0;
            background: var(--bg-light);
        }

        /* Breadcrumb */
        .breadcrumb a {
            color: var(--text-muted) !important;
            font-size: 0.9rem;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            color: var(--border-subtle);
        }

        .breadcrumb .active {
            color: var(--accent) !important;
            font-weight: 600;
        }

        /* Service Card */
        .service-box {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 35px;
            border: 1px solid var(--border-subtle);
            box-shadow: var(--shadow-subtle);
        }

        /* Image */
        .service-main-img {
            border-radius: 15px;
            transition: .4s ease;
            border: 1px solid var(--border-subtle);
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: cover;
        }

        .service-main-img:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 30px rgba(255, 195, 0, 0.2);
        }

        /* Title */
        .service-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        /* Rating */
        .rating i {
            color: var(--accent);
        }

        /* Price */
        .price-large {
            font-size: 2rem;
            font-weight: 800;
            color: var(--text-dark);
        }

        .price-large small {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-muted);
            display: block;
        }

        /* Buttons */
        .btn-accent {
            background: var(--accent);
            color: var(--text-dark);
            font-weight: 700;
            border-radius: 40px;
            padding: 14px 35px;
            transition: .25s;
            border: 1px solid var(--accent);
        }

        .btn-accent:hover {
            background: var(--accent-dark);
            border-color: var(--accent-dark);
            box-shadow: 0 0 15px rgba(255, 195, 0, 0.5);
            transform: translateY(-2px);
        }

        .btn-outline-accent {
            border: 2px solid var(--accent);
            color: var(--accent);
            background: transparent;
            font-weight: 600;
            border-radius: 40px;
            padding: 14px 35px;
        }

        .btn-outline-accent:hover {
            background: var(--accent);
            color: var(--text-dark);
            box-shadow: 0 0 15px rgba(255, 195, 0, 0.4);
            transform: translateY(-2px);
        }

        /* Tabs */
        .nav-tabs {
            border-bottom: 1px solid var(--border-subtle);
        }

        .nav-tabs .nav-link {
            color: var(--text-muted);
            font-weight: 600;
            border: none;
            padding: 15px 20px;
            margin-bottom: -1px;
        }

        .nav-tabs .nav-link.active {
            color: var(--accent);
            border-bottom: 3px solid var(--accent);
            background: transparent;
        }

        /* Sidebar - Rekomendasi */
        .reco-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            padding: 15px;
            transition: .3s ease;
        }

        .reco-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-subtle);
            border-color: var(--accent);
        }

        .reco-card img {
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            width: 100%;
            margin-bottom: 10px;
        }

        .reco-title {
            font-size: .95rem;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.3;
        }

        /* Info list */
        .list-group-item {
            background: var(--bg-card) !important;
            border-color: var(--border-subtle);
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .list-group-item span {
            color: var(--text-dark);
            font-weight: 600;
        }

        /* Service Related Product (Tidak digunakan di sini, tapi dipertahankan jika ingin dimasukkan) */
        .product-link-card {
            background: var(--bg-card);
            border: 1px solid var(--border-subtle);
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            margin-top: 30px;
        }

        .product-link-card h5 {
            color: var(--success);
            /* Menggunakan warna hijau untuk produk/barang */
            font-weight: 700;
        }

        /* Media Queries */
        @media (max-width: 991px) {
            .service-title {
                font-size: 1.8rem;
            }

            .price-large {
                font-size: 1.6rem;
            }

            .service-box {
                padding: 25px;
            }
        }
    </style>
@endpush

@section('content')

    <div class="service-wrap">
        <div class="container">

            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services') }}">Layanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $service->name ?? 'Detail Layanan' }}</li>
                </ol>
            </nav>

            <div class="row g-5">

                {{-- Left: Service Details & Tabs (9/12) --}}
                <div class="col-lg-9">
                    <div class="service-box">

                        <div class="row g-5 align-items-center">

                            {{-- Service Image --}}
                            <div class="col-lg-5 text-center">
                                <div style="overflow: hidden;">
                                    <img src="{{ asset('storage/' . $service->image) }}" class="service-main-img"
                                        alt="{{ $service->name }}">
                                </div>
                                <div class="text-muted small mt-2">
                                    <i class="bi bi-geo-alt"></i> Tersedia Onsite & Homecare
                                </div>
                            </div>

                            {{-- Service Info --}}
                            <div class="col-lg-7">

                                <span class="badge bg-opacity-10 py-2 px-3 mb-2"
                                    style="background-color: var(--accent); color: var(--text-dark); font-weight: 600;">
                                    {{ $service->category ?? 'Perawatan Ibu & Bayi' }}
                                </span>

                                <h1 class="service-title mb-2">{{ $service->name }}</h1>

                                <div class="rating mb-3">
                                    {{-- Rating Statis untuk tampilan --}}
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <span class="text-muted small ms-2">(4.8 / 100+ Ulasan)</span>
                                </div>

                                <div class="price-large mb-4">
                                    <small>Harga Mulai Dari</small>
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </div>

                                @if ($service->short_description)
                                    <p class="text-secondary mb-4">{{ $service->short_description }}</p>
                                @endif

                                <div class="d-flex gap-3 mt-4 flex-wrap">
                                    {{-- Tombol Reservasi WhatsApp (Primary) --}}
                                    <a href="https://wa.me/62?text=Halo%2C%20saya%20tertarik%20dengan%20layanan%20*{{ urlencode($service->name) }}*%20di%20website.%20Mohon%20info%20ketersediaan%20jadwal."
                                        target="_blank" class="btn btn-accent shadow-sm">
                                        <i class="bi bi-whatsapp me-2"></i> Reservasi & Booking
                                    </a>

                                    {{-- Tombol Konsultasi (Secondary) --}}
                                    <a href="{{ route('consult') ?? '#' }}" class="btn btn-outline-accent shadow-sm">
                                        <i class="bi bi-chat-dots me-2"></i> Konsultasi
                                    </a>
                                </div>

                            </div>
                        </div>

                        <hr class="my-5" style="border-color: var(--border-subtle)">

                        {{-- Tabs (Deskripsi & Info) --}}
                        <div>
                            <ul class="nav nav-tabs mb-4" id="serviceTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="desc-tab" data-bs-toggle="tab"
                                        data-bs-target="#desc" type="button" role="tab" aria-controls="desc"
                                        aria-selected="true">Deskripsi Lengkap</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                        type="button" role="tab" aria-controls="info" aria-selected="false">Prosedur &
                                        Info</button>
                                </li>
                            </ul>

                            <div class="tab-content">
                                {{-- Deskripsi --}}
                                <div class="tab-pane fade show active" id="desc" role="tabpanel"
                                    aria-labelledby="desc-tab">
                                    <div class="text-dark">
                                        {!! $service->description ?? 'Deskripsi detail layanan ini sedang disiapkan.' !!}
                                    </div>
                                </div>

                                {{-- Info --}}
                                <div class="tab-pane fade" id="info" role="tabpanel" aria-labelledby="info-tab">
                                    <ul class="list-group list-group-flush">
                                        {{-- Data Info Layanan --}}
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Durasi Pelayanan</span>
                                            <span>{{ $service->duration ?? '60 - 90 Menit' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Tipe Lokasi</span>
                                            <span>{{ $service->location_type ?? 'Onsite / Homecare' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Pelaksana</span>
                                            <span>{{ $service->therapist ?? 'Bidan Berlisensi' }}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="text-muted">Kategori</span>
                                            <span>{{ $service->category ?? 'Perawatan Ibu & Bayi' }}</span>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                {{-- Right: Sidebar (3/12) --}}
                <div class="col-lg-3">

                    {{-- Section: Keterkaitan Produk (Kebalikan dari detail produk) --}}
                    <div class="product-link-card mb-4 border-success">
                        <i class="bi bi-shop fs-3 mb-2" style="color: var(--success);"></i>
                        <h5 class="mb-2" style="color: var(--text-dark);">Butuh Produk Pendukung?</h5>
                        <p class="small text-muted mb-3">Lengkapi perawatan Anda dengan produk terbaik dari Bidan Feni.</p>
                        <a href="{{ route('products') }}" class="btn btn-sm w-100"
                            style="background: var(--success); color: white; font-weight: 600; border-radius: 40px; transition: .3s;">
                            Lihat Katalog Produk
                        </a>
                    </div>

                    <h5 class="fw-bold mb-3 text-dark">Layanan Serupa</h5>

                    <div class="d-grid gap-3">
                        @forelse($recommended_services as $item)
                            {{-- Gunakan $item->slug jika ada, atau fallback ke $item->id --}}
                            <a href="{{ route('service.show', $item->slug ?? $item->id) }}"
                                class="reco-card text-decoration-none">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                <div class="reco-title mb-1">{{ Str::limit($item->name, 40) }}</div>
                                <div class="small fw-bold" style="color: var(--accent);">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </div>
                            </a>
                        @empty
                            <div class="text-center small text-muted p-3">Tidak ada rekomendasi layanan saat ini.</div>
                        @endforelse
                    </div>

                    <a href="{{ route('services') }}" class="btn btn-outline-accent w-100 mt-4">
                        <i class="bi bi-grid-3x3-gap-fill me-2"></i> Lihat Semua Layanan
                    </a>
                </div>

            </div>
        </div>
    </div>

@endsection
