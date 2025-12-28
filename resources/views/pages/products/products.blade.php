@extends('layouts.app')

@section('title', 'Katalog Layanan & Infrastruktur')

@section('content')
    {{-- Resource & Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @php
        // Mengambil foto dari data $items untuk Hero dan Grid
        $heroImage1 = $items->skip(0)->first()
            ? asset('storage/' . $items->skip(0)->first()->image)
            : 'https://images.unsplash.com/photo-1544380904-c686119ec4f5?q=80&w=2000';
        $heroImage2 = $items->skip(1)->first()
            ? asset('storage/' . $items->skip(1)->first()->image)
            : 'https://images.unsplash.com/photo-1581092160562-40aa08e78837?q=80&w=2000';

        $gridPhoto1 = $items->skip(2)->first() ? asset('storage/' . $items->skip(2)->first()->image) : $heroImage1;
        $gridPhoto2 = $items->skip(3)->first() ? asset('storage/' . $items->skip(3)->first()->image) : $heroImage2;
        $gridPhoto3 = $items->skip(4)->first() ? asset('storage/' . $items->skip(4)->first()->image) : $heroImage1;
    @endphp

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fcfcfc;
        }

        .heading-tight {
            letter-spacing: -0.04em;
        }

        .bg-navy {
            background-color: #161f36;
        }

        .text-orange-main {
            color: #FF7518;
        }

        .bg-orange-main {
            background-color: #FF7518;
        }

        @keyframes slow-zoom {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        .animate-slow-zoom {
            animation: slow-zoom 20s infinite ease-in-out;
        }
    </style>

    {{-- 🌌 1. HERO SLIDER (Dinamis dari Data Produk) --}}
    <section class="relative w-full h-[450px] overflow-hidden">
        <div x-data="{ activeSlide: 1, totalSlides: 2 }" x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)" class="h-full">

            <div x-show="activeSlide === 1" x-transition.opacity.duration.1000ms class="absolute inset-0">
                <img src="{{ $heroImage1 }}" class="w-full h-full object-cover animate-slow-zoom">
                <div class="absolute inset-0 bg-[#161f36]/50 flex items-center justify-center">
                    <h2 class="text-white text-4xl md:text-6xl font-extrabold uppercase heading-tight text-center">
                        Tower <span class="text-orange-main">Construction</span>
                    </h2>
                </div>
            </div>

            <div x-show="activeSlide === 2" x-transition.opacity.duration.1000ms class="absolute inset-0">
                <img src="{{ $heroImage2 }}" class="w-full h-full object-cover animate-slow-zoom">
                <div class="absolute inset-0 bg-[#161f36]/50 flex items-center justify-center">
                    <h2 class="text-white text-4xl md:text-6xl font-extrabold uppercase heading-tight text-center">
                        Expert <span class="text-orange-main">Maintenance</span>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    {{-- 🍞 2. BREADCRUMB DARK --}}
    <div class="bg-[#2D2D2D] py-4">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="flex text-sm font-bold uppercase tracking-widest text-gray-400 items-center">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <i class="fas fa-chevron-right mx-3 text-[10px] text-white"></i>
                <span class="text-white">Our Collections</span>
            </nav>
        </div>
    </div>

    {{-- 🏗️ 3. DYNAMIC GRID SECTION (Foto Berbeda dari Data Produk) --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="flex items-end justify-center lg:justify-start gap-4">
                    <div class="h-48 w-28 rounded-2xl overflow-hidden shadow-xl bg-gray-100">
                        <img src="{{ $gridPhoto1 }}" class="h-full w-full object-cover">
                    </div>
                    <div class="h-80 w-40 rounded-2xl overflow-hidden shadow-2xl border-4 border-white -mb-10 bg-gray-100">
                        <img src="{{ $gridPhoto2 }}" class="h-full w-full object-cover">
                    </div>
                    <div class="h-64 w-32 rounded-2xl overflow-hidden shadow-xl bg-gray-100">
                        <img src="{{ $gridPhoto3 }}" class="h-full w-full object-cover">
                    </div>
                </div>

                <div class="text-center lg:text-left">
                    <div class="w-20 h-1.5 bg-orange-main mb-6 mx-auto lg:mx-0"></div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-[#161f36] heading-tight uppercase mb-6">
                        Infrastruktur <br> Tanpa Batas</h2>
                    <p class="text-gray-500 leading-relaxed mb-8 font-medium">Kami menyediakan perangkat keras dan jasa
                        teknis profesional untuk memastikan jaringan telekomunikasi Anda tetap stabil dan berkembang
                        mengikuti zaman.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center gap-3 font-bold text-[#161f36] justify-center lg:justify-start">
                            <i class="fas fa-check-circle text-orange-main text-xl"></i> Material Standar Internasional
                        </li>
                        <li class="flex items-center gap-3 font-bold text-[#161f36] justify-center lg:justify-start">
                            <i class="fas fa-check-circle text-orange-main text-xl"></i> Teknisi Bersertifikat Ahli
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- 🏷️ 4. CATALOG SECTION --}}
    <section class="py-20 bg-[#fcfcfc]" x-data="{ activeTab: 'all' }">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-8">
                <div>
                    <h2 class="text-3xl font-extrabold text-[#161f36] uppercase tracking-tighter">Katalog Unggulan</h2>
                    <p class="text-gray-400 mt-2 font-medium italic">Solusi Tower & Infrastruktur Telekomunikasi</p>
                </div>
                <div class="flex gap-2 bg-gray-100 p-1.5 rounded-full">
                    <button @click="activeTab = 'all'"
                        :class="activeTab === 'all' ? 'bg-orange-main text-white shadow-md' :
                            'text-gray-500 hover:text-navy'"
                        class="px-8 py-2.5 rounded-full text-[11px] font-black uppercase transition-all tracking-widest">Semua</button>
                    <button @click="activeTab = 'barang'"
                        :class="activeTab === 'barang' ? 'bg-orange-main text-white shadow-md' :
                            'text-gray-500 hover:text-navy'"
                        class="px-8 py-2.5 rounded-full text-[11px] font-black uppercase transition-all tracking-widest">Barang</button>
                    <button @click="activeTab = 'jasa'"
                        :class="activeTab === 'jasa' ? 'bg-orange-main text-white shadow-md' :
                            'text-gray-500 hover:text-navy'"
                        class="px-8 py-2.5 rounded-full text-[11px] font-black uppercase transition-all tracking-widest">Jasa</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 lg:gap-14">
                @foreach ($items as $item)
                    <div x-show="activeTab === 'all' || activeTab === '{{ $item->type }}'"
                        x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="group bg-white rounded-[2.5rem] overflow-hidden shadow-[0_15px_40px_rgba(0,0,0,0.03)] hover:shadow-[0_25px_60px_rgba(255,117,24,0.1)] transition-all duration-500 border border-gray-50">

                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ asset('storage/' . $item->image) }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div
                                class="absolute top-6 left-6 bg-white/95 backdrop-blur-sm px-4 py-1.5 rounded-xl text-[9px] font-black uppercase text-navy shadow-sm tracking-[0.1em]">
                                {{ $item->type }}
                            </div>
                        </div>

                        <div class="p-8">
                            <h3
                                class="text-xl font-extrabold text-navy mb-3 group-hover:text-orange-main transition-colors duration-300">
                                {{ $item->name }}</h3>
                            <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 mb-8 font-medium italic">
                                {{ $item->description ?? 'Solusi konstruksi telekomunikasi terintegrasi dengan kualitas material premium.' }}
                            </p>
                            <div class="flex justify-between items-center pt-6 border-t border-gray-100">
                                <span class="text-navy font-black text-sm tracking-tight">Rp
                                    {{ number_format($item->price, 0, ',', '.') }}</span>
                                <a href="{{ route('product.show', $item->id) }}"
                                    class="text-orange-main font-black text-[10px] uppercase tracking-[0.15em] flex items-center gap-2 hover:gap-3 transition-all">
                                    Details <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- 📞 6. CTA FINAL --}}
    <section class="pb-24 px-6">
        <div
            class="max-w-7xl mx-auto bg-navy rounded-[4rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl shadow-navy/30">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-orange-main opacity-20 rounded-full blur-[120px]"></div>
            <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-orange-main opacity-10 rounded-full blur-[100px]"></div>

            <div class="relative z-10">
                <h2 class="text-3xl md:text-6xl font-extrabold text-white mb-8 uppercase heading-tight">Elevating <br> <span
                        class="text-orange-main">Connectivity</span></h2>
                <p class="text-gray-400 mb-14 max-w-xl mx-auto font-medium leading-relaxed opacity-80">Rencanakan kebutuhan
                    infrastruktur telekomunikasi Anda bersama mitra konstruksi terpercaya.</p>
                <a href="{{ route('booking.index') }}"
                    class="bg-orange-main text-white px-16 py-5 rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] hover:bg-white hover:text-navy transition-all duration-300 shadow-xl shadow-orange-600/20 active:scale-95">Book
                    Project Now</a>
            </div>
        </div>
    </section>
@endsection
