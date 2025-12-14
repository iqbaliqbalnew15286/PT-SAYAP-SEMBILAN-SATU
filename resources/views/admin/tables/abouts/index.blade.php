@extends('admin.layouts.app')

@section('title', 'Profil & Deskripsi Properti')

@section('content')
    {{-- Memastikan Tailwind & Font Awesome di-load --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />

    {{-- Gaya Kustom (Menggunakan warna tema Tower) --}}
    <style>
        /* Definisi Warna Kustom di Tailwind (diasumsikan sudah dikonfigurasi, tapi ditambahkan di sini untuk kepastian) */
        .text-dark-tower { color: #2C3E50; } /* Biru Tua */
        .bg-dark-tower { background-color: #2C3E50; }
        .text-accent-tower { color: #FF8C00; } /* Oranye/Emas */
        .bg-accent-tower { background-color: #FF8C00; }
        .border-accent-tower { border-color: #FF8C00; }
        .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

        body { font-family: 'Poppins', sans-serif; }
    </style>

    <div class="p-4 md:p-8">

        {{-- Header Halaman & Tombol Aksi --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-dark-tower flex items-center">
                <i class="fas fa-info-circle text-accent-tower mr-2 text-xl"></i> Profil & Deskripsi
            </h1>

            {{-- Tombol Tambah Data --}}
            <a href="{{ route('admin.abouts.create') }}"
               class="px-4 py-2 text-dark-tower bg-accent-tower rounded-lg font-semibold transition duration-300 hover:bg-opacity-90 shadow-md">
                <i class="fas fa-plus-circle mr-1"></i> Tambah Data
            </a>
        </div>

        {{-- Alert Sukses --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-[#155724] bg-[#d4edda] border border-[#c3e6cb] rounded-lg relative" role="alert">
                {{ session('success') }}
                <button type="button" class="absolute top-2 right-2 text-[#155724] opacity-50 hover:opacity-100" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                    <span class="text-xl">&times;</span>
                </button>
            </div>
        @endif

        {{-- Alert Error --}}
        @if(session('error'))
            <div class="p-4 mb-4 text-sm text-[#721c24] bg-[#f8d7da] border border-[#f5c6cb] rounded-lg relative" role="alert">
                {{ session('error') }}
                <button type="button" class="absolute top-2 right-2 text-[#721c24] opacity-50 hover:opacity-100" data-dismiss="alert" aria-label="Close" onclick="this.parentElement.style.display='none';">
                    <span class="text-xl">&times;</span>
                </button>
            </div>
        @endif

        {{-- Tabel Konten (Card Tailwind) --}}
        <div class="bg-white rounded-xl shadow-soft mb-8 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="bg-gray-50">
                            {{-- Header Kolom --}}
                            <th class="px-4 py-3 text-center text-xs font-bold text-dark-tower uppercase tracking-wider border-b-2 border-accent-tower w-[5%]">No</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-dark-tower uppercase tracking-wider border-b-2 border-accent-tower w-[35%]">Visi</th>
                            <th class="px-4 py-3 text-left text-xs font-bold text-dark-tower uppercase tracking-wider border-b-2 border-accent-tower w-[35%]">Misi</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-dark-tower uppercase tracking-wider border-b-2 border-accent-tower w-[15%]">Gambar Pendukung</th>
                            <th class="px-4 py-3 text-center text-xs font-bold text-dark-tower uppercase tracking-wider border-b-2 border-accent-tower w-[10%]">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                    @forelse($abouts as $index => $about)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            {{-- No. --}}
                            <td class="px-4 py-4 text-center text-sm text-gray-500">{{ $index + 1 }}</td>

                            {{-- Konten Visi & Misi --}}
                            <td class="px-4 py-4 text-left text-sm text-dark-tower">{{ Str::limit($about->vision, 90) }}</td>
                            <td class="px-4 py-4 text-left text-sm text-dark-tower">{{ Str::limit($about->mission, 90) }}</td>

                            {{-- Gambar --}}
                            <td class="px-4 py-4 text-center">
                                @if($about->image)
                                    <img src="{{ asset('storage/'.$about->image) }}" width="50" height="50"
                                        class="rounded-full object-cover mx-auto shadow-sm border border-gray-200" alt="gambar">
                                @else
                                    <span class="text-gray-400 text-xs">N/A</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-4 text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- Show (Info: Teal/Cyan) --}}
                                    <a href="{{ route('admin.abouts.show', $about->id) }}"
                                       class="text-[#36b9cc] hover:text-cyan-700 p-2 rounded-full transition duration-150" title="Detail">
                                        <i class="fas fa-eye text-base"></i>
                                    </a>

                                    {{-- Edit (Accent: Orange/Emas) --}}
                                    <a href="{{ route('admin.abouts.edit', $about->id) }}"
                                       class="text-accent-tower hover:text-orange-700 p-2 rounded-full transition duration-150" title="Edit">
                                        <i class="fas fa-pencil-alt text-base"></i>
                                    </a>

                                    {{-- Delete (Danger: Red) --}}
                                    <form action="{{ route('admin.abouts.destroy', $about->id) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="text-[#e74a3b] hover:text-red-700 p-2 rounded-full transition duration-150" title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini secara permanen?')">
                                            <i class="fas fa-trash-alt text-base"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-gray-500">
                                <i class="fas fa-info-circle text-accent-tower text-3xl mb-3"></i>
                                <h4 class="text-lg font-semibold text-dark-tower">Data Visi & Misi belum tersedia.</h4>
                                <p class="text-sm">Silakan klik tombol 'Tambah Data' di atas untuk menambahkan informasi.</p>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
