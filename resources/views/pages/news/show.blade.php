@extends('layouts.app')

@section('content')
@php
    $brandOrange = '#FF7518';
    $brandDark = '#161f36';

    $hasGallery = isset($newsImages) && $newsImages->isNotEmpty();

    // ✅ SAFE fallback hero
    $fallbackHero = collect($randomNews ?? [])
        ->filter(fn($n) => !empty($n->image))
        ->first();
@endphp

<div class="bg-white">

{{-- ================= HERO IMAGE ================= --}}
<header class="w-full h-[300px] lg:h-[500px] bg-[#161f36] overflow-hidden relative">

    @if (!empty($news->image))
        <img src="{{ asset('storage/'.$news->image) }}"
             alt="{{ $news->title }}"
             class="w-full h-full object-cover opacity-90">

    @elseif ($fallbackHero)
        <img src="{{ asset('storage/'.$fallbackHero->image) }}"
             alt="{{ $fallbackHero->title }}"
             class="w-full h-full object-cover opacity-90">

    @else
        <div class="w-full h-full flex items-center justify-center bg-gray-800">
            <i class="far fa-image text-6xl text-gray-500"></i>
        </div>
    @endif

    <div class="absolute inset-0 bg-gradient-to-t from-[#161f36] to-transparent opacity-50"></div>
</header>

{{-- ================= BREADCRUMB ================= --}}
<div class="bg-[#2D2D2D] py-3">
    <div class="max-w-screen-xl mx-auto px-4">
        <nav>
            <ol class="flex items-center space-x-2 text-sm text-gray-300">
                <li><a href="/" class="hover:text-[#FF7518]">Home</a></li>
                <li><i class="fas fa-chevron-right text-[10px]"></i></li>
                <li><a href="{{ route('news.index') }}" class="hover:text-[#FF7518]">Berita</a></li>
                <li><i class="fas fa-chevron-right text-[10px]"></i></li>
                <li class="text-[#FF7518] font-semibold truncate">{{ $news->title }}</li>
            </ol>
        </nav>
    </div>
</div>

{{-- ================= MAIN CONTENT ================= --}}
<div class="max-w-screen-xl mx-auto px-4 py-10 lg:py-16">
<div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

{{-- ================= KONTEN ================= --}}
<div class="lg:col-span-2">

<a href="{{ route('news.index') }}"
   class="inline-flex items-center text-sm font-semibold text-gray-500 hover:text-[#FF7518] mb-6">
    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Berita
</a>

{{-- FOTO BERITA (dari index) --}}
@if (!empty($news->image))
<div class="mb-8">
    <img src="{{ asset('storage/'.$news->image) }}"
         alt="{{ $news->title }}"
         class="w-full rounded-2xl shadow-md">
</div>
@endif

{{-- JUDUL --}}
<h1 class="text-3xl lg:text-5xl font-bold text-[#161f36] mb-6 leading-tight">
    {{ $news->title }}
</h1>

{{-- META --}}
<div class="flex flex-wrap gap-6 text-sm border-y py-4 mb-8">
    <div class="flex items-center text-gray-600">
        <div class="w-8 h-8 bg-orange-100 text-[#FF7518] rounded-full flex items-center justify-center mr-3">
            <i class="far fa-calendar-alt"></i>
        </div>
        {{ \Carbon\Carbon::parse($news->date_published)->translatedFormat('d F Y') }}
    </div>

    <div class="flex items-center text-gray-600">
        <div class="w-8 h-8 bg-blue-100 text-[#161f36] rounded-full flex items-center justify-center mr-3">
            <i class="far fa-user"></i>
        </div>
        Penulis: <strong class="ml-1">{{ $news->publisher ?? 'Admin' }}</strong>
    </div>
</div>

{{-- DESKRIPSI FULL --}}
<article class="prose prose-lg max-w-none news-body mb-12">
    {!! $news->description !!}
</article>

{{-- GALERI --}}
@if ($hasGallery)
<div class="pt-10 border-t" x-data="{ open:false, img:'' }">
    <h3 class="text-2xl font-bold mb-6 text-[#161f36]">
        <span class="w-2 h-8 bg-[#FF7518] inline-block mr-3 rounded-full"></span>
        Galeri Foto
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @foreach ($newsImages as $img)
        <div @click="img='{{ asset('storage/'.$img->path) }}';open=true"
             class="aspect-square rounded-xl overflow-hidden cursor-pointer bg-gray-100">
            <img src="{{ asset('storage/'.$img->path) }}"
                 class="w-full h-full object-cover hover:scale-110 transition">
        </div>
        @endforeach
    </div>

    <div x-show="open"
         class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center"
         @click.self="open=false">
        <img :src="img" class="max-h-[90vh] rounded-xl">
    </div>
</div>
@endif

</div>

{{-- ================= SIDEBAR ================= --}}
<aside class="lg:col-span-1">
<div class="sticky top-10 space-y-8">

<div class="bg-white border rounded-2xl p-6 shadow-sm">
    <h3 class="text-xl font-bold border-b-2 border-[#FF7518] inline-block mb-6">
        Baca Juga
    </h3>

    @foreach ($randomNews ?? [] as $item)
        <a href="{{ route('news.show',$item->id) }}" class="flex gap-4 mb-5 group">
            <div class="w-20 h-20 rounded-lg overflow-hidden bg-gray-100">
                @if (!empty($item->image))
                    <img src="{{ asset('storage/'.$item->image) }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">
                        No Image
                    </div>
                @endif
            </div>
            <div>
                <h4 class="text-sm font-bold group-hover:text-[#FF7518] line-clamp-2">
                    {{ $item->title }}
                </h4>
                <p class="text-xs text-gray-500 mt-1">
                    {{ \Carbon\Carbon::parse($item->date_published)->diffForHumans() }}
                </p>
            </div>
        </a>
    @endforeach
</div>

</div>
</aside>

</div>
</div>
</div>

<style>
.news-body img{border-radius:1rem;margin:2rem 0}
.news-body h2{font-weight:700;color:#161f36}
.news-body a{color:#FF7518;text-decoration:underline}
</style>

@endsection
