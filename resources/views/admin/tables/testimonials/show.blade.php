@extends('admin.layouts.app')

@section('title', 'Detail Testimoni')

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
    <h4 class="text-2xl font-bold mb-6 text-dark-tower">Detail Testimoni</h4>

    {{-- Card Detail --}}
    <div class="bg-white rounded-xl shadow-soft mb-6 p-6 md:p-8">
        <div class="flex flex-col md:flex-row items-center">

            {{-- Bagian Foto (30% Lebar di md:) --}}
            <div class="w-full md:w-1/4 text-center mb-6 md:mb-0 md:pr-6">
                @if($testimonial->photo && Storage::disk('public')->exists($testimonial->photo))
                    <img src="{{ asset('storage/'.$testimonial->photo) }}"
                         class="rounded-full mx-auto shadow-md object-cover border-4 border-gray-100"
                         style="width: 160px; height: 160px;"
                         alt="Foto Testimoni">
                @else
                    <div class="bg-gray-100 p-8 rounded-full text-gray-500 shadow-sm inline-block">
                        <i class="fas fa-user-circle text-6xl"></i>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Tidak ada foto</p>
                @endif
            </div>

            {{-- Bagian Konten (70% Lebar di md:) --}}
            <div class="w-full md:w-3/4">
                {{-- Nama --}}
                <h4 class="text-3xl font-bold text-dark-tower mb-3">{{ $testimonial->name ?? 'Anonim' }}</h4>

                {{-- Pesan --}}
                <p class="text-lg text-gray-700 leading-relaxed italic border-l-4 border-accent-tower pl-4 py-1">
                    "{{ $testimonial->message ?? '-' }}"
                </p>

                {{-- Aksi --}}
                <div class="mt-6 flex flex-wrap gap-3 items-center pt-4 border-t border-gray-100">

                    {{-- Edit (Menggunakan Aksen Oranye) --}}
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"
                       class="bg-accent-tower text-white px-4 py-2 rounded-lg font-semibold hover:bg-accent-dark transition duration-200 shadow-md flex items-center space-x-1 text-sm">
                        <i class="fas fa-pencil-alt"></i> <span>Edit</span>
                    </a>

                    {{-- Hapus (Menggunakan Merah Danger) --}}
                    <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini secara permanen?')"
                          class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-700 transition duration-200 shadow-md flex items-center space-x-1 text-sm">
                            <i class="fas fa-trash-alt"></i> <span>Hapus</span>
                        </button>
                    </form>

                    {{-- Kembali (Menggunakan netral) --}}
                    <a href="{{ route('admin.testimonials.index') }}"
                       class="bg-gray-200 text-dark-tower px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition duration-200 shadow-sm text-sm ml-auto">
                        <i class="fas fa-arrow-left"></i> <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
