<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Booking - PT RIZQALLAH</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        [x-cloak] { display: none !important; }

        .sidebar-transition { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }

        /* Custom Checkbox Bulat */
        .check-container {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 2px solid #E2E8F0;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        input:checked + .card-body .check-container {
            background: #22C55E;
            border-color: #22C55E;
        }

        input:checked + .card-body .check-icon {
            display: block;
            color: white;
        }

        .corner-glow {
            position: absolute;
            top: -30px;
            right: -30px;
            width: 100px;
            height: 100px;
            background: #FF5F00;
            border-radius: 50%;
            opacity: 0;
            transition: 0.3s;
            filter: blur(20px);
        }
        input:checked + .card-body .corner-glow { opacity: 0.15; }

        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-700" x-data="bookingApp()">

    <div class="flex min-h-screen">

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

                <button @click="step = 1" :class="step === 1 ? 'bg-orange-50 text-orange-600' : 'text-slate-500 hover:bg-slate-50'" class="w-full flex items-center px-4 py-3 rounded-xl transition-all group" :class="!sidebarOpen && 'justify-center'">
                    <i class="fa-solid fa-layer-group w-5" :class="step === 1 ? 'text-orange-500' : 'text-slate-400', sidebarOpen ? 'mr-3' : ''"></i>
                    <span x-show="sidebarOpen" class="font-semibold text-sm">Pilih Layanan</span>
                </button>

                <a href="/booking/riwayat" class="flex items-center px-4 py-3 text-slate-500 rounded-xl hover:bg-slate-50 group transition-all" :class="!sidebarOpen && 'justify-center'">
                    <i class="fa-solid fa-clipboard-list w-5 group-hover:text-orange-500" :class="sidebarOpen ? 'mr-3' : ''"></i>
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
                        <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">PT RIZQALLAH</p>
                        <h1 class="text-lg font-extrabold text-slate-800 tracking-tight">Booking System</h1>
                    </div>
                </div>

                <div class="flex items-center space-x-3 bg-slate-50 p-1.5 rounded-2xl border border-slate-100">
                    <div class="text-right pl-3 hidden sm:block">
                        <p class="text-xs font-extrabold text-slate-800">{{ auth()->user()->name ?? 'Muhamad Iqbal' }}</p>
                        <p class="text-[9px] text-slate-400 font-medium">{{ auth()->user()->email ?? 'user@gmail.com' }}</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-slate-900 flex items-center justify-center text-white text-sm font-black shadow-lg">
                        {{ substr(auth()->user()->name ?? 'I', 0, 1) }}
                    </div>
                </div>
            </header>

            <div class="p-4 md:p-8 max-w-6xl mx-auto w-full flex-1">
                <div x-show="step === 1" x-transition x-cloak class="space-y-8">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black text-slate-900">Pilih Layanan</h2>
                            <p class="text-sm text-slate-500">Katalog produk dan jasa terbaik untuk Anda.</p>
                        </div>

                        <div class="bg-slate-100 p-1 rounded-2xl flex w-full md:w-auto">
                            <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-500'" class="flex-1 md:px-6 py-2.5 text-xs font-bold rounded-xl transition-all">Semua</button>
                            <button @click="filter = 'barang'" :class="filter === 'barang' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-500'" class="flex-1 md:px-6 py-2.5 text-xs font-bold rounded-xl transition-all">Barang</button>
                            <button @click="filter = 'jasa'" :class="filter === 'jasa' ? 'bg-white shadow-sm text-slate-900' : 'text-slate-500'" class="flex-1 md:px-6 py-2.5 text-xs font-bold rounded-xl transition-all">Jasa</button>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($products->merge($services) as $item)
                        <label x-show="filter === 'all' || filter === '{{ $item->type }}'" class="relative cursor-pointer group">
                            <input type="checkbox" class="hidden peer" value="{{ $item->name }}" data-price="{{ $item->price }}" @change="updateSelection($event)">

                            <div class="card-body h-full bg-white border border-slate-200 rounded-[32px] p-7 shadow-sm transition-all duration-300 relative overflow-hidden flex flex-col peer-checked:border-green-500 peer-checked:ring-4 peer-checked:ring-green-50">
                                <div class="corner-glow"></div>

                                <div class="check-container">
                                    <i class="fa-solid fa-check text-[10px] hidden check-icon"></i>
                                </div>

                                <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-700 mb-6 transition-colors group-hover:bg-orange-50 group-hover:text-orange-500">
                                    <i class="fa-solid {{ $item->type == 'barang' ? 'fa-box-open' : 'fa-screwdriver-wrench' }} text-2xl"></i>
                                </div>

                                <h3 class="font-bold text-slate-900 mb-2 group-hover:text-orange-600 transition-colors">{{ $item->name }}</h3>
                                <p class="text-xs text-slate-400 leading-relaxed flex-1">{{ Str::limit($item->description, 80) }}</p>

                                <div class="mt-8 pt-6 border-t border-slate-50 flex justify-between items-center">
                                    <span class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400">{{ $item->type }}</span>
                                    <span class="font-black text-slate-900">Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div x-show="step === 2" x-transition x-cloak>
                    <div class="max-w-xl mx-auto space-y-8">
                        <div class="text-center">
                            <h2 class="text-2xl font-black text-slate-900">Atur Jadwal</h2>
                            <p class="text-sm text-slate-500">Pilih waktu kunjungan atau konsultasi.</p>
                        </div>

                        <div class="bg-white rounded-[32px] p-8 border border-slate-200 shadow-sm space-y-8">
                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-3">Pilih Tanggal</label>
                                <input type="date" x-model="bookingDate" min="{{ date('Y-m-d') }}" class="w-full bg-slate-50 border-none rounded-2xl px-6 py-4 focus:ring-2 focus:ring-orange-500 font-bold text-slate-800">
                            </div>

                            <div>
                                <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest block mb-3">Slot Waktu</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <template x-for="time in timeSlots">
                                        <button @click="bookingTime = time"
                                            :class="bookingTime === time ? 'bg-orange-500 text-white shadow-lg shadow-orange-100' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'"
                                            class="py-4 text-xs font-bold rounded-2xl transition-all" x-text="time"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 bg-slate-900 rounded-[32px] p-6 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl">
                    <div class="text-center md:text-left">
                        <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-1">Total Biaya</p>
                        <h3 class="text-3xl font-black text-white" x-text="formatRupiah(totalPrice)"></h3>
                    </div>

                    <div class="flex gap-4 w-full md:w-auto">
                        <button x-show="step === 2" @click="step = 1" class="flex-1 md:px-10 py-4 text-white font-bold text-sm bg-white/10 hover:bg-white/20 rounded-2xl transition-all">Kembali</button>
                        <button x-show="step === 1" @click="step = 2" :disabled="selectedItems.length === 0" class="flex-1 md:px-12 py-4 bg-orange-500 text-white font-bold text-sm rounded-2xl hover:bg-orange-600 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-xl shadow-orange-500/20">Lanjut <i class="fa-solid fa-arrow-right ml-2"></i></button>
                        <button x-show="step === 2" @click="redirectToWA()" :disabled="!bookingDate || !bookingTime" class="flex-1 md:px-12 py-4 bg-green-500 text-white font-bold text-sm rounded-2xl hover:bg-green-600 transition-all shadow-xl shadow-green-500/20">Kirim WhatsApp <i class="fa-brands fa-whatsapp ml-2 text-lg"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-30 md:hidden" x-transition:opacity x-cloak></div>

    <script>
        function bookingApp() {
            return {
                step: 1,
                filter: 'all',
                sidebarOpen: true, // Default Terbuka
                selectedItems: [],
                totalPrice: 0,
                bookingDate: '',
                bookingTime: '',
                timeSlots: ['09:00', '11:00', '14:00', '16:00', '19:00'],

                // Fungsi yang berjalan saat halaman dimuat
                init() {
                    // Redirect otomatis ke riwayat jika diinginkan
                    // window.location.href = "/booking/riwayat";
                },

                updateSelection(e) {
                    const itemName = e.target.value;
                    const itemPrice = parseInt(e.target.dataset.price);
                    if (e.target.checked) {
                        this.selectedItems.push(itemName);
                        this.totalPrice += itemPrice;
                    } else {
                        this.selectedItems = this.selectedItems.filter(i => i !== itemName);
                        this.totalPrice -= itemPrice;
                    }
                },

                formatRupiah(num) {
                    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(num);
                },

                redirectToWA() {
                    const phone = "6289502669582";
                    const text = `*PESANAN BOOKING BARU*\n\n*Pelanggan:* {{ auth()->user()->name ?? 'Muhamad Iqbal' }}\n*Layanan:* ${this.selectedItems.join(', ')}\n*Total:* ${this.formatRupiah(this.totalPrice)}\n*Jadwal:* ${this.bookingDate} (${this.bookingTime} WIB)`;
                    window.open(`https://wa.me/${phone}?text=${encodeURIComponent(text)}`, '_blank');
                }
            }
        }
    </script>
</body>
</html>
