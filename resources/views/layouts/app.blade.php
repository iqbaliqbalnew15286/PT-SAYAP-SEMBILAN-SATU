<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/am.png') }}">

    <title>@yield('title', 'PT. Sayap Sembilan Satu - Tower Infrastructure')</title>

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
            scroll-behavior: smooth;
        }

        /* Navbar Styling */
        .nav-link {
            @apply relative text-gray-700 px-2 py-2 transition-all duration-300 flex items-center text-[13px] font-bold uppercase tracking-wider;
        }

        .nav-link::after {
            content: '';
            background-color: var(--accent);
            @apply absolute left-1/2 -bottom-1 w-0 h-[3px] transition-all duration-300 ease-in-out -translate-x-1/2 rounded-full;
        }

        .nav-link:hover {
            color: var(--accent);
        }

        .nav-link:hover::after {
            @apply w-full;
        }

        .nav-active {
            color: var(--accent) !important;
        }

        .nav-active::after {
            @apply w-full;
        }

        .dropdown-content {
            opacity: 0;
            transform: translateY(10px);
            visibility: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

<body class="bg-gray-50 font-sans text-gray-900 pt-[116px] lg:pt-[124px]">
    @php
        $rbmDark = '#161f36';
        $rbmAccent = '#FF7518';
        $whatsappNumber = '6285649011449';
        $whatsappMessage = 'Halo PT. Sayap Sembilan Satu, saya ingin bertanya tentang layanan Anda.';
    @endphp

    <div x-data="{ searchModalOpen: false }" @keydown.escape.window="searchModalOpen = false">

        {{-- MODAL SEARCH --}}
        <div x-show="searchModalOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-cloak
            class="fixed inset-0 z-[100] overflow-y-auto">
            <div @click="searchModalOpen = false" class="fixed inset-0 bg-rbm-dark/90 backdrop-blur-md"></div>
            <div class="relative min-h-screen flex items-start justify-center pt-32 px-4">
                <div @click.away="searchModalOpen = false"
                    class="bg-white w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input type="text" name="query"
                            class="w-full text-xl py-6 pl-14 pr-6 focus:ring-0 border-none outline-none font-sans"
                            placeholder="Ketik layanan atau produk..." autofocus>
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-6 top-1/2 -translate-y-1/2 text-gray-400 text-xl"></i>
                    </form>
                </div>
            </div>
        </div>

        {{-- HEADER/NAVBAR --}}
        <header x-data="{ mobileMenuOpen: false }" class="fixed top-0 z-50 w-full shadow-sm">
            {{-- TOP BAR --}}
            <div class="bg-white border-b border-gray-100 relative z-20">
                <div class="max-w-screen-xl mx-auto flex items-center justify-between px-4 sm:px-6 lg:px-8 py-3">
                    <a href="/" class="flex-shrink-0 flex items-center space-x-3 group">
                        <img src="{{ asset('assets/img/image.png') }}" alt="Logo PT Sayap Sembilan Satu"
                            class="h-10 w-auto md:h-12 transition-transform group-hover:scale-105">
                        <div class="flex flex-col border-l border-gray-200 pl-3">
                            <span
                                class="text-rbm-dark font-times text-sm md:text-lg font-bold leading-tight uppercase tracking-tighter">
                                PT SAYAP SEMBILAN SATU
                            </span>
                            <span
                                class="text-[10px] md:text-xs font-sans text-gray-500 font-medium tracking-widest uppercase opacity-80">
                                Tower Infrastructure
                            </span>
                        </div>
                    </a>

                    <div class="hidden lg:flex items-center space-x-5">
                        <button @click="searchModalOpen = true"
                            class="text-gray-500 hover:text-rbm-accent transition-all p-2 bg-gray-50 rounded-full">
                            <i class="fa-solid fa-magnifying-glass text-lg"></i>
                        </button>
                        <a href="https://wa.me/{{ $whatsappNumber }}?text={{ urlencode($whatsappMessage) }}"
                            target="_blank"
                            class="bg-[#FF7518] text-white px-6 py-2.5 rounded-full font-bold hover:bg-orange-600 transition-all text-xs shadow-lg flex items-center gap-2 transform hover:-translate-y-0.5">
                            <i class="fab fa-whatsapp text-sm"></i> WHATSAPP KAMI
                        </a>
                    </div>

                    {{-- Hamburger --}}
                    <div class="lg:hidden flex items-center space-x-2">
                        <button @click="searchModalOpen = true" class="text-gray-600 p-2"><i
                                class="fa-solid fa-magnifying-glass"></i></button>
                        <button @click="mobileMenuOpen = !mobileMenuOpen"
                            class="text-2xl text-rbm-dark p-2 focus:outline-none bg-gray-50 rounded-lg">
                            <i class="fa-solid fa-bars-staggered" x-show="!mobileMenuOpen"></i>
                            <i class="fa-solid fa-xmark" x-show="mobileMenuOpen" x-cloak></i>
                        </button>
                    </div>
                </div>
            </div>

            {{-- MAIN NAV DESKTOP --}}
            <nav class="hidden lg:block bg-white border-b border-gray-100 relative z-10">
                <div class="max-w-screen-xl mx-auto flex items-center justify-center gap-x-8 px-4 h-12">
                    <a href="/" class="nav-link {{ Request::is('/') ? 'nav-active' : '' }}">Home</a>

                    <div class="relative group h-full flex items-center">
                        <button class="nav-link">Perusahaan <i
                                class="fa-solid fa-chevron-down ml-1.5 text-[9px]"></i></button>
                        <div
                            class="absolute top-full dropdown-content bg-white shadow-xl border border-gray-100 rounded-b-xl py-2 w-52 overflow-hidden">
                            <a href="{{ route('about') }}"
                                class="block px-5 py-3 text-sm text-gray-600 hover:bg-orange-50 hover:text-rbm-accent transition-colors">Tentang
                                Kami</a>
                            <a href="{{ route('gallery.index') }}"
                                class="block px-5 py-3 text-sm text-gray-600 hover:bg-orange-50 hover:text-rbm-accent transition-colors">Galeri
                                Proyek</a>
                            <a href="{{ route('partners') }}"
                                class="block px-5 py-3 text-sm text-gray-600 hover:bg-orange-50 hover:text-rbm-accent transition-colors">Mitra
                                Kami</a>
                            <a href="{{ route('send.testimonial') }}"
                                class="block px-5 py-3 text-sm text-gray-600 hover:bg-orange-50 hover:text-rbm-accent transition-colors">Testimonial</a>
                        </div>
                    </div>

                    <a href="{{ route('products') }}"
                        class="nav-link {{ Request::is('products*') ? 'nav-active' : '' }}">Produk</a>
                    <a href="{{ route('facilities') }}"
                        class="nav-link {{ Request::is('facilities*') ? 'nav-active' : '' }}">Fasilitas</a>
                    <a href="{{ route('kontak') }}"
                        class="nav-link {{ Request::is('kontak*') ? 'nav-active' : '' }}">Kontak</a>
                    <a href="https://forms.gle/sveGZa9nd9uX62YE9" target="_blank" class="nav-link">Feedback</a>

                    <div class="relative group h-full flex items-center">
                        <button class="nav-link">Bantuan <i
                                class="fa-solid fa-chevron-down ml-1.5 text-[9px]"></i></button>
                        <div
                            class="absolute top-full dropdown-content bg-white shadow-xl border border-gray-100 rounded-b-xl py-2 w-48 overflow-hidden">
                            <a href="{{ route('faq') }}"
                                class="block px-5 py-3 text-sm text-gray-600 hover:bg-orange-50 hover:text-rbm-accent transition-colors">FAQs</a>
                            <a href="{{ route('syaratketentuan') }}"
                                class="block px-5 py-3 text-sm text-gray-600 hover:bg-orange-50 hover:text-rbm-accent transition-colors">Legalitas</a>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- MOBILE MENU --}}
            <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
                class="lg:hidden bg-white w-full absolute shadow-2xl border-b border-gray-200 z-50">
                <div class="flex flex-col p-5 space-y-1 overflow-y-auto max-h-[80vh]">
                    <a href="/"
                        class="px-4 py-3 rounded-xl text-gray-700 font-bold {{ Request::is('/') ? 'bg-orange-50 text-rbm-accent' : '' }}">HOME</a>

                    <div x-data="{ open: false }">
                        <button @click="open = !open"
                            class="w-full flex justify-between items-center px-4 py-3 text-gray-700 font-bold uppercase">
                            <span>Perusahaan</span>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform"
                                :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-transition class="bg-gray-50 rounded-xl mx-2 my-1 overflow-hidden">
                            <a href="{{ route('about') }}" class="block px-6 py-3 text-sm text-gray-600">Tentang
                                Kami</a>
                            <a href="{{ route('gallery.index') }}"
                                class="block px-6 py-3 text-sm text-gray-600">Galeri Proyek</a>
                            <a href="{{ route('partners') }}" class="block px-6 py-3 text-sm text-gray-600">Mitra
                                Industri</a>
                        </div>
                    </div>

                    <a href="{{ route('products') }}" class="px-4 py-3 text-gray-700 font-bold uppercase">Produk</a>
                    <a href="{{ route('facilities') }}"
                        class="px-4 py-3 text-gray-700 font-bold uppercase">Fasilitas</a>
                    <a href="{{ route('kontak') }}" class="px-4 py-3 text-gray-700 font-bold uppercase">Kontak</a>

                    <a href="https://wa.me/{{ $whatsappNumber }}"
                        class="mt-6 block text-center bg-rbm-accent text-white font-bold py-4 rounded-2xl shadow-lg transform active:scale-95 transition-transform">
                        <i class="fab fa-whatsapp mr-2"></i> HUBUNGI WHATSAPP
                    </a>
                </div>
            </div>
        </header>

        <main class="min-h-screen">
            {{-- FLOATING ACTIONS --}}
            <div class="fixed bottom-6 right-6 z-40 flex flex-col gap-3">
                <button x-data="{ shown: false }" x-init="window.addEventListener('scroll', () => { shown = window.scrollY > 400 })" x-show="shown"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-10"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
                    class="w-12 h-12 bg-white text-rbm-dark shadow-xl rounded-full flex items-center justify-center border border-gray-100 hover:bg-gray-50 transition transform hover:-translate-y-1">
                    <i class="fas fa-arrow-up"></i>
                </button>
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank"
                    class="w-12 h-12 bg-green-500 text-white shadow-xl rounded-full flex items-center justify-center hover:bg-green-600 transition transform hover:scale-110">
                    <i class="fab fa-whatsapp text-2xl"></i>
                </a>
            </div>

            @yield('content')
        </main>

        {{-- FOOTER --}}
        <footer style="background-color: {{ $rbmDark }};" class="text-white pt-20">
            <div class="max-w-screen-xl mx-auto px-6 sm:px-8 lg:px-8 pb-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
                    <div class="space-y-6">
                        <img src="{{ asset('assets/img/image.png') }}" alt="Logo PT Sayap Sembilan Satu"
                            class="h-14 brightness-0 invert opacity-90">
                        <p class="text-rbm-light-text text-sm leading-relaxed">Berdedikasi untuk memberikan layanan
                            konstruksi dan suplai material kualitas tinggi di seluruh wilayah Indonesia.</p>
                        <div class="flex gap-4">
                            @foreach (['facebook-f', 'instagram', 'linkedin-in', 'youtube'] as $icon)
                                <a href="#"
                                    class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-gray-400 hover:text-rbm-accent hover:border-rbm-accent transition-all">
                                    <i class="fab fa-{{ $icon }} text-base"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="lg:pl-8">
                        <h4 class="font-bold text-white text-lg mb-8 relative inline-block">
                            Navigasi
                            <span class="absolute -bottom-2 left-0 w-8 h-1 bg-rbm-accent rounded-full"></span>
                        </h4>
                        <ul class="space-y-4 text-sm text-rbm-light-text font-medium">
                            <li><a href="/"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Beranda</a>
                            </li>
                            <li><a href="{{ route('about') }}"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Tentang
                                    Kami</a></li>
                            <li><a href="{{ route('gallery.index') }}"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Galeri
                                    Proyek</a></li>
                            <li><a href="{{ route('products') }}"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Produk
                                    Kami</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-white text-lg mb-8 relative inline-block">
                            Pusat Bantuan
                            <span class="absolute -bottom-2 left-0 w-8 h-1 bg-rbm-accent rounded-full"></span>
                        </h4>
                        <ul class="space-y-4 text-sm text-rbm-light-text font-medium">
                            <li><a href="{{ route('faq') }}"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Pertanyaan
                                    Umum (FAQ)</a></li>
                            <li><a href="{{ route('kontak') }}"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Hubungi
                                    Kami</a></li>
                            <li><a href="{{ route('syaratketentuan') }}"
                                    class="hover:text-white transition-colors flex items-center gap-2"><i
                                        class="fa-solid fa-chevron-right text-[10px] text-rbm-accent"></i> Syarat &
                                    Ketentuan</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-bold text-white text-lg mb-8 relative inline-block">
                            Kantor Pusat
                            <span class="absolute -bottom-2 left-0 w-8 h-1 bg-rbm-accent rounded-full"></span>
                        </h4>
                        <div class="space-y-5 text-sm text-rbm-light-text">
                            <div class="flex gap-4">
                                <i class="fas fa-map-marker-alt text-rbm-accent text-lg"></i>
                                <span class="leading-relaxed">Jl. Sudirman No. 12, Jakarta Selatan, Indonesia</span>
                            </div>
                            <div class="flex gap-4 items-center">
                                <i class="fas fa-envelope text-rbm-accent text-lg"></i>
                                <a href="mailto:info@sayapsembilansatu.co.id"
                                    class="hover:text-white transition">info@sayapsembilansatu.co.id</a>
                            </div>
                            <div class="flex gap-4 items-center">
                                <i class="fas fa-phone-alt text-rbm-accent text-lg"></i>
                                <span>+62 21 1234 5678</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-white/5 py-8 bg-black/20">
                <div
                    class="max-w-screen-xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4 text-[11px] text-gray-500 font-medium tracking-wider">
                    <p class="uppercase">&copy; {{ date('Y') }} PT. SAYAP SEMBILAN SATU. All rights Reserved.</p>
                    <div class="flex gap-8 uppercase">
                        <a href="#" class="hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="hover:text-white transition-colors">Terms of Service</a>
                        <a href="#" class="hover:text-white transition-colors">Cookies</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
