@extends('layouts.booking')

@section('title', 'Dashboard Booking - PT RIZQALLAH')
@section('header_title', 'Layanan Kami')
@section('header_subtitle', 'Silahkan pilih produk atau jasa')

@section('styles')
    <style>
        [x-cloak] { display: none !important; }
        .check-container {
            position: absolute; top: 15px; right: 15px; width: 28px; height: 28px;
            border-radius: 50%; border: 2px solid #E2E8F0; background: white;
            display: flex; align-items: center; justify-content: center; z-index: 10;
            transition: all 0.3s ease;
        }
        /* Logika Checkbox Peer */
        input:checked + .card-content .check-container {
            background: #22C55E;
            border-color: #22C55E;
        }
        input:checked + .card-content .check-icon {
            display: block !important;
            color: white;
        }
        .product-image { transition: transform 0.5s ease; }
        .group:hover .product-image { transform: scale(1.1); }
    </style>
@endsection

@section('content')
<div x-data="bookingApp()" x-cloak>
    {{-- STEP 1: PILIH PRODUK --}}
    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4">
        <div class="flex justify-between items-center mb-8">
            <div class="bg-slate-100 p-1 rounded-2xl flex">
                <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-white shadow-sm text-orange-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-bold rounded-xl transition-all">Semua</button>
                <button @click="filter = 'barang'" :class="filter === 'barang' ? 'bg-white shadow-sm text-orange-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-bold rounded-xl transition-all">Barang</button>
                <button @click="filter = 'jasa'" :class="filter === 'jasa' ? 'bg-white shadow-sm text-orange-600' : 'text-slate-500'" class="px-6 py-2 text-xs font-bold rounded-xl transition-all">Jasa</button>
            </div>
            <div class="text-right">
                <span class="text-xs font-bold text-slate-400 uppercase">Item Terpilih: </span>
                <span class="text-sm font-black text-orange-600" x-text="selectedItems.length"></span>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                // Menggabungkan collection jika variabel dipisah dari controller
                $allItems = collect($products)->merge($services);
            @endphp

            @foreach ($allItems as $item)
            <label x-show="filter === 'all' || filter === '{{ $item->type }}'"
                   class="relative cursor-pointer group block h-full">
                <input type="checkbox"
                       class="hidden peer"
                       value="{{ $item->name }}"
                       data-price="{{ $item->price }}"
                       @change="updateSelection($event)"
                       :checked="selectedItems.includes('{{ $item->name }}')">

                <div class="card-content h-full bg-white border rounded-[32px] overflow-hidden shadow-sm transition-all peer-checked:border-orange-500 peer-checked:ring-4 peer-checked:ring-orange-50">
                    <div class="check-container">
                        <i class="fa-solid fa-check hidden check-icon text-[10px]"></i>
                    </div>

                    <div class="h-44 overflow-hidden bg-slate-50">
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover product-image" alt="{{ $item->name }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-slate-300 italic text-xs font-bold uppercase">No Image</div>
                        @endif
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-1">
                            <div class="text-[10px] font-bold text-orange-500 uppercase">{{ $item->type }}</div>
                        </div>
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
    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-[32px] border shadow-sm">
            <h2 class="text-xl font-black mb-6 text-center text-slate-900">Detail Kunjungan</h2>
            <div class="space-y-6">
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-2 tracking-widest">Pilih Tanggal</label>
                    <input type="date" x-model="bookingDate" min="{{ date('Y-m-d') }}"
                           class="w-full bg-slate-50 border-2 border-slate-100 focus:border-orange-500 focus:ring-0 rounded-2xl p-4 font-bold transition-all">
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-slate-400 block mb-2 tracking-widest">Pilih Waktu Slot</label>
                    <div class="grid grid-cols-2 gap-3">
                        <template x-for="time in timeSlots" :key="time">
                            <button @click="bookingTime = time"
                                    :class="bookingTime === time ? 'bg-orange-600 text-white shadow-lg shadow-orange-200 ring-2 ring-orange-500' : 'bg-slate-50 text-slate-600 hover:bg-slate-100'"
                                    class="p-4 text-xs font-bold rounded-2xl transition-all"
                                    x-text="time"></button>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        {{-- RINGKASAN PESANAN --}}
        <div class="max-w-md mx-auto mt-6 p-6 bg-orange-50 rounded-3xl border border-orange-100">
            <h4 class="text-[10px] font-black uppercase text-orange-400 mb-3 tracking-widest">Ringkasan Pesanan</h4>
            <div class="space-y-2">
                <template x-for="item in selectedItems" :key="item">
                    <div class="flex justify-between">
                        <span class="text-xs font-bold text-slate-700" x-text="item"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    {{-- BOTTOM BAR (ESTIMASI & BUTTON) --}}
    <div class="mt-12 bg-slate-900 rounded-[40px] p-8 flex flex-col md:flex-row items-center justify-between shadow-2xl relative z-20">
        <div class="text-center md:text-left">
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">Estimasi Total Pembayaran</p>
            <h3 class="text-3xl font-black text-white" x-text="formatRupiah(totalPrice)"></h3>
        </div>

        <div class="flex flex-wrap justify-center gap-4 mt-6 md:mt-0">
            <button x-show="step === 2" @click="step = 1"
                    class="px-8 py-4 text-white font-bold text-sm bg-white/10 rounded-2xl transition-all hover:bg-white/20 border border-white/10">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
            </button>

            <button x-show="step === 1" @click="step = 2"
                    :disabled="selectedItems.length === 0"
                    class="px-10 py-4 bg-orange-600 text-white font-bold text-sm rounded-2xl disabled:opacity-50 disabled:cursor-not-allowed transition-all hover:bg-orange-700 shadow-xl shadow-orange-900/20">
                Lanjut Pilih Jadwal <i class="fa-solid fa-calendar-days ml-2"></i>
            </button>

            <button x-show="step === 2" @click="submitBooking()"
                    :disabled="!bookingDate || !bookingTime || loading"
                    class="px-10 py-4 bg-green-500 text-white font-bold text-sm rounded-2xl shadow-xl shadow-green-900/20 transition-all hover:bg-green-600 disabled:opacity-50 disabled:cursor-not-allowed">
                <template x-if="!loading">
                    <span>Konfirmasi Booking <i class="fa-solid fa-paper-plane ml-2"></i></span>
                </template>
                <template x-if="loading">
                    <span class="flex items-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </template>
            </button>
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
                selectedItems: [],
                totalPrice: 0,
                bookingDate: '',
                bookingTime: '',
                loading: false,
                timeSlots: ['09:00', '11:00', '14:00', '16:00'],

                updateSelection(e) {
                    const itemName = e.target.value;
                    const price = parseInt(e.target.dataset.price);

                    if (e.target.checked) {
                        if (!this.selectedItems.includes(itemName)) {
                            this.selectedItems.push(itemName);
                            this.totalPrice += price;
                        }
                    } else {
                        this.selectedItems = this.selectedItems.filter(i => i !== itemName);
                        this.totalPrice -= price;
                    }
                },

                formatRupiah(n) {
                    return new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    }).format(n);
                },

                async submitBooking() {
                    if (this.loading) return;

                    this.loading = true;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

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
                                "Accept": "application/json",
                                "X-CSRF-TOKEN": csrfToken
                            },
                            body: JSON.stringify(data)
                        });

                        const result = await response.json();

                        if (response.ok) {
                            // Format pesan WhatsApp yang lebih profesional
                            const waText = `*BOOKING BARU - PT RIZQALLAH*\n\n` +
                                           `*Nama:* {{ auth()->user()->name }}\n` +
                                           `*Layanan:* ${data.services}\n` +
                                           `*Tanggal:* ${data.date}\n` +
                                           `*Jam:* ${data.time}\n` +
                                           `*Total Estimasi:* ${this.formatRupiah(data.total_price)}\n\n` +
                                           `Mohon segera dikonfirmasi. Terima kasih.`;

                            window.open(`https://wa.me/6289502669582?text=${encodeURIComponent(waText)}`, '_blank');

                            // Redirect ke halaman riwayat
                            window.location.href = "{{ route('booking.riwayat') }}";
                        } else {
                            alert("Gagal menyimpan booking: " + (result.message || "Terjadi kesalahan"));
                        }
                    } catch (e) {
                        console.error(e);
                        alert("Terjadi kesalahan koneksi atau server error.");
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
@endsection
