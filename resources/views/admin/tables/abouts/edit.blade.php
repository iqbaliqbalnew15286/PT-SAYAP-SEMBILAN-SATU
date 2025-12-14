@extends('admin.layouts.app')
@section('title','Edit Visi, Misi & Tujuan')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4">Edit Visi, Misi & Tujuan</h4>

  <form action="{{ route('admin.abouts.update', $about->id) }}" method="POST">
    @csrf @method('PUT')

    <div class="row g-4">

      <div class="col-md-4">
        <label class="form-label fw-semibold">Visi</label>
        <textarea name="vision" class="form-control" rows="5" required>{{ $about->vision }}</textarea>
      </div>

      <div class="col-md-4">
        <label class="form-label fw-semibold">Misi</label>
        <textarea name="mission" class="form-control" rows="5" required>{{ $about->mission }}</textarea>
      </div>

    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-dark">
        <i class="bi bi-save me-1"></i> Update
      </button>
      <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>

@endsection
