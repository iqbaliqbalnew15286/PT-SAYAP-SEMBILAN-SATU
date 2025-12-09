@extends('layouts.app')

@section('title', 'Syarat & Ketentuan')

@push('styles')
<style>
    body {
        background:#0f0f0f;
        color:#e9e9e9;
    }

    .sk-section {
        padding-top:130px;
        padding-bottom:60px;
    }

    .sk-container {
        max-width:850px;
        margin:auto;
    }

    .sk-title {
        font-weight:700;
        color:#fff;
        letter-spacing:.5px;
        font-size:2rem;
    }

    .sk-subtext {
        color:#bfbfbf;
        max-width:650px;
        margin:auto;
        font-size:.98rem;
    }

    .gold-divider {
        width:90px;
        height:3px;
        background:#ffb400;
        margin:10px auto 25px;
        border-radius:4px;
    }

    .sk-category-title {
        font-size:1.25rem;
        font-weight:700;
        color:#ffb400;
        margin-top:40px;
        margin-bottom:12px;
    }

    .accordion-item {
        background:#141414;
        border:1px solid rgba(255,255,255,.08);
        margin-bottom:16px;
        border-radius:14px;
        overflow:hidden;
        box-shadow:0 8px 22px rgba(0,0,0,.45);
    }

    .accordion-button {
        background:#141414 !important;
        color:#fff;
        font-weight:600;
        padding:18px;
        font-size:.95rem;
        transition:.3s ease;
    }

    .accordion-button:not(.collapsed) {
        background:#1c1c1c !important;
        color:#ffb400;
        border-bottom:1px solid rgba(255,255,255,.1);
    }

    .accordion-button:focus {
        box-shadow:none;
    }

    .accordion-button::after { display:none; }

    .custom-icon {
        margin-left:auto;
        transition:.3s ease;
        color:#ffb400;
        font-size:1rem;
    }

    .accordion-button:not(.collapsed) .custom-icon {
        transform:rotate(45deg);
        color:#fff;
    }

    .accordion-body {
        background:#0f0f0f;
        padding:18px 22px;
        color:#dcdcdc;
        font-size:.92rem;
        line-height:1.55;
    }

    .accordion-body strong { color:#ffb400; }

    ol, ul { padding-left:17px; }

</style>
@endpush

@section('content')
<section class="sk-section">
    <div class="container sk-container text-center">
        <h2 class="sk-title">Syarat & Ketentuan</h2>
        <div class="gold-divider"></div>
        <p class="sk-subtext">
            Mohon membaca seluruh ketentuan sebelum menggunakan layanan Bidan Feni Care.
        </p>
    </div>

    <div class="container sk-container mt-5">
        <div class="accordion" id="skAccordion">

            <h3 class="sk-category-title">1. Ketentuan Umum</h3>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk1">
                        Persetujuan Syarat & Ketentuan
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk1" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Dengan menggunakan layanan, Anda menyetujui seluruh syarat & ketentuan yang berlaku.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk2">
                        Kewajiban Data Valid
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk2" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Pelanggan wajib memberikan data lengkap & benar. Kesalahan data menjadi tanggung jawab pelanggan.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk3">
                        Informasi & Kontak
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk3" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Seluruh komunikasi hanya melalui admin resmi Bidan Feni Care.
                    </div>
                </div>
            </div>

            <h3 class="sk-category-title">2. Homecare</h3>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk4">
                        Minimum Order Homecare
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk4" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Jika total layanan tidak memenuhi batas minimum, pelanggan dapat:
                        <ol>
                            <li>Menambah layanan, atau</li>
                            <li>Membayar selisih minimum</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk5">
                        Tempat Pelayanan
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk5" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Klien wajib menyediakan tempat bersih, nyaman, dan aman untuk layanan.
                    </div>
                </div>
            </div>

            <h3 class="sk-category-title">3. Pembayaran & Reschedule</h3>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk6">
                        Pembayaran
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk6" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Pembayaran dilakukan sebelum layanan dimulai. Bukti pembayaran wajib dikirim ke admin.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk7">
                        Pembatalan
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk7" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Pembatalan dalam <strong>kurang dari 2 jam</strong> dikenakan biaya pembatalan.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk8">
                        Reschedule
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk8" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Perubahan jadwal min. **4 jam sebelum** sesi berlangsung, sesuai ketersediaan terapis.
                    </div>
                </div>
            </div>

            <h3 class="sk-category-title">4. Ketentuan Khusus</h3>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk9">
                        Layanan Pijat Laktasi
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk9" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Pijat laktasi hanya menangani mastitis awal. Kondisi abses harus ke fasilitas medis.
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk10">
                        Kebersihan Pasca-Laktasi
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk10" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Setelah terapi, klien wajib mencuci area payudara sebelum menyusui.
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
