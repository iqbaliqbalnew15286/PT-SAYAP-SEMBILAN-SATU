@extends('layouts.app')

@section('title', 'Katalog Layanan & Infrastruktur')

@section('content')
    {{-- Resource & Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @php
        /**
         * Helper untuk menangani path gambar dari database
         * Mendukung spasi di folder dan pengecekan seeder/storage
         */
        $getImg = function($path) {
            if (!$path) return 'https://images.unsplash.com/photo-1544380904-c686119ec4f5?q=80&w=2000';

            // Jika path mengandung 'assets/', itu dari public folder (seeder)
            if (str_contains($path, 'assets/')) {
                return asset($path);
            }
            // Jika dari upload user
            return asset('storage/' . $path);
        };

        // 1. Ambil semua URL foto dari koleksi $items
        $photos = $items->map(fn($item) => $getImg($item->image))->toArray();

        // 2. Tentukan foto untuk Banner Hero
        // Mengambil foto produk ke-1 dan ke-2. Jika tidak ada, pakai fallback Unsplash
        $heroImage1 = $photos[0] ?? 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?q=80&w=2000';
        $heroImage2 = $photos[1] ?? 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=2000';

        // 3. Foto untuk section Grid Visual (Foto ke 3, 4, 5)
        $gridPhoto1 = $photos[2] ?? $heroImage1;
        $gridPhoto2 = $photos[3] ?? $heroImage2;
        $gridPhoto3 = $photos[4] ?? $heroImage1;
    @endphp

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfc; }
        .heading-tight { letter-spacing: -0.04em; }
        .bg-navy { background-color: #161f36; }
        .text-orange-main { color: #FF7518; }
        .bg-orange-main { background-color: #FF7518; }
        @keyframes slow-zoom { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.08); } }
        .animate-slow-zoom { animation: slow-zoom 20s infinite ease-in-out; }
        [x-cloak] { display: none !important; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>

    {{-- 🌌 1. HERO SLIDER (BANNER AMBIL DATA) --}}
    <section class="relative w-full h-[500px] overflow-hidden bg-navy">
        <div x-data="{ activeSlide: 1, totalSlides: 2 }"
             x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 6000)"
             class="h-full">

            <div x-show="activeSlide === 1" x-transition.opacity.duration.1000ms class="absolute inset-0">
                <img src="{{ $heroImage1 }}" class="w-full h-full object-cover animate-slow-zoom opacity-60">
                <div class="absolute inset-0 bg-gradient-to-r from-navy/80 via-transparent to-transparent flex items-center">
                    <div class="max-w-7xl mx-auto px-6 w-full">
                        <h2 class="text-white text-5xl md:text-7xl font-extrabold uppercase leading-none max-w-2xl">
                            Tower <br><span class="text-orange-main">Construction</span>
                        </h2>
                        <p class="text-gray-300 mt-6 max-w-lg text-lg font-medium">Infrastruktur telekomunikasi mutakhir dengan standar keamanan internasional.</p>
                    </div>
                </div>
            </div>

            <div x-show="activeSlide === 2" x-transition.opacity.duration.1000ms class="absolute inset-0" x-cloak>
                <img src="{{ $heroImage2 }}" class="w-full h-full object-cover animate-slow-zoom opacity-60">
                <div class="absolute inset-0 bg-gradient-to-r from-navy/80 via-transparent to-transparent flex items-center">
                    <div class="max-w-7xl mx-auto px-6 w-full">
                        <h2 class="text-white text-5xl md:text-7xl font-extrabold uppercase leading-none max-w-2xl">
                            Expert <br><span class="text-orange-main">Maintenance</span>
                        </h2>
                        <p class="text-gray-300 mt-6 max-w-lg text-lg font-medium">Layanan pemeliharaan berkala untuk menjamin stabilitas jaringan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 🍞 2. BREADCRUMB --}}
    <div class="bg-[#1a1a1a] py-4">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="flex text-[10px] font-bold uppercase tracking-[0.2em] text-gray-500 items-center">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right mx-4 text-[8px] text-orange-main"></i>
                <span class="text-white">Our Collections</span>
            </nav>
        </div>
    </div>

    {{-- 🏗️ 3. DYNAMIC GRID SECTION --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div class="flex items-end justify-center lg:justify-start gap-4">
                    <div class="h-56 w-32 rounded-3xl overflow-hidden shadow-xl bg-gray-100">
                        <img src="{{ $gridPhoto1 }}" class="h-full w-full object-cover">
                    </div>
                    <div class="h-96 w-48 rounded-3xl overflow-hidden shadow-2xl border-[6px] border-white -mb-12 bg-gray-100">
                        <img src="{{ $gridPhoto2 }}" class="h-full w-full object-cover">
                    </div>
                    <div class="h-72 w-36 rounded-3xl overflow-hidden shadow-xl bg-gray-100">
                        <img src="{{ $gridPhoto3 }}" class="h-full w-full object-cover">
                    </div>
                </div>
                <div class="text-center lg:text-left">
                    <div class="w-20 h-2 bg-orange-main mb-8 mx-auto lg:mx-0"></div>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-[#161f36] heading-tight uppercase mb-6">
                        Infrastruktur <br> Tanpa Batas</h2>
                    <p class="text-gray-500 leading-relaxed mb-8 font-medium text-lg">Kami memadukan material standar internasional dengan teknisi bersertifikat ahli untuk hasil pengerjaan yang presisi.</p>
                    <div class="space-y-4 inline-block text-left">
                        <div class="flex items-center gap-4 font-bold text-[#161f36]">
                            <span class="w-10 h-10 rounded-full bg-orange-main/10 flex items-center justify-center text-orange-main">
                                <i class="fas fa-check"></i>
                            </span>
                            Material Standar Internasional
                        </div>
                        <div class="flex items-center gap-4 font-bold text-[#161f36]">
                            <span class="w-10 h-10 rounded-full bg-orange-main/10 flex items-center justify-center text-orange-main">
                                <i class="fas fa-check"></i>
                            </span>
                            Teknisi Bersertifikat Ahli
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 🏷️ 4. CATALOG SECTION --}}
    <section class="py-24 bg-[#fcfcfc]" x-data="{ activeTab: 'all' }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div>
                    <h2 class="text-4xl font-extrabold text-[#161f36] uppercase tracking-tighter">Katalog Unggulan</h2>
                    <p class="text-gray-400 mt-2 font-medium italic">Solusi Tower & Infrastruktur Telekomunikasi</p>
                </div>
                <div class="flex gap-2 bg-gray-200 p-1.5 rounded-full no-scrollbar overflow-x-auto">
                    <button @click="activeTab = 'all'" :class="activeTab === 'all' ? 'bg-orange-main text-white shadow-md' : 'text-gray-500 hover:text-navy'" class="px-8 py-2.5 rounded-full text-[11px] font-black uppercase transition-all tracking-widest whitespace-nowrap">Semua</button>
                    <button @click="activeTab = 'barang'" :class="activeTab === 'barang' ? 'bg-orange-main text-white shadow-md' : 'text-gray-500 hover:text-navy'" class="px-8 py-2.5 rounded-full text-[11px] font-black uppercase transition-all tracking-widest whitespace-nowrap">Barang</button>
                    <button @click="activeTab = 'jasa'" :class="activeTab === 'jasa' ? 'bg-orange-main text-white shadow-md' : 'text-gray-500 hover:text-navy'" class="px-8 py-2.5 rounded-full text-[11px] font-black uppercase transition-all tracking-widest whitespace-nowrap">Jasa</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @foreach ($items as $item)
                    <div x-show="activeTab === 'all' || activeTab === '{{ strtolower($item->type) }}'"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="group bg-white rounded-[3rem] overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.03)] hover:shadow-[0_30px_70px_rgba(255,117,24,0.12)] transition-all duration-500 border border-gray-50">

                        <div class="relative h-80 overflow-hidden bg-gray-100">
                            <img src="{{ $getImg($item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-5 py-2 rounded-2xl text-[10px] font-black uppercase text-navy shadow-sm tracking-[0.1em]">
                                {{ $item->type }}
                            </div>
                        </div>

                        <div class="p-10">
                            <h3 class="text-2xl font-extrabold text-navy mb-4 group-hover:text-orange-main transition-colors duration-300">{{ $item->name }}</h3>
                            <p class="text-gray-400 text-sm leading-relaxed line-clamp-2 mb-10 font-medium italic">{{ $item->description }}</p>
                            <div class="flex justify-between items-center pt-8 border-t border-gray-100">
                                <span class="text-navy font-black text-lg tracking-tight">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $item->id) }}" class="w-12 h-12 bg-gray-50 rounded-2xl flex items-center justify-center text-orange-main hover:bg-orange-main hover:text-white transition-all duration-300">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 📞 5. CTA FINAL --}}
    <section class="pb-24 px-6">
        <div class="max-w-7xl mx-auto bg-navy rounded-[4rem] p-16 md:p-24 text-center relative overflow-hidden shadow-2xl">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-main opacity-20 rounded-full blur-[120px]"></div>
            <div class="relative z-10">
                <h2 class="text-4xl md:text-7xl font-extrabold text-white mb-8 uppercase heading-tight">Elevating <br> <span class="text-orange-main">Connectivity</span></h2>
                <p class="text-gray-400 mb-14 max-w-xl mx-auto font-medium leading-relaxed opacity-80 text-lg">Bermitra dengan kami untuk solusi infrastruktur telekomunikasi yang handal dan berkelanjutan.</p>
                <a href="{{ route('booking.index') }}" class="bg-orange-main text-white px-16 py-6 rounded-[2.5rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-white hover:text-navy transition-all duration-300 shadow-xl shadow-orange-600/20 active:scale-95">Book Project Now</a>
            </div>
        </div>
    </section>
@endsection
