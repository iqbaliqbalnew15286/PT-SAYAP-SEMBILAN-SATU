@extends('admin.layouts.app')
@section('title', 'Edit Galeri')
@section('content')

<div class="container-fluid">
    <h4 class="fw-bold mb-4 text-dark">Edit Gambar Galeri</h4>

    <div class="card shadow border-0 p-4">
        <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="row g-3">

                {{-- 1. Tampilan Gambar Saat Ini --}}
                <div class="col-12 mb-3">
                    <label class="form-label fw-bold">Gambar Saat Ini</label>
                    <div class="border rounded p-3 d-inline-block bg-light">
                        @if($gallery->image)
                            <img src="{{ asset('storage/'.$gallery->image) }}" width="150" height="100" style="object-fit: cover;" class="rounded shadow-sm">
                        @else
                            <p class="text-muted mb-0">Tidak ada gambar terunggah.</p>
                        @endif
                    </div>
                </div>

                {{-- Kolom Judul Dihilangkan --}}
                {{-- Kolom Deskripsi Dihilangkan --}}

                {{-- 2. Input Gambar Baru --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Ganti Gambar (Upload Baru)</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Abaikan jika tidak ingin mengganti gambar.</small>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-dark"><i class="bi bi-save me-1"></i> Update Gambar</button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali ke Galeri</a>
            </div>
        </form>
    </div>
</div>

@endsection
