@extends('admin.layouts.app')
@section('title','Detail Testimoni')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4 text-dark">Detail Testimoni</h4>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    @if($testimonial->photo && Storage::disk('public')->exists($testimonial->photo))
                        <img src="{{ asset('storage/'.$testimonial->photo) }}" class="rounded-circle img-fluid shadow-sm" style="max-width:160px;" alt="Foto Testimoni">
                    @else
                        <div class="bg-light p-5 rounded text-muted shadow-sm">Tidak ada foto</div>
                    @endif
                </div>

                <div class="col-md-9">
                    <h4 class="fw-bold">{{ $testimonial->name ?? 'Anonim' }}</h4>
                    <p class="text-muted mt-2">{{ $testimonial->message ?? '-' }}</p>

                    <div class="mt-4 d-flex flex-wrap gap-2">
                        <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" onsubmit="return confirm('Hapus testimoni ini?')" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>

                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm ms-auto">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
