@extends('layouts.booking')

@section('title', 'Chat Konsultasi - PT RIZQALLAH')

@section('styles')
    <style>
        .chat-container::-webkit-scrollbar { width: 5px; }
        .chat-container::-webkit-scrollbar-track { background: transparent; }
        .chat-container::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

        #chatBox {
            background-color: #f8fafc;
            /* Pattern dot halus agar mata tidak lelah */
            background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
            background-size: 20px 20px;
        }

        .message-wrapper .btn-delete {
            display: none;
        }
        .message-wrapper:hover .btn-delete {
            display: flex;
        }
    </style>
@endsection

@section('content')
<div class="max-w-[95%] mx-auto pb-10">
    {{-- Grid Layout: Chat lebih luas (col-span-9), Info (col-span-3) --}}
    <div class="grid grid-cols-12 gap-6 h-[800px]">

        <div class="col-span-12 lg:col-span-9 bg-white border border-slate-200 rounded-[32px] overflow-hidden shadow-2xl flex flex-col">

            {{-- HEADER CHAT --}}
            <div class="p-6 border-b border-slate-100 flex items-center justify-between bg-white">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('booking.index') }}" class="group flex items-center space-x-2 text-slate-400 hover:text-orange-600 transition-all">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span class="text-sm font-bold uppercase tracking-widest">Kembali</span>
                    </a>
                    <div class="h-8 w-[1px] bg-slate-100 mx-2"></div>
                    <div>
                        <h3 class="font-black text-slate-900 text-lg uppercase tracking-tight">Ruang Konsultasi</h3>
                        <p class="text-[11px] text-green-500 font-bold flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            Admin PT RIZQALLAH Sedang Online
                        </p>
                    </div>
                </div>
            </div>

            {{-- AREA PESAN: Luas dan lega --}}
            <div class="flex-1 overflow-y-auto p-8 space-y-6 chat-container" id="chatBox">
                @forelse($messages as $msg)
                    @php $isFromMe = $msg->sender_id == auth()->id() && $msg->sender_type !== 'admin'; @endphp

                    <div class="flex {{ $isFromMe ? 'justify-end' : 'justify-start' }} items-end space-x-3 message-wrapper">
                        @if(!$isFromMe)
                            <div class="w-10 h-10 bg-slate-900 rounded-2xl flex-shrink-0 flex items-center justify-center text-white shadow-lg shadow-slate-200">
                                <i class="fa-solid fa-headset text-sm"></i>
                            </div>
                        @endif

                        <div class="flex flex-col {{ $isFromMe ? 'items-end' : 'items-start' }} max-w-[70%]">
                            <div class="flex items-center space-x-2 mb-1">
                                @if($isFromMe)
                                    <form action="{{ route('chat.delete', $msg->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-delete text-[10px] text-slate-300 hover:text-red-500 p-1 transition-all" onclick="return confirm('Hapus pesan?')">
                                            <i class="fa-solid fa-trash-can"></i> Hapus
                                        </button>
                                    </form>
                                @endif
                                <span class="text-[10px] text-slate-400 font-bold uppercase">{{ $msg->created_at->format('H:i') }}</span>
                            </div>

                            <div class="p-4 {{ $isFromMe ? 'bg-orange-600 text-white rounded-[24px] rounded-br-none shadow-orange-100' : 'bg-white border border-slate-200 text-slate-700 rounded-[24px] rounded-bl-none' }} shadow-sm text-sm leading-relaxed">
                                {{ $msg->message }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center opacity-30 text-center">
                        <i class="fa-solid fa-comments text-6xl mb-4"></i>
                        <p class="font-black text-slate-900 uppercase tracking-[0.2em]">Belum Ada Pesan</p>
                    </div>
                @endforelse
            </div>

            {{-- INPUT AREA --}}
            <div class="p-6 bg-slate-50 border-t border-slate-100">
                <form action="{{ route('chat.send') }}" method="POST" class="flex items-center gap-4">
                    @csrf
                    <input type="text" name="message" required autocomplete="off" placeholder="Ketik pesan Anda di sini..."
                        class="flex-1 bg-white border-2 border-slate-200 rounded-[20px] py-4 px-6 text-sm font-semibold focus:border-orange-500 focus:ring-0 transition-all outline-none shadow-sm">
                    <button type="submit" class="w-16 h-14 bg-orange-600 text-white rounded-[20px] flex items-center justify-center shadow-lg shadow-orange-200 hover:bg-orange-700 hover:scale-105 active:scale-95 transition-all">
                        <i class="fa-solid fa-paper-plane text-xl"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-3 space-y-6">

            {{-- CARD 1: TOTAL BIAYA (DIAMBIL DARI DATA RIWAYAT/BOOKING) --}}
            <div class="bg-slate-900 rounded-[32px] p-6 text-white shadow-2xl relative overflow-hidden group">
                <div class="relative z-10">
                    <h4 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-4">Ringkasan Biaya</h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-slate-400">Total Tagihan</span>
                            <span class="font-black text-lg text-orange-400 font-mono">
                                Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="flex justify-between items-center text-[10px] pt-3 border-t border-slate-800">
                            <span class="text-slate-400 uppercase font-bold tracking-widest">Status Bayar</span>
                            @if(($booking->payment_status ?? 'pending') == 'paid')
                                <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-lg font-black uppercase">LUNAS</span>
                            @else
                                <span class="px-2 py-1 bg-red-500/20 text-red-400 rounded-lg font-black uppercase tracking-tighter">BELUM BAYAR</span>
                            @endif
                        </div>
                    </div>
                </div>
                {{-- Dekorasi background --}}
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-orange-500/10 rounded-full blur-3xl"></div>
            </div>

            {{-- CARD 2: PROSES (DIAMBIL DARI DATA RIWAYAT) --}}
            <div class="bg-white border border-slate-200 rounded-[32px] p-6 shadow-sm">
                <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-6">Proses Layanan</h4>

                <div class="space-y-6 relative">
                    {{-- Garis Vertical --}}
                    <div class="absolute left-4 top-0 bottom-0 w-[2px] bg-slate-100"></div>

                    @php
                        // Logika Proses Sederhana berdasarkan status database
                        $status = $booking->status ?? 'pending';
                    @endphp

                    {{-- Tahap 1: Booking --}}
                    <div class="relative flex items-center pl-10">
                        <div class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center z-10 {{ in_array($status, ['pending', 'process', 'success']) ? 'bg-orange-500 text-white shadow-lg shadow-orange-100' : 'bg-slate-100 text-slate-400' }}">
                            <i class="fa-solid fa-file-invoice text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-800 leading-none">Pendaftaran</p>
                            <p class="text-[10px] text-slate-400 mt-1">Selesai dilakukan</p>
                        </div>
                    </div>

                    {{-- Tahap 2: Verifikasi/Proses --}}
                    <div class="relative flex items-center pl-10">
                        <div class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center z-10 {{ in_array($status, ['process', 'success']) ? 'bg-orange-500 text-white shadow-lg shadow-orange-100' : 'bg-slate-100 text-slate-400' }}">
                            <i class="fa-solid fa-spinner {{ $status == 'process' ? 'fa-spin' : '' }} text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-800 leading-none tracking-tight">Proses Admin</p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase">{{ $status == 'process' ? 'Sedang diperiksa' : 'Antrean' }}</p>
                        </div>
                    </div>

                    {{-- Tahap 3: Selesai --}}
                    <div class="relative flex items-center pl-10">
                        <div class="absolute left-0 w-8 h-8 rounded-full flex items-center justify-center z-10 {{ $status == 'success' ? 'bg-green-500 text-white shadow-lg shadow-green-100' : 'bg-slate-100 text-slate-400' }}">
                            <i class="fa-solid fa-check text-[10px]"></i>
                        </div>
                        <div>
                            <p class="text-xs font-black text-slate-800 leading-none tracking-tight">Selesai</p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase">Layanan Berakhir</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CARD 3: INFO TAMBAHAN --}}
            <div class="p-6 bg-orange-50 border border-orange-100 rounded-[32px]">
                <h4 class="text-[10px] font-black text-orange-600 uppercase tracking-widest mb-2">Informasi Penting</h4>
                <p class="text-[11px] text-orange-800/70 leading-relaxed">
                    Pastikan Anda telah mengirimkan bukti transfer jika status bayar masih <span class="font-black underline uppercase">Belum Bayar</span>.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    const chatBox = document.getElementById('chatBox');
    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    window.onload = scrollToBottom;
</script>
@endsection
