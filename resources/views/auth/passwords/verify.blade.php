<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Verifikasi Kode - PT Sayap Sembilan Satu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root { --accent-orange: #FF5F00; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #F8FAFC; }
        .input-light { background-color: #F1F5F9; border: 1px solid #E2E8F0; transition: .2s; }
        .input-light:focus { background-color: #FFFFFF; border-color: var(--accent-orange); outline: none; box-shadow: 0 0 0 4px rgba(255, 95, 0, 0.1); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-md bg-white rounded-2xl p-10 shadow-xl">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-extrabold tracking-tight">Verifikasi <span class="text-orange-500">Kode</span></h1>
            <p class="text-sm text-slate-400 mt-2">Masukkan kode yang dikirim ke:</p>
            <p class="font-bold text-slate-700">{{ request('email') }}</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-100 text-red-600 text-xs rounded-xl p-4 mb-6">
                @foreach ($errors->all() as $error)
                    <div><i class="fa-solid fa-circle-exclamation mr-2"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('password.verify.post') }}">
            @csrf

            <input type="hidden" name="email" value="{{ request('email') }}">

            <div class="space-y-4">
                <div class="space-y-2">
                    <label class="text-[10px] font-bold uppercase text-slate-400">Kode 6 Digit</label>
                    <input type="text" name="code" maxlength="6" required autofocus
                        class="w-full rounded-xl py-4 pl-4 pr-4 input-light text-center tracking-[0.5em] font-bold text-lg"
                        placeholder="••••••">
                </div>

                <button type="submit" class="w-full py-4 bg-orange-500 text-white rounded-xl font-bold uppercase tracking-widest shadow-lg shadow-orange-200 hover:scale-[1.01] transition-all">
                    Verifikasi Sekarang
                </button>
            </div>
        </form>

        <div class="mt-8 text-center">
            <p class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.3em]">Secured by Sayap 91 Node</p>
        </div>
    </div>
</body>
</html>
