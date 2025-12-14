<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/am.png') }}">
    <title>@yield('title', 'Perusahaan')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .nav-link {
            @apply text-white px-4 py-2 flex items-center gap-1 text-sm font-medium transition;
        }

        .nav-link:hover {
            color: #F97316;
        }

        .dropdown {
            @apply absolute mt-2 bg-white rounded-lg shadow-lg w-52 opacity-0 invisible transition-all;
        }

        .group:hover .dropdown {
            opacity: 1;
            visibility: visible;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50">

    <!-- ================= HEADER ================= -->
    <header x-data="{ mobile:false }" class="sticky top-0 z-50">

        <!-- TOP -->
        <div class="bg-[#020617]">
            <div class="max-w-screen-xl mx-auto px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/logo/amaliah.png') }}" class="h-10">
                    <span class="text-white font-semibold text-lg">Perusahaan</span>
                </div>

                <!-- Desktop Menu -->
                <nav class="hidden lg:flex items-center gap-8">

                    <a href="/" class="nav-link">Home</a>

                    <!-- Discover -->
                    <div class="relative group">
                        <button class="nav-link">
                            Discover Perusahaan <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="dropdown">
                            <a href="{{ route('about') }}" class="block px-4 py-3 hover:bg-gray-100">About</a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100">Gallery</a>
                            <a href="{{ route('partners') }}" class="block px-4 py-3 hover:bg-gray-100">Partners</a>
                            <a href="{{ route('send.testimonial') }}" class="block px-4 py-3 hover:bg-gray-100">Testimonial</a>
                        </div>
                    </div>

                    <a href="{{ route('facilities') }}" class="nav-link">Facilities</a>

                    <!-- Produk -->
                    <div class="relative group">
                        <button class="nav-link">
                            Produk Perusahaan <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="dropdown">
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100">Produk Barang</a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100">Produk Jasa</a>
                        </div>
                    </div>

                    <!-- Help -->
                    <div class="relative group">
                        <button class="nav-link">
                            Help Center <i class="fa-solid fa-chevron-down text-xs"></i>
                        </button>
                        <div class="dropdown">
                            <a href="{{ route('faq') }}" class="block px-4 py-3 hover:bg-gray-100">FAQ</a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100">Kontak</a>
                            <a href="#" class="block px-4 py-3 hover:bg-gray-100">Syarat & Ketentuan</a>
                            <a href="https://forms.gle/sveGZa9nd9uX62YE9" class="block px-4 py-3 hover:bg-gray-100">Feedback</a>
                        </div>
                    </div>

                </nav>

                <!-- Mobile Button -->
                <button @click="mobile = !mobile" class="lg:hidden text-white text-2xl">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- MOBILE MENU -->
        <div x-show="mobile" x-cloak class="bg-white shadow-lg lg:hidden">
            <div class="flex flex-col p-4 text-sm space-y-1">
                <a href="/" class="px-4 py-3 hover:bg-gray-100 rounded">Home</a>

                <details class="px-4 py-2">
                    <summary class="cursor-pointer">Discover Perusahaan</summary>
                    <div class="ml-4 mt-2 space-y-1">
                        <a href="{{ route('about') }}" class="block py-2">About</a>
                        <a href="#" class="block py-2">Gallery</a>
                        <a href="{{ route('partners') }}" class="block py-2">Partners</a>
                        <a href="{{ route('send.testimonial') }}" class="block py-2">Testimonial</a>
                    </div>
                </details>

                <a href="{{ route('facilities') }}" class="px-4 py-3 hover:bg-gray-100 rounded">Facilities</a>

                <details class="px-4 py-2">
                    <summary class="cursor-pointer">Produk Perusahaan</summary>
                    <div class="ml-4 mt-2">
                        <a href="#" class="block py-2">Produk Barang</a>
                        <a href="#" class="block py-2">Produk Jasa</a>
                    </div>
                </details>

                <details class="px-4 py-2">
                    <summary class="cursor-pointer">Help Center</summary>
                    <div class="ml-4 mt-2">
                        <a href="{{ route('faq') }}" class="block py-2">FAQ</a>
                        <a href="#" class="block py-2">Kontak</a>
                        <a href="#" class="block py-2">Syarat & Ketentuan</a>
                        <a href="#" class="block py-2">Feedback</a>
                    </div>
                </details>
            </div>
        </div>

    </header>

    <!-- ================= CONTENT ================= -->
    <main>
        @yield('content')
    </main>

    <!-- ================= FOOTER ================= -->
    <footer class="bg-[#0F172A] text-gray-400 mt-20">
        <div class="max-w-screen-xl mx-auto px-6 py-12 text-center text-sm">
            © {{ date('Y') }} Perusahaan. All rights reserved.
        </div>
    </footer>

</body>

</html>
