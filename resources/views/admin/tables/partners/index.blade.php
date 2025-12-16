@extends('admin.layouts.app')

@section('title', 'Daftar Mitra Industri')

@section('content')

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mitra Industri</title>
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Font Awesome untuk ikon --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    {{-- Google Fonts: Poppins --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Definisi Warna Kustom (Tower Theme) */
        .text-dark-tower { color: #2C3E50; } /* Biru Tua/Dark Blue */
        .bg-dark-tower { background-color: #2C3E50; }
        .text-accent-tower { color: #FF8C00; } /* Oranye/Emas */
        .bg-accent-tower { background-color: #FF8C00; }
        .hover\:bg-accent-dark:hover { background-color: #E67E22; } /* Hover gelap */
        .focus\:ring-accent-tower:focus { --tw-ring-color: #FF8C00; }
        .shadow-soft { box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08); }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }

        /* Menyembunyikan panah default pada input search */
        input[type='search']::-webkit-search-decoration,
        input[type='search']::-webkit-search-cancel-button,
        input[type='search']::-webkit-search-results-button,
        input[type='search']::-webkit-search-results-decoration {
            -webkit-appearance: none;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="main-content flex-1 p-4 sm:p-6">
        <div class="bg-white rounded-xl shadow-soft p-4 sm:p-6">
            {{-- Header: Judul, Cari, dan Tombol Tambah --}}
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4 border-b pb-4 border-gray-100">
                <h1 class="text-3xl font-bold text-dark-tower">Daftar Mitra Industri</h1>
                <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto">
                    {{-- Fitur Pencarian --}}
                    <div class="relative w-full sm:w-64">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <i class="fas fa-search text-gray-400"></i>
                        </span>
                        <input type="search" id="searchInput" placeholder="Cari berdasarkan nama..."
                            class="w-full pl-10 pr-4 py-2 border rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-accent-tower">
                    </div>
                    {{-- Tombol Tambah Mitra (Tower Theme) --}}
                    <a href="{{ route('admin.partners.create') }}"
                        class="bg-accent-tower text-white px-4 py-2 rounded-lg font-semibold hover:bg-accent-dark transition-colors duration-200 flex items-center justify-center space-x-2 w-full sm:w-auto shadow-md">
                        <i class="fas fa-plus"></i>
                        <span>Tambah Mitra</span>
                    </a>
                </div>
            </div>

            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg shadow-sm"
                    role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            {{-- Menghitung statistik (Menggunakan 'sector' untuk kategori TOWER/NON TOWER) --}}
            @php
                $totalPartners = $partners->count();
                $filledContacts = $partners->filter(fn($p) => !empty($p->company_contact))->count();
                $emptyContacts = $totalPartners - $filledContacts;
                $filledLogos = $partners->filter(fn($p) => !empty($p->logo))->count();
                $emptyLogos = $totalPartners - $filledLogos;
                $filledCities = $partners->filter(fn($p) => !empty($p->city))->count();
                $emptyCities = $totalPartners - $filledCities;

                // STATS BARU: Menggunakan kolom 'sector' sebagai sumber untuk kategori TOWER/NON TOWER
                $towerProviders = $partners->filter(fn($p) => strtoupper($p->sector ?? '') === 'TOWER PROVIDER')->count();
                $nonTowerProviders = $partners->filter(fn($p) => strtoupper($p->sector ?? '') === 'NON TOWER PROVIDER')->count();

                // Menghitung mitra yang memiliki nilai 'sector' selain 2 kategori di atas
                $otherSectors = $partners->filter(function($p) {
                    $sector = strtoupper($p->sector ?? '');
                    return !empty($sector) && $sector !== 'TOWER PROVIDER' && $sector !== 'NON TOWER PROVIDER';
                })->count();
            @endphp

            {{-- Bagian Statistik Ringkas (GRID) --}}
            {{-- Mengubah tampilan grid agar lebih fokus pada 4 kategori utama yang baru --}}
            <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Card Total Mitra --}}
                <div class="bg-dark-tower text-white p-4 rounded-lg shadow-md flex items-center space-x-4">
                    <div class="bg-accent-tower text-white rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-users fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm opacity-75">Total Mitra</p>
                        <p class="text-2xl font-bold">{{ $totalPartners }}</p>
                    </div>
                </div>

                {{-- Card TOWER PROVIDER (Mengambil dari sector) --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-blue-100 text-blue-600 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-broadcast-tower fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">TOWER PROVIDER</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $towerProviders }}</p>
                    </div>
                </div>

                {{-- Card NON TOWER PROVIDER (Mengambil dari sector) --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-orange-100 text-orange-600 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-lightbulb fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">NON TOWER PROVIDER</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $nonTowerProviders }}</p>
                    </div>
                </div>

                {{-- Card Sektor Lainnya --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-gray-200 text-gray-700 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-globe-americas fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Sektor Lainnya</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $otherSectors }}</p>
                    </div>
                </div>
            </div>

            {{-- Mengganti grid 3x3 di bawah dengan 3x2 saja agar lebih ringkas --}}
            <div class="mb-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                {{-- Card Kontak Terisi --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-green-100 text-green-500 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-check-circle fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kontak Terisi</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $filledContacts }}</p>
                    </div>
                </div>

                {{-- Card Kontak Kosong --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-red-100 text-red-500 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kontak Kosong</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $emptyContacts }}</p>
                    </div>
                </div>

                {{-- Card Logo Terpasang --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-purple-100 text-purple-500 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                         <i class="fas fa-image fa-lg"></i>
                    </div>
                    <div>
                         <p class="text-sm text-gray-500">Logo Terpasang</p>
                         <p class="text-2xl font-bold text-gray-800">{{ $filledLogos }}</p>
                    </div>
                </div>

                {{-- Card Logo Kosong --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                   <div class="bg-yellow-100 text-yellow-500 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-exclamation-circle fa-lg"></i>
                   </div>
                   <div>
                        <p class="text-sm text-gray-500">Logo Kosong</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $emptyLogos }}</p>
                   </div>
                </div>

                {{-- Card Kota Terisi --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-teal-100 text-teal-500 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-map-marker-alt fa-lg"></i>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Kota Terisi</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $filledCities }}</p>
                </div>
                </div>

                {{-- Card Kota Kosong (Tambahan yang sebelumnya tidak ada, untuk melengkapi pasangan) --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-sm flex items-center space-x-4 border border-gray-200">
                    <div class="bg-pink-100 text-pink-500 rounded-full h-12 w-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-map-marker-slash fa-lg"></i>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kota Kosong</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $emptyCities }}</p>
                    </div>
                </div>

            </div> {{-- End Grid Statistik --}}

            {{-- Tabel Data Mitra --}}
            <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-200 mt-6">
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-dark-tower text-white uppercase text-sm leading-normal">
                            <th class="py-3 px-4 text-left w-10">No.</th>
                            <th class="py-3 px-4 text-left w-32">Nama Mitra</th>
                            {{-- MENGHILANGKAN KOLOM JENIS MITRA. SEKARANG MENGGUNAKAN SEKTOR --}}
                            <th class="py-3 px-4 text-left w-20">Logo</th>
                            <th class="py-3 px-4 text-left w-48">Deskripsi</th>
                            <th class="py-3 px-4 text-left w-24">Sektor</th> {{-- KOLOM SEKTOR TETAP ADA --}}
                            <th class="py-3 px-4 text-left w-24">Kota</th>
                            <th class="py-3 px-4 text-left w-24">Kontak</th>
                            <th class="py-3 px-4 text-left w-24">Penerbit</th>
                            <th class="py-3 px-4 text-left w-24">Tgl Kerja Sama</th>
                            <th class="py-3 px-4 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light" id="partnerTableBody">
                        @forelse($partners as $partner)
                            <tr class="border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200 partner-row">
                                <td class="py-4 px-4 text-left font-medium">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 text-left font-semibold break-words">{{ $partner->name }}</td>

                                {{-- KOLOM JENIS MITRA (type) DIHAPUS --}}

                                <td class="py-4 px-4 text-left">
                                    @if($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="Logo {{ $partner->name }}"
                                            class="w-12 h-12 object-contain rounded-md shadow-sm bg-gray-50 border">
                                    @else
                                        <span class="text-xs text-red-500">No Logo</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-left max-w-xs break-words">
                                    <p class="line-clamp-3">{{ $partner->description ?? '-' }}</p>
                                </td>
                                <td class="py-4 px-4 text-left break-words">
                                    @php
                                        $sector = strtoupper($partner->sector ?? '');
                                        if ($sector === 'TOWER PROVIDER') {
                                            $color = 'bg-blue-100 text-blue-800';
                                        } elseif ($sector === 'NON TOWER PROVIDER') {
                                            $color = 'bg-orange-100 text-orange-800';
                                        } elseif (empty($sector)) {
                                            $color = 'bg-gray-300 text-gray-800';
                                        } else {
                                            $color = 'bg-green-100 text-green-800';
                                        }
                                        $label = $sector ?: 'BELUM DIISI';
                                    @endphp
                                    <span class="py-1 px-3 rounded-full text-xs font-semibold {{ $color }}">
                                        {{ $label }}
                                    </span>
                                </td>
                                <td class="py-4 px-4 text-left break-words">{{ $partner->city ?? '-' }}</td>
                                <td class="py-4 px-4 text-left break-words">{{ $partner->company_contact ?? '-' }}</td>
                                <td class="py-4 px-4 text-left break-words">{{ $partner->publisher ?? '-' }}</td>
                                <td class="py-4 px-4 text-left">
                                    {{ $partner->partnership_date ? \Carbon\Carbon::parse($partner->partnership_date)->format('d M Y') : '-' }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.partners.show', $partner->id) }}"
                                            class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-blue-500 rounded-full hover:bg-gray-200 transition-all duration-200" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                            class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-accent-tower rounded-full hover:bg-gray-200 transition-all duration-200" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.partners.destroy', $partner->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mitra {{ $partner->name }}?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-8 h-8 flex items-center justify-center text-gray-400 hover:text-red-500 rounded-full hover:bg-gray-200 transition-all duration-200" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr id="no-data">
                                <td colspan="10" class="py-8 text-center text-gray-500">
                                    Belum ada mitra industri yang ditambahkan.
                                </td>
                            </tr>
                        @endforelse
                        {{-- Baris ini akan muncul jika pencarian tidak menemukan hasil --}}
                        <tr id="no-results" class="hidden">
                             <td colspan="10" class="py-8 text-center text-gray-500">
                                 Mitra tidak ditemukan.
                             </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const tableBody = document.getElementById('partnerTableBody');
            const allRows = tableBody.querySelectorAll('tr.partner-row');
            const noResultsRow = document.getElementById('no-results');
            const noDataRow = document.getElementById('no-data');

            searchInput.addEventListener('keyup', function (e) {
                const searchTerm = e.target.value.toLowerCase();
                let visibleRows = 0;

                allRows.forEach(row => {
                    // Kolom "Nama Mitra" ada di index 1
                    const partnerNameCell = row.cells[1];
                    if (partnerNameCell) {
                        const partnerName = partnerNameCell.textContent.toLowerCase();
                        if (partnerName.includes(searchTerm)) {
                            row.style.display = '';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });

                // Handle pesan "tidak ditemukan"
                const hasInitialData = !!noDataRow;

                if (visibleRows === 0 && !hasInitialData && searchTerm.length > 0) {
                    noResultsRow.style.display = '';
                } else if (visibleRows === 0 && hasInitialData && searchTerm.length === 0) {
                    noDataRow.style.display = '';
                    noResultsRow.style.display = 'none';
                } else {
                    noResultsRow.style.display = 'none';
                    if(noDataRow) noDataRow.style.display = 'none';
                }
            });

            // Atur tampilan awal jika data kosong
            if (noDataRow && allRows.length === 0) {
                 noDataRow.style.display = '';
            } else if (noDataRow) {
                noDataRow.style.display = 'none';
            }
        });
    </script>

</body>
</html>

@endsection
