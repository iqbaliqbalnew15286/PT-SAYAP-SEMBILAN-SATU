<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/image.png') }}">
    <title>@yield('title', 'Dashboard - PT Rizqallah Boer Makmur')</title>

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
            z-index: 2000;
        }

        @media (min-width: 992px) {
            .sidebar {
                transform: translateX(0);
            }

            .main {
                margin-left: 260px;
            }
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main {
            padding: 30px;
        }

        nav::-webkit-scrollbar {
            width: 4px;
        }

        nav::-webkit-scrollbar-thumb {
            background: var(--border-subtle);
            border-radius: 10px;
        }
    </style>
</head>

<body>

    {{-- Mobile Toggle --}}
    <button
        class="lg:hidden fixed top-4 left-4 p-3 rounded-xl bg-[var(--primary-accent)] text-white text-xl z-[3000] shadow-lg"
        id="sidebarToggle">
        <i class="bi bi-list"></i>
    </button>

    <aside
        class="sidebar fixed top-0 left-0 h-screen flex flex-col p-4 bg-[var(--bg-card)] border-r border-[var(--border-subtle)] shadow-xl lg:shadow-none transition-transform duration-300"
        id="sidebar">

        {{-- BRANDING --}}
        <div
            class="brand p-4 mb-6 rounded-xl border border-[var(--primary-accent)] border-l-4 bg-[var(--bg-card)] shadow-md">
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/img/image.png') }}" alt="Logo" class="w-10 h-10 rounded-lg object-cover">
                <div class="flex flex-col">
                    <div class="font-bold text-[var(--text-dark)] leading-tight text-sm uppercase">PT RIZQALLAH</div>
                    <small class="text-[10px] text-[var(--text-muted)] font-bold tracking-widest uppercase">Admin Tower</small>
                </div>
            </div>
        </div>

        <nav class="flex-grow overflow-y-auto pr-2">
            <div
                class="menu-section text-[var(--text-muted)] text-[10px] font-black uppercase my-4 mx-2 tracking-[2px]">
                Menu Utama
            </div>

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center p-3 rounded-xl font-medium mb-1 transition-all
                @if (request()->routeIs('admin.dashboard')) bg-[var(--active-bg)] text-[var(--text-dark)] border-l-4 border-[var(--primary-accent)] pl-3 @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif">
                <i
                    class="bi bi-grid-1x2-fill me-3 @if (request()->routeIs('admin.dashboard')) text-[var(--primary-accent)] @endif"></i>
                Dashboard
            </a>

            {{-- EDITOR KONTEN --}}
            @php
                $editorRoutes = [
                    'admin.abouts.*',
                    'admin.news.*',
                    'admin.products.*',
                    'admin.galleries.*',
                    'admin.partners.*',
                    'admin.testimonials.*',
                    'admin.feedbacks.*',
                    'admin.booking.index',
                ];
                $isEditorActive = collect($editorRoutes)->contains(fn($route) => request()->routeIs($route));
            @endphp

            <div class="mb-1">
                <button
                    class="w-full flex items-center justify-between p-3 rounded-xl font-medium transition-all outline-none
                    @if ($isEditorActive) bg-[var(--hover-bg)] text-[var(--text-dark)] @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif"
                    id="editorToggle">
                    <div class="flex items-center">
                        <i
                            class="bi bi-pencil-square me-3 @if ($isEditorActive) text-[var(--primary-accent)] @endif"></i>
                        Editor Konten
                    </div>
                    <i id="editorIcon"
                        class="bi bi-chevron-right text-xs transition-transform @if ($isEditorActive) rotate-90 @endif"></i>
                </button>

                <div class="submenu overflow-hidden transition-all duration-300 ease-in-out pl-4
                @if ($isEditorActive) max-h-[1000px] opacity-100 mt-2 @else max-h-0 opacity-0 @endif"
                    id="editorSubmenu">

                    @php
                        $submenus = [
                            ['route' => 'admin.abouts.index', 'icon' => 'bi-info-circle', 'label' => 'Tentang Kami'],
                            ['route' => 'admin.news.index', 'icon' => 'bi-newspaper', 'label' => 'Berita & Artikel'],
                            ['route' => 'admin.products.index', 'icon' => 'bi-box-seam', 'label' => 'Produk & Jasa'],
                            ['route' => 'admin.galleries.index', 'icon' => 'bi-images', 'label' => 'Galeri Foto'],
                            ['route' => 'admin.partners.index', 'icon' => 'bi-hand-thumbs-up', 'label' => 'Mitra Kerja'],
                            ['route' => 'admin.testimonials.index', 'icon' => 'bi-chat-quote', 'label' => 'Testimoni'],
                            ['route' => 'admin.feedbacks.index', 'icon' => 'bi-envelope-paper', 'label' => 'Feedback'],
                            ['route' => 'admin.booking.index', 'icon' => 'bi-calendar2-check', 'label' => 'Daftar Booking'],
                        ];
                    @endphp

                    @foreach ($submenus as $menu)
                        <a href="{{ Route::has($menu['route']) ? route($menu['route']) : '#' }}"
                            class="flex items-center py-2 px-3 my-1 rounded-lg text-sm transition-all
                        @if (request()->routeIs($menu['route']) || request()->is(str_replace('.index', '', $menu['route']) . '/*')) text-[var(--text-dark)] font-semibold bg-[var(--active-bg)] border-l-2 border-[var(--primary-accent)]
                        @else
                            text-[var(--text-muted)] hover:text-[var(--text-dark)] @endif">
                            <i class="{{ $menu['icon'] }} me-3"></i> {{ $menu['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- USERS --}}
            <a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : '#' }}"
                class="flex items-center p-3 rounded-xl font-medium mb-1 transition-all
                @if (request()->routeIs('admin.users.index')) bg-[var(--active-bg)] text-[var(--text-dark)] border-l-4 border-[var(--primary-accent)] pl-3 @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif">
                <i
                    class="bi bi-people-fill me-3 @if (request()->routeIs('admin.users.index')) text-[var(--primary-accent)] @endif"></i>
                Kelola Users
            </a>

            {{-- SEPARATOR KOMUNIKASI --}}
            <div class="menu-section text-[var(--text-muted)] text-[10px] font-black uppercase my-4 mx-2 tracking-[2px]">
                Komunikasi
            </div>

            {{-- CHAT BOOKING (Logika: Menuju Halaman Index Chat / Inbox) --}}
            <a href="{{ route('admin.booking.index') }}"
                class="flex items-center p-3 rounded-xl font-medium mb-1 transition-all
                @if (request()->routeIs('admin.booking.chat*')) bg-[var(--active-bg)] text-[var(--text-dark)] border-l-4 border-[var(--primary-accent)] pl-3 @else text-[var(--text-muted)] hover:bg-[var(--hover-bg)] hover:text-[var(--text-dark)] @endif">
                <i class="bi bi-chat-dots-fill me-3 @if (request()->routeIs('admin.booking.chat*')) text-[var(--primary-accent)] @endif"></i>
                Chat Booking
            </a>
        </nav>

        {{-- BOTTOM BUTTONS --}}
        <div class="mt-auto pt-4 border-t border-[var(--border-subtle)] space-y-2">
            <a href="{{ url('/') }}"
                class="w-full flex items-center justify-center p-3 rounded-xl font-bold text-white bg-[var(--primary-accent)] hover:brightness-110 shadow-lg transition-all text-xs uppercase tracking-wider"
                target="_blank">
                Lihat Website <i class="bi bi-box-arrow-up-right ms-2"></i>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center p-3 rounded-xl font-bold bg-white border border-[var(--border-subtle)] text-[var(--text-muted)] hover:border-red-500 hover:text-red-500 transition-all text-xs uppercase tracking-wider">
                    <i class="bi bi-power me-2"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <main class="main">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editorToggle = document.getElementById('editorToggle');
            const editorSubmenu = document.getElementById('editorSubmenu');
            const editorIcon = document.getElementById('editorIcon');

            editorToggle.addEventListener('click', () => {
                const isClosed = editorSubmenu.classList.contains('max-h-0');

                if (isClosed) {
                    editorSubmenu.classList.remove('max-h-0', 'opacity-0');
                    editorSubmenu.classList.add('max-h-[1000px]', 'opacity-100', 'mt-2');
                    editorIcon.classList.add('rotate-90');
                } else {
                    editorSubmenu.classList.add('max-h-0', 'opacity-0');
                    editorSubmenu.classList.remove('max-h-[1000px]', 'opacity-100', 'mt-2');
                    editorIcon.classList.remove('rotate-90');
                }
            });

            // Mobile Sidebar Toggle
            const sidebarToggle = document.getElementById("sidebarToggle");
            const sidebar = document.getElementById("sidebar");

            sidebarToggle.onclick = (e) => {
                e.stopPropagation();
                sidebar.classList.toggle("show");
            };

            document.addEventListener('click', (e) => {
                if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>
