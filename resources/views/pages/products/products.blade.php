@extends('layouts.app')

@section('title', 'Katalog Produk & Solusi - Tower Management')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* -------------------------------------
        COLOR THEME: MODERN LIGHT MODE (WHITE & AMBER)
    ---------------------------------------*/
    :root {
        --accent: #FFC300;
        /* Kuning Emas */
        --accent-dark: #FFAA00;
        /* Kuning Lebih Gelap */
        --bg-light: #F8F9FB;
        /* Latar Belakang Utama */
        --bg-card: #FFFFFF;
        /* Latar Belakang Card */
        --text-dark: #2C3E50;
        /* Teks Utama (Dark Accent) */
        --text-muted: #7F8C8D;
        /* Teks Sekunder */
        --border-subtle: #E9ECEF;
        /* Border tipis */
        --shadow-subtle: 0 6px 20px rgba(0, 0, 0, 0.08);
        /* Shadow yang lebih halus */
    }

    body {
        background: var(--bg-light);
        color: var(--text-dark);
        font-family: 'Poppins', sans-serif;
    }

    /* HERO SECTION (PREMIUM LOOK) */
    .hero-products {
        padding: 140px 0 80px;
        background: var(--bg-card); /* Putih bersih */
        text-align: center;
        border-bottom: 5px solid var(--accent);
    }

    .hero-products .tagline {
        color: var(--accent);
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 3px;
        text-transform: uppercase;
        display: block;
    }

    .hero-products h1 {
        font-weight: 800;
        font-size: 3.5rem;
        color: var(--text-dark);
        margin-top: 10px;
        margin-bottom: 20px;
    }

    .hero-products p {
        color: var(--text-muted);
        max-width: 700px;
        margin: 0 auto;
        font-size: 1.1rem;
    }

    /* PRODUCT GRID SECTION */
    .product-section {
        padding: 80px 0 100px;
        background: var(--bg-light);
    }

    .section-header {
        margin-bottom: 50px;
        text-align: center;
    }
    .section-header h2 {
        font-weight: 800;
        color: var(--text-dark);
    }
    .section-header p {
        color: var(--text-muted);
        max-width: 600px;
        margin: 0 auto;
    }


    /* PRODUCT CARD (ELEGANT MINIMALIST) */
    .product-card {
        background: var(--bg-card);
        border-radius: 12px;
        border: 1px solid var(--border-subtle);
        overflow: hidden;
        transition: transform .35s ease, box-shadow .35s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        display: flex;
        flex-direction: column;
        height: 100%; /* Penting untuk grid yang rata */
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .product-card img {
        height: 250px;
        object-fit: cover;
        width: 100%;
        transition: .4s ease-in-out;
    }

    .product-card:hover img {
        transform: scale(1.05);
    }

    .product-info {
        padding: 25px;
        flex-grow: 1; /* Agar info mengisi ruang sisa */
        display: flex;
        flex-direction: column;
    }

    .product-info h5 {
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--text-dark);
        margin-bottom: 8px;
    }

    .product-info .product-meta {
        font-size: 0.85rem;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .product-info .product-meta i {
        font-size: 1rem;
        margin-right: 6px;
        color: var(--accent);
    }

    .product-info p {
        color: var(--text-muted);
        font-size: .9rem;
        /* Hapus min-height/height agar tidak membatasi deskripsi */
        overflow: hidden;
        margin-top: 5px;
        margin-bottom: 15px;
    }

    .price-box {
        margin-top: auto; /* Push ke bawah */
        padding-top: 15px;
        border-top: 1px dashed var(--border-subtle);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--accent);
        line-height: 1.1;
    }

    .price small {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--text-muted);
        display: block;
    }

    /* CTA Button (Primary Style, Amber) */
    .btn-detail {
        background: var(--accent);
        color: var(--text-dark);
        font-weight: 600;
        border-radius: 8px;
        padding: 10px 15px;
        border: 1px solid var(--accent);
        transition: .3s;
    }

    .btn-detail:hover {
        background: var(--accent-dark);
        color: var(--text-dark);
        border-color: var(--accent-dark);
        box-shadow: 0 4px 10px rgba(255, 195, 0, 0.3);
    }

    /* LOAD MORE (New Style: Button Outline) */
    .load-more-btn {
        border: 2px solid var(--accent);
        color: var(--text-dark);
        background: var(--bg-card);
        padding: 12px 45px;
        border-radius: 8px;
        font-weight: 700;
        transition: .3s ease;
    }

    .load-more-btn:hover {
        background: var(--accent);
        color: var(--text-dark);
        box-shadow: 0 0 20px rgba(255, 195, 0, 0.35);
        transform: translateY(-3px);
    }

    @media(max-width: 768px) {
        .hero-products h1 {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@section('content')

{{-- HERO SECTION --}}
<section class="hero-products" data-aos="fade-down">
    <div class="container">
        <span class="tagline">TEKNOLOGI & INFRASTRUKTUR</span>
        <h1>Solusi Rekayasa Presisi</h1>
        <p>Tower Management menyediakan produk engineering dan manufaktur berstandar tinggi yang disesuaikan untuk memenuhi kebutuhan spesifik industri dan korporasi Anda.</p>
    </div>
</section>

{{-- PRODUCT GRID SECTION --}}
<section class="product-section">
    <div class="container">

        {{-- Section Header (Ganti Filter Bar) --}}
        <div class="section-header" data-aos="fade-up">
            <h2 class="h3">Katalog Produk Unggulan</h2>
            <p class="text-muted">Jelajahi berbagai produk dan solusi teknis kami. Temukan inovasi yang Anda butuhkan.</p>
        </div>

        <div class="row g-4">
            @forelse ($items as $product)
            {{-- Asumsi $product memiliki 'id', 'slug', 'image', 'name', 'description', 'price', dan 'category' --}}
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="product-card">

                    <a href="{{ route('product.show', $product->slug ?? $product->id) }}">
                        {{-- Gunakan Div untuk Image Wrapper agar efek zoom lebih mulus --}}
                        <div style="overflow: hidden;">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </div>
                    </a>

                    <div class="product-info">
                        <div class="product-meta">
                            {{-- Ikon kategori disesuaikan berdasarkan data --}}
                            <i class="{{ $product->category == 'Engineering' ? 'bi bi-lightning-charge-fill' : ($product->category == 'Konstruksi' ? 'bi bi-hammer' : 'bi bi-tag-fill') }}"></i>
                            {{ $product->category ?? 'Manufaktur' }}
                        </div>

                        <h5>{{ $product->name }}</h5>

                        <p>{{ Str::limit($product->description ?? 'Solusi rekayasa dan produk B2B dengan standar kualitas internasional.', 80) }}</p>

                        <div class="price-box">
                            <div class="price">
                                <small>Mulai dari</small>
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>

                            <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="btn btn-detail btn-sm">
                                Detail <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-box-seam-fill fs-1 mb-3" style="color: var(--accent);"></i>
                <h5 class="text-dark">Katalog Sedang Diperbarui</h5>
                <p class="text-muted">Silakan hubungi tim sales kami untuk informasi produk terbaru.</p>
            </div>
            @endforelse
        </div>

        {{-- Tombol Load More hanya jika jumlah item lebih dari 8 --}}
        @if(count($items) > 8)
        <div class="text-center mt-5 pt-3">
            <button class="load-more-btn">Muat Lebih Banyak</button>
        </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script>
    // Tambahkan logika untuk Load More di sini jika Anda ingin mengimplementasikannya
    // Contoh:
    document.addEventListener('DOMContentLoaded', function () {
        const loadMoreBtn = document.querySelector('.load-more-btn');
        if (loadMoreBtn) {
            loadMoreBtn.addEventListener('click', function() {
                alert('Fungsi memuat lebih banyak akan dimuat menggunakan AJAX.');
                // Di sini Anda akan menambahkan logika AJAX untuk mengambil data produk berikutnya
            });
        }
    });
</script>
@endpush
