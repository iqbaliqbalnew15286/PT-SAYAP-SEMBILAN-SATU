<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - PT RIZQALLAH</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }
        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-700" x-data="{ sidebarOpen: true }"> <div class="flex min-h-screen">

        <aside
            :class="sidebarOpen ? 'w-72' : 'w-20'"
            class="bg-white border-r border-slate-200 flex flex-col sticky top-0 h-screen sidebar-transition z-40 hidden md:flex shadow-sm">

            <div class="p-6 flex items-center border-b border-slate-50" :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                <div class="flex items-center space-x-3 overflow-hidden" x-show="sidebarOpen">
                    <div class="min-w-[40px] h-10 bg-slate-900 rounded-xl flex items-center justify-center text-white font-bold">RBM</div>
                    <span class="font-extrabold text-sm tracking-tight whitespace-nowrap">PT RIZQALLAH</span>
                </div>
                <button @click="sidebarOpen = !sidebarOpen" class="text-slate-400 hover:text-orange-500 transition-colors">
                    <i class="fa-solid fa-bars-staggered text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto no-scrollbar">

                <a href="{{ route('booking') }}" class="flex items-center px-4 py-3 text-slate-500 rounded-xl hover:bg-slate-50 group transition-all" :class="!sidebarOpen && 'justify-center'">
                    <i class="fa-solid fa-layer-group w-5 group-hover:text-orange-500" :class="sidebarOpen ? 'mr-3' : ''"></i>
                    <span x-show="sidebarOpen" class="font-semibold text-sm">Pilih Layanan</span>
                </a>

                <a href="{{ route('booking.riwayat') }}" class="flex items-center px-4 py-3 bg-orange-50 text-orange-600 rounded-xl group transition-all" :class="!sidebarOpen && 'justify-center'">
                    <i class="fa-solid fa-clipboard-list w-5 text-orange-500" :class="sidebarOpen ? 'mr-3' : ''"></i>
                    <span x-show="sidebarOpen" class="font-semibold text-sm">Riwayat Booking</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-50">
                <form action="{{ route('booking.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50 rounded-xl transition-all" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
                        <i class="fa-solid fa-power-off w-5" :class="sidebarOpen ? 'mr-3' : ''"></i>
                        <span x-show="sidebarOpen">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col h-screen overflow-y-auto w-full">

            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 md:px-8 py-4 sticky top-0 z-30 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-slate-600 p-2 hover:bg-slate-100 rounded-lg">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <div class="hidden sm:block">
                        <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">USER PANEL</p>
                        <h1 class="text-lg font-extrabold text-slate-800 tracking-tight">Riwayat Booking</h1>
                    </div>
                </div>

                <div class="flex items-center space-x-3 bg-slate-50 p-1.5 rounded-2xl border border-slate-100">
                    <div class="text-right pl-3 hidden sm:block">
                        <p class="text-xs font-extrabold text-slate-800">{{ auth()->user()->name }}</p>
                        <p class="text-[9px] text-slate-400 font-medium">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white text-sm font-black shadow-lg">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-4 md:p-8 max-w-6xl mx-auto w-full">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    <div class="bg-white p-6 rounded-[24px] border border-slate-100 shadow-sm flex items-center space-x-4">
                        <div class="w-12 h-12 bg-orange-50 text-orange-500 rounded-2xl flex items-center justify-center text-xl">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Booking</p>
                            <h3 class="text-2xl font-black text-slate-900">{{ $bookings->count() }}</h3>
                        </div>
                    </div>
                </div>

                <div class="bg-white border border-slate-200 rounded-[32px] overflow-hidden shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50">
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Layanan</th>
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tanggal & Waktu</th>
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Biaya</th>
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                                    <th class="px-6 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest text-center">Bantuan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @forelse($bookings as $booking)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-5">
                                        <p class="font-bold text-slate-800 text-sm capitalize">{{ $booking->services }}</p>
                                        <p class="text-[10px] text-slate-400 font-medium mt-0.5 tracking-wider">#BOK-{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center text-sm text-slate-700 font-semibold">
                                            <i class="fa-regular fa-calendar-check mr-2 text-orange-500"></i>
                                            {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}
                                        </div>
                                        <p class="text-[11px] text-slate-400 font-medium ml-6 mt-1">{{ $booking->time }} WIB</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <span class="font-black text-slate-900 text-sm">Rp{{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        @if($booking->status == 'pending')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-orange-50 text-orange-600 border border-orange-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-orange-500 mr-2 animate-pulse"></span> PENDING
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-green-50 text-green-600 border border-green-100">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span> SELESAI
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <a href="https://wa.me/6289502669582?text={{ urlencode('Halo PT RIZQALLAH, saya ingin konfirmasi booking ID #BOK-'.$booking->id) }}"
                                           target="_blank"
                                           class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-green-50 text-green-600 hover:bg-green-500 hover:text-white transition-all shadow-sm">
                                            <i class="fa-brands fa-whatsapp text-lg"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-200">
                                                <i class="fa-solid fa-clipboard-question text-3xl"></i>
                                            </div>
                                            <p class="text-slate-400 font-bold text-sm italic">Belum ada riwayat pemesanan.</p>
                                            <a href="{{ route('booking') }}" class="mt-4 px-8 py-3 bg-slate-900 text-white text-[10px] font-bold rounded-xl uppercase tracking-widest hover:bg-orange-600 transition-all shadow-lg">Buat Pesanan Baru</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 md:hidden" x-transition:opacity x-cloak></div>

</body>
</html>
