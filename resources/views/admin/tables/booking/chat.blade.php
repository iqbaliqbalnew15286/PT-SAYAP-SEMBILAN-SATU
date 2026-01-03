@extends('admin.layouts.app')

@section('title', 'WhatsApp Admin - ' . ($user->name ?? 'Chat'))

@section('content')
<div class="container mx-auto px-4 py-4 h-[calc(100vh-120px)]"
    x-data="{
        search: '',
        isSending: false,
        imagePreview: null,
        showDetails: window.innerWidth > 1024,
        quickReply(msg) {
            $refs.messageInput.value = msg;
            $nextTick(() => { $refs.chatForm.submit(); });
        },
        scrollToBottom() {
            const box = document.getElementById('chat-box');
            if (box) box.scrollTop = box.scrollHeight;
        },
        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => { this.imagePreview = e.target.result; };
                reader.readAsDataURL(file);
            }
        }
    }"
    x-init="scrollToBottom();">

    <div class="flex h-full bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">

        {{-- SIDEBAR KIRI: Daftar Pelanggan dari Booking --}}
        <div class="w-full md:w-80 lg:w-96 border-r border-slate-200 flex flex-col bg-white shrink-0">
            <div class="p-5 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                <h2 class="text-xs font-black text-slate-700 uppercase tracking-widest">Daftar Pelanggan</h2>
                <span class="bg-orange-500 text-white text-[10px] px-2.5 py-1 rounded-full font-bold shadow-sm">{{ $active_chats->count() }}</span>
            </div>

            <div class="p-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" x-model="search" placeholder="Cari nama pelanggan..."
                        class="w-full bg-slate-100 border-none rounded-xl py-2.5 pl-11 pr-4 text-sm focus:ring-2 focus:ring-orange-500 transition-all">
                </div>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar">
                @forelse($active_chats as $sidebarUser)
                    {{-- Filter Search menggunakan Alpine.js --}}
                    <div x-show="search === '' || '{{ strtolower($sidebarUser->name) }}'.includes(search.toLowerCase())">
                        <a href="{{ route('admin.booking.chat', $sidebarUser->id) }}"
                            class="flex items-center gap-4 p-4 border-b border-slate-50 transition-all hover:bg-slate-50 {{ isset($user) && $user->id == $sidebarUser->id ? 'bg-orange-50 border-l-4 border-l-orange-500' : '' }}">

                            {{-- Avatar --}}
                            <div class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center font-bold text-slate-600 shrink-0 relative text-sm shadow-sm">
                                {{ strtoupper(substr($sidebarUser->name, 0, 1)) }}
                                @if($sidebarUser->unread_count > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-[10px] flex items-center justify-center rounded-full border-2 border-white text-white font-bold animate-bounce">
                                        {{ $sidebarUser->unread_count }}
                                    </span>
                                @endif
                            </div>

                            {{-- Info Singkat --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-center mb-1">
                                    <h4 class="text-sm font-bold text-slate-800 truncate">{{ $sidebarUser->name }}</h4>
                                    <span class="text-[10px] text-slate-400 font-medium">
                                        {{ $sidebarUser->last_interaction ? \Carbon\Carbon::parse($sidebarUser->last_interaction)->diffForHumans(null, true) : '' }}
                                    </span>
                                </div>
                                <p class="text-xs text-slate-500 truncate">
                                    @if($sidebarUser->latest_msg_image)
                                        <i class="fas fa-camera text-[10px] mr-1"></i> Gambar
                                    @else
                                        {{ $sidebarUser->latest_msg_text ?? 'Belum ada pesan' }}
                                    @endif
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="p-10 text-center text-slate-400 text-sm italic">Tidak ada data pelanggan</div>
                @endforelse
            </div>
        </div>

        {{-- PANEL CHAT UTAMA --}}
        <div class="flex-1 flex flex-col bg-[#e5ddd5] relative min-w-0 shadow-inner">
            {{-- Background WhatsApp Pattern --}}
            <div class="absolute inset-0 opacity-[0.06] pointer-events-none" style="background-image: url('https://user-images.githubusercontent.com/15075759/28719144-86dc0f70-73b1-11e7-911d-60d70fcded21.png');"></div>

            @if(isset($user))
                {{-- HEADER CHAT --}}
                <div class="p-4 bg-white border-b border-slate-200 flex justify-between items-center z-10 shadow-sm">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-orange-500 rounded-full flex items-center justify-center text-white font-bold text-sm shadow-md">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-slate-800 leading-tight">{{ $user->name }}</h3>
                            <div class="flex items-center gap-1.5 mt-0.5">
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                <p class="text-[10px] text-green-600 font-bold uppercase tracking-widest">Aktif</p>
                            </div>
                        </div>
                    </div>
                    <button @click="showDetails = !showDetails" class="text-slate-400 hover:text-orange-500 transition-colors hidden lg:block">
                        <i class="fas fa-info-circle text-xl"></i>
                    </button>
                </div>

                {{-- AREA HISTORY CHAT --}}
                <div class="flex-1 overflow-y-auto p-6 space-y-4 z-10 custom-scrollbar scroll-smooth" id="chat-box">
                    @foreach ($messages as $msg)
                        <div class="flex {{ $msg->sender_type == 'admin' ? 'justify-end' : 'justify-start' }} animate-fade-in">
                            <div class="max-w-[70%] group relative {{ $msg->sender_type == 'admin' ? 'bg-[#dcf8c6] text-slate-800 rounded-2xl rounded-tr-none' : 'bg-white text-slate-800 rounded-2xl rounded-tl-none' }} px-4 py-3 shadow-md border border-black/5">

                                @if ($msg->image)
                                    <div class="mb-2 overflow-hidden rounded-lg">
                                        <img src="{{ asset('storage/' . $msg->image) }}" class="max-h-64 w-full object-cover cursor-zoom-in" @click="window.open($el.src, '_blank')">
                                    </div>
                                @endif

                                <p class="text-[14px] leading-relaxed pr-6 whitespace-pre-wrap">{{ $msg->message }}</p>

                                <div class="flex items-center justify-end gap-1.5 mt-1.5 opacity-60">
                                    <span class="text-[10px] font-bold">{{ $msg->created_at->format('H:i') }}</span>
                                    @if ($msg->sender_type == 'admin')
                                        <i class="fas fa-check-double text-[10px] {{ $msg->is_read ? 'text-blue-500' : 'text-slate-400' }}"></i>
                                    @endif
                                </div>

                                {{-- Fitur Hapus Pesan (Hanya Pesan Admin) --}}
                                @if ($msg->sender_type == 'admin')
                                    <form action="{{ route('admin.chat.delete', $msg->id) }}" method="POST" onsubmit="return confirm('Hapus pesan?')"
                                        class="absolute top-1 -left-10 opacity-0 group-hover:opacity-100 transition-all">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-slate-400 hover:text-red-500 p-2 bg-white rounded-full shadow-sm">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- FOOTER INPUT --}}
                <div class="bg-[#f0f2f5] z-10 p-4">
                    {{-- Quick Replies --}}
                    <div class="flex gap-2 mb-3 overflow-x-auto no-scrollbar pb-1">
                        @foreach (['Halo, mohon ditunggu ya!', 'Booking sedang diproses.', 'Sudah selesai, terima kasih!'] as $reply)
                            <button @click="quickReply('{{ $reply }}')"
                                class="whitespace-nowrap bg-white text-slate-700 hover:bg-orange-500 hover:text-white px-4 py-1.5 rounded-full text-xs font-bold transition-all border border-slate-300 shadow-sm">
                                {{ $reply }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Image Preview --}}
                    <div x-show="imagePreview" class="relative inline-block mb-3 p-2 bg-white rounded-xl border-2 border-orange-300 shadow-lg" x-cloak>
                        <img :src="imagePreview" class="w-20 h-20 object-cover rounded-lg">
                        <button @click="imagePreview = null; $refs.fileInput.value = ''"
                            class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center shadow-lg border-2 border-white">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    </div>

                    {{-- Form Kirim Chat --}}
                    <form action="{{ route('admin.chat.send') }}" method="POST" enctype="multipart/form-data"
                        x-ref="chatForm" @submit="isSending = true" class="flex items-center gap-3">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">

                        <label class="w-12 h-12 flex items-center justify-center text-slate-500 hover:text-orange-600 cursor-pointer bg-white rounded-full shadow-md transition-all hover:scale-105">
                            <i class="fas fa-camera text-xl"></i>
                            <input type="file" name="image" class="hidden" x-ref="fileInput" @change="previewImage">
                        </label>

                        <div class="flex-1 relative">
                            <textarea name="message" x-ref="messageInput" rows="1"
                                @keydown.enter.exact.prevent="$refs.chatForm.submit()"
                                placeholder="Ketik pesan..."
                                class="w-full bg-white border-none rounded-2xl py-3.5 px-6 text-sm shadow-md focus:ring-2 focus:ring-orange-500 max-h-32"></textarea>
                        </div>

                        <button type="submit" :disabled="isSending"
                            class="bg-orange-500 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:bg-orange-600 transition-all hover:scale-105 active:scale-95 disabled:opacity-50">
                            <i class="fas fa-paper-plane text-lg" x-show="!isSending"></i>
                            <i class="fas fa-circle-notch animate-spin text-lg" x-show="isSending" style="display: none;"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="flex-1 flex flex-center flex-col items-center justify-center text-slate-400">
                    <i class="fas fa-comments text-6xl mb-4"></i>
                    <p>Pilih pelanggan untuk mulai chat</p>
                </div>
            @endif
        </div>

        {{-- SIDEBAR KANAN: Detail Booking --}}
        @if(isset($user))
        <div class="w-72 lg:w-80 border-l border-slate-200 bg-slate-50 flex flex-col shrink-0"
            x-show="showDetails" x-transition x-cloak>
            <div class="p-5 bg-white border-b border-slate-200 flex items-center gap-3">
                <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-receipt text-orange-600 text-sm"></i>
                </div>
                <h2 class="text-xs font-black text-slate-700 uppercase tracking-widest">Detail Booking</h2>
            </div>

            <div class="flex-1 overflow-y-auto p-4 space-y-4 custom-scrollbar">
                @forelse($user->reservations()->latest()->limit(5)->get() as $res)
                    <div class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-all">
                        <div class="flex justify-between items-start mb-3">
                            <span class="text-[10px] font-black px-2.5 py-1 rounded-full uppercase
                                {{ $res->status == 'pending' ? 'bg-orange-100 text-orange-600' :
                                   ($res->status == 'proses' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600') }}">
                                {{ $res->status }}
                            </span>
                            <span class="text-[10px] font-bold text-slate-400">#{{ $res->id }}</span>
                        </div>
                        <h4 class="text-xs font-bold text-slate-800 leading-tight mb-2">{{ $res->services }}</h4>
                        <div class="flex items-center gap-2 text-[10px] text-slate-500 mb-3">
                            <i class="far fa-calendar-alt text-orange-500"></i> {{ \Carbon\Carbon::parse($res->date)->format('d M Y') }} | {{ $res->time }}
                        </div>
                        <div class="pt-3 border-t border-slate-50 flex justify-between items-center">
                            <span class="text-[10px] font-bold text-slate-400 uppercase">Total</span>
                            <span class="text-sm font-black text-slate-800">Rp{{ number_format($res->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 opacity-30">
                        <i class="fas fa-calendar-times text-4xl mb-4"></i>
                        <p class="text-xs font-bold">Belum ada booking</p>
                    </div>
                @endforelse
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    [x-cloak] { display: none !important; }
    body { overflow: hidden; }

    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.3s ease-out forwards; }
</style>
@endsection
