@extends('admin.layouts.app')
@section('title', 'Galeri - Admin')
@section('content')

<div class="container-fluid">
    {{-- Heading --}}
    <h4 class="fw-bold mb-4 text-dark">🖼️ Galeri Foto</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol Tambah --}}
    <div class="text-end mb-3">
        <a href="{{ route('admin.galleries.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg"></i> Tambah Gambar
        </a>
    </div>

    {{-- Tabel Galeri --}}
    <div class="card shadow border-0">
        <div class="card-body table-responsive">
            {{-- Tabel kini hanya memiliki kolom No, Gambar, dan Aksi --}}
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 70%;">Gambar</th>
                        <th style="width: 25%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleries as $index => $gallery)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if($gallery->image)
                                {{-- Ukuran gambar sedikit dibesarkan untuk tampilan galeri --}}
                                <img src="{{ asset('storage/'.$gallery->image) }}" width="150" height="100" style="object-fit: cover;" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">Tidak ada gambar</span>
                            @endif
                        </td>
                        <td>
                            {{-- **TAMBAHAN BARU: Tombol Detail** --}}
                            <a href="{{ route('admin.galleries.show', $gallery->id) }}" class="btn btn-sm btn-info text-white mb-1 me-1"><i class="bi bi-eye"></i> Detail</a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="btn btn-sm btn-warning mb-1"><i class="bi bi-pencil"></i> Edit</a>

                            {{-- Hapus --}}
                            <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus gambar ini?')" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="text-muted">Belum ada gambar di galeri.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
