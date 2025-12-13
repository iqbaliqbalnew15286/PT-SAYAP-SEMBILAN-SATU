@extends('layouts.app')

@section('title', $service->name ?? 'Detail Layanan')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* -------------------------------------
        COLOR THEME: SOFT LIGHT (WHITE & AMBER/GOLD)
    ---------------------------------------*/
    :root {
        --accent: #FFC300;
        /* Kuning Emas/Amber */
        --accent-dark: #FFAA00;
        /* Kuning Lebih Gelap */
        --bg-light: #F8F9FB;
        /* Latar Belakang Utama */
        --bg-card: #FFFFFF;
        /* Latar Belakang Card Putih */
        --text-dark: #2C3E50;
        /* Teks Utama (Dark Accent) */
        --text-muted: #7F8C8D;
        /* Teks Sekunder */
        --border-subtle: #E9ECEF;
        /* Border tipis */
        --shadow-subtle: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    body {
        background: var(--bg-light);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif;
    }

    /* Page BG (Konten Utama) */
    .page-bg {
        background: var(--bg-light);
        padding: 50px 0 100px;
    }

    /* Card main */
    .main-card {
        background: var(--bg-card);
        border-radius: 15px;
        border: 1px solid var(--border-subtle);
        box-shadow: var(--shadow-subtle);
    }

    /* Image */
    .service-main-img {
        border-radius: 1rem;
        transition: .35s;
        border: 1px solid var(--border-subtle);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    .service-main-img:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 30px rgba(255, 195, 0, 0.3);
    }

    /* Title */
    h1 {
        color: var(--text-dark);
        font-weight: 800;
        font-size: 2.5rem;
    }

    /* Price */
    .price-big {
        font-size: 2.7rem;
        color: var(--accent);
        font-weight: 800;
        line-height: 1;
        margin-bottom: 20px;
    }

    /* Buttons (Konsisten dengan List Layanan) */
    .btn-accent {
        background: var(--accent);
        border-radius: 8px;
        color: var(--text-dark);
        padding: 12px 32px;
        font-weight: 700;
        transition: .3s;
        border: 1px solid var(--accent);
    }
    .btn-accent:hover {
        background: var(--accent-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 195, 0, 0.4);
    }

    .btn-accent-outline {
        border: 2px solid var(--accent);
        border-radius: 8px;
        color: var(--text-dark);
        padding: 12px 32px;
        font-weight: 700;
        transition: .3s;
    }
    .btn-accent-outline:hover {
        background: var(--accent);
        color: var(--text-dark);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 195, 0, 0.2);
    }

    /* Tabs */
    .nav-tabs .nav-link {
        color: var(--text-muted);
        font-weight: 600;
        border: none;
        padding-bottom: 15px;
    }
    .nav-tabs .nav-link.active {
        color: var(--accent);
        border-bottom: 3px solid var(--accent);
    }

    /* Text */
    .text-desc {
        color: var(--text-dark);
        line-height: 1.8;
        font-size: 1rem;
    }

    /* Sidebar cards */
    .recommended-card {
        background: var(--bg-card);
        border: 1px solid var(--border-subtle);
        border-radius: 12px;
        transition: .3s;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }
    .recommended-card:hover {
        transform: translateY(-3px);
        border-color: var(--accent);
        box-shadow: 0 8px 20px rgba(255, 195, 0, 0.2);
    }
    .recommended-card img {
        border-radius: 8px;
    }

    /* Info list */
    .list-group-item {
        background: var(--bg-card);
        color: var(--text-dark);
        border-color: var(--border-subtle);
        font-weight: 500;
    }
    .list-group-item:nth-child(even) {
        background: var(--bg-light);
    }

    .list-group-item span:first-child {
        color: var(--text-muted);
    }
    .breadcrumb-item a {
        color: var(--text-muted) !important;
    }
    .text-accent {
        color: var(--accent) !important;
    }

    @media(max-width: 991px) {
        .main-card { padding: 30px !important; }
        .price-big { font-size: 2rem; }
        h1 { font-size: 2rem; }
    }
</style>
@endpush

@section('content')

<div class="page-bg">
<div class="container py-4">

    {{-- BREADCRUMB --}}
    <nav class="mb-4" aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="{{ route('services') }}" class="small">Layanan</a></li>
            {{-- Menggunakan text-dark untuk teks aktif agar kontras di tema terang --}}
            <li class="breadcrumb-item active text-dark small fw-bold" aria-current="page">{{ $service->name ?? 'Detail Layanan' }}</li>
        </ol>
    </nav>

    <div class="row g-5">

        {{-- LEFT CONTENT (MAIN SERVICE INFO) --}}
        <div class="col-lg-9">
            <div class="p-4 p-md-5 main-card">

                <div class="row g-5">

                    {{-- IMAGE --}}
                    <div class="col-lg-5 text-center">
                        <div style="overflow: hidden;">
                             <img src="{{ asset('storage/'.$service->image) }}"
                                     class="img-fluid w-100 service-main-img"
                                     alt="{{ $service->name }}"
                                     style="max-height: 420px; object-fit: cover;">
                        </div>
                        <div class="text-muted small mt-3">
                            <i class="bi bi-geo-alt"></i> Tersedia layanan Onsite & Homecare
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">{{ $service->name }}</h1>

                        <div class="d-flex align-items-center mb-3">
                            <span class="text-accent fs-5 me-1"><i class="bi bi-star-fill"></i></span>
                            <span class="text-muted small">Rating (4.8 / 100+ Ulasan)</span>
                        </div>

                        <p class="price-big mb-4">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </p>

                        {{-- ACTION --}}
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="https://wa.me/628xxx"
                               class="btn btn-accent">
                                <i class="bi bi-whatsapp"></i> Reservasi Sekarang
                            </a>

                            <a href="{{ route('consult') ?? '#' }}" class="btn btn-accent-outline">
                                <i class="bi bi-chat"></i> Konsultasi
                            </a>
                        </div>
                    </div>

                </div>

                <hr class="my-5 text-muted opacity-25">

                {{-- TABS SECTION --}}
                <ul class="nav nav-tabs border-0 mb-4">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-target="#tab-desc" data-bs-toggle="tab">
                            <i class="bi bi-file-earmark-text"></i> Deskripsi
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-target="#tab-info" data-bs-toggle="tab">
                            <i class="bi bi-info-circle"></i> Prosedur & Info
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- 1. Description Tab --}}
                    <div class="tab-pane fade show active" id="tab-desc">
                        <div class="text-desc">
                            {{-- LOGIKA: Menampilkan Deskripsi Lengkap --}}
                            {!! $service->description !!}
                        </div>
                    </div>

                    {{-- 2. Info Tab --}}
                    <div class="tab-pane fade" id="tab-info">
                        <ul class="list-group list-group-flush rounded">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Durasi Pelayanan</span>
                                <span class="fw-bold">{{ $service->duration ?? '60 - 90 Menit' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tipe Lokasi</span>
                                <span class="fw-bold">{{ $service->location_type ?? 'Onsite / Homecare' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Pelaksana</span>
                                <span class="fw-bold">{{ $service->therapist ?? 'Bidan Berlisensi' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Kategori</span>
                                <span class="fw-bold text-accent">{{ $service->category ?? 'Perawatan Ibu & Bayi' }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        {{-- SIDEBAR (RECOMMENDED SERVICES) --}}
        <div class="col-lg-3">
            <h5 class="text-dark fw-bold mb-3">Layanan Serupa</h5>

            <div class="d-grid gap-3">
                @if (isset($recommended_services) && count($recommended_services) > 0)
                    @foreach($recommended_services as $item)
                    {{-- LOGIKA: Looping layanan rekomendasi --}}
                    <a href="{{ route('service.show',$item->slug ?? $item->id) }}"
                       class="p-3 recommended-card d-block text-decoration-none">

                        <img src="{{ asset('storage/'.$item->image) }}" class="w-100 mb-2" style="height:90px; object-fit:cover; border-radius: 8px;">
                        <div class="fw-bold text-dark text-truncate">{{ $item->name }}</div>
                        <div class="text-accent fw-bold small">Rp {{ number_format($item->price,0,',','.') }}</div>

                    </a>
                    @endforeach
                @else
                    <p class="text-muted small">Tidak ada rekomendasi lain saat ini.</p>
                @endif
            </div>

            <a href="{{ route('services') ?? '#' }}" class="btn btn-accent-outline mt-4 w-100">
                Lihat Semua Layanan <i class="bi bi-arrow-right-short"></i>
            </a>
        </div>

    </div>

</div>
</div>
@endsection
