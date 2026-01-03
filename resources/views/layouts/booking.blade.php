<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PT RIZQALLAH')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        .sidebar-transition {
            transition: all 0.3s ease;
        }

        @yield('styles')
    </style>
</head>

<body class="bg-slate-50 text-slate-700" x-data="{ sidebarOpen: true, mobileSidebar: false }">

    <div class="flex min-h-screen overflow-hidden">

        <div x-show="mobileSidebar" x-cloak class="fixed inset-0 z-50 flex md:hidden" role="dialog" aria-modal="true">

            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="mobileSidebar = false"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <div class="relative flex w-full max-w-xs flex-1 flex-col bg-white"
                x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full">

                <div class="flex h-16 items-center justify-between px-6 border-b">
                    <span class="font-extrabold text-orange-500">PT RIZQALLAH</span>
                    <button @click="mobileSidebar = false" class="text-slate-500">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <nav class="flex-1 space-y-2 p-4">
                    <a href="{{ route('booking.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('booking.index') ? 'bg-orange-50 text-orange-600' : 'text-slate-500' }}">
                        <i class="fa-solid fa-calendar-check w-5 mr-3"></i> Booking Baru
                    </a>
                    <a href="{{ route('booking.riwayat') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold {{ request()->routeIs('booking.riwayat') ? 'bg-orange-50 text-orange-600' : 'text-slate-500' }}">
                        <i class="fa-solid fa-clock-rotate-left w-5 mr-3"></i> Status Pesanan
                    </a>
                    <div class="border-t my-4"></div>
                    <a href="{{ route('chat.index') }}"
                        class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold text-slate-500">
                        <i class="fa-solid fa-comment-dots w-5 mr-3"></i> Chat Admin
                    </a>
                </nav>

                <div class="p-4 border-t">
                    <form method="POST" action="{{ route('booking.logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center px-4 py-3 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 transition">
                            <i class="fa-solid fa-right-from-bracket w-5 mr-3"></i> Keluar Aplikasi
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <aside
            class="hidden md:flex flex-col bg-white border-r border-slate-200 sidebar-transition sticky top-0 h-screen"
            :class="sidebarOpen ? 'w-72' : 'w-20'">
            <div class="h-16 flex items-center justify-between px-5 border-b shrink-0">
                <div class="flex items-center space-x-3" x-show="sidebarOpen">
                    <div
                        class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white font-black">
                        R
                    </div>
                    <span class="font-extrabold text-sm tracking-tight">PT RIZQALLAH</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-orange-500 mx-auto">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>

            <nav class="flex-1 px-3 py-6 space-y-2 overflow-y-auto">
                <a href="{{ route('booking.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('booking.index') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-100' }}">
                    <i class="fa-solid fa-calendar-check w-5 shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'"></i>
                    <span x-show="sidebarOpen">Booking Baru</span>
                </a>

                <a href="{{ route('booking.riwayat') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold transition
               {{ request()->routeIs('booking.riwayat') ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-100' }}">
                    <i class="fa-solid fa-clock-rotate-left w-5 shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'"></i>
                    <span x-show="sidebarOpen">Status Pesanan</span>
                </a>

                <div class="border-t my-4" x-show="sidebarOpen"></div>

                <a href="{{ route('chat.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-sm font-semibold text-slate-500 hover:bg-blue-50 hover:text-blue-600 transition">
                    <i class="fa-solid fa-comment-dots w-5 shrink-0" :class="sidebarOpen ? 'mr-3' : 'mx-auto'"></i>
                    <span x-show="sidebarOpen">Chat Admin</span>
                </a>
            </nav>

            <div class="p-4 border-t space-y-2 shrink-0">
                <div class="flex items-center bg-slate-50 rounded-xl p-3"
                    :class="sidebarOpen ? 'space-x-3' : 'justify-center'">
                    <div
                        class="w-9 h-9 bg-orange-500 rounded-lg flex items-center justify-center text-white font-bold shrink-0">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="overflow-hidden" x-show="sidebarOpen">
                        <p class="text-xs font-bold truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[10px] text-green-500 font-bold uppercase">Online</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('booking.logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full px-4 py-3 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 transition-all group"
                        :class="sidebarOpen ? '' : 'justify-center'">
                        <i class="fa-solid fa-right-from-bracket w-5 shrink-0 group-hover:translate-x-1 transition-transform"
                            :class="sidebarOpen ? 'mr-3' : ''"></i>
                        <span x-show="sidebarOpen">Keluar Aplikasi</span>
                    </button>
                </form>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden">

            <header class="h-16 bg-white border-b flex items-center justify-between px-6 sticky top-0 z-30 shrink-0">
                <div class="flex items-center space-x-3">
                    <button class="md:hidden text-slate-500 hover:text-orange-500 p-2" @click="mobileSidebar = true">
                        <i class="fa-solid fa-bars-staggered text-xl"></i>
                    </button>

                    <div>
                        <h1 class="text-base font-extrabold text-slate-800">@yield('header_title')</h1>
                        <p class="text-xs text-slate-400">@yield('header_subtitle')</p>
                    </div>
                </div>

                <div class="flex items-center space-x-3 bg-slate-100 px-3 py-1.5 rounded-xl border border-slate-200">
                    <div class="text-right hidden sm:block">
                        <p class="text-xs font-bold leading-none">{{ auth()->user()->name }}</p>
                        <span class="text-[10px] text-orange-600 font-bold uppercase">Customer Account</span>
                    </div>
                    <div
                        class="w-9 h-9 bg-orange-500 rounded-xl flex items-center justify-center text-white font-bold shadow-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-slate-50/50">
                <div class="max-w-7xl mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    @yield('scripts')

</body>

</html>
