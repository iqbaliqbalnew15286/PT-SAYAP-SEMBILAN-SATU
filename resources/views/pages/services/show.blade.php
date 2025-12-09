@extends('layouts.app')

@section('title', $service->name ?? 'Detail Layanan')

@push('styles')
<style>
:root {
    --black: #0f0f0f;
    --black-soft: #1a1a1a;
    --white: #fff;
    --gray: #bfbfbf;
    --gold: #ffb400;
    --gold-soft: #ffda7b;
}

/* Page BG */
.page-bg {
    background: #0c0c0c;
}

/* Card main */
.main-card {
    background: var(--black-soft);
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.05);
    box-shadow: 0 0 20px rgba(0,0,0,0.45);
}

/* Image */
.service-main-img {
    border-radius: 1rem;
    transition: .35s;
}
.service-main-img:hover {
    transform: scale(1.06);
    box-shadow: 0 0 25px rgba(255,180,0,0.35);
}

/* Title */
h1 {
    color: var(--white);
}

/* Price */
.price-big {
    font-size: 2.7rem;
    color: var(--gold);
    font-weight: 800;
}

/* Buttons */
.btn-gold {
    background: var(--gold);
    border-radius: 50px;
    color: #000;
    padding: 12px 32px;
    font-weight: 600;
    transition: .3s;
}
.btn-gold:hover {
    background: var(--gold-soft);
    transform: translateY(-3px);
    box-shadow: 0 0 18px rgba(255,180,0,.45);
}

.btn-gold-outline {
    border: 2px solid var(--gold);
    border-radius: 50px;
    color: var(--gold);
    padding: 12px 32px;
    font-weight: 600;
    transition: .3s;
}
.btn-gold-outline:hover {
    background: var(--gold);
    color: #000;
    transform: translateY(-2px);
}

/* Tabs */
.nav-tabs .nav-link {
    color: var(--gray);
    font-weight: 600;
    border: none;
}
.nav-tabs .nav-link.active {
    color: var(--gold);
    border-bottom: 3px solid var(--gold);
}

/* Text */
.text-desc {
    color: var(--gray);
    line-height: 1.8;
}

/* Sidebar cards */
.recommended-card {
    background: var(--black-soft);
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 12px;
    transition: .3s;
}
.recommended-card:hover {
    transform: translateY(-5px);
    border-color: var(--gold);
    box-shadow: 0 0 18px rgba(255,180,0,.35);
}
.recommended-card img {
    border-radius: 8px;
}

/* Info list */
.list-group-item {
    background: var(--black);
    color: var(--white);
    border-color: rgba(255,255,255,0.08);
}
.list-group-item:nth-child(even) {
    background: #151515;
}
</style>
@endpush

@section('content')

<div class="py-5 page-bg">
<div class="container py-4">

    {{-- BREADCRUMB --}}
    <nav class="mb-4">
        <ol class="breadcrumb bg-transparent p-0 mb-0">
            <li class="breadcrumb-item"><a href="{{ route('services') }}" class="text-secondary small">Layanan</a></li>
            <li class="breadcrumb-item active text-gold small fw-bold">{{ $service->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- LEFT CONTENT --}}
        <div class="col-lg-9">
            <div class="p-4 p-md-5 main-card">

                <div class="row g-5">

                    {{-- IMAGE --}}
                    <div class="col-lg-5 text-center">
                        <img src="{{ asset('storage/'.$service->image) }}"
                             class="img-fluid w-100 service-main-img"
                             style="max-height: 420px; object-fit: cover;">
                        <div class="text-secondary small mt-2">
                            <i class="bi bi-geo-alt"></i> Onsite & Homecare
                        </div>
                    </div>

                    {{-- INFO --}}
                    <div class="col-lg-7">
                        <h1 class="fw-bold mb-2">{{ $service->name }}</h1>

                        <div class="d-flex align-items-center mb-3">
                            <span class="text-warning fs-5 me-1"><i class="bi bi-star-fill"></i></span>
                            <span class="text-muted small">Rating terbaik</span>
                        </div>

                        <div class="price-big mb-3">
                            Rp {{ number_format($service->price, 0, ',', '.') }}
                        </div>

                        {{-- ACTION --}}
                        <div class="d-flex gap-3 flex-wrap">
                            <a href="https://wa.me/628xxx"
                               class="btn btn-gold">
                                <i class="bi bi-whatsapp"></i> Reservasi
                            </a>

                            <a href="{{ route('consult') }}" class="btn btn-gold-outline">
                                <i class="bi bi-chat"></i> Konsultasi
                            </a>
                        </div>
                    </div>

                </div>

                <hr class="my-4 text-secondary">

                {{-- TABS --}}
                <ul class="nav nav-tabs border-0 mb-3">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-target="#tab-desc" data-bs-toggle="tab">
                            Deskripsi
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-target="#tab-info" data-bs-toggle="tab">
                            Prosedur & Info
                        </button>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- Description --}}
                    <div class="tab-pane fade show active" id="tab-desc">
                        <div class="text-desc">
                            {!! $service->description !!}
                        </div>
                    </div>

                    {{-- Info --}}
                    <div class="tab-pane fade" id="tab-info">
                        <ul class="list-group list-group-flush rounded">
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Durasi</span>
                                <span>{{ $service->duration ?? '60 - 90 Menit' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Lokasi</span>
                                <span>{{ $service->location_type ?? 'Onsite / Homecare' }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Terapis</span>
                                <span>{{ $service->therapist ?? 'Bidan Berlisensi' }}</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="col-lg-3">
            <h5 class="text-white fw-bold mb-3">Layanan Serupa</h5>

            <div class="d-grid gap-3">
                @foreach($recommended_services as $item)
                <a href="{{ route('service.show',$item->slug ?? $item->id) }}"
                   class="p-3 recommended-card d-block text-decoration-none">

                    <img src="{{ asset('storage/'.$item->image) }}" class="w-100 mb-2" style="height:90px; object-fit:cover;">
                    <div class="fw-bold text-white text-truncate">{{ $item->name }}</div>
                    <div class="text-gold fw-bold small">Rp {{ number_format($item->price,0,',','.') }}</div>

                </a>
                @endforeach
            </div>

            <a href="{{ route('services') }}" class="btn btn-gold-outline mt-4 w-100">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>

    </div>

</div>
</div>
@endsection
