@extends('layouts.app')

@section('content')
    @php
        $hasImages = isset($mainImages) && $mainImages->isNotEmpty();
        $themeDark = '#161f36'; 
        $themeAccent = '#FF7518'; 
    @endphp

    <style>
        .text-tower-dark { color: {{ $themeDark }}; }
        .bg-tower-dark { background-color: {{ $themeDark }}; }
        .text-tower-accent { color: {{ $themeAccent }}; }
        .bg-tower-accent { background-color: {{ $themeAccent }}; }
        .border-tower-accent { border-color: {{ $themeAccent }}; }
        
        /* Modern Hover Effect - Tanpa Shadow */
        .history-card {
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
        }

        /* Garis highlight saat di hover */
        .history-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 4px;
            background: {{ $themeAccent }};
            transition: width 0.5s ease;
        }

        .history-card:hover {
            border-color: {{ $themeAccent }};
            background-color: {{ $themeDark }};
        }

        .history-card:hover::after {
            width: 100%;
        }

        /* Efek Icon saat di hover */
        .history-card:hover .icon-box {
            transform: scale(1.1) rotate(10deg);
            background-color: {{ $themeAccent }};
            color: white;
        }

        .history-card:hover h3 {
            color: white;
        }

        .history-card:hover p {
            color: #9ca3af;
        }
    </style>

    <div>
        {{-- Hero Section / Slider --}}
        <section class="relative max-w-screen overflow-hidden">
            @if ($hasImages)
                <div x-data="{ activeSlide: 1, totalSlides: {{ $mainImages->count() }} }" x-init="setInterval(() => { activeSlide = activeSlide % totalSlides + 1 }, 5000)">
                    <div class="relative w-full h-[400px] lg:h-[500px] overflow-hidden">
                        @foreach ($mainImages as $image)
                            <div x-show="activeSlide === {{ $loop->iteration }}"
                                x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0"
                                x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-1000"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                class="absolute inset-0">
                                <img src="{{ Storage::url($image->path) }}"
                                    alt="{{ $image->description ?? $image->filename }}" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-{{ $themeDark }} to-transparent opacity-80"></div>
                            </div>
                        @endforeach
                        
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                            <span class="text-tower-accent font-black tracking-[0.5em] text-xs uppercase mb-4">Established Excellence</span>
                            <h1 class="text-white text-5xl lg:text-7xl font-black uppercase tracking-tighter">
                                OUR <span class="text-tower-accent">HISTORY</span>
                            </h1>
                        </div>
                    </div>
                </div>
            @else
                <div class="relative h-[300px] bg-tower-dark flex items-center justify-center">
                    <h1 class="text-white text-5xl font-black tracking-tighter">HISTORY</h1>
                </div>
            @endif
        </section>

        {{-- Breadcrumb Clean --}}
        <div class="bg-white border-b border-gray-100">
            <div class="max-w-screen-xl h-[60px] mx-auto px-8">
                <nav class="h-full flex items-center">
                    <ol class="flex items-center space-x-3 text-[10px] font-bold uppercase tracking-[0.2em] text-gray-400">
                        <li><a href="/" class="hover:text-tower-accent transition-colors">Home</a></li>
                        <li><span class="w-1 h-1 bg-gray-300 rounded-full"></span></li>
                        <li><a href="{{ route('about') }}" class="hover:text-tower-accent transition-colors">About</a></li>
                        <li><span class="w-1 h-1 bg-tower-accent rounded-full"></span></li>
                        <li class="text-tower-dark">History</li>
                    </ol>
                </nav>
            </div>
        </div>

        {{-- Main History Content --}}
        <section class="bg-white py-24">
            <div class="container mx-auto max-w-6xl px-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
                    <div class="max-w-xl">
                        <h2 class="text-4xl lg:text-5xl font-black text-tower-dark uppercase leading-none mb-6">
                            Sejarah <br><span class="text-tower-accent">Perusahaan</span>
                        </h2>
                        <div class="w-20 h-1.5 bg-tower-accent rounded-full"></div>
                    </div>
                    <p class="text-gray-500 max-w-lg leading-relaxed font-medium">
                        PT. RIZQALLAH BOER MAKMUR merupakan badan usaha pembangunan yang berbasis di Kota Jakarta Selatan, Indonesia. Berdiri sejak lama, kini dikenal sebagai salah satu pemimpin di area development.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-0 border-collapse">
                    {{-- Card 1 --}}
                    <div class="history-card bg-white p-12 group">
                        <div class="icon-box w-16 h-16 bg-gray-50 text-tower-accent rounded-2xl flex items-center justify-center mb-10 transition-all duration-500">
                            <i class="fas fa-rocket text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark uppercase mb-5 transition-colors duration-500">Awal Mula & Visi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed transition-colors duration-500">
                            Berawal dari semangat untuk memberikan solusi infrastruktur terbaik, perusahaan didirikan dengan fokus pada kualitas dan ketepatan waktu. Kami percaya bahwa setiap menara yang kami bangun adalah pondasi bagi konektivitas bangsa.
                        </p>
                    </div>

                    {{-- Card 2 --}}
                    <div class="history-card bg-white p-12 group border-x-0 md:border-x-1">
                        <div class="icon-box w-16 h-16 bg-gray-50 text-tower-accent rounded-2xl flex items-center justify-center mb-10 transition-all duration-500">
                            <i class="fas fa-broadcast-tower text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark uppercase mb-5 transition-colors duration-500">Ekspansi & Inovasi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed transition-colors duration-500">
                            Seiring berjalannya waktu, kami memperluas jangkauan layanan mulai dari fabrikasi baja hingga penyediaan unit Transportable BTS (Combat). Inovasi menjadi mesin utama pertumbuhan kami di industri telekomunikasi.
                        </p>
                    </div>

                    {{-- Card 3 --}}
                    <div class="history-card bg-white p-12 group">
                        <div class="icon-box w-16 h-16 bg-gray-50 text-tower-accent rounded-2xl flex items-center justify-center mb-10 transition-all duration-500">
                            <i class="fas fa-shield-alt text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-black text-tower-dark uppercase mb-5 transition-colors duration-500">Komitmen Kualitas</h3>
                        <p class="text-gray-500 text-sm leading-relaxed transition-colors duration-500">
                            Keamanan dan ketahanan produk adalah prioritas utama. Melalui proses Engineering Design yang presisi, kami memastikan setiap struktur mampu menghadapi tantangan lingkungan yang ekstrim sekalipun.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Detail Content Section --}}
        <section class="bg-gray-50 py-24">
            <div class="max-w-4xl mx-auto px-8">
                <div class="flex items-center gap-4 mb-12">
                    <span class="w-12 h-[2px] bg-tower-accent"></span>
                    <h2 class="text-2xl font-black text-tower-dark uppercase tracking-tight">Detail Perjalanan Kami</h2>
                </div>
                
                <div class="bg-white p-10 md:p-16 border border-gray-100 rounded-3xl">
                    @if ($historyContent)
                        <article class="prose prose-lg prose-slate max-w-none 
                            prose-headings:text-tower-dark prose-headings:font-black
                            prose-p:text-gray-600 prose-strong:text-tower-accent">
                            {!! $historyContent->content !!}
                        </article>
                    @else
                        <div class="text-center py-10 italic text-gray-400 font-medium">
                            Konten sedang diperbarui...
                        </div>
                    @endif
                </div>
            </div>
        </section>
    </div>
@endsection