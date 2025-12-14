@extends('layouts.app')

@section('title', 'PROJECT TOWER')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        {{-- 1. SEO: Meta Description --}}
        <meta name="description"
            content="Selamat datang di SMK Amaliah 1 & 2 Ciawi, Sekolah Pusat Keunggulan. Temukan program keahlian unggulan, fasilitas modern, dan berita terbaru kami. Daftar online sekarang!">

        {{-- 2. PERFORMA: Preconnect ke domain penting untuk mempercepat handshake DNS, TCP, dan TLS --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="preconnect" href="https://cdn.curator.io">
        <link rel="preconnect" href="https://www.youtube-nocookie.com">

        {{-- 3. PERFORMA: Memuat CSS non-kritis secara asinkron untuk menghilangkan render-blocking --}}
        {{-- Font Awesome --}}
        <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        </noscript>

        {{-- Google Fonts: Poppins --}}
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
            as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
        </noscript>

        {{-- Splide CSS --}}
        <link rel="preload" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css"
            as="style" onload="this.onload=null;this.rel='stylesheet'">
        <noscript>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
        </noscript>

        {{-- 4. PERFORMA: Muat semua skrip dengan 'defer' agar tidak memblokir parsing HTML --}}
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    </head>
    <style>
        .hero-clip-path {
            clip-path: polygon(0 0, 100% 0, 100% calc(100% - 4rem), calc(100% - 4rem) 100%, 0 100%);
        }

        /* Aturan ini akan aktif jika lebar layar 768px atau kurang */
        @media (max-width: 768px) {
            .custom-none {
                display: none;
            }
        }
    </style>

    <body class="font-['Poppins'] bg-gray-100">
        @php
            $amaliahGreen = '#161f36'; // Matching layout's navy blue
            $amaliahOrange = '#FF7518'; // Matching layout's bright orange
            $amaliahDark = '#282829';
            $amaliahBlue = '#E0E7FF';
            $hasImages = isset($mainImages) && $mainImages->isNotEmpty();
        @endphp
        <main style="margin-top: 10px;">
            <section class="relative max-w-[1440px] mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                @if ($hasImages && $latestNews->isNotEmpty())
                    <div x-data="{
                        showVideo: false,
                        activeImageSlide: 1,
                        totalImageSlides: {{ $mainImages->count() }},
                        activeNewsSlide: 1,
                        totalNewsSlides: {{ $latestNews->count() }}
                    }" x-init="setInterval(() => {
                        if (!showVideo) { // Animasi gambar hanya berjalan jika video tidak ditampilkan
                            activeImageSlide = activeImageSlide % totalImageSlides + 1
                        }
                    }, 5000);
                    setInterval(() => { activeNewsSlide = activeNewsSlide % totalNewsSlides + 1 }, 5000);">

                        <div class="relative h-[550px] overflow-hidden hero-clip-path rounded-3xl">

                            {{-- Kontainer Slider Gambar (Hanya tampil jika showVideo false) --}}
                            <div x-show="!showVideo" class="w-full h-full">
                                @foreach ($mainImages as $image)
                                    <div x-show="activeImageSlide === {{ $loop->iteration }}"
                                        x-transition:enter="transition ease-out duration-1000"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="transition ease-in duration-1000"
                                        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                        class="absolute inset-0">
                                        <img src="{{ Storage::url($image->path) }}"
                                            alt="{{ $image->description ?? $image->filename }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach

                                {{-- Tombol "Watch Video" di Pojok Kanan Atas --}}
                                <button @click="showVideo = true"
                                    class="absolute top-6 right-6 z-20 flex items-center gap-2 bg-black/50 backdrop-blur-sm text-white px-4 py-2 rounded-full hover:bg-black/70 transition-all duration-300">
                                    <svg xmlns="https://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm font-semibold">Watch Video</span>
                                </button>
                            </div>

                            {{-- Kontainer Iframe YouTube (Hanya tampil jika showVideo true) --}}
                            <div x-show="showVideo" x-cloak class="w-full h-full">
                                {{-- Iframe yang sudah dimodifikasi --}}
                                <iframe class="w-full h-full"
                                    :src="showVideo ?
                                        'https://www.youtube.com/embed/STOhZZmY6Co?autoplay=1&mute=1&controls=0&loop=1&playlist=STOhZZmY6Co&rel=0&iv_load_policy=3&modestbranding=1' :
                                        ''"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    title="youtube" allowfullscreen>
                                </iframe>

                                {{-- Tombol "Close" untuk Video --}}
                                <button @click="showVideo = false"
                                    class="absolute top-6 right-6 z-20 flex items-center justify-center w-10 h-10 bg-black/50 backdrop-blur-sm text-white rounded-full hover:bg-black/70 transition-all duration-300">
                                    <svg xmlns="https://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        {{-- Bagian bawah (kartu berita dan logo) tidak diubah --}}
                        <div class="absolute bottom-12 left-8 md:left-12 z-10 w-[calc(100%-4rem)] max-w-md">

                            <div class="bg-white/90 backdrop-blur-md border border-white/30 rounded-xl p-3 shadow-lg mb-4">
                                <div class="flex items-center justify-between w-full">
                                    <div class="flex items-center justify-between w-full pr-2">
                                        <img src="{{ asset('assets/logo/infra.png') }}" alt="Logo Partner 1"
                                            class="h-7 object-contain transition duration-300">
                                        <img src="{{ asset('assets/logo/jh.png') }}" alt="Logo Partner 5"
                                            class="h-7 object-contain transition duration-300">
                                        <img src="{{ asset('assets/logo/komdigi.png') }}" alt="Logo Partner 2"
                                            class="h-7 object-contain transition duration-300">
                                        <img src="{{ asset('assets/logo/maspionit.png') }}" alt="Logo Partner 3"
                                            class="h-7 object-contain transition duration-300">
                                        <img src="{{ asset('assets/logo/gspark.png') }}" alt="Logo Partner 4"
                                            class="h-7 object-contain transition duration-300">
                                    </div>

                                    <a href="https://jagoanhosting.com/"
                                        class="text-[#282829] hover:text-gray-600 transition-colors flex-shrink-0">
                                        <svg xmlns="https://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            {{-- Kontainer Slider Kartu Berita --}}
                            <div class="relative w-full h-auto min-h-[250px] overflow-hidden hero-clip-path ">
                                @foreach ($latestNews as $news)
                                    <div x-show="activeNewsSlide === {{ $loop->iteration }}"
                                        x-transition:enter="transition transform ease-in-out duration-500"
                                        x-transition:enter-start="opacity-0 translate-y-10"
                                        x-transition:enter-end="opacity-100 translate-y-0"
                                        x-transition:leave="transition transform ease-in-out duration-500"
                                        x-transition:leave-start="opacity-100 translate-y-0"
                                        x-transition:leave-end="opacity-0 -translate-y-10"
                                        class="absolute inset-0 w-full">

                                        <div
                                            class="flex flex-col h-full bg-white/90 backdrop-blur-lg p-6 rounded-2xl shadow-2xl border border-white/30">
                                            <h1 class="text-xl font-bold text-gray-900 leading-tight line-clamp-2">
                                                {{ $news->title }}
                                            </h1>
                                            <p class="text-sm mt-2 text-gray-700 line-clamp-3 flex-grow">
                                                {{ strip_tags($news->description) }}
                                            </p>
                                            <p class="text-xs font-medium text-gray-500 mt-4">
                                                Diterbitkan
                                                {{ \Carbon\Carbon::parse($news->date_published)->translatedFormat('d F Y') }}
                                            </p>
                                            <div class="mt-4">
                                                <a href="{{ route('public.news.show', $news) }}"
                                                    class="inline-flex items-center gap-2 text-sm font-semibold text-white bg-[#282829] px-4 py-2 rounded-full hover:bg-black transition-all duration-300 group">
                                                    Selengkapnya
                                                    <i
                                                        class="fas fa-arrow-right transition-transform duration-300 group-hover:translate-x-1"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    {{-- Fallback jika tidak ada data --}}
                    <div class="relative h-[550px] overflow-hidden hero-clip-path rounded-3xl bg-black"></div>
                @endif
            </section>

            <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mt-12 mb-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    @php
                        // Data untuk setiap kartu fitur (ditambahkan 'link' dan 'button_text')
                        $fitur = [
                            [
                                'icon' => 'fa-file-lines',
                                'title' => 'SPMB Online',
                                'desc' =>
                                    'Ayo daftarkan dirimu di SMK Amaliah secara mudah melalui sistem online kami.',
                                'link' => 'https://ppdb.smkamaliah.sch.id/login', // Ganti dengan route atau URL PPDB Anda
                                'button_text' => 'Daftar Sekarang',
                            ],
                            [
                                'icon' => 'fa-chart-simple',
                                'title' => 'E-Learning',
                                'desc' =>
                                    'Akses materi, tugas, dan sumber belajar kapan saja melalui platform E-Learning terintegrasi.',
                                'link' => 'https://lms.smkamaliah.sch.id', // Ganti dengan URL E-Learning Anda
                                'button_text' => 'Mulai Belajar',
                            ],
                            [
                                'icon' => 'fa-vr-cardboard',
                                'title' => 'Virtual Tour',
                                'desc' =>
                                    'Jelajahi setiap sudut dan fasilitas sekolah kami secara virtual dari kenyamanan rumah Anda.',
                                'link' => 'https://yourdisc710.itch.io/amaliah-tour', // Ganti dengan route atau URL Virtual Tour
                                'button_text' => 'Jelajahi Sekarang',
                            ],
                            [
                                'icon' => 'fa-building-columns',
                                'title' => 'Ujian Online',
                                'desc' =>
                                    'Laksanakan berbagai ujian sekolah dengan mudah dan aman melalui platform ujian online kami.',
                                'link' => 'https://play.google.com/store/apps/details?id=com.amexam', // Ganti dengan URL Ujian Online
                                'button_text' => 'Masuk Ujian',
                            ],
                        ];

                        // Asumsi variabel $amaliahGreen dan $amaliahDark sudah ada
                        $amaliahGreen = $amaliahGreen ?? '#63cd00';
                        $amaliahDark = $amaliahDark ?? '#282829';
                    @endphp

                    {{-- Loop untuk menampilkan setiap kartu fitur --}}
                    @foreach ($fitur as $index => $item)
                        {{-- Seluruh kartu sekarang adalah sebuah link --}}
                        <a href="{{ $item['link'] }}"
                            class=" border-[{{ $loop->even ? $amaliahGreen : $amaliahOrange }}] group bg-gray-50 p-6 rounded-2xl flex flex-col items-start border-2  hover:border-[{{ $loop->even ? $amaliahGreen : $amaliahOrange }}] hover:bg-white transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-1">

                            {{-- Bagian Ikon --}}
                            <div class="p-4 rounded-xl mb-4" style="background-color: {{ $loop->even ? $amaliahGreen : $amaliahOrange }};">
                                <i class="fas {{ $item['icon'] }} text-2xl text-white"></i>
                            </div>

                            {{-- Bagian Teks --}}
                            <h2 class="text-lg font-bold mb-2" style="color: {{ $amaliahDark }};">{{ $item['title'] }}
                            </h2>
                            <p class="text-sm text-gray-600 mb-4 flex-grow">{{ $item['desc'] }}</p>

                            {{-- Tombol Link dengan teks dinamis --}}
                            <div class="text-sm font-semibold flex items-center mt-auto"
                                style="color: {{ $loop->even ? $amaliahGreen : $amaliahOrange }};">
                                <span>{{ $item['button_text'] }}</span>
                                <i
                                    class="fas fa-chevron-right ml-2 text-xs transition-transform group-hover:translate-x-1"></i>
                            </div>
                        </a>
                    @endforeach

                </div>
            </section>

            {{-- Bagian Header Judul --}}
            <section class="text-center px-4 sm:px-6 lg:px-8 mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800">We Have Intelligent Solution For Your Education
                </h2>
                <div class="flex items-center justify-center gap-x-2 mx-auto mt-4">
                    <div class="w-20 h-1.5 rounded-full" style="background-color: {{ $amaliahGreen }};"></div>
                    <div class="w-4 h-1.5 rounded-full" style="background-color: {{ $amaliahGreen }};"></div>
                    <div class="w-4 h-1.5 rounded-full" style="background-color: {{ $amaliahGreen }};"></div>
                </div>
            </section>

            {{-- Bagian Konten Utama (Deskripsi, Tombol, dan Grid Gambar) --}}
            <section class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    {{-- Kolom Kiri: Teks dan Tombol --}}
                    <div class="text-gray-600">
                        <p class="text-base leading-relaxed">
                            SMK Amaliah 1 & 2 merupakan bentuk sekolah kejuruan yang dibawah naungan Yayasan Pusat Studi
                            Pengembangan Islam Amaliyah Indonesia (YPSPIAI) dengan mengutamakan kualitas, Profesionalitas
                            dan Pelayanan Prima dan dibawah pengawasan Universitas Djuanda (UNIDA) berdiri pada tahun 2008.
                        </p>

                        {{-- Wadah untuk Tombol --}}
                        <div
                            class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-4 mt-8">

                            <a href="https://ppdb.smkamaliah.sch.id/"
                                class="group inline-flex items-center justify-between text-white pl-6 pr-2 py-2 rounded-lg font-semibold shadow-lg transition-all duration-300 hover:shadow-xl hover:opacity-90"
                                style="background-color: {{ $amaliahGreen }};">

                                <span class="mr-4">Info PPDB</span>

                                <span
                                    class="bg-white rounded-full h-8 w-8 flex items-center justify-center transition-transform duration-300 group-hover/button:translate-x-1 ease-in-out group-hover:translate-x-1">
                                    <i class="fas fa-arrow-right text-sm " style="color: {{ $amaliahGreen }};"></i>
                                </span>
                            </a>

                            <a href="{{ route('about') }}"
                                class="group inline-flex items-center justify-between text-white pl-6 pr-2 py-2 rounded-lg font-semibold shadow-lg transition-all duration-300 hover:shadow-xl hover:opacity-90"
                                style="background-color: {{ $amaliahOrange }};">

                                <span class="mr-4">Selengkapnya</span>

                                <span
                                    class="bg-white rounded-full h-8 w-8 flex items-center justify-center transition-transform duration-300 group-hover/button:translate-x-1 ease-in-out group-hover:translate-x-1">
                                    <i class="fas fa-arrow-right text-sm    " style="color: {{ $amaliahOrange }};"></i>
                                </span>
                            </a>

                        </div>
                    </div>

                    {{-- Kolom Kanan: Grid Gambar Dinamis dari Database --}}
                    <div class="grid grid-cols-3 grid-rows-3 gap-4 h-96">

                        {{-- Gambar 1 (Slot Paling Kiri, Tinggi) --}}
                        @if (isset($gridImages[0]))
                            <img src="{{ Storage::url($gridImages[0]->path) }}" alt="Grid Image 1"
                                class="w-full h-full object-cover rounded-lg row-span-2">
                        @else
                            <div class="bg-gray-200 rounded-lg row-span-2"></div>
                        @endif

                        {{-- Gambar 2 (Slot Kanan Atas, Besar) --}}
                        @if (isset($gridImages[1]))
                            <img src="{{ Storage::url($gridImages[1]->path) }}" alt="Grid Image 2"
                                class="w-full h-full object-cover rounded-lg col-span-2 row-span-2">
                        @else
                            <div class="bg-gray-200 rounded-lg col-span-2 row-span-2"></div>
                        @endif

                        {{-- Gambar 3 (Slot Kiri Bawah) --}}
                        @if (isset($gridImages[2]))
                            <img src="{{ Storage::url($gridImages[2]->path) }}" alt="Grid Image 3"
                                class="w-full h-full object-cover rounded-lg">
                        @else
                            <div class="bg-gray-200 rounded-lg"></div>
                        @endif

                        {{-- Gambar 4 (Slot Tengah Bawah) --}}
                        @if (isset($gridImages[3]))
                            <img src="{{ Storage::url($gridImages[3]->path) }}" alt="Grid Image 4"
                                class="w-full h-full object-cover rounded-lg">
                        @else
                            <div class="bg-gray-200 rounded-lg"></div>
                        @endif

                        {{-- Gambar 5 (Slot Kanan Bawah) --}}
                        @if (isset($gridImages[4]))
                            <img src="{{ Storage::url($gridImages[4]->path) }}" alt="Grid Image 5"
                                class="w-full h-full object-cover rounded-lg">
                        @else
                            <div class="bg-gray-200 rounded-lg"></div>
                        @endif

                    </div>
                </div>
            </section>

            </section>
            <section class="bg-white py-16 sm:py-24">
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                        {{-- Kolom Kiri: Teks & Tombol (Tidak ada perubahan) --}}
                        <div class="text-left">
                            <h2 class="text-4xl md:text-5xl font-bold" style="color: {{ $amaliahDark }};">
                                Here Is Our<br>Industry Partner
                            </h2>

                            <div class="flex items-center gap-x-2 mt-4">
                                <div class="w-20 h-1.5 rounded-full" style="background-color: {{ $amaliahGreen }};">
                                </div>
                                <div class="w-4 h-1.5 rounded-full" style="background-color: {{ $amaliahGreen }};"></div>
                                <div class="w-4 h-1.5 rounded-full" style="background-color: {{ $amaliahGreen }};"></div>
                            </div>

                            <p class="mt-6 text-gray-600 leading-relaxed">
                                We cooperate with industry leaders to provide students with real-world experience through
                                internships, industrial visits, training, and career opportunities after graduation.
                            </p>

                            <a href="{{ route('partners') }}"
                                class="group mt-8 inline-flex items-center text-white px-6 py-3 rounded-lg font-semibold shadow-lg group/button transition-opacity duration-300 hover:opacity-90"
                                style="background-color: {{ $amaliahGreen }};">
                                <span class="mr-4 text-lg">Selengkapnya</span>
                                <div
                                    class="bg-white rounded-full p-2 flex items-center justify-center transition-transform duration-300 group-hover/button:translate-x-1 ease-in-out group-hover:translate-x-1">
                                    <i class="fas fa-arrow-right text-base " style="color: {{ $amaliahGreen }};"></i>
                                </div>
                            </a>
                        </div>

                        {{-- Kolom Kanan: Grid Logo Mitra dengan Animasi Scroll --}}
                        <div class="group relative h-[28rem] overflow-hidden">
                            {{-- Kontainer untuk item yang akan dianimasikan --}}
                            <div
                                class="grid grid-cols-2 md:grid-cols-4 gap-x-8 gap-y-10 animate-scroll-vertical group-hover:[animation-play-state:paused]">

                                {{-- Loop data dari controller (DUPLIKASI 1) --}}
                                @forelse ($partners as $partner)
                                    <div class="text-center">
                                        <div
                                            class="bg-gray-100 h-24 w-full rounded-lg mb-3 flex items-center justify-center p-4">
                                            <img src="{{ asset('storage/' . $partner->logo) }}"
                                                alt="Logo {{ $partner->name }}"
                                                class="max-h-full max-w-full object-contain">
                                        </div>
                                        <p class="text-sm text-gray-600 font-medium">{{ $partner->name }}</p>
                                    </div>
                                @empty
                                    <div class="col-span-2 md:col-span-4 text-center">
                                        <p class="text-gray-500">Belum ada mitra yang ditambahkan.</p>
                                    </div>
                                @endforelse

                                {{-- Loop data dari controller (DUPLIKASI 2 - Untuk Efek Mulus) --}}
                                @forelse ($partners as $partner)
                                    <div class="text-center">
                                        <div
                                            class="bg-gray-100 h-24 w-full rounded-lg mb-3 flex items-center justify-center p-4">
                                            <img src="{{ asset('storage/' . $partner->logo) }}"
                                                alt="Logo {{ $partner->name }}"
                                                class="max-h-full max-w-full object-contain">
                                        </div>
                                        <p class="text-sm text-gray-600 font-medium">{{ $partner->name }}</p>
                                    </div>
                                @empty
                                    {{-- Tidak perlu pesan empty di duplikasi --}}
                                @endforelse
                            </div>
                            {{-- Efek fade di bagian bawah untuk transisi yang lebih halus --}}
                            <div
                                class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-white to-transparent pointer-events-none">
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            {{-- Tambahkan CSS untuk Animasi di bagian bawah file blade atau di file CSS utama --}}
            <style>
                @keyframes scroll-vertical {
                    from {
                        transform: translateY(0);
                    }

                    to {
                        transform: translateY(-50%);
                    }
                }

                .animate-scroll-vertical {
                    /* Sesuaikan durasi (misal: 60s) untuk mengatur kecepatan scroll */
                    animation: scroll-vertical 120s linear infinite;
                }
            </style>


            {{-- Tombol Navigasi (Hanya tampil di mobile) --}}
            <div class="lg:hidden mt-6 flex items-center space-x-4">
                <button @click="scrollSlider('prev')"
                    class="bg-white hover:bg-gray-200 text-gray-800 w-12 h-12 rounded-lg flex items-center justify-center transition-colors"
                    id="majorbutton" role="presentation" aria-label="button">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button @click="scrollSlider('next')"
                    class="bg-white hover:bg-gray-200 text-gray-800 w-12 h-12 rounded-lg flex items-center justify-center transition-colors"
                    id="majorbutton" role="presentation" aria-label="button">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            </div>
            </div>
            </section>


            <section class="py-16 sm:py-24" style="background-color: {{ $amaliahDark }};">
                {{-- Container Utama --}}
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative">

                    {{-- Dekorasi Titik --}}
                    <div class="absolute top-8 left-8 md:left-12 flex items-center space-x-2 custom-none">
                        <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                        <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                        <div class="w-3 h-3 bg-white rounded-full"></div>
                    </div>

                    {{-- Header Section --}}
                    <div class="text-center">
                        <h2 class="text-3xl md:text-4xl font-bold text-white">Fasilitas</h2>
                        <p class="mt-2 text-gray-400">Stay in the know with insights from industry experts.</p>
                        <div class="w-24 h-px bg-gray-600 mx-auto mt-4"></div>
                    </div>

                    {{-- Galeri Gambar Mozaik Dinamis --}}
                    <div class="mt-12 w-full h-[30rem] md:h-[32rem] grid grid-cols-2 md:grid-cols-4 grid-rows-2 gap-4">

                        {{-- Gambar 1 (Tinggi di Kiri) --}}
                        <div class="col-span-1 row-span-2 rounded-xl overflow-hidden">
                            @if (isset($facilities[0]) && $facilities[0]->image)
                                <img src="{{ asset('storage/' . $facilities[0]->image) }}"
                                    alt="{{ $facilities[0]->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                {{-- Placeholder jika gambar tidak ada --}}
                                <div class="w-full h-full bg-black"></div>
                            @endif
                        </div>

                        {{-- Gambar 2 (Tengah Atas) --}}
                        <div class="col-span-1 row-span-1 rounded-xl overflow-hidden">
                            @if (isset($facilities[1]) && $facilities[1]->image)
                                <img src="{{ asset('storage/' . $facilities[1]->image) }}"
                                    alt="{{ $facilities[1]->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="w-full h-full bg-black"></div>
                            @endif
                        </div>

                        {{-- Gambar 3 (Kanan Atas) --}}
                        <div class="col-span-1 md:col-span-2 row-span-1 rounded-xl overflow-hidden">
                            @if (isset($facilities[2]) && $facilities[2]->image)
                                <img src="{{ asset('storage/' . $facilities[2]->image) }}"
                                    alt="{{ $facilities[2]->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="w-full h-full bg-black"></div>
                            @endif
                        </div>

                        {{-- Gambar 4 (Tengah Bawah) --}}
                        <div class="col-span-1 row-span-1 rounded-xl overflow-hidden">
                            @if (isset($facilities[3]) && $facilities[3]->image)
                                <img src="{{ asset('storage/' . $facilities[3]->image) }}"
                                    alt="{{ $facilities[3]->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="w-full h-full bg-black"></div>
                            @endif
                        </div>

                        {{-- Gambar 5 (Kanan Bawah) --}}
                        <div class="col-span-1 md:col-span-2 row-span-1 rounded-xl overflow-hidden">
                            @if (isset($facilities[4]) && $facilities[4]->image)
                                <img src="{{ asset('storage/' . $facilities[4]->image) }}"
                                    alt="{{ $facilities[4]->name }}"
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                            @else
                                <div class="w-full h-full bg-black"></div>
                            @endif
                        </div>
                    </div>

                    {{-- Tombol Selengkapnya --}}
                    <div class="text-right mt-6">
                        <a href="{{ route('facilities') }}" class="inline-flex items-center group">
                            <span class="text-sm font-semibold text-white mr-3">Selengkapnya</span>
                            <div
                                class="bg-gray-200 rounded-full p-2 group-hover:bg-gray-300 transition-transform duration-300 group-hover/button:translate-x-1 ease-in-out group-hover:translate-x-1">
                                <i class="fas fa-arrow-right text-gray-800 text-sm"></i>
                            </div>
                        </a>
                    </div>

                </div>
            </section>
            {{-- CSS Tambahan untuk menyembunyikan scrollbar --}}
            <style>
                .scrollbar-hide::-webkit-scrollbar {
                    display: none;
                }

                .scrollbar-hide {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
            </style>


            @php
                // Definisikan warna utama
                $amaliahGreen = '#63cd00';
                $amaliahDark = '#282829';

                // Definisikan informasi kontak
                $alamat = 'Jl. Raya Jl. Tol Jagorawi No.1, Ciawi, Kec. Ciawi, Kabupaten Bogor, Jawa Barat 16720';
                $email = 'smkamaliahciawi@gmail.com';
                $phone = '0856-1922-827 / 0856-4901-1449';
            @endphp

        </main>
    </body>

    </html>
@endsection
