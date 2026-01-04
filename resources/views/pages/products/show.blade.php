@extends('layouts.app')

@section('title', $product->name . ' - PT. RBM')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

@php
    /**
     * Helper untuk mendeteksi apakah gambar berasal dari Seeder (assets) atau Upload (storage)
     */
    $getProductImage = function($imagePath) {
        if (!$imagePath) return null;
        if (str_contains($imagePath, 'assets/')) {
            return asset($imagePath);
        }
        return asset('storage/' . $imagePath);
    };

    $mainImage = $getProductImage($product->image);
@endphp

<div class="bg-[#F4F7FA] min-h-screen font-['Poppins']">

    {{-- 🌌 1. DYNAMIC FULL-WIDTH HERO BANNER --}}
    <section class="relative w-full h-[50vh] lg:h-[60vh] flex items-end pb-16 overflow-hidden bg-[#161f36]">
        <div class="absolute inset-0 z-0">
            @if ($mainImage)
                <img src="{{ $mainImage }}"
                     class="w-full h-full object-cover object-center opacity-60"
                     alt="Banner {{ $product->name }}">
            @endif

            {{-- Overlay Gradien agar teks judul tetap kontras --}}
            <div class="absolute inset-0 bg-gradient-to-t from-[#161f36] via-[#161f36]/40 to-transparent"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-12">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-3 text-[10px] uppercase tracking-[0.3em] font-bold text-gray-300">
                    <li><a href="/" class="hover:text-[#FF7518] transition">Home</a></li>
                    <li><i class="fas fa-angle-right text-[8px]"></i></li>
                    <li><a href="{{ route('products') }}" class="hover:text-[#FF7518] transition">Products</a></li>
                    <li><i class="fas fa-angle-right text-[8px]"></i></li>
                    <li class="text-[#FF7518]">{{ $product->type }}</li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter leading-none">
                PRODUCT <span class="text-[#FF7518]">SPECIFICATION</span>
            </h1>
        </div>
    </section>

    {{-- 🏗️ 2. MAIN CONTENT AREA --}}
    <section class="py-12 lg:py-20 -mt-12 relative z-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex flex-col lg:flex-row gap-10">

                {{-- KOLOM KIRI (8/12): Foto Utama & Deskripsi --}}
                <div class="lg:w-8/12 space-y-8">

                    {{-- Judul Produk Card --}}
                    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100">
                        <div class="flex flex-wrap items-center justify-between gap-4">
                            <h2 class="text-3xl lg:text-4xl font-black text-[#161f36] uppercase tracking-tight">
                                {{ $product->name }}
                            </h2>
                            <span class="bg-[#FF7518]/10 text-[#FF7518] px-5 py-2 rounded-full text-[10px] font-black uppercase tracking-widest border border-[#FF7518]/20">
                                {{ $product->type }}
                            </span>
                        </div>
                    </div>

                    {{-- FOTO PRODUK UTAMA --}}
                    <div class="bg-white p-4 rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                        <div class="relative bg-gray-50 rounded-[2rem] flex items-center justify-center overflow-hidden" style="min-height: 450px;">
                            @if ($mainImage)
                                <img src="{{ $mainImage }}"
                                     alt="{{ $product->name }}"
                                     class="max-w-full max-h-[600px] object-contain transition-transform duration-1000 hover:scale-105 p-8">
                            @else
                                <div class="text-gray-300 text-center">
                                    <i class="fas fa-image text-8xl mb-4"></i>
                                    <p class="font-bold uppercase tracking-widest">No Image Available</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Card Deskripsi --}}
                    <div class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="w-12 h-12 bg-[#161f36] text-white flex items-center justify-center rounded-2xl">
                                <i class="fas fa-info-circle text-lg"></i>
                            </div>
                            <h4 class="text-[#161f36] font-black uppercase tracking-widest text-lg">Detail Informasi</h4>
                        </div>
                        <div class="prose prose-slate max-w-none text-gray-600 leading-relaxed text-base lg:text-lg">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN (4/12): Harga & Booking --}}
                <div class="lg:w-4/12">
                    <div class="sticky top-28 space-y-8">

                        {{-- Card Harga & Booking --}}
                        <div class="bg-white rounded-[2.5rem] p-10 shadow-xl border border-gray-50">
                            <div class="mb-10">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Estimasi Harga</p>
                                <h3 class="text-4xl font-black text-[#161f36]">
                                    <span class="text-[#FF7518] text-xl">Rp</span> {{ number_format($product->price, 0, ',', '.') }}
                                </h3>
                            </div>

                            <div class="space-y-4">
                                {{-- Tombol WhatsApp Booking --}}
                                @php
                                    $waMessage = "Halo Admin PT. RBM, saya tertarik dengan " . $product->type . " : " . $product->name . ". Mohon info detail selengkapnya.";
                                @endphp
                                <a href="https://wa.me/6281234567890?text={{ urlencode($waMessage) }}"
                                   target="_blank"
                                   class="flex items-center justify-center gap-3 bg-[#161f36] text-white w-full py-5 rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] hover:bg-[#FF7518] transition-all transform hover:-translate-y-1 active:scale-95 shadow-lg shadow-blue-900/10">
                                    <i class="fas fa-calendar-check text-xl"></i> Booking Sekarang
                                </a>
                                <p class="text-[9px] text-center text-gray-400 font-bold uppercase tracking-widest leading-relaxed">
                                    Konsultasikan kebutuhan teknis atau <br> survei lapangan dengan tim ahli kami.
                                </p>
                            </div>
                        </div>

                        {{-- Card Produk Serupa --}}
                        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                            <h3 class="text-[#161f36] font-black uppercase tracking-widest text-xs mb-8 flex items-center gap-3">
                                <div class="w-2 h-6 bg-[#FF7518] rounded-full"></div>
                                Produk/Jasa Serupa
                            </h3>

                            <div class="space-y-6">
                                @forelse ($recommended_products as $item)
                                    @php
                                        $recImage = $getProductImage($item->image);
                                    @endphp
                                    <a href="{{ route('product.show', $item->id) }}" class="group flex items-center gap-5">
                                        <div class="w-20 h-20 flex-shrink-0 rounded-2xl overflow-hidden bg-gray-50 border border-gray-100">
                                            @if($recImage)
                                                <img src="{{ $recImage }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-300 bg-gray-100">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-[11px] font-black text-[#161f36] group-hover:text-[#FF7518] transition-colors line-clamp-2 uppercase mb-1">
                                                {{ $item->name }}
                                            </h4>
                                            <p class="text-[10px] font-bold text-[#FF7518]">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-gray-400 text-[10px] text-center italic py-4">Tidak ada produk serupa</p>
                                @endforelse
                            </div>

                            <a href="{{ route('products') }}" class="mt-8 flex items-center justify-center w-full py-4 bg-gray-50 text-gray-500 rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] hover:bg-[#161f36] hover:text-white transition-all border border-gray-100">
                                Lihat Semua Katalog
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<style>
    .prose p { margin-bottom: 1.25rem; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .relative.z-20 { animation: fadeInUp 0.8s ease-out; }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #f4f7fa; }
    ::-webkit-scrollbar-thumb { background: #161f36; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #FF7518; }
</style>
@endsection
