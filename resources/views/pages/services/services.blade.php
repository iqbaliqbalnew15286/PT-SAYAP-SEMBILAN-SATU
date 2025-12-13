@extends('layouts.app')

@section('title', 'Layanan Kami - PT SAYAP SEMBILAN SATU')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* -------------------------------------
        COLOR THEME: SOFT LIGHT (WHITE & AMBER/GOLD)
    ---------------------------------------*/
    :root {
        --accent: #FFC300;
        /* Kuning Emas/Amber */
        --accent-soft: #FFD700;
        /* Kuning Lebih Terang */
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
        --shadow-subtle: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    body {
        background: var(--bg-light);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif;
    }

    /* Hero */
    .service-header {
        background: var(--bg-card);
        color: var(--text-dark);
        padding: 130px 0 100px;
        text-align: center;
        border-bottom: 5px solid var(--accent);
    }

    .service-header .tag {
        letter-spacing: 3px;
        font-size: .9rem;
        color: var(--accent);
        font-weight: 700;
        text-transform: uppercase;
    }

    .service-header h1 {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 20px;
    }

    .service-header p {
        max-width: 800px;
        margin: auto;
        color: var(--text-muted);
        font-size: 1.1rem;
    }

    /* Section Content */
    .section-bg {
        background: var(--bg-light);
        padding: 60px 0 100px;
    }

    /* Card */
    .service-card {
        background: var(--bg-card);
        border-radius: 18px;
        overflow: hidden;
        border: 1px solid var(--border-subtle);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: .35s ease;
        display: flex;
        flex-direction: column;
    }

    .service-card:hover {
        transform: translateY(-5px);
        border-color: var(--accent);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .service-card img {
        height: 250px;
        object-fit: cover;
        transition: .4s;
        width: 100%;
    }

    .service-card:hover img {
        transform: scale(1.03);
    }

    .card-content {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    /* Text */
    .service-card h5 {
        font-weight: 700;
        color: var(--text-dark);
        font-size: 1.2rem;
    }

    .price {
        font-size: 1.4rem;
        color: var(--text-dark);
        font-weight: 800;
        line-height: 1.1;
    }

    .price span {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--text-muted);
        display: block;
    }

    .description {
        color: var(--text-muted);
        font-size: 0.9rem;
        min-height: 40px;
        max-height: 40px;
        overflow: hidden;
        margin-bottom: 15px;
    }

    /* Button (Primary Amber) */
    .btn-accent-outline {
        border: 2px solid var(--accent);
        color: var(--text-dark);
        background: var(--bg-card);
        border-radius: 8px;
        font-weight: 700;
        padding: 10px 0;
        transition: .3s;
    }

    .btn-accent-outline:hover {
        background: var(--accent);
        color: var(--text-dark);
        box-shadow: 0 0 18px rgba(255, 195, 0, 0.4);
        transform: translateY(-2px);
    }

    /* Stars */
    .card-stars i {
        color: var(--accent);
    }

    /* Filter bar */
    .filter-bar {
        border-bottom: 1px solid var(--border-subtle);
        padding-bottom: 15px;
        margin-bottom: 40px !important;
    }

    .filter-bar h4 {
        color: var(--text-dark);
        font-weight: 700;
        font-size: 1.3rem;
    }

    .filter-link {
        color: var(--accent);
        font-weight: 700;
        transition: color .2s;
    }
    .filter-link:hover {
        color: var(--accent-soft);
    }

    /* Load More Button */
    .load-more-btn {
        border: 2px solid var(--accent);
        color: var(--text-dark);
        background: var(--bg-card);
        padding: 12px 45px;
        border-radius: 8px;
        font-weight: 700;
        transition: .3s ease;
    }

    .load-more-btn:hover {
        background: var(--accent);
        color: var(--text-dark);
        box-shadow: 0 0 20px rgba(255, 195, 0, 0.35);
        transform: translateY(-3px);
    }

    @media(max-width: 767px) {
        .service-header h1 { font-size: 2.5rem; }
    }
</style>
@endpush

@section('content')

{{-- Header --}}
<section class="service-header" data-aos="fade-down">
    <div class="container">
        <div class="tag mb-2">PELAYANAN KAMI</div>
        <h1 class="mb-3">Layanan Eksklusif Tower</h1>
        <p>Kami hadir dengan pelayanan terbaik dan profesional</p>
    </div>
</section>

{{-- Content --}}
<section class="section-bg">
<div class="container">

    {{-- Filter Bar --}}
    <div class="d-flex justify-content-between align-items-center filter-bar mb-4" data-aos="fade-up">
        {{-- LOGIKA: Menghitung jumlah layanan --}}
        <h4>Semua Layanan ({{ count($items) }})</h4>
        <a href="#" class="filter-link text-decoration-none fw-bold small">
            <i class="bi bi-funnel"></i> Filter Kategori
        </a>
    </div>

    {{-- Grid Layanan --}}
    <div class="row g-4">
        @forelse($items as $service)
        {{-- LOGIKA: Looping data layanan --}}
        <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <div class="service-card h-100">

                <a href="{{ route('service.show', $service->slug ?? $service->id) }}">
                    {{-- LOGIKA: Menampilkan Gambar Layanan --}}
                    <div style="overflow: hidden;">
                        <img src="{{ asset('storage/'.$service->image) }}" class="img-fluid w-100" alt="{{ $service->name }}">
                    </div>
                </a>

                <div class="card-content">
                    {{-- LOGIKA: Menampilkan Nama Layanan --}}
                    <h5 class="text-truncate mb-1">{{ $service->name }}</h5>

                    <div class="card-stars mb-2 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        <span class="text-muted small ms-1">(4.8)</span>
                    </div>

                    {{-- LOGIKA: Menampilkan Deskripsi Singkat --}}
                    <p class="description mb-3">{{ Str::limit(strip_tags($service->description ?? 'Layanan perawatan terbaik untuk Bunda dan Buah Hati.'), 65) }}</p>

                    <div class="mt-auto">
                        {{-- LOGIKA: Menampilkan Harga --}}
                        <p class="price mb-3">
                            <span>Harga Mulai Dari</span>
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </p>

                        {{-- LOGIKA: Tautan ke Halaman Detail Layanan --}}
                        <a href="{{ route('service.show', $service->slug ?? $service->id) }}" class="btn btn-accent-outline w-100">
                            Detail Layanan <i class="bi bi-arrow-right-short"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        @empty
        {{-- LOGIKA: Pesan jika tidak ada layanan --}}
        <div class="col-12 text-center py-5">
            <i class="bi bi-heart-pulse-fill fs-1 mb-3" style="color: var(--accent);"></i>
            <h5 class="text-dark">Layanan Sedang Diperbarui</h5>
            <p class="text-muted">Mohon maaf, saat ini belum ada layanan yang ditampilkan. Silakan hubungi kami untuk informasi lebih lanjut.</p>
        </div>
        @endforelse
    </div>

    {{-- Load More --}}
    @if(count($items) > 8)
    {{-- LOGIKA: Menampilkan tombol Load More jika item > 8 --}}
    <div class="text-center mt-5">
        <button class="load-more-btn">Muat Lebih Banyak</button>
    </div>
    @endif

</div>
</section>
@endsection
