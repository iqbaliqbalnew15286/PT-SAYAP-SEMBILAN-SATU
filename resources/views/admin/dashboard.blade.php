@extends('admin.layouts.app')

@section('content')
    {{-- Memastikan skrip Tailwind di-load (Biasanya di-load di admin-app, tapi disertakan jika ada kebutuhan kustom) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    {{-- Gaya Kustom (Injeksi warna Tower) --}}
    <style>
        :root {
            --primary-accent: #FF8C00; /* Oranye/Emas */
            --text-dark: #2C3E50; /* Biru Tua */
        }
        .text-accent-tower {
            color: var(--primary-accent);
        }
        .hover\:border-accent-tower:hover {
            border-color: var(--primary-accent);
        }
        .bg-page {
            background-color: #f0f2f5;
            color: var(--text-dark);
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <div class="bg-page min-h-screen p-6 md:p-10">
        <div class="max-w-7xl mx-auto">

            {{-- HEADER / TOPBAR --}}
            <header class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 p-4 bg-white rounded-xl shadow-md border border-[#D9D9D9]">
                <div>
                    <h1 class="text-xl font-bold mb-1 text-[var(--text-dark)]">
                        Selamat Datang,
                        <span class="text-accent-tower">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </span>
                    </h1>
                    <p class="text-sm font-normal text-gray-600">
                        Kelola data properti Anda <span class="text-accent-tower">di sini</span>.
                    </p>
                </div>
                <div class="flex items-center space-x-2 text-gray-600 mt-3 sm:mt-0 text-sm">
                    <i class="fas fa-calendar-alt text-lg"></i>
                    <span id="current-date" class="font-semibold"></span>
                </div>
            </header>

            {{-- BANNER VIEW --}}
            <div class="mb-8">
                <div class="w-full rounded-lg overflow-hidden border border-[#D9D9D9] shadow-lg">
                    <img alt="Panoramic aerial view of modern building complex with glass and greenery"
                        class="w-full h-40 object-cover object-center" src="{{ asset('assets/img/image.png') }}" />
                </div>
            </div>

            <main>
                {{-- JUDUL SEKSI --}}
                <h2 class="text-xl font-bold mb-5 text-[var(--text-dark)]">Kontrol Konten Properti</h2>

                {{-- GRID KARTU AKSI CEPAT --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                    {{-- 1. Gambar Utama --}}
                    <a href="{{ route('admin.home.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-image"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Gambar Utama Properti</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Kelola gambar utama (hero section) yang tampil di
                            halaman depan website Tower.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 2. Profil & Deskripsi --}}
                    <a href="{{ route('admin.abouts.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Profil & Deskripsi</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Atur tulisan seperti profil PT/developer, sejarah pembangunan, dan visi & misi Tower.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 3. Testimoni --}}
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-quote-right"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Testimoni Penghuni</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Kelola ulasan dan pengalaman positif dari penghuni atau klien properti.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 4. Fasilitas --}}
                    <a href="{{ route('admin.facilities.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-swimming-pool"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Fasilitas Properti</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Perbarui informasi dan galeri foto fasilitas atau *amenities* yang tersedia di Tower.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 5. Unit & Tipe Properti --}}
                    <a href="{{ route('admin.products.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-building"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Unit & Tipe Properti</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Sesuaikan daftar dan detail spesifikasi tipe unit (apartemen, kantor) yang dijual/disewakan.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 6. Galeri Foto & Video --}}
                    <a href="{{ route('admin.galleries.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Galeri Foto & Video</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Kelola galeri foto dan video Tower untuk keperluan *marketing* dan visual.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>


                    {{-- 8. Mitra & Klien Utama --}}
                    <a href="{{ route('admin.partners.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Mitra & Klien Utama</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Kelola dan tampilkan daftar mitra, investor, atau klien korporat utama Tower.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 9. Tim Manajemen --}}
                    <a href="{{ route('admin.abouts.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Tim Manajemen</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Kelola data dan profil tim manajemen properti serta kontak penting.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 10. Dokumen & Sertifikasi --}}
                    <a href="{{ route('admin.galleries.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-scroll"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Dokumen & Sertifikasi</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Publikasikan dan kelola daftar dokumen hukum, perizinan, dan sertifikasi properti.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                    {{-- 11. Kontak & Lokasi --}}
                    <a href="{{ route('admin.partners.index') }}"
                        class="bg-white rounded-lg p-5 flex flex-col space-y-3 shadow-lg border border-gray-200 transition-transform duration-300 hover:scale-[1.03] hover:shadow-xl hover:border-accent-tower">
                        <div class="text-accent-tower text-2xl">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h2 class="font-semibold text-lg text-[var(--text-dark)]">Kontak & Lokasi</h2>
                        <p class="text-sm text-gray-600 leading-snug flex-grow">Kelola informasi kontak, alamat kantor, dan koordinat Google Maps Tower.</p>
                        <span class="text-sm text-accent-tower font-semibold flex items-center space-x-1 mt-auto pt-2">
                            <span>Kelola Sekarang</span>
                            <i class="fas fa-arrow-right text-xs ml-1"></i>
                        </span>
                    </a>

                </div>
            </main>
        </div>

        {{-- JAVASCRIPT --}}
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dateSpan = document.getElementById('current-date');

                function updateDate() {
                    const now = new Date();
                    const options = {
                        timeZone: 'Asia/Jakarta',
                        weekday: 'long',
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    };
                    // Menggunakan Intl.DateTimeFormat untuk format lokal Indonesia (hari, dd bulan yyyy)
                    const formattedDate = new Intl.DateTimeFormat('id-ID', options).format(now);
                    dateSpan.textContent = formattedDate;
                }

                updateDate();
                // Opsional: update date every minute (60000ms)
                setInterval(updateDate, 60000);
            });
        </script>
    </div>
@endsection
