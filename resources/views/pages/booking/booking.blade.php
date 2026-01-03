@extends('layouts.booking')

@section('title', 'Booking Layanan - PT RIZQALLAH')
@section('header_title', 'Pilih Layanan')
@section('header_subtitle', 'Cari dan pilih produk atau jasa yang Anda butuhkan')

@section('styles')
<style>
    [x-cloak] { display: none !important; }

    /* Custom Scrollbar */
    .custom-scroll::-webkit-scrollbar { width: 6px; }
    .custom-scroll::-webkit-scrollbar-track { background: #f1f1f1; }
    .custom-scroll::-webkit-scrollbar-thumb { background: #ed8936; border-radius: 10px; }

    /* Checkbox Card Animation */
    .card-content { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    input:checked + .card-content {
        border-color: #f97316;
        background-color: #fffaf8;
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(249, 115, 22, 0.1), 0 10px 10px -5px rgba(249, 115, 22, 0.04);
    }

    .check-container {
        position: absolute; top: 12px; right: 12px; width: 24px; height: 24px;
        border-radius: 50%; border: 2px solid #E2E8F0; background: white;
        display: flex; align-items: center; justify-content: center; z-index: 10;
        transition: all 0.2s ease;
    }
    input:checked + .card-content .check-container {
        background: #22C55E; border-color: #22C55E; scale: 1.1;
    }

    /* Floating Bar Shadow */
    .floating-bar {
        box-shadow: 0 -10px 15px -3px rgba(0, 0, 0, 0.1), 0 -4px 6px -2px rgba(0, 0, 0, 0.05);
    }
</style>
@endsection

@section('content')
<div x-data="bookingApp()" x-init="init()" x-cloak class="pb-32">

    {{-- STEP 1: PEMILIHAN PRODUK --}}
    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4">

        {{-- FILTER & SEARCH STICKY BAR --}}
        <div class="sticky top-16 z-30 bg-slate-50/80 backdrop-blur-md py-4 mb-6">
            <div class="flex flex-col md:flex-row gap-4 justify-between items-center">
                <div class="bg-white p-1.5 rounded-2xl shadow-sm border flex w-full md:w-auto">
                    <button @click="filter='all'" :class="filter==='all'?'bg-orange-600 text-white shadow-md shadow-orange-200':'text-slate-500 hover:bg-slate-50'"
                        class="flex-1 md:flex-none px-6 py-2.5 text-xs font-bold rounded-xl transition-all">Semua</button>
                    <button @click="filter='barang'" :class="filter==='barang'?'bg-orange-600 text-white shadow-md shadow-orange-200':'text-slate-500 hover:bg-slate-50'"
                        class="flex-1 md:flex-none px-6 py-2.5 text-xs font-bold rounded-xl transition-all">Barang</button>
                    <button @click="filter='jasa'" :class="filter==='jasa'?'bg-orange-600 text-white shadow-md shadow-orange-200':'text-slate-500 hover:bg-slate-50'"
                        class="flex-1 md:flex-none px-6 py-2.5 text-xs font-bold rounded-xl transition-all">Jasa</button>
                </div>

                <div class="relative w-full md:w-72">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                    <input type="text" x-model="search" placeholder="Cari produk..."
                        class="w-full pl-11 pr-4 py-3 rounded-2xl border-none shadow-sm focus:ring-2 focus:ring-orange-500 transition-all">
                </div>
            </div>
        </div>

        {{-- GRID PRODUK --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php $allItems = collect($products)->merge($services); @endphp
            @foreach ($allItems as $item)
            <label x-show="shouldShow('{{ $item->type }}', '{{ strtolower($item->name) }}')"
                   class="relative group cursor-pointer block h-full">
                <input type="checkbox" class="hidden peer"
                    value="{{ $item->name }}"
                    data-price="{{ $item->price }}"
                    @change="updateSelection($event)"
                    :checked="selectedItems.includes('{{ $item->name }}')">

                <div class="card-content h-full bg-white border border-slate-200 rounded-[32px] overflow-hidden">
                    <div class="check-container">
                        <i class="fa-solid fa-check hidden check-icon text-[10px] text-white"></i>
                    </div>

                    <div class="h-48 bg-slate-100 overflow-hidden relative">
                        @if($item->image)
                            <img src="{{ asset('storage/'.$item->image) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="{{ $item->name }}">
                        @else
                            <div class="h-full flex flex-col items-center justify-center text-slate-300">
                                <i class="fa-solid fa-image text-3xl mb-2"></i>
                                <span class="text-[10px] font-bold uppercase tracking-widest">No Preview</span>
                            </div>
                        @endif
                        <div class="absolute bottom-3 left-3">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur text-[9px] font-black uppercase rounded-lg text-slate-700 shadow-sm border border-slate-100">
                                {{ $item->type }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <h3 class="font-bold text-slate-800 leading-tight mb-2 group-hover:text-orange-600 transition-colors">{{ $item->name }}</h3>
                        <p class="text-xs text-slate-500 leading-relaxed mb-4">{{ Str::limit($item->description, 60) }}</p>
                        <div class="text-lg font-black text-slate-900 tracking-tight">
                            Rp{{ number_format($item->price, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </label>
            @endforeach
        </div>

        {{-- EMPTY STATE --}}
        <div x-show="isEmpty()" class="py-20 text-center">
            <div class="bg-slate-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-box-open text-3xl text-slate-300"></i>
            </div>
            <h3 class="text-slate-500 font-bold">Produk tidak ditemukan</h3>
            <p class="text-slate-400 text-sm">Coba kata kunci atau filter lain</p>
        </div>
    </div>

    {{-- STEP 2: PENJADWALAN (MODAL STYLE) --}}
    <div x-show="step === 2" class="fixed inset-0 z-[60] flex items-center justify-center px-4" x-transition>
        <div @click="step = 1" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm"></div>
        <div class="relative bg-white w-full max-w-lg rounded-[40px] shadow-2xl overflow-hidden" @click.away="step = 1">
            <div class="p-8 border-b flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-black text-slate-900">Atur Jadwal</h2>
                    <p class="text-xs text-slate-400">Tentukan waktu kunjungan Anda</p>
                </div>
                <button @click="step = 1" class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center text-slate-400 hover:bg-red-50 hover:text-red-500 transition-all">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Pilih Tanggal</label>
                    <input type="date" x-model="bookingDate" min="{{ date('Y-m-d') }}"
                        class="w-full p-4 rounded-2xl border-2 border-slate-100 focus:border-orange-500 focus:ring-0 font-bold transition-all bg-slate-50">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-slate-400 mb-3">Pilih Jam Operasional</label>
                    <div class="grid grid-cols-2 gap-3">
                        <template x-for="time in timeSlots" :key="time">
                            <button @click="bookingTime=time"
                                :class="bookingTime===time?'bg-orange-600 text-white shadow-lg shadow-orange-200 border-orange-600':'bg-white border-slate-100 text-slate-600 hover:border-orange-200'"
                                class="p-4 rounded-2xl text-sm font-black border-2 transition-all transition-all" x-text="time"></button>
                        </template>
                    </div>
                </div>
            </div>

            <div class="p-8 bg-slate-50 flex gap-3">
                <button @click="step = 1" class="flex-1 py-4 font-bold text-slate-500 hover:text-slate-700 transition-colors">Batal</button>
                <button @click="submitBooking()" :disabled="loading || !bookingDate || !bookingTime"
                    class="flex-[2] py-4 bg-orange-600 text-white rounded-2xl font-black shadow-lg shadow-orange-200 disabled:opacity-50 flex items-center justify-center gap-2">
                    <span x-show="!loading">Konfirmasi Pesanan</span>
                    <i x-show="loading" class="fa-solid fa-circle-notch animate-spin"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- FLOATING BOTTOM BAR (THE MAGIC) --}}
    <div class="fixed bottom-6 left-1/2 -translate-x-1/2 w-[95%] max-w-5xl z-50 transition-all duration-500"
         :class="selectedItems.length > 0 ? 'translate-y-0 opacity-100' : 'translate-y-20 opacity-0 pointer-events-none'">

        <div class="floating-bar bg-slate-900 rounded-[32px] p-4 md:p-6 flex flex-col md:flex-row items-center justify-between gap-4 border border-white/10 backdrop-blur-md">
            <div class="flex items-center gap-4">
                <div class="hidden md:flex w-12 h-12 bg-orange-500 rounded-2xl items-center justify-center text-white shadow-lg">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <div>
                    <p class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none mb-1">Total Estimasi</p>
                    <h3 class="text-xl md:text-2xl font-black text-white" x-text="formatRupiah(totalPrice)"></h3>
                </div>
                <div class="h-8 w-px bg-white/10 mx-2 hidden md:block"></div>
                <div class="text-slate-300 text-xs font-bold">
                    <span class="text-orange-500" x-text="selectedItems.length"></span> Item Terpilih
                </div>
            </div>

            <div class="flex w-full md:w-auto gap-3">
                <button @click="clearSelection()" class="flex-1 md:flex-none px-6 py-3 text-slate-400 hover:text-white text-xs font-bold transition-colors">
                    Hapus Semua
                </button>
                <button @click="step = 2"
                    class="flex-[2] md:flex-none px-10 py-4 bg-orange-600 hover:bg-orange-500 text-white rounded-2xl font-black shadow-lg shadow-orange-900/20 transition-all flex items-center justify-center gap-2">
                    Lanjut Jadwal <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function bookingApp() {
    return {
        step: 1,
        filter: 'all',
        search: '',
        selectedItems: [],
        totalPrice: 0,
        bookingDate: '',
        bookingTime: '',
        loading: false,
        timeSlots: ['09:00','10:00','11:00','13:00','14:00','15:00','16:00'],

        init() {
            // Load from localStorage if needed
        },

        updateSelection(e) {
            const price = parseInt(e.target.dataset.price);
            if (e.target.checked) {
                this.selectedItems.push(e.target.value);
                this.totalPrice += price;
            } else {
                this.selectedItems = this.selectedItems.filter(i => i !== e.target.value);
                this.totalPrice -= price;
            }
        },

        clearSelection() {
            this.selectedItems = [];
            this.totalPrice = 0;
            // Uncheck all checkboxes
            document.querySelectorAll('input[type="checkbox"]').forEach(el => el.checked = false);
        },

        shouldShow(type, name) {
            const matchFilter = this.filter === 'all' || this.filter === type;
            const matchSearch = name.includes(this.search.toLowerCase());
            return matchFilter && matchSearch;
        },

        isEmpty() {
            // Logika sederhana untuk mengecek jika grid kosong setelah filter
            return document.querySelectorAll('label[style*="display: none"]').length >= {{ $allItems->count() }};
        },

        formatRupiah(n) {
            return new Intl.NumberFormat('id-ID',{style:'currency',currency:'IDR',minimumFractionDigits:0}).format(n);
        },

        async submitBooking() {
            if(!this.bookingDate || !this.bookingTime) return;
            this.loading = true;

            try {
                const response = await fetch("{{ route('booking.riwayat.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({
                        services: this.selectedItems.join(', '),
                        total_price: this.totalPrice,
                        date: this.bookingDate,
                        time: this.bookingTime,
                        status: 'pending'
                    })
                });

                if(response.ok) {
                    window.location.href = "{{ route('booking.riwayat') }}";
                }
            } catch (error) {
                alert("Terjadi kesalahan, silakan coba lagi.");
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endsection
