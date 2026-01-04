@extends('layouts.app')

@section('content')

    @php
        $amaliahGreen = '#63cd00';
        $amaliahDark = '#282829';
        $amaliahBlue = '#E0E7FF';

        // Cek Variabel agar tidak error count()
        $hasImages = isset($newsImages) && $newsImages->isNotEmpty();

        // Ambil 1 gambar dari berita (fallback banner)
        $bannerFromNews = isset($news) && $news->count() > 0 ? $news->firstWhere('image', '!=', null) : null;
    @endphp

    <div>
        {{-- ===================== BANNER ===================== --}}
        <section class="relative max-w-screen">
            {{-- PRIORITAS 1: SLIDER DARI NEWS IMAGES --}}
            @if ($hasImages)
                <div x-data="{ activeSlide: 1, totalSlides: {{ $newsImages->count() }} }" x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                    <div class="relative w-full h-[300px] overflow-hidden">
                        @foreach ($newsImages as $image)
                            <div x-show="activeSlide === {{ $loop->iteration }}"
                                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute inset-0">
                                <img src="{{ Storage::url($image->path) }}"
                                    alt="{{ $image->description ?? $image->filename }}" class="w-full h-full object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>

            {{-- PRIORITAS 2: AMBIL GAMBAR DARI BERITA --}}
            @elseif ($bannerFromNews)
                <div class="relative w-full h-[300px] overflow-hidden">
                    <img src="{{ asset('storage/' . $bannerFromNews->image) }}" alt="{{ $bannerFromNews->title }}"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black/30"></div> {{-- Overlay agar lebih elegan --}}
                </div>

            {{-- PRIORITAS 3: FALLBACK TERAKHIR --}}
            @else
                <div class="relative h-[250px] overflow-hidden bg-[#161f36] flex items-center justify-center">
                    <h1 class="text-white font-bold text-3xl uppercase tracking-widest">News & Updates</h1>
                </div>
            @endif
        </section>

        {{-- BREADCRUMB --}}
        <div style="background-color: #2D2D2D;">
            <div class="max-w-screen-xl h-[70px] mx-auto px-4 sm:px-6 lg:px-8">
                <div class="h-full flex items-center">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-2 md:space-x-3 text-lg">
                            <li class="inline-flex items-center">
                                <a href="/" class="font-medium text-gray-300 hover:text-white transition-colors">Home</a>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <i class="fas fa-chevron-right text-white text-[10px] opacity-50"></i>
                                    <a href="{{ route('news.index') }}" class="ml-2 font-medium text-white md:ml-3">News</a>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        {{-- CONTENT --}}
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="md:w-1/2 mb-12">
                <h2 class="text-3xl lg:text-4xl font-black text-gray-900 tracking-tight uppercase">
                    Warta <span class="text-[#FF7518]">Terbaru</span>
                </h2>
                <div class="h-1.5 w-20 bg-[#FF7518] mt-2 mb-4"></div>
                <p class="text-base text-gray-600">
                    Informasi terkini mengenai perkembangan proyek, teknologi, dan kegiatan operasional PT. Rizqallah Boer Makmur.
                </p>
            </div>

            {{-- GRID BERITA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($news as $item)
                    <div class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col">

                        {{-- Image Area --}}
                        <div class="relative overflow-hidden h-56">
                            {{-- Perbaikan slug: Jika slug kosong, gunakan id sebagai cadangan --}}
                            <a href="{{ route('news.show', $item->slug ?? $item->id) }}">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                        <i class="fa-regular fa-image text-4xl"></i>
                                    </div>
                                @endif
                            </a>
                        </div>

                        {{-- Text Area --}}
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <span class="bg-orange-50 text-[#FF7518] text-[10px] font-bold px-2 py-0.5 rounded uppercase">Update</span>
                                <span class="text-[11px] text-gray-400 font-medium">
                                    {{ $item->date_published ? \Carbon\Carbon::parse($item->date_published)->format('d M Y') : $item->created_at->format('d M Y') }}
                                </span>
                            </div>

                            <a href="{{ route('news.show', $item->slug ?? $item->id) }}"
                                class="text-xl font-bold text-gray-900 hover:text-[#FF7518] transition-colors mb-3 line-clamp-2 leading-snug">
                                {{ $item->title }}
                            </a>

                            <p class="text-gray-500 text-sm line-clamp-3 mb-6 leading-relaxed">
                                {{ strip_tags($item->description ?? $item->content) }}
                            </p>

                            <div class="mt-auto pt-4 border-t border-gray-50">
                                <a href="{{ route('news.show', $item->slug ?? $item->id) }}"
                                    class="text-[#FF7518] hover:gap-3 transition-all text-sm font-bold flex items-center gap-2">
                                    Baca Selengkapnya <i class="fas fa-arrow-right-long"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="bg-gray-50 inline-block p-6 rounded-full mb-4">
                            <i class="fa-solid fa-newspaper text-gray-300 text-5xl"></i>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $news->links() }}
            </div>
        </div>
    </div>

@endsection
