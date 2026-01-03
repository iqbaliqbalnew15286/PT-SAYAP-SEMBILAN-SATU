@extends('layouts.app')

@section('content')
    @php
        $hasImages = isset($mainImages) && $mainImages->isNotEmpty();
        // Definisi warna tema agar mudah diubah jika perlu
        $themeDark = '#2C3E50'; // Biru Tua Tower
        $themeAccent = '#FF7518'; // Oranye
    @endphp

    <style>
        .text-tower-dark { color: {{ $themeDark }}; }
        .bg-tower-dark { background-color: {{ $themeDark }}; }
        .text-tower-accent { color: {{ $themeAccent }}; }
        .bg-tower-accent { background-color: {{ $themeAccent }}; }
        .border-tower-accent { border-color: {{ $themeAccent }}; }
    </style>

    <div>
        {{-- Hero Section / Slider --}}
        <section class="relative max-w-screen">
            @if ($hasImages)
                <div x-data="{ activeSlide: 1, totalSlides: {{ $mainImages->count() }} }" x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                    <div class="relative w-full h-[350px] overflow-hidden">
                        @foreach ($mainImages as $image)
                            <div x-show="activeSlide === {{ $loop->iteration }}"
                                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute inset-0">
                                <img src="{{ Storage::url($image->path) }}"
                                    alt="{{ $image->description ?? $image->filename }}" class="w-full h-full object-cover">
                                {{-- Overlay agar teks breadcrumb nantinya kontras --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="relative h-[300px] overflow-hidden bg-tower-dark flex items-center justify-center">
                    <i class="fas fa-building text-white/10 text-[200px] absolute"></i>
                    <h1 class="text-white text-4xl font-black relative z-10">HISTORY</h1>
                </div>
            @endif
        </section>

        {{-- Breadcrumb Section --}}
        <div class="bg-tower-dark border-b border-white/10">
            <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-full flex items-center">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2 md:space-x-3 text-sm uppercase tracking-widest">
                            <li class="inline-flex items-center">
                                <a href="/" class="font-bold text-gray-400 hover:text-tower-accent transition-colors">
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-gray-500 text-[10px]"></i>
                                    <a href="{{ route('about') }}" class="ml-2 font-bold text-gray-400 hover:text-tower-accent md:ml-3 transition-colors">About</a>
                                </div>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-tower-accent text-[10px]"></i>
                                    <span class="ml-2 font-black md:ml-3 text-white">History</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- Main History Content --}}
        <section class="bg-[#F8FAFC] py-16 sm:py-24">
            <div class="container mx-auto max-w-5xl px-6 lg:px-8">

                <div class="text-center mb-16">
                    <span class="bg-orange-100 text-tower-accent px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest">Company Journey</span>
                    <h2 class="mt-4 text-4xl font-black tracking-tight text-tower-dark sm:text-5xl">
                        Sejarah Perusahaan
                    </h2>
                    <div class="mt-4 w-24 h-1.5 bg-tower-accent mx-auto rounded-full"></div>
                    <p class="mt-6 text-lg leading-8 text-gray-600 max-w-2xl mx-auto">
                        Membangun infrastruktur masa depan dengan dedikasi, integritas, dan inovasi berkelanjutan.
                    </p>
                </div>

                {{-- Timeline Style --}}
                <div class="space-y-16">

                    {{-- Section 1 --}}
                    <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8 bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-tower-dark text-tower-accent shadow-lg shadow-blue-900/20">
                            <i class="fas fa-rocket text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-tower-dark uppercase tracking-tight">
                                Awal Mula & Visi
                            </h3>
                            <p class="mt-3 text-base leading-7 text-gray-600">
                                Berawal dari semangat untuk memberikan solusi infrastruktur terbaik, perusahaan didirikan dengan fokus pada kualitas dan ketepatan waktu. Kami percaya bahwa setiap menara yang kami bangun adalah pondasi bagi konektivitas bangsa.
                            </p>
                        </div>
                    </div>

                    {{-- Section 2 --}}
                    <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8 bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-tower-accent text-white shadow-lg shadow-orange-500/20">
                            <i class="fas fa-broadcast-tower text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-tower-dark uppercase tracking-tight">
                                Ekspansi & Inovasi
                            </h3>
                            <p class="mt-3 text-base leading-7 text-gray-600">
                                Seiring berjalannya waktu, kami memperluas jangkauan layanan mulai dari fabrikasi baja hingga penyediaan unit Transportable BTS (Combat). Inovasi menjadi mesin utama pertumbuhan kami di industri telekomunikasi.
                            </p>
                        </div>
                    </div>

                    {{-- Section 3 --}}
                    <div class="relative flex flex-col md:flex-row items-center md:items-start gap-8 bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                        <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-2xl bg-tower-dark text-tower-accent shadow-lg shadow-blue-900/20">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-black text-tower-dark uppercase tracking-tight">
                                Komitmen Terhadap Kualitas
                            </h3>
                            <p class="mt-3 text-base leading-7 text-gray-600">
                                Keamanan dan ketahanan produk adalah prioritas utama. Melalui proses Engineering Design yang presisi, kami memastikan setiap struktur mampu menghadapi tantangan lingkungan yang ekstrim sekalipun.
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- Detail Content Section --}}
        <section class="bg-white py-16 sm:py-24 border-t border-slate-100">
            <div class="max-w-5xl mx-auto px-6 lg:px-8">

                <div class="flex items-center gap-4 mb-12">
                    <div class="w-2 h-10 bg-tower-accent rounded-full"></div>
                    <h2 class="text-3xl font-black text-tower-dark tracking-tight">
                        Detail Perjalanan Kami
                    </h2>
                </div>

                @if ($historyContent)
                    <article class="prose prose-lg prose-slate max-w-none
                        prose-headings:text-tower-dark prose-headings:font-black
                        prose-strong:text-tower-dark prose-a:text-tower-accent">
                        {!! $historyContent->content !!}
                    </article>
                @else
                    <div class="text-center py-20 bg-slate-50 rounded-[2rem] border-2 border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i class="fas fa-file-alt text-slate-300 text-3xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-tower-dark">Konten Sedang Disiapkan</h3>
                        <p class="mt-2 text-slate-500">Informasi detail mengenai sejarah perusahaan akan segera hadir.</p>
                    </div>
                @endif

            </div>
        </section>
    </div>
@endsection
