@extends('admin.layouts.app')
@section('title','Edit Produk')

@section('content')

<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h4 class="text-2xl font-bold text-gray-800 mb-6">Edit Produk</h4>

    {{-- Pesan Error Validasi --}}
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline"> Ada beberapa masalah dengan input Anda.</span>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-xl rounded-lg p-6 md:p-8">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- 🛑 Tipe Produk (Barang/Jasa) --}}
                <div class="col-span-full md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Tipe Produk <span class="text-red-500">*</span>
                    </label>
                    <div class="flex items-center space-x-4">

                        {{-- Radio Barang --}}
                        <div class="flex items-center">
                            <input class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                type="radio" name="type" id="type_barang" value="barang"
                                {{ old('type', $product->type) == 'barang' ? 'checked' : '' }} required>
                            <label class="ml-2 block text-sm text-gray-700" for="type_barang">Barang</label>
                        </div>

                        {{-- Radio Jasa --}}
                        <div class="flex items-center">
                            <input class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                                type="radio" name="type" id="type_jasa" value="jasa"
                                {{ old('type', $product->type) == 'jasa' ? 'checked' : '' }} required>
                            <label class="ml-2 block text-sm text-gray-700" for="type_jasa">Jasa</label>
                        </div>
                    </div>
                    @error('type')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Nama Produk --}}
                <div class="col-span-full md:col-span-1">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="col-span-full md:col-span-1">
                    <label for="price" class="block text-sm font-medium text-gray-700">
                        Harga <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    @error('price')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="col-span-full">
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Deskripsi <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                              required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Gambar Produk --}}
                <div class="col-span-full md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Gambar Produk (Biarkan kosong jika tidak ingin mengubah)
                    </label>

                    {{-- Preview Gambar Lama --}}
                    @if($product->image)
                        <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
                        <img src="{{ asset('storage/'.$product->image) }}" alt="Gambar Produk Lama"
                             class="mb-3 rounded-md shadow-sm object-cover h-24 w-auto border border-gray-200">
                    @else
                        <p class="text-sm text-gray-500 mb-3">Belum ada gambar.</p>
                    @endif

                    {{-- Input File Baru --}}
                    <input type="file" name="image" id="image"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <p class="mt-1 text-xs text-gray-500">Maksimal 4MB. Gambar baru akan menimpa gambar lama.</p>
                    @error('image')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end space-x-3">

                {{-- Tombol Update --}}
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-3m-7-4l2-2m0 0l2 2m-2-2v6"></path></svg>
                    Update
                </button>

                {{-- Tombol Kembali --}}
                <a href="{{ route('admin.products.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
