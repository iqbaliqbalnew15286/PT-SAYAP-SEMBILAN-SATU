@extends('layouts.app')
@section('title','FAQ - Bidan Feni Care')

@push('styles')
<style>
    body { background:#0f0f0f; color:#eee; font-family:'Poppins',sans-serif; }

    /* Hero */
    .faq-hero {
        padding-top:130px;
        padding-bottom:60px;
        text-align:center;
        background:linear-gradient(to bottom,#111,#0f0f0f);
    }
    .faq-hero h1 { font-weight:700; color:#fff; }
    .faq-hero p { color:#c9c9c9; }

    .badge-custom {
        background:#1a1a1a;
        border:1px solid rgba(255,255,255,.2);
        color:#ffb400;
        font-weight:600;
        padding:8px 14px;
    }

    .divider {
        width:80px; height:3px;
        background:#ffb400;
        margin:12px auto 22px;
        border-radius:4px;
    }

    /* Accordion */
    .accordion-item {
        background:#151515;
        border:1px solid rgba(255,255,255,.08);
        margin-bottom:14px;
        border-radius:14px;
        overflow:hidden;
        box-shadow:0 8px 24px rgba(0,0,0,.45);
    }

    .accordion-button {
        background:#151515;
        color:#fff;
        font-weight:600;
        padding:18px;
        letter-spacing:.2px;
    }
    .accordion-button:focus { box-shadow:none !important; }

    .accordion-button.collapsed {
        color:#dcdcdc;
    }

    .accordion-button:not(.collapsed) {
        background:#1a1a1a;
        color:#ffb400;
        border-bottom:1px solid rgba(255,255,255,.1);
    }

    .accordion-body {
        background:#141414;
        color:#e0e0e0;
        padding:18px 20px;
        line-height:1.55;
    }

    /* Custom icon */
    .accordion-button::after { display:none; }
    .custom-icon {
        font-size:1rem; margin-left:auto;
        transition:.3s ease;
        color:#ffb400;
    }
    .accordion-button:not(.collapsed) .custom-icon {
        transform:rotate(45deg);
        color:#fff;
    }

</style>
@endpush

@section('content')

{{-- ✅ HERO --}}
<section class="faq-hero" data-aos="fade-down">
    <span class="badge-custom rounded-pill mb-2">FAQ</span>
    <h1>Frequently Asked Questions</h1>
    <div class="divider"></div>
    <p>Pertanyaan yang sering diajukan oleh Bunda & keluarga 💛</p>
</section>

{{-- ✅ FAQ CONTENT --}}
<section class="py-5">
<div class="container" style="max-width:950px;">
    <div class="row g-4">

        <div class="col-md-6">
            <div class="accordion" id="faqLeft">

                @php
                    $left = [
                        'Di mana lokasi Bidan Feni Care?' =>
                        'Kami memiliki beberapa cabang. Cek halaman lokasi untuk detail alamat.',
                        'Kapan jam operasional?' =>
                        'Jam operasional tiap cabang berbeda. Lihat halaman lokasi kami.',
                        'Cara reservasi?' =>
                        'Reservasi melalui website di menu Pemesanan atau tombol Reservasi.',
                        'Apakah perlu booking dulu?' =>
                        'Sangat disarankan, terutama layanan tertentu agar tidak full.',
                        'Bisa reschedule?' =>
                        'Bisa, sesuai kebijakan & ketersediaan jadwal.',
                        'Apakah ada ruang laktasi?' =>
                        'Tersedia ruang laktasi nyaman di setiap cabang.'
                    ];
                @endphp

                @foreach($left as $q => $a)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqL{{ $loop->index }}">
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

        <div class="col-md-6">
            <div class="accordion" id="faqRight">

                @php
                    $right = [
                        'Bisa request terapis?' =>
                        'Bisa request, tergantung ketersediaan.',
                        'Wilayah layanan?' =>
                        'Ada di beberapa kota besar, lihat halaman cabang.',
                        'Minimal layanan homecare?' =>
                        'Jika belum memenuhi min order, bisa tambah layanan lain.',
                        'Bunda & bayi satu ruangan?' =>
                        'Bisa request ruang privat jika tersedia.',
                        'Baby Spa untuk newborn?' =>
                        'Bisa setelah 7 hari & tali pusar lepas.',
                        'Apakah ada layanan homecare?' =>
                        'Ada, silakan hubungi CS untuk area jangkauan.'
                    ];
                @endphp

                @foreach($right as $q => $a)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faqR{{ $loop->index }}">
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

@endsection
