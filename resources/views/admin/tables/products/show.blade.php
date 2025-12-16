@extends('admin.layouts.app')
@section('title', 'Detail Produk')

@section('content')

{{-- Container Utama --}}
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

    {{-- Judul Halaman --}}
    <h3 class="text-3xl font-extrabold text-gray-900 mb-6 flex items-center">
        <svg class="w-8 h-8 mr-3 text-gray-700" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 2a1 1 0 00-1 1v1a1 1 0 002 0V3a1 1 0 00-1-1zm4.364 1.636a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707zm-4.364 8a1 1 0 100 2h.01a1 1 0 100-2H10zm2.828-6.657a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM15 10a1 1 0 11-2 0 1 1 0 012 0zm-7 0a1 1 0 11-2 0 1 1 0 012 0zM17.364 14.364a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM5.636 14.364a1 1 0 00-1.414 1.414l.707.707a1 1 0 001.414-1.414l-.707-.707zM18 10a1 1 0 01-1 1H3a1 1 0 01-1-1 1 1 0 011-1h14a1 1 0 011 1z" clip-rule="evenodd"></path></svg>
        Detail Produk
    </h3>

    {{-- Kartu Produk (Product Card) --}}
    <div class="bg-white rounded-xl shadow-2xl p-6 md:p-8 transition duration-300 ease-in-out hover:shadow-xl">
        <div class="flex flex-col lg:flex-row gap-6 lg:gap-10 items-start">

            {{-- GAMBAR PRODUK --}}
            <div class="w-full lg:w-5/12 text-center">
                @if($product->image)
                    {{-- Menggunakan h-96 untuk tinggi tetap --}}
                    <img src="{{ asset('storage/'.$product->image) }}"
                        class="w-full h-96 object-cover rounded-lg shadow-md"
                        alt="Gambar Produk">
                @else
                    <div class="bg-gray-100 flex items-center justify-center rounded-lg h-96 border border-dashed border-gray-300">
                        <span class="text-gray-500 italic">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            {{-- INFORMASI PRODUK --}}
            <div class="w-full lg:w-7/12">

                {{-- Nama dan Tipe --}}
                <div class="flex items-center mb-4">
                    <h4 class="text-3xl font-bold text-gray-800 mr-4">{{ $product->name }}</h4>

                    {{-- Tampilkan Tipe Produk --}}
                    @if($product->type == 'barang')
                        <span class="px-3 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full">Barang</span>
                    @elseif($product->type == 'jasa')
                        <span class="px-3 py-1 text-sm font-semibold text-indigo-800 bg-indigo-100 rounded-full">Jasa</span>
                    @endif
                </div>

                {{-- INFORMASI DETAIL --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 border-b pb-4 border-gray-100">

                    {{-- Slug --}}
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Slug (URL Identitas)</p>
                        <p class="text-gray-700 font-medium break-words">{{ $product->slug ?? '-' }}</p>
                    </div>

                    {{-- Harga --}}
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-1">Harga</p>
                        <p class="text-2xl font-bold text-green-600">
                            {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : 'Gratis / Tanyakan Harga' }}
                        </p>
                    </div>
                </div>

                <hr class="my-4 border-gray-200">

                {{-- Deskripsi --}}
                <p class="text-sm font-semibold text-gray-500 mb-2">Deskripsi</p>
                <div class="text-gray-600 leading-relaxed mb-6">
                    {{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}
                </div>

                <hr class="my-4 border-gray-200">

                {{-- Waktu Pembuatan/Pembaruan --}}
                <div class="flex flex-col sm:flex-row justify-between text-xs text-gray-500 italic mb-6">
                    <p class="flex items-center mb-2 sm:mb-0">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Dibuat: {{ $product->created_at->isoFormat('D MMM YYYY, H:mm') }}
                    </p>
                    <p class="flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.962 8.962 0 0112 20a9 9 0 01-8.632-12.441M12 2v2m0 16v2m-4.5-5.5h-2.164m.926 2.39-1.442 1.442M18 10h2.164m-.926 2.39 1.442 1.442M12 6a4 4 0 100 8 4 4 0 000-8z"></path></svg>
                        Diperbarui: {{ $product->updated_at->isoFormat('D MMM YYYY, H:mm') }}
                    </p>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="flex flex-wrap gap-3 mt-4 pt-4 border-t border-gray-100">

                    {{-- Tombol Edit --}}
                    <a href="{{ route('admin.products.edit', $product->id) }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Edit
                    </a>

                    {{-- Tombol Hapus --}}
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini secara permanen? Tindakan ini tidak dapat dibatalkan.')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition duration-150 ease-in-out">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus
                        </button>
                    </form>

                    {{-- Tombol Kembali --}}
                    <a href="{{ route('admin.products.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out ml-auto">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"></path></svg>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
