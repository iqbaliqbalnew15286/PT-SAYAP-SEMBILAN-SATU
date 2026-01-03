@extends('admin.layouts.app')

@section('title', 'Daftar Booking')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Header Halaman --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                    <i class="fas fa-calendar-check me-2 text-orange-500"></i> Manajemen Booking
                </h1>
                <p class="text-slate-500 text-sm mt-1">Kelola reservasi pelanggan dan hubungi mereka melalui fitur chat internal.</p>
            </div>
            <div class="flex gap-3">
                <span class="bg-slate-800 text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm flex items-center">
                    Total: {{ $reservations->total() }} Pesanan
                </span>
            </div>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded-xl mb-6 shadow-md flex items-center animate-fade-in-down">
                <i class="fas fa-check-circle me-3 text-green-500 text-xl"></i>
                <p class="font-bold">{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-xl mb-6 shadow-md flex items-center">
                <i class="fas fa-exclamation-circle me-3 text-red-500 text-xl"></i>
                <p class="font-bold">{{ session('error') }}</p>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b-2 border-slate-100">
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">No</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Pelanggan</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Layanan & Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-widest">Jadwal</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Status Reservasi</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-slate-400 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse($reservations as $reservation)
                            <tr class="hover:bg-slate-50/50 transition-colors group">
                                {{-- Nomor --}}
                                <td class="px-6 py-4 text-center text-slate-400 font-medium">
                                    {{ ($reservations->currentPage() - 1) * $reservations->perPage() + $loop->iteration }}
                                </td>

                                {{-- Pelanggan & Indikator Chat --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center font-black text-sm relative shadow-sm">
                                            {{ strtoupper(substr($reservation->user->name ?? 'U', 0, 1)) }}

                                            @if ($reservation->user && $reservation->user->unread_messages_count > 0)
                                                <span class="absolute -top-1 -right-1 flex h-3 w-3">
                                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">
                                                {{ $reservation->user->name ?? 'User Terhapus' }}
                                            </div>
                                            <div class="text-[11px] text-slate-400 font-bold flex items-center gap-1 mt-0.5">
                                                <i class="fas fa-id-badge text-[9px]"></i> ID:
                                                #BOK-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Layanan & Harga --}}
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-slate-700 leading-tight">
                                        {{ $reservation->services }}
                                    </div>
                                    <div class="text-orange-600 font-black text-xs mt-1">
                                        Rp{{ number_format($reservation->total_price, 0, ',', '.') }}
                                    </div>
                                </td>

                                {{-- Jadwal --}}
                                <td class="px-6 py-4 text-xs">
                                    <div class="font-bold text-slate-700 flex items-center gap-2">
                                        <i class="far fa-calendar-alt text-orange-400"></i>
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d M Y') }}
                                    </div>
                                    <div class="text-slate-400 mt-1 font-bold flex items-center gap-2">
                                        <i class="far fa-clock"></i>
                                        {{ $reservation->time }} WIB
                                    </div>
                                </td>

                                {{-- Status Reservasi (DIBENARKAN) --}}
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.booking.update', $reservation->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-[10px] font-black uppercase tracking-widest border rounded-xl px-3 py-2 cursor-pointer outline-none transition-all
                                        @if ($reservation->status == 'pending') bg-orange-50 text-orange-600 border-orange-200
                                        @elseif($reservation->status == 'proses') bg-blue-50 text-blue-600 border-blue-200
                                        @elseif($reservation->status == 'selesai') bg-green-50 text-green-600 border-green-200
                                        @else bg-red-50 text-red-600 border-red-200 @endif">
                                            <option value="pending" {{ $reservation->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="proses" {{ $reservation->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                            <option value="selesai" {{ $reservation->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            <option value="batal" {{ $reservation->status == 'batal' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>

                                {{-- Kolom Aksi --}}
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-2 items-center">
                                        @if($reservation->user_id)
                                            <a href="{{ route('admin.booking.chat', ['user_id' => $reservation->user_id]) }}"
                                                class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-orange-600 text-white rounded-xl shadow-lg shadow-slate-200 transition-all group/btn">
                                                <i class="fas fa-comment-dots text-xs group-hover/btn:animate-bounce"></i>
                                                <span class="text-[10px] font-black tracking-widest uppercase">Hubungi Customer</span>
                                            </a>
                                        @else
                                            <button disabled class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-200 text-slate-400 rounded-xl cursor-not-allowed">
                                                <span class="text-[10px] font-black uppercase">User Tidak Ada</span>
                                            </button>
                                        @endif

                                        <form action="{{ route('admin.booking.destroy', $reservation->id) }}"
                                            method="POST" onsubmit="return confirm('Hapus data booking ini?')"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button class="w-full p-2 text-slate-400 hover:text-red-500 transition-all flex items-center justify-center gap-1">
                                                <i class="fas fa-trash-alt text-[10px]"></i>
                                                <span class="text-[10px] font-bold uppercase">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-24 text-center">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-calendar-times text-6xl text-slate-200 mb-4"></i>
                                        <p class="text-slate-400 font-bold italic">Belum ada data reservasi masuk.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-8">
            {{ $reservations->links() }}
        </div>
    </div>
@endsection
