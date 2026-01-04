@extends('layouts.app')

@section('content')
    @php
        $hasImages = isset($mainImages) && $mainImages->isNotEmpty();
        $darkBlue = '#2C3E50';
        $accentOrange = '#FF7518';
    @endphp

    <style>
        .text-tower-dark {
            color: {{ $darkBlue }};
        }

        .bg-tower-dark {
            background-color: {{ $darkBlue }};
        }

        .text-tower-accent {
            color: {{ $accentOrange }};
        }

        .bg-tower-accent {
            background-color: {{ $accentOrange }};
        }

        /* Animasi Floating untuk Ikon */
        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .float-icon {
            animation: float 3s ease-in-out infinite;
        }

        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .mission-card:hover .icon-box {
            background-color: {{ $accentOrange }};
            color: white;
            transform: scale(1.1) rotate(5deg);
        }
    </style>

    <div class="antialiased font-sans">
        {{-- Hero Section --}}
        <section class="relative h-[450px] flex items-center overflow-hidden">
            @if ($hasImages)
                <div x-data="{ activeSlide: 1, totalSlides: {{ $mainImages->count() }} }" x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)" class="absolute inset-0 z-0">
                    @foreach ($mainImages as $image)
                        <div x-show="activeSlide === {{ $loop->iteration }}" x-transition:enter="transition duration-1000"
                            x-transition:enter-start="opacity-0 scale-105" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition duration-1000" class="absolute inset-0">
                            <img src="{{ Storage::url($image->path) }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @else
                <div
                    class="absolute inset-0 bg-tower-dark bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20">
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-tower-dark via-slate-800 to-black"></div>
            @endif

            <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/40 to-transparent"></div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-2xl">
                    <span
                        class="inline-block py-1 px-3 rounded-md bg-tower-accent text-white text-xs font-bold tracking-[0.2em] uppercase mb-4">
                        Company Profile
                    </span>
                    <h1 class="text-5xl md:text-7xl font-black text-white leading-none uppercase tracking-tighter">
                        Vision & <span class="text-tower-accent">Mission</span>
                    </h1>
                    <div class="mt-6 flex items-center gap-4">
                        <div class="h-1 w-24 bg-tower-accent"></div>
                        <p class="text-gray-300 font-medium tracking-wide">Integritas dalam Infrastruktur</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Breadcrumb --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <nav class="flex text-xs font-bold uppercase tracking-widest text-gray-400">
                    <a href="/" class="hover:text-tower-accent transition-colors">Home</a>
                    <span class="mx-3 text-gray-300">/</span>
                    <a href="{{ route('about') }}" class="hover:text-tower-accent transition-colors">About</a>
                    <span class="mx-3 text-tower-accent">/</span>
                    <span class="text-tower-dark">Vision & Mission</span>
                </nav>
            </div>
        </div>

        {{-- Visi Section --}}
        <section class="relative py-24 bg-slate-50 overflow-hidden">
            <div class="absolute top-0 right-0 w-1/3 h-full bg-white skew-x-12 translate-x-1/2 z-0"></div>

            <div class="container mx-auto max-w-6xl px-6 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                    <div class="lg:col-span-5">
                        <span class="text-tower-accent font-bold uppercase tracking-widest text-sm italic">Focus &
                            Goal</span>
                        <h2 class="mt-2 text-4xl font-black text-tower-dark leading-tight">VISI<br>PERUSAHAAN</h2>
                        <div class="mt-6 p-1 bg-tower-accent w-12"></div>
                    </div>
                    <div
                        class="lg:col-span-7 bg-white p-10 md:p-16 rounded-[40px] shadow-2xl shadow-slate-200 border border-slate-100 relative">
                        <p class="relative text-2xl md:text-3xl italic leading-relaxed text-gray-700 font-medium">
                            "Menjadi mitra terpercaya dan pemimpin inovatif dalam industri infrastruktur telekomunikasi
                            nasional melalui keunggulan teknis dan integritas layanan."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Misi Section --}}
        <section class="py-24 bg-white">
            <div class="container mx-auto max-w-7xl px-6">
                <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                    <div class="max-w-xl">
                        <h2 class="text-4xl font-black text-tower-dark uppercase tracking-tight">Misi Kami</h2>
                        <p class="mt-4 text-gray-500 text-lg italic border-l-4 border-tower-accent pl-4">
                            Langkah strategis kami dalam mewujudkan visi besar perusahaan.
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <div class="flex gap-2">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="w-2 h-2 rounded-full bg-tower-accent/30"></div>
                            @endfor
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Misi 1 --}}
                    <div
                        class="mission-card group relative p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-tower-dark transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                        <div
                            class="icon-box relative z-10 h-16 w-16 flex items-center justify-center rounded-xl bg-white text-tower-accent shadow-sm mb-8 transition-all duration-500">
                            <i class="fas fa-microchip text-3xl"></i>
                        </div>
                        <h3
                            class="relative z-10 text-xl font-black text-tower-dark group-hover:text-white transition-colors">
                            Inovasi Teknologi</h3>
                        <p
                            class="relative z-10 mt-4 text-gray-600 leading-relaxed group-hover:text-gray-300 transition-colors text-sm">
                            Mengadopsi teknologi terbaru dalam desain dan fabrikasi baja untuk menghasilkan infrastruktur
                            tower yang efisien dan tahan lama.
                        </p>
                        <div
                            class="absolute -bottom-4 -right-4 text-8xl font-black text-slate-200 group-hover:text-white/5 transition-colors">
                            01</div>
                    </div>

                    {{-- Misi 2 --}}
                    <div
                        class="mission-card group relative p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-tower-dark transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                        <div
                            class="icon-box relative z-10 h-16 w-16 flex items-center justify-center rounded-xl bg-white text-tower-accent shadow-sm mb-8 transition-all duration-500">
                            <i class="fas fa-user-shield text-3xl"></i>
                        </div>
                        <h3
                            class="relative z-10 text-xl font-black text-tower-dark group-hover:text-white transition-colors">
                            Kualitas & Keamanan</h3>
                        <p
                            class="relative z-10 mt-4 text-gray-600 leading-relaxed group-hover:text-gray-300 transition-colors text-sm">
                            Menjaga standar kualitas tertinggi dan keselamatan kerja (K3) dalam setiap proses instalasi
                            serta pemeliharaan infrastruktur.
                        </p>
                        <div
                            class="absolute -bottom-4 -right-4 text-8xl font-black text-slate-200 group-hover:text-white/5 transition-colors">
                            02</div>
                    </div>

                    {{-- Misi 3 --}}
                    <div
                        class="mission-card group relative p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-tower-dark transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                        <div
                            class="icon-box relative z-10 h-16 w-16 flex items-center justify-center rounded-xl bg-white text-tower-accent shadow-sm mb-8 transition-all duration-500">
                            <i class="fas fa-handshake text-3xl"></i>
                        </div>
                        <h3
                            class="relative z-10 text-xl font-black text-tower-dark group-hover:text-white transition-colors">
                            Kemitraan Strategis</h3>
                        <p
                            class="relative z-10 mt-4 text-gray-600 leading-relaxed group-hover:text-gray-300 transition-colors text-sm">
                            Membangun hubungan jangka panjang yang saling menguntungkan dengan klien melalui pelayanan prima
                            dan responsif.
                        </p>
                        <div
                            class="absolute -bottom-4 -right-4 text-8xl font-black text-slate-200 group-hover:text-white/5 transition-colors">
                            03</div>
                    </div>

                    {{-- Misi 4 --}}
                    <div
                        class="mission-card group relative p-8 bg-slate-50 rounded-2xl border border-slate-100 hover:bg-tower-dark transition-all duration-500 hover:-translate-y-2 overflow-hidden">
                        <div
                            class="icon-box relative z-10 h-16 w-16 flex items-center justify-center rounded-xl bg-white text-tower-accent shadow-sm mb-8 transition-all duration-500">
                            <i class="fas fa-chart-line text-3xl"></i>
                        </div>
                        <h3
                            class="relative z-10 text-xl font-black text-tower-dark group-hover:text-white transition-colors">
                            Pertumbuhan Berkelanjutan</h3>
                        <p
                            class="relative z-10 mt-4 text-gray-600 leading-relaxed group-hover:text-gray-300 transition-colors text-sm">
                            Meningkatkan nilai perusahaan secara berkelanjutan dengan mengembangkan kompetensi SDM dan
                            ekspansi layanan ke seluruh wilayah Indonesia.
                        </p>
                        <div
                            class="absolute -bottom-4 -right-4 text-8xl font-black text-slate-200 group-hover:text-white/5 transition-colors">
                            04</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="relative py-20 bg-tower-dark overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div
                    class="absolute top-0 left-0 w-96 h-96 bg-tower-accent rounded-full filter blur-[100px] -translate-x-1/2 -translate-y-1/2">
                </div>
            </div>

            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-4xl mx-auto text-center">
                    <h3 class="text-white font-black text-3xl md:text-4xl leading-tight uppercase">
                        Ingin membangun masa depan bersama kami?
                    </h3>
                    <p class="mt-4 text-gray-400 font-medium">Hubungi tim ahli kami untuk konsultasi proyek infrastruktur
                        Anda.</p>
                    <div class="mt-10">
                        <a href="{{ route('contact') }}"
                            class="group relative inline-flex items-center gap-3 bg-tower-accent text-white px-10 py-4 rounded-xl font-black uppercase tracking-widest hover:bg-orange-600 transition-all shadow-[0_20px_50px_rgba(255,117,24,0.3)]">
                            Hubungi Kami
                            <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
