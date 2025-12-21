@extends('layouts.app')
@section('title', 'Galeri Proyek & Portofolio - PT. RBM')

@section('content')
{{-- Library Assets --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" />
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="bg-[#F4F7FA] min-h-screen font-['Poppins'] text-[#161f36] selection:bg-[#FF7518]/30"
     x-data="{
        activeFilter: 'all',
        items: [
            @foreach($galleries as $gallery)
            {
                id: {{ $gallery->id }},
                cat: '{{ strtolower($gallery->category ?? 'umum') }}',
                img: '{{ asset('storage/'.$gallery->image) }}',
                title: '{{ $gallery->caption ?? 'Proyek PT. RBM' }}'
            },
            @endforeach
        ],
        get filteredItems() {
            if (this.activeFilter === 'all') return this.items;
            return this.items.filter(i => i.cat === this.activeFilter);
        }
     }">

    {{-- 🌌 HERO SECTION: DARK & BOLD (Matching About) --}}
    <section class="relative pt-32 pb-24 lg:pt-48 lg:pb-32 bg-[#161f36] text-white overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FF7518 1px, transparent 1px); background-size: 40px 40px;"></div>
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#FF7518]/5 -skew-x-12 translate-x-1/3"></div>

        <div class="relative z-10 container mx-auto px-6 text-center">
            <span class="inline-block px-5 py-2 bg-white/5 backdrop-blur-md border border-white/10 rounded-full text-[#FF7518] text-[10px] font-black uppercase tracking-[0.4em] mb-8" data-aos="fade-down">
                Project Showcase
            </span>
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white uppercase tracking-tight leading-none mb-8" data-aos="fade-up">
                Visualisasi <span class="text-[#FF7518]">Kinerja</span>
            </h1>
            <p class="text-gray-400 text-xs md:text-sm max-w-xl mx-auto uppercase tracking-[0.2em] leading-relaxed font-medium" data-aos="fade-up" data-aos-delay="100">
                Dokumentasi dedikasi kami dalam membangun infrastruktur telekomunikasi dan manajemen teknis terbaik di Indonesia.
            </p>
        </div>
    </section>

    {{-- 🛠️ STICKY NAVIGATION FILTER --}}
    <section class="sticky top-16 z-40 bg-white/80 backdrop-blur-xl border-b border-gray-100 shadow-sm">
        <div class="container mx-auto px-6 py-4">
            <div class="flex flex-wrap justify-center gap-2 md:gap-4">
                @php
                    $categories = ['all', 'tower', 'fabrikasi', 'maintenance', 'civil'];
                @endphp
                @foreach($categories as $cat)
                <button @click="activeFilter = '{{ $cat }}'"
                        :class="activeFilter === '{{ $cat }}' ? 'bg-[#161f36] text-white shadow-xl scale-105' : 'bg-gray-50 text-gray-400 hover:text-[#161f36] hover:bg-white'"
                        class="px-8 py-3 rounded-2xl text-[10px] font-black uppercase tracking-widest transition-all duration-500 border border-transparent">
                    {{ $cat }}
                </button>
                @endforeach
            </div>
        </div>
    </section>

    {{-- 🖼️ MASONRY-LIKE GRID --}}
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 min-h-[500px]">

                {{-- Loop Items with Alpine --}}
                <template x-for="(item, index) in filteredItems" :key="item.id">
                    <div
                        x-show="activeFilter === 'all' || activeFilter === item.cat"
                        x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 translate-y-12"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="group relative"
                    >
                        <div class="relative h-[450px] bg-white rounded-[2.5rem] overflow-hidden shadow-sm group-hover:shadow-2xl transition-all duration-700 group-hover:-translate-y-4">

                            {{-- Image --}}
                            <img :src="item.img" :alt="item.title" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                            {{-- Advanced Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-[#161f36] via-[#161f36]/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-500"></div>

                            {{-- Content Bottom --}}
                            <div class="absolute inset-0 flex flex-col justify-end p-10 translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                                <div class="mb-4 overflow-hidden">
                                    <span class="inline-block px-3 py-1 bg-[#FF7518] text-white text-[8px] font-black uppercase tracking-widest rounded-lg mb-3 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-700" x-text="item.cat"></span>
                                    <h4 class="text-white text-xl font-bold leading-tight uppercase tracking-tight group-hover:text-[#FF7518] transition-colors" x-text="item.title"></h4>
                                </div>

                                <div class="flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity duration-700 delay-100">
                                    <a :href="item.img" data-lightbox="rbm-gallery" :data-title="item.title"
                                       class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-[#161f36] hover:bg-[#FF7518] hover:text-white transition-all shadow-xl">
                                        <i class="fas fa-expand-alt text-lg"></i>
                                    </a>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-tighter">View Project</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

            </div>

            {{-- Empty State --}}
            <div x-show="filteredItems.length === 0" x-cloak class="py-40 text-center" data-aos="zoom-in">
                <div class="w-24 h-24 bg-white rounded-[2rem] shadow-xl flex items-center justify-center mx-auto mb-8 border border-gray-100">
                    <i class="fas fa-camera-retro text-gray-200 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-400 uppercase tracking-widest">Gallery Empty</h3>
                <p class="text-gray-400 text-xs mt-4 uppercase tracking-[0.2em]">Dokumentasi sedang dalam proses pengunggahan.</p>
            </div>
        </div>
    </section>

    {{-- 📞 DARK CTA SECTION --}}
    <section class="py-24 px-6">
        <div class="container mx-auto">
            <div class="relative bg-[#161f36] rounded-[3.5rem] p-12 md:p-24 text-center overflow-hidden shadow-2xl" data-aos="flip-up">
                {{-- Decorative circles --}}
                <div class="absolute top-0 left-0 w-64 h-64 bg-[#FF7518]/10 rounded-full blur-[100px] -ml-32 -mt-32"></div>
                <div class="absolute bottom-0 right-0 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px] -mr-32 -mb-32"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight mb-8">Percayakan Proyek Anda <br> Kepada <span class="text-[#FF7518]">Ahlinya</span></h2>
                    <p class="text-gray-400 text-xs md:text-sm max-w-xl mx-auto mb-12 uppercase tracking-[0.3em] leading-relaxed">
                        Kami siap membantu mewujudkan infrastruktur berkualitas tinggi dengan standar manajemen premium.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('contact') }}" class="px-12 py-5 bg-[#FF7518] text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-orange-600/20 hover:bg-white hover:text-[#161f36] transition-all duration-500">
                            Konsultasi Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 800, once: true, easing: 'ease-out' });

        lightbox.option({
            'resizeDuration': 300,
            'wrapAround': true,
            'showImageNumberLabel': false,
            'imageFadeDuration': 500
        });
    });
</script>

<style>
    [x-cloak] { display: none !important; }

    /* Custom Lightbox Styling */
    .lightboxOverlay { background-color: rgba(22, 31, 54, 0.95) !important; opacity: 1 !important; }
    .lb-data .lb-caption { font-family: 'Poppins'; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #FF7518; }
    .lb-outerContainer { border-radius: 2rem; overflow: hidden; }

    /* Hide scrollbar but keep functionality */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
