@extends('admin.layouts.app')
@section('title','Tambah Produk')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4 text-dark">Tambah Produk Baru</h4>

  {{-- Pesan error validasi --}}
  @if ($errors->any())
      <div class="alert alert-danger">
          <strong>Terjadi kesalahan!</strong>
          <ul class="mb-0">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  {{-- Form Tambah Produk --}}
  <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="row g-3">
          <div class="col-md-6">
              <label for="name" class="form-label">Nama Produk</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Contoh: Sabun Bayi" required>
          </div>

          <div class="col-md-6">
              <label for="price" class="form-label">Harga (Rp)</label>
              <input type="number" name="price" id="price" class="form-control" placeholder="Contoh: 25000" required>
          </div>

          <div class="col-12">
              <label for="description" class="form-label">Deskripsi</label>
              <textarea name="description" id="description" class="form-control" rows="3" placeholder="Tuliskan deskripsi produk..."></textarea>
          </div>

          <div class="col-md-6">
              <label for="image" class="form-label">Gambar Produk</label>
              <input type="file" name="image" id="image" class="form-control" accept="image/*">
              <small class="text-muted">Ukuran maks: 4MB</small>
          </div>
      </div>

      <div class="mt-4">
          <button type="submit" class="btn btn-dark">
              <i class="bi bi-save me-1"></i> Simpan Produk
          </button>
          <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
      </div>
  </form>
</div>

@endsection
