@extends('layouts.app')
@section('title', 'Galeri Proyek & Portofolio - PT. Rizqallah Boer Makmur')

@push('styles')
    {{-- Memastikan Lightbox dimuat --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" />

    <style>
        /* -------------------------------------
           CUSTOM STYLING FOR TAILWIND COMPONENTS
        ---------------------------------------*/
        /* Garis Pembagi (Divider) */
        .divider {
            width: 60px;
            height: 4px;
            background-color: #FF7518; /* RBM Accent */
            margin: 12px auto 18px;
            border-radius: 4px;
        }

        /* CARD Hover Effect (menggunakan utilitas Tailwind kecuali transisi) */
        .photo-card {
            transition: transform 0.35s ease, box-shadow 0.35s ease;
        }

        .photo-card:hover {
            transform: translateY(-5px);
        }

        /* Gambar di dalam Card */
        .photo-card img {
            transition: transform 0.42s ease, filter 0.42s ease;
            filter: grayscale(10%); /* Filter default */
        }

        .photo-card:hover img {
            transform: scale(1.05);
            filter: grayscale(0%); /* Warna penuh saat dihover */
        }

        /* Lightbox custom minimalis */
        #lightbox .lb-nav a.lb-prev, #lightbox .lb-nav a.lb-next {
            opacity: 0.8 !important;
            transition: opacity 0.2s;
        }
        #lightbox .lb-nav a.lb-prev:hover, #lightbox .lb-nav a.lb-next:hover {
            opacity: 1 !important;
        }
        #lightbox .lb-dataContainer .lb-caption {
            font-weight: 600;
        }
    </style>
@endpush


@section('content')

    {{-- ✅ HERO/TITLE (Menggunakan background gradasi lembut) --}}
    <section class="bg-gray-50 pt-32 pb-16 text-center"
        style="background: linear-gradient(180deg, #F8F9FB, #F1F3F7);" data-aos="fade-down">
        <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            {{-- Badge (Putih, Border Abu, Teks Navy) --}}
            <span
                class="inline-flex items-center rounded-full bg-white px-4 py-1.5 text-sm font-semibold text-rbm-dark shadow-md border border-gray-200 mb-2">
                Portofolio Proyek
            </span>

            {{-- Judul (RBM Dark Navy) --}}
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-rbm-dark">
                Galeri Kinerja PT. RBM
            </h1>

            {{-- Divider (RBM Accent Orange) --}}
            <div class="divider"></div>

            {{-- Subteks (Abu-abu Muted) --}}
            <p class="text-lg text-gray-500 max-w-3xl mx-auto">
                Lihat secara langsung kualitas dan skala proyek kontraktor & supplier yang telah kami selesaikan.
            </p>
        </div>
    </section>


    {{-- ✅ GALLERY GRID --}}
    <div class="container mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
        {{-- Grid Kolom Responsif (3 kolom di desktop) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            {{-- Contoh Looping Data Galeri --}}
            @forelse ($galleries as $gallery)
                <div data-aos="zoom-in">
                    {{-- Photo Card (Putih, Sudut 12px, Shadow, Border) --}}
                    <div class="photo-card rounded-xl overflow-hidden bg-white border border-gray-100 shadow-lg">
                        <a href="{{ asset('storage/'.$gallery->image) }}"
                            data-lightbox="gallery"
                            {{-- Mengambil deskripsi dari model (jika ada) atau fallback --}}
                            data-title="{{ $gallery->caption ?? 'Proyek Kontraktor & Supplier' }}">

                            {{-- Gambar --}}
                            <img src="{{ asset('storage/'.$gallery->image) }}" alt="Foto Galeri Proyek"
                                class="w-full object-cover h-[320px] md:h-[280px] lg:h-[320px]">
                        </a>
                    </div>
                </div>
            @empty
                {{-- Empty State (Tampilan jika $galleries kosong) --}}
                <div class="col-span-full text-center">
                    <div class="bg-white rounded-2xl p-10 sm:p-16 border border-gray-100 shadow-xl mx-auto max-w-2xl" data-aos="fade-up">
                        {{-- Ikon (RBM Accent Orange) --}}
                        <i class="fas fa-camera-retro fa-4x mb-4" style="color: #FF7518;"></i>

                        {{-- Judul (RBM Dark Navy) --}}
                        <h3 class="text-2xl font-semibold text-rbm-dark">Galeri Segera Diperbarui</h3>

                        {{-- Subteks (Abu-abu Muted) --}}
                        <p class="mt-2 text-gray-500 text-lg">
                            Kami sedang menyiapkan momen terbaik dari proyek-proyek terbaru kami. Silakan kunjungi kembali.
                        </p>
                    </div>
                </div>
            @endforelse

        </div>
    </div>


@push('scripts')
    {{-- Lightbox Script --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script>
        // Konfigurasi Lightbox agar lebih minimalis dan modern
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'fadeDuration': 300,
            'imageFadeDuration': 300,
            'positionFromTop': 100 // Jarak dari atas
        });
    </script>
@endpush

@endsection
