<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT RIZQALLAH')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: all 0.3s ease; }
        @yield('styles')
    </style>
</head>

<body class="bg-slate-50 text-slate-700" x-data="{ sidebarOpen: true, mobileSidebar: false }">

<div class="flex min-h-screen overflow-hidden">

    <!-- ================= SIDEBAR DESKTOP ================= -->
    <aside
        class="hidden md:flex flex-col bg-white border-r border-slate-200 sidebar-transition"
        :class="sidebarOpen ? 'w-72' : 'w-20'"
    >
        <!-- Logo -->
        <div class="h-16 flex items-center justify-between px-5 border-b">
            <div class="flex items-center space-x-3" x-show="sidebarOpen">
                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-black">
                    R
                </div>
                <span class="font-extrabold text-sm tracking-tight">PT RIZQALLAH</span>
            </div>
            <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-orange-500">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>

        <!-- Menu -->
        <nav class="flex-1 px-3 py-6 space-y-2">
            <a href="{{ route('booking.index') }}"
               class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('booking.index') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-100' }}">
                <i class="fa-solid fa-calendar-check w-5 mr-3"></i>
                <span x-show="sidebarOpen">Booking Baru</span>
            </a>

            <a href="{{ route('booking.riwayat') }}"
               class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('booking.riwayat') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-100' }}">
                <i class="fa-solid fa-clock-rotate-left w-5 mr-3"></i>
                <span x-show="sidebarOpen">Status Pesanan</span>
            </a>

            <div class="border-t my-4" x-show="sidebarOpen"></div>

            <a href="{{ route('chat.index') }}"
               class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition">
                <i class="fa-solid fa-comment-dots w-5 mr-3"></i>
                <span x-show="sidebarOpen">Chat Admin</span>
            </a>
        </nav>

        <!-- User -->
        <div class="p-4 border-t" x-show="sidebarOpen">
            <div class="flex items-center space-x-3 bg-slate-50 rounded-xl p-3">
                <div class="w-9 h-9 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name,0,1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[10px] text-green-500 font-bold uppercase">Online</p>
                </div>
            </div>
        </div>
    </aside>

    <!-- ================= MAIN ================= -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">

        <!-- Header -->
        <header class="h-16 bg-white border-b flex items-center justify-between px-6 sticky top-0 z-30">
            <div class="flex items-center space-x-3">
                <!-- Mobile menu -->
                <button class="md:hidden text-slate-500" @click="mobileSidebar = true">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div>
                    <h1 class="text-base font-extrabold text-slate-800">@yield('header_title')</h1>
                    <p class="text-xs text-slate-400">@yield('header_subtitle')</p>
                </div>
            </div>

            <div class="flex items-center space-x-3 bg-slate-100 px-3 py-1.5 rounded-xl">
                <div class="text-right hidden sm:block">
                    <p class="text-xs font-bold">{{ auth()->user()->name }}</p>
                    <span class="text-[10px] text-green-600 font-bold">Customer</span>
                </div>
                <div class="w-9 h-9 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->name,0,1) }}
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-y-auto">
            <div class="max-w-7xl mx-auto px-6 py-8">
                @yield('content')
            </div>
        </main>

    </div>
</div>

@yield('scripts')

</body>
</html>

