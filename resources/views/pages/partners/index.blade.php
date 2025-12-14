@extends('layouts.app')
@section('title', 'Mitra Industri - PT. Rizqallah Boer Makmur')

@push('styles')
    {{-- Memastikan Font Awesome dimuat (digunakan di Breadcrumb dan Ikon) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* -------------------------------------
           CATATAN: SKEMA WARNA RBM DI DEFINISIKAN
           DI tailwind.config.js (atau di kode Navbar)
           rbm-dark: #161f36 (Navy)
           rbm-accent: #FF7518 (Orange)
        ---------------------------------------*/

        /* Memastikan card ditampilkan sebagai flex untuk layout yang konsisten */
        .partner-card {
            display: flex;
            flex-direction: column;
        }

        /* Styling spesifik untuk slider (jika ada gambar) */
        .slider-image {
            object-fit: cover;
            /* Memastikan gambar tidak terdistorsi */
        }
    </style>
@endpush

@php
    // Variabel warna RBM yang telah disepakati (fallback dari tailwind.config jika tidak ada)
    $rbmDark = '#161f36';
    $rbmAccent = '#FF7518';
    $rbmLightText = '#b3b9c6';

    // Cek Variabel
    $hasImages = isset($partnersImages) && $partnersImages->isNotEmpty();
@endphp

@section('content')

    {{-- ✅ SLIDER GAMBAR DINAMIS (Header) --}}
    <section class="relative max-w-full">
        @if ($hasImages)
            {{-- Menggunakan AlpineJS untuk Slider Gambar Dinamis --}}
            <div x-data="{ activeSlide: 1, totalSlides: {{ $partnersImages->count() }} }"
                x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                <div class="relative w-full h-[300px] overflow-hidden">
                    @foreach ($partnersImages as $image)
                        <div x-show="activeSlide === {{ $loop->iteration }}"
                            x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            class="absolute inset-0">

                            <img src="{{ Storage::url($image->path) }}" alt="{{ $image->description ?? $image->filename }}"
                                class="w-full h-full slider-image">
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            {{-- Fallback: Background Biru Tua Navy --}}
            <div style="background-color: {{ $rbmDark }};">
                <div class="relative h-[250px] overflow-hidden">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="fas fa-handshake fa-4x text-white opacity-20"></i>
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- ✅ BREADCRUMB (Menggunakan Biru Tua RBM) --}}
    <div style="background-color: {{ $rbmDark }};">
        <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Menggunakan h-full dan flex items-center untuk membuat konten di tengah vertikal --}}
            <div class="h-full flex items-center">
                <nav class="flex" aria-label="Breadcrumb">
                    {{-- Text-sm agar tidak terlalu besar --}}
                    <ol class="inline-flex items-center space-x-2 md:space-x-3 text-sm">
                        <li class="inline-flex items-center">
                            <a href="/"
                                class="inline-flex items-center font-medium text-gray-300 hover:text-white transition-colors">
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs mx-1"></i>
                                {{-- Link Aktif (Teks Putih) --}}
                                <a href="{{ route('partners') }}"
                                    class="ml-2 font-medium text-white md:ml-3 transition-colors">Industry
                                    Partners</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>


    {{-- ========================================================== --}}
    {{-- BAGIAN MITRA INDUSTRI (Konten Utama) --}}
    {{-- ========================================================== --}}

    <section class="bg-gray-50 py-16 sm:py-24">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- KEPALA BAGIAN (JUDUL) --}}
            <div class="text-center max-w-3xl mx-auto mb-12 lg:mb-16">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-rbm-dark tracking-tight">
                    Bermitra dengan Industri Terkemuka
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    PT. RBM menjalin kerja sama strategis untuk memastikan kualitas produk dan layanan kami selalu relevan
                    dengan standar pasar tertinggi.
                </p>
            </div>

            {{-- STATISTIK & PENCARIAN --}}
            <div class="mb-10 max-w-3xl mx-auto">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 items-center">
                    {{-- Statistik Total Mitra --}}
                    <div
                        class="bg-white p-5 rounded-xl border border-gray-200 shadow-lg flex items-center space-x-4 transition duration-300 hover:shadow-xl">
                        <div
                            class="bg-rbm-accent/20 text-rbm-accent rounded-full h-14 w-14 flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-building fa-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Mitra Perusahaan</p>
                            <p class="text-3xl font-bold text-rbm-dark">{{ $partners->count() }}</p>
                        </div>
                    </div>
                    {{-- Fitur Pencarian --}}
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="search" id="partnerSearchInput" placeholder="Cari nama mitra..."
                            class="w-full pl-11 pr-4 py-3.5 border border-gray-300 rounded-xl text-base text-gray-700 focus:outline-none focus:ring-2 focus:ring-rbm-accent focus:border-rbm-accent transition shadow-md">
                    </div>
                </div>
            </div>


            {{-- GRID DAFTAR MITRA --}}
            <div id="partnersGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 lg:gap-8">

                {{-- Loop untuk setiap kartu mitra --}}
                @forelse($partners as $partner)
                    <div data-name="{{ strtolower($partner->name) }}"
                        class="partner-card group bg-white border border-gray-200 rounded-xl p-4 sm:p-6 flex flex-col text-center transition-all duration-300 shadow-lg hover:shadow-2xl hover:-translate-y-2">

                        {{-- Wadah Logo --}}
                        <div
                            class="h-20 sm:h-24 w-full bg-gray-100 rounded-lg flex items-center justify-center p-3 mb-4 border border-gray-200">

                            @if ($partner->logo)
                                <img src="{{ Storage::url($partner->logo) }}" alt="Logo {{ $partner->name }}"
                                    class="max-h-full max-w-full object-contain filter grayscale transition-all duration-500 group-hover:grayscale-0">
                            @else
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center rounded-md">
                                    <span class="text-sm font-semibold text-gray-500">Logo</span>
                                </div>
                            @endif
                        </div>

                        {{-- Nama Mitra --}}
                        <h3 class="text-base sm:text-lg font-bold text-rbm-dark mb-2 leading-snug">
                            {{ $partner->name }}
                        </h3>

                        {{-- Deskripsi Singkat (Dibuat lebih ringkas) --}}
                        <p class="text-xs text-gray-500 flex-grow mb-4 h-8 overflow-hidden">
                            {{ Str::limit($partner->description, 50) }}
                        </p>

                        {{-- AREA AKSI (Tombol) --}}
                        <div
                            class="w-full mt-auto pt-4 border-t border-gray-200/80 flex items-center justify-center space-x-3">

                            {{-- Tombol Lihat Detail (Aksi Utama - RBM Dark) --}}
                            <a href="{{ route('partners.show', $partner) }}"
                                class="inline-flex items-center justify-center bg-rbm-dark hover:bg-rbm-accent text-white text-xs font-bold px-4 py-2 rounded-full transition-colors duration-300 transform group-hover:scale-[1.03]">
                                Detail
                            </a>

                            {{-- Link Website (Ikon - RBM Accent Hover) --}}
                            @if ($partner->website)
                                <a href="{{ $partner->website }}" target="_blank" rel="noopener noreferrer"
                                    title="Kunjungi Situs Web"
                                    class="h-8 w-8 flex items-center justify-center bg-gray-100 hover:bg-rbm-accent text-gray-600 hover:text-white rounded-full transition-colors duration-300">
                                    <i class="fas fa-globe text-sm"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                @empty
                    {{-- Tampilan jika tidak ada data mitra --}}
                    <div
                        class="col-span-full bg-white border-2 border-dashed border-gray-300 rounded-xl p-12 text-center shadow-inner">
                        <i class="fas fa-exclamation-triangle fa-2x text-gray-400 mb-3"></i>
                        <p class="text-lg text-gray-500">Data mitra industri belum tersedia.</p>
                    </div>
                @endforelse

                {{-- Pesan jika pencarian tidak ditemukan --}}
                <div id="noResultsMessage"
                    class="hidden col-span-full bg-white border-2 border-dashed border-red-300 rounded-xl p-12 text-center shadow-inner">
                    <i class="fas fa-search-minus fa-2x text-red-400 mb-3"></i>
                    <p class="text-lg text-gray-500">Mitra yang Anda cari tidak ditemukan.</p>
                </div>

            </div>

            {{-- Tombol Load More --}}
            <div id="loadMoreContainer" class="text-center mt-12">
                <button id="loadMoreBtn"
                    class="bg-white hover:bg-gray-100 text-gray-700 font-bold py-3 px-8 rounded-full border border-gray-300 transition-colors duration-300 shadow-md">
                    Tampilkan Lebih Banyak
                </button>
            </div>

        </div>
    </section>

    {{-- ✅ SCRIPTS (Search & Load More Logic) --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('partnerSearchInput');
            // Ambil semua kartu mitra di awal
            const partnerCards = Array.from(document.querySelectorAll('.partner-card'));
            const noResultsMessage = document.getElementById('noResultsMessage');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const loadMoreContainer = document.getElementById('loadMoreContainer');

            // Tetapkan jumlah item per muatan (sesuaikan dengan desain grid)
            const itemsPerLoad = 20; // Default: Tampilkan 20 item
            let itemsShown = itemsPerLoad;

            // Fungsi untuk memperbarui kartu yang terlihat
            function updateVisibleCards() {
                let visibleCount = 0;
                partnerCards.forEach((card, index) => {
                    // Hanya tampilkan jika index kurang dari itemsShown
                    const isVisible = index < itemsShown;
                    card.style.display = isVisible ? 'flex' : 'none';
                    if (isVisible) {
                        visibleCount++;
                    }
                });

                // Tampilkan atau sembunyikan tombol "Load More"
                if (itemsShown >= partnerCards.length || partnerCards.length === visibleCount) {
                    loadMoreContainer.style.display = 'none';
                } else {
                    loadMoreContainer.style.display = 'block';
                }
            }

            // Fungsi untuk menangani logika pencarian
            function handleSearch() {
                const searchTerm = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;

                if (searchTerm) {
                    // Saat mencari, sembunyikan "Load More"
                    loadMoreContainer.style.display = 'none';

                    partnerCards.forEach(card => {
                        const partnerName = card.dataset.name;
                        // Logika pencarian sederhana: apakah nama mitra mengandung istilah pencarian
                        if (partnerName.includes(searchTerm)) {
                            card.style.display = 'flex';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Tampilkan pesan "Tidak Ditemukan" jika tidak ada hasil
                    noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';

                } else {
                    // Jika pencarian kosong, kembalikan ke state "Load More"
                    noResultsMessage.style.display = 'none';
                    itemsShown = itemsPerLoad; // Reset jumlah item yang ditampilkan
                    updateVisibleCards(); // Terapkan kembali tampilan awal (dengan load more)
                }
            }

            // Event listener untuk tombol "Load More"
            loadMoreBtn.addEventListener('click', () => {
                itemsShown += itemsPerLoad;
                updateVisibleCards();
            });

            // Event listener untuk input pencarian (menggunakan 'input' agar real-time)
            searchInput.addEventListener('input', handleSearch);

            // Inisialisasi tampilan awal
            updateVisibleCards();
        });
    </script>
@endsection
