@extends('admin.layouts.app')

@section('title', 'WhatsApp Admin - ' . ($user->name ?? 'Chat'))

@section('content')
    @php
        use App\Models\Reservation;
        use App\Models\Message;

        // =============================
        // GABUNG USER CHAT + BOOKING
        // =============================
        // Mengambil user yang pernah booking
        $bookingUsers = Reservation::with('user')->get()->pluck('user')->filter();

        // Mengambil user yang ada di tabel chat (meskipun belum/tidak booking)
        $sidebarUsers = $active_chats
            ->merge($bookingUsers)
            ->unique('id')
            ->values()
            ->map(function ($u) {
                // Ambil pesan terakhir untuk setiap user
                $u->latest_msg = \App\Models\Message::where(function ($q) use ($u) {
                    $q->where('sender_id', $u->id)->orWhere('receiver_id', $u->id);
                })
                    ->latest()
                    ->first();
                return $u;
            });

        // =============================
        // BOOKING USER AKTIF (HEADER)
        // =============================
        $activeBooking = isset($user) ? Reservation::where('user_id', $user->id)->latest()->first() : null;
    @endphp

    <div class="container mx-auto px-4 py-4 h-[calc(100vh-120px)]" x-data="{
        search: '',
        preview: null,
        fileName: '',
        isImage: false,
        scrollBottom() {
            this.$nextTick(() => {
                let box = document.getElementById('chat-box');
                if (box) box.scrollTop = box.scrollHeight;
            });
        },
        handleFile(e) {
            const file = e.target.files[0];
            if (!file) return;
            this.fileName = file.name;
            this.isImage = file.type.startsWith('image/');

            if (this.isImage) {
                const reader = new FileReader();
                reader.onload = ev => this.preview = ev.target.result;
                reader.readAsDataURL(file);
            } else {
                this.preview = null;
            }
        },
        clearFile() {
            this.preview = null;
            this.fileName = '';
            document.getElementById('file-input').value = '';
        }
    }" x-init="scrollBottom()">

        <div class="flex h-full bg-white rounded-2xl shadow-xl border overflow-hidden">

            {{-- ===================== --}}
            {{-- SIDEBAR KIRI --}}
            {{-- ===================== --}}
            <div class="w-80 border-r flex flex-col bg-white">

                <div class="p-4 border-b bg-slate-50">
                    <h2 class="text-xs font-black uppercase tracking-wider text-slate-600">Daftar Pesan & Booking</h2>
                </div>

                {{-- SEARCH ENGINE --}}
                <div class="p-3">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-3 text-slate-400 text-xs"></i>
                        <input x-model="search" placeholder="Cari pelanggan..."
                            class="w-full bg-slate-100 rounded-xl px-9 py-2 text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all">
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    @foreach ($sidebarUsers as $su)
                        <div x-show="search === '' || '{{ strtolower($su->name) }}'.includes(search.toLowerCase())">
                            <a href="{{ route('admin.booking.chat', ['user_id' => $su->id]) }}"
                                class="flex items-center gap-3 p-4 hover:bg-slate-50 transition-all border-b border-slate-50
            {{ isset($user) && $user->id == $su->id ? 'bg-orange-50 border-l-4 border-orange-500' : '' }}">

                                <div class="relative">
                                    <div
                                        class="w-12 h-12 bg-slate-200 rounded-2xl flex items-center justify-center font-black text-slate-600 shadow-sm">
                                        {{ strtoupper(substr($su->name, 0, 1)) }}
                                    </div>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <div class="flex justify-between items-start">
                                        <p class="font-bold text-sm truncate text-slate-800">{{ $su->name }}</p>
                                        @if ($su->latest_msg)
                                            <span
                                                class="text-[10px] text-slate-400 font-medium">{{ $su->latest_msg->created_at->format('H:i') }}</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-500 truncate mt-0.5">
                                        @if ($su->latest_msg)
                                            @if ($su->latest_msg->sender_type == 'admin')
                                                <span class="text-orange-500 font-bold">Anda:</span>
                                            @endif
                                            {{ $su->latest_msg->image ? '📷 Gambar' : ($su->latest_msg->file ? '📁 File' : $su->latest_msg->message) }}
                                        @else
                                            <span class="italic text-slate-400 text-[11px]">Belum ada riwayat pesan</span>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ===================== --}}
            {{-- PANEL CHAT --}}
            {{-- ===================== --}}
            <div class="flex-1 flex flex-col bg-[#F0F2F5]">

                @if (isset($user))
                    {{-- HEADER CHAT --}}
                    <div class="p-4 bg-white border-b flex justify-between items-center shadow-sm z-10">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center font-black shadow-inner">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-black text-slate-800 leading-tight">{{ $user->name }}</h3>
                                <p class="text-[11px] text-slate-500 font-bold flex items-center gap-1">
                                    <i class="fas fa-phone text-[9px]"></i> {{ $activeBooking->phone ?? 'Tidak ada nomor' }}
                                </p>
                            </div>
                        </div>

                        @if ($activeBooking)
                            <div class="flex flex-col items-end">
                                <span
                                    class="text-[10px] font-black px-3 py-1 rounded-lg shadow-sm
            {{ $activeBooking->status == 'pending'
                ? 'bg-orange-100 text-orange-600 border border-orange-200'
                : ($activeBooking->status == 'proses'
                    ? 'bg-blue-100 text-blue-600 border border-blue-200'
                    : 'bg-green-100 text-green-600 border border-green-200') }}">
                                    {{ strtoupper($activeBooking->status) }}
                                </span>
                                <span class="text-[9px] text-slate-400 mt-1 uppercase tracking-tighter">Booking
                                    Terakhir</span>
                            </div>
                        @endif
                    </div>

                    {{-- AREA CHAT --}}
                    <div id="chat-box" class="flex-1 overflow-y-auto p-6 space-y-4 custom-scrollbar">
                        @foreach ($messages as $msg)
                            <div class="flex {{ $msg->sender_type == 'admin' ? 'justify-end' : 'justify-start' }}">
                                <div
                                    class="group relative max-w-[70%] px-4 py-2 rounded-2xl shadow-sm
        {{ $msg->sender_type == 'admin' ? 'bg-orange-600 text-white rounded-tr-none' : 'bg-white border text-slate-800 rounded-tl-none' }}">

                                    {{-- TAMPILAN GAMBAR --}}
                                    @if ($msg->image)
                                        <div class="mb-2 mt-1">
                                            <img src="{{ asset('storage/' . $msg->image) }}"
                                                class="rounded-lg max-h-72 w-full object-cover cursor-pointer hover:brightness-90 transition"
                                                onclick="window.open(this.src)">
                                        </div>
                                    @endif

                                    {{-- TAMPILAN FILE --}}
                                    @if ($msg->file)
                                        <a href="{{ asset('storage/' . $msg->file) }}" target="_blank"
                                            class="flex items-center gap-3 p-2 mb-2 rounded-lg {{ $msg->sender_type == 'admin' ? 'bg-orange-700' : 'bg-slate-100' }} hover:bg-opacity-80 transition">
                                            <i class="fas fa-file-alt text-xl"></i>
                                            <div class="min-w-0">
                                                <p class="text-xs font-bold truncate">Buka Lampiran File</p>
                                                <p class="text-[10px] opacity-70 italic">Klik untuk mengunduh</p>
                                            </div>
                                        </a>
                                    @endif

                                    @if ($msg->message)
                                        <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                                    @endif

                                    <div class="flex items-center justify-end gap-1 mt-1">
                                        <span class="text-[9px] opacity-70">{{ $msg->created_at->format('H:i') }}</span>
                                        @if ($msg->sender_type == 'admin')
                                            <i class="fas fa-check-double text-[9px] text-orange-200"></i>
                                        @endif
                                    </div>

                                    {{-- TOMBOL HAPUS --}}
                                    @if ($msg->sender_type == 'admin')
                                        <form action="{{ route('admin.chat.delete', $msg->id) }}" method="POST"
                                            onsubmit="return confirm('Hapus pesan ini?')"
                                            class="absolute -left-10 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 transition-all">
                                            @csrf @method('DELETE')
                                            <button
                                                class="w-8 h-8 bg-white text-red-500 rounded-full shadow-lg flex items-center justify-center hover:scale-110 active:scale-95 transition">
                                                <i class="fas fa-trash text-xs"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- INPUT PESAN --}}
                    <div class="p-4 bg-white border-t">

                        {{-- FILE PREVIEW POPUP --}}
                        <div x-show="fileName" x-transition
                            class="mb-3 p-3 bg-slate-50 border rounded-2xl flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <template x-if="isImage">
                                    <img :src="preview" class="w-12 h-12 rounded-lg object-cover border">
                                </template>
                                <template x-if="!isImage">
                                    <div
                                        class="w-12 h-12 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-file-alt text-xl"></i>
                                    </div>
                                </template>
                                <div class="min-w-0">
                                    <p class="text-xs font-bold text-slate-700 truncate" x-text="fileName"></p>
                                    <p class="text-[10px] text-slate-500 uppercase font-black">Siap dikirim...</p>
                                </div>
                            </div>
                            <button type="button" @click="clearFile" class="text-slate-400 hover:text-red-500 p-2">
                                <i class="fas fa-times-circle text-xl"></i>
                            </button>
                        </div>

                        <form action="{{ route('admin.chat.send') }}" method="POST" enctype="multipart/form-data"
                            class="flex gap-2 items-end">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->id }}">

                            <div class="flex gap-1">
                                <label
                                    class="w-12 h-12 bg-slate-100 hover:bg-slate-200 rounded-xl flex items-center justify-center cursor-pointer transition-colors group">
                                    <i class="fas fa-paperclip text-slate-500 group-hover:text-orange-600"></i>
                                    <input type="file" name="file" id="file-input" class="hidden"
                                        @change="handleFile">
                                </label>
                            </div>

                            <div class="flex-1 relative">
                                <textarea name="message" rows="1"
                                    class="w-full bg-slate-100 rounded-2xl px-4 py-3 text-sm focus:ring-2 focus:ring-orange-500 outline-none transition-all resize-none"
                                    placeholder="Tulis pesan ke {{ $user->name }}..." @keydown.enter.prevent="$el.form.submit()"></textarea>
                            </div>

                            <button
                                class="bg-orange-600 hover:bg-orange-700 text-white w-12 h-12 rounded-xl shadow-lg shadow-orange-200 flex items-center justify-center transition-all active:scale-90">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex-1 flex flex-col items-center justify-center text-slate-400 bg-slate-50">
                        <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-comments text-4xl text-slate-300"></i>
                        </div>
                        <h3 class="font-bold text-slate-500">Pilih Pelanggan</h3>
                        <p class="text-xs">Klik pada daftar di sebelah kiri untuk mulai mengobrol.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }

        body {
            overflow: hidden;
        }

        /* Animasi bubble chat */
        #chat-box div {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
