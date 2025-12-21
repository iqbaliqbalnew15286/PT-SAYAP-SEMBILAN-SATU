@extends('layouts.app')
@section('title', 'Tentang Kami - PT. Rizqallah Boer Makmur')

@section('content')
{{-- Google Fonts, Alpine.js, & AOS --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="bg-[#F4F7FA] min-h-screen font-['Poppins'] text-[#161f36] overflow-x-hidden">

    @php
        $about = \App\Models\About::first();
        $vision = $about?->vision ?? 'Menjadi perusahaan manajemen dan layanan teknis terdepan di Asia Tenggara yang dikenal atas keunggulan dan integritas.';
        $mission = $about?->mission ?? 'Menyediakan solusi yang inovatif dan terintegrasi. Membangun kemitraan jangka panjang berbasis kepercayaan. Mendorong pertumbuhan berkelanjutan bagi klien dan perusahaan.';
        $goal = $about?->goal ?? 'Integritas | Inovasi | Kualitas Premium | Fokus pada Klien';
        $title = $about?->title ?? 'Mitra Solusi Manajemen Terpercaya';
        $description = $about?->description ?? 'PT. Rizqallah Boer Makmur (RBM) hadir sebagai penyedia layanan dan produk premium yang berfokus pada efisiensi, inovasi, dan hasil yang optimal. Didukung oleh tim yang berpengalaman dan berdedikasi, kami berkomitmen untuk memberikan nilai tambah nyata bagi setiap proyek.';
    @endphp

    {{-- 🌌 HERO SECTION: BOLD & CLEAN --}}
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 bg-[#161f36] text-white overflow-hidden">
        <div class="absolute top-0 right-0 w-1/2 h-full bg-[#FF7518]/10 -skew-x-12 translate-x-1/3"></div>
        <div class="container mx-auto px-6 relative z-10 text-center lg:text-left">
            <div class="max-w-4xl">
                <span class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[#FF7518] text-[10px] font-black uppercase tracking-[0.3em] mb-6" data-aos="fade-right">
                    Establish in 2025
                </span>
                <h1 class="text-4xl md:text-6xl font-black uppercase tracking-tight leading-tight mb-6" data-aos="fade-up">
                    Dedikasi, Inovasi & <span class="text-[#FF7518]">Kualitas Premium</span>
                </h1>
                <p class="text-gray-400 text-sm md:text-lg max-w-2xl leading-relaxed font-medium uppercase tracking-widest" data-aos="fade-up" data-aos-delay="100">
                    “Membangun masa depan layanan manajemen dan teknis bersama Anda.”
                </p>
            </div>
        </div>
    </section>

    {{-- 🏗️ STORY SECTION: SPLIT LAYOUT --}}
    <section class="py-20 -mt-10 relative z-20">
        <div class="container mx-auto px-6">
            <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 flex flex-col lg:flex-row">
                {{-- Image Part --}}
                <div class="lg:w-1/2 relative group" data-aos="fade-right">
                    <img src="{{ $about?->image ? asset('storage/'.$about->image) : asset('assets/img/staff_kolase.jpg') }}"
                         class="w-full h-[400px] lg:h-full object-cover transition-transform duration-700 group-hover:scale-105" alt="RBM Team">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#161f36]/60 to-transparent opacity-60"></div>
                </div>
                {{-- Text Part --}}
                <div class="lg:w-1/2 p-10 lg:p-20 flex flex-col justify-center" data-aos="fade-left">
                    <h2 class="text-[10px] font-black text-[#FF7518] uppercase tracking-[0.4em] mb-4">Profil Perusahaan</h2>
                    <h3 class="text-3xl font-black text-[#161f36] uppercase leading-tight mb-8">
                        {{ $title }}
                    </h3>
                    <p class="text-gray-500 text-sm md:text-base leading-relaxed mb-10">
                        {{ $description }}
                    </p>
                    {{-- Quick Stats --}}
                    <div class="grid grid-cols-2 gap-8 border-t border-gray-100 pt-10">
                        <div>
                            <p class="text-3xl font-black text-[#161f36]">100%</p>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Kualitas Terjamin</p>
                        </div>
                        <div>
                            <p class="text-3xl font-black text-[#FF7518]">24/7</p>
                            <p class="text-[9px] font-bold text-gray-400 uppercase tracking-widest">Dukungan Teknis</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 🎯 VISI MISI: INTERACTIVE TABS --}}
    <section class="py-20 bg-white" x-data="{ tab: 'visi' }">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-black text-[#161f36] uppercase tracking-tight mb-16" data-aos="fade-up">Arah & <span class="text-[#FF7518]">Filosofi</span> Kami</h2>

            <div class="max-w-5xl mx-auto">
                {{-- Tabs Header --}}
                <div class="flex justify-center gap-2 md:gap-6 mb-12 p-2 bg-[#F4F7FA] rounded-2xl md:rounded-full w-fit mx-auto" data-aos="fade-up">
                    <button @click="tab = 'visi'"
                        :class="tab === 'visi' ? 'bg-[#161f36] text-white shadow-xl' : 'text-gray-400 hover:text-[#161f36]'"
                        class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">
                        Visi
                    </button>
                    <button @click="tab = 'misi'"
                        :class="tab === 'misi' ? 'bg-[#161f36] text-white shadow-xl' : 'text-gray-400 hover:text-[#161f36]'"
                        class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">
                        Misi
                    </button>
                    <button @click="tab = 'nilai'"
                        :class="tab === 'nilai' ? 'bg-[#161f36] text-white shadow-xl' : 'text-gray-400 hover:text-[#161f36]'"
                        class="px-8 py-3 rounded-full text-[10px] font-black uppercase tracking-widest transition-all">
                        Nilai Inti
                    </button>
                </div>

                {{-- Tab Panels --}}
                <div class="relative min-h-[300px]" data-aos="zoom-in">
                    {{-- Visi --}}
                    <div x-show="tab === 'visi'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" class="bg-[#F4F7FA] p-10 lg:p-16 rounded-[3rem] relative overflow-hidden">
                        <i class="fas fa-eye absolute -right-4 -bottom-4 text-[150px] text-gray-200 opacity-20"></i>
                        <p class="text-xl md:text-3xl font-medium italic text-[#161f36] leading-relaxed relative z-10 text-center">
                            "{{ $vision }}"
                        </p>
                    </div>

                    {{-- Misi --}}
                    <div x-show="tab === 'misi'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" class="bg-[#F4F7FA] p-10 lg:p-16 rounded-[3rem] text-left">
                        <div class="grid md:grid-cols-2 gap-6 relative z-10">
                            @foreach (explode('.', $mission) as $index => $item)
                                @if (trim($item))
                                <div class="flex gap-4 p-4 bg-white rounded-2xl shadow-sm border border-gray-100">
                                    <span class="w-8 h-8 rounded-lg bg-[#FF7518] text-white flex items-center justify-center font-black text-xs">{{ $index + 1 }}</span>
                                    <p class="text-sm text-gray-600 font-medium">{{ trim($item) }}</p>
                                </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Nilai Inti --}}
                    <div x-show="tab === 'nilai'" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-4" class="bg-[#F4F7FA] p-10 lg:p-16 rounded-[3rem]">
                         <div class="flex flex-wrap justify-center gap-4">
                            @foreach(explode('|', $goal) as $val)
                                <div class="px-8 py-6 bg-white rounded-2xl shadow-sm border-b-4 border-[#FF7518] group hover:-translate-y-2 transition-all">
                                    <p class="text-sm font-black text-[#161f36] uppercase tracking-widest">{{ trim($val) }}</p>
                                </div>
                            @endforeach
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- 📞 FINAL CTA --}}
    <section class="py-20">
        <div class="container mx-auto px-6">
            <div class="relative bg-[#161f36] rounded-[3rem] p-10 md:p-20 text-center overflow-hidden shadow-2xl shadow-navy-900/40" data-aos="zoom-in">
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#FF7518 1px, transparent 1px); background-size: 30px 30px;"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-5xl font-black text-white uppercase tracking-tight mb-6">Mulai Transformasi <span class="text-[#FF7518]">Hari Ini</span></h2>
                    <p class="text-gray-400 text-sm md:text-base max-w-2xl mx-auto mb-12 uppercase tracking-widest leading-relaxed">
                        Siap melangkah bersama mitra manajemen terbaik? Tim ahli kami siap mendiskusikan visi proyek Anda.
                    </p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-4 bg-[#FF7518] text-white px-10 py-5 rounded-2xl font-black text-xs uppercase tracking-[0.2em] shadow-xl shadow-orange-500/20 hover:bg-orange-600 hover:scale-105 transition-all">
                        Hubungi Tim Ahli <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
</style>
@endsection
