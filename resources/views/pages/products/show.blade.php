@extends('layouts.app')

@section('title', $product->name ?? 'Detail Produk')

@push('styles')
<style>
:root {
    --black: #0f0f0f;
    --black-soft: #151515;
    --gold: #ffb400;
    --gold-soft: #ffda7b;
    --white: #fff;
    --gray: #bfbfbf;
}

body {
    background: var(--black);
    color: var(--white);
    font-family: 'Poppins', sans-serif;
}

/* Page background section */
.product-wrap {
    padding: 120px 0;
    background: radial-gradient(circle at top, #1c1c1c, #0b0b0b);
}

/* Breadcrumb */
.breadcrumb a {
    color: var(--gray) !important;
}
.breadcrumb .active {
    color: var(--gold) !important;
    font-weight: 600;
}

/* Product Card */
.product-box {
    background: var(--black-soft);
    border-radius: 16px;
    padding: 35px;
    border: 1px solid rgba(255,255,255,0.09);
    box-shadow: 0 8px 28px rgba(0,0,0,0.4);
}

/* Image */
.product-main-img {
    border-radius: 15px;
    transition: .4s ease;
}
.product-main-img:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 25px rgba(255,180,0,0.25);
}

/* Title */
.product-title {
    font-size: 2.4rem;
    font-weight: 800;
}

/* Rating */
.rating i {
    color: var(--gold);
}

/* Price */
.price-large {
    font-size: 2rem;
    font-weight: 800;
    color: var(--gold);
}

/* Buttons */
.btn-gold {
    background: var(--gold);
    color: #000;
    font-weight: 700;
    border-radius: 40px;
    padding: 14px 35px;
    transition: .25s;
    border: none;
}
.btn-gold:hover {
    background: var(--gold-soft);
    box-shadow: 0 0 18px rgba(255,180,0,0.5);
    transform: translateY(-3px);
}

.btn-outline-gold {
    border: 2px solid var(--gold);
    color: var(--gold);
    background: transparent;
    font-weight: 600;
    border-radius: 40px;
    padding: 14px 35px;
}
.btn-outline-gold:hover {
    background: var(--gold);
    color: #000;
    box-shadow: 0 0 20px rgba(255,180,0,0.4);
    transform: translateY(-3px);
}

/* Tabs */
.nav-tabs .nav-link {
    color: var(--gray);
    font-weight: 600;
    border: none;
}
.nav-tabs .nav-link.active {
    color: var(--gold);
    border-bottom: 2px solid var(--gold);
}

/* Sidebar */
.reco-card {
    background: var(--black-soft);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 12px;
    padding: 15px;
    transition: .3s ease;
}
.reco-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0 18px rgba(255,180,0,0.3);
    border-color: var(--gold);
}
.reco-card img {
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
}
.reco-title {
    font-size: .92rem;
    font-weight: 700;
}

/* Info list */
.list-group-item {
    background: transparent !important;
    border-color: rgba(255,255,255,0.07);
    color: var(--gray);
}
.list-group-item span {
    color: var(--white);
    font-weight: 600;
}
</style>
@endpush

@section('content')

<div class="product-wrap">
<div class="container">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products') }}">Produk</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- Left: Product --}}
        <div class="col-lg-9">
            <div class="product-box">

                <div class="row g-5">

                    <div class="col-lg-5 text-center">
                        <img src="{{ asset('storage/'.$product->image) }}" class="img-fluid product-main-img" alt="">
                    </div>

                    <div class="col-lg-7">

                        <h1 class="product-title mb-2">{{ $product->name }}</h1>

                        <div class="rating mb-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span class="text-muted small ms-2">(4.8)</span>
                        </div>

                        <div class="price-large mb-3">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        @if ($product->short_description)
                        <p class="text-light small mb-4">{{ $product->short_description }}</p>
                        @endif

                        <div class="d-flex gap-3 mt-4 flex-wrap">
                            <a href="https://wa.me/62?text=Halo%20saya%20ingin%20pesan%20{{ $product->name }}" target="_blank" class="btn btn-gold">
                                <i class="bi bi-whatsapp me-2"></i> Pesan WhatsApp
                            </a>

                            <a href="#" class="btn btn-outline-gold">
                                Shopee
                            </a>
                        </div>

                    </div>
                </div>

                <hr class="my-4" style="border-color: rgba(255,255,255,0.06)">

                {{-- Tabs --}}
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#desc">Deskripsi</button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#spec">Spesifikasi</button>
                    </li>
                </ul>

                <div class="tab-content">

                    {{-- Deskripsi --}}
                    <div class="tab-pane fade show active" id="desc">
                        <p class="text-light small">
                            {!! $product->description ?? 'Belum ada deskripsi.' !!}
                        </p>
                    </div>

                    {{-- Spesifikasi --}}
                    <div class="tab-pane fade" id="spec">
                        <ul class="list-group">
                            @php $specs = [
                                'Kategori' => $product->category ?? null,
                                'Brand' => $product->brand ?? null,
                                'Bahan' => $product->material ?? null,
                                'Dimensi' => $product->dimensions ?? null
                            ]; @endphp

                            @foreach($specs as $name => $val)
                                @if($val)
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>{{ $name }}</span><span>{{ $val }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>

                </div>

            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-3">
            <h5 class="fw-bold mb-3 text-gold">Rekomendasi</h5>

            <div class="d-grid gap-3">
                @foreach($recommended_products as $item)
                    <a href="{{ route('product.show', $item->id) }}" class="reco-card text-decoration-none">
                        <img src="{{ asset('storage/'.$item->image) }}" class="img-fluid mb-2">
                        <div class="reco-title">{{ $item->name }}</div>
                        <div class="text-gold small fw-bold">
                            Rp {{ number_format($item->price,0,',','.') }}
                        </div>
                    </a>
                @endforeach
            </div>

            <a href="{{ route('products') }}" class="btn btn-outline-gold w-100 mt-4">
                Lihat Semua Produk
            </a>
        </div>

    </div>
</div>
</div>

@endsection
