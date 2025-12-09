<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Bidan Feni')</title>

  {{-- Fonts --}}
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  {{-- Icons --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  {{-- Bootstrap --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- Swiper --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

  {{-- AOS --}}
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

  {{-- Lightbox --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css"/>

  @stack('styles')

  <style>
    :root {
      --accent:#ffb400;
      --bg:#0f0f0f;
      --muted:#bdbdbd;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: var(--bg);
      color:#eee;
      overflow-x:hidden;
    }

    /* NAVBAR */
    .navbar {
      background: rgba(0,0,0,0.45);
      backdrop-filter: blur(6px);
      border-bottom: 1px solid rgba(255,255,255,0.08);
      padding:12px 0;
    }

    .nav-link {
      color:#ddd !important;
      font-weight:600;
      padding: 10px 16px !important;
      transition:.3s;
    }

    .nav-link:hover {
      color:#fff !important;
      transform: translateY(-2px);
    }

    /* Dropdown Hover */
    .dropdown:hover .dropdown-menu {
      display: block;
      margin-top:0;
    }

    .dropdown-menu {
      background:#111;
      border:1px solid rgba(255,255,255,0.1);
      border-radius:10px;
    }

    .dropdown-item {
      color:#ddd;
      font-weight:500;
      padding:10px 18px;
    }

    .dropdown-item:hover {
      background: var(--accent);
      color:#000 !important;
    }

    .btn-warning {
      background:var(--accent);
      border:none;
      font-weight:600;
    }

    footer {
      background:#070707;
      border-top:1px solid rgba(255,255,255,0.03);
    }

    /* Make navbar links not too close on mobile */
    @media (max-width:991px) {
        .nav-link { padding:12px 10px !important; }
        .dropdown-menu { position:relative; float:none; }
    }
  </style>

</head>
<body>

{{-- ✅ NAVBAR --}}
<nav class="navbar navbar-expand-lg sticky-top" data-aos="fade-down">
  <div class="container">

    <a class="navbar-brand d-flex align-items-center text-white" href="{{ route('home') }}">
      <img src="{{ asset('assets/img/logo.jpg') }}" height="42" class="me-2 rounded-circle" alt="logo">
      <strong>Bidan Feni</strong>
    </a>

    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
      <i class="fa-solid fa-bars"></i>
    </button>

    <div class="collapse navbar-collapse" id="nav">
      <ul class="navbar-nav ms-auto me-3">

        <li class="nav-item">
          <a class="nav-link" href="{{ route('home') }}">Home</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#">Profil</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('about') }}">Tentang Kami</a></li>
            <li><a class="dropdown-item" href="{{ route('gallery.index') }}">Gallery</a></li>
            <li><a class="dropdown-item" href="{{ route('faq') }}">FAQs</a></li>
            <li><a class="dropdown-item" href="{{ route('syaratketentuan') }}">Syarat & Ketentuan</a></li>
            <li><a class="dropdown-item" href="{{ route('kontak') }}">Kontak Kami</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#">Produk & Layanan</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('products') }}">Produk Kami</a></li>
            <li><a class="dropdown-item" href="{{ route('services') }}">Layanan Kami</a></li>
          </ul>
        </li>

      </ul>

      <div class="d-flex">
        <a href="{{ route('booking') }}" class="btn btn-outline-light rounded-pill me-2">Reservasi</a>
        <a href="{{ route('contact') }}" class="btn btn-warning text-dark rounded-pill">Kontak</a>
      </div>

    </div>
  </div>
</nav>

{{-- CONTENT --}}
<main>
  @yield('content')
</main>

{{-- FOOTER --}}
<footer class="py-4 mt-5 text-center text-muted small">
  © {{ date('Y') }} Bidan Feni. All rights reserved.
</footer>

{{-- Scripts --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<script>
  AOS.init({ duration:800, once:true });
</script>

@stack('scripts')

</body>
</html>
