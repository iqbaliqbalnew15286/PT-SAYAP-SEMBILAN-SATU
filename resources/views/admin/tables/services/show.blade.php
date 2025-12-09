@extends('admin.layouts.app')
@section('title', 'Detail Layanan')

@section('content')
<style>
  .service-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      transition: transform 0.2s ease;
  }
  .service-card:hover {
      transform: translateY(-3px);
  }
  .service-image {
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
  <h3 class="fw-bold text-dark mb-4"><i class="bi bi-activity me-2"></i>Detail Layanan</h3>

  <div class="service-card p-4">
    <div class="row g-4 align-items-start">

      {{-- GAMBAR LAYANAN --}}
      <div class="col-lg-5 col-md-6 text-center">
        @if($service->image)
          <img src="{{ asset('storage/'.$service->image) }}" class="service-image shadow-sm" alt="Gambar Layanan">
        @else
          <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 350px;">
            <span class="text-muted">Tidak ada gambar</span>
          </div>
        @endif
      </div>

      {{-- INFORMASI LAYANAN --}}
      <div class="col-lg-7 col-md-6">
        <h4 class="fw-bold text-dark mb-3">{{ $service->name }}</h4>

        <p class="text-secondary mb-3" style="font-size: 0.95rem;">
          {{ $service->description ?? 'Belum ada deskripsi untuk layanan ini.' }}
        </p>

        {{-- OPSIONAL: Harga jika layanan berbayar --}}
        @if(isset($service->price))
        <p class="info-label mb-1">Harga</p>
        <p class="price-tag mb-4">
          {{ $service->price ? 'Rp ' . number_format($service->price, 0, ',', '.') : '-' }}
        </p>
        @endif

        <hr>

        <div class="d-flex flex-wrap gap-2 mt-3">
          <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-dark btn-sm">
            <i class="bi bi-pencil me-1"></i> Edit
          </a>

          <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus layanan ini?')" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">
              <i class="bi bi-trash me-1"></i> Hapus
            </button>
          </form>

          <a href="{{ route('admin.services.index') }}" class="btn back-btn btn-sm ms-auto">
            <i class="bi bi-arrow-left-circle me-1"></i> Kembali
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
