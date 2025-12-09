<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login Admin - Bidan Fina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
        }
        .info-card {
            transition: all .3s ease;
            backdrop-filter: blur(8px);
        }
        .info-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .fade-in {
            animation: fadeIn 0.7s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="min-h-screen flex bg-gray-100">

    {{-- LEFT PANEL --}}
    <div class="hidden md:flex flex-1 bg-gradient-to-br from-[#e5e5e5] to-[#f8f8f8] flex-col justify-between fade-in">
        <header class="flex items-center justify-between px-10 py-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('assets/logo/amaliah.png') }}" alt="Logo" class="w-14 h-14 object-contain drop-shadow-md">
                <div class="leading-tight">
                    <p class="text-gray-900 text-base font-semibold">Bidan Fina</p>
                    <p class="text-xs italic text-gray-600">Service for Mom & Baby</p>
                </div>
            </div>
        </header>

        <div class="flex-1 flex flex-col items-center justify-center space-y-8 p-8">
            <div class="relative w-full max-w-2xl h-[260px] rounded-3xl overflow-hidden shadow-xl">
                <img src="{{ asset('assets/image/DroneView.jpg') }}" alt="Hero" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 text-white">
                    <p class="text-lg font-semibold tracking-wide">Pelayanan Terbaik untuk Bunda & Bayi</p>
                    <p class="text-xs mt-1 opacity-90">Bidan Fina</p>
                    <a href="#" class="text-xs font-bold text-[#4ED400] mt-3 inline-flex items-center hover:underline transition-all">
                        <i class="fa-solid fa-calendar-check mr-1"></i> Reservasi Sekarang
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 w-full max-w-2xl">
                <div class="info-card flex items-center p-6 bg-white/80 border border-gray-200 rounded-2xl shadow-md space-x-4">
                    <i class="fas fa-globe text-3xl text-[#4ED400]"></i>
                    <div>
                        <p class="font-bold text-gray-800">Web Page</p>
                        <p class="text-xs text-gray-600">Kembali ke halaman utama</p>
                        <a href="/" class="text-xs font-semibold text-[#4ED400] mt-1 inline-flex items-center hover:underline">
                            <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="info-card flex items-center p-6 bg-white/80 border border-gray-200 rounded-2xl shadow-md space-x-4">
                    <i class="fas fa-headset text-3xl text-[#4ED400]"></i>
                    <div>
                        <p class="font-bold text-gray-800">Contact Admin</p>
                        <p class="text-xs text-gray-600">Hubungi admin / tim IT</p>
                        <a href="#" class="text-xs font-semibold text-[#4ED400] mt-1 inline-flex items-center hover:underline">
                            <i class="fa-solid fa-phone mr-1"></i> Hubungi
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- RIGHT PANEL LOGIN --}}
    <div class="w-full max-w-md bg-gradient-to-br from-[#1e1e1e] to-[#2b2b2b] flex flex-col justify-center px-10 py-16 mx-auto text-white fade-in">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-extrabold mb-2 text-white">Login Admin</h1>
            <p class="text-gray-400 text-sm">Masukkan email & password untuk mengakses dashboard</p>
        </div>

        {{-- Error --}}
        @if ($errors->any())
            <div class="bg-red-500 text-white text-xs rounded-lg p-3 mb-5 shadow-md">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- FORM --}}
        <form method="POST" action="{{ route('login.post') }}" class="space-y-6">
            @csrf

            <div class="relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                    <i class="fa-solid fa-envelope"></i>
                </span>
                <input name="email" type="email" value="{{ old('email') }}"
                    class="w-full rounded-xl py-4 pl-12 pr-4 bg-[#3A3A3A] text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4ED400]"
                    placeholder="admin@bidanfina.com" required autofocus>
            </div>

            <div class="relative">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">
                    <i class="fa-solid fa-lock"></i>
                </span>
                <input name="password" type="password"
                    class="w-full rounded-xl py-4 pl-12 pr-4 bg-[#3A3A3A] text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#4ED400]"
                    placeholder="password" required>
            </div>

            <div class="flex items-center justify-between text-xs text-gray-300">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="remember" class="h-4 w-4 text-[#4ED400] border-gray-500 focus:ring-[#4ED400]">
                    <span>Ingat saya</span>
                </label>
                <a href="#" class="hover:underline text-[#4ED400]">Lupa password?</a>
            </div>

            <button type="submit"
                class="w-full py-3 rounded-xl bg-[#4ED400] text-black font-extrabold text-lg shadow-lg hover:opacity-95 hover:scale-[1.02] transition-transform">
                Login Sekarang
            </button>
        </form>

        <div class="text-center mt-8 text-xs text-gray-400">
            <span>Belum memiliki akun? Hubungi administrator.</span>
        </div>
    </div>

</body>
</html>
