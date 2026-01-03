<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    /**
     * Menampilkan form login admin.
     */
    public function showLoginForm()
    {
        // Jika sudah login, jangan tampilkan form login, langsung ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        // 1. Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba melakukan login
        // Menggunakan 'remember' agar user tidak cepat ter-logout (mengatasi masalah session expire)
        if (Auth::attempt($credentials, $request->filled('remember'))) {

            // 3. Regenerasi session untuk keamanan (mencegah fixation attack)
            $request->session()->regenerate();

            /**
             * redirect()->intended() sangat penting.
             * Jika admin sebelumnya mengakses /admin/news tapi diminta login dulu,
             * setelah login sukses, dia akan otomatis kembali ke /admin/news.
             */
            return redirect()->intended(route('admin.dashboard'));
        }

        // 4. Jika gagal, kembali dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput($request->only('email'));
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        // Logout dari Guard
        Auth::logout();

        // Hapus semua data session
        $request->session()->invalidate();

        // Bikin token baru agar session lama tidak bisa dipakai lagi (keamanan)
        $request->session()->regenerateToken();

        // Arahkan ke halaman login admin (sesuai route di web.php Anda)
        return redirect()->route('login')->with('success', 'Anda telah berhasil keluar.');
    }

    /**
     * Menampilkan form lupa password (opsional jika dibutuhkan).
     */
    public function showForgotPasswordForm()
    {
        return view('auth.passwords.email');
    }
}