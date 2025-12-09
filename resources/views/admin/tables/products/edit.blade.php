@extends('admin.layouts.app')
@section('title','Edit Produk')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4">Edit Produk</h4>

  <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama Produk</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Harga</label>
        <input type="number" name="price" value="{{ $product->price }}" class="form-control">
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Gambar Produk</label><br>
        @if($product->image)
          <img src="{{ asset('storage/'.$product->image) }}" width="100" class="mb-2 rounded"><br>
        @endif
        <input type="file" name="image" class="form-control">
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-dark"><i class="bi bi-save me-1"></i> Update</button>
      <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>

@endsection
