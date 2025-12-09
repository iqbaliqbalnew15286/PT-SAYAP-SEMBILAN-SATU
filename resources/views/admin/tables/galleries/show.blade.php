@extends('admin.layouts.app')
@section('title','Detail - Galeri')

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-bold mb-4 text-dark">Detail Gambar Galeri</h4>

    <div class="card shadow border-0 p-4">
        <div class="card-body">
            <div class="row g-4">

                {{-- 1. Area Tampilan Gambar --}}
                <div class="col-12 col-lg-8 offset-lg-2 text-center">
                    <h5 class="fw-semibold mb-3 text-muted">Pratinjau Gambar</h5>

                    @if($gallery->image)
                        {{-- Tampilkan gambar utama dengan ukuran yang lebih besar --}}
                        <img src="{{ asset('storage/'.$gallery->image) }}"
                             class="img-fluid rounded shadow-lg border p-1"
                             alt="Gambar Galeri"
                             style="max-height: 500px; object-fit: contain;">
                    @else
                        <div class="bg-light p-5 rounded text-center text-muted border">
                            <i class="bi bi-x-circle fs-3"></i>
                            <p class="mb-0 mt-2">Tidak ada gambar terunggah.</p>
                        </div>
                    @endif
                </div>

                {{-- Kolom Judul dan Deskripsi Dihilangkan --}}

            </div>

            <hr class="mt-4 mb-3">

            {{-- Area Aksi (Tetap dipertahankan) --}}
            <div class="d-flex gap-2 justify-content-center mt-3">
                <a href="{{ route('admin.galleries.edit',$gallery->id) }}" class="btn btn-warning btn-md">
                    <i class="bi bi-pencil"></i> Edit Gambar
                </a>

                <form action="{{ route('admin.galleries.destroy',$gallery->id) }}" method="POST" onsubmit="return confirm('Hapus gambar ini secara permanen?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-md">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>

                <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary btn-md">
                    <i class="bi bi-arrow-left"></i> Kembali ke Galeri
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
