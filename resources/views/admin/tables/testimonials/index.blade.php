@extends('admin.layouts.app')
@section('title', 'Testimoni - Admin')
@section('content')

<div class="container-fluid">
    <h4 class="fw-bold mb-4 text-dark">Testimoni</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('admin.testimonials.create') }}" class="btn btn-dark">
            <i class="bi bi-plus-lg"></i> Tambah Testimoni
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Pesan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($t->photo && Storage::disk('public')->exists($t->photo))
                                    <img src="{{ asset('storage/'.$t->photo) }}" width="70" height="70" class="rounded-circle shadow-sm">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $t->name ?? '-' }}</td>
                            <td class="text-start">{{ Str::limit($t->message ?? '-', 60) }}</td>
                            <td>
                                <a href="{{ route('admin.testimonials.show', $t->id) }}" class="btn btn-sm btn-info" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn btn-sm btn-secondary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus testimoni ini?')" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">Belum ada testimoni.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
