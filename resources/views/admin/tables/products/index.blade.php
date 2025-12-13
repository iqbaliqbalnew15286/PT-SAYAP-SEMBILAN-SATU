@extends('admin.layouts.app')

@section('title', 'Produk')

@section('content')

<div class="container-fluid">

    {{-- Header Halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- Menggunakan warna teks gelap dari variabel CSS --}}
        <h1 class="h3 mb-0" style="color: var(--text-dark);">Tabel Produk</h1>

        {{-- Tombol Tambah Produk, menggunakan aksen Kuning Emas (primary-amber) --}}
        <a href="{{ route('admin.products.create') }}" class="btn primary-amber" style="font-weight:700; border-radius: 8px; color: var(--text-dark);">
            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
        </a>
    </div>

    {{-- Alert sukses (Disesuaikan dengan Soft Light) --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert"
             style="background-color: rgba(28, 200, 138, 0.15); border: 1px solid #1cc88a; color: #1cc88a;">
            {{ session('success') }}
            {{-- Tombol close standar dari Bootstrap --}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Alert error (Disesuaikan dengan Soft Light) --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert"
             style="background-color: rgba(230, 70, 70, 0.15); border: 1px solid #e74a3b; color: #e74a3b;">
            {{ session('error') }}
            {{-- Tombol close standar dari Bootstrap --}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Tabel Konten (Menggunakan card-tower) --}}
    <div class="card card-tower mb-4">
        <div class="card-body table-responsive p-0">

            {{-- Menggunakan table-hover dan align-middle --}}
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        {{-- Header menggunakan muted color dan border pemisah vertikal --}}
                        <th class="text-center py-3" style="width: 5%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">No</th>
                        <th class="text-start py-3" style="width: 20%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Nama</th>
                        <th class="text-start py-3" style="width: 40%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Deskripsi</th>
                        <th class="text-start py-3" style="width: 15%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Harga</th>
                        <th class="text-center py-3" style="width: 10%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Gambar</th>
                        <th class="text-center py-3" style="width: 10%; color: var(--text-muted);">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $index => $product)
                        <tr>
                            {{-- No. menggunakan text-muted, dengan garis vertikal lembut --}}
                            <td class="text-center" style="color:var(--text-muted); border-right: 1px solid var(--border-subtle);">{{ $index + 1 }}</td>

                            {{-- Nama Produk (Teks Gelap) --}}
                            <td class="text-start fw-semibold" style="color: var(--text-dark); border-right: 1px solid var(--border-subtle);">{{ $product->name }}</td>

                            {{-- Deskripsi (Teks Gelap) --}}
                            <td class="text-start" style="font-size: 0.9rem; color: var(--text-dark); border-right: 1px solid var(--border-subtle);">{{ Str::limit($product->description, 60) }}</td>

                            {{-- Harga (Menggunakan warna aksen Succes/Hijau tapi tetap konsisten dengan gaya) --}}
                            <td class="text-start fw-bold" style="color: #1cc88a; border-right: 1px solid var(--border-subtle);">Rp {{ number_format($product->price, 0, ',', '.') }}</td>

                            {{-- Gambar --}}
                            <td class="text-center" style="border-right: 1px solid var(--border-subtle);">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" width="45" height="45"
                                        class="rounded" style="object-fit: cover; border: 1px solid var(--border-subtle);" alt="Gambar Produk">
                                @else
                                    <span style="color:var(--text-muted); font-size: 0.8rem;">Tidak ada</span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    {{-- Show (Biru Muda/Info) --}}
                                    <a href="{{ route('admin.products.show', $product->id) }}"
                                       class="btn btn-sm btn-icon-action" title="Detail"
                                       style="color: #36b9cc; padding: 5px 8px;">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Edit (Kuning/Warning) --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                       class="btn btn-sm btn-icon-action" title="Edit"
                                       style="color: #f6c23e; padding: 5px 8px;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete (Merah/Danger) --}}
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon-action" title="Hapus"
                                            style="color: #e74a3b; padding: 5px 8px;"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini secara permanen?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5" style="color:var(--text-muted);">
                                {{-- Ikon menggunakan aksen Kuning Emas (text-neon) --}}
                                <i class="bi bi-info-circle-fill fa-2x mb-3 text-neon"></i>
                                <h4 style="color: var(--text-dark);">Belum ada Produk yang ditambahkan.</h4>
                                <p>Silakan klik tombol 'Tambah Produk' di atas untuk menambahkan data.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
