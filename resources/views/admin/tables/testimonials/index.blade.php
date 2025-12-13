@extends('admin.layouts.app')

@section('title', 'Testimoni - Admin')

@section('content')

<div class="container-fluid">

    {{-- Header Halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- Menggunakan warna teks gelap dari variabel CSS --}}
        <h1 class="h3 mb-0" style="color: var(--text-dark);">Testimoni</h1>

        {{-- Tombol Tambah, menggunakan aksen Kuning Emas (primary-amber) --}}
        <a href="{{ route('admin.testimonials.create') }}" class="btn primary-amber" style="font-weight:700; border-radius: 8px; color: var(--text-dark);">
            <i class="bi bi-plus-circle me-1"></i> Tambah Testimoni
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

    {{-- Tabel Testimoni (Menggunakan card-tower) --}}
    <div class="card card-tower mb-4">
        <div class="card-body table-responsive p-0">

            {{-- Menggunakan table-hover dan align-middle --}}
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        {{-- Header menggunakan muted color dan border pemisah vertikal --}}
                        <th class="text-center py-3" style="width: 5%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">No</th>
                        <th class="text-center py-3" style="width: 10%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Foto</th>
                        <th class="text-start py-3" style="width: 20%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Nama</th>
                        <th class="text-start py-3" style="width: 50%; color: var(--text-muted); border-right: 1px solid var(--border-subtle);">Pesan</th>
                        <th class="text-center py-3" style="width: 15%; color: var(--text-muted);">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($testimonials as $t)
                        <tr>
                            {{-- No. menggunakan text-muted, dengan garis vertikal lembut --}}
                            <td class="text-center" style="color:var(--text-muted); border-right: 1px solid var(--border-subtle);">{{ $loop->iteration }}</td>

                            {{-- Foto Testimoni --}}
                            <td class="text-center" style="border-right: 1px solid var(--border-subtle);">
                                @if($t->photo && Storage::disk('public')->exists($t->photo))
                                    <img src="{{ asset('storage/'.$t->photo) }}" width="50" height="50"
                                         class="rounded-circle" style="object-fit: cover; border: 1px solid var(--border-subtle);" alt="Foto Klien">
                                @else
                                    <i class="bi bi-person-circle fa-2x" style="color: var(--text-muted);"></i>
                                @endif
                            </td>

                            {{-- Nama Klien (Teks Gelap) --}}
                            <td class="text-start fw-semibold" style="color: var(--text-dark); border-right: 1px solid var(--border-subtle);">{{ $t->name ?? '-' }}</td>

                            {{-- Pesan (Teks Gelap) --}}
                            <td class="text-start" style="font-size: 0.9rem; color: var(--text-dark); border-right: 1px solid var(--border-subtle);">{{ Str::limit($t->message ?? '-', 60) }}</td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    {{-- Show (Biru Muda/Info) --}}
                                    <a href="{{ route('admin.testimonials.show', $t->id) }}"
                                       class="btn btn-sm btn-icon-action" title="Detail"
                                       style="color: #36b9cc; padding: 5px 8px;">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    {{-- Edit (Kuning/Warning) --}}
                                    <a href="{{ route('admin.testimonials.edit', $t->id) }}"
                                       class="btn btn-sm btn-icon-action" title="Edit"
                                       style="color: #f6c23e; padding: 5px 8px;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    {{-- Delete (Merah/Danger) --}}
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-icon-action" title="Hapus"
                                            style="color: #e74a3b; padding: 5px 8px;"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus testimoni ini secara permanen?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5" style="color:var(--text-muted);">
                                {{-- Ikon menggunakan aksen Kuning Emas (text-neon) --}}
                                <i class="bi bi-chat-quote fa-2x mb-3 text-neon"></i>
                                <h4 style="color: var(--text-dark);">Belum ada Testimoni.</h4>
                                <p>Silakan klik tombol 'Tambah Testimoni' di atas untuk menambahkan masukan klien.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
