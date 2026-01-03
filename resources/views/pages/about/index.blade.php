@extends('layouts.app')

@section('content')
    @php
        // Cek Variabel
        $hasImages = isset($mainImages) && $mainImages->isNotEmpty();

        // Data link yang sudah disesuaikan teks, url, dan warnanya tetap mengikuti struktur asli
        $aboutLinks = [
            [
                'title' => 'Sejarah',
                'description' => 'Perjalanan membangun infrastruktur komunikasi.',
                'url' => '/history',
                'icon' => 'fa-history'
            ],
            [
                'title' => 'Visi Misi',
                'description' => 'Target kami menjadi penyedia menara terdepan.',
                'url' => '/vision',
                'icon' => 'fa-bullseye'
            ],
        ];
    @endphp
    <div>
        <section class="relative max-w-screen">
            {{-- Slider Gambar Dinamis --}}
            @if ($hasImages)
                <div x-data="{ activeSlide: 1, totalSlides: {{ $mainImages->count() }} }" x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                    <div class="relative w-full h-[300px] overflow-hidden">
                        @foreach ($mainImages as $image)
                            <div x-show="activeSlide === {{ $loop->iteration }}"
                                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute inset-0">

                                <img src="{{ Str::contains($image->path, 'http') ? $image->path : Storage::url($image->path) }}"
                                    alt="{{ $image->description ?? $image->filename }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach

                    </div>
                </div>
            @else
                {{-- Diubah ke warna Biru sesuai permintaan --}}
                <div>
                    <div class="relative h-[300px] overflow-hidden bg-blue-900">
                    </div>
                </div>
            @endif
        </section>

        {{-- Background Breadcrumb diubah ke Biru Gelap --}}
        <div style="background-color: #1e3a8a;">
            <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-full flex items-center">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2 md:space-x-3 text-lg">
                            <li class="inline-flex items-center">
                                <a href="/"
                                    class="inline-flex items-center font-medium text-gray-300 hover:text-white transition-colors">
                                    Home
                                </a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    {{-- Icon Chevron diubah ke Oranye --}}
                                    <i class="fas fa-chevron-right text-orange-500 text-xs"></i>
                                    <a href="{{ route('about') }}"
                                        class="ml-2 font-medium text-white hover:text-white md:ml-3 transition-colors">About</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section class="bg-white py-16 sm:py-24">
            <div class="container mx-auto max-w-7xl px-6 lg:px-8">
                <div class="grid grid-cols-1 gap-y-12 lg:grid-cols-3 lg:gap-x-12">

                    <div class="lg:col-span-1">
                        {{-- Teks diubah ke tema Industri Tower --}}
                        <h2 class="text-3xl font-bold tracking-tight text-blue-900 sm:text-4xl">
                            Penyedia Infrastruktur Menara Terpercaya
                        </h2>
                        <p class="mt-4 text-lg text-gray-600 leading-relaxed">
                            Kami berfokus pada penyediaan lahan dan pembangunan menara telekomunikasi (BTS) untuk mempercepat digitalisasi dan konektivitas di seluruh wilayah.
                        </p>
                    </div>

                    <div class="lg:col-span-2 grid grid-cols-1 gap-y-10 sm:grid-cols-2 sm:gap-x-8">

                        <div class="flex items-start">
                            {{-- Warna bg diubah ke Biru muda, icon Biru --}}
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100">
                                <i class="fas fa-broadcast-tower text-lg text-blue-700"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Infrastruktur Kokoh</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600">
                                    Pembangunan menara dilakukan dengan standar keamanan tinggi dan material berkualitas industri.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            {{-- Warna bg diubah ke Oranye muda, icon Oranye --}}
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-orange-100">
                                <i class="fas fa-tools text-lg text-orange-600"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Layanan Maintenance</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600">
                                    Tim teknis profesional siap melakukan pemeliharaan berkala untuk menjaga kualitas jaringan.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-blue-100">
                                <i class="fas fa-shield-alt text-lg text-blue-700"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Izin & Legalitas</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600">
                                    Kami menjamin seluruh titik koordinat menara memiliki izin resmi dari pemerintah dan warga setempat.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-orange-100">
                                <i class="fas fa-network-wired text-lg text-orange-600"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900">Solusi Konektivitas</h3>
                                <p class="mt-2 text-base leading-7 text-gray-600">
                                    Mendukung berbagai provider telekomunikasi dalam memperluas jangkauan sinyal hingga pelosok.
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-20 mt-[-40px]">
            <div class="container mx-auto px-4">

                {{-- Judul Seksi --}}
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold tracking-tight text-blue-900 sm:text-4xl">
                        Informasi Perusahaan
                    </h2>
                    <p class="mt-3 max-w-2xl mx-auto text-lg leading-8 text-gray-600">
                        Kenali lebih dalam sejarah dan struktur manajemen kami.
                    </p>
                </div>

                {{-- Grid Card --}}
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-2 gap-4 px-4 sm:px-6 lg:px-8">

                    @foreach ($aboutLinks as $item)
                        <a href="{{ url($item['url']) }}"
                            {{-- bg diubah ke Biru (blue-900), hover ke Oranye (orange-600) --}}
                            class="group bg-blue-900 rounded-xl p-6 flex items-center justify-between hover:bg-orange-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">

                            {{-- Bagian Kiri: Teks Judul dan Deskripsi --}}
                            <div class="text-white pr-4">
                                <h3 class="text-xl font-bold">{{ $item['title'] }}</h3>
                                <p class="mt-1 text-sm text-blue-100">{{ $item['description'] }}</p>
                            </div>

                            {{-- Bagian Kanan: Ikon (Hover diubah ke Biru) --}}
                            <div
                                class="ml-4 flex-shrink-0 w-14 h-14 bg-white rounded-full flex items-center justify-center
                                         group-hover:scale-110 group-hover:bg-blue-100 transition-all duration-300">

                                <i
                                    class="fas {{ $item['icon'] }} text-2xl text-blue-900 group-hover:text-blue-900 transition-colors"></i>

                            </div>
                        </a>
                    @endforeach

                </div>

            </div>
        </section>

    </div>
@endsection
