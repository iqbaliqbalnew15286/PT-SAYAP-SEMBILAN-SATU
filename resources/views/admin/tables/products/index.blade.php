@extends('admin.layouts.app')

@section('title', 'Daftar Produk')

@section('content')

<style>
    /* 🎨 Styling Kustom Tailwind (Tower Theme) */
    :root {
        --dark-tower: #2C3E50; /* Biru Tua/Dark Blue */
        --accent-tower: #FF8C00; /* Oranye/Emas */
        --border-subtle: #DDE1E8;
    }
    .text-dark-tower { color: var(--dark-tower); }
    .bg-dark-tower { background-color: var(--dark-tower); }
    .text-accent-tower { color: var(--accent-tower); }
    .bg-accent-tower { background-color: var(--accent-tower); }
    .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); }

    /* Gaya Tabel */
    .table-header-cell {
        color: #7F8C8D;
        border-bottom: 2px solid var(--border-subtle);
        padding-top: 1rem;
        padding-bottom: 1rem;
        font-weight: 600;
        vertical-align: middle;
    }
    .table-data-cell {
        border-bottom: 1px solid var(--border-subtle);
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    .table-row-hover:hover {
        background-color: #F8F9FA;
    }
    /* Style untuk Active Tab */
    .tab-active {
        border-bottom: 3px solid var(--accent-tower);
        color: var(--dark-tower);
        font-weight: 700;
    }
</style>

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- Header Halaman --}}
    <div class="flex items-center justify-between mb-6 border-b pb-4">
        <h1 class="text-3xl font-bold text-dark-tower">
            <i class="fas fa-cubes me-2 text-accent-tower"></i> Daftar Produk
        </h1>

        {{-- Tombol Tambah Produk --}}
        <a href="{{ route('admin.products.create') }}" class="bg-accent-tower text-dark-tower px-4 py-2 rounded-xl font-semibold shadow-md hover:bg-orange-500 transition duration-200 text-sm flex items-center">
            <i class="fas fa-plus-circle me-1"></i> Tambah Produk
        </a>
    </div>

    {{-- Area Alert (Sukses/Error) --}}
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
            <div class="flex items-center">
                <i class="fas fa-check-circle me-3 text-green-600"></i>
                <p class="font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    {{-- 🛑 FILTER TABS (Logika untuk memfilter tampilan) --}}
    <div class="flex border-b border-gray-200 mb-6 space-x-6">
        @php
            // Fungsi helper untuk menentukan apakah sebuah tab sedang aktif
            // Variabel $filterType berasal dari ProductController
            $isTabActive = fn($type) => isset($filterType) && $filterType == $type;
            $currentFilter = $filterType ?? 'all'; // Default: 'all'
        @endphp

        {{-- 1. Tab Semua Produk --}}
        <a href="{{ route('admin.products.index') }}"
           class="py-3 px-1 transition duration-150 ease-in-out text-gray-500 hover:text-dark-tower
           {{ $currentFilter == 'all' ? 'tab-active' : '' }}">
           Semua Produk
        </a>

        {{-- 2. Tab Barang --}}
        <a href="{{ route('admin.products.index', ['type' => 'barang']) }}"
           class="py-3 px-1 transition duration-150 ease-in-out text-gray-500 hover:text-dark-tower
           {{ $isTabActive('barang') ? 'tab-active' : '' }}">
           Barang
        </a>

        {{-- 3. Tab Jasa --}}
        <a href="{{ route('admin.products.index', ['type' => 'jasa']) }}"
           class="py-3 px-1 transition duration-150 ease-in-out text-gray-500 hover:text-dark-tower
           {{ $isTabActive('jasa') ? 'tab-active' : '' }}">
           Jasa
        </a>
    </div>
    {{-- 🛑 AKHIR FILTER TABS --}}


    {{-- Tabel Konten --}}
    <div class="bg-white rounded-xl shadow-soft overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="table-header-cell text-center w-12">No</th>
                        <th class="table-header-cell text-left w-1/5">Nama</th>
                        <th class="table-header-cell text-left w-2/5">Deskripsi</th>
                        <th class="table-header-cell text-left w-1/6">Harga</th>
                        <th class="table-header-cell text-center w-16">Gambar</th>
                        <th class="table-header-cell text-center w-16 border-0">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    {{-- Pastikan $products dikirim dari controller sebagai LengthAwarePaginator (bukan Collection biasa) --}}
                    @forelse($products as $index => $product)
                        <tr class="table-row-hover">
                            {{-- No. (Menggunakan index pagination) --}}
                            {{-- $products->firstItem() adalah method Paginator Laravel --}}
                            <td class="table-data-cell text-center text-gray-500">{{ $products->firstItem() + $loop->index }}</td>

                            {{-- Nama Produk & Tipe --}}
                            <td class="table-data-cell text-left font-semibold text-dark-tower">
                                {{ $product->name }}

                                @php
                                    $typeClass = $product->type == 'barang' ? 'bg-indigo-100 text-indigo-800' : 'bg-green-100 text-green-800';
                                @endphp
                                <span class="ms-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $typeClass }}">
                                    {{ Str::ucfirst($product->type) }}
                                </span>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="table-data-cell text-left text-sm text-gray-700">
                                {{ Str::limit($product->description, 60) }}
                            </td>

                            {{-- Harga --}}
                            <td class="table-data-cell text-left font-bold text-green-600">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>

                            {{-- Gambar --}}
                            <td class="table-data-cell text-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" width="45" height="45"
                                        class="rounded-md object-cover border border-gray-200 mx-auto" alt="Gambar Produk">
                                @else
                                    <span class="text-xs text-gray-500">N/A</span>
                                @endif
                            </td>

                            {{-- Aksi (Action Buttons) --}}
                            <td class="table-data-cell text-center">
                                <div class="flex justify-center space-x-2">
                                    {{-- Show --}}
                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                        class="text-cyan-500 hover:text-cyan-700 p-1" title="Detail">
                                        <i class="fas fa-eye text-sm"></i>
                                    </a>

                                    {{-- Edit --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="text-yellow-500 hover:text-yellow-700 p-1" title="Edit">
                                        <i class="fas fa-pencil-alt text-sm"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ $product->name }} secara permanen?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 p-1" title="Hapus">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="table-data-cell text-center py-12">
                                <div class="text-center">
                                    <i class="fas fa-info-circle text-4xl mb-3 text-accent-tower"></i>
                                    <h4 class="text-xl font-semibold text-dark-tower">Belum ada Produk yang ditambahkan.</h4>
                                    <p class="text-gray-500 mt-1">Silakan klik tombol 'Tambah Produk' di atas untuk menambahkan data.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- 🛑 PAGINATION --}}
    @if(isset($products) && $products instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-6">
            {{-- Menggunakan withQueryString() untuk mempertahankan filter 'type' pada link pagination --}}
            {{ $products->withQueryString()->links() }}
        </div>
    @endif
</div>

@endsection
