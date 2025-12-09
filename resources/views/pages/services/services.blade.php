@extends('layouts.app')

@section('title', 'Layanan Kami - Bidan Feni')

@section('content')
<style>
:root {
    --black: #0f0f0f;
    --black-soft: #171717;
    --gold: #ffb400;
    --gold-soft: #ffda7b;
    --white: #fff;
    --gray: #bfbfbf;
}

/* Hero */
.service-header {
    background: radial-gradient(circle at top, #1c1c1c, #070707);
    color: var(--white);
    padding: 130px 0 140px;
    text-align: center;
}
.service-header .tag {
    letter-spacing: 3px;
    font-size: .8rem;
    color: var(--gold);
}
.service-header h1 {
    font-size: 3rem;
    font-weight: 800;
}
.service-header p {
    max-width: 700px;
    margin: auto;
    opacity: .8;
}

/* Card */
.service-card {
    background: var(--black-soft);
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.07);
    box-shadow: 0 0 15px rgba(0,0,0,0.4);
    transition: .35s ease;
}
.service-card:hover {
    transform: translateY(-8px);
    border-color: var(--gold);
    box-shadow: 0 0 25px rgba(255,180,0,0.35);
}
.service-card img {
    height: 250px;
    object-fit: cover;
    transition: .4s;
}
.service-card:hover img {
    transform: scale(1.06);
}

/* Text */
.service-card h5 {
    font-weight: 700;
    color: var(--white);
}
.price {
    font-size: 1.3rem;
    color: var(--gold);
    font-weight: 800;
}
.description {
    color: var(--gray);
}

/* Button */
.btn-gold-outline {
    border: 2px solid var(--gold);
    color: var(--gold);
    border-radius: 35px;
    font-weight: 600;
    padding: 10px 0;
    transition: .3s;
}
.btn-gold-outline:hover {
    background: var(--gold);
    color: #000;
    box-shadow: 0 0 18px rgba(255,180,0,0.45);
    transform: translateY(-2px);
}

/* Stars */
.card-stars i {
    color: var(--gold);
}

/* Filter bar */
.filter-bar {
    border-bottom: 1px solid rgba(255,255,255,0.12);
    padding-bottom: 12px;
}
.filter-bar h4 {
    color: var(--white);
}

/* Background */
.section-bg {
    background: #0c0c0c;
}

/* Responsive */
@media(max-width: 767px) {
    .service-header h1 { font-size: 2.1rem; }
}
</style>

{{-- Header --}}
<section class="service-header">
    <div class="container">
        <div class="tag mb-2">SERVICES</div>
        <h1 class="mb-3">Layanan Eksklusif Bunda & Bayi</h1>
        <p>Kami hadir dengan pelayanan terbaik dan profesional, memberikan perawatan berkualitas bagi Bunda & Buah Hati.</p>
    </div>
</section>

{{-- Content --}}
<section class="py-5 section-bg">
<div class="container">

    {{-- Filter Bar --}}
    <div class="d-flex justify-content-between align-items-center filter-bar mb-4">
        <h4>Semua Layanan ({{ count($items) }})</h4>
        <a href="#" class="text-gold text-decoration-none fw-bold small">
            <i class="bi bi-funnel"></i> Filter
        </a>
    </div>

    {{-- Grid --}}
    <div class="row g-4">
        @forelse($items as $service)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="service-card h-100">

                <a href="{{ route('service.show', $service->slug ?? $service->id) }}">
                    <img src="{{ asset('storage/'.$service->image) }}" class="img-fluid w-100">
                </a>

                <div class="p-4">
                    <h5 class="text-truncate mb-1">{{ $service->name }}</h5>

                    <p class="price mb-2">Rp {{ number_format($service->price, 0, ',', '.') }}</p>

                    <p class="description mb-2">{{ Str::limit(strip_tags($service->description), 60) }}</p>

                    <div class="card-stars mb-3 small">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
                        <span class="text-secondary small">(4.8)</span>
                    </div>

                    <a href="{{ route('service.show', $service->slug ?? $service->id) }}" class="btn btn-gold-outline w-100">
                        Detail Layanan <i class="bi bi-arrow-right-short"></i>
                    </a>
                </div>

            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="text-secondary fs-5">Belum ada layanan yang ditambahkan.</p>
        </div>
        @endforelse
    </div>

    {{-- Load More --}}
    @if(count($items) > 8)
    <div class="text-center mt-5">
        <button class="btn btn-gold-outline px-5 py-2">Muat Lebih Banyak</button>
    </div>
    @endif

</div>
</section>
@endsection
