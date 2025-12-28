@extends('admin.layouts.app')

@section('title', 'Update Status Booking')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-2xl mx-auto bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">

        {{-- Header Form --}}
        <div class="bg-slate-800 p-8 text-white text-center relative">
            <div class="absolute top-4 left-4">
                <a href="{{ route('admin.booking.index') }}" class="text-slate-400 hover:text-white transition-colors">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
            <h2 class="text-2xl font-black tracking-tight">Update Status Reservasi</h2>
            <p class="text-orange-400 font-mono text-sm mt-2 tracking-widest uppercase">
                ID: #BOK-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}
            </p>
        </div>

        <form action="{{ route('admin.booking.update', $reservation->id) }}" method="POST" class="p-10">
            @csrf
            @method('PUT')

            {{-- Nama Pelanggan (Read Only) --}}
            <div class="mb-6">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Nama Pelanggan</label>
                <div class="flex items-center bg-slate-50 border border-slate-100 rounded-2xl px-5 py-4 text-slate-600 font-bold">
                    <i class="fas fa-user me-3 text-slate-300"></i>
                    {{ $reservation->name }}
                </div>
            </div>

            {{-- Input Total Harga --}}
            <div class="mb-6">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Total Biaya (Rp)</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-5 flex items-center text-slate-400 font-bold">Rp</span>
                    <input type="number" name="total_price" value="{{ $reservation->total_price }}"
                        class="w-full bg-white border-2 border-slate-100 rounded-2xl pl-12 pr-5 py-4 focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 outline-none transition-all font-bold text-slate-700"
                        placeholder="0">
                </div>
                <p class="text-[10px] text-slate-400 mt-2 italic">*Sesuaikan total biaya jika ada tambahan layanan.</p>
            </div>

            {{-- Pemilihan Status --}}
            <div class="mb-10">
                <label class="block text-xs font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Pilih Status Terbaru</label>
                <div class="grid grid-cols-2 gap-4">
                    @foreach(['pending', 'proses', 'selesai', 'batal'] as $st)
                        @php
                            $colorClass = [
                                'pending' => 'peer-checked:border-orange-500 peer-checked:bg-orange-50 text-orange-600',
                                'proses'  => 'peer-checked:border-blue-500 peer-checked:bg-blue-50 text-blue-600',
                                'selesai' => 'peer-checked:border-green-500 peer-checked:bg-green-50 text-green-600',
                                'batal'   => 'peer-checked:border-red-500 peer-checked:bg-red-50 text-red-600',
                            ][$st];
                        @endphp

                        <label class="relative cursor-pointer group">
                            <input type="radio" name="status" value="{{ $st }}" class="peer hidden" {{ $reservation->status == $st ? 'checked' : '' }}>
                            <div class="flex items-center justify-center p-4 border-2 border-slate-100 rounded-2xl transition-all duration-300 {{ $colorClass }} hover:border-slate-200 peer-checked:shadow-md">
                                <span class="text-sm font-black uppercase tracking-widest">{{ $st }}</span>
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="flex-1 bg-slate-800 hover:bg-orange-500 text-white font-black py-5 rounded-2xl transition-all shadow-xl hover:shadow-orange-200 flex items-center justify-center gap-2 group uppercase tracking-widest text-sm">
                    <span>Simpan Perubahan</span>
                    <i class="fas fa-check-circle transition-transform group-hover:scale-125"></i>
                </button>

                <a href="{{ route('admin.booking.index') }}" class="px-8 py-5 bg-slate-100 text-slate-500 font-black rounded-2xl hover:bg-slate-200 transition-all text-center uppercase tracking-widest text-sm">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
