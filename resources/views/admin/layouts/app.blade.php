<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title','Dashboard - PT Sayap Sembilan Satu')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome (untuk ikon) & Bootstrap Icons (untuk ikon utama) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        /* ---------------------------------------------------
            COLOR THEME & BASE STYLES (Menggunakan CSS Variables untuk konsistensi)
        ----------------------------------------------------*/
        :root {
            /* Latar Belakang Diredam/Soft */
            --bg-light-main: #F2F4F8; /* Latar belakang utama (Putih keabu-abuan lembut) */
            --bg-card: #FCFDFE; /* Latar belakang card/sidebar (Putih mendekati bersih) */

            /* Aksen & Teks */
            --primary-accent: #FF8C00; /* Aksen primer (ORANYE/EMAS) */
            --text-dark: #2C3E50; /* Teks utama (BIRU TUA) */
            --text-muted: #7F8C8D; /* Teks sekunder/muted (Abu-abu sedang) */

            /* Border & Hover */
            --border-subtle: #DDE1E8;
            --hover-bg: #E7EBF1;
            --active-bg: #DCE0E6;
        }

        body {
            font-family: "Poppins", sans-serif;
            background: var(--bg-light-main);
            color: var(--text-dark);
        }

        /* Smooth transition for all elements */
        *, *::before, *::after {
            transition: all .25s ease;
        }

        /* ---------------------------------------------------
            SIDEBAR
        ----------------------------------------------------*/
        .sidebar {
            width: 260px;
            /* Menggunakan fixed untuk menempel di samping */
            transform: translateX(-260px); /* Sembunyikan secara default pada mobile */
            transition: transform .3s ease;
            z-index: 2000;
        }

        /* Tampilkan di desktop */
        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
            }
        }

        /* Tampilkan di mobile saat kelas 'show' ditambahkan */
        .sidebar.show {
            transform: translateX(0);
        }

        /* ---------------------------------------------------
            MAIN CONTENT
        ----------------------------------------------------*/
        .main {
            margin-left: 0;
            padding: 30px;
        }
        @media (min-width: 992px) {
            .main {
                margin-left: 260px; /* Jarak untuk sidebar */
            }
        }

        /* Animasi Topbar */
        @keyframes fadeDown {
            from { opacity:0; transform: translateY(-10px); }
            to   { opacity:1; transform: translateY(0); }
        }
        .topbar {
            animation: fadeDown .55s ease;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08); /* Bayangan lembut */
        }
    </style>
</head>

<body>

{{-- Sidebar Toggle Button (Mobile) --}}
<button
    class="lg:hidden fixed top-4 left-4 p-3 rounded-xl bg-[var(--primary-accent)] text-[var(--text-dark)] text-xl z-[3000] shadow-md shadow-[rgba(255,140,0,0.3)]"
    id="sidebarToggle">
    <i class="bi bi-list"></i>
</button>

<aside
    class="sidebar fixed top-0 left-0 h-screen flex flex-col p-4 bg-[var(--bg-card)] border-r border-[var(--border-subtle)] shadow-xl lg:shadow-none"
    id="sidebar">

    {{-- BRANDING / ADMIN BOX --}}
    <div class="brand p-4 mb-6 rounded-xl border border-[var(--primary-accent)] border-l-4 lg:border-l-4 bg-[var(--bg-card)] shadow-lg">
        <div class="flex items-center gap-3">
            {{-- Ganti path logo jika diperlukan --}}
            <img src="{{ asset('assets/img/image.png') }}" alt="Admin Profile" class="w-11 h-11 rounded-xl object-cover shadow-sm">
            <div class="flex flex-col">
                <div class="font-bold text-[var(--text-dark)] leading-tight text-base">PT. RIZQALLAH BOER MAKMUR</div>
                <small class="text-xs text-[var(--text-muted)] font-medium">Admin Panel Tower</small>
            </div>
        </div>
    </div>


    <nav class="flex-grow overflow-y-auto">

        {{-- MENU UTAMA --}}
        <div class="menu-section text-[var(--text-muted)] text-xs font-extrabold uppercase my-4 mx-2 tracking-wider">Menu Utama</div>

        <a href="{{ route('admin.dashboard') }}"
           class="nav-link-custom flex items-center justify-between p-3 rounded-xl font-medium mb-1 transition-colors duration-250
           @if(request()->routeIs('admin.dashboard'))
               bg-[var(--active-bg)] text-[var(--text-dark)] font-semibold border-l-4 border-[var(--primary-accent)] pl-3
           @else
               text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
           @endif">
            <div class="flex items-center">
                <i class="bi bi-speedometer2 me-2 @if(request()->routeIs('admin.dashboard')) text-[var(--primary-accent)] @else text-[var(--text-muted)] @endif"></i>
                Dashboard
            </div>
            <i class="bi bi-chevron-right text-base text-[var(--text-muted)]"></i>
        </a>

        {{-- MANAJEMEN KONTEN (ACCORDION) --}}
        @php
            // Tentukan rute mana yang termasuk dalam submenu Editor Konten
            $editorRoutes = ['admin.products.*', 'admin.services.*', 'admin.galleries.*', 'admin.testimonials.*', 'admin.abouts.*', 'admin.partners.*', 'admin.facilities.*'];
            $isEditorActive = collect($editorRoutes)->contains(fn($route) => request()->routeIs($route));
        @endphp

        <a class="nav-link-custom flex items-center justify-between p-3 rounded-xl font-medium mb-1 cursor-pointer transition-colors duration-250
            @if($isEditorActive) bg-[var(--hover-bg)] text-[var(--text-dark)] font-semibold @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif"
            id="editorToggle">
            <div class="flex items-center">
                <i class="bi bi-pencil-square me-2 @if($isEditorActive) text-[var(--primary-accent)] @else text-[var(--text-muted)] @endif transition-colors duration-250"></i>
                Editor Konten
            </div>
            <i id="editorIcon" class="bi bi-chevron-right text-base text-[var(--text-muted)] transition-all duration-300"></i>
        </a>

        <div class="submenu overflow-hidden opacity-0 pl-5 transition-all duration-500 ease-in-out
            @if($isEditorActive) show max-h-[500px] mb-2 opacity-100 @else max-h-0 @endif"
            id="editorSubmenu">

            <a href="{{ route('admin.abouts.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.abouts.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-person-vcard me-2 @if(request()->routeIs('admin.abouts.index')) text-[var(--primary-accent)] @endif"></i> Tentang Kami
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.products.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-bag-heart me-2 @if(request()->routeIs('admin.products.index')) text-[var(--primary-accent)] @endif"></i> Produk
            </a>
             <a href="{{ route('admin.services.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.services.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-activity me-2 @if(request()->routeIs('admin.services.index')) text-[var(--primary-accent)] @endif"></i> Layanan
            </a>
             <a href="{{ route('admin.galleries.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.galleries.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-images me-2 @if(request()->routeIs('admin.galleries.index')) text-[var(--primary-accent)] @endif"></i> Galeri
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.testimonials.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-chat-quote me-2 @if(request()->routeIs('admin.testimonials.index')) text-[var(--primary-accent)] @endif"></i> Testimoni
            </a>
            <a href="{{ route('admin.partners.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.partners.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-handshake me-2 @if(request()->routeIs('admin.partners.index')) text-[var(--primary-accent)] @endif"></i> Mitra
            </a>
            <a href="{{ route('admin.facilities.index') }}"
               class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-colors duration-200
               @if(request()->routeIs('admin.facilities.index'))
                   text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-3 border-[var(--primary-accent)] pl-4
               @else
                   text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]
               @endif">
                 <i class="bi bi-building me-2 @if(request()->routeIs('admin.facilities.index')) text-[var(--primary-accent)] @endif"></i> Fasilitas
            </a>
        </div>

        {{-- MENU FUNGSIONAL --}}
        <div class="menu-section text-[var(--text-muted)] text-xs font-extrabold uppercase my-4 mx-2 tracking-wider">Fungsionalitas</div>

        <a href="{{ route('admin.testimonials.index') }}" class="nav-link-custom flex items-center p-3 rounded-xl font-medium mb-1 text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]">
            <div class="flex items-center">
                <i class="bi bi-calendar-check me-2 text-[var(--text-muted)] hover:text-[var(--primary-accent)]"></i> Reservasi
            </div>
        </a>
        <a href="{{ route('admin.partners.index') }}" class="nav-link-custom flex items-center p-3 rounded-xl font-medium mb-1 text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]">
            <div class="flex items-center">
                <i class="bi bi-people me-2 text-[var(--text-muted)] hover:text-[var(--primary-accent)]"></i> Pengguna
            </div>
        </a>
        <a href="{{ route('admin.facilities.index') }}" class="nav-link-custom flex items-center p-3 rounded-xl font-medium mb-1 text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)]">
            <div class="flex items-center">
                <i class="bi bi-gear me-2 text-[var(--text-muted)] hover:text-[var(--primary-accent)]"></i> Pengaturan Sistem
            </div>
        </a>

    </nav>

    {{-- BOTTOM BUTTONS --}}
    <div class="mt-auto pt-4 border-t border-[var(--border-subtle)]">
        <div class="menu-section mb-2 text-[var(--text-muted)] text-xs font-extrabold uppercase mx-2 tracking-wider">Aksi Cepat</div>

        <a href="{{ url('/') }}" class="w-full flex items-center justify-center p-3 rounded-xl font-semibold mb-2 text-[var(--text-dark)] bg-[var(--primary-accent)] hover:bg-[#FF9933] shadow-md hover:shadow-lg hover:shadow-[rgba(255,140,0,0.4)] transition-all" target="_blank">
            Lihat Website <i class="bi bi-arrow-up-right-square ms-2"></i>
        </a>

        <form action="{{ route('logout') }}" method="POST">@csrf
            <button type="submit" class="w-full flex items-center justify-center p-3 rounded-xl font-semibold bg-transparent border border-[var(--border-subtle)] text-[var(--text-muted)] hover:border-[var(--primary-accent)] hover:bg-[var(--hover-bg)] hover:text-[var(--primary-accent)] transition-all">
                <i class="bi bi-box-arrow-right me-2"></i> Log Out
            </button>
        </form>
    </div>

</aside>

<main class="main">
    {{-- Konten Topbar dapat diinjeksikan di sini jika diperlukan, atau langsung di child view --}}
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
        const accentColor = 'var(--primary-accent)';
        const darkText = 'var(--text-dark)';
        const mutedText = 'var(--text-muted)';
        const hoverBg = 'var(--hover-bg)';
        const activeBg = 'var(--active-bg)';

        // Tentukan apakah halaman aktif saat ini berada di dalam submenu
        const isPageInSubmenu = submenu.classList.contains('opacity-100');

        if (isShow || isPageInSubmenu) {
            icon.classList.remove("bi-chevron-right");
            icon.classList.add("bi-chevron-down");

            // Pastikan toggle link memiliki tampilan aktif/highlight
            editorToggle.classList.add('bg-[var(--hover-bg)]', 'text-[var(--text-dark)]', 'font-semibold');
            editorToggle.classList.remove('text-[var(--text-muted)]');
            editorToggle.querySelector('i:first-child').classList.add("text-[var(--primary-accent)]");

        } else {
            icon.classList.remove("bi-chevron-down");
            icon.classList.add("bi-chevron-right");

            // Atur kembali ke tampilan default
            editorToggle.classList.remove('bg-[var(--hover-bg)]', 'text-[var(--text-dark)]', 'font-semibold');
            editorToggle.classList.add('text-[var(--text-muted)]');
            editorToggle.querySelector('i:first-child').classList.remove("text-[var(--primary-accent)]");
        }
    }

    // Inisialisasi ikon saat load
    document.addEventListener('DOMContentLoaded', setIconState);

    editorToggle.onclick = (e) => {
        e.preventDefault();

        // Toggle class 'show' pada submenu
        const isCurrentlyShown = submenu.classList.toggle("show");

        // Toggle kelas untuk animasi CSS
        if (isCurrentlyShown) {
            submenu.classList.add('max-h-[500px]', 'opacity-100');
            submenu.classList.remove('max-h-0', 'opacity-0');
        } else {
            submenu.classList.remove('max-h-[500px]', 'opacity-100');
            submenu.classList.add('max-h-0', 'opacity-0');
        }

        setIconState();
    };

    // Logic untuk Sidebar Toggle di Mobile
    document.getElementById("sidebarToggle").onclick = () => {
        document.getElementById("sidebar").classList.toggle("show");
    };

    // Sembunyikan sidebar saat mengklik di luar sidebar di mobile
    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById("sidebar");
        const toggleButton = document.getElementById("sidebarToggle");
        const isClickInsideSidebar = sidebar.contains(event.target);
        const isClickOnToggleButton = toggleButton.contains(event.target);

        if (window.innerWidth < 992 && sidebar.classList.contains('show') && !isClickInsideSidebar && !isClickOnToggleButton) {
            sidebar.classList.remove('show');
        }
    });

</script>
</body>
</html>
