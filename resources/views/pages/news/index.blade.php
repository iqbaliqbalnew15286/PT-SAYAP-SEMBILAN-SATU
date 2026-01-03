@extends('layouts.app') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('content')

@php
    $amaliahGreen = '#63cd00';
    $amaliahDark = '#282829';
    $amaliahBlue = '#E0E7FF';

    // Cek Variabel
    $hasImages = isset($newsImages) && $newsImages->isNotEmpty();

    // Ambil 1 gambar dari berita (fallback banner)
    $bannerFromNews = $news->firstWhere('image', '!=', null);
@endphp

<div>

    {{-- ===================== BANNER ===================== --}}
    <section class="relative max-w-screen">

        {{-- PRIORITAS 1: SLIDER DARI NEWS IMAGES --}}
        @if ($hasImages)
            <div
                x-data="{ activeSlide: 1, totalSlides: {{ $newsImages->count() }} }"
                x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)"
            >
                <div class="relative w-full h-[300px] overflow-hidden">
                    @foreach ($newsImages as $image)
                        <div
                            x-show="activeSlide === {{ $loop->iteration }}"
                            x-transition:enter="transition ease-out duration-1000"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-1000"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="absolute inset-0"
                        >
                            <img
                                src="{{ Storage::url($image->path) }}"
                                alt="{{ $image->description ?? $image->filename }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                    @endforeach
                </div>
            </div>

        {{-- PRIORITAS 2: AMBIL GAMBAR DARI BERITA --}}
        @elseif ($bannerFromNews)
            <div class="relative w-full h-[300px] overflow-hidden">
                <img
                    src="{{ asset('storage/' . $bannerFromNews->image) }}"
                    alt="{{ $bannerFromNews->title }}"
                    class="w-full h-full object-cover"
                >
            </div>

        {{-- PRIORITAS 3: FALLBACK TERAKHIR --}}
        @else
            <div class="relative h-[300px] overflow-hidden bg-black"></div>
        @endif

    </section>
    {{-- ===================== END BANNER ===================== --}}

    {{-- BREADCRUMB --}}
    <div style="background-color: #2D2D2D;">
        <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-full flex items-center">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-2 md:space-x-3 text-lg">
                        <li class="inline-flex items-center">
                            <a href="/" class="font-medium text-gray-300 hover:text-white transition-colors">
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-white text-xs"></i>
                                <a href="{{ route('news.index') }}"
                                   class="ml-2 font-medium text-white md:ml-3">
                                    News
                                </a>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="md:w-1/2 mb-8">
            <h2 class="text-2xl lg:text-3xl font-extrabold text-gray-900 tracking-tight">
                Berita Terbaru
            </h2>
            <p class="mt-3 text-base text-gray-600">
                Jelajahi beragam berita terbaru yang kami sajikan untuk Anda.
            </p>
        </div>

        {{-- GRID BERITA --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse ($news as $item)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    <a href="{{ route('news.show', $item) }}">
                        @if ($item->image)
                            <img
                                src="{{ asset('storage/' . $item->image) }}"
                                alt="{{ $item->title }}"
                                class="w-full h-48 object-cover"
                            >
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-500">
                                Gambar Tidak Tersedia
                            </div>
                        @endif
                    </a>

                    <div class="p-5">
                        <span class="text-xs text-gray-500 block mb-2">
                            {{ \Carbon\Carbon::parse($item->date_published)->format('d F Y') }}
                            | Oleh: {{ $item->publisher }}
                        </span>

                        <a href="{{ route('news.show', $item) }}"
                           class="text-xl font-semibold text-gray-900 hover:text-blue-600 block mb-3 line-clamp-2">
                            {{ $item->title }}
                        </a>

                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ strip_tags($item->description) }}
                        </p>

                        <a href="{{ route('news.show', $item) }}"
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center col-span-full py-10">
                    Belum ada berita yang dipublikasikan.
                </p>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $news->links() }}
        </div>
    </div>

</div>

@endsection
