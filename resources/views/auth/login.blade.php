<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin - Tower Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <style>
        /* ------------------------------
            TOWER LIGHT MODE - WHITE & GOLD
        -------------------------------*/
        :root {
            --bg-light-main: #F4F6F9;
            /* Latar belakang utama (putih lembut) */
            --bg-card: #FFFFFF;
            /* Latar belakang card/panel (putih bersih) */
            --amber-accent: #FFC300;
            /* Kuning Emas Cerah */
            --text-dark: #1F2937;
            /* Teks utama (Hitam gelap) */
            --text-muted: #6B7280;
            /* Teks sekunder (Abu-abu sedang) */
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-light-main);
            color: var(--text-dark);
        }

        /* Styling Card Info */
        .card-info {
            background-color: var(--bg-card);
            border-radius: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: all .3s ease;
        }

        .card-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        /* Input Field Styling */
        .input-light {
            background-color: #F9FAFB;
            border: 1px solid #D1D5DB;
            color: var(--text-dark);
        }

        .input-light:focus {
            border-color: var(--amber-accent);
            box-shadow: 0 0 0 3px rgba(255, 195, 0, 0.2);
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.7s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Utility untuk tombol password */
        .password-toggle {
            cursor: pointer;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: var(--amber-accent);
        }
    </style>
</head>

<body class="min-h-screen flex">

    {{-- KONTEN UTAMA (FULL LEBAR) --}}
    <div class="flex flex-1 min-h-screen">

        {{-- LEFT PANEL (INFO & STATS) --}}
        <div
            class="hidden md:flex flex-1/2 lg:w-2/3 bg-white p-12 flex-col justify-between fade-in border-r border-gray-100">

            {{-- KONTEN TENGAH: Pembungkus baru untuk memusatkan konten --}}
            <div class="max-w-xl mx-auto w-full h-full flex flex-col justify-between">

                <header class="flex items-center space-x-3 mt-4">
                    <img src="{{ asset('assets/img/logotower.png') }}" alt="Logo" class="w-12 h-12 object-contain">
                    <div class="leading-tight">
                        <p class="text-xl font-bold tracking-tight text-gray-800">PT Sayap Sembilan Satu</p>
                        <p class="text-xs italic" style="color: var(--text-muted);">Premium Telecommunication System</p>
                    </div>
                </header>

                <div class="flex-1 flex flex-col justify-center space-y-8 py-10">

                    {{-- Image Card (Hero) --}}
                    <div class="relative w-full h-[280px] rounded-xl overflow-hidden shadow-xl border border-gray-100">
                        <img src="{{ asset('assets/image/tower.jpg') }}" alt="Hero"
                            class="w-full h-full object-cover opacity-90">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent"></div>

                        <div class="absolute bottom-0 left-0 p-6 text-white">
                            <p class="text-2xl font-bold tracking-wide">Real-Time Monitoring</p>
                            <p class="text-sm mt-1 text-gray-200">Akses Penuh ke Sistem Jaringan</p>
                            <a href="#"
                                class="text-xs font-semibold mt-3 inline-flex items-center hover:underline"
                                style="color: var(--amber-accent);">
                                <i class="fa-solid fa-signal mr-1"></i> Lihat Status Terkini
                            </a>
                        </div>
                    </div>

                    {{-- Info Cards --}}
                    <div class="grid grid-cols-2 gap-4 w-full">
                        <div class="card-info flex items-center p-5 space-x-4 border-l-4"
                            style="border-color: var(--amber-accent);">
                            <i class="fas fa-globe text-2xl" style="color: var(--amber-accent);"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Web Page</p>
                                <a href="/"
                                    class="text-xs font-medium mt-1 inline-flex items-center hover:underline"
                                    style="color: var(--text-muted);">
                                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali ke Website
                                </a>
                            </div>
                        </div>

                        <div class="card-info flex items-center p-5 space-x-4 border-l-4"
                            style="border-color: var(--amber-accent);">
                            <i class="fas fa-headset text-2xl" style="color: var(--amber-accent);"></i>
                            <div>
                                <p class="font-semibold text-gray-800">Support Center</p>
                                <a href="#"
                                    class="text-xs font-medium mt-1 inline-flex items-center hover:underline"
                                    style="color: var(--text-muted);">
                                    <i class="fa-solid fa-phone mr-1"></i> Hubungi Administrator
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="mt-8 text-xs mb-4" style="color: var(--text-muted);">
                    &copy; {{ date('Y') }} Tower Management System. Developed for Premium Telecommunication.
                </footer>
            </div>

        </div>

        {{-- RIGHT PANEL LOGIN FORM --}}
        <div
            class="w-full md:w-1/2 lg:w-1/3 bg-white flex flex-col justify-center px-10 py-16 shadow-2xl relative z-10">

            <div class="max-w-md mx-auto w-full">
                <div class="text-center mb-10">
                    <h1 class="text-4xl font-extrabold mb-2 tracking-tight text-gray-800">
                        <span style="color: var(--amber-accent);">Admin</span> Login
                    </h1>
                    <p class="text-sm" style="color: var(--text-muted);">Akses eksklusif untuk staf dan administrator
                    </p>
                </div>

                {{-- Error Alert --}}
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 text-xs rounded-lg p-3 mb-5 border border-red-300 shadow-md">
                        @foreach ($errors->all() as $error)
                            <div><i class="fas fa-times-circle mr-1"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- FORM --}}
                <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
                    @csrf

                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center" style="color: var(--text-muted);">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input name="email" type="email" value="{{ old('email') }}"
                            class="w-full rounded-lg py-3 pl-12 pr-4 input-light placeholder-gray-400 focus:ring-0"
                            placeholder="Email Administrator" required autofocus>
                    </div>

                    <div class="relative">
                        <span class="absolute inset-y-0 left-4 flex items-center" style="color: var(--text-muted);">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input name="password" id="password_field" type="password"
                            class="w-full rounded-lg py-3 pl-12 pr-12 input-light placeholder-gray-400 focus:ring-0"
                            placeholder="Password" required>
                        {{-- TOMBOL TOGGLE PASSWORD --}}
                        <span class="absolute inset-y-0 right-4 flex items-center text-gray-500 password-toggle"
                            onclick="togglePasswordVisibility()">
                            <i id="toggleIcon" class="fa-solid fa-eye"></i>
                        </span>
                    </div>

                    <div class="flex items-center justify-between text-xs" style="color: var(--text-muted);">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" name="remember" class="h-4 w-4 border-gray-300 rounded"
                                style="color: var(--amber-accent); background-color: #F9FAFB;">
                            <span>Ingat saya</span>
                        </label>
                        <a href="#" class="hover:underline" style="color: var(--text-muted);">Lupa password?</a>
                    </div>

                    <button type="submit"
                        class="w-full py-3 rounded-lg bg-gradient-to-r from-[#FFC300] to-[#FFD700] text-gray-900 font-extrabold text-lg shadow-lg hover:opacity-95 transition-all duration-200 ease-in-out transform hover:scale-[1.005]">
                        LOGIN
                    </button>
                </form>

                <div class="text-center mt-6 text-xs" style="color: var(--text-muted);">
                    Untuk bantuan login, hubungi technical support.
                </div>
            </div>
        </div>

    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById('password_field');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
