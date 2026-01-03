<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT RIZQALLAH')</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        @yield('styles')
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-700" x-data="bookingApp()">

    <div class="flex min-h-screen">
        {{-- SIDEBAR --}}
        <aside :class="sidebarOpen ? 'w-72' : 'w-20'" class="bg-white border-r border-slate-200 flex flex-col sticky top-0 h-screen sidebar-transition z-40 hidden md:flex">
            <div class="p-6 flex items-center border-b border-slate-50" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                <div class="flex items-center space-x-3 overflow-hidden" x-show="sidebarOpen">
                    <div class="min-w-[40px] h-10 bg-orange-600 rounded-xl flex items-center justify-center text-white font-black">R</div>
                    <span class="font-extrabold text-sm tracking-tight whitespace-nowrap">PT RIZQALLAH</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-orange-500">
                    <i class="fa-solid fa-bars-staggered"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="{{ route('booking.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('booking.index') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-50' }} rounded-xl transition-all group">
                    <i class="fa-solid fa-calendar-check w-5 mr-3"></i>
                    <span x-show="sidebarOpen" class="font-bold text-sm">Booking Baru</span>
                </a>

                <a href="{{ route('booking.riwayat') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('booking.riwayat') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-50' }} rounded-xl transition-all">
                    <i class="fa-solid fa-clock-rotate-left w-5 mr-3"></i>
                    <span x-show="sidebarOpen" class="font-bold text-sm">Cek Status Pesanan</span>
                </a>

                <div class="my-4 border-t border-slate-100" x-show="sidebarOpen"></div>

                <a href="{{ route('chat.index') }}" class="flex items-center px-4 py-3 text-slate-500 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all group relative">
                    <i class="fa-solid fa-comment-dots w-5 mr-3"></i>
                    <span x-show="sidebarOpen" class="font-bold text-sm">Chat Admin</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-50" x-show="sidebarOpen">
                <div class="bg-slate-50 rounded-2xl p-3 flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-lg bg-orange-500 flex items-center justify-center text-white text-xs font-black">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-[10px] font-bold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[8px] text-green-500 font-bold uppercase tracking-wider">Online</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto">
            {{-- HEADER --}}
            <header class="bg-white/80 backdrop-blur-md border-b px-8 py-4 sticky top-0 z-30 flex justify-between items-center">
                <div>
                    <h1 class="text-lg font-black text-slate-800">@yield('header_title')</h1>
                    <p class="text-xs text-slate-400">@yield('header_subtitle')</p>
                </div>
                <div class="flex items-center space-x-3 bg-slate-50 p-2 rounded-2xl border">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold">{{ auth()->user()->name }}</p>
                        <span class="text-[10px] text-green-500 font-bold uppercase">Customer</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-orange-500 flex items-center justify-center text-white font-black">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            {{-- CONTENT --}}
            <div class="p-8 max-w-6xl mx-auto w-full">
                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
