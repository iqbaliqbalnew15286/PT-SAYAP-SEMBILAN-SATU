@extends('layouts.app')

@section('title', 'Katalog Premium - Tower Management')

@section('content')
    {{-- Load Scripts --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <div class="bg-[#F9FBFF] min-h-screen font-['Poppins'] text-[#1A202C]" x-data="{ activeTab: 'all', search: '' }">

        {{-- 🌌 HERO SECTION: Disesuaikan tingginya agar konten cepat terlihat --}}
        @php
            $heroBg =
                $items->count() > 0
                    ? asset('storage/' . $items->first()->image)
                    : 'https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&q=80';
        @endphp

        <section class="relative h-[40vh] lg:h-[50vh] flex items-center justify-center overflow-hidden">
            <div class="absolute inset-0 z-0">
                <img src="{{ $heroBg }}" class="w-full h-full object-cover scale-105 animate-slow-zoom"
                    alt="Hero Background">
                <div class="absolute inset-0 bg-gradient-to-b from-[#2C3E50]/90 via-[#2C3E50]/70 to-[#F9FBFF]"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 text-center" data-aos="fade-up">
                <span
                    class="inline-block py-1 px-4 rounded-full bg-[#FF8C00] text-white font-bold text-[9px] tracking-[0.3em] uppercase mb-4 shadow-lg shadow-orange-500/20">
                    Official Catalog
                </span>
                <h1 class="text-3xl md:text-6xl font-black text-white mb-2 tracking-tight leading-tight">
                    Our <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-amber-300">Collections</span>
                </h1>
                <p
                    class="text-gray-300 text-xs md:text-sm font-light max-w-md mx-auto italic uppercase tracking-widest opacity-80">
                    Premium Solutions for Industry & Infrastructure
                </p>
            </div>
        </section>

        {{-- 🏷️ STICKY FILTER & SEARCH BAR: UX Inti --}}
        <div class="sticky top-20 z-40 max-w-5xl mx-auto px-4 -mt-8">
            <div
                class="bg-white/90 backdrop-blur-xl p-2 rounded-2xl lg:rounded-3xl shadow-2xl border border-white/50 flex flex-col md:flex-row gap-2">

                {{-- Search Input --}}
                <div class="relative flex-1 group">
                    <span
                        class="absolute inset-y-0 left-4 flex items-center text-gray-400 group-focus-within:text-[#FF8C00] transition-colors">
                        <i class="fas fa-search text-sm"></i>
                    </span>
                    <input type="text" x-model="search" placeholder="Cari barang atau jasa..."
                        class="w-full pl-12 pr-4 py-3 bg-gray-50 border-none rounded-xl lg:rounded-2xl text-sm focus:ring-2 focus:ring-[#FF8C00]/20 transition-all font-medium">
                </div>

                {{-- Tab Buttons --}}
                <div class="flex items-center gap-1 bg-gray-50 p-1 rounded-xl lg:rounded-2xl">
                    <button @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'bg-[#2C3E50] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                        class="flex-1 md:flex-none px-4 lg:px-8 py-2.5 rounded-lg lg:rounded-xl text-[11px] lg:text-xs font-black transition-all duration-300 uppercase tracking-wider">
                        All
                    </button>
                    <button @click="activeTab = 'barang'"
                        :class="activeTab === 'barang' ? 'bg-[#FF8C00] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                        class="flex-1 md:flex-none px-4 lg:px-8 py-2.5 rounded-lg lg:rounded-xl text-[11px] lg:text-xs font-black transition-all duration-300 uppercase tracking-wider">
                        Barang
                    </button>
                    <button @click="activeTab = 'jasa'"
                        :class="activeTab === 'jasa' ? 'bg-[#FF8C00] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                        class="flex-1 md:flex-none px-4 lg:px-8 py-2.5 rounded-lg lg:rounded-xl text-[11px] lg:text-xs font-black transition-all duration-300 uppercase tracking-wider">
                        Jasa
                    </button>
                </div>
            </div>
        </div>

        {{-- 📦 MAIN CONTENT --}}
        <div class="max-w-7xl mx-auto px-6 py-12 space-y-20">

            {{-- SECTION: BARANG --}}
            <section x-show="(activeTab === 'all' || activeTab === 'barang')"
                x-transition:enter="transition ease-out duration-500" class="space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1.5 bg-[#FF8C00] rounded-full"></div>
                        <h2 class="text-xl md:text-2xl font-black text-[#2C3E50] tracking-tight uppercase">Produk Barang
                        </h2>
                    </div>
                    <span
                        class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-white px-3 py-1 rounded-full border border-gray-100">
                        {{ $items->where('type', 'barang')->count() }} Items
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                    @forelse ($items->where('type', 'barang') as $item)
                        <div x-show="search === '' || '{{ strtolower($item->name) }}'.includes(search.toLowerCase())">
                            {{-- Gunakan path include yang benar (sesuai saran sebelumnya) --}}
                            @include('product.partials.card', ['item' => $item])
                        </div>
                    @empty
                        <div
                            class="col-span-full py-10 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100">
                            <p class="text-gray-400 text-sm italic">Belum ada produk barang.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- SECTION: JASA --}}
            <section x-show="(activeTab === 'all' || activeTab === 'jasa')"
                x-transition:enter="transition ease-out duration-500" class="space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1.5 bg-[#2C3E50] rounded-full"></div>
                        <h2 class="text-xl md:text-2xl font-black text-[#2C3E50] tracking-tight uppercase">Layanan Jasa</h2>
                    </div>
                    <span
                        class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-white px-3 py-1 rounded-full border border-gray-100">
                        {{ $items->where('type', 'jasa')->count() }} Items
                    </span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                    @forelse ($items->where('type', 'jasa') as $item)
                        <div x-show="search === '' || '{{ strtolower($item->name) }}'.includes(search.toLowerCase())">
                            @include('product.partials.card', ['item' => $item])
                        </div>
                    @empty
                        <div
                            class="col-span-full py-10 text-center bg-white rounded-3xl border-2 border-dashed border-gray-100">
                            <p class="text-gray-400 text-sm italic">Belum ada layanan jasa.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- Empty Search State --}}
            <div x-show="search !== '' && !document.querySelector('.grid > div:not([style*=\'display: none\'])')"
                class="text-center py-20 bg-white rounded-[3rem] shadow-sm">
                <i class="fas fa-search fa-3x text-gray-100 mb-4"></i>
                <h3 class="text-lg font-bold text-gray-400 italic">Pencarian "<span x-text="search"></span>" tidak ditemukan
                </h3>
            </div>

        </div>

        {{-- 📞 CONTACT CTA: Lebih Ringkas di Mobile --}}
        <section class="py-16 px-6">
            <div
                class="max-w-4xl mx-auto rounded-[2.5rem] bg-[#2C3E50] p-8 md:p-16 text-center text-white relative overflow-hidden shadow-2xl">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#FF8C00] opacity-10 rounded-full blur-3xl"></div>
                <div class="relative z-10">
                    <h2 class="text-2xl md:text-4xl font-black mb-4 tracking-tight leading-tight">Solusi Khusus Untuk Bisnis
                        Anda</h2>
                    <p class="text-gray-400 text-sm md:text-base mb-8 max-w-lg mx-auto leading-relaxed font-light">
                        Diskusikan kebutuhan teknis Anda dengan tim ahli kami untuk mendapatkan penawaran investasi terbaik.
                    </p>
                    <a href="https://wa.me/your-number"
                        class="group inline-flex items-center gap-3 bg-[#FF8C00] px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all hover:scale-105 hover:bg-orange-500 shadow-xl shadow-orange-500/30">
                        <i class="fab fa-whatsapp text-lg"></i> Hubungi Sales
                    </a>
                </div>
            </div>
        </section>
    </div>

    <style>
        @keyframes slow-zoom {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.08);
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-slow-zoom {
            animation: slow-zoom 20s infinite ease-in-out;
        }

        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }

        /* Menyembunyikan scrollbar tapi tetap bisa scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                once: true
            });
        });
    </script>
@endsection
