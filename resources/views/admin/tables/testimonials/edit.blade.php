@extends('admin.layouts.app')

@section('title', 'Edit Testimoni')

@section('content')

{{-- Definisi Warna Kustom --}}
<style>
    .text-dark-tower { color: #2C3E50; } /* Biru Tua/Primary */
    .bg-dark-tower { background-color: #2C3E50; }
    .text-accent-tower { color: #FF8C00; } /* Oranye/Accent */
    .bg-accent-tower { background-color: #FF8C00; }
    .hover\:bg-accent-dark:hover { background-color: #E67E22; } /* Hover gelap */
    .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

    /* Gaya khusus untuk input file agar lebih rapi di Tailwind */
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

<div class="container mx-auto p-6">
    <div class="bg-white rounded-xl shadow-soft p-6 md:p-8">

        {{-- Header --}}
        <h4 class="text-2xl font-bold mb-6 text-dark-tower">Edit Testimoni</h4>

        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Grid Utama --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Nama --}}
                <div class="col-span-1">
                    <label for="name" class="block text-sm font-medium text-dark-tower mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('name') border-red-500 @enderror"
                           value="{{ old('name', $testimonial->name) }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kolom Kosong/Buffer --}}
                <div class="col-span-1 hidden md:block"></div>

                {{-- Pesan (Membutuhkan 100% lebar) --}}
                <div class="md:col-span-2">
                    <label for="message" class="block text-sm font-medium text-dark-tower mb-1">Pesan <span class="text-red-500">*</span></label>
                    <textarea name="message" id="message" rows="4" required
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('message') border-red-500 @enderror">{{ old('message', $testimonial->message) }}</textarea>
                    @error('message')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Foto --}}
                <div class="col-span-1">
                    <label class="block text-sm font-medium text-dark-tower mb-1">Foto Klien (Opsional)</label>

                    {{-- Pratinjau Foto Saat Ini --}}
                    @if($testimonial->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($testimonial->photo))
                        <div class="mb-3 flex items-center space-x-3">
                            <img src="{{ asset('storage/'.$testimonial->photo) }}"
                                 class="w-16 h-16 rounded-full object-cover shadow-md border border-gray-200"
                                 alt="Foto Klien Saat Ini">
                            <span class="text-xs text-gray-500">Foto saat ini</span>
                        </div>
                    @else
                        <span class="text-sm text-gray-500 block mb-3">Belum ada foto terunggah.</span>
                    @endif

                    <input type="file" name="photo" id="photo" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('photo') border-red-500 @enderror">
                    <p class="text-xs text-gray-500 mt-1">Unggah file baru untuk mengganti foto lama.</p>

                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex items-center space-x-3 pt-4 border-t border-gray-100">

                {{-- Tombol Update (Menggunakan warna Biru Tua/Dark Tower) --}}
                <button type="submit"
                        class="bg-dark-tower text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition-colors duration-200 shadow-md flex items-center space-x-2 text-sm">
                    <i class="fas fa-sync-alt me-1"></i> <span>Update</span>
                </button>

                {{-- Tombol Kembali (Warna netral/secondary) --}}
                <a href="{{ route('admin.testimonials.index') }}"
                   class="bg-gray-200 text-dark-tower px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 shadow-sm text-sm">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
