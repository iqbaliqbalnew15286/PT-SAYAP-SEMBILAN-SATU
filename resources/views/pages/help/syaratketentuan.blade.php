@extends('layouts.app')

@section('title', 'Syarat & Ketentuan Layanan - Tower Management')

@push('styles')
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

/* HERO SECTION (Clean & Light) */
.sk-section {
    padding-top: 130px;
    padding-bottom: 70px;
    background: linear-gradient(to bottom, var(--bg-light), #F1F3F7);
}

.sk-container {
    max-width: 950px;
    margin: auto;
}

.sk-title {
    font-weight: 800; /* Lebih tebal */
    color: var(--text-dark);
    font-size: 2.5rem;
}

.sk-subtext {
    color: var(--text-muted);
    max-width: 700px;
    margin: auto;
    font-size: 1.05rem;
}

.gold-divider {
    width: 70px;
    height: 4px;
    background: var(--accent);
    margin: 10px auto 25px;
    border-radius: 4px;
}

/* CATEGORY TITLE */
.sk-category-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark); /* Menggunakan warna gelap */
    margin-top: 40px;
    margin-bottom: 18px;
    border-bottom: 2px solid var(--border-subtle);
    padding-bottom: 8px;
}

/* ACCORDION (Modern Minimalis) */
.accordion-item {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    margin-bottom: 15px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,.05);
}

.accordion-button {
    background: var(--bg-card) !important;
    color: var(--text-dark);
    font-weight: 600;
    padding: 18px 22px;
    font-size: 1rem;
    transition: .3s ease;
}

.accordion-button:not(.collapsed) {
    background: var(--accent) !important; /* Kuning ketika aktif */
    color: var(--text-dark);
    border-bottom: 1px solid var(--border-subtle);
    box-shadow: 0 2px 5px rgba(255, 195, 0, 0.2);
}

.accordion-button:focus {
    box-shadow:none;
}

.accordion-button::after { display:none; }

.custom-icon {
    margin-left:auto;
    transition:.3s ease;
    color: var(--text-muted);
    font-size: 1.2rem;
}

.accordion-button:not(.collapsed) .custom-icon {
    transform:rotate(45deg);
    color: var(--text-dark);
}

.accordion-body {
    background: #F4F6F9;
    padding: 20px 25px;
    color: var(--text-dark);
    font-size: .95rem;
    line-height: 1.6;
}

.accordion-body strong { color: var(--accent); }

ol, ul { padding-left: 20px; }

</style>
@endpush

@section('content')
<section class="sk-section">
    <div class="container sk-container text-center" data-aos="fade-down">
        <h2 class="sk-title">Syarat & Ketentuan Layanan</h2>
        <div class="gold-divider"></div>
        <p class="sk-subtext">
            Dokumen ini mengatur hak dan kewajiban antara Klien dan Tower Management terkait semua produk dan layanan profesional yang disediakan.
        </p>
    </div>

    <div class="container sk-container mt-5">
        <div class="accordion" id="skAccordion">

            <h3 class="sk-category-title" data-aos="fade-right">1. Ketentuan Kontrak & Umum</h3>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="100">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk1" type="button">
                        Persetujuan Kontrak Resmi
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk1" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Semua proyek dan layanan besar memerlukan penandatanganan **Perjanjian Layanan Tertulis (Kontrak)**. Penawaran atau *Purchase Order* (PO) dianggap sebagai persetujuan awal atas S&K yang berlaku, kecuali dinyatakan lain dalam Kontrak utama.
                    </div>
                </div>
            </div>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk2" type="button">
                        Kewajiban Data Teknis & Lokasi
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2 class="accordion-header">
                <div id="sk2" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Klien wajib menyediakan **data teknis, spesifikasi, dan akses lokasi** proyek yang lengkap dan akurat. Tower Management tidak bertanggung jawab atas keterlambatan atau kesalahan yang timbul akibat data yang tidak valid atau kurang lengkap.
                    </div>
                </div>
            </div>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="300">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk3" type="button">
                        Hak Kekayaan Intelektual (HKI)
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk3" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Semua **desain, blueprint, metodologi, dan perangkat lunak** yang dikembangkan oleh Tower selama proyek tetap menjadi HKI milik Tower, kecuali HKI tersebut secara eksplisit dialihkan kepada Klien melalui persetujuan tertulis dalam Kontrak.
                    </div>
                </div>
            </div>

            <h3 class="sk-category-title" data-aos="fade-right">2. Pembayaran & Penagihan</h3>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="400">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk4" type="button">
                        Syarat Pembayaran & Termin
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk4" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Pembayaran proyek akan mengikuti jadwal termin yang disepakati dalam Kontrak. Umumnya melibatkan:
                        <ol>
                            <li>**Pembayaran Uang Muka (Down Payment/DP)** untuk mobilisasi tim dan pembelian material awal.</li>
                            <li>Pembayaran Progres berdasarkan pencapaian target kerja.</li>
                            <li>Pembayaran Akhir setelah serah terima proyek (Final Handover).</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="500">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk5" type="button">
                        Keterlambatan Pembayaran
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk5" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Keterlambatan pembayaran melebihi batas waktu yang ditentukan dalam faktur dapat mengakibatkan **penghentian sementara** layanan atau pekerjaan proyek tanpa pemberitahuan lebih lanjut.
                    </div>
                </div>
            </div>

            <h3 class="sk-category-title" data-aos="fade-right">3. Pembatalan & Pengakhiran Kontrak</h3>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="600">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk6" type="button">
                        Pembatalan Proyek oleh Klien
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk6" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Jika Klien membatalkan proyek setelah Kontrak ditandatangani, Klien berkewajiban membayar **seluruh biaya pekerjaan yang telah diselesaikan** dan **biaya pembatalan** (termasuk biaya material non-refundable dan biaya administrasi) yang diatur dalam Kontrak.
                    </div>
                </div>
            </div>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="700">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk7" type="button">
                        Pengakhiran oleh Tower Management
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk7" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Tower berhak mengakhiri Kontrak secara sepihak jika Klien melanggar S&K, gagal melakukan pembayaran, atau terlibat dalam aktivitas ilegal yang merugikan nama baik atau operasional Tower.
                    </div>
                </div>
            </div>

            <h3 class="sk-category-title" data-aos="fade-right">4. Garansi & Jaminan Kualitas</h3>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="800">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk8" type="button">
                        Periode Garansi
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk8" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Produk dan instalasi kami dilindungi oleh Garansi selama periode yang ditetapkan, terhitung sejak tanggal Serah Terima Proyek (FHO). Durasi garansi bervariasi tergantung jenis layanan/produk.
                    </div>
                </div>
            </div>

            <div class="accordion-item" data-aos="fade-up" data-aos-delay="900">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#sk9" type="button">
                        Batasan Garansi
                        <i class="fas fa-plus custom-icon"></i>
                    </button>
                </h2>
                <div id="sk9" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body">
                        Garansi tidak mencakup kerusakan yang disebabkan oleh:
                        <ul>
                            <li>Penggunaan yang salah atau tidak sesuai panduan.</li>
                            <li>Modifikasi atau perbaikan yang dilakukan pihak ketiga tanpa izin Tower.</li>
                            <li>Bencana alam (force majeure).</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
