@extends('layouts.booking')

@section('title', 'Dashboard Booking - PT RIZQALLAH')
@section('header_title', 'Layanan Kami')
@section('header_subtitle', 'Silahkan pilih produk atau jasa')

@section('styles')
    <style>
        .check-container {
            position: absolute; top: 15px; right: 15px; width: 28px; height: 28px;
            border-radius: 50%; border: 2px solid #E2E8F0; background: white;
            display: flex; align-items: center; justify-content: center; z-index: 10;
        }
        input:checked + .card-body .check-container { background: #22C55E; border-color: #22C55E; }
        input:checked + .card-body .check-icon { display: block; color: white; }
        .product-image { transition: transform 0.5s ease; }
        .group:hover .product-image { transform: scale(1.1); }
    </style>
@endsection

@section('content')
    {{-- STEP 1: PILIH PRODUK --}}
    <div x-show="step === 1" x-transition>
        <div class="flex justify-between items-end mb-8">
            <div class="bg-slate-100 p-1 rounded-2xl flex">
                <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow-sm' : ''" class="px-6 py-2 text-xs font-bold rounded-xl transition-all">Semua</button>
                <button @click="filter = 'barang'" :class="filter === 'barang' ? 'bg-white shadow-sm' : ''" class="px-6 py-2 text-xs font-bold rounded-xl transition-all">Barang</button>
                <button @click="filter = 'jasa'" :class="filter === 'jasa' ? 'bg-white shadow-sm' : ''" class="px-6 py-2 text-xs font-bold rounded-xl transition-all">Jasa</button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products->merge($services) as $item)
            <label x-show="filter === 'all' || filter === '{{ $item->type }}'" class="relative cursor-pointer group">
                <input type="checkbox" class="hidden peer" value="{{ $item->name }}" data-price="{{ $item->price }}" @change="updateSelection($event)">
                <div class="card-body h-full bg-white border rounded-[32px] overflow-hidden shadow-sm transition-all peer-checked:border-orange-500 peer-checked:ring-4 peer-checked:ring-orange-50">
                    <div class="check-container"><i class="fa-solid fa-check hidden check-icon text-[10px]"></i></div>
                    <div class="h-44 overflow-hidden">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover product-image">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300 italic text-xs font-bold uppercase">No Image</div>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="text-[10px] font-bold text-orange-500 uppercase mb-1">{{ $item->type }}</div>
                        <h3 class="font-bold text-slate-900 mb-1">{{ $item->name }}</h3>
                        <p class="text-xs text-slate-400 mb-4">{{ Str::limit($item->description, 50) }}</p>
                        <div class="font-black text-slate-900">Rp{{ number_format($item->price, 0, ',', '.') }}</div>
                    </div>
                </div>
            </label>
            @endforeach
        </div>
    </div>

    {{-- STEP 2: PILIH JADWAL --}}
    <div x-show="step === 2" x-transition x-cloak>
        <div class="max-w-md mx-auto bg-white p-8 rounded-[32px] border shadow-sm">
            <h2 class="text-xl font-black mb-6">Detail Kunjungan</h2>
            <div class="space-y-6">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-2">Tanggal</label>
                    <input type="date" x-model="bookingDate" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold">
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-2">Waktu Slot</label>
                    <div class="grid grid-cols-2 gap-2">
                        <template x-for="time in timeSlots">
                            <button @click="bookingTime = time" :class="bookingTime === time ? 'bg-orange-600 text-white' : 'bg-slate-50 text-slate-600'" class="p-3 text-xs font-bold rounded-xl" x-text="time"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- BOTTOM BAR (ESTIMASI & BUTTON) --}}
    <div class="mt-12 bg-slate-900 rounded-[32px] p-8 flex flex-col md:flex-row items-center justify-between shadow-2xl">
        <div>
            <p class="text-slate-500 text-[10px] font-bold uppercase">Estimasi Total</p>
            <h3 class="text-2xl font-black text-white" x-text="formatRupiah(totalPrice)"></h3>
        </div>
        <div class="flex space-x-4 mt-6 md:mt-0">
            <button x-show="step === 2" @click="step = 1" class="px-8 py-4 text-white font-bold text-sm bg-white/10 rounded-2xl transition-all hover:bg-white/20">Kembali</button>
            <button x-show="step === 1" @click="step = 2" :disabled="selectedItems.length === 0" class="px-8 py-4 bg-orange-600 text-white font-bold text-sm rounded-2xl disabled:opacity-50 transition-all hover:bg-orange-700">Lanjut Jadwal</button>
            <button x-show="step === 2" @click="submitBooking()" :disabled="!bookingDate || !bookingTime || loading" class="px-8 py-4 bg-green-500 text-white font-bold text-sm rounded-2xl shadow-lg shadow-green-500/20 transition-all hover:bg-green-600">
                <span x-show="!loading">Kirim Pesanan ke Admin <i class="fa-solid fa-paper-plane ml-2"></i></span>
                <span x-show="loading">Mengirim...</span>
            </button>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function bookingApp() {
            return {
                step: 1, filter: 'all', sidebarOpen: true, selectedItems: [], totalPrice: 0,
                bookingDate: '', bookingTime: '', loading: false,
                timeSlots: ['09:00', '11:00', '14:00', '16:00'],

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
                formatRupiah(n) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(n); },
                async submitBooking() {
                    this.loading = true;
                    const data = {
                        services: this.selectedItems.join(', '),
                        total_price: this.totalPrice,
                        date: this.bookingDate,
                        time: this.bookingTime,
                        status: 'pending'
                    };
                    try {
                        const response = await fetch("{{ route('booking.riwayat.store') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify(data)
                        });
                        if (response.ok) {
                            const text = `Halo Admin, saya {{ auth()->user()->name }} telah membuat booking baru untuk ${data.services}. Mohon cek dashboard admin!`;
                            window.open(`https://wa.me/6289502669582?text=${encodeURIComponent(text)}`, '_blank');
                            window.location.href = "{{ route('booking.riwayat') }}";
                        }
                    } catch (e) { alert("Koneksi Error"); }
                    this.loading = false;
                }
            }
        }
    </script>
@endsection
