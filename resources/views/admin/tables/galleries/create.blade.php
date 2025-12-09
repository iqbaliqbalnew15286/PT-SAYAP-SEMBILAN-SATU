@extends('admin.layouts.app')
@section('title', 'Tambah Gambar - Galeri')
@section('content')

<div class="container-fluid">
    <h4 class="fw-bold mb-4 text-dark">Tambah Gambar ke Galeri</h4>

    <div class="card shadow border-0 p-4">
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                {{-- Kolom Judul Dihilangkan --}}
                {{-- Kolom Deskripsi Dihilangkan --}}

                {{-- Kolom Upload Gambar menjadi fokus utama --}}
                <div class="col-md-6">
                    <label class="form-label fw-bold">Upload Gambar</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Hanya file gambar yang diizinkan.</small>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-dark"><i class="bi bi-save me-1"></i> Simpan Gambar</button>
                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">Kembali ke Galeri</a>
            </div>
        </form>
    </div>
</div>

@endsection
