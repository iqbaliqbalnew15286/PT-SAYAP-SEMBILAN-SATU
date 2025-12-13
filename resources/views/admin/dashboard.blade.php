@extends('admin.layouts.app')

@section('title', 'Dashboard Admin - Bidan Fina')

@section('content')
    <div class="container-fluid">

        {{-- TOPBAR SELAMAT DATANG (KHUSUS DASHBOARD) --}}
        {{-- Menggunakan style dari .topbar yang ada di layout CSS --}}
        <div class="topbar">
            {{-- Header lebih ringkas dan profesional --}}
            <div class="welcome">
                <h3 style="color: var(--text-dark);">Selamat Datang, Admin!</h3>
                <small style="color: var(--text-muted);">Sistem Manajemen Tower.</small>
            </div>

            <div class="datebox d-none d-sm-flex align-items-center">
                <i class="bi bi-calendar-week me-2 text-neon"></i>
                <span style="color:var(--text-muted)">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
            </div>
        </div>

        {{-- Header & Tombol Export --}}
        <div class="d-sm-flex align-items-center justify-content-between mb-4 mt-4">
            {{-- Menggunakan warna teks gelap dari variabel CSS --}}
            <h1 class="h3 mb-0" style="color: var(--text-dark);">Ringkasan Statistik</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm primary-amber"
               style="font-weight:700; border-radius: 8px; color: var(--text-dark);">
                <i class="fas fa-file-export fa-sm me-2"></i> Export Laporan
            </a>
        </div>

        {{-- ROW STATISTIC CARDS --}}
        <div class="row">

            {{-- Produk Card (Aksen Amber) --}}
            <div class="col-xl-3 col-md-6 mb-4">
                {{-- Menggunakan card-tower dan aksen amber --}}
                <div class="card card-tower h-100 py-2" style="border-left: 4px solid var(--amber-accent);">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                {{-- Menggunakan warna aksen dan teks dark --}}
                                <div class="text-xs font-weight-bold text-uppercase mb-1 text-neon">
                                    Total Produk
                                </div>
                                <div class="h5 mb-0 font-weight-bold" style="color: var(--text-dark);">{{ $products }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box fa-2x text-neon" style="opacity: 0.35;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Layanan Card (Aksen Hijau) --}}
            <div class="col-xl-3 col-md-6 mb-4">
                {{-- Kita pertahankan warna Hijau (Success) sebagai variasi --}}
                <div class="card card-tower h-100 py-2" style="border-left: 4px solid #1cc88a;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#1cc88a;">
                                    Total Layanan
                                </div>
                                {{-- Menggunakan $items->count() sesuai kode Anda. Asumsi $items berisi daftar layanan. --}}
                                <div class="h5 mb-0 font-weight-bold" style="color: var(--text-dark);">{{ $items->count() }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-stethoscope fa-2x" style="color:#1cc88a; opacity: 0.35;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reservasi Card (Aksen Biru Muda) --}}
            <div class="col-xl-3 col-md-6 mb-4">
                {{-- Kita pertahankan warna Biru Muda (Info) sebagai variasi --}}
                <div class="card card-tower h-100 py-2" style="border-left: 4px solid #36b9cc;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#36b9cc;">
                                    Total Reservasi
                                </div>
                                <div class="h5 mb-0 font-weight-bold" style="color: var(--text-dark);">{{ $reservations }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar-check fa-2x" style="color:#36b9cc; opacity: 0.35;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Testimoni Card (Aksen Kuning) --}}
            <div class="col-xl-3 col-md-6 mb-4">
                {{-- Kita pertahankan warna Kuning (Warning) sebagai variasi --}}
                <div class="card card-tower h-100 py-2" style="border-left: 4px solid #f6c23e;">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1" style="color:#f6c23e;">
                                    Total Testimoni
                                </div>
                                <div class="h5 mb-0 font-weight-bold" style="color: var(--text-dark);">{{ $testimonials }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x" style="color:#f6c23e; opacity: 0.35;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END ROW STATISTIC CARDS --}}

        {{-- ROW LAYANAN TERBARU & AKSI CEPAT --}}
        <div class="row">
            {{-- Layanan Terbaru (Tabel) --}}
            <div class="col-xl-8 col-lg-7">
                <div class="card card-tower mb-4">
                    {{-- Card Header: Menggunakan card-header-tower dari layout --}}
                    <div class="card-header card-header-tower py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-neon">Layanan Terbaru</h6>
                        {{-- Tombol Lihat Semua, menggunakan border-subtle --}}
                        <a href="{{ route('admin.services.index') }}" class="btn btn-sm text-neon" style="border: 1px solid var(--border-subtle); border-radius: 6px; font-weight: 500;">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                    </div>
                    <div class="card-body">
                        @if ($items->count() > 0)
                            <div class="table-responsive">
                                {{-- Table Styling akan otomatis mengikuti CSS di layout --}}
                                <table class="table table-borderless table-hover" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            {{-- Warna header tabel disesuaikan --}}
                                            <th style="width: 50%; color: var(--text-muted);">Nama Layanan</th>
                                            <th style="width: 30%; color: var(--text-muted);">Harga</th>
                                            <th style="width: 20%; color: var(--text-muted);">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($items->take(5) as $service)
                                            <tr>
                                                <td><strong style="color: var(--text-dark);">{{ $service->name }}</strong></td>
                                                {{-- Badge Harga disesuaikan dengan skema warna hijau --}}
                                                <td><span class="badge" style="background-color: rgba(28, 200, 138, 0.15); color: #1cc88a; padding: 7px 10px; font-weight: 600;">Rp {{ number_format($service->price ?? 0, 0, ',', '.') }}</span></td>
                                                <td>
                                                    {{-- Tombol Detail menggunakan aksen Kuning Emas --}}
                                                    <a href="{{ route('admin.services.show', $service) }}"
                                                        class="btn btn-sm rounded-circle primary-amber" title="Detail" style="width: 30px; height: 30px; padding: 0; display: inline-flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-eye text-dark fa-sm"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-stethoscope fa-2x mb-3 text-neon"></i>
                                <p style="color: var(--text-muted); padding: 0 20px;">Belum ada layanan yang ditambahkan. Tambahkan layanan baru untuk melihat ringkasan di sini.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Aksi Cepat --}}
            <div class="col-xl-4 col-lg-5">
                <div class="card card-tower mb-4">
                    <div class="card-header card-header-tower py-3">
                        <h6 class="m-0 font-weight-bold text-neon">Aksi Cepat</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            {{-- Quick Action Buttons --}}
                            <a href="{{ route('admin.products.create') }}" class="btn btn-quick-action btn-lg btn-block text-left"
                               style="display: flex; align-items: center; justify-content: start; background:var(--bg-light-main); border-left: 4px solid var(--amber-accent); box-shadow: none; color: var(--text-dark); border-radius: 8px;">
                                <i class="fas fa-box fa-lg me-3 text-neon"></i>
                                <div class="ms-3" style="font-weight: 500;">Tambah Produk</div>
                            </a>

                            <a href="{{ route('admin.services.create') }}" class="btn btn-quick-action btn-lg btn-block text-left"
                               style="display: flex; align-items: center; justify-content: start; background:var(--bg-light-main); border-left: 4px solid #1cc88a; box-shadow: none; color: var(--text-dark); border-radius: 8px;">
                                <i class="fas fa-stethoscope fa-lg me-3" style="color:#1cc88a;"></i>
                                <div class="ms-3" style="font-weight: 500;">Tambah Layanan</div>
                            </a>

                            <a href="{{ route('admin.galleries.create') }}" class="btn btn-quick-action btn-lg btn-block text-left"
                               style="display: flex; align-items: center; justify-content: start; background:var(--bg-light-main); border-left: 4px solid #36b9cc; box-shadow: none; color: var(--text-dark); border-radius: 8px;">
                                <i class="fas fa-image fa-lg me-3" style="color:#36b9cc;"></i>
                                <div class="ms-3" style="font-weight: 500;">Tambah Galeri</div>
                            </a>

                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-quick-action btn-lg btn-block text-left"
                               style="display: flex; align-items: center; justify-content: start; background:var(--bg-light-main); border-left: 4px solid #f6c23e; box-shadow: none; color: var(--text-dark); border-radius: 8px;">
                                <i class="fas fa-star fa-lg me-3" style="color:#f6c23e;"></i>
                                <div class="ms-3" style="font-weight: 500;">Tambah Testimoni</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- END ROW LAYANAN TERBARU & AKSI CEPAT --}}
    </div>
@endsection
