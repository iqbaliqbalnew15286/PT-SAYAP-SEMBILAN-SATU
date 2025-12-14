<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/am.png') }}">

    <title>@yield('title', 'PT. Rizqallah Boer Makmur')</title>

    {{-- 🛑 CATATAN: Hapus baris di bawah ini dan ganti dengan @vite(['resources/css/app.css', 'resources/js/app.js']) jika Anda menggunakan build tool seperti Vite/Laravel Mix. --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    {{-- Google Fonts: Poppins (Sans) dan Times New Roman (Serif) --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Times+New+Roman&display=swap"
        rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- 🎨 KONFIGURASI TAILWIND KHUSUS (RBM: Biru Tua, Oranye Terang) --}}
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        // Biru Tua / Navy (Dominan dari Logo RBM)
                        'rbm-dark': '#161f36',
                        // Oranye Terang (Aksen dari Logo RBM)
                        'rbm-accent': '#FF7518',
                        // Abu-abu terang untuk sub-teks di background gelap
                        'rbm-light-text': '#b3b9c6',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                        'times': ['"Times New Roman"', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* Definisi variabel CSS untuk Navigasi */
        :root {
            --accent: #FF7518; /* Bright Orange */
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        /* --- STYLING NAVIGASI UTAMA (Desktop - Dark Background) --- */
        .nav-link {
            /* Teks navigasi utama harus putih untuk kontras tinggi di atas Biru Tua */
            @apply relative text-white px-3 py-2 transition-colors duration-300 flex items-center text-[15px] font-medium;
        }

        .nav-link::after {
            content: '';
            /* Garis bawah menggunakan warna aksen (Orange) */
            background-color: var(--accent);
            @apply absolute left-0 -bottom-1 w-0 h-[3px] transition-all duration-300 ease-in-out;
        }

        .nav-link:hover {
            /* Teks hover berubah menjadi Oranye Terang */
            color: var(--accent);
        }

        .nav-link:hover::after {
            @apply w-full;
        }

        .nav-active {
            /* Tautan yang sedang aktif - Teks Oranye, Garis Oranye */
            @apply font-semibold;
            color: var(--accent);
        }

        .nav-active::after {
            @apply w-full;
        }
        /* ------------------------------------------------------------- */


        /* Dropdown transition */
        .dropdown-content {
            opacity: 0;
            transform: translateY(-10px);
            visibility: hidden;
            transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
        }

        .group:hover .dropdown-content {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans">
    @php
        // Kode Warna disesuaikan dengan Logo RBM (diambil dari tailwind.config)
        $rbmDark = '#161f36'; // Deep Indigo Navy
        $rbmAccent = '#FF7518'; // Bright Orange
        $whatsappNumber = '6285649011449';
        $whatsappMessage = 'Halo, saya ingin bertanya tentang informasi PT. Rizqallah Boer Makmur';
    @endphp

    {{-- WRAPPER UNTUK MODAL SEARCH --}}
    <div x-data="{ searchModalOpen: false }" @keydown.escape.window="searchModalOpen = false">

        <header x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 shadow-lg">

            {{-- TOP BAR - Warna Putih/Terang (Tema: Putih, Aksen: Oranye) --}}
            <div class="bg-white border-b border-gray-200">
                <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 py-3">

                    {{-- Grup 1: Logo & Nama (Kiri) --}}
                    <div class="flex-shrink-0 flex items-center space-x-4">
                        <img src="{{ asset('assets/img/image.png') }}" alt="Logo RBM" class="h-12 w-12">
                        <div class="flex flex-col">
                            {{-- Teks Logo Hitam. Gunakan font-times sesuai branding --}}
                            <span
                                class="text-gray-900 font-times text-base font-bold whitespace-nowrap">PT. RIZQALLAH BOER MAKMUR</span>
                            <span class="text-xs font-times text-gray-600 italic">Kontraktor & Supplier Terbaik</span>
                        </div>
                    </div>

                    {{-- Grup Kanan (Desktop) --}}
                    <div class="hidden lg:flex items-center space-x-8">

                        {{-- Tombol Pemicu Search --}}
                        <button @click="searchModalOpen = true"
                            class="flex items-center space-x-3 bg-gray-100 rounded-full px-5 py-2 text-sm text-gray-500 hover:bg-gray-200 transition">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <span>Cari Informasi RBM</span>
                        </button>

                        {{-- Tombol Contact Us (Oranye Terang - Warna Aksen) --}}
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank"
                            class="bg-rbm-accent text-white px-6 py-2 rounded-full font-semibold hover:bg-opacity-90 transition-colors whitespace-nowrap text-sm shadow-lg hover:shadow-xl transform hover:scale-[1.02] duration-300">
                            <i class="fab fa-whatsapp mr-1"></i> Hubungi Kami
                        </a>

                    </div>

                    {{-- Tombol Hamburger (Mobile) --}}
                    <div class="lg:hidden">
                        <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-2xl text-gray-700 p-2">
                            <i class="fa-solid fa-bars" x-show="!mobileMenuOpen"></i>
                            <i class="fa-solid fa-times" x-show="mobileMenuOpen" x-cloak></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- MAIN NAV (BIRU TUA NAVY - Desktop) --}}
            <nav style="background-color: {{ $rbmDark }};" class="hidden lg:block">
                <div class="max-w-screen-xl mx-auto flex items-center justify-center gap-x-10 px-4 h-12">

                    {{-- 1. Home --}}
                    <a href="/" class="nav-link {{ Request::is('/') ? 'nav-active' : '' }}">Home</a>

                    {{-- 2. Dropdown: Discover Perusahaan (About, Gallery, Partners, Testimonial) --}}
                    <div class="relative group">
                        <button class="nav-link">Discover Perusahaan <i
                                class="fa-solid fa-chevron-down ml-1.5 text-xs"></i></button>
                        <div
                            class="absolute dropdown-content bg-white shadow-xl border border-gray-100 mt-2 rounded-lg py-2 w-48 z-10">
                            {{-- Dropdown Teks: Hitam, Hover: Oranye Terang --}}
                            <a href="{{ route('about') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">About</a>
                            <a href="{{ route('gallery.index') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Gallery</a>
                            <a href="{{ route('partners') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Partners</a>
                            <a href="{{ route('send.testimonial') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Testimonials</a>
                        </div>
                    </div>

                    {{-- 3. Link: Facilities/Layanan --}}
                    <div class="relative group">
                        <a href="{{ route('facilities') }}" class="nav-link {{ Request::is('facilities') ? 'nav-active' : '' }}">
                            Facilities
                        </a>
                    </div>

                    {{-- 4. Dropdown: Help Center (FAQ, Kontak, Syarat & Ketentuan, Feedback) --}}
                    <div class="relative group">
                        <button class="nav-link">Help Center <i
                                class="fa-solid fa-chevron-down ml-1.5 text-xs"></i></button>
                        <div
                            class="absolute dropdown-content bg-white shadow-xl border border-gray-100 mt-2 rounded-lg py-2 w-48 z-10">
                            {{-- Dropdown Teks: Hitam, Hover: Oranye Terang --}}
                            <a href="{{ route('faq') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">FAQs</a>
                            <a href="https://wa.me/{{ $whatsappNumber }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Kontak</a>
                            <a href="{{ route('syaratketentuan') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Syarat & Ketentuan</a>
                            <a href="https://forms.gle/sveGZa9nd9uX62YE9"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Feedback</a>
                        </div>
                    </div>

                    {{-- 5. Dropdown: Produk Perusahaan (Barang & Jasa) --}}
                    <div class="relative group">
                        <button class="nav-link">Produk Perusahaan <i
                                class="fa-solid fa-chevron-down ml-1.5 text-xs"></i></button>
                        <div
                            class="absolute dropdown-content bg-white shadow-xl border border-gray-100 mt-2 rounded-lg py-2 w-48 z-10">
                            {{-- Dropdown Teks: Hitam, Hover: Oranye Terang --}}
                            <a href="{{ route('products') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Produk Barang</a>
                            <a href="{{ route('services') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 hover:text-rbm-accent transition-colors">Produk Jasa</a>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- MOBILE MENU (Tema: Putih, Aksen: Oranye Terang) --}}
            <div x-show="mobileMenuOpen" x-cloak @click.away="mobileMenuOpen = false"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4"
                class="lg:hidden bg-white w-full absolute shadow-xl">
                <div class="flex flex-col space-y-1 p-4 text-sm max-h-[calc(100vh-80px)] overflow-y-auto">

                    <a href="/"
                        class="block px-4 py-3 text-gray-700 rounded-md hover:bg-gray-100 hover:text-rbm-accent {{ Request::is('/') ? 'bg-gray-100 text-rbm-accent font-semibold' : '' }}">Home</a>

                    {{-- 2. Discover Perusahaan (Mobile) --}}
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 text-gray-700 rounded-md hover:bg-gray-100 hover:text-rbm-accent"><span>Discover
                                Perusahaan</span><i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i></button>
                        <div x-show="open" x-transition class="pl-6 pt-2 pb-1 space-y-1">
                            <a href="{{ route('about') }}"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">About</a>
                            <a href="{{ route('gallery.index') }}"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Gallery</a>
                            <a href="{{ route('partners') }}"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Partners</a>
                            <a href="{{ route('send.testimonial') }}"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Testimonials</a>
                        </div>
                    </div>

                    {{-- 3. Link: Facilities (Mobile) --}}
                    <a href="{{ route('facilities') }}"
                        class="block px-4 py-3 text-gray-700 rounded-md hover:bg-gray-100 hover:text-rbm-accent {{ Request::is('facilities') ? 'bg-gray-100 text-rbm-accent font-semibold' : '' }}">Facilities</a>

                    {{-- 4. Help Center (Mobile) --}}
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 text-gray-700 rounded-md hover:bg-gray-100 hover:text-rbm-accent"><span>Help
                                Center</span><i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i></button>
                        <div x-show="open" x-transition class="pl-6 pt-2 pb-1 space-y-1">
                            <a href="{{ route('faq') }}"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">FAQs</a>
                            <a href="https://wa.me/{{ $whatsappNumber }}"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Kontak</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Syarat & Ketentuan</a>
                            <a href="https://forms.gle/sveGZa9nd9uX62YE9"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Feedback</a>
                        </div>
                    </div>

                    {{-- 5. Produk Perusahaan (Mobile) --}}
                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 text-gray-700 rounded-md hover:bg-gray-100 hover:text-rbm-accent"><span>Produk
                                Perusahaan</span><i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i></button>
                        <div x-show="open" x-transition class="pl-6 pt-2 pb-1 space-y-1">
                            <a href="#"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Produk Barang</a>
                            <a href="#"
                                class="block px-4 py-2 text-gray-600 rounded-md hover:bg-gray-100 hover:text-rbm-accent">Produk Jasa</a>
                        </div>
                    </div>

                    <hr class="my-2">
                    {{-- Tombol Aksi Mobile (Oranye Terang) --}}
                    <a href="https://wa.me/{{ $whatsappNumber }}"
                        class="block text-center bg-rbm-accent text-white font-semibold py-3 px-4 rounded-full hover:bg-opacity-90 transition-colors shadow-md text-sm">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </header>

        {{-- MODAL PENCARIAN --}}
        <div x-show="searchModalOpen" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-start justify-center pt-16 sm:pt-24">

            <div @click.away="searchModalOpen = false" x-show="searchModalOpen"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4">

                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="search" name="query"
                        class="w-full border-0 rounded-xl py-4 pl-12 pr-6 text-black placeholder-gray-400 focus:ring-2 focus:ring-rbm-accent text-lg"
                        placeholder="Ketikkan pencarian Anda..." autocomplete="off" autofocus>
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <button type="button" @click="searchModalOpen = false"
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </form>
            </div>
        </div>
        <main>
            {{-- ================================================================= --}}
            {{-- TOMBOL CEPAT & WIDGET (WHATSAPP, UP BUTTON, & ELFSIGHT AI) ----}}
            {{-- ================================================================= --}}

            <script src="https://elfsightcdn.com/platform.js" async></script>
            <div class="elfsight-app-44ecca3d-2b46-4aa8-b0dc-77f7448f5014" data-elfsight-app-lazy></div>

            {{-- Menggunakan warna Oranye Terang untuk tombol cepat --}}
            <div class="fixed bottom-[90px] lg:bottom-[100px] right-5 z-40 flex flex-col items-end space-y-4 lg:space-y-5">

                {{-- TOMBOL SCROLL TO TOP (UP BUTTON) --}}
                <div x-data="{ shown: false }"
                    x-init="window.addEventListener('scroll', () => { shown = window.scrollY > 300 })" x-show="shown"
                    x-transition>
                    <button @click="window.scrollTo({ top: 0, behavior: 'smooth' })" aria-label="Kembali ke atas"
                        class="w-12 h-12 lg:w-[65px] lg:h-[65px] rounded-full text-white shadow-lg flex items-center justify-center transition-transform hover:scale-110"
                        style="background-color: {{ $rbmAccent }};">
                        <i class="fas fa-arrow-up text-xl lg:text-2xl"></i>
                    </button>
                </div>

                {{-- TOMBOL CEPAT WHATSAPP --}}
                <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}" target="_blank"
                    rel="noopener noreferrer" aria-label="Hubungi via WhatsApp"
                    class="w-12 h-12 lg:w-[65px] lg:h-[65px] rounded-full text-white shadow-lg flex items-center justify-center transition-transform hover:scale-110"
                    style="background-color: {{ $rbmAccent }};">
                    <i class="fab fa-whatsapp text-xl lg:text-2xl"></i>
                </a>

            </div>
            @yield('content')
        </main>

        {{-- FOOTER - Menggunakan warna Biru Tua Navy (Tema: Navy, Teks: Putih/Abu Terang, Aksen: Oranye) --}}
        <footer style="background-color: {{ $rbmDark }};">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

                {{-- Konten Utama Footer (Multi-kolom) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

                    {{-- Kolom 1: Logo, Deskripsi, dan Sosial Media --}}
                    <div class="space-y-6">
                        {{-- Struktur Branding --}}
                        <a href="/" class="flex items-center gap-3">
                            {{-- Logo putih agar kontras --}}
                            <img src="{{ asset('assets/logo/amaliah_white.png') }}" alt="Logo RBM"
                                class="h-10">
                            <div>
                                {{-- Teks Logo Putih --}}
                                <span class="text-white font-semibold text-lg leading-tight">PT. RIZQALLAH BOER MAKMUR</span>
                                <span class="block text-rbm-light-text text-xs">Jakarta, Indonesia</span>
                            </div>
                        </a>

                        {{-- Deskripsi text-rbm-light-text (Abu-abu terang kustom) --}}
                        <p class="text-rbm-light-text text-sm leading-relaxed">
                            Penyedia jasa kontraktor dan supplier terbaik di Indonesia. Kami menjamin kualitas dan ketepatan waktu proyek Anda.
                        </p>

                        {{-- Ikon Sosial Media (Hover background Oranye Terang) --}}
                        <div class="flex items-center space-x-3">
                            {{-- Ikon default gray-400, container hover rbm-accent --}}
                            <a href="#" target="_blank"
                                class="group w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-rbm-accent">
                                <i
                                    class="fab fa-youtube text-gray-400 text-xl group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" target="_blank"
                                class="group w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-rbm-accent">
                                <i
                                    class="fab fa-instagram text-gray-400 text-xl group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" target="_blank"
                                class="group w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-rbm-accent">
                                <i
                                    class="fab fa-facebook-f text-gray-400 text-xl group-hover:text-white transition-colors"></i>
                            </a>
                            <a href="#" target="_blank"
                                class="group w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center transition-all duration-300 hover:bg-rbm-accent">
                                <i
                                    class="fab fa-linkedin text-gray-400 text-xl group-hover:text-white transition-colors"></i>
                            </a>
                        </div>
                    </div>

                    {{-- Kolom 2: Link Navigasi Cepat (Jelajahi) --}}
                    <div>
                        <h4 class="font-semibold text-white tracking-wider uppercase">Jelajahi</h4>
                        <ul class="mt-4 space-y-3 text-sm">
                            {{-- Teks link default: rbm-light-text, Hover: Oranye Terang --}}
                            <li><a href="/"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Beranda</a>
                            </li>
                            <li><a href="{{ route('about') }}"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Tentang
                                    Kami</a></li>
                            <li><a href="{{ route('partners') }}"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Partners</a>
                            </li>
                            <li><a href="#"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Proyek</a>
                            </li>
                        </ul>
                    </div>

                    {{-- Kolom 3: Link Informasi & Bantuan (Layanan Kami) --}}
                    <div>
                        <h4 class="font-semibold text-white tracking-wider uppercase">Layanan Kami</h4>
                        <ul class="mt-4 space-y-3 text-sm">
                            {{-- Teks link default: rbm-light-text, Hover: Oranye Terang --}}
                            <li><a href="#"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Jasa Kontraktor</a></li>
                            <li><a href="#"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Supplier Bahan</a>
                            </li>
                            <li><a href="{{ route('faq') }}"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">FAQs</a>
                            </li>
                            <li><a href="https://wa.me/{{ $whatsappNumber }}"
                                    class="text-rbm-light-text hover:text-rbm-accent hover:translate-x-1 block transition-all duration-300">Hubungi Kami</a></li>
                        </ul>
                    </div>

                    {{-- Kolom 4: Informasi Kontak --}}
                    <div>
                        <h4 class="font-semibold text-white tracking-wider uppercase">Kontak Kantor</h4>
                        <div class="mt-4 flex flex-col gap-4 text-sm">
                            <div class="flex items-start gap-3 text-rbm-light-text">
                                {{-- Ikon menggunakan warna aksen Oranye Terang --}}
                                <i class="fas fa-map-marker-alt w-4 h-4 mt-1 flex-shrink-0 text-rbm-accent"></i>
                                <span>Jl. Sudirman No. 12, Jakarta Selatan, DKI Jakarta 12190</span>
                            </div>
                            <div class="flex items-start gap-3 text-rbm-light-text">
                                {{-- Teks email/telp hover putih --}}
                                <i class="fas fa-envelope w-4 h-4 mt-1 flex-shrink-0 text-rbm-accent"></i>
                                <a href="mailto:info@rbm.co.id"
                                    class="hover:text-white transition">info@rbm.co.id</a>
                            </div>
                            <div class="flex items-start gap-3 text-rbm-light-text">
                                <i class="fas fa-phone-alt w-4 h-4 mt-1 flex-shrink-0 text-rbm-accent"></i>
                                <a href="tel:+6221xxxxxx" class="hover:text-white transition">
                                    (021) xxxxxxx
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Bagian Copyright di Bawah --}}
            <div class="border-t border-gray-800">
                <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center text-center sm:text-left gap-4">
                        <p class="text-sm text-gray-500">
                            &copy; {{ date('Y') }} PT. RIZQALLAH BOER MAKMUR. All Rights Reserved.
                        </p>
                        <div class="flex space-x-6 text-sm text-gray-500">
                            <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                            <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


</body>

</html>
