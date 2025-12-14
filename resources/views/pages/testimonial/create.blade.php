@extends('layouts.app')

@section('title', 'Kirim Testimoni - PT. Rizqallah Boer Makmur')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-6 text-center">Kirim Testimoni</h1>
        <p class="text-gray-600 mb-8 text-center">
            Bagikan pengalaman Anda dengan PT. Rizqallah Boer Makmur. Testimoni Anda akan ditinjau oleh admin sebelum ditampilkan.
        </p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('testimonial.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-rbm-accent focus:border-rbm-accent">
            </div>

            <div>
                <label for="company" class="block text-sm font-medium text-gray-700">Perusahaan (Opsional)</label>
                <input type="text" name="company" id="company" value="{{ old('company') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-rbm-accent focus:border-rbm-accent">
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Pesan Testimoni *</label>
                <textarea name="message" id="message" rows="5" required
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-rbm-accent focus:border-rbm-accent"
                          placeholder="Tuliskan pengalaman Anda dengan PT. Rizqallah Boer Makmur...">{{ old('message') }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-rbm-accent text-white px-6 py-2 rounded-md font-semibold hover:bg-opacity-90 transition-colors">
                    Kirim Testimoni
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
