@extends('layouts.app')
@section('title', 'Galeri Proyek & Portofolio - Tower Management')

@push('styles')
{{-- Memastikan Lightbox dimuat --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css"/>

<style>
/* -------------------------------------
   COLOR THEME: MODERN LIGHT MODE (WHITE & AMBER)
---------------------------------------*/
:root {
    --accent: #FFC300;
    --bg-light: #F8F9FB;
    --bg-card: #FFFFFF;
    --text-dark: #2C3E50;
    --text-muted: #7F8C8D;
    --border-subtle: #E9ECEF;
}

body {
    background: var(--bg-light);
    color: var(--text-dark);
}

/* HERO/TITLE SECTION (Clean & Sharp) */
.gallery-title {
    padding-top: 130px; /* Lebih tinggi */
    padding-bottom: 70px;
    text-align: center;
    background: linear-gradient(180deg, var(--bg-light), #F1F3F7); /* Gradasi lembut */
}

.gallery-title h1 {
    font-weight: 800; /* Lebih tebal */
    color: var(--text-dark);
    font-size: 2.8rem;
}

.divider {
    width: 60px; /* Lebih pendek dan tebal */
    height: 4px;
    background: var(--accent);
    margin: 12px auto 18px;
    border-radius: 4px;
}

.gallery-title p {
    color: var(--text-muted);
    font-size: 1.05rem;
}

/* PHOTO CARD (Modern & Clean on Light Mode) */
.photo-card {
    border-radius: 12px; /* Sudut lebih tegas */
    overflow: hidden;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    box-shadow: 0 4px 15px rgba(0,0,0,.08); /* Shadow halus */
    transition: .35s ease;
}
.photo-card:hover {
    transform: translateY(-5px); /* Efek hover modern */
    box-shadow: 0 8px 25px rgba(0,0,0,.15);
}

.photo-card img {
    width: 100%;
    height: 320px; /* Lebih tinggi */
    object-fit: cover;
    transition: .42s ease;
    filter: grayscale(10%); /* Sedikit filter untuk kesan profesional */
}
.photo-card:hover img {
    transform: scale(1.05); /* Skala diperkecil sedikit agar tidak terlalu agresif */
    filter: grayscale(0%); /* Warna penuh saat dihover */
}

@media(max-width:768px){
    .photo-card img { height: 250px; }
}

/* EMPTY STATE */
.empty-box {
    padding: 60px 0;
    border-radius: 16px;
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    box-shadow: 0 4px 15px rgba(0,0,0,.05);
}
.empty-box h3 {
    color: var(--text-dark);
    font-weight: 600;
}
.empty-box p {
    color: var(--text-muted);
}

/* Lightbox custom minimalis */
#lightbox .lb-nav a.lb-prev, #lightbox .lb-nav a.lb-next {
    opacity: 0.8 !important;
}
#lightbox .lb-dataContainer .lb-caption {
    font-weight: 600;
}
</style>
@endpush


@section('content')

{{-- ✅ HERO/TITLE --}}
<section class="gallery-title" data-aos="fade-down">
    <span class="badge px-3 py-2 mb-2 fw-semibold"
        style="background: var(--bg-card); border: 1px solid var(--border-subtle) !important; color: var(--text-dark) !important;">
        Portofolio Proyek
    </span>
    <h1 class="display-5">Galeri Kinerja Tower Management</h1>
    <div class="divider"></div>
    <p>Lihat secara langsung kualitas dan skala proyek yang telah kami selesaikan.</p>
</section>


{{-- ✅ GALLERY GRID --}}
<div class="container pb-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        @forelse ($galleries as $gallery)
        <div class="col">
            <div class="photo-card" data-aos="zoom-in">
                <a href="{{ asset('storage/'.$gallery->image) }}"
                    data-lightbox="gallery"
                    {{-- Judul yang lebih profesional --}}
                    data-title="Proyek Tower Management">
                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="Foto Galeri Proyek">
                </a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="empty-box mx-auto" style="max-width:600px;" data-aos="fade-up">
                <i class="fas fa-camera-retro fa-3x mb-3" style="color: var(--accent);"></i>
                <h3>Galeri Segera Diperbarui</h3>
                <p class="mt-2">Kami sedang menyiapkan momen terbaik dari proyek-proyek terbaru kami. Silakan kunjungi kembali.</p>
            </div>
        </div>
        @endforelse

    </div>
</div>


@push('scripts')
{{-- Lightbox Script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script>
    // Konfigurasi Lightbox agar lebih minimalis dan modern
    lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true,
      'fadeDuration': 300,
      'imageFadeDuration': 300,
      'positionFromTop': 100 // Jarak dari atas
    })
</script>
@endpush

@endsection
