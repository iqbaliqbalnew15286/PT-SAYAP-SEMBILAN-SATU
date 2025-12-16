@extends('admin.layouts.app')

@section('title', 'Tambah Mitra Industri')

@section('content')

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tambah Mitra Industri</title>
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
            .focus\:ring-accent-tower:focus { --tw-ring-color: #FF8C00; }
            .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f2f5;
            }

            /* Gaya khusus untuk input file */
            input[type="file"]::file-selector-button {
                background-color: #e0e0e0;
                color: #333;
                border: none;
                padding: 0.5rem 1rem;
                margin-right: 1rem;
                border-radius: 0.375rem;
                cursor: pointer;
                transition: background-color 0.2s;
            }

            input[type="file"]::file-selector-button:hover {
                background-color: #d0d0d0;
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <div class="main-content flex-1 p-6">
            <div class="bg-white rounded-xl shadow-soft p-6 md:p-8">
                <div class="flex justify-between items-center mb-8 border-b pb-4 border-gray-100">
                    <h1 class="text-3xl font-bold text-dark-tower flex items-center">
                        <i class="fas fa-handshake text-accent-tower mr-3"></i> Tambah Mitra Industri
                    </h1>
                    <a href="{{ route('admin.partners.index') }}"
                        class="bg-gray-200 text-dark-tower px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2 text-sm shadow-sm">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali ke Daftar</span>
                    </a>
                </div>

                {{-- PASTIKAN ROUTE DAN METHOD BENAR UNTUK UPDATE --}}
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Mitra --}}
                    <div class="mb-5">
                        <label for="name" class="block text-sm font-medium text-dark-tower mb-1">Nama Mitra <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Logo Mitra --}}
                    <div class="mb-5">
                        <label for="logo" class="block text-sm font-medium text-dark-tower mb-1">Logo Mitra</label>
                        <input type="file" name="logo" id="logo"
                            class="w-full border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('logo') border-red-500 @enderror">
                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-medium text-dark-tower mb-1">Deskripsi</label>
                        <textarea name="description" id="description" rows="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sektor (Dropdown Hanya 2 Pilihan) --}}
                    <div class="mb-5">
                        <label for="sector" class="block text-sm font-medium text-dark-tower mb-1">Sektor <span class="text-red-500">*</span></label>
                        <select name="sector" id="sector" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('sector') border-red-500 @enderror">

                            {{-- Mengambil nilai lama dari database atau dari session old() --}}
                            @php
                                $currentSector = old('sector');
                            @endphp

                            <option value="" disabled {{ !$currentSector ? 'selected' : '' }}>Pilih Kategori Mitra</option>
                            <option value="TOWER PROVIDER" {{ $currentSector == 'TOWER PROVIDER' ? 'selected' : '' }}>TOWER PROVIDER</option>
                            <option value="NON TOWER PROVIDER" {{ $currentSector == 'NON TOWER PROVIDER' ? 'selected' : '' }}>NON TOWER PROVIDER</option>

                        </select>
                        @error('sector')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kota --}}
                    <div class="mb-5">
                        <label for="city" class="block text-sm font-medium text-dark-tower mb-1">Kota</label>
                        <input type="text" name="city" id="city"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('city') border-red-500 @enderror"
                            value="{{ old('city') }}">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kontak Perusahaan --}}
                    <div class="mb-5">
                        <label for="company_contact" class="block text-sm font-medium text-dark-tower mb-1">Kontak Perusahaan</label>
                        <input type="text" name="company_contact" id="company_contact"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('company_contact') border-red-500 @enderror"
                            value="{{ old('company_contact') }}">
                        @error('company_contact')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>



                    {{-- Tanggal Kerja Sama --}}
                    <div class="mb-6">
                        <label for="partnership_date" class="block text-sm font-medium text-dark-tower mb-1">Tanggal Kerja Sama</label>
                        <input type="date" name="partnership_date" id="partnership_date" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('partnership_date') border-red-500 @enderror"
                            value="{{ old('partnership_date') }}">
                        @error('partnership_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                        <button type="submit"
                            class="bg-accent-tower text-white px-8 py-2 rounded-lg font-semibold hover:bg-accent-dark transition-colors duration-200 shadow-md flex items-center space-x-2">
                            <i class="fas fa-save mr-2"></i> Tambah Mitra
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </body>

    </html>

@endsection
