@extends('layouts.app')

@section('title', 'Syarat & Ketentuan Layanan - Tower Management')

@push('styles')
{{-- Memastikan Font Awesome (untuk ikon plus/minus) dan AOS dimuat --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
/* |--------------------------------------------------------------------------
| CUSTOM STYLES & OVERRIDES
|--------------------------------------------------------------------------
| Menggunakan variabel kustom CSS untuk tema warna dan beberapa override
| yang sulit dilakukan dengan kelas utilitas Tailwind murni.
*/
:root {
    --accent: #FFC300; /* Kuning Amber */
    --bg-light: #F8F9FB;
    --bg-card: #FFFFFF;
    --text-dark: #2C3E50;
    --text-muted: #7F8C8D;
    --border-subtle: #E9ECEF;
}

/* Mengatur background body menggunakan CSS variabel */
body {
    background-color: var(--bg-light);
    color: var(--text-dark);
}

/* Kategori Title (Override untuk padding/border kustom) */
.sk-category-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-top: 40px;
    margin-bottom: 18px;
    border-bottom: 2px solid var(--border-subtle);
    padding-bottom: 8px;
}

/* Accordion active state override */
.accordion-button:not(.collapsed) {
    background: var(--accent) !important;
    border-bottom: 1px solid var(--border-subtle) !important;
    box-shadow: 0 2px 5px rgba(255, 195, 0, 0.2) !important;
}

/* Accordion body background */
.accordion-body {
    background-color: #F4F6F9 !important;
    color: var(--text-dark);
    line-height: 1.6;
}

/* Custom icon rotation */
.accordion-button::after { display: none; }
.custom-icon {
    transition: transform 0.3s ease, color 0.3s ease;
    color: var(--text-muted);
}
.accordion-button:not(.collapsed) .custom-icon {
    transform: rotate(45deg);
    color: var(--text-dark);
}

/* Warna aksen untuk list/strong di body */
.accordion-body strong { color: var(--accent); }
</style>
@endpush

@section('content')
<section
    class="pt-32 pb-16 bg-gradient-to-b from-[var(--bg-light)] to-[#F1F3F7] min-h-screen"
    data-aos="fade-down"
>
    {{-- HERO SECTION --}}
    <div class="container mx-auto max-w-4xl px-4 text-center">
        <h2 class="text-4xl font-extrabold text-[var(--text-dark)] md:text-5xl">
            Syarat & Ketentuan Layanan
        </h2>

        {{-- Divider Emas --}}
        <div class="w-[70px] h-1 bg-[var(--accent)] mx-auto mt-2 mb-6 rounded"></div>

        <p class="text-lg text-[var(--text-muted)] mx-auto max-w-3xl">
            Dokumen ini mengatur hak dan kewajiban antara Klien dan Tower Management terkait semua produk dan layanan profesional yang disediakan.
        </p>
    </div>

    {{-- ACCORDION CONTENT --}}
    <div class="container mx-auto max-w-4xl mt-12 px-4">
        <div class="accordion" id="skAccordion">

            {{-- KATEGORI 1: Ketentuan Kontrak & Umum --}}
            <h3 class="sk-category-title" data-aos="fade-right">1. Ketentuan Kontrak & Umum</h3>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="100">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk1" type="button">
                        Persetujuan Kontrak Resmi
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk1" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Semua proyek dan layanan besar memerlukan penandatanganan **Perjanjian Layanan Tertulis (Kontrak)**. Penawaran atau *Purchase Order* (PO) dianggap sebagai persetujuan awal atas S&K yang berlaku, kecuali dinyatakan lain dalam Kontrak utama.
                    </div>
                </div>
            </div>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="200">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk2" type="button">
                        Kewajiban Data Teknis & Lokasi
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk2" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Klien wajib menyediakan **data teknis, spesifikasi, dan akses lokasi** proyek yang lengkap dan akurat. Tower Management tidak bertanggung jawab atas keterlambatan atau kesalahan yang timbul akibat data yang tidak valid atau kurang lengkap.
                    </div>
                </div>
            </div>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="300">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk3" type="button">
                        Hak Kekayaan Intelektual (HKI)
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk3" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Semua **desain, blueprint, metodologi, dan perangkat lunak** yang dikembangkan oleh Tower selama proyek tetap menjadi HKI milik Tower, kecuali HKI tersebut secara eksplisit dialihkan kepada Klien melalui persetujuan tertulis dalam Kontrak.
                    </div>
                </div>
            </div>

            {{-- KATEGORI 2: Pembayaran & Penagihan --}}
            <h3 class="sk-category-title" data-aos="fade-right">2. Pembayaran & Penagihan</h3>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="400">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk4" type="button">
                        Syarat Pembayaran & Termin
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk4" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Pembayaran proyek akan mengikuti jadwal termin yang disepakati dalam Kontrak. Umumnya melibatkan:
                        <ol class="list-decimal list-inside ml-4 mt-2 space-y-1">
                            <li>**Pembayaran Uang Muka (Down Payment/DP)** untuk mobilisasi tim dan pembelian material awal.</li>
                            <li>Pembayaran Progres berdasarkan pencapaian target kerja.</li>
                            <li>Pembayaran Akhir setelah serah terima proyek (Final Handover).</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="500">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk5" type="button">
                        Keterlambatan Pembayaran
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk5" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Keterlambatan pembayaran melebihi batas waktu yang ditentukan dalam faktur dapat mengakibatkan **penghentian sementara** layanan atau pekerjaan proyek tanpa pemberitahuan lebih lanjut.
                    </div>
                </div>
            </div>

            {{-- KATEGORI 3: Pembatalan & Pengakhiran Kontrak --}}
            <h3 class="sk-category-title" data-aos="fade-right">3. Pembatalan & Pengakhiran Kontrak</h3>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="600">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk6" type="button">
                        Pembatalan Proyek oleh Klien
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk6" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Jika Klien membatalkan proyek setelah Kontrak ditandatangani, Klien berkewajiban membayar **seluruh biaya pekerjaan yang telah diselesaikan** dan **biaya pembatalan** (termasuk biaya material non-refundable dan biaya administrasi) yang diatur dalam Kontrak.
                    </div>
                </div>
            </div>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="700">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk7" type="button">
                        Pengakhiran oleh Tower Management
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk7" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Tower berhak mengakhiri Kontrak secara sepihak jika Klien melanggar S&K, gagal melakukan pembayaran, atau terlibat dalam aktivitas ilegal yang merugikan nama baik atau operasional Tower.
                    </div>
                </div>
            </div>

            {{-- KATEGORI 4: Garansi & Jaminan Kualitas --}}
            <h3 class="sk-category-title" data-aos="fade-right">4. Garansi & Jaminan Kualitas</h3>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="800">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk8" type="button">
                        Periode Garansi
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk8" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Produk dan instalasi kami dilindungi oleh Garansi selama periode yang ditetapkan, terhitung sejak tanggal Serah Terima Proyek (FHO). Durasi garansi bervariasi tergantung jenis layanan/produk.
                    </div>
                </div>
            </div>

            <div class="accordion-item shadow-lg mb-4 rounded-xl border border-[var(--border-subtle)]" data-aos="fade-up" data-aos-delay="900">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed flex items-center w-full text-left font-semibold text-lg py-4 px-6 rounded-xl transition duration-300 ease-in-out"
                            data-bs-toggle="collapse" data-bs-target="#sk9" type="button">
                        Batasan Garansi
                        <i class="fas fa-plus custom-icon text-xl"></i>
                    </button>
                </h2>
                <div id="sk9" class="accordion-collapse collapse" data-bs-parent="#skAccordion">
                    <div class="accordion-body text-base p-6 rounded-b-xl">
                        Garansi tidak mencakup kerusakan yang disebabkan oleh:
                        <ul class="list-disc list-inside ml-4 mt-2 space-y-1">
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

{{-- ✅ AOS Initialization Script (Wajib agar data-aos bekerja) --}}
@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi AOS (Animate On Scroll)
        AOS.init({
            duration: 800, // Durasi animasi
            once: true // Animasi hanya terjadi sekali saat scroll
        });

        // Refresh AOS saat accordion dibuka
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
