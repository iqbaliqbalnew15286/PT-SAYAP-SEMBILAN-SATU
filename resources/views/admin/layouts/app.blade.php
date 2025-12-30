<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title', 'Dashboard - PT Rizqallha Boer Makmur')</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font Awesome & Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --bg-light-main: #F2F4F8;
            --bg-card: #FCFDFE;
            --primary-accent: #FF7518;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-subtle: #DDE1E8;
            --hover-bg: #E7EBF1;
            --active-bg: #DCE0E6;
        }

        body {
            font-family: "Poppins", sans-serif;
            background: var(--bg-light-main);
            color: var(--text-dark);
        }

        *,
        *::before,
        *::after {
            transition: all .25s ease;
        }

        .sidebar {
            width: 260px;
            transform: translateX(-260px);
            transition: transform .3s ease;
            z-index: 2000;
        }

        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
            }
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main {
            margin-left: 0;
            padding: 30px;
        }

        @media (min-width: 992px) {
            .main {
                margin-left: 260px;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar Toggle Button (Mobile) --}}
    <button
        class="lg:hidden fixed top-4 left-4 p-3 rounded-xl bg-[var(--primary-accent)] text-[var(--text-dark)] text-xl z-[3000] shadow-md"
        id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <aside
        class="sidebar fixed top-0 left-0 h-screen flex flex-col p-4 bg-[var(--bg-card)] border-r border-[var(--border-subtle)] shadow-xl lg:shadow-none"
        id="sidebar">

        {{-- BRANDING --}}
        <div
            class="brand p-4 mb-6 rounded-xl border border-[var(--primary-accent)] border-l-4 bg-[var(--bg-card)] shadow-lg">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/img/image.png') }}" alt="Admin Profile"
                    class="w-11 h-11 rounded-xl object-cover shadow-sm">
                <div class="flex flex-col">
                    <div class="font-bold text-[var(--text-dark)] leading-tight text-base">PT RIZQALLAH</div>
                    <small class="text-xs text-[var(--text-muted)] font-medium">Admin Panel Tower</small>
                </div>
            </div>
        </div>

        <nav class="flex-grow overflow-y-auto">

            <div
                class="menu-section text-[var(--text-muted)] text-xs font-extrabold uppercase my-4 mx-2 tracking-wider">
                Menu Utama</div>

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}"
                class="nav-link-custom flex items-center p-3 rounded-xl font-medium mb-1 transition-colors
                @if (request()->routeIs('admin.dashboard')) bg-[var(--active-bg)] text-[var(--text-dark)] font-semibold border-l-4 border-[var(--primary-accent)] pl-3
                @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif">
                <i
                    class="bi bi-speedometer2 me-2 @if (request()->routeIs('admin.dashboard')) text-[var(--primary-accent)] @endif"></i>
                Dashboard
            </a>

            {{-- 1. EDITOR KONTEN (ACCORDION) --}}
            @php
                $editorRoutes = [
                    'admin.products.*',
                    'admin.galleries.*',
                    'admin.testimonials.*',
                    'admin.abouts.*',
                    'admin.partners.*',
                    'admin.facilities.*',
                ];
                $isEditorActive = collect($editorRoutes)->contains(fn($route) => request()->routeIs($route));
            @endphp

            <a class="nav-link-custom flex items-center justify-between p-3 rounded-xl font-medium mb-1 cursor-pointer
                @if ($isEditorActive) bg-[var(--hover-bg)] text-[var(--text-dark)] font-semibold @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif"
                id="editorToggle">
                <div class="flex items-center">
                    <i
                        class="bi bi-pencil-square me-2 @if ($isEditorActive) text-[var(--primary-accent)] @endif"></i>
                    Editor Konten
                </div>
                <i id="editorIcon" class="bi bi-chevron-right text-base text-[var(--text-muted)] transition-all"></i>
            </a>

            <div class="submenu overflow-hidden opacity-0 pl-5 transition-all duration-500 ease-in-out
                @if ($isEditorActive) show max-h-[500px] mb-2 opacity-100 @else max-h-0 @endif"
                id="editorSubmenu">

                <a href="{{ route('admin.abouts.index') }}"
                    class="flex items-center py-2 px-3 my-1 rounded-lg text-sm @if (request()->routeIs('admin.abouts.index')) text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-2 border-[var(--primary-accent)] @else text-[var(--text-muted)] hover:text-[var(--text-dark)] @endif">
                    <i class="bi bi-person-vcard me-2"></i> Tentang Kami
                </a>
                <a href="{{ route('admin.products.index') }}"
                    class="flex items-center py-2 px-3 my-1 rounded-lg text-sm @if (request()->routeIs('admin.products.index')) text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-2 border-[var(--primary-accent)] @else text-[var(--text-muted)] hover:text-[var(--text-dark)] @endif">
                    <i class="bi bi-bag-heart me-2"></i> Produk
                </a>
                <a href="{{ route('admin.galleries.index') }}"
                    class="flex items-center py-2 px-3 my-1 rounded-lg text-sm @if (request()->routeIs('admin.galleries.index')) text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-2 border-[var(--primary-accent)] @else text-[var(--text-muted)] hover:text-[var(--text-dark)] @endif">
                    <i class="bi bi-images me-2"></i> Galeri
                </a>
                <a href="{{ route('admin.testimonials.index') }}"
                    class="flex items-center py-2 px-3 my-1 rounded-lg text-sm @if (request()->routeIs('admin.testimonials.index')) text-[var(--text-dark)] font-medium bg-[var(--active-bg)] border-l-2 border-[var(--primary-accent)] @else text-[var(--text-muted)] hover:text-[var(--text-dark)] @endif">
                    <i class="bi bi-chat-quote me-2"></i> Testimoni
                </a>
                 <a href="{{ route('admin.booking.index') }}"
                    class="flex items-center py-2 px-3 my-1 rounded-lg text-sm text-[var(--text-muted)] hover:text-[var(--text-dark)]">
                    <i class="bi bi-calendar-event me-2"></i> Daftar Booking
                </a>
            </div>


        </nav>

        {{-- BOTTOM BUTTONS --}}
        <div class="mt-auto pt-4 border-t border-[var(--border-subtle)]">
            <a href="{{ url('/') }}"
                class="w-full flex items-center justify-center p-3 rounded-xl font-semibold mb-2 text-[var(--text-dark)] bg-[var(--primary-accent)] hover:bg-[#FF9933] shadow-md transition-all"
                target="_blank">
                Lihat Website <i class="bi bi-arrow-up-right-square ms-2"></i>
            </a>

            <form action="{{ route('logout') }}" method="POST">@csrf
                <button type="submit"
                    class="w-full flex items-center justify-center p-3 rounded-xl font-semibold bg-transparent border border-[var(--border-subtle)] text-[var(--text-muted)] hover:border-[var(--primary-accent)] hover:text-[var(--primary-accent)] transition-all">
                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                </button>
            </form>
        </div>

    </aside>

    <main class="main">
        @yield('content')
    </main>

    <script>
        // Logika Reusable untuk Accordion
        function initAccordion(toggleId, submenuId, iconId) {
            const toggle = document.getElementById(toggleId);
            const submenu = document.getElementById(submenuId);
            const icon = document.getElementById(iconId);

            if (!toggle || !submenu || !icon) return;

            function updateState() {
                const isShow = submenu.classList.contains("show");
                if (isShow) {
                    icon.classList.replace("bi-chevron-right", "bi-chevron-down");
                    toggle.classList.add('bg-[var(--hover-bg)]', 'text-[var(--text-dark)]', 'font-semibold');
                    toggle.querySelector('i:first-child').classList.add("text-[var(--primary-accent)]");
                    submenu.classList.add('max-h-[500px]', 'opacity-100');
                    submenu.classList.remove('max-h-0', 'opacity-0');
                } else {
                    icon.classList.replace("bi-chevron-down", "bi-chevron-right");
                    toggle.classList.remove('bg-[var(--hover-bg)]', 'text-[var(--text-dark)]', 'font-semibold');
                    toggle.querySelector('i:first-child').classList.remove("text-[var(--primary-accent)]");
                    submenu.classList.remove('max-h-[500px]', 'opacity-100');
                    submenu.classList.add('max-h-0', 'opacity-0');
                }
            }

            toggle.onclick = (e) => {
                e.preventDefault();
                submenu.classList.toggle("show");
                updateState();
            };

            // Jalankan saat load untuk mengecek menu aktif
            if (submenu.classList.contains('show')) updateState();
        }

        // Eksekusi untuk kedua menu
        document.addEventListener('DOMContentLoaded', () => {
            initAccordion("editorToggle", "editorSubmenu", "editorIcon");
            initAccordion("authToggle", "authSubmenu", "authIcon");
        });

        // Mobile Sidebar Toggle
        document.getElementById("sidebarToggle").onclick = () => {
            document.getElementById("sidebar").classList.toggle("show");
        };

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById("sidebar");
            const btn = document.getElementById("sidebarToggle");
            if (window.innerWidth < 992 && sidebar.classList.contains('show') && !sidebar.contains(e.target) && !btn
                .contains(e.target)) {
                sidebar.classList.remove('show');
            }
        });
    </script>
</body>

</html>
