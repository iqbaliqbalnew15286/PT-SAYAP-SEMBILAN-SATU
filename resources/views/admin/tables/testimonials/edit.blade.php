@extends('admin.layouts.app')
@section('title', 'Edit Testimoni')
@section('content')

<div class="container-fluid">
    <h4 class="fw-bold mb-4 text-dark">Edit Testimoni</h4>

    <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" name="name" class="form-control" value="{{ $testimonial->name ?? '' }}">
            </div>

            <div class="col-12">
                <label class="form-label">Pesan</label>
                <textarea name="message" class="form-control" rows="3">{{ $testimonial->message ?? '' }}</textarea>
            </div>

            <div class="col-md-6">
                <label class="form-label">Foto (Opsional)</label><br>
                @if($testimonial->photo && \Illuminate\Support\Facades\Storage::disk('public')->exists($testimonial->photo))
                    <img src="{{ asset('storage/'.$testimonial->photo) }}" width="80" height="80" class="rounded-circle mb-2 shadow-sm"><br>
                @else
                    <span class="text-muted d-block mb-2">Belum ada foto</span>
                @endif
                <input type="file" name="photo" class="form-control" accept="image/*">
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark">
                <i class="bi bi-save me-1"></i> Update
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>

@endsection
