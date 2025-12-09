@extends('layouts.app')
@section('title', 'Tentang Kami - Bidan Feni')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* HERO */
.hero-about {
    padding:130px 0 90px;
    background: linear-gradient(180deg,#0f0f0f,#181818);
}
.hero-about h1 {
    font-size:2.8rem; font-weight:700; color:#fff;
}
.hero-about p { color:#cfcfcf; font-size:1.07rem; }

/* IMAGE BLOCK */
.about-image-box {
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 8px 30px rgba(0,0,0,.55);
    border:1px solid rgba(255,255,255,.08);
}

/* CONTENT */
.about-card {
    background:#151515;
    border-radius:18px;
    padding:40px;
    box-shadow:0 6px 28px rgba(0,0,0,.45);
    border:1px solid rgba(255,255,255,.08);
}
.about-card p { color:#ddd; font-size:1rem; }

/* VISI MISI TABS */
.tab-btn {
    padding:10px 26px; border-radius:50px;
    font-weight:600; border:1px solid rgba(255,255,255,.18);
    color:#fff; background:transparent; transition:.25s;
}
.tab-btn.active {
    background:var(--accent);
    color:#000;
    border-color:var(--accent);
}
.tab-btn:hover {
    transform:translateY(-2px);
}

/* TAB BOX */
.tab-box {
    background:#131313;
    border-radius:20px;
    padding:40px;
    border:1px solid rgba(255,255,255,.1);
    box-shadow:0 4px 20px rgba(0,0,0,.45);
}
.tab-box p {
    color:#eee;
    font-size:1.08rem;
    max-width:720px;
    margin:0 auto;
}
.tab-icon {
    font-size:42px;
    color:#ffb400;
    margin-bottom:10px;
}

/* CTA SECTION */
.cta-box {
    background:#181818;
    padding:60px;
    border-radius:22px;
    box-shadow:0 6px 26px rgba(0,0,0,.6);
    border:1px solid rgba(255,255,255,.08);
}

/* RESPONSIVE */
@media(max-width:768px){
    .hero-about h1 { font-size:2.1rem; }
}
</style>
@endpush


@section('content')

@php
    $about = \App\Models\About::first();
@endphp

{{-- ✅ HERO --}}
<section class="hero-about text-center" data-aos="fade-down">
    <div class="container">
        <span class="badge bg-dark border text-warning px-3 py-2 mb-3"
            style="border-color:rgba(255,255,255,.15)!important; font-weight:600;">
            Tentang Kami
        </span>

        <h1>Bidan Feni – Perjalanan & Dedikasi</h1>
        <p class="mt-2">“Sahabat terbaik Bunda & Buah Hati”</p>
    </div>
</section>

{{-- ✅ MAIN IMAGE --}}
<section class="py-5">
    <div class="container">
        <div class="about-image-box" data-aos="zoom-in">
            <img src="{{ $about?->image ? asset('storage/'.$about->image) : asset('assets/img/staff_kolase.jpg') }}"
                 class="img-fluid w-100" style="height:420px; object-fit:cover;">
        </div>
    </div>
</section>

{{-- ✅ DESCRIPTION --}}
<section class="py-5">
    <div class="container">
        <div class="about-card" data-aos="fade-up">
            <h2 class="fw-bold text-white mb-3">
                {{ $about?->title ?? "Pelayanan Penuh Kasih & Profesional" }}
            </h2>

            <p class="mb-0">
                {{ $about?->description ?? "Bidan Feni Care hadir memberikan layanan kesehatan ibu & bayi terbaik dengan pendekatan profesional, ramah, dan penuh kasih sayang." }}
            </p>
        </div>
    </div>
</section>

{{-- ✅ VISI MISI TUJUAN --}}
<section class="py-5">
    <div class="container text-center">

        <h2 class="fw-bold text-white mb-4">Visi, Misi & Tujuan</h2>

        <div x-data="{ tab: 'visi' }" class="tab-box mx-auto" style="max-width:900px;" data-aos="fade-up">

            {{-- Tabs --}}
            <div class="d-flex justify-content-center gap-2 mb-4">
                <button @click="tab='visi'"
                    :class="tab=='visi' ? 'tab-btn active' : 'tab-btn'">Visi</button>

                <button @click="tab='misi'"
                    :class="tab=='misi' ? 'tab-btn active' : 'tab-btn'">Misi</button>

                <button @click="tab='tujuan'"
                    :class="tab=='tujuan' ? 'tab-btn active' : 'tab-btn'">Tujuan</button>
            </div>

            {{-- Content --}}
            <div class="fade-content">
                <template x-if="tab==='visi'">
                    <div>
                        <div class="tab-icon"><i class="bi bi-stars"></i></div>
                        <p>{{ $about?->vision ?? "Menjadi pusat layanan Mom & Baby terkemuka, terpercaya & humanis." }}</p>
                    </div>
                </template>

                <template x-if="tab==='misi'">
                    <div>
                        <div class="tab-icon"><i class="bi bi-heart-pulse"></i></div>
                        <p>{{ $about?->mission ?? "Memberikan pelayanan aman, profesional & penuh kasih." }}</p>
                    </div>
                </template>

                <template x-if="tab==='tujuan'">
                    <div>
                        <div class="tab-icon"><i class="bi bi-bullseye"></i></div>
                        <p>{{ $about?->goal ?? "Meningkatkan kesehatan & kebahagiaan ibu dan buah hati." }}</p>
                    </div>
                </template>
            </div>
        </div>

    </div>
</section>

{{-- ✅ CTA --}}
<section class="py-5">
    <div class="container">
        <div class="cta-box text-center" data-aos="fade-up">
            <h2 class="fw-bold text-white mb-2">Siap Mendampingi Perjalanan Bunda 💞</h2>
            <p class="text-muted mb-4">Ayo buat janji & dapatkan layanan terbaik untuk Bunda & buah hati.</p>

            <a href="{{ route('booking') }}" class="btn btn-warning fw-semibold px-4 py-2 rounded-pill text-dark">
                Reservasi Sekarang <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection
