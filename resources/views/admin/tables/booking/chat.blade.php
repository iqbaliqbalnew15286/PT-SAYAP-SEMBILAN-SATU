@extends('admin.layouts.app')

@section('title', 'WhatsApp Admin - ' . ($user->name ?? 'Chat'))

@section('content')
    @php
        use App\Models\Reservation;
        use App\Models\Message;

        $bookingUsers = Reservation::with('user')->get()->pluck('user')->filter();

        $sidebarUsers = $active_chats
            ->merge($bookingUsers)
            ->unique('id')
            ->values()
            ->map(function ($u) {
                $u->latest_msg = Message::where(function ($q) use ($u) {
                    $q->where('sender_id', $u->id)->orWhere('receiver_id', $u->id);
                })
                    ->latest()
                    ->first();
                return $u;
            });

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

            {{-- SIDEBAR --}}
            <div class="w-80 border-r flex flex-col bg-white">
                <div class="p-4 border-b bg-slate-50">
                    <h2 class="text-xs font-black uppercase tracking-wider text-slate-600">
                        Daftar Pesan & Booking
                    </h2>
                </div>

                <div class="p-3">
                    <input x-model="search" placeholder="Cari pelanggan..."
                        class="w-full bg-slate-100 rounded-xl px-4 py-2 text-sm">
                </div>

                <div class="flex-1 overflow-y-auto custom-scrollbar">
                    @foreach ($sidebarUsers as $su)
                        <a href="{{ route('admin.booking.chat', ['user_id' => $su->id]) }}"
                            class="flex gap-3 p-4 border-b hover:bg-slate-50
           {{ isset($user) && $user->id == $su->id ? 'bg-orange-50 border-l-4 border-orange-500' : '' }}">
                            <div class="w-12 h-12 bg-slate-200 rounded-xl flex items-center justify-center font-bold">
                                {{ strtoupper(substr($su->name, 0, 1)) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-bold text-sm truncate">{{ $su->name }}</p>
                                <p class="text-xs truncate text-slate-500">
                                    {{ $su->latest_msg->message ?? 'Belum ada pesan' }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- CHAT PANEL --}}
            <div class="flex-1 flex flex-col bg-[#F0F2F5]">

                @if (isset($user))
                    {{-- CHAT BOX --}}
                    <div id="chat-box" class="flex-1 p-6 overflow-y-auto space-y-4 custom-scrollbar">
                        @foreach ($messages as $msg)
                            <div class="flex {{ $msg->sender_type == 'admin' ? 'justify-end' : 'justify-start' }}">
                                <div
                                    class="max-w-[70%] px-4 py-2 rounded-2xl
        {{ $msg->sender_type == 'admin' ? 'bg-orange-600 text-white' : 'bg-white border' }}">
                                    {{ $msg->message }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- INPUT --}}
                    <div class="p-4 bg-white border-t">
                        <form action="{{ route('admin.chat.send') }}" method="POST" enctype="multipart/form-data"
                            class="flex gap-2 items-end">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $user->id }}">

                            <textarea name="message" rows="1" class="flex-1 bg-slate-100 rounded-xl px-4 py-3 text-sm resize-none"
                                placeholder="Tulis pesan ke {{ $user->name }}..." @keydown.enter.stop></textarea>

                            <button type="submit" class="w-12 h-12 bg-orange-600 text-white rounded-xl">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex-1 flex items-center justify-center text-slate-400">
                        Pilih pelanggan untuk mulai chat
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 10px;
        }

        body {
            overflow: hidden;
        }
    </style>
@endsection
