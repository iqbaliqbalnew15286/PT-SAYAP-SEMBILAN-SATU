@extends('layouts.app')

@section('title', 'Tambah Testimoni')

@section('content')

    <style>
        .text-dark-tower {
            color: #2C3E50;
        }

        .bg-dark-tower {
            background-color: #2C3E50;
        }

        .text-accent-tower {
            color: #FF8C00;
        }

        .bg-accent-tower {
            background-color: #FF8C00;
        }

        .hover\:bg-accent-dark:hover {
            background-color: #E67E22;
        }

        .shadow-soft {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        input[type="file"]::file-selector-button {
            background-color: #f3f4f6;
            color: #374151;
            border: none;
            padding: 0.5rem 1rem;
            margin-right: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background-color: #e5e7eb;
        }
    </style>

    <div class="container mx-auto px-4 md:px-8 py-8">
        <div class="bg-white rounded-2xl shadow-soft overflow-hidden">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 md:px-8 py-5 border-b">
                <div>
                    <h4 class="text-2xl font-bold text-dark-tower">Tambah Testimoni Baru</h4>
                    <p class="text-sm text-gray-500 mt-1">Isi data testimoni pelanggan dengan lengkap</p>
                </div>
                <div class="hidden md:block w-12 h-12 rounded-full bg-accent-tower/10 flex items-center justify-center">
                    <i class="fas fa-comment-dots text-accent-tower text-xl"></i>
                </div>
            </div>

            {{-- Form --}}
            <form action="{{ route('testimonial.store') }}" method="POST" class="px-6 md:px-8 py-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-dark-tower mb-2">
                            Nama <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Perusahaan --}}
                    <div>
                        <label for="company" class="block text-sm font-semibold text-dark-tower mb-2">
                            Perusahaan (Opsional)
                        </label>
                        <input type="text" name="company" id="company" value="{{ old('company') }}"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition @error('company') border-red-500 @enderror">
                        @error('company')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Pesan --}}
                    <div class="md:col-span-2">
                        <label for="message" class="block text-sm font-semibold text-dark-tower mb-2">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" id="message" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-accent-tower focus:border-accent-tower transition resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Tombol --}}
                <div class="mt-10 flex items-center justify-end gap-3 pt-6 border-t">

                    <a href="{{ route('admin.testimonials.index') }}"
                        class="px-6 py-2.5 rounded-xl font-semibold bg-gray-100 text-dark-tower hover:bg-gray-200 transition text-sm">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-6 py-2.5 rounded-xl font-semibold bg-dark-tower text-white hover:bg-gray-800 transition shadow-md flex items-center gap-2 text-sm">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>

                </div>
            </form>
        </div>
    </div>

@endsection
