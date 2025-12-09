@extends('admin.layouts.app')
@section('title', 'Tambah Testimoni')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4 text-dark">Tambah Testimoni Baru</h4>

  <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Nama</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="col-12">
        <label class="form-label">Pesan</label>
        <textarea name="message" class="form-control" rows="3" required></textarea>
      </div>

      <div class="col-md-6">
        <label class="form-label">Foto (Opsional)</label>
        <input type="file" name="photo" class="form-control" accept="image/*">
      </div>
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-dark">
        <i class="bi bi-save me-1"></i> Simpan
      </button>
      <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>

@endsection
