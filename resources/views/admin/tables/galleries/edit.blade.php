@extends('admin.layouts.app')

@section('title', 'Edit Galeri')

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

    {{-- Header Halaman --}}
    <h4 class="text-2xl font-bold mb-6 text-dark-tower">Edit Gambar Galeri</h4>

    <div class="bg-white rounded-xl shadow-soft p-6 md:p-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-6">

                {{-- 1. Tampilan Gambar Saat Ini --}}
                <div class="w-full">
                    <label class="block text-sm font-bold text-dark-tower mb-2">Gambar Saat Ini</label>
                    <div class="border border-gray-200 rounded-lg p-3 inline-block bg-gray-50 shadow-inner">
                        @if($gallery->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($gallery->image))
                            <img src="{{ asset('storage/'.$gallery->image) }}"
                                 class="rounded shadow-sm object-cover"
                                 style="width: 150px; height: 100px;"
                                 alt="Gambar Galeri Saat Ini">
                        @else
                            <p class="text-gray-500 text-sm mb-0 p-2">Tidak ada gambar terunggah.</p>
                        @endif
                    </div>
                </div>

                {{-- 2. Input Gambar Baru --}}
                <div class="w-full">
                    <label for="image" class="block text-sm font-bold text-dark-tower mb-1">Ganti Gambar (Upload Baru)</label>
                    <input type="file" name="image" id="image" accept="image/*"
                           class="w-full border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('image') border-red-500 @enderror">

                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror

                    <p class="text-xs text-gray-500 mt-1">Abaikan kolom ini jika Anda tidak ingin mengganti gambar.</p>
                </div>

            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex items-center space-x-3 pt-4 border-t border-gray-100">

                {{-- Tombol Update (Menggunakan warna Biru Tua/Dark Tower) --}}
                <button type="submit"
                        class="bg-dark-tower text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-700 transition-colors duration-200 shadow-md flex items-center space-x-2 text-sm">
                    <i class="fas fa-sync-alt me-1"></i> <span>Update Gambar</span>
                </button>

                {{-- Tombol Kembali (Warna netral/secondary) --}}
                <a href="{{ route('admin.galleries.index') }}"
                   class="bg-gray-200 text-dark-tower px-6 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 shadow-sm text-sm">
                    Kembali ke Galeri
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
