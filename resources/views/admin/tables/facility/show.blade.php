@extends('admin.layouts.app')

@section('title', $facility->name)

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $facility->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Definisi Warna Kustom (Tower Theme) */
        .text-dark-tower { color: #2C3E50; } /* Biru Tua/Dark Blue */
        .bg-dark-tower { background-color: #2C3E50; }
        .text-accent-tower { color: #FF8C00; } /* Oranye/Emas */
        .bg-accent-tower { background-color: #FF8C00; }
        .hover\:bg-accent-dark:hover { background-color: #E67E22; } /* Hover gelap */
        .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="main-content flex-1 p-6">
        <div class="bg-white rounded-xl shadow-soft p-6 md:p-8">

            {{-- Header dan Tombol Kembali --}}
            <div class="flex justify-between items-center mb-8 border-b pb-4 border-gray-100">
                <h1 class="text-3xl font-extrabold text-dark-tower flex items-center">
                    <i class="fas fa-search-plus text-accent-tower mr-3"></i> {{ $facility->name }}
                </h1>
                <a href="{{ route('admin.facilities.index') }}"
                    class="bg-gray-200 text-dark-tower px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2 text-sm shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Daftar</span>
                </a>
            </div>

            {{-- Bagian Konten Detail --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Kolom Kiri: Gambar --}}
                <div class="lg:col-span-1">
                    <h2 class="text-lg font-semibold text-dark-tower mb-3 border-b border-accent-tower/50 pb-1">Foto Fasilitas</h2>
                    <img src="{{ asset('storage/' . $facility->image) }}" alt="{{ $facility->name }}"
                        class="w-full h-auto max-h-96 object-cover rounded-xl shadow-lg border border-gray-200">

                    {{-- Metadata Ringkas --}}
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm font-semibold text-dark-tower mb-2 flex items-center">
                            <i class="fas fa-tag text-accent-tower mr-2"></i> Jenis Fasilitas
                        </p>

                        @php
                            // Logika untuk menentukan warna badge berdasarkan kategori peralatan baru
                            $badgeClass = match(trim($facility->type)) {
                                'Peralatan Pabrikas' => 'bg-accent-tower text-white',
                                'Peralatan Maintenance' => 'bg-blue-500 text-white',
                                'Kendaraan Operasional' => 'bg-green-500 text-white',
                                default => 'bg-gray-400 text-white', // Untuk kategori lain/default
                            };
                        @endphp

                        <span class="px-3 py-1 text-sm font-bold rounded-full shadow-md {{ $badgeClass }}">
                            {{ $facility->type }}
                        </span>

                        <p class="text-sm font-semibold text-dark-tower mt-4 flex items-center">
                            <i class="fas fa-user-circle text-dark-tower mr-2"></i> Dipublikasikan oleh
                        </p>
                        <p class="text-sm text-gray-700 ml-5">{{ $facility->publisher ?? 'Administrator' }}</p>
                    </div>
                </div>

                {{-- Kolom Kanan: Deskripsi --}}
                <div class="lg:col-span-2">
                    <h2 class="text-lg font-semibold text-dark-tower mb-3 border-b border-accent-tower/50 pb-1">Deskripsi Fasilitas</h2>
                    <div class="text-gray-700 leading-relaxed text-base">
                        <p>{{ $facility->description }}</p>
                    </div>
                </div>

            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-10 flex justify-end space-x-3 border-t pt-6 border-gray-100">
                {{-- Tombol Edit --}}
                <a href="{{ route('admin.facilities.edit', $facility->id) }}"
                    class="bg-accent-tower text-white px-6 py-2 rounded-lg font-semibold hover:bg-accent-dark transition-colors duration-200 shadow-md flex items-center">
                    <i class="fas fa-edit mr-2"></i>Edit Fasilitas
                </a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST"
                    onsubmit="return confirm('PERINGATAN! Apakah Anda yakin ingin menghapus fasilitas {{ $facility->name }} ini secara permanen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-700 transition-colors duration-200 shadow-md flex items-center">
                        <i class="fas fa-trash-alt mr-2"></i>Hapus Fasilitas
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
@endsection
