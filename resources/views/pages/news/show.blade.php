@extends('layouts.app') {{-- Sesuaikan dengan nama file layout utama Anda --}}

@section('content')
    @php
        // Warna Branding (Disesuaikan dengan tema Biru Gelap & Oranye sesuai percakapan sebelumnya)
        $brandOrange = '#FF7518';
        $brandDark = '#161f36';

        // Cek apakah ada galeri tambahan (Opsional, tergantung database Anda)
        $hasGallery = isset($newsImages) && $newsImages->isNotEmpty();
    @endphp

    <div class="bg-white">
        {{-- ================================================================= --}}
        {{-- BAGIAN 1: HERO IMAGE (GAMBAR UTAMA BERITA) --}}
        {{-- ================================================================= --}}
        <header class="w-full h-[300px] lg:h-[500px] bg-[#161f36] overflow-hidden relative">
            @if ($news->image)
                <img src="{{ asset('storage/' . $news->image) }}" alt="Gambar Utama {{ $news->title }}"
                    class="w-full h-full object-contain lg:object-cover opacity-90 transition-opacity duration-500 hover:opacity-100">
                {{-- Overlay Gradient untuk teks agar lebih terbaca jika ada --}}
                <div class="absolute inset-0 bg-gradient-to-t from-[#161f36] to-transparent opacity-40"></div>
            @else
                <div class="w-full h-full flex flex-col items-center justify-center bg-gray-800 text-white">
                    <i class="far fa-image text-5xl mb-3 text-gray-500"></i>
                    <p class="text-xl font-medium">Gambar Berita Tidak Tersedia</p>
                </div>
            @endif
        </header>

        {{-- BREADCRUMB --}}
        <div class="bg-[#2D2D2D] py-3">
            <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex text-sm sm:text-base" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 w-full overflow-hidden">
                        <li>
                            <a href="/" class="text-gray-300 hover:text-[#FF7518] transition-colors">Home</a>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-500 text-[10px] mx-2"></i>
                            <a href="{{ route('news.index') }}" class="text-gray-300 hover:text-[#FF7518] transition-colors">Berita</a>
                        </li>
                        <li class="flex items-center min-w-0 flex-1">
                            <i class="fas fa-chevron-right text-gray-500 text-[10px] mx-2"></i>
                            <span class="text-[#FF7518] truncate font-medium">{{ $news->title }}</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- MAIN CONTENT SECTION --}}
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-16">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                {{-- KOLOM KIRI (KONTEN UTAMA) --}}
                <div class="lg:col-span-2">
                    {{-- Tombol Kembali --}}
                    <a href="{{ route('news.index') }}"
                        class="text-gray-500 hover:text-[#FF7518] text-sm font-semibold mb-6 inline-flex items-center transition-all group">
                        <i class="fas fa-arrow-left mr-2 transform group-hover:-translate-x-1 transition-transform"></i>
                        Kembali ke Daftar Berita
                    </a>

                    <header class="mb-8">
                        <h1 class="text-3xl lg:text-5xl font-bold mb-6 text-[#161f36] leading-tight">
                            {{ $news->title }}
                        </h1>

                        <div class="flex flex-wrap items-center gap-6 text-sm border-y border-gray-100 py-4">
                            <div class="flex items-center text-gray-600">
                                <div class="w-8 h-8 rounded-full bg-orange-100 text-[#FF7518] flex items-center justify-center mr-3">
                                    <i class="far fa-calendar-alt"></i>
                                </div>
                                <span>{{ \Carbon\Carbon::parse($news->date_published)->translatedFormat('d F Y') }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <div class="w-8 h-8 rounded-full bg-blue-100 text-[#161f36] flex items-center justify-center mr-3">
                                    <i class="far fa-user"></i>
                                </div>
                                <span>Penulis: <strong class="text-gray-900">{{ $news->publisher ?? 'Admin' }}</strong></span>
                            </div>
                        </div>
                    </header>

                    {{-- Isi Berita --}}
                    <article class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-12 news-body">
                        {!! $news->description !!}
                    </article>

                    {{-- GALERI FOTO (Jika Ada) --}}
                    @if ($hasGallery)
                        <div class="pt-10 border-t border-gray-100" x-data="{ modalOpen: false, modalImage: '' }">
                            <h3 class="text-2xl font-bold text-[#161f36] mb-6 flex items-center">
                                <span class="w-2 h-8 bg-[#FF7518] mr-3 rounded-full"></span>
                                Galeri Foto
                            </h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                @foreach ($newsImages as $img)
                                    <div @click="modalImage = '{{ asset('storage/' . $img->path) }}'; modalOpen = true"
                                        class="aspect-square overflow-hidden rounded-xl cursor-pointer group bg-gray-100 relative shadow-sm border border-gray-100">
                                        <img src="{{ asset('storage/' . $img->path) }}"
                                            alt="Galeri"
                                            class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity"></div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- MODAL PREVIEW GAMBAR --}}
                            <div x-show="modalOpen"
                                 x-transition.opacity
                                 class="fixed inset-0 z-[99] bg-black/95 flex items-center justify-center p-4"
                                 @keydown.escape.window="modalOpen = false"
                                 style="display: none;">
                                <button @click="modalOpen = false" class="absolute top-6 right-6 text-white text-4xl hover:text-[#FF7518]">
                                    <i class="fas fa-times"></i>
                                </button>
                                <img :src="modalImage" class="max-w-full max-h-[90vh] object-contain rounded shadow-2xl">
                            </div>
                        </div>
                    @endif

                    {{-- SHARE BUTTONS --}}
                    <div class="mt-12 p-6 bg-gray-50 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4">
                        <h3 class="font-bold text-[#161f36]">Bagikan berita ini:</h3>
                        <div class="flex items-center space-x-3">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($news->title . ' - ' . url()->current()) }}" target="_blank"
                                class="w-11 h-11 rounded-full bg-white shadow-sm text-green-500 flex items-center justify-center hover:bg-green-500 hover:text-white transition-all">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank"
                                class="w-11 h-11 rounded-full bg-white shadow-sm text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($news->title) }}" target="_blank"
                                class="w-11 h-11 rounded-full bg-white shadow-sm text-black flex items-center justify-center hover:bg-black hover:text-white transition-all">
                                <i class="fab fa-twitter text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (SIDEBAR) --}}
                <aside class="lg:col-span-1">
                    <div class="lg:sticky lg:top-10 space-y-8">
                        {{-- Widget Berita Lainnya --}}
                        <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-[#161f36] mb-6 pb-2 border-b-2 border-[#FF7518] inline-block">
                                Baca Juga
                            </h3>
                            <div class="space-y-6">
                                @forelse ($randomNews ?? [] as $item)
                                    <a href="{{ route('news.show', $item->id) }}" class="group flex items-start gap-4">
                                        <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-gray-100">
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-bold text-gray-800 group-hover:text-[#FF7518] line-clamp-2 transition-colors">
                                                {{ $item->title }}
                                            </h4>
                                            <p class="text-[11px] text-gray-500 mt-2">
                                                <i class="far fa-clock mr-1"></i> {{ \Carbon\Carbon::parse($item->date_published)->diffForHumans() }}
                                            </p>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-400 italic">Belum ada berita lainnya.</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Widget Info / Iklan (Optional) --}}
                        <div class="bg-[#161f36] rounded-2xl p-6 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <h3 class="font-bold text-lg mb-2">Punya Pertanyaan?</h3>
                                <p class="text-sm text-gray-300 mb-4">Hubungi kami untuk informasi lebih lanjut mengenai berita ini.</p>
                                <a href="/contact" class="inline-block bg-[#FF7518] text-white px-5 py-2 rounded-lg text-sm font-bold hover:bg-white hover:text-[#FF7518] transition-colors">
                                    Hubungi Kami
                                </a>
                            </div>
                            <i class="fas fa-paper-plane absolute -bottom-4 -right-4 text-white/10 text-8xl transform -rotate-12 group-hover:scale-110 transition-transform"></i>
                        </div>
                    </div>
                </aside>

            </div>
        </div>
    </div>

    <style>
        /* Styling tambahan untuk konten dari Trix Editor agar tetap rapi */
        .news-body img { border-radius: 1rem; margin: 2rem 0; box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1); }
        .news-body h2 { color: #161f36; font-weight: 700; margin-top: 2rem; }
        .news-body a { color: #FF7518; text-decoration: underline; }
        .news-body ul { list-style-type: disc; margin-left: 1.5rem; }
    </style>
@endsection
