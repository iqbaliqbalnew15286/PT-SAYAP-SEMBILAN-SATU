@extends('admin.layouts.app')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        :root {
            --accent: #FF8C00;
            --dark: #161f36;
        }

        /* Animasi elegan */
        .fade-up {
            opacity: 0;
            transform: translateY(14px);
            animation: fadeUp .8s cubic-bezier(.22, .61, .36, 1) forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: none;
            }
        }

        /* Card corporate */
        .tower-card {
            border-left: 5px solid var(--accent);
            transition: all .28s ease;
        }

        .tower-card:hover {
            background: #F9FAFB;
            box-shadow: 0 14px 30px rgba(0, 0, 0, .08);
            transform: translateY(-3px);
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #E5E7EB, transparent);
        }
    </style>

    <div class="min-h-screen bg-[#F0F2F5] px-8 py-10">

        <div class="max-w-7xl mx-auto space-y-12">

            {{-- HEADER --}}
            <header
                class="bg-white rounded-2xl border border-gray-200 px-8 py-7 flex flex-col md:flex-row justify-between items-start md:items-center shadow-sm">

                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span class="w-2 h-10 bg-[var(--accent)] rounded-full"></span>
                        <h1 class="text-2xl font-semibold text-[var(--dark)]">
                            Selamat Datang,
                            <span class="text-[var(--accent)] font-bold">
                                {{ Auth::user()->name ?? 'Admin Tower' }}
                            </span>
                        </h1>
                    </div>

                    <p class="text-sm text-gray-600 pl-5">
                        Kelola data properti Anda di sini.
                    </p>
                </div>

                <div class="mt-4 md:mt-0 flex items-center gap-3 text-gray-600 text-sm">
                    <div class="w-10 h-10 flex items-center justify-center rounded-lg bg-gray-100">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span id="current-date" class="font-medium"></span>
                </div>

            </header>

            {{-- BANNER --}}
            <section class="relative bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-md">

                <img src="{{ asset('assets/img/foto1.png') }}" alt="Tower Banner"
                    class="w-full h-72 md:h-80 object-cover object-center">

                {{-- Overlay elegan --}}
                <div class="absolute inset-0 bg-gradient-to-r from-[#161f36]/30 via-transparent to-[#161f36]/30"></div>

            </section>


            {{-- TITLE --}}
            <div class="fade-up" style="animation-delay:.15s">
                <h2 class="text-lg font-semibold text-[var(--dark)]">
                    Kontrol Konten Properti
                </h2>
                <div class="divider mt-4"></div>
            </div>

            {{-- GRID --}}
            <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">

                @foreach ([
            ['admin.home.index', 'fa-image', 'Gambar Utama Properti', 'Kelola gambar utama (hero section) yang tampil di halaman depan website Tower.'],
            ['admin.abouts.index', 'fa-info-circle', 'Profil & Deskripsi', 'Atur tulisan seperti profil PT/developer, sejarah pembangunan, dan visi & misi Tower.'],
            ['admin.testimonials.index', 'fa-quote-right', 'Testimoni Penghuni', 'Kelola ulasan dan pengalaman positif dari penghuni atau klien properti.'],
            ['admin.facilities.index', 'fa-swimming-pool', 'Fasilitas Properti', 'Perbarui informasi dan galeri foto fasilitas atau amenities yang tersedia di Tower.'],
            ['admin.products.index', 'fa-building', 'Unit & Tipe Properti', 'Sesuaikan daftar dan detail spesifikasi tipe unit (apartemen, kantor) yang dijual/disewakan.'],
            ['admin.galleries.index', 'fa-camera', 'Galeri Foto & Video', 'Kelola galeri foto dan video Tower untuk keperluan marketing dan visual.'],
            ['admin.partners.index', 'fa-handshake', 'Mitra & Klien Utama', 'Kelola dan tampilkan daftar mitra, investor, atau klien korporat utama Tower.'],
            ['admin.abouts.index', 'fa-user-tie', 'Tim Manajemen', 'Kelola data dan profil tim manajemen properti serta kontak penting.'],
            ['admin.galleries.index', 'fa-scroll', 'Dokumen & Sertifikasi', 'Publikasikan dan kelola daftar dokumen hukum, perizinan, dan sertifikasi properti.'],
            ['admin.partners.index', 'fa-map-marker-alt', 'Kontak & Lokasi', 'Kelola informasi kontak, alamat kantor, dan koordinat Google Maps Tower.'],
        ] as $i => $c)
                    <a href="{{ route($c[0]) }}" class="tower-card bg-white rounded-xl p-6 border border-gray-200 fade-up"
                        style="animation-delay: {{ 0.2 + $i * 0.05 }}s">

                        <div class="flex items-start gap-4 mb-4">
                            <div
                                class="w-10 h-10 flex items-center justify-center rounded-md bg-[var(--accent)] text-white">
                                <i class="fas {{ $c[1] }}"></i>
                            </div>
                            <h3 class="font-semibold text-[var(--dark)] leading-snug">
                                {{ $c[2] }}
                            </h3>
                        </div>

                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $c[3] }}
                        </p>

                        <div class="mt-5 text-sm font-semibold text-[var(--dark)] flex items-center gap-2">
                            Kelola Sekarang
                            <i class="fas fa-arrow-right text-xs text-[var(--accent)]"></i>
                        </div>
                    </a>
                @endforeach
            </section>
        </div>

        {{-- DATE --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const opt = {
                    timeZone: 'Asia/Jakarta',
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                document.getElementById('current-date').textContent =
                    new Intl.DateTimeFormat('id-ID', opt).format(new Date());
            });
        </script>
    </div>
@endsection
