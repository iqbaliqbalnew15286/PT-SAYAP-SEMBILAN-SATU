@extends('admin.layouts.app')

@section('title', 'Detail - Galeri')

@section('content')

{{-- Definisi Warna Kustom --}}
<style>
    .text-dark-tower { color: #2C3E50; } /* Biru Tua/Primary */
    .bg-dark-tower { background-color: #2C3E50; }
    .text-accent-tower { color: #FF8C00; } /* Oranye/Accent */
    .bg-accent-tower { background-color: #FF8C00; }
    .hover\:bg-accent-dark:hover { background-color: #E67E22; }
    .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }
</style>

<div class="container mx-auto p-6">

    {{-- Header Halaman --}}
    <h4 class="text-2xl font-bold mb-6 text-dark-tower">Detail Gambar Galeri</h4>

    {{-- Card Detail --}}
    <div class="bg-white rounded-xl shadow-soft p-6 md:p-8">
        <div class="flex flex-wrap -mx-3">

            {{-- 1. Area Tampilan Gambar --}}
            <div class="w-full lg:w-8/12 lg:mx-auto px-3 text-center">
                <h5 class="text-lg font-semibold mb-4 text-gray-500">Pratinjau Gambar</h5>

                @if($gallery->image)
                    {{-- Tampilkan gambar utama dengan ukuran yang lebih besar --}}
                    <div class="inline-block border border-gray-200 rounded-lg shadow-lg p-2 max-w-full">
                        <img src="{{ asset('storage/'.$gallery->image) }}"
                             class="rounded-md w-full h-auto"
                             alt="Gambar Galeri"
                             style="max-height: 500px; object-fit: contain;">
                    </div>
                @else
                    <div class="bg-gray-100 p-8 rounded-lg text-center text-gray-500 border border-dashed">
                        <i class="fas fa-times-circle text-4xl"></i>
                        <p class="mb-0 mt-3 text-lg">Tidak ada gambar terunggah.</p>
                    </div>
                @endif
            </div>

        </div>

        <hr class="mt-8 mb-6 border-t border-gray-100">

        {{-- Area Aksi --}}
        <div class="flex flex-wrap gap-3 justify-center mt-6">

            {{-- Edit (Menggunakan Aksen Oranye) --}}
            <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
               class="bg-accent-tower text-white px-5 py-2 rounded-lg font-semibold hover:bg-accent-dark transition duration-200 shadow-md flex items-center space-x-1 text-sm">
                <i class="fas fa-pencil-alt"></i> <span>Edit Gambar</span>
            </a>

            {{-- Hapus (Menggunakan Merah Danger) --}}
            <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini secara permanen?')"
                  class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 text-white px-5 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-200 shadow-md flex items-center space-x-1 text-sm">
                    <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                </button>
            </form>

            {{-- Kembali (Menggunakan netral) --}}
            <a href="{{ route('admin.galleries.index') }}"
               class="bg-gray-200 text-dark-tower px-5 py-2 rounded-lg font-semibold hover:bg-gray-300 transition duration-200 shadow-sm text-sm">
                <i class="fas fa-arrow-left"></i> <span>Kembali ke Galeri</span>
            </a>
        </div>
    </div>
</div>

@endsection
