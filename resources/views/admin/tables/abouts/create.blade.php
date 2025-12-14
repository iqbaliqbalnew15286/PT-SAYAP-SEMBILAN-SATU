@extends('admin.layouts.app')
@section('title','Tambah Visi Misi Tujuan')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4">Tambah Data Visi, Misi & Tujuan</h4>

  <form action="{{ route('admin.abouts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row g-3">

      <div class="col-md-4">
        <label class="form-label fw-semibold">Visi</label>
        <textarea name="vision" class="form-control" rows="4" required></textarea>
      </div>

      <div class="col-md-4">
        <label class="form-label fw-semibold">Misi</label>
        <textarea name="mission" class="form-control" rows="4" required></textarea>
      </div>


      <div class="col-12">
        <label class="form-label fw-semibold">Gambar (Opsional)</label>
        <input type="file" name="image" class="form-control">
      </div>

    </div>

    <div class="mt-4 d-flex gap-2">
      <button type="submit" class="btn btn-dark px-4"><i class="bi bi-save me-1"></i> Simpan</button>
      <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary px-4">Kembali</a>
    </div>
  </form>
</div>

@endsection
