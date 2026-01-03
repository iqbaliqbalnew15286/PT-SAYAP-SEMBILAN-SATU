@extends('layouts.app')

@section('content')
    @php
        $hasImages = isset($mainImages) && $mainImages->isNotEmpty();
        // Variabel Warna agar mudah dikelola
        $darkBlue = '#2C3E50';
        $accentOrange = '#FF7518';
    @endphp

    <style>
        .text-tower-dark { color: {{ $darkBlue }}; }
        .bg-tower-dark { background-color: {{ $darkBlue }}; }
        .text-tower-accent { color: {{ $accentOrange }}; }
        .bg-tower-accent { background-color: {{ $accentOrange }}; }
        .border-tower-accent { border-color: {{ $accentOrange }}; }
        .shadow-tower { box-shadow: 0 10px 30px -10px rgba(44, 62, 80, 0.2); }
    </style>

    <div>
        {{-- Hero / Slider Section --}}
        <section class="relative max-w-screen">
            @if($hasImages)
                <div x-data="{ activeSlide: 1, totalSlides: {{ $mainImages->count() }} }"
                    x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                    <div class="relative w-full h-[350px] overflow-hidden">
                        @foreach($mainImages as $image)
                            <div x-show="activeSlide === {{ $loop->iteration }}"
                                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0">
                                <img src="{{ Storage::url($image->path) }}" alt="{{ $image->description ?? $image->filename }}"
                                    class="w-full h-full object-cover">
                                {{-- Overlay Gradasi --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="relative h-[300px] overflow-hidden bg-tower-dark flex items-center justify-center">
                    <div class="text-center">
                        <h1 class="text-white text-4xl font-black tracking-tighter uppercase">Vision & Mission</h1>
                        <div class="mt-2 h-1 w-20 bg-tower-accent mx-auto"></div>
                    </div>
                </div>
            @endif
        </section>

        {{-- Breadcrumb Section --}}
        <div class="bg-tower-dark border-b border-white/10">
            <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-full flex items-center">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2 md:space-x-3 text-sm uppercase tracking-widest font-bold">
                            <li class="inline-flex items-center">
                                <a href="/" class="text-gray-400 hover:text-tower-accent transition-colors">
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-500 text-[10px]"></i>
                                    <a href="{{ route('about') }}"
                                        class="ml-2 text-gray-400 hover:text-tower-accent md:ml-3 transition-colors">About</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-tower-accent text-[10px]"></i>
                                    <span class="ml-2 text-white md:ml-3">Vision & Mission</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Visi Section --}}
        <section class="bg-white py-16 sm:py-24">
            <div class="container mx-auto max-w-5xl px-6 lg:px-8">
                <div class="text-center mb-20">
                    <span class="text-tower-accent font-black uppercase tracking-[0.3em] text-xs">Our Core Values</span>
                    <h2 class="mt-4 text-4xl font-black tracking-tight text-tower-dark sm:text-5xl uppercase">
                        Visi Perusahaan
                    </h2>
                    <div class="mt-8 relative">
                        <i class="fas fa-quote-left absolute -top-8 left-1/2 -translate-x-20 text-tower-accent/10 text-6xl"></i>
                        <p class="text-2xl italic leading-relaxed text-gray-700 max-w-3xl mx-auto font-medium">
                            "Menjadi mitra terpercaya dan pemimpin inovatif dalam industri infrastruktur telekomunikasi nasional melalui keunggulan teknis dan integritas layanan."
                        </p>
                    </div>
                </div>

                <div class="my-16 border-t border-slate-100"></div>

                {{-- Misi Section --}}
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-black tracking-tight text-tower-dark uppercase">Misi Kami</h2>
                    <p class="mt-2 text-gray-500">Langkah strategis kami dalam mewujudkan visi besar perusahaan.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    {{-- Misi 1 --}}
                    <div class="group p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:bg-tower-dark transition-all duration-300 shadow-tower">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-tower-accent mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-microchip text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark group-hover:text-white transition-colors">Inovasi Teknologi</h3>
                        <p class="mt-4 text-gray-600 leading-7 group-hover:text-gray-300 transition-colors">
                            Mengadopsi teknologi terbaru dalam desain dan fabrikasi baja untuk menghasilkan infrastruktur tower yang efisien dan tahan lama.
                        </p>
                    </div>

                    {{-- Misi 2 --}}
                    <div class="group p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:bg-tower-dark transition-all duration-300 shadow-tower">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-tower-accent mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-shield text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark group-hover:text-white transition-colors">Kualitas & Keamanan</h3>
                        <p class="mt-4 text-gray-600 leading-7 group-hover:text-gray-300 transition-colors">
                            Menjaga standar kualitas tertinggi dan keselamatan kerja (K3) dalam setiap proses instalasi serta pemeliharaan infrastruktur.
                        </p>
                    </div>

                    {{-- Misi 3 --}}
                    <div class="group p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:bg-tower-dark transition-all duration-300 shadow-tower">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-tower-accent mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-handshake text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark group-hover:text-white transition-colors">Kemitraan Strategis</h3>
                        <p class="mt-4 text-gray-600 leading-7 group-hover:text-gray-300 transition-colors">
                            Membangun hubungan jangka panjang yang saling menguntungkan dengan klien melalui pelayanan prima dan responsif.
                        </p>
                    </div>

                    {{-- Misi 4 --}}
                    <div class="group p-8 bg-slate-50 rounded-3xl border border-slate-100 hover:bg-tower-dark transition-all duration-300 shadow-tower">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white text-tower-accent mb-6 group-hover:scale-110 transition-transform">
                            <i class="fas fa-chart-line text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark group-hover:text-white transition-colors">Pertumbuhan Berkelanjutan</h3>
                        <p class="mt-4 text-gray-600 leading-7 group-hover:text-gray-300 transition-colors">
                            Meningkatkan nilai perusahaan secara berkelanjutan dengan mengembangkan kompetensi SDM dan ekspansi layanan ke seluruh wilayah Indonesia.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        {{-- CTA Section --}}
        <section class="bg-tower-dark py-12">
            <div class="container mx-auto px-6 text-center">
                <h3 class="text-white font-bold text-xl">Ingin membangun masa depan bersama kami?</h3>
                <a href="{{ route('contact') }}" class="mt-6 inline-block bg-tower-accent text-white px-8 py-3 rounded-full font-black uppercase tracking-widest hover:bg-orange-600 transition-all shadow-lg">
                    Hubungi Kami
                </a>
            </div>
        </section>
    </div>
@endsection
