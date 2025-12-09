@extends('admin.layouts.app')
@section('title', 'Visi, Misi & Tujuan')
@section('content')

<div class="container-fluid">
  <h4 class="fw-bold mb-3 text-dark">Visi, Misi & Tujuan</h4>

  {{-- Alert sukses --}}
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Alert error --}}
  @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Tombol tambah --}}
  <div class="d-flex justify-content-end mb-3">
    <a href="{{ route('admin.abouts.create') }}" class="btn btn-dark">
      <i class="bi bi-plus-circle me-1"></i> Tambah Data
    </a>
  </div>

  {{-- Tabel --}}
  <div class="card shadow-sm border-0">
    <div class="card-body table-responsive">

      <table class="table table-bordered align-middle text-center">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Visi</th>
            <th>Misi</th>
            <th>Tujuan</th>
            <th>Gambar</th>
            <th width="150">Aksi</th>
          </tr>
        </thead>

        <tbody>
        @forelse($abouts as $index => $about)
          <tr>
            <td>{{ $index + 1 }}</td>

            <td class="text-start">{{ Str::limit($about->vision, 80) }}</td>
            <td class="text-start">{{ Str::limit($about->mission, 80) }}</td>
            <td class="text-start">{{ Str::limit($about->goal, 80) }}</td>

            <td>
              @if($about->image)
                <img src="{{ asset('storage/'.$about->image) }}" width="70" height="70"
                     class="rounded shadow-sm" alt="gambar">
              @else
                <span class="text-muted">Tidak ada</span>
              @endif
            </td>

            <td>
              {{-- Show --}}
              <a href="{{ route('admin.abouts.show', $about->id) }}" class="btn btn-success btn-sm" title="Detail">
                <i class="bi bi-eye"></i>
              </a>

              {{-- Edit --}}
              <a href="{{ route('admin.abouts.edit', $about->id) }}" class="btn btn-warning btn-sm" title="Edit">
                <i class="bi bi-pencil"></i>
              </a>

              {{-- Delete --}}
              <form action="{{ route('admin.abouts.destroy', $about->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-danger btn-sm" title="Hapus"
                  onclick="return confirm('Yakin ingin menghapus data ini?')">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-muted py-3">Belum ada data.</td>
          </tr>
        @endforelse
        </tbody>

      </table>

    </div>
  </div>

</div>
@endsection
