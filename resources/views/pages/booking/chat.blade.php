@extends('layouts.booking')

@section('title', 'Chat Konsultasi - PT RIZQALLAH')

@section('styles')
<style>
    .chat-container::-webkit-scrollbar { width: 5px }
    .chat-container::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px
    }

    #chatBox {
        background: #f8fafc;
        background-image: radial-gradient(#e2e8f0 .5px, transparent .5px);
        background-size: 20px 20px
    }

    .message-wrapper .btn-delete { display: none }
    .message-wrapper:hover .btn-delete { display: inline-flex }

    .quick-btn { transition: .2s }
    .quick-btn:hover { transform: scale(.97) }
</style>
@endsection

@section('content')
<div class="max-w-7xl mx-auto pb-10 h-full">
    <div class="grid grid-cols-12 gap-6 h-[calc(100vh-140px)]">

        {{-- ================= CHAT ================= --}}
        <div class="col-span-12 lg:col-span-8 bg-white border rounded-[28px] shadow-xl
                    flex flex-col overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-5 border-b shrink-0">
                <div class="flex items-center gap-4">
                    <a href="{{ route('booking.index') }}" class="text-slate-400 hover:text-orange-600">
                        <i class="fa-solid fa-chevron-left"></i>
                    </a>
                    <div>
                        <h3 class="font-black text-slate-900 uppercase tracking-tight">
                            Ruang Konsultasi
                        </h3>
                        <p class="text-[11px] text-green-600 font-bold flex items-center">
                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                            Admin Online
                        </p>
                    </div>
                </div>
            </div>

            {{-- CHAT (INI SAJA YANG SCROLL) --}}
            <div id="chatBox"
                 class="flex-1 overflow-y-auto px-8 py-6 space-y-6 chat-container">

                @forelse($messages as $msg)
                    @php
                        $isMe = $msg->sender_id == auth()->id() && $msg->sender_type !== 'admin';
                    @endphp

                    <div class="flex {{ $isMe ? 'justify-end' : 'justify-start' }} gap-3 message-wrapper">

                        @unless($isMe)
                            <div class="w-10 h-10 bg-slate-900 text-white rounded-2xl
                                        flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-headset text-sm"></i>
                            </div>
                        @endunless

                        <div class="max-w-[75%]">
                            <div class="flex items-center gap-2 mb-1 {{ $isMe ? 'justify-end' : '' }}">
                                @if($isMe)
                                    <form action="{{ route('chat.delete', $msg->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus pesan?')">
                                        @csrf @method('DELETE')
                                        <button class="btn-delete text-[10px] text-slate-300 hover:text-red-500">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                                <span class="text-[10px] text-slate-400 font-bold">
                                    {{ $msg->created_at->format('H:i') }}
                                </span>
                            </div>

                            <div class="p-4 text-sm leading-relaxed
                                {{ $isMe
                                    ? 'bg-orange-600 text-white rounded-[22px] rounded-br-none'
                                    : 'bg-white border rounded-[22px] rounded-bl-none' }}">

                                @if ($msg->image)
                                    <img src="{{ asset('storage/'.$msg->image) }}"
                                         class="mb-2 rounded-xl max-h-64 cursor-pointer"
                                         onclick="window.open(this.src)">
                                @endif

                                {{ $msg->message }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="h-full flex flex-col items-center justify-center opacity-40">
                        <i class="fa-solid fa-comments text-6xl mb-4"></i>
                        <p class="font-black uppercase tracking-widest">Belum Ada Pesan</p>
                    </div>
                @endforelse
            </div>

            {{-- INPUT (SELALU DI BAWAH, TIDAK SCROLL) --}}
            <div class="px-6 py-5 bg-slate-50 border-t shrink-0">
                <form action="{{ route('chat.send') }}" method="POST"
                      enctype="multipart/form-data"
                      class="flex gap-4 items-center">
                    @csrf

                    <label
                        class="w-14 h-14 bg-white border rounded-2xl
                               flex items-center justify-center cursor-pointer hover:bg-slate-100">
                        <i class="fa-solid fa-image text-slate-400"></i>
                        <input type="file" name="image" hidden>
                    </label>

                    <input type="text" name="message" required
                        placeholder="Ketik pesan..."
                        class="flex-1 bg-white border-2 rounded-[20px]
                               py-4 px-6 text-sm font-semibold
                               focus:border-orange-500 focus:outline-none">

                    <button
                        class="w-16 h-14 bg-orange-600 hover:bg-orange-700
                               text-white rounded-[20px]
                               flex items-center justify-center">
                        <i class="fa-solid fa-paper-plane text-lg"></i>
                    </button>
                </form>
            </div>
        </div>

        {{-- ================= SIDE INFO ================= --}}
        <div class="col-span-12 lg:col-span-4 space-y-6">

            {{-- RINGKASAN --}}
            <div class="bg-slate-900 rounded-[28px] p-6 text-white">
                <h4 class="text-[10px] font-black text-slate-500 uppercase mb-4">
                    Ringkasan Booking
                </h4>
                <p class="text-sm font-bold">{{ $booking->services ?? 'Layanan Custom' }}</p>
                <p class="text-xs text-slate-400 mt-1">
                    {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }} • {{ $booking->time }} WIB
                </p>
                <div class="mt-4 flex justify-between font-black">
                    <span>Total</span>
                    <span class="text-orange-400">
                        Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            {{-- QUICK CHAT --}}
            <div class="bg-white border rounded-[28px] p-6 space-y-3">
                <h4 class="text-[10px] font-black text-slate-400 uppercase mb-3">
                    Kirim Cepat
                </h4>

                @php
                    $quick = [
                        "Min, saya ingin konfirmasi booking {$booking->services}",
                        "Jadwal saya {$booking->date} jam {$booking->time}",
                        "Total biaya saya Rp " . number_format($booking->total_price ?? 0, 0, ',', '.'),
                        "Status booking saya {$booking->status}",
                    ];
                @endphp

                @foreach($quick as $text)
                    <form action="{{ route('chat.send') }}" method="POST">
                        @csrf
                        <input type="hidden" name="message" value="{{ $text }}">
                        <button
                            class="quick-btn w-full text-left px-4 py-3
                                   rounded-xl bg-slate-100
                                   hover:bg-orange-100 text-xs font-bold">
                            {{ $text }}
                        </button>
                    </form>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const chatBox = document.getElementById('chatBox');
    window.addEventListener('load', () => {
        chatBox.scrollTop = chatBox.scrollHeight;
    });
</script>
@endsection
