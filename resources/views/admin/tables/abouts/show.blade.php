@extends('admin.layouts.app')
@section('title','Detail Visi, Misi & Tujuan')

@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4">Detail Visi, Misi & Tujuan</h4>

  <div class="card shadow-sm">
    <div class="card-body">

      <div class="row g-4">

        <div class="col-md-4">
          <h6 class="fw-bold">Visi</h6>
          <p class="text-muted">{{ $about->vision ?? '-' }}</p>
        </div>

        <div class="col-md-4">
          <h6 class="fw-bold">Misi</h6>
          <p class="text-muted">{{ $about->mission ?? '-' }}</p>
        </div>


      </div>

      <div class="mt-4 d-flex gap-2">
        <a href="{{ route('admin.abouts.edit',$about->id) }}" class="btn btn-warning btn-sm">
          <i class="bi bi-pencil"></i> Edit
        </a>

        <form action="{{ route('admin.abouts.destroy',$about->id) }}" method="POST"
              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
          @csrf @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="bi bi-trash"></i> Hapus
          </button>
        </form>

        <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary btn-sm ms-auto">
          Kembali
        </a>
      </div>

    </div>
  </div>
</div>

@endsection
