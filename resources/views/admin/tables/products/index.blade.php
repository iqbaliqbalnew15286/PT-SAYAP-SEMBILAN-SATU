@extends('admin.layouts.app')
@section('title', 'Produk')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-3 text-dark">Tabel Produk</h4>

  {{-- Alert sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- Tombol tambah produk --}}
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
      <i class="bi bi-plus-circle me-1"></i> Tambah Produk
    </a>
  </div>

  {{-- Tabel --}}
  <div class="card shadow-sm border-0">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama</th>
            {{-- KOLOM DESKRIPSI (DIKEMBALIKAN) --}}
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th width="150">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($products as $index => $product)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td class="fw-semibold">{{ $product->name }}</td>

              {{-- DATA DESKRIPSI DENGAN BATAS KARAKTER --}}
              <td class="text-start">{{ Str::limit($product->description, 60) }}</td>

              <td class="fw-bold text-success">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
              <td>
                @if($product->image)
                  <img src="{{ asset('storage/'.$product->image) }}" width="70" height="70" class="rounded shadow-sm" alt="Gambar Produk">
                @else
                  <span class="text-muted">Tidak ada</span>
                @endif
              </td>
              <td>
                {{-- Tombol Show --}}
                <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-success btn-sm" title="Lihat Detail">
                  <i class="bi bi-eye"></i>
                </a>

                {{-- Tombol Edit --}}
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm" title="Edit">
                  <i class="bi bi-pencil"></i>
                </a>

                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger btn-sm" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-muted py-3">Belum ada produk yang ditambahkan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
