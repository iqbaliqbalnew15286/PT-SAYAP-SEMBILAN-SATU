<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password salah sesuai database.'
        ])->onlyInput('email');
    }

    // Menampilkan form verifikasi (setelah user input email di forgot password)
    public function showVerifyForm(Request $request)
    {
        // Ambil email dari kiriman halaman sebelumnya
        $email = $request->email;

        if (!$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Sesi habis, silakan masukkan email kembali.']);
        }

        return view('auth.passwords.verify', compact('email'));
    }

    // Proses Verifikasi Kode 6 Digit
    public function verifyCode(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'code'  => 'required|string|size:6',
        ]);

        // Cek kode di tabel password_resets (asumsi kode disimpan di kolom token)
        $is_valid = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->code)
            ->first();

        if ($is_valid) {
            // Jika kode benar, lanjut ke halaman ganti password baru
            return redirect()->route('password.reset', [
                'token' => $request->code,
                'email' => $request->email
            ]);
        }

        return back()->withErrors(['code' => 'Kode verifikasi salah atau sudah kadaluwarsa.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
