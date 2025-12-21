@extends('layouts.app')

@section('title', $product->name . ' - PT. RBM')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<div class="bg-[#F9FBFF] min-h-screen font-['Poppins']">

    {{-- 🌌 HERO BANNER: Disamakan dengan Detail Fasilitas --}}
    <section class="relative h-[20vh] lg:h-[30vh] flex items-center overflow-hidden bg-[#161f36]">
        <div class="absolute inset-0 z-0">
            @if ($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover opacity-30 blur-sm" alt="Background">
            @endif
            <div class="absolute inset-0 bg-gradient-to-r from-[#161f36] to-transparent"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 w-full">
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-[10px] uppercase tracking-widest font-bold">
                    <li><a href="/" class="text-gray-400 hover:text-white transition">Home</a></li>
                    <li class="text-gray-500"><i class="fas fa-chevron-right text-[8px] mx-1"></i></li>
                    <li><a href="{{ route('products') }}" class="text-gray-400 hover:text-white transition">Products</a></li>
                    <li class="text-gray-500"><i class="fas fa-chevron-right text-[8px] mx-1"></i></li>
                    <li class="text-[#FF7518] truncate max-w-[150px]">{{ $product->name }}</li>
                </ol>
            </nav>
            <h1 class="text-2xl md:text-4xl font-black text-white uppercase tracking-tight">
                Detail <span class="text-[#FF7518]">Produk</span>
            </h1>
        </div>
    </section>

    {{-- 🏗️ MAIN CONTENT --}}
    <section class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col lg:flex-row gap-12">

                {{-- KOLOM KIRI: Konten Utama --}}
                <div class="lg:w-2/3">
                    {{-- Badge & Judul --}}
                    <div class="mb-8">
                        <span class="bg-[#FF7518]/10 text-[#FF7518] px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border border-[#FF7518]/20">
                            {{ $product->type == 'jasa' ? 'Technical Service' : 'Hardware Product' }}
                        </span>
                        <h2 class="mt-4 text-3xl lg:text-4xl font-black text-[#161f36] uppercase tracking-tight leading-tight">
                            {{ $product->name }}
                        </h2>
                        <div class="flex flex-wrap items-center gap-6 mt-6">
                            <div>
                                <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest mb-1">Mulai Investasi</p>
                                <p class="text-3xl font-black text-[#FF7518]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                            <div class="h-10 w-[1px] bg-gray-200 hidden md:block"></div>
                            <span class="flex items-center gap-2 text-gray-400 text-[10px] font-bold uppercase tracking-widest">
                                <i class="fas fa-shield-check text-green-500"></i>
                                Ready to execute
                            </span>
                        </div>
                    </div>

                    {{-- GAMBAR UTAMA: Ukuran proporsional (max-h-450px) --}}
                    @if ($product->image)
                        <div class="mb-10 group">
                            <div class="relative overflow-hidden rounded-[2rem] shadow-2xl bg-white border border-gray-100 max-h-[450px]">
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-full object-contain bg-gray-50 group-hover:scale-105 transition-transform duration-700">
                            </div>
                        </div>
                    @endif

                    {{-- DESKRIPSI LENGKAP --}}
                    <div class="prose prose-blue max-w-none">
                        <h4 class="text-[#161f36] font-black uppercase tracking-widest text-sm mb-4 flex items-center gap-2">
                            <span class="w-8 h-[2px] bg-[#FF7518]"></span>
                            Spesifikasi & Deskripsi
                        </h4>
                        <div class="text-gray-600 leading-relaxed text-sm lg:text-base space-y-4">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Sidebar (Sama dengan Fasilitas) --}}
                <div class="lg:w-1/3">
                    <div class="sticky top-28 space-y-8">

                        {{-- Kartu Info / CTA --}}
                        <div class="bg-[#161f36] rounded-[2rem] p-8 text-white relative overflow-hidden shadow-xl">
                            <div class="relative z-10">
                                <h3 class="text-lg font-bold mb-4 uppercase tracking-tight">Tertarik dengan Produk Ini?</h3>
                                <p class="text-gray-400 text-[10px] leading-relaxed mb-6 uppercase tracking-widest">
                                    Dapatkan penawaran harga terbaik dan konsultasi teknis gratis dengan tim ahli kami.
                                </p>
                                <a href="https://wa.me/62?text=Halo%20Admin%2C%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}"
                                   target="_blank"
                                   class="flex items-center justify-center gap-3 bg-[#FF7518] py-4 rounded-xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-orange-600 transition-all shadow-lg shadow-orange-500/20">
                                    <i class="fab fa-whatsapp text-lg"></i> Hubungi WhatsApp
                                </a>
                            </div>
                            <div class="absolute -bottom-10 -right-10 w-32 h-32 bg-white/5 rounded-full blur-2xl"></div>
                        </div>

                        {{-- Rekomendasi / Produk Lain --}}
                        <div class="bg-white rounded-[2rem] p-8 border border-gray-100 shadow-sm">
                            <h3 class="text-[#161f36] font-black uppercase tracking-widest text-xs mb-6 pb-4 border-b border-gray-100">
                                Rekomendasi Lain
                            </h3>

                            <div class="space-y-6">
                                @forelse ($recommended_products as $item)
                                    <a href="{{ route('product.show', $item->id) }}" class="group flex items-center gap-4">
                                        <div class="w-16 h-16 flex-shrink-0 rounded-xl overflow-hidden bg-gray-100 border border-gray-100">
                                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-[9px] font-black text-[#FF7518] uppercase tracking-widest mb-1 italic">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                            <h4 class="text-xs font-bold text-[#161f36] group-hover:text-[#FF7518] transition-colors line-clamp-1 uppercase">
                                                {{ $item->name }}
                                            </h4>
                                        </div>
                                    </a>
                                @empty
                                    <p class="text-gray-400 text-[10px] uppercase text-center italic">Tidak ada produk lain</p>
                                @endforelse
                            </div>

                            <a href="{{ route('products') }}" class="mt-8 flex items-center justify-center w-full py-3 border-2 border-[#161f36] text-[#161f36] rounded-xl text-[9px] font-black uppercase tracking-[0.2em] hover:bg-[#161f36] hover:text-white transition-all">
                                Katalog Lengkap
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<style>
    .prose h4 { margin-top: 2rem; }
    .prose p { margin-bottom: 1.5rem; }
    /* Custom scrollbar matching the theme */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #f9f9f9; }
    ::-webkit-scrollbar-thumb { background: #161f36; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #FF7518; }
</style>
@endsection
