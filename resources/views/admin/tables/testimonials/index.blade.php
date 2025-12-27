@extends('admin.layouts.app')

@section('title', 'Testimoni - Admin')

@section('content')

{{-- Inisialisasi Kustom Tailwind CSS --}}
<style>
    /* Definisi Warna Kustom (Tower Theme - Dark Blue/Orange) */
    .text-dark-tower { color: #2C3E50; } /* Biru Tua/Primary */
    .bg-dark-tower { background-color: #2C3E50; }
    .text-accent-tower { color: #FF8C00; } /* Oranye/Accent */
    .bg-accent-tower { background-color: #FF8C00; }
    .hover\:bg-accent-dark:hover { background-color: #E67E22; }
    .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

    /* Warna tambahan */
    .border-subtle-gray { border-color: #e0e0e0; }
</style>

<div class="container mx-auto p-6">

    {{-- Header Halaman & Tombol Aksi --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-dark-tower">Testimoni</h1>

        {{-- Tombol Tambah --}}
        <a href="{{ route('admin.testimonials.create') }}"
           class="bg-accent-tower hover:bg-accent-dark text-dark-tower px-4 py-2 rounded-lg font-semibold transition duration-200 shadow-md flex items-center space-x-2 text-sm">
            <i class="fas fa-plus-circle mr-1"></i> <span>Tambah Testimoni</span>
        </a>
    </div>

    {{-- Informasi Jumlah Data --}}
    <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/3 pr-2">
            <div class="bg-white p-4 rounded-xl shadow-soft border-l-4 border-accent-tower">
                @php
                    // Pastikan $testimonials adalah Collection atau memiliki method count()
                    $totalTestimonials = $testimonials->count() ?? 0;
                @endphp
                <p class="text-sm font-medium text-accent-tower uppercase">Total Testimoni</p>
                <p class="text-2xl font-bold text-dark-tower">{{ $totalTestimonials }}</p>
            </div>
        </div>
    </div>

    {{-- Alert sukses --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-md" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    {{-- Tabel Testimoni --}}
    <div class="bg-white rounded-xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 border-r border-subtle-gray" style="width: 5%;">No</th>
                        <th class="py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 border-r border-subtle-gray" style="width: 10%;">Foto</th>
                        <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 border-r border-subtle-gray" style="width: 20%;">Nama</th>
                        <th class="py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 border-r border-subtle-gray" style="width: 50%;">Pesan</th>
                        <th class="py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500" style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($testimonials as $t)
                        <tr class="hover:bg-gray-50 transition duration-150">
                            {{-- No. --}}
                            <td class="px-4 py-3 text-center text-sm text-gray-500 border-r border-subtle-gray">{{ $loop->iteration }}</td>

                            {{-- Foto Testimoni --}}
                            <td class="px-4 py-3 text-center border-r border-subtle-gray">
                                @if($t->image && Storage::disk('public')->exists($t->image))
                                    <img src="{{ asset('storage/'.$t->image) }}" width="50" height="50"
                                         class="rounded-full mx-auto object-cover border border-gray-200" alt="Foto Klien">
                                @else
                                    <i class="fas fa-user-circle text-4xl text-gray-400"></i>
                                @endif
                            </td>

                            {{-- Nama Klien --}}
                            <td class="px-4 py-3 text-left font-medium text-dark-tower border-r border-subtle-gray">{{ $t->name ?? '-' }}</td>

                            {{-- Pesan --}}
                            <td class="px-4 py-3 text-left text-sm text-gray-700 border-r border-subtle-gray">{{ Str::limit($t->message ?? '-', 60) }}</td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center space-x-3">

                                    {{-- Show (Menggunakan Icon Mata/Eye) --}}
                                    <a href="{{ route('admin.testimonials.show', $t->id) }}"
                                       class="text-gray-500 hover:text-dark-tower transition duration-150" title="Detail">
                                        <i class="fas fa-eye text-lg"></i>
                                    </a>

                                    {{-- Edit (Menggunakan Icon Pensil/Edit) --}}
                                    <a href="{{ route('admin.testimonials.edit', $t->id) }}"
                                       class="text-gray-500 hover:text-accent-tower transition duration-150" title="Edit">
                                        <i class="fas fa-edit text-lg"></i>
                                    </a>

                                    {{-- Delete (Menggunakan Icon Tong Sampah/Trash) --}}
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-600 transition duration-150" title="Hapus"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini secara permanen?')">
                                            <i class="fas fa-trash-alt text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 bg-gray-50">
                                <i class="fas fa-comment-dots text-5xl mb-3 text-accent-tower"></i>
                                <h4 class="text-xl font-semibold text-dark-tower">Belum ada Testimoni.</h4>
                                <p class="text-gray-500 mt-2">Silakan klik tombol 'Tambah Testimoni' di atas untuk menambahkan masukan klien.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
