@extends('layouts.app')

@section('title', 'Produk Premium - Bidan Feni')

@section('content')

<style>
    :root {
        --black: #0f0f0f;
        --black-soft: #151515;
        --gold: #ffb400;
        --gold-soft: #ffda7b;
        --white: #ffffff;
        --gray: #bfbfbf;
    }

    body {
        background: var(--black);
        color: var(--white);
        font-family: 'Poppins', sans-serif;
    }

    /* HERO SECTION */
    .hero-products {
        padding: 140px 0 120px;
        background: linear-gradient(180deg, #0a0a0a 0%, #1a1a1a 100%);
        text-align: center;
    }

    .hero-products .tagline {
        color: var(--gold);
        font-weight: 600;
        font-size: .9rem;
        letter-spacing: 2px;
    }

    .hero-products h1 {
        font-weight: 800;
        font-size: 3rem;
        color: #fff;
    }

    .hero-products p {
        color: var(--gray);
        max-width: 700px;
        margin: 0 auto;
    }

    .gold-line {
        width: 80px;
        height: 4px;
        background: var(--gold);
        margin: 18px auto 35px;
        border-radius: 20px;
    }

    /* PRODUCT SECTION */
    .product-section {
        padding: 80px 0;
        background: var(--black);
    }

    .product-card {
        background: var(--black-soft);
        border-radius: 18px;
        border: 1px solid rgba(255,255,255,0.12);
        overflow: hidden;
        transition: .35s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.45);
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 38px rgba(255,180,0,0.18);
        border-color: var(--gold);
    }

    .product-card img {
        height: 260px;
        object-fit: cover;
        width: 100%;
        transition: .4s ease-in-out;
    }

    .product-card:hover img {
        transform: scale(1.06);
    }

    .product-info {
        padding: 22px;
    }

    .product-info h5 {
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--white);
        margin-bottom: 6px;
    }

    .product-info p {
        color: #c8c8c8;
        font-size: .92rem;
        min-height: 38px;
        height: 38px;
        overflow: hidden;
    }

    .price {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gold);
        margin-bottom: 12px;
    }

    .btn-gold {
        background: var(--gold);
        color: #000;
        font-weight: 600;
        border-radius: 35px;
        padding: 11px;
        width: 100%;
        transition: .3s;
        border: none;
    }

    .btn-gold:hover {
        background: var(--gold-soft);
        box-shadow: 0 0 20px rgba(255,180,0,0.4);
        transform: translateY(-3px);
    }

    /* FILTER BAR */
    .filter-bar h4 {
        font-weight: 700;
        color: var(--white);
    }

    .btn-filter {
        border: 1px solid var(--gold);
        color: var(--gold);
        font-weight: 600;
        border-radius: 25px;
        transition: .3s;
        background: transparent;
    }

    .btn-filter:hover {
        background: var(--gold);
        color: #000;
        box-shadow: 0 0 15px rgba(255,180,0,0.4);
    }

    /* LOAD MORE */
    .load-more-btn {
        border: 2px solid var(--gold);
        color: var(--gold);
        background: transparent;
        padding: 12px 45px;
        border-radius: 30px;
        font-weight: 600;
        transition: .3s ease;
    }

    .load-more-btn:hover {
        background: var(--gold);
        color: #000;
        box-shadow: 0 0 20px rgba(255,180,0,0.35);
        transform: translateY(-3px);
    }

    @media(max-width: 768px){
        .hero-products h1 {font-size: 2.25rem;}
    }
</style>

{{-- HERO --}}
<section class="hero-products">
    <div class="container">
        <p class="tagline">KOLEKSI PREMIUM</p>
        <h1>Produk Perawatan Terbaik</h1>
        <div class="gold-line"></div>
        <p>Produk pilihan yang cocok untuk ibu & bayi dengan kualitas terjamin, aman, dan terpercaya.</p>
    </div>
</section>

{{-- PRODUCT GRID --}}
<section class="product-section">
    <div class="container">

        {{-- Filter --}}
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3" style="border-bottom: 1px solid rgba(255,255,255,0.1)">
            <h4>Semua Produk ({{ count($items) }})</h4>
            <button class="btn btn-filter btn-sm px-3">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>

        <div class="row g-4">
            @forelse ($items as $product)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="product-card">
                        <a href="{{ route('product.show', $product->slug ?? $product->id) }}">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                        </a>

                        <div class="product-info">
                            <h5>{{ $product->name }}</h5>
                            <p>{{ Str::limit($product->description ?? 'Deskripsi belum tersedia', 60) }}</p>
                            <div class="price">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('product.show', $product->slug ?? $product->id) }}" class="btn-gold">
                                Detail Produk <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-light">
                    <i class="bi bi-box fs-1 mb-3 text-light"></i>
                    <h5>Tidak ada produk tersedia</h5>
                </div>
            @endforelse
        </div>

        @if(count($items) > 8)
        <div class="text-center mt-5">
            <button class="load-more-btn">Muat Lebih Banyak</button>
        </div>
        @endif
    </div>
</section>

@endsection
