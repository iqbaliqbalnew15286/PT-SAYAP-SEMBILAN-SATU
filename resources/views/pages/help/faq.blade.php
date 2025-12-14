@extends('layouts.app')
@section('title')
FAQ - Tower Management & Service
@endsection

@push('styles')
{{-- Memastikan Font Awesome dan AOS dimuat (Karena ada atribut data-aos-*) --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* -------------------------------------
   COLOR THEME: MODERN LIGHT MODE (WHITE & AMBER)
---------------------------------------*/
:root {
    --accent: #FFC300; /* Kuning Amber */
    --bg-light: #F8F9FB; /* Light Background */
    --bg-card: #FFFFFF; /* White Card */
    --text-dark: #2C3E50; /* Navy/Dark Text */
    --text-muted: #7F8C8D; /* Muted Gray */
    --border-subtle: #E9ECEF; /* Border Gray */
}

body {
    background: var(--bg-light);
    color: var(--text-dark);
}

/* Hero (Clean & Light) */
.faq-hero {
    padding-top: 130px;
    padding-bottom: 70px;
    text-align: center;
    background: linear-gradient(to bottom, var(--bg-light), #F1F3F7);
}
.faq-hero h1 {
    font-weight: 800;
    color: var(--text-dark);
}
.faq-hero p {
    color: var(--text-muted);
    max-width: 600px; /* Batasi lebar teks paragraf */
    margin-left: auto;
    margin-right: auto;
}

.badge-custom {
    background: var(--bg-card) !important;
    border: 1px solid var(--border-subtle) !important;
    color: var(--text-dark) !important;
    font-weight: 600;
    padding: 8px 16px;
    border-radius: 8px;
    display: inline-block; /* Agar margin-bottom berfungsi */
}

.divider {
    width: 60px; height: 4px;
    background: var(--accent);
    margin: 12px auto 22px;
    border-radius: 4px;
}

/* Accordion (Modern Minimalis) */
.accordion-item {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    margin-bottom: 15px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,.05);
}

.accordion-button {
    background: var(--bg-card);
    color: var(--text-dark);
    font-weight: 600;
    padding: 18px 20px;
    letter-spacing: normal;
    font-size: 1.05rem;
    transition: background .3s, color .3s;
    width: 100%; /* Memastikan tombol memenuhi lebar */
    text-align: left;
}
.accordion-button:focus { box-shadow:none !important; }

.accordion-button.collapsed {
    color: var(--text-dark);
}

.accordion-button:not(.collapsed) {
    background: var(--accent); /* Kuning ketika aktif */
    color: var(--text-dark);
    border-bottom: 1px solid var(--border-subtle);
    box-shadow: 0 2px 5px rgba(255, 195, 0, 0.2);
}

.accordion-body {
    background: #F4F6F9;
    color: var(--text-dark);
    padding: 20px 25px;
    line-height: 1.6;
    font-size: 0.95rem;
}

/* Custom icon */
.accordion-button::after { display:none; }
.custom-icon {
    font-size: 1.2rem;
    margin-left: auto;
    transition: .3s ease;
    color: var(--accent);
    flex-shrink: 0; /* Agar tidak terpotong */
}
.accordion-button.collapsed .custom-icon {
    color: var(--text-muted);
}
.accordion-button:not(.collapsed) .custom-icon {
    transform: rotate(45deg);
    color: var(--text-dark);
}

/* KEPADATAN */
section { padding: 50px 0; }
</style>
@endpush

@section('content')

{{-- ✅ HERO SECTION --}}
<section class="faq-hero" data-aos="fade-down">
    <div class="container">
        <span class="badge-custom mb-2">Pusat Bantuan</span>
        <h1>Pertanyaan yang Sering Diajukan (FAQ)</h1>
        <div class="divider"></div>
        <p>Kami telah mengumpulkan jawaban atas pertanyaan umum terkait layanan, produk, dan operasional Tower Management.</p>
    </div>
</section>

{{-- ✅ FAQ CONTENT --}}
<section class="py-5 pt-0">
<div class="container" style="max-width:1000px;">
    <div class="row g-4">

        {{-- Kolom Kiri --}}
        <div class="col-md-6">
            <div class="accordion" id="faqLeft">

                @php
                    // Konten FAQ yang disesuaikan untuk Tower Management & Service
                    $left = [
                        'Di mana lokasi kantor pusat Tower Management?' =>
                        'Kantor pusat kami berlokasi di Central Business District Jakarta. Detail alamat lengkap tersedia di halaman Kontak dan Google Maps.',
                        'Apa saja jam operasional layanan kami?' =>
                        'Jam operasional kantor adalah Senin - Jumat, 09.00 - 17.00 WIB. Dukungan teknis darurat tersedia 24/7 untuk klien kontrak.',
                        'Bagaimana cara memulai proyek atau mendapatkan penawaran?' =>
                        'Anda dapat mengisi formulir Permintaan Penawaran di halaman Layanan, atau langsung menghubungi tim sales kami melalui telepon/email.',
                        'Apakah ada biaya konsultasi awal?' =>
                        'Konsultasi awal untuk penjajakan proyek bersifat gratis. Kami akan memberikan estimasi biaya setelah memahami kebutuhan spesifik Anda.',
                        'Bisa dilakukan penjadwalan ulang meeting?' =>
                        'Tentu, silakan hubungi kontak mitra kami minimal 24 jam sebelum jadwal untuk koordinasi ulang.',
                        'Layanan apa yang menjadi keunggulan utama Tower?' =>
                        'Kami unggul dalam Jasa Konstruksi, Layanan Engineering terintegrasi, dan Solusi Otomatisasi Jaringan.'
                    ];
                @endphp

                @foreach($left as $q => $a)
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqL{{ $loop->index }}"
                                type="button">
                            {{ $q }}
                            <i class="fas fa-plus custom-icon"></i>
                        </button>
                    </h2>
                    <div id="faqL{{ $loop->index }}" class="accordion-collapse collapse"
                            data-bs-parent="#faqLeft">
                        <div class="accordion-body">{{ $a }}</div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-6">
            <div class="accordion" id="faqRight">

                @php
                    // Konten FAQ yang disesuaikan untuk Tower Management & Service
                    $right = [
                        'Apakah Tower menyediakan layanan di luar Jakarta?' =>
                        'Ya, kami melayani proyek di berbagai kota besar di Indonesia. Silakan diskusikan lokasi proyek Anda dengan tim kami.',
                        'Bagaimana proses purna jual dan garansi produk/layanan?' =>
                        'Setiap produk dan layanan disertai garansi sesuai kontrak. Kami menyediakan tim purna jual dan dukungan teknis yang responsif.',
                        'Minimal skala proyek yang diterima Tower?' =>
                        'Kami melayani proyek dari skala menengah hingga besar, namun kami terbuka untuk diskusi proyek skala kecil dengan potensi jangka panjang.',
                        'Apakah ada program pelatihan untuk klien?' =>
                        'Ya, kami menyediakan pelatihan teknis (misalnya, untuk sistem otomatisasi) sebagai bagian dari paket layanan kami.',
                        'Apa keunggulan Manufaktur Tower dibandingkan kompetitor?' =>
                        'Keunggulan kami terletak pada kustomisasi produk industri yang presisi dan standar kualitas internasional.',
                        'Apa yang membedakan Tower dari perusahaan manajemen lain?' =>
                        'Integrasi solusi (produk, konstruksi, engineering) di bawah satu atap, didukung komitmen pada transparansi dan kualitas premium.'
                    ];
                @endphp

                @foreach($right as $q => $a)
                <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqR{{ $loop->index }}"
                                type="button">
                            {{ $q }}
                            <i class="fas fa-plus custom-icon"></i>
                        </button>
                    </h2>
                    <div id="faqR{{ $loop->index }}" class="accordion-collapse collapse"
                            data-bs-parent="#faqRight">
                        <div class="accordion-body">{{ $a }}</div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>
</section>

{{-- ✅ AOS Initialization Script --}}
@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi AOS (Animate On Scroll)
        AOS.init({
            duration: 800, // Durasi animasi
            once: true // Animasi hanya terjadi sekali saat scroll
        });

        // Menambahkan fungsionalitas untuk memastikan AOS bekerja saat accordion dibuka/ditutup
        var accordions = document.querySelectorAll('.accordion-item');
        accordions.forEach(function(item) {
            item.addEventListener('shown.bs.collapse', function () {
                AOS.refresh();
            });
        });
    });
</script>
@endpush
@endsection
