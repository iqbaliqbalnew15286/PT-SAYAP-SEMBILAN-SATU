@extends('layouts.app')

@section('title', 'PT RIZQALLAH BOER MAKMUR | Tower Infrastructure')

@section('content')

    {{-- ================= MODAL SEARCH ================= --}}
    <div x-show="searchModalOpen" x-cloak class="fixed inset-0 z-[100] overflow-y-auto">
        <div @click="searchModalOpen = false" class="fixed inset-0 bg-[#161f36]/80 backdrop-blur-sm"></div>
        <div class="relative min-h-screen flex items-start justify-center pt-24 px-4">
            <div @click.away="searchModalOpen = false"
                class="bg-white w-full max-w-xl rounded-3xl shadow-2xl overflow-hidden">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="query" class="w-full text-lg py-5 pl-14 pr-6 outline-none"
                        placeholder="Cari layanan / produk..." autofocus>
                    <i class="fa-solid fa-magnifying-glass absolute left-5 top-1/2 -translate-y-1/2 text-gray-400"></i>
                </form>
            </div>
        </div>
    </div>

    @push('heads')
        <meta name="description"
            content="PT SAYAP SEMBILAN SATU - Solusi infrastruktur menara telekomunikasi profesional dan inovatif.">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
            rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endpush

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        /* Scroll Reveal */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all .8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Modern Card */
        .modern-card {
            background: white;
            border-radius: 32px;
            border: 1px solid #f1f5f9;
            transition: all .4s ease;
        }

        .modern-card:hover {
            transform: translateY(-8px);
            border-color: #FF7518;
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, .15);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <script>
        document.addEventListener('scroll', () => {
            document.querySelectorAll('.reveal').forEach(el => {
                const top = el.getBoundingClientRect().top;
                if (top < window.innerHeight - 100) el.classList.add('active');
            });
        });
    </script>

    @php
        $amaliahDark = '#161f36';
        $amaliahOrange = '#FF7518';

        $sliderImages = [
            'https://images.unsplash.com/photo-1520640193369-2213303b19cd?w=1600',
            'https://images.unsplash.com/photo-1544724569-5f546fd6f2b5?w=1600',
            'https://images.unsplash.com/photo-1518770660439-4636190af475?w=1600',
        ];
    @endphp

    {{-- ================= HERO ================= --}}
    <section class="relative h-[75vh] min-h-[520px] overflow-hidden bg-[#161f36]">
        <div x-data="{ activeSlide: 1, total: {{ count($sliderImages) }} }" x-init="setInterval(() => activeSlide = activeSlide === total ? 1 : activeSlide + 1, 5000)" class="relative h-full">

            @foreach ($sliderImages as $i => $img)
                <div x-show="activeSlide==={{ $i + 1 }}" x-transition.opacity.duration.1000 class="absolute inset-0">
                    <img src="{{ $img }}" class="w-full h-full object-cover brightness-[0.35]">
                </div>
            @endforeach

            <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-transparent"></div>

            <div class="absolute inset-0 flex flex-col justify-center px-8 md:px-24">
                <h1 class="text-white text-4xl md:text-5xl font-bold leading-tight mb-4 reveal">
                    Elevating <br> Connectivity
                </h1>
                <p class="text-gray-300 max-w-md text-sm md:text-base reveal">
                    Solusi pembangunan menara telekomunikasi dengan standar profesional dan inovasi berkelanjutan.
                </p>
            </div>

            <div class="absolute bottom-10 right-10 flex gap-2">
                @for ($i = 1; $i <= count($sliderImages); $i++)
                    <button @click="activeSlide={{ $i }}"
                        :class="activeSlide === {{ $i }} ? 'w-8 bg-[#FF7518]' : 'w-3 bg-white/30'"
                        class="h-1.5 rounded-full transition-all"></button>
                @endfor
            </div>
        </div>
    </section>

    {{-- ================= FEATURE FLOAT ================= --}}
    <section class="relative -mt-20 z-30 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
            @php
                $fitur = [
                    [
                        'icon' => 'fa-calendar-check',
                        'title' => 'Project Booking',
                        'desc' => 'Atur jadwal survei proyek',
                        'link' => route('booking.login'),
                        'color' => $amaliahOrange,
                    ],
                    [
                        'icon' => 'fa-file-pdf',
                        'title' => 'E-Catalogue',
                        'desc' => 'Spesifikasi teknis material',
                        'link' => '#',
                        'color' => $amaliahDark,
                    ],
                    [
                        'icon' => 'fa-project-diagram',
                        'title' => 'Tracking',
                        'desc' => 'Pantau progres proyek',
                        'link' => '#',
                        'color' => $amaliahOrange,
                    ],
                    [
                        'icon' => 'fa-comments',
                        'title' => 'Consultation',
                        'desc' => 'Diskusi kebutuhan tower',
                        'link' => route('consult'),
                        'color' => $amaliahDark,
                    ],
                    [
                        'icon' => 'fa-images',
                        'title' => 'Gallery',
                        'desc' => 'Dokumentasi proyek',
                        'link' => route('gallery.index'),
                        'color' => $amaliahOrange,
                    ],
                ];
            @endphp

            @foreach ($fitur as $f)
                <a href="{{ $f['link'] }}" class="modern-card p-8 text-center reveal">
                    <div class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-6"
                        style="background:{{ $f['color'] }}">
                        <i class="fas {{ $f['icon'] }} text-white text-xl"></i>
                    </div>
                    <h3 class="text-sm font-bold tracking-wide mb-2">{{ strtoupper($f['title']) }}</h3>
                    <p class="text-xs text-gray-500">{{ $f['desc'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    <div class="h-32"></div>

    {{-- ================= CTA ================= --}}
    <section class="max-w-6xl mx-auto px-6 mb-32 reveal">
        <div
            class="bg-[#161f36] rounded-[3rem] p-10 md:p-14 flex flex-col lg:flex-row items-center justify-between relative overflow-hidden">

            <div class="absolute -top-20 -right-20 w-64 h-64 bg-[#FF7518]/10 rounded-full blur-3xl"></div>

            <div>
                <h2 class="text-white text-2xl md:text-4xl font-semibold mb-4">
                    Mulai Proyek <span class="text-[#FF7518]">Tower Anda</span>
                </h2>
                <p class="text-gray-400 text-sm max-w-md">
                    Tim profesional kami siap membantu kebutuhan infrastruktur Anda.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-6 mt-8 lg:mt-0">
                <a href="{{ route('kontak') }}"
                    class="px-8 py-4 bg-[#FF7518] text-white rounded-xl font-semibold hover:scale-105 transition">
                    Hubungi Kami
                </a>

                <div class="flex items-center gap-3">
                    <div class="flex -space-x-3">
                        <img src="https://www.google.com/favicon.ico" class="w-10 h-10 bg-white rounded-full p-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg"
                            class="w-10 h-10 bg-white rounded-full p-2">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/7/7b/Meta_Platforms_Inc._logo.svg"
                            class="w-10 h-10 bg-white rounded-full p-2">
                    </div>
                    <span class="text-xs text-gray-300">100+ Mitra</span>
                </div>
            </div>
        </div>
    </section>



    {{-- ================= INTELLIGENT SOLUTION ================= --}}
    <section class="max-w-7xl mx-auto px-6 lg:px-12 mb-40 reveal">

        {{-- Header --}}
        <div class="mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-[#161f36] tracking-tight uppercase leading-tight">
                Intelligent <span class="text-[#FF7518]">Solution</span><br>
                For Your Infrastructure
            </h2>

            <div class="flex items-center gap-2 mt-5">
                <span class="w-16 h-[3px] bg-[#FF7518] rounded-full"></span>
                <span class="w-4 h-[3px] bg-[#161f36] rounded-full"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-start">

            {{-- Left Content --}}
            <div class="space-y-10 reveal">
                <div class="relative pl-6 border-l-4 border-[#FF7518]">
                    <h3 class="text-xl font-bold text-[#161f36] mb-4">
                        PT Rizqallah Boer Makmur
                    </h3>

                    <p class="text-gray-700 text-base leading-relaxed">
                        Didirikan pada tahun 2005 di Jakarta sebagai perusahaan yang berdedikasi dalam penyediaan barang dan
                        jasa berkualitas tinggi.
                        Seiring berkembangnya teknologi, fokus utama kami kini menjadi mitra strategis di industri
                        Telekomunikasi dengan jangkauan layanan
                        yang mencakup seluruh wilayah Indonesia.Kami memahami bahwa infrastruktur telekomunikasi adalah
                        tulang punggung konektivitas digital.
                        Oleh karena itu, <span class="text-[#FF7518] font-semibold">RBM</span> hadir memberikan solusi
                        komprehensif mulai dari pembangunan hingga pemeliharaan infrastruktur menara.
                    </p>

                    <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                        Solusi infrastruktur profesional untuk mendukung konektivitas digital
                        yang stabil, aman, dan berkelanjutan di seluruh Indonesia.
                    </p>
                </div>

                {{-- CTA --}}
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('products') }}"
                        class="group inline-flex items-center justify-center px-8 py-4 rounded-xl bg-[#161f36] text-white font-semibold transition-all duration-300 hover:bg-[#FF7518] hover:shadow-lg hover:shadow-orange-500/30">
                        <span>CEK PRODUK</span>
                        <span
                            class="ml-4 p-2 rounded-lg bg-white/20 group-hover:bg-white group-hover:text-[#FF7518] transition">
                            <i class="fas fa-arrow-right text-sm"></i>
                        </span>
                    </a>

                    <a href="{{ route('about') }}"
                        class="inline-flex items-center justify-center px-8 py-4 rounded-xl border border-[#161f36] text-[#161f36] font-semibold transition-all hover:bg-[#161f36] hover:text-white">
                        TENTANG KAMI
                    </a>
                </div>
            </div>

            {{-- Right Product Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 auto-rows-[160px] gap-4 reveal">

                @php
                    $gridProducts = isset($products) ? $products->take(5) : collect();
                @endphp

                @for ($i = 0; $i < 5; $i++)
                    @php
                        $product = $gridProducts->get($i);
                        $class = $i === 0 ? 'md:row-span-2' : ($i === 1 ? 'md:col-span-2 md:row-span-2' : '');
                    @endphp

                    <div
                        class="{{ $class }} relative overflow-hidden rounded-2xl bg-[#161f36] group border border-transparent hover:border-[#FF7518] transition-all duration-500">

                        @if ($product && $product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition flex flex-col justify-end p-5">
                                <h4 class="text-white text-sm font-bold uppercase tracking-tight">
                                    {{ $product->name }}
                                </h4>
                                <span class="w-8 h-[2px] bg-[#FF7518] mt-2"></span>
                            </div>

                            <a href="{{ route('product.show', $product->slug) }}" class="absolute inset-0 z-10"></a>
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center border border-dashed border-white/20">
                                <i class="fas fa-tower-broadcast text-[#FF7518] text-xl opacity-40 mb-2"></i>
                                <span class="text-white/40 text-[10px] uppercase font-semibold">Waiting for Data</span>
                            </div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>
    </section>
    {{-- ================= PARTNER SECTION (FIXED & STABLE) ================= --}}
    <section class="bg-white py-20 reveal">
        <div class="max-w-screen-xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- Left --}}
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-[#161f36] leading-tight">
                    Industry <br> Partner
                </h2>

                <div class="flex items-center gap-2 mt-4">
                    <span class="w-16 h-1 bg-[#FF7518] rounded-full"></span>
                    <span class="w-3 h-1 bg-[#FF7518] rounded-full"></span>
                </div>

                <p class="mt-6 text-gray-600 text-sm leading-relaxed max-w-md">
                    Kami bekerja sama dengan mitra industri untuk memberikan pengalaman nyata,
                    pengembangan skill, dan peluang profesional jangka panjang.
                </p>

                <a href="{{ route('partners.index') }}"
                    class="inline-flex items-center gap-4 mt-8 px-6 py-3 rounded-lg bg-[#FF7518] text-white font-semibold transition hover:scale-105">
                    Selengkapnya
                    <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            {{-- Right Logos --}}
            <div class="relative h-[30rem] overflow-hidden rounded-3xl">

                {{-- Fade --}}
                <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-b from-white to-transparent z-10"></div>
                <div class="absolute bottom-0 left-0 w-full h-16 bg-gradient-to-t from-white to-transparent z-10"></div>

                {{-- Scroll Container --}}
                <div class="animate-scroll flex flex-col gap-12">

                    {{-- BLOK 1 --}}
                    <div class="grid grid-cols-2 gap-10">
                        @forelse ($partners as $partner)
                            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-110">
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                    class="max-h-20 object-contain">
                                <span class="mt-2 text-[10px] text-gray-400 uppercase tracking-widest text-center">
                                    {{ $partner->name }}
                                </span>
                            </div>
                        @empty
                            <div class="col-span-2 text-center text-gray-400 italic">
                                Belum ada mitra.
                            </div>
                        @endforelse
                    </div>

                    {{-- BLOK 2 (DUPLIKASI AMAN) --}}
                    <div class="grid grid-cols-2 gap-10" aria-hidden="true">
                        @foreach ($partners as $partner)
                            <div class="flex flex-col items-center transition-transform duration-300 hover:scale-110">
                                <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                    class="max-h-20 object-contain">
                                <span class="mt-2 text-[10px] text-gray-400 uppercase tracking-widest text-center">
                                    {{ $partner->name }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- ================= STYLE ================= --}}
    <style>
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all .8s ease;
        }

        .reveal.show {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes scroll {
            from {
                transform: translateY(0);
            }

            to {
                transform: translateY(-50%);
            }
        }

        .animate-scroll {
            animation: scroll 18s linear infinite;
        }

        .animate-scroll:hover {
            animation-play-state: paused;
        }
    </style>

    <script>
        document.addEventListener('scroll', () => {
            document.querySelectorAll('.reveal').forEach(el => {
                if (el.getBoundingClientRect().top < window.innerHeight - 100) {
                    el.classList.add('show');
                }
            });
        });
    </script>



    <section class="py-16 sm:py-24 animate-on-scroll" style="background-color: {{ $amaliahDark }};">
        {{-- Container Utama --}}
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 relative">

            {{-- Dekorasi Titik --}}
            <div class="absolute top-8 left-8 md:left-12 flex items-center space-x-2 custom-none">
                <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                <div class="w-3 h-3 bg-gray-600 rounded-full"></div>
                <div class="w-3 h-3 bg-white rounded-full"></div>
            </div>

            {{-- Header Section --}}
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white">Fasilitas</h2>
                <p class="mt-2 text-gray-400">Stay in the know with insights from industry experts.</p>
                <div class="w-24 h-px bg-gray-600 mx-auto mt-4"></div>
            </div>

            {{-- Galeri Gambar Mozaik Dinamis --}}
            <div class="mt-12 w-full h-[30rem] md:h-[32rem] grid grid-cols-2 md:grid-cols-4 grid-rows-2 gap-4">

                {{-- Gambar 1 (Tinggi di Kiri) --}}
                <div class="col-span-1 row-span-2 rounded-xl overflow-hidden">
                    @if (isset($facilities[0]) && $facilities[0]->image)
                        <img src="{{ asset('storage/' . $facilities[0]->image) }}" alt="{{ $facilities[0]->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-black"></div>
                    @endif
                </div>

                {{-- Gambar 2 (Tengah Atas) --}}
                <div class="col-span-1 row-span-1 rounded-xl overflow-hidden">
                    @if (isset($facilities[1]) && $facilities[1]->image)
                        <img src="{{ asset('storage/' . $facilities[1]->image) }}" alt="{{ $facilities[1]->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-black"></div>
                    @endif
                </div>

                {{-- Gambar 3 (Kanan Atas) --}}
                <div class="col-span-1 md:col-span-2 row-span-1 rounded-xl overflow-hidden">
                    @if (isset($facilities[2]) && $facilities[2]->image)
                        <img src="{{ asset('storage/' . $facilities[2]->image) }}" alt="{{ $facilities[2]->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-black"></div>
                    @endif
                </div>

                {{-- Gambar 4 (Tengah Bawah) --}}
                <div class="col-span-1 row-span-1 rounded-xl overflow-hidden">
                    @if (isset($facilities[3]) && $facilities[3]->image)
                        <img src="{{ asset('storage/' . $facilities[3]->image) }}" alt="{{ $facilities[3]->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-black"></div>
                    @endif
                </div>

                {{-- Gambar 5 (Kanan Bawah) --}}
                <div class="col-span-1 md:col-span-2 row-span-1 rounded-xl overflow-hidden">
                    @if (isset($facilities[4]) && $facilities[4]->image)
                        <img src="{{ asset('storage/' . $facilities[4]->image) }}" alt="{{ $facilities[4]->name }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
                    @else
                        <div class="w-full h-full bg-black"></div>
                    @endif
                </div>
            </div>

            {{-- Tombol Selengkapnya --}}
            <div class="text-right mt-6">
                <a href="{{ route('facilities.index') }}" class="inline-flex items-center group">
                    <span class="text-sm font-semibold text-white mr-3">Selengkapnya</span>
                    <div
                        class="bg-gray-200 rounded-full p-2 group-hover:bg-gray-300 transition-transform duration-300 group-hover:translate-x-1">
                        <i class="fas fa-arrow-right text-gray-800 text-sm"></i>
                    </div>
                </a>
            </div>

        </div>
    </section>

    {{-- CSS Tambahan --}}
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        #product-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            backdrop-filter: blur(5px);
        }

        #product-modal.hidden {
            display: none;
        }

        @keyframes testimonial-slide {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-50% - 1rem));
            }
        }

        .animate-testimonial-slider {
            display: flex;
            width: fit-content;
            animation: testimonial-slide 40s linear infinite;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 117, 24, 0.3);
            border-radius: 10px;
        }
    </style>
    {{-- Testimonials Section - Interactive Blue & Orange --}}
    <section class="py-24 bg-gray-50 overflow-hidden">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Title dengan Mix Warna Biru & Oranye --}}
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-extrabold text-[#161f36] mb-4 tracking-tight">Testimoni</h2>
                <div class="flex justify-center gap-1.5">
                    <div class="w-16 h-2 bg-[#161f36] rounded-full"></div> {{-- Biru Tua --}}
                    <div class="w-4 h-2 bg-[#FF7518] rounded-full animate-pulse"></div> {{-- Oranye --}}
                    <div class="w-4 h-2 bg-[#FF7518]/50 rounded-full"></div>
                </div>
            </div>

            <div x-data="{
                skip: 1,
                atBeginning: true,
                atEnd: false,
                next() {
                    this.$refs.slider.scrollBy({ left: this.$refs.slider.firstElementChild.clientWidth + 24, behavior: 'smooth' })
                },
                prev() {
                    this.$refs.slider.scrollBy({ left: -(this.$refs.slider.firstElementChild.clientWidth + 24), behavior: 'smooth' })
                },
                checkPosition() {
                    this.atBeginning = this.$refs.slider.scrollLeft <= 5
                    this.atEnd = this.$refs.slider.scrollLeft + this.$refs.slider.clientWidth >= this.$refs.slider.scrollWidth - 5
                }
            }" class="relative px-4">

                {{-- Tombol Navigasi Interaktif --}}
                <div
                    class="absolute top-1/2 -translate-y-1/2 inset-x-0 z-30 flex justify-between pointer-events-none px-2 md:-mx-8">
                    <button @click="prev()"
                        class="pointer-events-auto w-12 h-12 bg-white text-[#161f36] border-2 border-[#161f36] rounded-full flex items-center justify-center hover:bg-[#161f36] hover:text-white transition-all duration-300 shadow-lg disabled:opacity-30 disabled:cursor-not-allowed"
                        :disabled="atBeginning">
                        <i class="fas fa-arrow-left"></i>
                    </button>

                    <button @click="next()"
                        class="pointer-events-auto w-12 h-12 bg-[#FF7518] text-white rounded-full flex items-center justify-center hover:bg-[#e66a15] transition-all duration-300 shadow-lg shadow-orange-200 disabled:opacity-30 disabled:cursor-not-allowed"
                        :disabled="atEnd">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>

                {{-- Slider Container --}}
                <div x-ref="slider" @scroll.debounce.10ms="checkPosition()"
                    class="flex gap-6 overflow-x-auto snap-x snap-mandatory no-scrollbar pb-10 pt-4">

                    @foreach ($testimonials as $testimonial)
                        <div class="min-w-full md:min-w-[calc(50%-12px)] snap-start group">
                            <div
                                class="bg-white p-10 rounded-[2rem] shadow-[0_4px_20px_rgba(0,0,0,0.05)] border-b-4 border-transparent hover:border-[#FF7518] h-full flex flex-col justify-between transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 relative">

                                {{-- Ikon Kutipan Interaktif --}}
                                <div
                                    class="absolute top-6 left-8 text-gray-100 group-hover:text-orange-50 transition-colors duration-500">
                                    <i class="fas fa-quote-left text-6xl"></i>
                                </div>

                                <div class="relative z-10 mb-8">
                                    <p class="text-gray-600 leading-relaxed text-lg italic font-medium">
                                        "{{ $testimonial['message'] }}"
                                    </p>
                                </div>

                                {{-- Profil di Pojok Kanan Bawah --}}
                                <div class="flex items-center justify-end gap-5 border-t border-gray-50 pt-8">
                                    <div class="text-right">
                                        <h4
                                            class="font-bold text-[#161f36] text-xl group-hover:text-[#FF7518] transition-colors">
                                            {{ $testimonial['name'] }}</h4>
                                        @if ($testimonial['company'])
                                            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mt-1">
                                                {{ $testimonial['company'] }}</p>
                                        @endif
                                    </div>

                                    {{-- Avatar Biru dengan Border Oranye --}}
                                    <div
                                        class="w-20 h-20 rounded-2xl bg-[#161f36] border-2 border-transparent group-hover:border-[#FF7518] shadow-lg flex-shrink-0 overflow-hidden flex items-center justify-center text-white text-3xl font-bold transition-all duration-500 transform group-hover:rotate-3">
                                        @if (isset($testimonial['photo']) && $testimonial['photo'])
                                            <img src="{{ asset($testimonial['photo']) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            {{ strtoupper(substr($testimonial['name'], 0, 1)) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- CTA Button --}}
            <div class="mt-8 text-center">
                <a href="{{ route('send.testimonial') }}"
                    class="inline-flex items-center gap-3 px-10 py-4 bg-[#161f36] text-white rounded-full font-bold hover:bg-[#FF7518] transition-all duration-300 shadow-xl group">
                    <i class="fas fa-comment-dots group-hover:scale-125 transition-transform"></i>
                    Bagi Pengalaman Anda
                </a>
            </div>
        </div>
    </section>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    {{-- Contact & Address Section --}}
    <section class="py-24 bg-slate-50 animate-on-scroll">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-4 space-y-10">
                    <div>
                        <h3 class="text-3xl font-black text-[#282829]">Hubungi Kami Lebih Lanjut</h3>
                        <p class="text-gray-500 mt-4">Kami siap melayani kebutuhan infrastruktur tower Anda secara
                            profesional.</p>
                    </div>
                    <div class="space-y-6">
                        <div
                            class="p-6 bg-white rounded-2xl shadow-sm flex items-center gap-5 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-[#FF7518]">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Telepon</p>
                                <p class="text-[#282829] font-bold">0813 9488 4596 / 0821 2123 3261</p>
                            </div>
                        </div>
                        <div
                            class="p-6 bg-white rounded-2xl shadow-sm flex items-center gap-5 hover:shadow-md transition-shadow">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-[#161f36]">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Email</p>
                                <p class="text-[#282829] font-bold">project@rbmark.co.id</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <a href="{{ route('faq') }}"
                            class="text-xs font-bold text-[#161f36] hover:text-[#FF7518]">FAQ</a>
                        <span class="text-gray-300">|</span>
                        <a href="{{ route('syaratketentuan') }}"
                            class="text-xs font-bold text-[#161f36] hover:text-[#FF7518]">Legalitas</a>
                    </div>
                </div>

                <div class="lg:col-span-8">
                    <div class="relative rounded-[2.5rem] overflow-hidden shadow-xl aspect-video lg:h-[500px]">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.347017420738!2d106.8308452!3d-6.2268615!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3f1da7a4369%3A0x2421b19a6801489c!2sMenara%20Palma!5e0!3m2!1sid!2sid!4v1733750000000"
                            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                            class="grayscale hover:grayscale-0 transition-all duration-1000"></iframe>
                        <div
                            class="absolute bottom-8 left-8 right-8 bg-white/90 backdrop-blur-md p-6 rounded-3xl flex flex-col md:flex-row justify-between items-center gap-4">
                            <div class="flex gap-4 items-start">
                                <div
                                    class="w-10 h-10 rounded-full bg-[#FF7518] flex items-center justify-center text-white shrink-0 shadow-lg">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <p class="text-sm text-[#282829] font-medium">Menara Palma Lantai 12
                                    Jl. HR. Rasuna Said Kav. 6 Blok X-2
                                    Jakarta Selatan 12950</p>
                            </div>
                            <a href="https://maps.app.goo.gl/..." target="_blank"
                                class="shrink-0 px-6 py-3 bg-[#161f36] text-white text-xs font-bold rounded-xl hover:bg-[#FF7518] transition-all">Buka
                                di Maps</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Product Modal --}}
    <div id="product-modal" class="hidden">
        <div id="modal-content"
            class="bg-white p-8 rounded-2xl max-w-4xl w-full mx-4 max-h-[90vh] overflow-y-auto relative">
            <button onclick="closeModal()" class="absolute top-4 right-4 text-gray-500 hover:text-black">
                <i class="fas fa-times text-xl"></i>
            </button>
            <div id="modal-body-inner"></div>
        </div>
    </div>

    <script>
        // Global Functions for buttons
        function scrollSlider(direction) {
            const container = document.querySelector('.testimonial-slider .flex');
            if (!container) return;
            const scrollAmount = 400;
            if (direction === 'next') {
                container.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            } else {
                container.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            }
        }

        function openModal(product) {
            const modal = document.getElementById('product-modal');
            const inner = document.getElementById('modal-body-inner');
            inner.innerHTML = `
            <div class="flex flex-col md:flex-row gap-8">
                <div class="md:w-1/2">
                    <img src="${product.image}" class="w-full h-80 object-cover rounded-2xl shadow-lg">
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">${product.name}</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">${product.description || 'Deskripsi akan segera diperbarui.'}</p>
                    <div class="flex gap-4">
                        <a href="${product.link}" class="bg-[#FF7518] text-white px-8 py-3 rounded-xl font-bold hover:bg-orange-600 transition-all">Detail Lengkap</a>
                    </div>
                </div>
            </div>`;
            modal.classList.remove('hidden');
            gsap.from("#modal-content", {
                opacity: 0,
                scale: 0.8,
                duration: 0.4,
                ease: "back.out(1.7)"
            });
        }

        function closeModal() {
            const modal = document.getElementById('product-modal');
            gsap.to("#modal-content", {
                opacity: 0,
                scale: 0.8,
                duration: 0.3,
                onComplete: () => modal.classList.add('hidden')
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof gsap !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);

                // Animate on Scroll Elements
                gsap.utils.toArray('.animate-on-scroll').forEach(element => {
                    gsap.from(element, {
                        opacity: 0,
                        y: 50,
                        duration: 1,
                        scrollTrigger: {
                            trigger: element,
                            start: "top 85%"
                        }
                    });
                });

                // Product Items Click
                document.querySelectorAll('.product-item').forEach(item => {
                    item.addEventListener('click', function() {
                        openModal({
                            name: this.dataset.name,
                            image: this.querySelector('img')?.src,
                            description: this.dataset.description,
                            link: this.dataset.link || '#'
                        });
                    });
                });

                // Stats Counter
                const stats = document.querySelectorAll('.stat-number');
                if (stats.length > 0) {
                    ScrollTrigger.create({
                        trigger: ".stat-number",
                        onEnter: () => {
                            stats.forEach(stat => {
                                const target = +stat.dataset.target;
                                gsap.to(stat, {
                                    innerText: target,
                                    duration: 2,
                                    snap: {
                                        innerText: 1
                                    }
                                });
                            });
                        }
                    });
                }
            }

            // Close modal on background click
            document.getElementById('product-modal').addEventListener('click', function(e) {
                if (e.target === this) closeModal();
            });
        });
    </script>
