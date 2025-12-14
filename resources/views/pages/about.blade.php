@extends('layouts.app')
@section('title', 'Tentang Kami - PT. Rizqallah Boer Makmur')

@push('styles')
    {{-- Memastikan ikon Font Awesome dimuat, menggantikan Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* -------------------------------------
           CATATAN: SKEMA WARNA RBM DI DEFINISIKAN
           DI tailwind.config.js (atau di kode Navbar sebelumnya)
           Warna utama: rbm-dark (#161f36 - Navy), rbm-accent (#FF7518 - Orange)
        ---------------------------------------*/
        .fade-content {
            /* Transisi sederhana untuk konten tab */
            transition: opacity 0.4s ease-in-out;
        }

        /*    AlpineJS tab button styling (tidak perlu banyak custom CSS
           karena sudah dihandle oleh Tailwind classes)
        */

        .tab-icon {
            /* Ikon Visi Misi */
            @apply text-5xl mb-4 block mx-auto;
            color: #FF7518; /* Menggunakan RBM Accent */
        }

        /* AOS Animation Library (jika digunakan) */
        [data-aos] {
            transition-property: all;
            transition-duration: 0.8s;
        }
    </style>
@endpush


@section('content')

    {{-- AlpineJS untuk Tabs (diambil dari CDN) --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @php
        // Variabel model (diasumsikan About berisi data Visi/Misi/Deskripsi)
        $about = \App\Models\About::first();
        // Fallback untuk konten
        $vision = $about?->vision ?? 'Menjadi perusahaan manajemen dan layanan teknis terdepan di Asia Tenggara yang dikenal atas keunggulan dan integritas.';
        $mission = $about?->mission ?? '1. Menyediakan solusi yang inovatif dan terintegrasi. 2. Membangun kemitraan jangka panjang berbasis kepercayaan. 3. Mendorong pertumbuhan berkelanjutan bagi klien dan perusahaan.';
        $goal = $about?->goal ?? 'Integritas | Inovasi | Kualitas Premium | Fokus pada Klien.';
        $title = $about?->title ?? 'Mitra Solusi Manajemen Terpercaya';
        $description = $about?->description ?? 'PT. Rizqallah Boer Makmur (RBM) hadir sebagai penyedia layanan dan produk premium yang berfokus pada efisiensi, inovasi, dan hasil yang optimal. Didukung oleh tim yang berpengalaman dan berdedikasi, kami berkomitmen untuk memberikan nilai tambah nyata bagi setiap proyek dan kemitraan yang kami jalani, menjadikan kesuksesan klien sebagai prioritas utama kami.';
    @endphp

    {{-- ✅ HERO (Menggunakan warna background terang) --}}
    <section class="bg-gray-50 pt-32 pb-20 text-center" data-aos="fade-down">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Badge menggunakan background Putih dan border tipis --}}
            <span
                class="inline-flex items-center rounded-full bg-white px-4 py-1.5 text-sm font-semibold text-gray-700 shadow-md border border-gray-200">
                Tentang Tower Management
            </span>

            <h1 class="mt-4 text-4xl sm:text-5xl lg:text-6xl font-extrabold text-rbm-dark">
                Dedikasi, Inovasi, dan Kualitas Tak Tertandingi
            </h1>
            {{-- Teks Muted menggunakan warna abu-abu yang soft --}}
            <p class="mt-4 text-lg text-gray-500 max-w-3xl mx-auto">
                “Membangun masa depan layanan premium bersama Anda.”
            </p>
        </div>
    </section>

    {{-- ✅ MAIN IMAGE --}}
    <section class="py-10">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-2xl overflow-hidden shadow-2xl border border-gray-100" data-aos="zoom-in">
                <img src="{{ $about?->image ? asset('storage/'.$about->image) : asset('assets/img/staff_kolase.jpg') }}"
                    class="w-full object-cover"
                    alt="Tim Tower Management Profesional"
                    style="height:480px; filter: grayscale(10%);">
            </div>
        </div>
    </section>

    {{-- ✅ DESCRIPTION (Card Putih Profesional) --}}
    <section class="py-10 pt-0">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-8 sm:p-10 shadow-xl border border-gray-100" data-aos="fade-up">
                {{-- Judul tebal, menggunakan warna dark navy --}}
                <h3 class="text-3xl font-bold text-rbm-dark mb-4">
                    {{ $title }}
                </h3>

                {{-- Konten teks --}}
                <p class="text-lg text-gray-700 leading-relaxed">
                    {{ $description }}
                </p>
            </div>
        </div>
    </section>

    {{-- ✅ VISI MISI TUJUAN (Tabs Modern) --}}
    <section class="py-10">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">

            <h2 class="text-4xl font-bold text-rbm-dark mb-10">Visi, Misi & Nilai Inti</h2>

            {{-- Container Tab Box --}}
            <div x-data="{ tab: 'visi' }" class="bg-white rounded-2xl p-6 sm:p-12 shadow-xl border border-gray-100 mx-auto max-w-4xl" data-aos="fade-up">

                {{-- Tabs Button --}}
                <div class="flex justify-center gap-3 mb-10 flex-wrap">
                    {{-- Tombol Visi --}}
                    <button @click="tab='visi'"
                        :class="tab=='visi' ? 'bg-rbm-accent text-rbm-dark shadow-lg shadow-rbm-accent/20 border-rbm-accent' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                        class="px-6 py-2.5 rounded-lg font-semibold border transition-all duration-300 transform hover:translate-y-[-2px]">
                        Visi Kami
                    </button>
                    {{-- Tombol Misi --}}
                    <button @click="tab='misi'"
                        :class="tab=='misi' ? 'bg-rbm-accent text-rbm-dark shadow-lg shadow-rbm-accent/20 border-rbm-accent' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                        class="px-6 py-2.5 rounded-lg font-semibold border transition-all duration-300 transform hover:translate-y-[-2px]">
                        Misi Kami
                    </button>
                    {{-- Tombol Nilai Inti --}}
                    <button @click="tab='nilai'"
                        :class="tab=='nilai' ? 'bg-rbm-accent text-rbm-dark shadow-lg shadow-rbm-accent/20 border-rbm-accent' : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-50'"
                        class="px-6 py-2.5 rounded-lg font-semibold border transition-all duration-300 transform hover:translate-y-[-2px]">
                        Nilai Inti
                    </button>
                </div>

                {{-- Content Area --}}
                <div class="fade-content min-h-[150px] flex items-center justify-center">
                    {{-- Visi --}}
                    <template x-if="tab==='visi'">
                        <div x-transition>
                            <i class="tab-icon fas fa-flag"></i>
                            <p class="text-xl text-gray-700 italic max-w-3xl mx-auto">
                                {{ $vision }}
                            </p>
                        </div>
                    </template>

                    {{-- Misi --}}
                    <template x-if="tab==='misi'">
                        <div x-transition>
                            <i class="tab-icon fas fa-cogs"></i>
                            <div class="text-left max-w-3xl mx-auto">
                                <ul class="list-disc list-inside text-lg text-gray-700 space-y-2 font-medium">
                                    @foreach (explode('.', $mission) as $item)
                                        @if (trim($item))
                                            <li>{{ trim($item, ' ') }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </template>

                    {{-- Nilai Inti --}}
                    <template x-if="tab==='nilai'">
                        <div x-transition>
                            <i class="tab-icon fas fa-gem"></i>
                            <p class="text-xl text-gray-700 italic max-w-3xl mx-auto font-semibold">
                                {{ $goal }}
                            </p>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </section>

    {{-- ✅ CTA (Menggunakan warna Biru Tua Navy sebagai background) --}}
    <section class="py-12">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="bg-rbm-dark p-10 sm:p-16 rounded-2xl text-center shadow-2xl" data-aos="fade-up">
                {{-- Teks Putih --}}
                <h2 class="text-4xl font-extrabold text-white mb-3">Mari Mulai Proyek Anda Sekarang!</h2>
                {{-- Teks Abu-abu Terang --}}
                <p class="text-lg text-rbm-light-text mb-8 max-w-2xl mx-auto">
                    PT. RBM siap menjadi mitra Anda. Hubungi kami untuk konsultasi gratis dan dapatkan penawaran terbaik.
                </p>

                {{-- Tombol CTA (Oranye Terang) --}}
                <a href="{{ route('contact') }}"
                    class="inline-flex items-center bg-rbm-accent text-rbm-dark font-bold text-lg px-8 py-3 rounded-xl shadow-lg transition-all duration-300 hover:bg-opacity-90 hover:scale-[1.02] transform">
                    Jadwalkan Konsultasi <i class="fas fa-headset ms-2"></i>
                </a>
            </div>
        </div>
    </section>

@endsection
