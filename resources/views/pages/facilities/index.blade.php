@extends('layouts.app')
@section('title', 'Fasilitas - PT. Rizqallah Boer Makmur')

@push('styles')
    {{-- Memastikan Font Awesome dimuat --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
        /* -------------------------------------
           CATATAN: SKEMA WARNA RBM DI DEFINISIKAN
           rbm-dark: #161f36 (Navy)
           rbm-accent: #FF7518 (Orange)
        ---------------------------------------*/

        /* Memastikan gambar slider tampil optimal */
        .slider-image {
            object-fit: cover;
        }

        /* Memastikan card ditampilkan sebagai flex untuk layout yang konsisten */
        .facility-card {
            display: flex;
            flex-direction: column;
        }
    </style>
@endpush

@php
    // Variabel warna RBM yang telah disepakati
    $rbmDark = '#161f36';
    $rbmAccent = '#FF7518';
    $rbmLightText = '#b3b9c6';

    // Cek Variabel
    $hasImages = isset($facilityImages) && $facilityImages->isNotEmpty();

    // Mapping ikon untuk fasilitas (bisa disesuaikan lebih lanjut di model atau database)
    $iconMap = [
        'Akademik' => 'fa-book-open',
        'Olahraga' => 'fa-futbol',
        'Umum' => 'fa-building',
        'Workshop' => 'fa-screwdriver-wrench',
        'Lab' => 'fa-flask',
        'Kesehatan' => 'fa-hospital-user',
    ];
@endphp

@section('content')

    {{-- ✅ SLIDER GAMBAR DINAMIS (Header) --}}
    <section class="relative max-w-full">
        @if ($hasImages)
            {{-- Menggunakan AlpineJS untuk Slider Gambar Dinamis --}}
            <div x-data="{ activeSlide: 1, totalSlides: {{ $facilityImages->count() }} }"
                x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                <div class="relative w-full h-[300px] overflow-hidden">
                    @foreach ($facilityImages as $image)
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
                        <i class="fas fa-tools fa-4x text-white opacity-20"></i>
                    </div>
                </div>
            </div>
        @endif
    </section>

    {{-- ✅ BREADCRUMB (Menggunakan Biru Tua RBM) --}}
    <div style="background-color: {{ $rbmDark }};">
        <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-full flex items-center">
                <nav class="flex" aria-label="Breadcrumb">
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
                                <a href="{{ route('facilities') }}"
                                    class="ml-2 font-medium text-white md:ml-3 transition-colors">Facilities</a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {{-- ========================================================== --}}
    {{-- BAGIAN 1: INTRO FASILITAS & GALLERY GRID (Gambar dari $gridImages) --}}
    {{-- ========================================================== --}}
    <section class="bg-white py-20 sm:py-24">
        <div class="container mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-y-16 gap-x-8 lg:grid-cols-2">

                {{-- Kolom Kiri: Image Gallery Grid --}}
                <div class="flex items-end justify-center gap-4 lg:justify-start">
                    @php $count = 0; @endphp
                    @foreach ($gridImages as $image)
                        @php
                            $count++;
                            // Logika untuk ukuran dinamis
                            $sizeClasses = [
                                1 => 'h-48 w-28 shadow-lg',
                                2 => 'h-64 w-32 shadow-xl',
                                3 => 'h-80 w-36 shadow-2xl',
                            ][$count] ?? 'h-48 w-28 shadow-lg';

                            // Hentikan setelah 3 gambar agar grid tetap cantik
                            if ($count > 3) continue;
                        @endphp

                        <div
                            class="rounded-xl bg-gray-100 {{ $sizeClasses }} overflow-hidden transform transition-transform duration-500 hover:scale-[1.05]">
                            <img src="{{ Storage::url($image->path) }}"
                                alt="{{ $image->alt_text ?? $image->title ?? 'Facility Image' }}"
                                class="h-full w-full rounded-xl object-cover">
                        </div>
                    @endforeach
                </div>

                {{-- Kolom Kanan: Teks & Key Features --}}
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl font-bold tracking-tight text-rbm-dark sm:text-4xl">
                        Fasilitas Modern untuk Kualitas Terbaik
                    </h2>
                    <p class="mt-4 text-lg leading-8 text-gray-600">
                        Kami menyediakan perangkat dan infrastruktur terkini untuk memastikan setiap proyek
                        dilakukan dengan presisi dan standar kualitas tertinggi.
                    </p>

                    <ul class="mt-8 space-y-4">
                        {{-- Menggunakan warna rbm-accent untuk poin --}}
                        <li class="flex items-start justify-center lg:justify-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-xl text-rbm-accent"></i>
                            </div>
                            <span class="ml-3 text-base text-gray-700 font-semibold">Infrastruktur Berstandar Internasional</span>
                        </li>
                        <li class="flex items-start justify-center lg:justify-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-xl text-rbm-accent"></i>
                            </div>
                            <span class="ml-3 text-base text-gray-700 font-semibold">Sistem Keamanan dan Kontrol Mutu Ketat</span>
                        </li>
                        <li class="flex items-start justify-center lg:justify-start">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-xl text-rbm-accent"></i>
                            </div>
                            <span class="ml-3 text-base text-gray-700 font-semibold">Perawatan Berkala dan Teknologi Terbaru</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    {{-- ========================================================== --}}
    {{-- BAGIAN 2: DAFTAR FASILITAS DENGAN TAB --}}
    {{-- ========================================================== --}}
    <section class="bg-gray-50 py-16 sm:py-24">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- KEPALA BAGIAN (JUDUL DI KIRI, TAB DI KANAN) --}}
            <div class="flex flex-col md:flex-row justify-between md:items-end gap-8 mb-12">

                {{-- Kolom Kiri: Judul dan Deskripsi --}}
                <div class="md:w-1/2 lg:w-2/3">
                    <h2 class="text-3xl lg:text-4xl font-extrabold text-rbm-dark tracking-tight">
                        Fasilitas Unggulan Kami
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Jelajahi beragam sarana dan prasarana modern yang kami sediakan.
                    </p>
                </div>

                {{-- Kolom Kanan: Tombol Tab Filter --}}
                <div class="flex-shrink-0">
                    {{-- Container untuk tombol tab --}}
                    <div id="tabs-container" class="flex flex-wrap items-center justify-start md:justify-end gap-3">
                        @foreach ($groupedFacilities->keys() as $type)
                            <button data-tab="{{ Str::slug($type) }}"
                                class="tab-button px-4 py-2 text-sm font-semibold rounded-full transition-colors duration-200">
                                {{ $type }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>


            {{-- KONTEN TAB (GRID FASILITAS) --}}
            @foreach ($groupedFacilities as $type => $facilities)
                <div id="{{ Str::slug($type) }}" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @forelse($facilities as $facility)
                            {{-- KARTU FASILITAS --}}
                            @php
                                // Ambil ikon dari mapping, fallback ke fa-star jika tidak ada
                                $iconClass = $iconMap[$facility->type] ?? 'fa-star';
                            @endphp

                            <div
                                class="facility-card group bg-white border border-gray-200 rounded-xl overflow-hidden shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                                {{-- GAMBAR FASILITAS --}}
                                <div class="relative h-56 w-full">
                                    <img src="{{ $facility->image ? Storage::url($facility->image) : 'https://placehold.co/600x400/e2e8f0/64748b?text=Image' }}"
                                        alt="Gambar {{ $facility->name }}" class="w-full h-full object-cover">
                                </div>

                                {{-- KONTEN CARD --}}
                                <div class="p-6 flex flex-col flex-grow">
                                    {{-- TIPE & IKON (Menggunakan RBM Accent) --}}
                                    <div class="flex items-center text-sm font-semibold text-rbm-accent mb-2">
                                        <i class="fas {{ $iconClass }} mr-2 w-4 text-center"></i>
                                        <span>{{ $facility->type }}</span>
                                    </div>
                                    {{-- NAMA FASILITAS --}}
                                    <h3 class="text-xl font-bold text-rbm-dark mb-2 leading-tight">
                                        {{ $facility->name }}
                                    </h3>
                                    {{-- DESKRIPSI SINGKAT --}}
                                    <p class="text-gray-600 text-sm flex-grow mb-6">
                                        {{ Str::limit($facility->description, 100) }}
                                    </p>
                                    {{-- TOMBOL AKSI --}}
                                    <div class="mt-auto">
                                        <a href="{{ route('facilities.show', $facility) }}"
                                            class="inline-flex items-center font-bold text-rbm-dark hover:text-rbm-accent group/link transition-colors duration-300">
                                            Baca Selengkapnya
                                            <i
                                                class="fas fa-arrow-right ml-2 text-xs transition-transform duration-300 group-hover/link:translate-x-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            {{-- TAMPILAN JIKA TIDAK ADA FASILITAS PADA TIPE INI --}}
                            <div class="col-span-full border-2 border-dashed border-gray-300 rounded-xl p-12 text-center">
                                <p class="text-gray-500 font-medium">Fasilitas untuk kategori **"{{ $type }}"** tidak
                                    ditemukan.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        {{-- SCRIPT UNTUK MEKANISME TAB --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabsContainer = document.getElementById('tabs-container');

                if (tabsContainer) {
                    const tabButtons = tabsContainer.querySelectorAll('.tab-button');
                    const tabContents = document.querySelectorAll('.tab-content');
                    const firstTabName = tabButtons.length > 0 ? tabButtons[0].dataset.tab : null;

                    // Ganti warna aktif/non-aktif sesuai RBM Theme
                    const activeClasses = ['bg-rbm-accent', 'text-white', 'shadow-md'];
                    const inactiveClasses = ['bg-gray-100', 'text-gray-700', 'hover:bg-gray-200'];

                    function switchTab(tabName) {
                        if (!tabName) return;

                        // Sembunyikan semua konten dan atur style tombol
                        tabButtons.forEach(button => {
                            const contentId = button.dataset.tab;
                            const content = document.getElementById(contentId);

                            // Atur tombol
                            if (contentId === tabName) {
                                button.classList.add(...activeClasses);
                                button.classList.remove(...inactiveClasses);
                            } else {
                                button.classList.add(...inactiveClasses);
                                button.classList.remove(...activeClasses);
                            }

                            // Atur konten
                            if (content) {
                                content.classList.add('hidden');
                            }
                        });

                        // Tampilkan konten yang dipilih
                        const activeContent = document.getElementById(tabName);
                        if (activeContent) {
                            activeContent.classList.remove('hidden');
                        }
                    }

                    // Tambahkan event listener ke setiap tombol
                    tabButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            switchTab(button.dataset.tab);
                        });
                    });

                    // Atur tab default saat halaman dimuat (tab pertama)
                    if (firstTabName) {
                        switchTab(firstTabName);
                    } else {
                        // Jika tidak ada tab sama sekali, pastikan semua konten tersembunyi
                        tabContents.forEach(content => {
                            content.classList.add('hidden');
                        });
                    }
                }
            });
        </script>
    </section>


    {{-- ========================================================== --}}
    {{-- BAGIAN 3: VIDEO FASILITAS (YouTube) --}}
    {{-- ========================================================== --}}
    <section class="bg-white py-16 sm:py-24">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-rbm-dark sm:text-4xl">
                    Jelajahi Fasilitas Kami dalam Video
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Saksikan video di bawah ini untuk melihat lebih dekat lingkungan kerja dan fasilitas yang kami miliki.
                </p>
            </div>

            <div class="mt-12 max-w-4xl mx-auto">
                <div class="relative w-full" style="padding-top: 56.25%;">
                    <iframe class="absolute top-0 left-0 w-full h-full rounded-xl shadow-2xl" width="560"
                        height="315"
                        src="https://www.youtube-nocookie.com/embed/V1itS-cUH4M?si=uZIO58_CPQb9nwDA&amp;controls=1"
                        title="YouTube video player" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-in; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </section>

@endsection
