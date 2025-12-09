@extends('admin.layouts.app')
@section('title', 'Detail Produk')

@section('content')
<style>
  .product-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: transform 0.2s ease;
  }
  .product-card:hover {
      transform: translateY(-3px);
  }
  .product-image {
      width: 100%;
      border-radius: 16px;
      object-fit: cover;
      max-height: 350px;
  }
  .price-tag {
      font-size: 1.25rem;
      font-weight: 700;
      color: #4ED400;
  }
  .info-label {
      font-weight: 600;
      color: #555;
  }
  .back-btn {
      background: #f4f4f4;
      color: #333;
      border-radius: 10px;
      font-weight: 500;
  }
  .back-btn:hover {
      background: #e2e2e2;
  }
  .btn-dark {
      background: #1e1e1e;
      border: none;
  }
  .btn-dark:hover {
      background: #000;
  }
</style>

<div class="container-fluid py-4">
  <h3 class="fw-bold text-dark mb-4"><i class="bi bi-bag-heart me-2"></i>Detail Produk</h3>

  <div class="product-card p-4">
    <div class="row g-4 align-items-start">

      {{-- GAMBAR PRODUK --}}
      <div class="col-lg-5 col-md-6 text-center">
        @if($product->image)
          <img src="{{ asset('storage/'.$product->image) }}" class="product-image shadow-sm" alt="Gambar Produk">
        @else
          <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 350px;">
            <span class="text-muted">Tidak ada gambar</span>
          </div>
        @endif
      </div>

      {{-- INFORMASI PRODUK --}}
      <div class="col-lg-7 col-md-6">
        <h4 class="fw-bold text-dark mb-3">{{ $product->name }}</h4>

        <p class="text-secondary mb-3" style="font-size: 0.95rem;">
          {{ $product->description ?? 'Belum ada deskripsi untuk produk ini.' }}
        </p>

        <p class="info-label mb-1">Harga</p>
        <p class="price-tag mb-4">
          {{ $product->price ? 'Rp ' . number_format($product->price, 0, ',', '.') : '-' }}
        </p>

        <hr>

        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-dark btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
          </a>

          <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="bi bi-trash me-1"></i> Hapus
            </button>
          </form>

          <a href="{{ route('admin.products.index') }}" class="btn back-btn btn-sm ms-auto">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
