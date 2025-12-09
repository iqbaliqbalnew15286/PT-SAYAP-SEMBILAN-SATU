@extends('admin.layouts.app')
@section('title', 'Edit Layanan')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4 text-dark">Edit Layanan</h4>

  <form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama Layanan</label>
        <input type="text" name="name" value="{{ $service->name }}" class="form-control" required>
      </div>
      <div class="col-md-6">
        <label class="form-label">Harga (Opsional)</label>
        <input type="number" name="price" value="{{ $service->price }}" class="form-control">
      </div>
      <div class="col-12">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3">{{ $service->description }}</textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">Gambar Layanan</label><br>
        @if($service->image)
          <img src="{{ asset('storage/'.$service->image) }}" width="100" class="rounded mb-2"><br>
        @endif
        <input type="file" name="image" class="form-control">
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-dark"><i class="bi bi-save me-1"></i> Update</button>
      <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>

@endsection
