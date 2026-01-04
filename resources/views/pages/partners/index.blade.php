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
                const matchSector = this.activeSector === 'all' || sector.toUpperCase() === this.activeSector.toUpperCase();
                const matchSearch = name.toLowerCase().includes(this.search.toLowerCase());
                return matchSector && matchSearch;
            }
        }">

        {{-- 🌌 HERO SECTION --}}
        <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-[#161f36] text-white overflow-hidden">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-[#FF7518]/10 -skew-x-12 translate-x-1/3"></div>
            <div class="container mx-auto px-6 relative z-10 text-center lg:text-left">
                <div class="max-w-4xl">
                    <span class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[#FF7518] text-[10px] font-black uppercase tracking-[0.3em] mb-6" data-aos="fade-right">
                        Partnership Network
                    </span>
                    <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight leading-tight mb-6" data-aos="fade-up">
                        Kolaborasi <br><span class="text-[#FF7518]">Lintas Industri</span>
                    </h1>
                    <p class="text-gray-400 text-sm md:text-lg max-w-2xl leading-relaxed font-medium uppercase tracking-widest" data-aos="fade-up" data-aos-delay="100">
                        Membangun infrastruktur masa depan bersama mitra penyedia tower dan solusi teknologi terbaik.
                    </p>
                </div>
            </div>
        </section>

        {{-- 🛠️ FILTER & SEARCH BAR --}}
        <section class="relative z-30 -mt-10">
            <div class="container mx-auto px-6">
                <div class="bg-white rounded-[2rem] shadow-2xl border border-gray-100 p-4 md:p-6 flex flex-col lg:flex-row items-center justify-between gap-6" data-aos="zoom-in">
                    <div class="flex flex-wrap justify-center gap-2 p-1.5 bg-gray-100 rounded-2xl w-full lg:w-auto">
                        <button @click="activeSector = 'all'"
                            :class="activeSector === 'all' ? 'bg-[#161f36] text-white shadow-lg' : 'text-gray-400 hover:text-[#161f36]'"
                            class="px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300">
                            Semua
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

                    <div class="relative w-full lg:w-80 group">
                        <input type="text" x-model="search" placeholder="CARI MITRA..."
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
                    @forelse ($partners as $partner)
                        <div x-show="isVisible('{{ $partner->sector }}', '{{ $partner->name }}')"
                            x-transition:enter="transition ease-out duration-400"
                            class="group bg-white rounded-[2.5rem] border border-gray-100 p-8 shadow-sm hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 flex flex-col"
                            data-aos="fade-up" x-cloak>

                            {{-- Logo Area - Warna Asli & Link ke Public Show --}}
                            <a href="{{ route('partners.show', $partner->id) }}" class="w-full h-44 flex items-center justify-center mb-6 bg-white rounded-[2rem] p-6 shadow-inner transition-all duration-500 relative overflow-hidden border border-gray-50">
                                @php
                                    $logoPath = $partner->logo;
                                    if (!$logoPath) {
                                        $finalUrl = null;
                                    } elseif (Str::startsWith($logoPath, ['http', 'cloudinary'])) {
                                        $finalUrl = $logoPath;
                                    } elseif (Str::startsWith($logoPath, 'assets/')) {
                                        $finalUrl = asset($logoPath);
                                    } else {
                                        $finalUrl = asset('storage/' . $logoPath);
                                    }
                                @endphp

                                @if ($finalUrl)
                                    <img src="{{ $finalUrl }}"
                                        class="max-h-full max-w-full object-contain transition-all duration-700 scale-100 group-hover:scale-110"
                                        alt="{{ $partner->name }}">
                                @else
                                    <div class="text-gray-200 flex flex-col items-center">
                                        <i class="fas fa-building text-4xl mb-2 text-gray-300"></i>
                                        <span class="text-[8px] font-black uppercase tracking-[0.3em] text-gray-400">No Image</span>
                                    </div>
                                @endif
                            </a>

                            {{-- Partner Info --}}
                            <div class="flex-grow">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="w-2 h-2 rounded-full {{ strtoupper($partner->sector) === 'TOWER PROVIDER' ? 'bg-blue-500' : 'bg-[#FF7518]' }}"></span>
                                    <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400">{{ $partner->sector }}</span>
                                </div>
                                <h3 class="text-lg font-black text-[#161f36] uppercase leading-tight mb-3 group-hover:text-[#FF7518] transition-colors">
                                    {{ $partner->name }}
                                </h3>
                                <p class="text-gray-500 text-xs leading-relaxed line-clamp-3 font-medium">
                                    {{ $partner->description ?? 'Mitra strategis dalam pengembangan infrastruktur telekomunikasi.' }}
                                </p>
                            </div>

                            {{-- Card Footer --}}
                            <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                                <div>
                                    <p class="text-[8px] font-black text-gray-300 uppercase tracking-widest">Base City</p>
                                    <p class="text-xs font-bold text-[#161f36]">{{ $partner->city ?? 'Indonesia' }}</p>
                                </div>
                                {{-- Link ke Public Show --}}
                                <a href="{{ route('partners.show', $partner->id) }}" class="w-10 h-10 rounded-xl bg-[#161f36] text-white flex items-center justify-center hover:bg-[#FF7518] transition-all duration-300 shadow-md">
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-24 text-center">
                             <i class="fas fa-folder-open text-4xl text-gray-200 mb-4"></i>
                             <h3 class="text-lg font-black text-gray-400 uppercase tracking-[0.3em]">Data Belum Tersedia</h3>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 800, once: true });
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
