@extends('admin.layouts.app')
@section('title', 'Layanan - Admin')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-4 text-dark">Tabel Layanan</h4>

  {{-- Notifikasi sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif

  {{-- Tombol tambah layanan --}}
  <div class="text-end mb-3">
    <a href="{{ route('admin.services.create') }}" class="btn btn-dark">
      <i class="bi bi-plus-lg"></i> Tambah Layanan
    </a>
  </div>

  {{-- Tabel Layanan --}}
  <div class="card shadow border-0">
    <div class="card-body table-responsive">
      <table class="table table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Layanan</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Gambar</th>
            <th width="150">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($services as $index => $service)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td class="fw-semibold">{{ $service->name }}</td>
            <td class="text-start">{{ Str::limit($service->description, 70) }}</td>
            <td>
              @if($service->price)
                <span class="fw-bold text-success">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
              @else
                <span class="text-muted">-</span>
              @endif
            </td>
            <td>
              @if($service->image)
                <img src="{{ asset('storage/'.$service->image) }}" width="70" height="70" class="rounded shadow-sm" alt="Gambar Layanan">
              @else
                <span class="text-muted">Tidak ada</span>
              @endif
            </td>
            <td>
              {{-- Tombol Show --}}
              <a href="{{ route('admin.services.show', $service->id) }}" class="btn btn-success btn-sm" title="Lihat Detail">
                <i class="bi bi-eye"></i>
              </a>

              {{-- Tombol Edit --}}
              <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-warning btn-sm" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>

              {{-- Tombol Hapus --}}
              <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button onclick="return confirm('Hapus layanan ini?')" class="btn btn-danger btn-sm" title="Hapus">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-muted py-3">Belum ada layanan.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
