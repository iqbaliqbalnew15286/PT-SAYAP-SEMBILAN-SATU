@extends('admin.layouts.app')

@section('title', 'Detail Reservasi')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="max-w-4xl mx-auto">

        {{-- Breadcrumb / Navigation --}}
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('admin.booking.index') }}" class="flex items-center text-sm font-bold text-slate-500 hover:text-orange-600 transition-colors">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar
            </a>
            <div class="flex gap-2">
                <a href="{{ route('admin.booking.edit', $reservation->id) }}" class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl text-xs font-bold hover:bg-blue-600 hover:text-white transition-all">
                    <i class="fas fa-edit me-1"></i> Edit Status
                </a>
            </div>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-xl overflow-hidden border border-slate-100">
            {{-- Header Detail --}}
            <div class="bg-slate-800 p-8 text-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <span class="px-3 py-1 bg-orange-500/20 text-orange-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-orange-500/30">
                            Konfirmasi Reservasi
                        </span>
                        <h2 class="text-3xl font-black mt-3 tracking-tight">Detail Reservasi</h2>
                        <p class="text-slate-400 text-sm mt-1 font-mono uppercase tracking-tighter">ID: #BOK-{{ str_pad($reservation->id, 5, '0', STR_PAD_LEFT) }}</p>
                    </div>
                    <div class="text-right">
                        @php
                            $status = strtolower($reservation->status ?? 'pending');
                            $statusClasses = [
                                'pending' => 'bg-orange-500 text-white',
                                'proses'  => 'bg-blue-500 text-white',
                                'selesai' => 'bg-green-500 text-white',
                                'batal'   => 'bg-red-500 text-white',
                            ];
                        @endphp
                        <div class="inline-block px-6 py-2 {{ $statusClasses[$status] ?? $statusClasses['pending'] }} rounded-2xl text-xs font-black uppercase tracking-widest shadow-lg shadow-black/20">
                            {{ $status }}
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Detail --}}
            <div class="p-8 md:p-12">
                <div class="grid md:grid-cols-2 gap-12">

                    {{-- Sisi Kiri: Profil & Jadwal --}}
                    <div class="space-y-8">
                        {{-- Informasi Pelanggan --}}
                        <section>
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                                <span class="w-8 h-[1px] bg-slate-200 me-2"></span> Informasi Pelanggan
                            </h4>
                            <div class="space-y-3">
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-400 leading-none mb-1">Nama Lengkap</p>
                                        <p class="text-lg font-black text-slate-800">{{ $reservation->name }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-400 leading-none mb-1">Email</p>
                                        <p class="text-base font-bold text-slate-700">{{ $reservation->email }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 flex-shrink-0">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-slate-400 leading-none mb-1">Telepon / WhatsApp</p>
                                        <p class="text-base font-bold text-slate-700">{{ $reservation->phone }}</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Jadwal Reservasi --}}
                        <section>
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                                <span class="w-8 h-[1px] bg-slate-200 me-2"></span> Jadwal Kedatangan
                            </h4>
                            <div class="bg-slate-50 rounded-3xl p-6 border border-slate-100">
                                <div class="flex items-center gap-6">
                                    <div class="text-center">
                                        <p class="text-[10px] font-black text-slate-400 uppercase">Hari/Tanggal</p>
                                        <p class="text-base font-black text-slate-800 mt-1">
                                            {{ \Carbon\Carbon::parse($reservation->date)->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                    <div class="h-10 w-[1px] bg-slate-200"></div>
                                    <div class="text-center">
                                        <p class="text-[10px] font-black text-slate-400 uppercase">Waktu</p>
                                        <p class="text-base font-black text-slate-800 mt-1">
                                            {{ \Carbon\Carbon::parse($reservation->time)->format('H:i') }} WIB
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    {{-- Sisi Kanan: Layanan & Biaya --}}
                    <div class="space-y-8">
                        {{-- Layanan & Catatan --}}
                        <section>
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                                <span class="w-8 h-[1px] bg-slate-200 me-2"></span> Rincian Pesanan
                            </h4>
                            <div class="bg-orange-50 rounded-3xl p-6 border border-orange-100 relative overflow-hidden">
                                <i class="fas fa-quote-right absolute -right-4 -bottom-4 text-6xl text-orange-200/50"></i>
                                <div class="relative z-10">
                                    <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest mb-1">Layanan Terpilih</p>
                                    <p class="text-xl font-black text-orange-700 capitalize mb-4">{{ $reservation->services ?? 'Layanan Umum' }}</p>

                                    <p class="text-[10px] font-black text-orange-400 uppercase tracking-widest mb-1">Catatan Pelanggan</p>
                                    <p class="text-sm text-orange-800 leading-relaxed italic">
                                        "{{ $reservation->note ?? 'Tidak ada catatan tambahan untuk reservasi ini.' }}"
                                    </p>
                                </div>
                            </div>
                        </section>

                        {{-- Ringkasan Biaya --}}
                        <section>
                            <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center">
                                <span class="w-8 h-[1px] bg-slate-200 me-2"></span> Ringkasan Pembayaran
                            </h4>
                            <div class="bg-slate-800 rounded-3xl p-6 shadow-xl shadow-slate-200">
                                <div class="flex justify-between items-center">
                                    <p class="text-slate-400 text-xs font-bold uppercase tracking-widest">Total Tagihan</p>
                                    <i class="fas fa-wallet text-slate-600"></i>
                                </div>
                                <p class="text-3xl font-black text-orange-500 mt-2 tracking-tighter">
                                    Rp{{ number_format($reservation->total_price, 0, ',', '.') }}
                                </p>
                                <div class="mt-4 pt-4 border-t border-slate-700">
                                    <p class="text-[10px] text-slate-500 italic uppercase">Pembayaran dilakukan di lokasi (On-site)</p>
                                </div>
                            </div>
                        </section>
                    </div>

                </div>
            </div>
        </div>

        {{-- Footer Note --}}
        <p class="text-center text-slate-400 text-[10px] mt-8 uppercase tracking-[0.3em]">
            Sistem Reservasi PT Rizqallah • Terakhir diperbarui: {{ $reservation->updated_at->diffForHumans() }}
        </p>
    </div>
</div>
@endsection
