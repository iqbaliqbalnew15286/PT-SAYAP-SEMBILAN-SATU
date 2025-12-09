<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>@yield('title','Dashboard - Bidan Fina')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
:root {
    --gold: #f8c200;
    --gold-soft:#fddf7a;
    --dark:#0b0b0b;
    --dark-soft:#121212;
    --text-muted:#a2a2a2;
}

/* Body */
body{
    font-family:"Poppins",sans-serif;
    background:var(--dark);
    color:#fff;
    overflow-x:hidden;
}

/* Sidebar */
.sidebar{
    background:linear-gradient(180deg,#0d0d0d,#000);
    width:260px;
    height:100vh;
    position:fixed;
    top:0;left:0;
    display:flex;
    flex-direction:column;
    border-right:1px solid rgba(255,255,255,0.06);
    box-shadow:8px 0 20px rgba(0,0,0,0.65);
    z-index:2000;
    transition:.35s;
}

/* Sidebar Brand */
.sidebar .brand{
    padding:20px;
    display:flex;
    align-items:center;
    gap:12px;
    background:rgba(255,255,255,0.05);
    border-bottom:1px solid rgba(255,255,255,0.06);
    backdrop-filter:blur(6px);
}
.sidebar .brand img{
    width:42px;height:42px;border-radius:9px;object-fit:cover;
}
.sidebar .brand div{
    font-weight:700;
    font-size:1rem;
}

/* Nav links */
.nav-link-custom{
    display:flex;
    justify-content:space-between;
    padding:11px 15px;
    color:var(--text-muted);
    text-decoration:none;
    border-radius:8px;
    margin:4px 8px;
    transition:.25s;
    font-weight:500;
}
.nav-link-custom:hover{
    background:rgba(255,215,0,0.09);
    color:var(--gold);
    transform:translateX(4px);
}
.nav-link-custom.active{
    background:rgba(255,200,0,0.18);
    color:var(--gold);
    font-weight:700;
    box-shadow:0 0 12px rgba(255,200,0,0.25);
}

/* Submenu */
.submenu{
    padding-left:42px;
    overflow:hidden;
    max-height:0;
    opacity:0;
    transition:.35s;
    display:flex;
    flex-direction:column;
}
.submenu.show{
    max-height:350px;
    opacity:1;
}
.submenu a{
    font-size:.9rem;color:#d4d4d4;text-decoration:none;
    padding:6px 8px;border-radius:6px;transition:.25s;
}
.submenu a:hover{
    background:rgba(255,215,0,0.12);
    color:var(--gold-soft);
}

/* Bottom buttons */
.btn-side{
    display:block;
    padding:10px;
    border-radius:8px;
    text-align:center;
    font-weight:700;
    text-decoration:none;
    background:var(--gold);
    color:#000;
    transition:.25s;
}
.btn-side:hover{
    background:var(--gold-soft);
    box-shadow:0 0 14px rgba(255,200,0,0.45);
}
.btn-side.outline{
    background:transparent;border:1px solid rgba(255,255,255,0.1);color:#eaeaea;
}
.btn-side.outline:hover{
    border-color:var(--gold);
    background:rgba(255,215,0,0.1);
}

/* Main content */
.main{
    margin-left:260px;
    padding:30px;
    min-height:100vh;
    transition:.35s;
}

/* Topbar */
.topbar{
    background:#0f0f0f;
    border:1px solid rgba(255,255,255,0.05);
    border-radius:14px;
    padding:18px 24px;
    box-shadow:0 0 20px rgba(0,0,0,0.55);
    margin-bottom:25px;
}
.welcome h3{
    font-size:1.45rem;margin:0;font-weight:800;color:#fff;
}
.welcome small{
    color:var(--text-muted);
}

/* Date */
.datebox{
    display:flex;
    align-items:center;
    gap:8px;
    color:var(--text-muted);
}
.datebox i{
    color:var(--gold);
}

/* Mobile toggle */
.sidebar-toggle{
    display:none;
    position:fixed;
    top:16px;left:16px;
    z-index:3000;
    background:var(--gold);
    border:none;
    padding:8px 10px;
    border-radius:8px;
    font-size:1.3rem;
    box-shadow:0 0 15px rgba(255,200,0,0.45);
}
@media(max-width:992px){
    .sidebar{left:-260px;}
    .sidebar.show{left:0;}
    .main{margin-left:0;padding-top:85px;}
    .sidebar-toggle{display:block;}
}
</style>
</head>
<body>

<!-- Toggle -->
<button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>

<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
<div>
  <div class="brand">
    <img src="{{ asset('assets/img/logo.jpg') }}">
    <div>
      Bidan Fina<br>
      <span style="font-size:.7rem;color:var(--text-muted);font-weight:300;">Admin Panel</span>
    </div>
  </div>

  <nav>
    <a href="{{ route('admin.dashboard') }}" class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active':'' }}">
      <div class="left"><i class="bi bi-speedometer2"></i> Dashboard</div>
    </a>

    <div class="nav-link-custom" id="editorToggle">
      <div class="left"><i class="bi bi-pencil-square"></i> Konten Website</div>
      <i id="editorIcon" class="bi bi-chevron-right"></i>
    </div>

    <div class="submenu" id="editorSubmenu">
      <a href="{{ route('admin.abouts.index') }}"><i class="bi bi-person-vcard me-2"></i> Tentang Kami</a>
      <a href="{{ route('admin.products.index') }}"><i class="bi bi-bag-heart me-2"></i> Produk</a>
      <a href="{{ route('admin.services.index') }}"><i class="bi bi-activity me-2"></i> Layanan</a>
      <a href="{{ route('admin.galleries.index') }}"><i class="bi bi-images me-2"></i> Galeri</a>
      <a href="{{ route('admin.testimonials.index') }}"><i class="bi bi-chat-quote me-2"></i> Testimoni</a>
    </div>

    <a class="nav-link-custom"><div class="left"><i class="bi bi-calendar-check"></i> Reservasi</div></a>
    <a class="nav-link-custom"><div class="left"><i class="bi bi-gear"></i> Pengaturan</div></a>
  </nav>
</div>

<div class="bottom p-3">
  <a href="{{ url('/') }}" class="btn-side mb-2">Lihat Website</a>
  <form action="{{ route('logout') }}" method="POST">@csrf
    <button class="btn-side outline w-100"><i class="bi bi-box-arrow-right me-2"></i>Log Out</button>
  </form>
</div>
</aside>

<!-- Main -->
<main class="main">
<div class="topbar">
  <div class="welcome">
    <h3>Selamat datang, <span style="color:var(--gold)">{{ Auth::user()->name }}</span></h3>
    <small>Kelola website dengan sempurna ✨</small>
  </div>

  <div class="datebox">
    <i class="bi bi-calendar-week"></i>
    <span>{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
  </div>
</div>

@yield('content')

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
const editorToggle=document.getElementById('editorToggle');
const editorSub=document.getElementById('editorSubmenu');
const icon=document.getElementById('editorIcon');
editorToggle.onclick=()=>{editorSub.classList.toggle('show');icon.classList.toggle('bi-chevron-down');icon.classList.toggle('bi-chevron-right');}

document.getElementById('sidebarToggle').onclick=()=>document.getElementById('sidebar').classList.toggle('show');
</script>
</body>
</html>
