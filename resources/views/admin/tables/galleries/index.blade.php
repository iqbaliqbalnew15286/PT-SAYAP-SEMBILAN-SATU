@extends('admin.layouts.app')

@section('title', 'Galeri - Admin')

@section('content')

<div class="container-fluid">

    {{-- Header Halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- Menggunakan warna teks gelap dari variabel CSS --}}
        <h1 class="h3 mb-0" style="color: var(--text-dark);"> Galeri Foto</h1>

        {{-- Tombol Tambah, menggunakan aksen Kuning Emas (primary-amber) --}}
        <a href="{{ route('admin.galleries.create') }}" class="btn primary-amber" style="font-weight:700; border-radius: 8px; color: var(--text-dark);">
            <i class="bi bi-plus-circle me-1"></i> Tambah Gambar
        </a>
    </div>

    {{-- Alert sukses (Disesuaikan dengan Soft Light) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert"
             style="background-color: rgba(28, 200, 138, 0.15); border: 1px solid #1cc88a; color: #1cc88a;">
            {{ session('success') }}
            {{-- Tombol close standar dari Bootstrap --}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Galeri (Menggunakan card-tower) --}}
    <div class="card card-tower mb-4">
        <div class="card-body table-responsive p-0">

            {{-- Menggunakan table-hover dan align-middle --}}
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        {{-- Header menggunakan muted color dan border pemisah vertikal --}}
                        <th class="text-center py-3" style="width: 5%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">No</th>
                        <th class="text-center py-3" style="width: 70%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Gambar</th>
                        <th class="text-center py-3" style="width: 25%; color: var(--text-muted);">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($galleries as $index => $gallery)
                    <tr>
                        {{-- No. menggunakan text-muted, dengan garis vertikal lembut --}}
                        <td class="text-center" style="color:var(--text-muted); border-right: 1px solid var(--border-subtle);">{{ $index + 1 }}</td>

                        {{-- Gambar --}}
                        <td class="text-center" style="border-right: 1px solid var(--border-subtle);">
                            @if($gallery->image)
                                {{-- Ukuran gambar sedikit dibesarkan dan styling border Soft Light --}}
                                <img src="{{ asset('storage/'.$gallery->image) }}" width="150" height="100"
                                     class="rounded" style="object-fit: cover; border: 1px solid var(--border-subtle); box-shadow: 0 1px 3px rgba(0,0,0,0.1);" alt="Galeri Foto">
                            @else
                                <span style="color:var(--text-muted); font-size: 0.8rem;">Tidak ada gambar</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                {{-- Show (Biru Muda/Info) --}}
                                <a href="{{ route('admin.galleries.show', $gallery->id) }}"
                                   class="btn btn-sm btn-icon-action" title="Detail"
                                   style="color: #36b9cc; padding: 5px 8px;">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Edit (Kuning/Warning) --}}
                                <a href="{{ route('admin.galleries.edit', $gallery->id) }}"
                                   class="btn btn-sm btn-icon-action" title="Edit"
                                   style="color: #f6c23e; padding: 5px 8px;">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- Delete (Merah/Danger) --}}
                                <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-icon-action" title="Hapus"
                                        style="color: #e74a3b; padding: 5px 8px;"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini secara permanen?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center py-5" style="color:var(--text-muted);">
                            {{-- Ikon menggunakan aksen Kuning Emas (text-neon) --}}
                            <i class="bi bi-camera-fill fa-2x mb-3 text-neon"></i>
                            <h4 style="color: var(--text-dark);">Belum ada Gambar di Galeri.</h4>
                            <p>Silakan klik tombol 'Tambah Gambar' di atas untuk mengunggah foto.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
