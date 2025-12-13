@extends('layouts.app')
@section('title', 'Tentang Kami - Tower Management & Service')

@push('styles')
{{-- Memastikan ikon Bootstrap dimuat jika AlpineJS memerlukannya --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

body { background: var(--bg-light); color: var(--text-dark); }
section { padding: 70px 0; }

h2.fw-bold, h3.fw-bold {
    font-weight: 700 !important;
    color: var(--text-dark);
}

/* HERO (Clean & Professional) */
.hero-about {
    padding: 130px 0 80px;
    background: linear-gradient(180deg, var(--bg-light), #F1F3F7);
}
.hero-about h1 {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--text-dark);
}
.hero-about p {
    color: var(--text-muted);
    font-size: 1.1rem;
}
.hero-about .badge {
    background: var(--bg-card) !important;
    border: 1px solid var(--border-subtle) !important;
    color: var(--text-dark) !important;
}

/* IMAGE BLOCK */
.about-image-box {
    border-radius: 16px; /* Lebih minimalis */
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,.1);
    border: 1px solid var(--border-subtle);
}

/* CONTENT CARD (Professional Look) */
.about-card {
    background: var(--bg-card);
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 4px 15px rgba(0,0,0,.08);
    border: 1px solid var(--border-subtle);
}
.about-card p {
    color: var(--text-dark);
    font-size: 1.05rem;
    line-height: 1.8;
}

/* VISI MISI TABS (Modern & Minimalis) */
.tab-btn {
    padding: 10px 24px;
    border-radius: 8px; /* Sudut lebih tegas */
    font-weight: 600;
    border: 1px solid var(--border-subtle);
    color: var(--text-dark);
    background: var(--bg-card);
    transition: .3s;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}
.tab-btn.active {
    background: var(--accent);
    color: var(--text-dark);
    border-color: var(--accent);
    box-shadow: 0 4px 10px rgba(255, 195, 0, 0.2);
}
.tab-btn:hover {
    transform: translateY(-1px);
}

/* TAB BOX */
.tab-box {
    background: var(--bg-card);
    border-radius: 16px;
    padding: 50px;
    border: 1px solid var(--border-subtle);
    box-shadow: 0 4px 20px rgba(0,0,0,.08);
}
.tab-box p {
    color: var(--text-dark);
    font-size: 1.1rem;
    max-width: 800px;
    margin: 0 auto;
    font-style: italic;
}
.tab-icon {
    font-size: 48px; /* Lebih besar */
    color: var(--accent);
    margin-bottom: 15px;
    display: block;
}

/* CTA SECTION (Dibuat Modern dan Padat) */
.cta-box {
    background: var(--accent); /* Menggunakan warna aksen penuh */
    padding: 50px;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(255, 195, 0, 0.3);
    border: none;
}
.cta-box h2 {
    color: var(--text-dark);
    font-weight: 800;
}
.cta-box p {
    color: var(--text-dark);
    opacity: 0.9;
    font-size: 1.05rem;
}
.cta-box .btn-cta {
    background: var(--text-dark); /* Tombol kontras (hitam) */
    color: #fff;
    font-weight: 700;
    padding: 12px 30px;
    border-radius: 8px;
    transition: .3s;
}
.cta-box .btn-cta:hover {
    background: #000;
    transform: translateY(-1px);
}

/* RESPONSIVE */
@media(max-width:768px){
    .hero-about h1 { font-size: 2.1rem; }
    .tab-box { padding: 30px; }
    .cta-box { padding: 40px; }
}
</style>
@endpush


@section('content')

{{-- AlpineJS untuk Tabs --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

@php
    // Variabel model (diasumsikan About berisi data Visi/Misi/Deskripsi Tower)
    $about = \App\Models\About::first();
@endphp

{{-- ✅ HERO --}}
<section class="hero-about text-center" data-aos="fade-down">
    <div class="container">
        <span class="badge px-3 py-2 mb-3 fw-semibold">
            Tentang Tower Management
        </span>

        <h1>Dedikasi, Inovasi, dan Kualitas Tak Tertandingi</h1>
        <p class="mt-2">“Membangun masa depan layanan premium bersama Anda.”</p>
    </div>
</section>

{{-- ✅ MAIN IMAGE --}}
<section class="py-5">
    <div class="container">
        <div class="about-image-box" data-aos="zoom-in">
            <img src="{{ $about?->image ? asset('storage/'.$about->image) : asset('assets/img/staff_kolase.jpg') }}"
                class="img-fluid w-100"
                alt="Tim Tower Management Profesional"
                style="height:480px; object-fit:cover; filter: grayscale(10%);">
        </div>
    </div>
</section>

{{-- ✅ DESCRIPTION --}}
<section class="py-5 pt-0">
    <div class="container">
        <div class="about-card" data-aos="fade-up">
            <h3 class="fw-bold mb-3">
                {{ $about?->title ?? "Mitra Solusi Manajemen Terpercaya" }}
            </h3>

            <p class="mb-0">
                {{ $about?->description ?? "Tower Management hadir sebagai penyedia layanan dan produk premium yang berfokus pada efisiensi, inovasi, dan hasil yang optimal. Didukung oleh tim yang berpengalaman dan berdedikasi, kami berkomitmen untuk memberikan nilai tambah nyata bagi setiap proyek dan kemitraan yang kami jalani, menjadikan kesuksesan klien sebagai prioritas utama kami." }}
            </p>
        </div>
    </div>
</section>

{{-- ✅ VISI MISI TUJUAN --}}
<section class="py-5">
    <div class="container text-center">

        <h2 class="fw-bold mb-4">Visi, Misi & Nilai Inti</h2>

        <div x-data="{ tab: 'visi' }" class="tab-box mx-auto" style="max-width:900px;" data-aos="fade-up">

            {{-- Tabs --}}
            <div class="d-flex justify-content-center gap-3 mb-4 flex-wrap">
                <button @click="tab='visi'"
                    :class="tab=='visi' ? 'tab-btn active' : 'tab-btn'">Visi Kami</button>

                <button @click="tab='misi'"
                    :class="tab=='misi' ? 'tab-btn active' : 'tab-btn'">Misi Kami</button>

                <button @click="tab='nilai'"
                    :class="tab=='nilai' ? 'tab-btn active' : 'tab-btn'">Nilai Inti</button>
            </div>

            {{-- Content --}}
            <div class="fade-content">
                <template x-if="tab==='visi'">
                    <div>
                        <i class="tab-icon bi bi-flag"></i>
                        <p class="mb-0">{{ $about?->vision ?? "Menjadi perusahaan manajemen dan layanan teknis terdepan di Asia Tenggara yang dikenal atas keunggulan dan integritas." }}</p>
                    </div>
                </template>

                <template x-if="tab==='misi'">
                    <div>
                        <i class="tab-icon bi bi-lightning-charge"></i>
                        <p class="mb-0">{{ $about?->mission ?? "1. Menyediakan solusi yang inovatif dan terintegrasi. 2. Membangun kemitraan jangka panjang berbasis kepercayaan. 3. Mendorong pertumbuhan berkelanjutan bagi klien dan perusahaan." }}</p>
                    </div>
                </template>

                <template x-if="tab==='nilai'">
                    <div>
                        <i class="tab-icon bi bi-gem"></i>
                        <p class="mb-0">{{ $about?->goal ?? "Integritas | Inovasi | Kualitas Premium | Fokus pada Klien." }}</p>
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
            <h2 class="fw-bold mb-2">Mari Mulai Proyek Anda Sekarang!</h2>
            <p class="mb-4">Tower Management siap menjadi mitra Anda. Hubungi kami untuk konsultasi gratis.</p>

            <a href="{{ route('contact') }}" class="btn-cta text-decoration-none">
                Jadwalkan Konsultasi <i class="fas fa-headset ms-2"></i>
            </a>
        </div>
    </div>
</section>

@endsection
