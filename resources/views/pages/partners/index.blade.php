@extends('layouts.app')
@section('title', 'Mitra Industri - PT. Rizqallah Boer Makmur')

@section('content')
{{-- Library pendukung --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

<div class="bg-[#F4F7FA] min-h-screen font-['Poppins'] text-[#161f36] overflow-x-hidden"
     x-data="{
        activeSector: 'all',
        search: '',
        isVisible(sector, name) {
            const matchSector = this.activeSector === 'all' || sector === this.activeSector;
            const matchSearch = name.toLowerCase().includes(this.search.toLowerCase());
            return matchSector && matchSearch;
        }
     }">

    {{-- 🌌 HERO SECTION: BOLD & DARK (Konsisten dengan About) --}}
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-[#161f36] text-white overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#FF7518]/10 -skew-x-12 translate-x-1/3"></div>
        <div class="container mx-auto px-6 relative z-10 text-center lg:text-left">
            <div class="max-w-4xl">
                <span class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[#FF7518] text-[10px] font-black uppercase tracking-[0.3em] mb-6" data-aos="fade-right">
                    Our Ecosystem
                </span>
                <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight leading-tight mb-6" data-aos="fade-up">
                    Jaringan Mitra <br><span class="text-[#FF7518]">Strategis & Global</span>
                </h1>
                <p class="text-gray-400 text-sm md:text-lg max-w-2xl leading-relaxed font-medium uppercase tracking-widest" data-aos="fade-up" data-aos-delay="100">
                    “Berkolaborasi dengan entitas terbaik untuk menjamin keunggulan infrastruktur.”
                </p>
            </div>
        </div>
    </section>

    {{-- 🛠️ FILTER & SEARCH BAR (Sticky & Sharp) --}}
    <section class="relative z-30 -mt-10">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-[2rem] shadow-2xl border border-gray-100 p-4 md:p-6 flex flex-col lg:flex-row items-center justify-between gap-6" data-aos="zoom-in">

                {{-- Tabs Filter --}}
                <div class="flex flex-wrap justify-center gap-2 p-1.5 bg-gray-100 rounded-2xl w-full lg:w-auto">
                    <button @click="activeSector = 'all'"
                        :class="activeSector === 'all' ? 'bg-[#161f36] text-white shadow-lg' : 'text-gray-400 hover:text-[#161f36]'"
                        class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300">
                        Semua Mitra
                    </button>
                    <button @click="activeSector = 'TOWER PROVIDER'"
                        :class="activeSector === 'TOWER PROVIDER' ? 'bg-[#161f36] text-white shadow-lg' : 'text-gray-400 hover:text-[#161f36]'"
                        class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300">
                        Tower Provider
                    </button>
                    <button @click="activeSector = 'NON TOWER PROVIDER'"
                        :class="activeSector === 'NON TOWER PROVIDER' ? 'bg-[#161f36] text-white shadow-lg' : 'text-gray-400 hover:text-[#161f36]'"
                        class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300">
                        Non-Tower
                    </button>
                </div>

                {{-- Search Box --}}
                <div class="relative w-full lg:w-80 group">
                    <input type="text" x-model="search" placeholder="CARI NAMA MITRA..."
                        class="w-full pl-12 pr-6 py-4 rounded-xl bg-gray-50 border-none focus:ring-2 focus:ring-[#FF7518] text-xs font-bold tracking-widest uppercase transition-all">
                    <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-[#FF7518]"></i>
                </div>
            </div>
        </div>
    </section>

    {{-- 📦 PARTNERS GRID --}}
    <section class="py-20 min-h-[600px]">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($partners as $partner)
                <div
                    x-show="isVisible('{{ $partner->sector }}', '{{ $partner->name }}')"
                    x-transition:enter="transition ease-out duration-400"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    class="group bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 flex flex-col"
                    data-aos="fade-up"
                >
                    {{-- Logo Area --}}
                    <div class="w-full h-40 flex items-center justify-center mb-8 bg-gray-50 rounded-[2rem] p-6 group-hover:bg-white transition-colors duration-500 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-[#FF7518]/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>

                        @if ($partner->logo)
                            <img src="{{ Storage::url($partner->logo) }}"
                                 class="max-h-full max-w-full object-contain filter grayscale group-hover:grayscale-0 transition-all duration-700 scale-90 group-hover:scale-110"
                                 alt="{{ $partner->name }}">
                        @else
                            <div class="text-gray-200 flex flex-col items-center">
                                <i class="fas fa-building text-4xl mb-2"></i>
                                <span class="text-[8px] font-black uppercase tracking-[0.3em]">No Identity</span>
                            </div>
                        @endif
                    </div>

                    {{-- Partner Info --}}
                    <div class="flex-grow">
                        <div class="flex items-center gap-2 mb-4">
                            <span class="w-2 h-2 rounded-full {{ $partner->sector === 'TOWER PROVIDER' ? 'bg-blue-500' : 'bg-[#FF7518]' }}"></span>
                            <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">{{ $partner->sector }}</span>
                        </div>
                        <h3 class="text-xl font-black text-[#161f36] uppercase leading-tight mb-3 group-hover:text-[#FF7518] transition-colors">
                            {{ $partner->name }}
                        </h3>
                        <p class="text-gray-400 text-xs leading-relaxed line-clamp-3 font-medium">
                            {{ $partner->description ?? 'Mitra profesional pendukung operasional dan pengembangan infrastruktur strategis.' }}
                        </p>
                    </div>

                    {{-- Card Footer --}}
                    <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                        <div>
                            <p class="text-[8px] font-black text-gray-300 uppercase tracking-widest">Base Location</p>
                            <p class="text-xs font-bold text-[#161f36]">{{ $partner->city ?? 'Indonesia' }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-[#161f36] text-white flex items-center justify-center group-hover:bg-[#FF7518] group-hover:rotate-[360deg] transition-all duration-700">
                            <i class="fas fa-arrow-right text-[10px]"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Empty State --}}
            <div x-show="search !== '' && !document.querySelector('.group[style*=\'display: none\']') === false"
                 class="py-24 text-center" x-cloak>
                <div class="w-20 h-20 bg-white shadow-xl rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-search text-gray-200 text-2xl"></i>
                </div>
                <h3 class="text-lg font-black text-gray-400 uppercase tracking-[0.3em]">Data Tidak Ditemukan</h3>
            </div>
        </div>
    </section>

    {{-- 📞 FINAL CTA (Konsisten dengan About) --}}
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="relative bg-[#161f36] rounded-[3rem] p-10 md:p-20 text-center overflow-hidden shadow-2xl shadow-navy-900/40" data-aos="zoom-in">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FF7518 1px, transparent 1px); background-size: 30px 30px;"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight mb-6">Siap Menjadi <span class="text-[#FF7518]">Partner Kami?</span></h2>
                    <p class="text-gray-400 text-sm md:text-base max-w-2xl mx-auto mb-12 uppercase tracking-widest leading-relaxed">
                        Kami terbuka untuk kolaborasi jangka panjang dalam pengerjaan proyek infrastruktur di seluruh wilayah Indonesia.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-4 bg-[#FF7518] text-white px-10 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-orange-500/20 hover:bg-orange-600 hover:scale-105 transition-all">
                        Jalin Kerja Sama <i class="fas fa-handshake"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Script AOS --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-back'
        });
    });
</script>

<style>
    [x-cloak] { display: none !important; }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
