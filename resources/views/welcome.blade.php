@extends('layouts.app')
@section('title','Bidan Feni – Perawatan Ibu & Bayi')

@push('styles')
<style>
/* GLOBAL */
body { background:#0f0f0f; color:#f1f1f1; }
section { position:relative; }

h3.fw-bold { color:#fff; }

/* HERO */
.hero {
  padding:120px 0;
  background: linear-gradient(180deg,#0f0f0f, #181818);
}
.hero h1 {
  color:#fff; font-weight:800; font-size:3rem;
}
.hero p { color:#d5d5d5; font-size:1.05rem; max-width:600px; }

/* Buttons */
.btn-main {
  background:var(--accent); border:none;
  color:#111; padding:10px 24px;
  font-weight:700; border-radius:50px;
  transition:.25s;
}
.btn-main:hover { background:#ff9e00; transform:translateY(-2px); }

.btn-soft {
  border:1px solid rgba(255,255,255,.15);
  color:#fff; border-radius:50px; padding:10px 24px;
  transition:.25s;
}
.btn-soft:hover { background:#fff; color:#000; }

/* CARD */
.card-item {
  background:#151515; border-radius:16px;
  overflow:hidden; height:420px;
  box-shadow:0 6px 26px rgba(0,0,0,.65);
  display:flex; flex-direction:column;
  transition:.25s;
}
.card-item:hover { transform:translateY(-5px); }
.card-item .media { height:230px; overflow:hidden; }
.card-item .media img { width:100%; height:100%; object-fit:cover; transition:.5s; }
.card-item:hover .media img { transform:scale(1.08); }
.card-item h6 { color:#fff; font-weight:600; }
.card-item p { color:#bbb; font-size:.9rem; }
.card-item .btn-detail {
  border-radius:40px; border:1px solid #ffb400;
  background:transparent; color:#ffb400;
  transition:.3s; padding:8px 18px;
}
.card-item .btn-detail:hover {
  background:#ffb400; color:#000;
  transform:scale(1.04);
}

/* SWIPER */
.swiper { padding-bottom:40px; }
.swiper-button-next,.swiper-button-prev {
  color:#ffb400 !important;
  background:rgba(255,255,255,0.08);
  border-radius:10px; backdrop-filter:blur(4px);
  width:42px; height:42px;
}
.swiper-button-next::after, .swiper-button-prev::after { font-size:14px; }

/* ABOUT */
.about-box {
  background:#131313; padding:40px;
  border-radius:16px;
  box-shadow:0 4px 20px rgba(0,0,0,.5);
}
.about-box p { color:#ccc; }

/* TESTI */
.testi-card {
  background:#171717; padding:22px; border-radius:16px;
  border:1px solid rgba(255,255,255,.07);
  box-shadow:0 4px 20px rgba(0,0,0,.45);
}

/* GALLERY */
.gallery-img {
  border-radius:14px; height:240px; width:100%;
  object-fit:cover;
}

/* RESPONSIVE */
@media(max-width:768px){
  .hero h1 { font-size:2.2rem; }
  .card-item { height:380px; }
}
</style>
@endpush


@section('content')

{{-- HERO --}}
<section class="hero">
  <div class="container">
    <div class="row align-items-center gy-5">

      <div class="col-lg-6" data-aos="fade-right">
        <h1>Bidan Feni — Sahabat Perjalanan Ibu & Bayi</h1>
        <p class="mt-3">Pendamping kehamilan, persalinan, dan perawatan bayi penuh kasih & profesional. Nyaman, aman, terpercaya.</p>

        <div class="mt-4 d-flex gap-3">
          <a href="{{ route('booking') }}" class="btn-main">Reservasi</a>
          <a href="{{ route('consult') }}" class="btn-soft">Konsultasi</a>
        </div>
      </div>

      <div class="col-lg-6 text-center" data-aos="fade-left">
        <img src="{{ asset('assets/img/ibubayi.png') }}" style="max-width:420px; filter:drop-shadow(0 0 20px rgba(255,255,255,.07));">
      </div>

    </div>
  </div>
</section>



{{-- PRODUK --}}
<section class="py-5">
  <div class="container">

    <div class="d-flex justify-content-between mb-3 align-items-center">
      <h3 class="fw-bold text-white">Produk Kami</h3>
      <a href="{{ route('products') }}" class="btn-soft">Lihat Semua</a>
    </div>

    <div class="swiper productSwiper">
      <div class="swiper-wrapper">
        @forelse($products as $p)
        <div class="swiper-slide">
          <div class="card-item" data-aos="zoom-in">
            <div class="media">
              <img src="{{ $p->image ? asset('storage/'.$p->image) : asset('assets/img/placeholder.png') }}">
            </div>
            <div class="p-3">
              <h6>{{ $p->name }}</h6>
              <p>{{ Str::limit(strip_tags($p->description), 80) }}</p>
              <div class="fw-bold text-warning mb-2">Rp {{ number_format($p->price ?? 0,0,',','.') }}</div>
              <a href="{{ route('product.show',$p->slug ?? $p->id) }}" class="btn-detail w-100">Detail</a>
            </div>
          </div>
        </div>
        @empty
        <p class="text-white">Belum ada produk.</p>
        @endforelse
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>

  </div>
</section>



{{-- LAYANAN --}}
<section class="py-5">
  <div class="container">

    <div class="d-flex justify-content-between mb-3">
      <h3 class="fw-bold text-white">Layanan Kami</h3>
      <a href="{{ route('services') }}" class="btn-soft">Lihat Semua</a>
    </div>

    <div class="swiper serviceSwiper">
      <div class="swiper-wrapper">
        @forelse($services as $s)
        <div class="swiper-slide">
          <div class="card-item" data-aos="zoom-in">
            <div class="media">
              <img src="{{ $s->image ? asset('storage/'.$s->image) : asset('assets/img/placeholder.png') }}">
            </div>
            <div class="p-3">
              <h6>{{ $s->name }}</h6>
              <p>{{ Str::limit(strip_tags($s->description), 80) }}</p>
              <a href="{{ route('service.show',$s->slug ?? $s->id) }}" class="btn-detail w-100">Detail</a>
            </div>
          </div>
        </div>
        @empty
        <p class="text-white">Belum ada layanan.</p>
        @endforelse
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>

  </div>
</section>



{{-- ABOUT --}}
<section class="py-5">
  <div class="container">
    <div class="about-box" data-aos="fade-up">
      <h3 class="fw-bold mb-2 text-white">Tentang Kami</h3>
      <p>Bidan Feni memberi layanan ibu & bayi terbaik, mengutamakan kenyamanan, keamanan, dan sentuhan kasih sejak 2018.</p>
      <a href="{{ route('about') }}" class="btn-main mt-2">Selengkapnya</a>
    </div>
  </div>
</section>



{{-- TESTIMONI --}}
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold mb-3 text-center text-white">Apa Kata Mereka?</h3>

    <div class="swiper testiSwiper">
      <div class="swiper-wrapper">
        @forelse($testimonials as $t)
        <div class="swiper-slide">
          <div class="testi-card" data-aos="fade-up">
            “{{ Str::limit($t->message,160) }}”
            <div class="mt-2 fw-bold text-warning">{{ $t->name }}</div>
          </div>
        </div>
        @empty
        <p class="text-center text-white">Belum ada testimoni.</p>
        @endforelse
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</section>



{{-- GALLERY --}}
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold text-center mb-3 text-white">Momen Bahagia Bersama Kami</h3>

    <div class="swiper gallerySwiper">
      <div class="swiper-wrapper">
        @forelse($galleryItems as $g)
        <div class="swiper-slide">
          <img src="{{ asset('storage/'.$g->image) }}" class="gallery-img">
        </div>
        @empty
        <p class="text-center text-white">Belum ada foto.</p>
        @endforelse
      </div>

      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>
    </div>
  </div>
</section>

@endsection



@push('scripts')
<script>
function slider(el,breaks){
  new Swiper(el,{
    slidesPerView:1.2,
    spaceBetween:18,
    loop:true,
    navigation:{ nextEl: el+' .swiper-button-next', prevEl: el+' .swiper-button-prev' },
    breakpoints:{
      576:{slidesPerView:2},
      768:{slidesPerView:3},
      1200:{slidesPerView:4},
      ...breaks
    }
  });
}

slider('.productSwiper');
slider('.serviceSwiper');
slider('.testiSwiper',{768:{slidesPerView:2},1200:{slidesPerView:3}});
slider('.gallerySwiper');
</script>
@endpush
