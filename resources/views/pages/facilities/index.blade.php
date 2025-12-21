@extends('layouts.app')

@section('title', 'Katalog Fasilitas - PT. RBM')

@section('content')
{{-- Load Scripts --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="bg-[#F9FBFF] min-h-screen font-['Poppins'] text-[#1A202C]"
     x-data="{ activeTab: 'all', search: '' }">

    {{-- 🌌 HERO SECTION --}}
    @php
        $heroBg = $facilities->count() > 0 ? Storage::url($facilities->first()->image) : 'https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=2070';
    @endphp

    <section class="relative h-[35vh] lg:h-[45vh] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ $heroBg }}" class="w-full h-full object-cover scale-105 animate-slow-zoom" alt="Hero">
            <div class="absolute inset-0 bg-gradient-to-b from-[#161f36]/90 via-[#161f36]/70 to-[#F9FBFF]"></div>
        </div>
        <div class="relative z-10 text-center px-6" data-aos="fade-up">
            <span class="inline-block py-1 px-4 rounded-full bg-[#FF7518] text-white font-bold text-[9px] tracking-[0.3em] uppercase mb-4 shadow-lg shadow-orange-500/20">
                Infrastruktur & Aset
            </span>
            <h1 class="text-3xl md:text-6xl font-black text-white mb-2 tracking-tight uppercase">
                Our <span class="text-[#FF7518]">Facilities</span>
            </h1>
        </div>
    </section>

    {{-- 🏷️ STICKY FILTER & SEARCH BAR (Sinkron dengan Form Input) --}}
    <div class="sticky top-16 lg:top-20 z-40 max-w-6xl mx-auto px-4 -mt-8">
        <div class="bg-white/95 backdrop-blur-xl p-2 rounded-2xl lg:rounded-[2.5rem] shadow-2xl border border-white/50 flex flex-col md:flex-row gap-2">

            {{-- Search Input --}}
            <div class="relative flex-1 group">
                <span class="absolute inset-y-0 left-5 flex items-center text-[#FF7518]">
                    <i class="fas fa-search text-sm"></i>
                </span>
                <input type="text" x-model="search" placeholder="Cari nama alat atau spesifikasi..."
                       class="w-full pl-12 pr-4 py-3 bg-gray-50 border-none rounded-xl lg:rounded-3xl text-sm focus:ring-2 focus:ring-[#FF7518]/20 transition-all font-medium text-[#161f36]">
            </div>

            {{-- Tab Buttons (Sesuaikan dengan value di Form) --}}
            <div class="flex items-center gap-1 bg-gray-50 p-1 rounded-xl lg:rounded-3xl overflow-x-auto no-scrollbar">
                <button @click="activeTab = 'all'"
                    :class="activeTab === 'all' ? 'bg-[#161f36] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                    class="whitespace-nowrap px-5 lg:px-8 py-2.5 rounded-lg lg:rounded-[2rem] text-[10px] lg:text-xs font-black transition-all duration-300 uppercase tracking-widest">
                    Semua
                </button>
                <button @click="activeTab = 'Peralatan Pabrikas'"
                    :class="activeTab === 'Peralatan Pabrikas' ? 'bg-[#FF7518] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                    class="whitespace-nowrap px-5 lg:px-8 py-2.5 rounded-lg lg:rounded-[2rem] text-[10px] lg:text-xs font-black transition-all duration-300 uppercase tracking-widest">
                    Pabrikasi
                </button>
                <button @click="activeTab = 'Peralatan Maintenance'"
                    :class="activeTab === 'Peralatan Maintenance' ? 'bg-[#FF7518] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                    class="whitespace-nowrap px-5 lg:px-8 py-2.5 rounded-lg lg:rounded-[2rem] text-[10px] lg:text-xs font-black transition-all duration-300 uppercase tracking-widest">
                    Maintenance
                </button>
                <button @click="activeTab = 'Kendaraan Operasional'"
                    :class="activeTab === 'Kendaraan Operasional' ? 'bg-[#FF7518] text-white shadow-md' : 'text-gray-500 hover:bg-white'"
                    class="whitespace-nowrap px-5 lg:px-8 py-2.5 rounded-lg lg:rounded-[2rem] text-[10px] lg:text-xs font-black transition-all duration-300 uppercase tracking-widest">
                    Kendaraan
                </button>
            </div>
        </div>
    </div>

    {{-- 🏗️ CONTENT SECTION --}}
    <section class="py-12 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 space-y-20">

            @php
                $categories = [
                    'Peralatan Pabrikasi' => 'Peralatan Pabrikas',
                    'Peralatan Maintenance' => 'Peralatan Maintenance',
                    'Kendaraan Operasional' => 'Kendaraan Operasional'
                ];
            @endphp

            @foreach($categories as $displayTitle => $dbValue)
                @php $items = $facilities->where('type', $dbValue); @endphp

                @if($items->count() > 0)
                <div x-show="activeTab === 'all' || activeTab === '{{ $dbValue }}'"
                     class="space-y-8"
                     x-transition:enter="transition ease-out duration-500">

                    {{-- Judul Kategori Otomatis --}}
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-[#FF7518] rounded-full"></div>
                            <h2 class="text-xl md:text-2xl font-black text-[#161f36] uppercase tracking-tight">{{ $displayTitle }}</h2>
                        </div>
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest bg-white px-3 py-1 rounded-full border border-gray-100">
                            {{ $items->count() }} Unit
                        </span>
                    </div>

                    {{-- Grid Kartu --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                        @foreach($items as $facility)
                        <div x-show="search === '' || '{{ strtolower($facility->name . ' ' . $facility->description) }}'.includes(search.toLowerCase())"
                             class="group bg-white rounded-[2rem] overflow-hidden border border-gray-50 shadow-sm hover:shadow-2xl transition-all duration-500"
                             data-aos="fade-up">

                            {{-- Foto --}}
                            <div class="relative aspect-square overflow-hidden bg-gray-100">
                                <img src="{{ Storage::url($facility->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute top-4 left-4">
                                    <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest text-[#FF7518] border border-orange-100">
                                        {{ $facility->type }}
                                    </span>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="p-6">
                                <h3 class="text-base font-black text-[#161f36] mb-2 group-hover:text-[#FF7518] transition-colors uppercase leading-tight">
                                    {{ $facility->name }}
                                </h3>
                                <p class="text-gray-500 text-xs leading-relaxed mb-6 line-clamp-2 italic">
                                    "{{ $facility->description }}"
                                </p>
                                <div class="pt-5 border-t border-gray-50 flex items-center justify-between">
                                    <span class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">
                                        ID: {{ str_pad($facility->id, 3, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <a href="{{ route('facilities.show', $facility->id) }}" class="w-8 h-8 bg-[#161f36] text-white rounded-lg flex items-center justify-center hover:bg-[#FF7518] transition-all">
                                        <i class="fas fa-arrow-right text-[10px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            @endforeach

            {{-- 🔍 EMPTY SEARCH STATE --}}
            <div x-show="search !== '' && !document.querySelector('.group:not([style*=\'display: none\'])')"
                 class="py-20 text-center bg-white rounded-[3rem] shadow-sm border border-dashed border-gray-200">
                <i class="fas fa-search-minus fa-3x text-gray-200 mb-4"></i>
                <h3 class="text-lg font-bold text-gray-400 italic">Data tidak ditemukan untuk "<span x-text="search" class="text-[#FF7518]"></span>"</h3>
            </div>

        </div>
    </section>
</div>

<style>
    @keyframes slow-zoom { 0% { transform: scale(1); } 50% { transform: scale(1.08); } 100% { transform: scale(1); } }
    .animate-slow-zoom { animation: slow-zoom 20s infinite ease-in-out; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    html { scroll-behavior: smooth; }
</style>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>
@endsection
