@extends('layouts.app')

@section('title', 'Testimonials - PT. RBM')

@section('content')
    {{-- Breadcrumb Biru Gelap (Konsisten dengan halaman About) --}}
    <div class="bg-[#1e3a8a] py-4">
        <div class="max-w-7xl mx-auto px-6">
            <nav class="flex text-sm font-bold uppercase tracking-widest text-gray-300 items-center">
                <a href="/" class="hover:text-white transition-colors">Home</a>
                <span class="mx-3 text-orange-500">/</span>
                <span class="text-white">Testimonials</span>
            </nav>
        </div>
    </div>

    <div class="container mx-auto px-4 md:px-8 py-12">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 md:px-8 py-6 border-b bg-white">
                <div>
                    <h4 class="text-2xl font-bold text-blue-900 uppercase tracking-tight">Client Testimonials</h4>
                    <p class="text-sm text-gray-500 mt-1 italic">Apa kata mereka tentang layanan infrastruktur PT. RBM</p>
                </div>
                <div class="hidden md:flex w-12 h-12 rounded-full bg-orange-100 items-center justify-center">
                    <i class="fas fa-quote-right text-orange-600 text-xl"></i>
                </div>
            </div>

            {{-- Testimonials Grid --}}
            <div class="px-6 md:px-8 py-10 bg-gray-50/50">
                {{-- Logika: Hanya menampilkan testimonial yang statusnya sudah disetujui (misal: is_published) --}}
                @if ($testimonials->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($testimonials as $testimonial)
                            <div
                                class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                                <div class="flex items-start gap-4">
                                    {{-- Foto Profile --}}
                                    @if ($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                                            alt="Foto {{ $testimonial->name }}"
                                            class="w-14 h-14 rounded-full object-cover flex-shrink-0 border-2 border-orange-500">
                                    @else
                                        <div
                                            class="w-14 h-14 rounded-full bg-blue-900 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif

                                    <div class="flex-1">
                                        <div class="mb-2">
                                            <h5 class="font-bold text-blue-900">{{ $testimonial->name }}</h5>
                                            @if ($testimonial->company)
                                                <p class="text-xs font-semibold text-orange-600 uppercase tracking-wider">
                                                    {{ $testimonial->company }}</p>
                                            @endif
                                        </div>

                                        {{-- Icon Bintang (Opsional) --}}
                                        <div class="flex text-orange-400 text-[10px] mb-3">
                                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                class="fas fa-star"></i><i class="fas fa-star"></i><i
                                                class="fas fa-star"></i>
                                        </div>

                                        <p class="text-gray-600 text-sm leading-relaxed italic">"{!! nl2br(e($testimonial->message)) !!}"
                                        </p>

                                        <div
                                            class="mt-4 pt-4 border-t border-gray-50 text-[10px] text-gray-400 font-medium">
                                            Diterima pada: {{ $testimonial->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    {{-- State Kosong / Belum Disetujui --}}
                    <div class="text-center py-20">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-comment-slash text-3xl text-gray-300"></i>
                        </div>
                        <h5 class="text-lg font-bold text-blue-900 mb-2 uppercase">Belum ada testimonial publik</h5>
                        <p class="text-gray-400 max-w-xs mx-auto text-sm">Testimonial yang masuk sedang dalam tahap moderasi
                            oleh admin sebelum ditampilkan di sini.</p>
                    </div>
                @endif
            </div>

            {{-- Footer dengan Link Kirim Testimonial --}}
            <div class="px-6 md:px-8 py-8 bg-white border-t text-center">
                <p class="text-sm text-gray-500 mb-6">Punya pengalaman bekerja sama dengan kami?</p>

                {{-- Pastikan nama route 'testimonials.create' atau 'send.testimonial' sudah ada di web.php --}}
                <a href="{{ route('send.testimonial') }}"
                    class="inline-flex items-center gap-3 px-8 py-3 bg-orange-600 text-white rounded-full font-bold uppercase text-xs tracking-widest hover:bg-blue-900 transition-all duration-300 shadow-lg shadow-orange-600/20">
                    <i class="fas fa-paper-plane"></i>
                    Kirim Testimonial Anda
                </a>
            </div>
        </div>
    </div>
@endsection
