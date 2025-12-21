@extends('layouts.app')

@section('title', 'Pusat Bantuan - PT. RBM')

@section('content')
{{-- Google Fonts, Alpine.js, & AOS --}}
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<div class="bg-[#F4F7FA] min-h-screen font-['Poppins'] text-[#161f36]"
     x-data="{
        search: '',
        activeTab: 'umum',
        activeFaq: null,
        faqs: [
            { id: 1, cat: 'umum', q: 'DI MANA LOKASI KANTOR PUSAT PT. RBM?', a: 'Kantor pusat kami berlokasi di kawasan industri strategis Jakarta. Kami memiliki fasilitas workshop yang modern untuk mendukung operasional teknis.' },
            { id: 2, cat: 'umum', q: 'BAGAIMANA CARA MENGHUBUNGI TIM SALES?', a: 'Anda dapat menghubungi kami melalui tombol WhatsApp yang tersedia, atau melalui email resmi marketing kami di rbm.official@example.com.' },
            { id: 3, cat: 'layanan', q: 'APAKAH MELAYANI PROYEK DI LUAR PULAU JAWA?', a: 'Ya, jangkauan layanan kami mencakup seluruh wilayah Indonesia. Kami memiliki tim mobile yang siap dikirim ke lokasi proyek Anda.' },
            { id: 4, cat: 'teknis', q: 'APAKAH PRODUK TOWER MEMILIKI SERTIFIKASI?', a: 'Tentu. Semua produk fabrikasi kami melalui proses QC ketat dan memiliki sertifikasi standar industri internasional untuk keamanan dan durabilitas.' },
            { id: 5, cat: 'layanan', q: 'BERAPA LAMA ESTIMASI PENGERJAAN PROYEK?', a: 'Estimasi waktu sangat bergantung pada skala proyek. Namun, kami selalu memberikan timeline yang transparan sejak tahap awal konsultasi.' },
            { id: 6, cat: 'teknis', q: 'APAKAH BISA CUSTOM SPESIFIKASI ALAT?', a: 'Sangat bisa. Kami memiliki tim engineering yang ahli dalam merancang solusi kustom sesuai kebutuhan teknis spesifik di lapangan.' }
        ],
        get filteredFaqs() {
            return this.faqs.filter(f =>
                (this.activeTab === 'all' || f.cat === this.activeTab) &&
                f.q.toLowerCase().includes(this.search.toLowerCase())
            );
        }
     }">

    {{-- 🌌 MODERN HERO SECTION --}}
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-[#161f36]">
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="absolute top-0 left-0 w-96 h-96 bg-[#FF7518] rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full blur-[120px] translate-x-1/2 translate-y-1/2"></div>
        </div>

        <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
            <span class="inline-block px-4 py-1.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[#FF7518] text-[10px] font-black uppercase tracking-[0.3em] mb-6" data-aos="fade-up">
                Help Center
            </span>
            <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tight mb-8" data-aos="fade-up" data-aos-delay="100">
                Ada yang bisa kami <span class="text-[#FF7518]">Bantu?</span>
            </h1>

            {{-- 🔍 INTERACTIVE SEARCH BAR --}}
            <div class="relative max-w-2xl mx-auto group" data-aos="fade-up" data-aos-delay="200">
                <input type="text"
                       x-model="search"
                       placeholder="Cari pertanyaan Anda di sini..."
                       class="w-full px-8 py-5 bg-white rounded-2xl shadow-2xl text-[#161f36] placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-[#FF7518]/30 transition-all text-sm md:text-base">
                <div class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-[#FF7518] rounded-xl flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-search"></i>
                </div>
            </div>
        </div>
    </section>

    {{-- 🏗️ CONTENT SECTION --}}
    <section class="py-12 -mt-10 relative z-20">
        <div class="max-w-5xl mx-auto px-6">

            {{-- 📑 CATEGORY TABS --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12" data-aos="fade-up">
                <template x-for="tab in ['all', 'umum', 'teknis', 'layanan']">
                    <button @click="activeTab = tab; activeFaq = null"
                            class="px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all duration-300 border-2"
                            :class="activeTab === tab ? 'bg-[#FF7518] border-[#FF7518] text-white shadow-xl shadow-orange-500/20 translate-y-[-2px]' : 'bg-white border-white text-gray-400 hover:border-gray-200 shadow-sm'">
                        <span x-text="tab"></span>
                    </button>
                </template>
            </div>

            {{-- 🧩 FAQ ACCORDION LIST --}}
            <div class="space-y-4 min-h-[400px]">
                {{-- Empty State --}}
                <div x-show="filteredFaqs.length === 0" x-cloak class="text-center py-20 bg-white rounded-[2rem] border border-dashed border-gray-300">
                    <i class="fas fa-search text-gray-200 text-5xl mb-4"></i>
                    <p class="text-gray-400 font-bold uppercase tracking-widest text-xs">Pertanyaan tidak ditemukan</p>
                </div>

                <template x-for="faq in filteredFaqs" :key="faq.id">
                    <div class="group" data-aos="fade-up">
                        <button @click="activeFaq === faq.id ? activeFaq = null : activeFaq = faq.id"
                                class="w-full flex items-center justify-between p-6 bg-white rounded-2xl text-left transition-all duration-300 hover:shadow-xl"
                                :class="activeFaq === faq.id ? 'ring-2 ring-[#FF7518] shadow-2xl' : 'shadow-sm'">
                            <div class="flex items-center gap-4">
                                <span class="w-10 h-10 rounded-xl bg-[#F4F7FA] flex items-center justify-center text-[#161f36] font-black text-xs group-hover:bg-[#FF7518] group-hover:text-white transition-colors"
                                      :class="activeFaq === faq.id ? 'bg-[#FF7518] text-white' : ''">
                                    Q
                                </span>
                                <span class="text-xs md:text-sm font-black uppercase tracking-tight"
                                      :class="activeFaq === faq.id ? 'text-[#FF7518]' : 'text-[#161f36]'">
                                    <span x-text="faq.q"></span>
                                </span>
                            </div>
                            <i class="fas fa-chevron-down text-[10px] transition-transform duration-500 text-gray-300"
                               :class="activeFaq === faq.id ? 'rotate-180 text-[#FF7518]' : ''"></i>
                        </button>

                        <div x-show="activeFaq === faq.id"
                             x-collapse x-cloak
                             class="overflow-hidden bg-white border-t border-gray-50 rounded-b-2xl shadow-xl shadow-gray-100/50">
                            <div class="p-8 text-gray-500 text-sm leading-relaxed relative">
                                <div class="absolute left-6 top-8 bottom-8 w-[2px] bg-[#FF7518]/20"></div>
                                <div class="pl-6">
                                    <span class="block text-[10px] font-black text-[#FF7518] mb-2 uppercase tracking-widest">Jawaban Kami:</span>
                                    <span x-text="faq.a"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            {{-- 📞 CONTACT FOOTER --}}
            <div class="mt-24 p-1 rounded-[3rem] bg-gradient-to-r from-[#FF7518] to-orange-400 shadow-2xl shadow-orange-500/20" data-aos="zoom-in">
                <div class="bg-[#161f36] rounded-[2.8rem] p-10 lg:p-16 text-center relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-2xl lg:text-4xl font-black text-white uppercase tracking-tight mb-4">Masih butuh penjelasan?</h3>
                        <p class="text-gray-400 text-xs lg:text-sm uppercase tracking-[0.2em] mb-10">Tim ahli kami siap melayani konsultasi teknis Anda kapan saja.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="https://wa.me/62812345678" class="flex items-center gap-3 bg-[#FF7518] text-white px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-orange-600 transition-all scale-100 hover:scale-105 shadow-xl shadow-orange-500/20">
                                <i class="fab fa-whatsapp text-lg"></i> Mulai Konsultasi
                            </a>
                            <a href="/contact" class="flex items-center gap-3 bg-white/5 text-white border border-white/10 px-8 py-4 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-white/10 transition-all">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                    {{-- Decorative Circle --}}
                    <div class="absolute -right-20 -top-20 w-64 h-64 bg-[#FF7518]/10 rounded-full blur-3xl"></div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Scripts --}}
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ duration: 1000, once: true });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    /* Scrollbar Style */
    ::-webkit-scrollbar { width: 8px; }
    ::-webkit-scrollbar-track { background: #F4F7FA; }
    ::-webkit-scrollbar-thumb { background: #161f36; border-radius: 10px; border: 2px solid #F4F7FA; }
    ::-webkit-scrollbar-thumb:hover { background: #FF7518; }
</style>
@endsection
