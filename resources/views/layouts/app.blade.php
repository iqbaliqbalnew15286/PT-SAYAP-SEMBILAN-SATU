<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/am.png') }}">

    <title>@yield('title', 'PT. Rizqallah Boer Makmur')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    {{-- Google Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Times+New+Roman&display=swap"
        rel="stylesheet" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rbm-dark': '#161f36',
                        'rbm-accent': '#FF7518',
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
        :root {
            --accent: #FF7518;
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
        }

        /* Navbar Putih - Link Hitam */
        .nav-link {
            @apply relative text-gray-800 px-3 py-2 transition-colors duration-300 flex items-center text-[14px] font-semibold uppercase tracking-wide;
        }

        .nav-link::after {
            content: '';
            background-color: var(--accent);
            @apply absolute left-1/2 -bottom-0 w-0 h-[3px] transition-all duration-300 ease-in-out -translate-x-1/2;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .nav-link:hover::after {
            @apply w-2/3;
        }

        .nav-active {
            color: var(--accent) !important;
        }

        .nav-active::after {
            @apply w-2/3;
        }

        .dropdown-content {
            opacity: 0;
            transform: translateY(10px);
            visibility: hidden;
            transition: all 0.3s ease;
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

<body class="bg-gray-50 font-sans text-gray-900">
    @php
        $rbmDark = '#161f36';
        $rbmAccent = '#FF7518';
        $whatsappNumber = '6285649011449';
        $whatsappMessage = 'Halo, saya ingin bertanya tentang informasi PT. Rizqallah Boer Makmur';
    @endphp

    <div x-data="{ searchModalOpen: false }" @keydown.escape.window="searchModalOpen = false">



        {{-- MODAL SEARCH --}}
        <div x-show="searchModalOpen" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">
            <div @click="searchModalOpen = false" class="fixed inset-0 bg-rbm-dark/80 backdrop-blur-sm"></div>
            <div class="relative min-h-screen flex items-start justify-center pt-20 px-4">
                <div @click.away="searchModalOpen = false"
                    class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden transform transition-all">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="query"
                            class="w-full text-xl py-6 pl-14 pr-6 focus:ring-0 border-none outline-none"
                            placeholder="Apa yang Anda cari?" autofocus>
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
                    </form>
                </div>
            </div>
        </div>

        {{-- HEADER/NAVBAR --}}
        <header x-data="{ mobileMenuOpen: false }" class="fixed top-0 z-50 w-full">
            {{-- TOP BAR - Tetap Putih --}}
            <div class="bg-white border-b border-gray-100 relative z-20">
                <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 py-3">
                    <div class="flex-shrink-0 flex items-center space-x-3">
                        <img src="{{ asset('assets/img/image.png') }}" alt="Logo PT SAYAP SEMBILAN SATU"
                            class="h-10 w-10 md:h-12 md:w-12">
                        <div class="flex flex-col">
                            <span
                                class="text-gray-900 font-times text-sm md:text-base font-bold whitespace-nowrap uppercase">PT
                                SAYAP SEMBILAN SATU</span>
                            <span class="text-[10px] md:text-xs font-times text-gray-500 italic">Tower
                                Infrastructure</span>
                        </div>
                    </div>

                    {{-- Search & Button Desktop --}}
                    <div class="hidden lg:flex items-center space-x-6">
                        <button @click="searchModalOpen = true"
                            class="text-gray-400 hover:text-rbm-accent transition p-2">
                            <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        </button>
                        <a href="https://wa.me/6285649011449" target="_blank"
                            class="bg-[#FF7518] text-white px-5 py-2 rounded-full font-bold hover:bg-opacity-90 transition-all text-xs shadow-md transform hover:scale-105">
                            WHATSAPP KAMI
                        </a>
                    </div>

                    {{-- Hamburger --}}
                    <div class="lg:hidden flex items-center space-x-4">
                        <button @click="searchModalOpen = true" class="text-gray-500 p-2"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="text-2xl text-gray-700 p-2 focus:outline-none">
                            <i class="fa-solid fa-bars-staggered" x-show="!mobileMenuOpen"></i>
                            <i class="fa-solid fa-xmark" x-show="mobileMenuOpen" x-cloak></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- MAIN NAV (Sekarang Putih dengan Pembatas/Shadow tipis) --}}
            <nav class="hidden lg:block bg-white border-b border-gray-200 shadow-sm relative z-10">
                <div class="max-w-screen-xl mx-auto flex items-center justify-center gap-x-6 px-4 h-14">

                    <a href="/" class="nav-link {{ Request::is('/') ? 'nav-active' : '' }}">Home</a>

                    <div class="relative group">
                        <button class="nav-link">Perusahaan <i
                                class="fa-solid fa-chevron-down ml-1 text-[10px]"></i></button>
                        <div
                            class="absolute dropdown-content bg-white shadow-2xl border border-gray-100 mt-0 rounded-b-xl py-2 w-48 z-50">
                            <a href="{{ route('about') }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-rbm-accent transition-colors">Tentang
                                Kami</a>
                            <a href="{{ route('gallery.index') }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-rbm-accent transition-colors">Galeri
                                Proyek</a>
                            <a href="{{ route('partners') }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-rbm-accent transition-colors">Mitra
                                Kami</a>
                            <a href="{{ route('send.testimonial') }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-rbm-accent transition-colors">Testimonial</a>
                        </div>
                    </div>

                    <a href="{{ route('products') }}"
                        class="nav-link {{ Request::is('products*') ? 'nav-active' : '' }}">Produk</a>
                    <a href="{{ route('facilities') }}"
                        class="nav-link {{ Request::is('facilities*') ? 'nav-active' : '' }}">Fasilitas</a>

                    {{-- Kontak & Feedback di Luar sesuai perintah --}}
                    <a href="{{ route('kontak') }}"
                        class="nav-link {{ Request::is('kontak*') ? 'nav-active' : '' }}">Kontak</a>
                    <a href="https://forms.gle/sveGZa9nd9uX62YE9" target="_blank" class="nav-link">Feedback</a>

                    <div class="relative group">
                        <button class="nav-link">Bantuan <i
                                class="fa-solid fa-chevron-down ml-1 text-[10px]"></i></button>
                        <div
                            class="absolute dropdown-content bg-white shadow-2xl border border-gray-100 mt-0 rounded-b-xl py-2 w-48 z-50">
                            <a href="{{ route('faq') }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-rbm-accent transition-colors">FAQs</a>
                            <a href="{{ route('syaratketentuan') }}"
                                class="block px-5 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-rbm-accent transition-colors">Legalitas</a>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- MOBILE MENU --}}
            <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                class="lg:hidden bg-white w-full absolute shadow-2xl border-b border-gray-200 z-50">
                <div class="flex flex-col p-4 space-y-1 overflow-y-auto max-h-[80vh]">
                    <a href="/"
                        class="px-4 py-3 rounded-lg text-gray-700 font-bold {{ Request::is('/') ? 'bg-gray-50 text-rbm-accent' : '' }}">HOME</a>

                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 text-gray-700 font-bold uppercase">
                            <span>Perusahaan</span>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="bg-gray-50 rounded-lg mx-2 my-1">
                            <a href="{{ route('about') }}" class="block px-6 py-3 text-sm text-gray-600">Tentang
                                Kami</a>
                            <a href="{{ route('gallery.index') }}"
                                class="block px-6 py-3 text-sm text-gray-600">Galeri</a>
                            <a href="{{ route('partners') }}" class="block px-6 py-3 text-sm text-gray-600">Mitra</a>
                        </div>
                    </div>

                    <a href="{{ route('products') }}"
                        class="px-4 py-3 rounded-lg text-gray-700 font-bold uppercase">Produk</a>
                    <a href="{{ route('facilities') }}"
                        class="px-4 py-3 rounded-lg text-gray-700 font-bold uppercase">Fasilitas</a>

                    {{-- Mobile Kontak & Feedback --}}
                    <a href="{{ route('contact') }}"
                        class="px-4 py-3 rounded-lg text-gray-700 font-bold uppercase">Kontak</a>
                    <a href="https://forms.gle/sveGZa9nd9uX62YE9"
                        class="px-4 py-3 rounded-lg text-gray-700 font-bold uppercase">Feedback</a>

                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 text-gray-700 font-bold uppercase">
                            <span>Bantuan</span>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="bg-gray-50 rounded-lg mx-2 my-1">
                            <a href="{{ route('faq') }}" class="block px-6 py-3 text-sm text-gray-600">FAQs</a>
                            <a href="{{ route('syaratketentuan') }}"
                                class="block px-6 py-3 text-sm text-gray-600">Syarat
                                & Ketentuan</a>
                        </div>
                    </div>

                    <a href="https://wa.me/6285649011449"
                        class="mt-4 block text-center bg-rbm-accent text-white font-bold py-4 rounded-xl shadow-lg">HUBUNGI
                        WHATSAPP</a>
                </div>
            </div>
        </header>

        <main class="min-h-screen">
            {{-- FLOATING ACTIONS --}}
            <div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
                <button x-data="{ shown: false }" x-init="window.addEventListener('scroll', () => { shown = window.scrollY > 400 })" x-show="shown" x-transition
                    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    class="w-12 h-12 bg-white text-rbm-dark shadow-2xl rounded-full flex items-center justify-center border border-gray-100 hover:bg-gray-50 transition transform hover:-translate-y-1">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank"
                    class="w-12 h-12 bg-green-500 text-white shadow-2xl rounded-full flex items-center justify-center hover:bg-green-600 transition transform hover:scale-110">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </a>
            </div>

            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer style="background-color: {{ $rbmDark }};" class="text-white pt-16">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                    <div class="space-y-6">
                        <img src="{{ asset('assets/img/image.png') }}" alt="Logo RBM"
                            class="h-14 brightness-0 invert opacity-90">
                        <p class="text-rbm-light-text text-sm leading-relaxed">Berdedikasi untuk memberikan layanan
                            konstruksi dan suplai material kualitas tinggi di seluruh wilayah Indonesia.</p>
                        <div class="flex gap-4">
                            @foreach (['facebook-f', 'instagram', 'linkedin-in', 'youtube'] as $icon)
                                <a href="#" class="text-gray-400 hover:text-rbm-accent transition"><i
                                        class="fab fa-{{ $icon }} text-lg"></i></a>
                            @endforeach
                        </div>
                    </div>

                    <div>
                        <h4 class="font-bold text-lg mb-6">Navigasi</h4>
                        <ul class="space-y-4 text-sm text-rbm-light-text">
                            <li><a href="/" class="hover:text-white transition">Beranda</a></li>
                            <li><a href="{{ route('about') }}" class="hover:text-white transition">Tentang Kami</a>
                            </li>
                            <li><a href="{{ route('gallery.index') }}" class="hover:text-white transition">Galeri
                                    Proyek</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-lg mb-6">Pusat Bantuan</h4>
                        <ul class="space-y-4 text-sm text-rbm-light-text">
                            <li><a href="{{ route('faq') }}" class="hover:text-white transition">Pertanyaan Umum
                                    (FAQ)</a></li>
                            <li><a href="{{ route('kontak') }}" class="hover:text-white transition">Hubungi Kami</a>
                            </li>
                            <li><a href="{{ route('syaratketentuan') }}"
                                    class="hover:text-white transition">Kebijakan
                                    Privasi</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-lg mb-6">Kontak Kami</h4>
                        <div class="space-y-4 text-sm text-rbm-light-text">
                            <div class="flex gap-3">
                                <i class="fas fa-map-marker-alt text-rbm-accent mt-1"></i>
                                <span>Jl. Sudirman No. 12, Jakarta Selatan, Indonesia</span>
                            </div>
                            <div class="flex gap-3">
                                <i class="fas fa-envelope text-rbm-accent"></i>
                                <a href="mailto:info@rbm.co.id" class="hover:text-white transition">info@rbm.co.id</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="border-t border-white/5 py-8">
                <div
                    class="max-w-screen-xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
                    <p>&copy; {{ date('Y') }} PT. RIZQALLAH BOER MAKMUR. All rights Reserved.</p>
                    <div class="flex gap-6">
                        <a href="#" class="hover:text-white">Terms</a>
                        <a href="#" class="hover:text-white">Privacy</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
