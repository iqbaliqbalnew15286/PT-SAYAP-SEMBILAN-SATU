<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title','Dashboard - Bidan Fina')</title>

    {{-- Font Awesome untuk Ikon --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<style>

/* ------------------------------
    COLOR THEME — SOFT LIGHT (CREAMY WHITE & MILD AMBER)
-------------------------------*/
:root {
    /* Latar Belakang Diredam/Soft */
    --bg-light-main: #F2F4F8; /* Latar belakang utama (Putih keabu-abuan lembut) */
    --bg-card: #FCFDFE; /* Latar belakang card/sidebar (Putih mendekati bersih, tapi tidak #FFFFFF) */

    /* Aksen & Teks */
    --amber-accent: #FFC300; /* Aksen primer (Kuning Emas Cerah) */
    --text-dark: #2C3E50; /* Teks utama (Biru tua, lebih lembut dari Hitam murni) */
    --text-muted: #7F8C8D; /* Teks sekunder/muted (Abu-abu sedang) */

    /* Border & Shadow */
    --border-subtle: #DDE1E8; /* Border yang lebih terlihat, tidak terlalu memudar */
    --shadow-soft: 0 6px 15px rgba(0, 0, 0, 0.08); /* Bayangan lembut */
    --hover-bg: #E7EBF1; /* Diperkuat sedikit agar lebih terlihat saat hover */
    --active-bg: #DCE0E6; /* Warna active sedikit lebih tegas */
}

/* ------------------------------
    GLOBAL
-------------------------------*/
body {
    font-family: "Poppins", sans-serif;
    background: var(--bg-light-main);
    color: var(--text-dark);
    overflow-x: hidden;
}

/* Smooth transition for all elements */
*, *::before, *::after {
    transition: .25s ease;
}

/* ------------------------------
    SIDEBAR (Clean White Background)
-------------------------------*/
.sidebar {
    width: 260px;
    height: 100vh;
    position: fixed;
    left: 0; top: 0;
    display: flex;
    flex-direction: column;
    padding: 18px 14px;
    background: var(--bg-card);
    border-right: 1px solid var(--border-subtle);
    box-shadow: 4px 0 10px rgba(0, 0, 0, 0.05);
    z-index: 2000;
}

/* BRANDING / ADMIN BOX (Penyempurnaan Tipografi) */
.brand {
    padding: 15px;
    border-radius: 14px;
    background: var(--bg-card);
    border: 1px solid var(--amber-accent);
    border-left: 5px solid var(--amber-accent);
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: var(--shadow-soft);
}
.brand img {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    object-fit: cover;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}
.brand .title {
    font-weight: 700;
    color: var(--text-dark);
    line-height: 1.1;
    font-size: 1rem;
}
.brand .subtitle {
    font-size: .75rem;
    color: var(--text-muted);
    font-weight: 500;
}

/* Menu Section Divider (Penyempurnaan Tipografi) */
.menu-section {
    color: var(--text-muted);
    font-size: .7rem;
    font-weight: 700;
    text-transform: uppercase;
    margin: 20px 10px 8px 10px;
    letter-spacing: 0.8px;
}

/* ------------------------------
    NAV LINKS (Subtle Hover/Active)
-------------------------------*/
.nav-link-custom {
    padding: 12px 14px;
    border-radius: 10px;
    color: var(--text-muted);
    font-weight: 500;
    margin: 5px 0px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-decoration: none;
    transition: background .25s ease, color .25s ease;
}
.nav-link-custom:hover {
    background: var(--hover-bg);
    color: var(--text-dark);
}
.nav-link-custom.active {
    background: var(--active-bg);
    color: var(--text-dark);
    font-weight: 600;
    border-left: 4px solid var(--amber-accent);
    padding-left: 10px;
}
/* Warna ikon saat link aktif */
.nav-link-custom.active i {
    color: var(--amber-accent);
}
.nav-link-custom i {
    font-size: 1rem;
    color: var(--text-muted);
    transition: color .25s ease;
}
.nav-link-custom:hover i {
    color: var(--amber-accent);
}

/* ------------------------------
    SUBMENU
-------------------------------*/
.submenu {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    padding-left: 20px;
    display: flex;
    flex-direction: column;
    transition: max-height .45s cubic-bezier(.42, 0, .58, 1),
                opacity .3s ease;
}
.submenu.show {
    max-height: 500px;
    opacity: 1;
    margin-bottom: 10px;
}
.submenu a {
    padding: 8px 10px;
    margin: 4px 0;
    color: var(--text-muted);
    font-size: .9rem;
    border-radius: 8px;
    text-decoration: none;
    transition: background .2s, color .2s;
}
.submenu a:hover {
    background: var(--hover-bg);
    color: var(--text-dark);
}
.submenu a.text-neon {
    color: var(--text-dark) !important;
    font-weight: 500;
    background: var(--hover-bg);
    border-left: 3px solid var(--amber-accent);
    padding-left: 17px;
}
.submenu a.text-neon i {
    color: var(--amber-accent) !important;
}

/* ------------------------------
    BOTTOM BUTTONS (DIPERBAIKI)
-------------------------------*/
.btn-side {
    display: flex; /* Menggunakan flexbox untuk penataan item */
    align-items: center; /* Rata vertikal tengah */
    justify-content: center; /* Rata horizontal tengah */
    padding: 10px;
    margin-bottom: 8px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    border: none;
    transition: all .25s ease;
}
.btn-side.primary-amber {
    background: var(--amber-accent);
    color: var(--text-dark);
}
.btn-side.primary-amber:hover {
    background: #FFD700;
    color: var(--text-dark);
    box-shadow: 0 4px 8px rgba(255, 195, 0, 0.4);
}
.btn-side.outline-subtle {
    background: transparent;
    border: 1px solid var(--border-subtle);
    color: var(--text-muted);
}
.btn-side.outline-subtle:hover {
    border-color: var(--amber-accent);
    background: var(--hover-bg);
    color: var(--amber-accent);
}

/* ------------------------------
    MAIN CONTENT
-------------------------------*/
.main {
    margin-left: 260px;
    padding: 30px;
    min-height: 100vh;
}

/* Topbar (Dibiarkan agar halaman Dashboard dapat menggunakannya) */
.topbar {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 15px 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    animation: fadeDown .55s ease;
    margin-bottom: 30px;
    box-shadow: var(--shadow-soft);
}
@keyframes fadeDown {
    from { opacity:0; transform: translateY(-10px); }
    to   { opacity:1; transform: translateY(0); }
}

.welcome h3 { font-weight: 700; margin-bottom: 0; font-size: 1.6rem; color: var(--text-dark); }
.welcome small { color: var(--text-muted); font-size: 0.8rem; }
.text-neon { color: var(--amber-accent) !important; }

/* Card Styling */
.card-tower {
    background: var(--bg-card);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    box-shadow: var(--shadow-soft);
}
.card-header-tower {
    border-bottom: 1px solid var(--border-subtle);
    background: var(--bg-light-main);
    color: var(--text-dark);
    font-weight: 600;
    padding: 1rem 1.25rem;
}
.table {
    color: var(--text-dark);
}
.table thead th {
    border-bottom: 2px solid var(--border-subtle);
    color: var(--text-muted);
}
.table tbody tr:hover {
    background: var(--hover-bg);
}
.table th, .table td {
    border-top: 1px solid #EBEBF0;
}

/* ------------------------------
    RESPONSIVE/MOBILE
-------------------------------*/
.sidebar-toggle {
    display: none;
    position: fixed;
    top: 15px;
    left: 15px;
    padding: 9px 11px;
    border: none;
    border-radius: 10px;
    background: var(--amber-accent);
    color: var(--text-dark);
    font-size: 1.3rem;
    z-index: 3000;
    box-shadow: 0 0 10px rgba(255, 195, 0, 0.3);
}
@media(max-width: 991px) {
    .sidebar { left: -260px; }
    .sidebar.show { left: 0; }
    .main { margin-left: 0; padding-top: 30px; }
    .sidebar-toggle { display: block; }
    .topbar { margin: 0 15px 30px 15px; }
}

</style>
</head>

<body>

<button class="sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>

<aside class="sidebar" id="sidebar">

{{-- BRANDING / ADMIN BOX --}}
<div class="brand mb-4">
    <img src="{{ asset('assets/img/logotower.png') }}" alt="Admin Profile">
    <div class="d-flex flex-column">
        <div class="title">PT Sayap Sembilan Satu</div>
        <small class="subtitle">Admin Tower</small>
    </div>
</div>


<nav class="flex-grow-1 overflow-y-auto">

    {{-- MENU UTAMA (Judul diperjelas) --}}
    <div class="menu-section">Menu Utama</div>

    <a href="{{ route('admin.dashboard') }}"
       class="nav-link-custom {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <div><i class="bi bi-speedometer2 me-2"></i> Dashboard</div>
        <i class="bi bi-chevron-right"></i>
    </a>

    {{-- MANAJEMEN KONTEN (PENSIL) --}}
    <div class="nav-link-custom" id="editorToggle">
        <div><i class="bi bi-pencil-square me-2"></i> Editor Konten</div>
        <i id="editorIcon" class="bi bi-chevron-right"></i>
    </div>

    <div class="submenu @if(request()->routeIs('admin.products.*') || request()->routeIs('admin.services.*') || request()->routeIs('admin.galleries.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.abouts.*')) show @endif" id="editorSubmenu">
        <a href="{{ route('admin.abouts.index') }}" class="{{ request()->routeIs('admin.abouts.index') ? 'text-neon' : '' }}"><i class="bi bi-person-vcard me-2"></i> Tentang Kami</a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.index') ? 'text-neon' : '' }}"><i class="bi bi-bag-heart me-2"></i> Produk</a>
        <a href="{{ route('admin.services.index') }}" class="{{ request()->routeIs('admin.services.index') ? 'text-neon' : '' }}"><i class="bi bi-activity me-2"></i> Layanan</a>
        <a href="{{ route('admin.galleries.index') }}" class="{{ request()->routeIs('admin.galleries.index') ? 'text-neon' : '' }}"><i class="bi bi-images me-2"></i> Galeri</a>
        <a href="{{ route('admin.testimonials.index') }}" class="{{ request()->routeIs('admin.testimonials.index') ? 'text-neon' : '' }}"><i class="bi bi-chat-quote me-2"></i> Testimoni</a>
    </div>

    {{-- MENU FUNGSIONAL --}}
    <div class="menu-section mt-3">Fungsionalitas</div>

    <a class="nav-link-custom"><i class="bi bi-calendar-check me-2"></i> Reservasi</a>
    <a class="nav-link-custom"><i class="bi bi-people me-2"></i> Pengguna</a>
    <a class="nav-link-custom"><i class="bi bi-gear me-2"></i> Pengaturan Sistem</a>

</nav>

{{-- BOTTOM BUTTONS (Diperbaiki rata tengah) --}}
<div class="mt-auto p-2">
    <div class="menu-section mb-2">Aksi Cepat</div>

    <a href="{{ url('/') }}" class="btn-side primary-amber" target="_blank">
        Lihat Website <i class="bi bi-arrow-up-right-square ms-2"></i>
    </a>

    <form action="{{ route('logout') }}" method="POST">@csrf
        <button class="btn-side outline-subtle w-100">
            <i class="bi bi-box-arrow-right me-2"></i> Log Out
        </button>
    </form>
</div>

</aside>

<main class="main">
    @yield('content')
</main>

<script>
// Logic untuk Submenu Accordion
const editorToggle = document.getElementById("editorToggle");
const submenu = document.getElementById("editorSubmenu");
const icon = document.getElementById("editorIcon");

// Fungsi untuk mengatur ikon berdasarkan status submenu
function setIconState() {
    const isShow = submenu.classList.contains("show");
    if (isShow) {
        icon.classList.remove("bi-chevron-right");
        icon.classList.add("bi-chevron-down");
    } else {
        icon.classList.remove("bi-chevron-down");
        icon.classList.add("bi-chevron-right");
    }
}

// Inisialisasi ikon saat load
document.addEventListener('DOMContentLoaded', setIconState);

editorToggle.onclick = (e) => {
    e.preventDefault();
    submenu.classList.toggle("show");
    setIconState();
};

// Logic untuk Sidebar Toggle di Mobile
document.getElementById("sidebarToggle").onclick = () => {
    document.getElementById("sidebar").classList.toggle("show");
};
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
