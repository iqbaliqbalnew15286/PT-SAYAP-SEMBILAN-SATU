@extends('layouts.app')

@section('title', 'Hubungi Kami - Tower Management')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
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

body {
    font-family: 'Poppins', sans-serif;
    background: var(--bg-light);
    color: var(--text-dark);
}

.contact-section {
    padding-top: 130px;
    padding-bottom: 80px;
    background: linear-gradient(to bottom, var(--bg-light), #F1F3F7);
}

.contact-box {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 45px; /* Padding lebih besar */
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    transition: .3s ease;
}

.contact-box:hover {
    box-shadow: 0 10px 40px rgba(0,0,0,0.15);
    transform: none; /* Menghilangkan transform hover */
}

.section-title {
    color: var(--text-dark);
    font-weight: 800; /* Lebih tebal */
    font-size: 2.5rem;
    text-align: center;
    margin-bottom: 15px;
}

.section-subtitle {
    color: var(--text-muted);
    text-align: center;
    max-width: 600px;
    margin: 0 auto 50px;
}

.gold-line {
    width: 70px;
    height: 4px;
    background: var(--accent);
    margin: 0 auto 25px;
    border-radius: 4px;
}

.column-header {
    font-weight: 700;
    color: var(--text-dark); /* Menggunakan warna gelap */
    font-size: 1.3rem;
    margin-bottom: 25px;
    padding-bottom: 8px;
    border-bottom: 2px solid var(--border-subtle);
}

.contact-item {
    display: flex;
    align-items: flex-start; /* Align ke atas */
    gap: 16px;
    margin-bottom: 30px;
}

.contact-item i {
    font-size: 2.2rem; /* Ikon lebih besar */
    color: var(--accent);
    flex-shrink: 0;
}

.contact-item .info-text {
    font-size: 1.05rem;
    font-weight: 500;
    color: var(--text-dark);
    text-decoration: none;
    line-height: 1.4;
    transition:.2s ease;
}

.contact-item .info-text:hover {
    color: var(--accent);
}

.label {
    font-size: .85rem;
    color: var(--text-muted);
    margin-top: 2px;
}

/* Social Icons (Modern & Subtle) */
.social-icons a {
    width: 42px;
    height: 42px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px; /* Lebih kotak */
    font-size: 1.1rem;
    margin-right: 12px;
    margin-bottom: 10px;
    background: #F1F3F7; /* Latar belakang sangat terang */
    color: var(--text-dark);
    border: 1px solid var(--border-subtle);
    transition: .3s;
}

.social-icons a:hover {
    transform: translateY(-2px);
    background: var(--accent);
    color: var(--text-dark);
    border-color: var(--accent);
    box-shadow: 0 4px 10px rgba(255,195,0,0.25);
}

.email-contact {
    color: var(--text-dark);
    font-weight: 600;
    text-decoration: none;
    font-size: 1rem;
    display: flex;
    align-items: center;
    margin-top: 6px;
}

.email-contact i {
    font-size: 1.3rem;
    margin-right: 8px;
    color: var(--accent);
}

.email-contact:hover {
    color: var(--accent);
}

/* MAP SECTION */
.map-container {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--border-subtle);
    box-shadow: 0 8px 30px rgba(0,0,0,0.1);
    height: 300px; /* Tinggi Map */
}
</style>
@endpush

@section('content')

<section class="contact-section">
    <div class="container">

        <h2 class="section-title" data-aos="fade-down">Hubungi Tower Management</h2>
        <div class="gold-line"></div>
        <p class="section-subtitle" data-aos="fade-down" data-aos-delay="100">
            Tim kami siap membantu Anda dengan pertanyaan mengenai proyek, layanan, atau kemitraan bisnis.
        </p>

        <div class="contact-box" data-aos="fade-up" data-aos-delay="200">
            <div class="row">

                {{-- KIRI: Kontak Utama --}}
                <div class="col-md-4 mb-5 mb-md-0">
                    <h3 class="column-header">Kontak Utama</h3>

                    <div class="contact-item">
                        <i class="bi bi-headset"></i>
                        <div>
                            <a href="tel:+6221XXXXXXX" class="info-text" target="_blank">+62 21 XXXX XXXX</a>
                            <div class="label">Pusat Layanan Klien (24/7)</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-briefcase"></i>
                        <div>
                            <a href="https://wa.me/6281234567890" class="info-text" target="_blank">+62 812 3456 7890</a>
                            <div class="label">Kemitraan & Bisnis Development</div>
                        </div>
                    </div>

                    <div class="contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <div>
                            <span class="info-text">
                                SCBD Tower Lt. 15, Jl. Sudirman Kav. 52-53, Jakarta Selatan
                            </span>
                            <div class="label">Kantor Pusat</div>
                        </div>
                    </div>
                </div>

                {{-- TENGAH: Alamat & Map --}}
                <div class="col-md-4 mb-5 mb-md-0">
                    <h3 class="column-header">Lokasi Kami</h3>

                    <p class="label mb-3">Kunjungi kami di kantor pusat kami di Jakarta. Mohon buat janji temu terlebih dahulu.</p>

                    <div class="map-container">
                        {{-- Placeholder untuk Google Map Embed --}}
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.368812615598!2d106.80415517502758!3d-6.216694693774849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f14d8f7b764b%3A0x6b42b1234567890!2sSCBD%20Tower%20Jakarta!5e0!3m2!1sen!2sid!4v1701993600000!5m2!1sen!2sid"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- KANAN: Social & Email --}}
                <div class="col-md-4">
                    <h3 class="column-header">Digital & Media</h3>

                    <div class="mb-4">
                        <h4 class="label fw-semibold mb-2" style="color: var(--text-dark);">Email Resmi</h4>
                        <a href="mailto:info@towermanagement.com" class="email-contact">
                            <i class="bi bi-envelope-at-fill"></i> info@towermanagement.com
                        </a>
                        <a href="mailto:careers@towermanagement.com" class="email-contact mt-2">
                            <i class="bi bi-person-workspace"></i> careers@towermanagement.com
                        </a>
                    </div>

                    <div class="mb-3">
                        <h4 class="label fw-semibold mb-2" style="color: var(--text-dark);">Ikuti Kami</h4>
                        <div class="social-icons">
                            {{-- Mengganti ikon dan tautan sesuai konteks B2B --}}
                            <a href="#" target="_blank"><i class="bi bi-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-twitter-x"></i></a>
                            <a href="#" target="_blank"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

@endsection
