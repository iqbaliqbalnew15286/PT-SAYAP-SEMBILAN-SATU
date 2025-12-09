@extends('layouts.app')
@section('title', 'Galeri Foto - Bidan Feni')

@section('content')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css"/>
<style>
    body { background:#0f0f0f; color:#eee; }

    .gallery-title {
        padding-top:120px;
        padding-bottom:60px;
        text-align:center;
    }

    .gallery-title h1 {
        font-weight:700;
        color:#fff;
    }

    .divider {
        width:80px;
        height:3px;
        background:#ffb400;
        margin:12px auto 18px;
        border-radius:4px;
    }

    .gallery-title p {
        color:#bcbcbc;
        font-size:1.05rem;
    }

    .photo-card {
        border-radius:16px;
        overflow:hidden;
        background:#161616;
        border:1px solid rgba(255,255,255,.08);
        box-shadow:0 8px 22px rgba(0,0,0,.4);
        transition:.35s ease;
    }
    .photo-card:hover {
        transform:translateY(-6px);
        box-shadow:0 10px 28px rgba(0,0,0,.6);
    }

    .photo-card img {
        width:100%; height:300px;
        object-fit:cover;
        transition:.42s ease;
    }
    .photo-card:hover img { transform:scale(1.07); }

    @media(max-width:768px){
        .photo-card img { height:220px; }
    }

    .empty-box {
        padding:80px 0;
        border-radius:20px;
        background:#141414;
        border:1px solid rgba(255,255,255,.05);
        box-shadow:inset 0 0 25px rgba(0,0,0,.4);
    }
</style>
@endpush


{{-- ✅ HERO --}}
<section class="gallery-title" data-aos="fade-down">
    <span class="badge bg-dark border text-warning px-3 py-2 mb-2"
          style="border-color:rgba(255,255,255,.15); font-weight:600;">
        Gallery
    </span>
    <h1 class="display-5">Galeri Foto</h1>
    <div class="divider"></div>
    <p>Lihat momen terbaik bersama Bunda & buah hati 💞</p>
</section>


{{-- ✅ GALLERY GRID --}}
<div class="container pb-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        @forelse ($galleries as $gallery)
        <div class="col">
            <div class="photo-card" data-aos="zoom-in">
                <a href="{{ asset('storage/'.$gallery->image) }}"
                   data-lightbox="gallery"
                   data-title="Momen Bidan Feni">
                    <img src="{{ asset('storage/'.$gallery->image) }}" alt="Foto Galeri">
                </a>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="empty-box" data-aos="fade-up">
                <h3 class="text-light">Galeri Segera Hadir</h3>
                <p class="text-secondary mt-2">Belum ada gambar tersedia saat ini.</p>
            </div>
        </div>
        @endforelse

    </div>
</div>


@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
@endpush

@endsection
