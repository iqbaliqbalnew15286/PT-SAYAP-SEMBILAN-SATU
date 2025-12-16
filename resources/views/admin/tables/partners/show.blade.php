@extends('admin.layouts.app')

@section('title', 'Detail Mitra Industri: ' . ($partner->name ?? ''))

@section('content')

    <!DOCTYPE html>
    <html lang="id">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail Mitra Industri: {{ $partner->name ?? 'Mitra' }}</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            /* Definisi Warna Kustom (Tower Theme) */
            .text-dark-tower { color: #2C3E50; } /* Biru Tua/Dark Blue */
            .bg-dark-tower { background-color: #2C3E50; }
            .text-accent-tower { color: #FF8C00; } /* Oranye/Emas */
            .bg-accent-tower { background-color: #FF8C00; }
            .hover\:bg-accent-dark:hover { background-color: #E67E22; } /* Hover gelap */
            .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f0f2f5;
            }
        </style>
    </head>

    <body class="bg-gray-100">

        <div class="main-content flex-1 p-4 md:p-6">
            <div class="bg-white rounded-xl shadow-soft p-6 md:p-8">

                {{-- Header --}}
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 border-b pb-4 border-gray-100">
                    <h1 class="text-3xl font-bold text-dark-tower flex items-center mb-4 sm:mb-0">
                        <i class="fas fa-building text-accent-tower mr-3"></i> Detail Mitra: {{ $partner->name ?? 'N/A' }}
                    </h1>

                    {{-- Tombol Aksi --}}
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.partners.index') }}"
                            class="bg-gray-200 text-dark-tower px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2 text-sm shadow-sm">
                            <i class="fas fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                            class="bg-accent-tower text-white px-4 py-2 rounded-lg font-semibold hover:bg-accent-dark transition-colors duration-200 flex items-center space-x-2 text-sm shadow-md">
                            <i class="fas fa-edit"></i>
                            <span>Edit</span>
                        </a>
                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra {{ $partner->name }}? Aksi ini tidak dapat dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-red-600 transition-colors duration-200 flex items-center space-x-2 text-sm shadow-md">
                                <i class="fas fa-trash-alt"></i>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Konten Utama (Logo dan Detail) --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                    {{-- Kolom Kiri: Logo --}}
                    <div class="lg:col-span-1 flex flex-col items-center p-6 border border-gray-100 rounded-lg shadow-sm bg-gray-50">
                        <h2 class="text-xl font-semibold text-dark-tower mb-4">Logo Perusahaan</h2>
                        @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }} Logo"
                                class="w-48 h-48 md:w-64 md:h-64 object-contain rounded-lg shadow-md border-2 border-gray-200 bg-white p-3">
                        @else
                            <div class="w-48 h-48 md:w-64 md:h-64 bg-gray-200 flex items-center justify-center rounded-lg border border-dashed border-gray-400">
                                <i class="fas fa-image fa-3x text-gray-500"></i>
                            </div>
                            <p class="text-sm text-red-500 mt-2">Logo belum diunggah</p>
                        @endif

                        {{-- Badge Jenis Mitra (type) --}}
                        <div class="mt-6">
                            @php
                                $type = strtoupper($partner->type ?? '');
                                if (empty($type)) {
                                    $label = 'BELUM DITENTUKAN';
                                    $color = 'bg-gray-300 text-gray-800';
                                    $icon = 'fa-question-circle';
                                } elseif ($type === 'TOWER PROVIDER') {
                                    $label = 'TOWER PROVIDER';
                                    $color = 'bg-blue-100 text-blue-800';
                                    $icon = 'fa-broadcast-tower';
                                } else { // NON TOWER PROVIDER atau yang lain
                                    $label = 'NON TOWER PROVIDER';
                                    $color = 'bg-orange-100 text-orange-800';
                                    $icon = 'fa-lightbulb';
                                }
                            @endphp
                            <span class="py-2 px-4 rounded-full text-sm font-bold {{ $color }} shadow-sm">
                                <i class="fas {{ $icon }} mr-2"></i> {{ $label }}
                            </span>
                        </div>

                    </div>

                    {{-- Kolom Kanan: Detail & Deskripsi --}}
                    <div class="lg:col-span-2">

                        {{-- Detail Kemitraan --}}
                        <div class="mb-8 p-6 border border-gray-100 rounded-lg shadow-sm bg-white">
                            <h2 class="text-xl font-semibold text-dark-tower mb-4 border-b pb-2">
                                <i class="fas fa-info-circle text-accent-tower mr-2"></i> Informasi Kemitraan
                            </h2>
                            <div class="space-y-3 text-gray-700">
                                {{-- Catatan: type sudah ditampilkan di badge --}}
                                @include('admin.components.detail-row', ['icon' => 'fas fa-cogs', 'label' => 'Sektor', 'value' => $partner->sector])
                                @include('admin.components.detail-row', ['icon' => 'fas fa-map-marker-alt', 'label' => 'Kota', 'value' => $partner->city])
                                @include('admin.components.detail-row', ['icon' => 'fas fa-phone', 'label' => 'Kontak Perusahaan', 'value' => $partner->company_contact])
                                @include('admin.components.detail-row', ['icon' => 'fas fa-calendar-alt', 'label' => 'Tanggal Kerja Sama', 'value' => $partner->partnership_date ? \Carbon\Carbon::parse($partner->partnership_date)->format('d F Y') : '-'])
                                @include('admin.components.detail-row', ['icon' => 'fas fa-user-tag', 'label' => 'Penerbit', 'value' => $partner->publisher])
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div class="p-6 border border-gray-100 rounded-lg shadow-sm bg-white">
                            <h2 class="text-xl font-semibold text-dark-tower mb-4 border-b pb-2">
                                <i class="fas fa-file-alt text-accent-tower mr-2"></i> Deskripsi
                            </h2>
                            <div class="text-gray-700 leading-relaxed min-h-[100px]">
                                <p>{{ $partner->description ?? 'Tidak ada deskripsi yang tersedia.' }}</p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </body>

    </html>

@endsection

{{-- --- FILE PENDUKUNG YANG DIASUMSIKAN ADA: detail-row.blade.php --- --}}
{{-- Anda harus memastikan file ini ada di resources/views/admin/components/detail-row.blade.php --}}
{{--
<div class="flex items-start">
    <div class="w-1/3 font-medium text-dark-tower flex items-center">
        <i class="{{ $icon }} mr-2 text-accent-tower w-4"></i> {{ $label }}
    </div>
    <div class="w-2/3 break-words">
        : {{ $value ?? '-' }}
    </div>
</div>
--}}
