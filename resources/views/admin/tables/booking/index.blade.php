@extends('admin.layouts.app')

@section('title', 'Daftar Booking')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header Halaman --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                <i class="fas fa-tower-broadcast me-2 text-orange-500"></i> Manajemen Booking
            </h1>
            <p class="text-slate-500 text-sm mt-1">Pantau dan kelola semua reservasi layanan PT RIZQALLAH.</p>
        </div>
        <div>
            <span class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm">
                Total: {{ $reservations->total() }} Pesanan
            </span>
        </div>
    </div>

    {{-- Alert Section --}}
    @if (session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-xl mb-6 shadow-sm flex items-center animate-fade-in" role="alert">
            <i class="fas fa-check-circle me-3 text-green-500 text-xl"></i>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

    {{-- Data Table --}}
    <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b-2 border-slate-100">
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">No</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Kontak</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Layanan & Biaya</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Jadwal</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($reservations as $reservation)
                        <tr class="hover:bg-slate-50/50 transition-colors group">
                            {{-- No --}}
                            <td class="px-6 py-4 text-center text-slate-400 font-medium">
                                {{ ($reservations->currentPage() - 1) * $reservations->perPage() + $loop->iteration }}
                            </td>

                            {{-- Pelanggan --}}
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">{{ $reservation->name }}</div>
                                <div class="text-[10px] text-slate-400 font-mono">ID: #BOK-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</div>
                            </td>

                            {{-- Kontak --}}
                            <td class="px-6 py-4 text-xs text-slate-600">
                                <div class="flex items-center gap-2 mb-1">
                                    <i class="fas fa-envelope text-slate-300 w-4"></i> {{ $reservation->email }}
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-phone text-slate-300 w-4"></i> {{ $reservation->phone }}
                                </div>
                            </td>

                            {{-- Layanan --}}
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-700">{{ $reservation->services ?? 'Layanan Umum' }}</div>
                                <div class="text-orange-500 font-bold text-xs mt-1">Rp{{ number_format($reservation->total_price ?? 0, 0, ',', '.') }}</div>
                            </td>

                            {{-- Jadwal --}}
                            <td class="px-6 py-4 text-xs">
                                <div class="font-bold text-slate-700 flex items-center gap-2">
                                    <i class="far fa-calendar-alt text-orange-400"></i>
                                    {{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('d M Y') }}
                                </div>
                                <div class="text-slate-400 mt-1 italic flex items-center gap-2">
                                    <i class="far fa-clock"></i>
                                    {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }} WIB
                                </div>
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-6 py-4 text-center">
                                @php
                                    $status = strtolower($reservation->status ?? 'pending');
                                    $colors = [
                                        'pending' => 'bg-orange-50 text-orange-600 border-orange-100',
                                        'proses'  => 'bg-blue-50 text-blue-600 border-blue-100',
                                        'selesai' => 'bg-green-50 text-green-600 border-green-100',
                                        'batal'   => 'bg-red-50 text-red-600 border-red-100',
                                    ];
                                    $currentClass = $colors[$status] ?? $colors['pending'];
                                @endphp
                                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $currentClass }}">
                                    @if($status == 'pending') <i class="fas fa-spinner fa-spin me-1"></i> @endif
                                    {{ $status }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.booking.show', $reservation->id) }}" class="p-2 bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-800 hover:text-white transition-all shadow-sm" title="Detail">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    <a href="{{ route('admin.booking.edit', $reservation->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition-all shadow-sm" title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    <form action="{{ route('admin.booking.destroy', $reservation->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 bg-red-50 text-red-500 rounded-lg hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-trash-alt text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-24 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-dashed border-slate-200">
                                        <i class="fas fa-inbox text-3xl text-slate-200"></i>
                                    </div>
                                    <h4 class="text-lg font-bold text-slate-800">Database Kosong</h4>
                                    <p class="text-slate-400 text-sm">Belum ada pelanggan yang melakukan booking.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="mt-8 flex justify-end">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
