<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class VerifyCodeController extends Controller
{
    /**
     * Menampilkan form verifikasi kode.
     */
    public function showVerifyForm(Request $request)
    {
        // Menangkap email dari URL: /verify-code?email=iqbaliqbalnew15286@gmail.com
        $email = $request->query('email');

        // Jika email tidak ada di URL, kita coba ambil dari session (flash data)
        if (!$email) {
            $email = session('email');
        }

        return view('auth.passwords.verify', compact('email'));
    }

    /**
     * Memproses Verifikasi
     */
    public function verifyCode(Request $request)
    {
        // Laravel butuh ini untuk mengecek kode di DB
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6',
        ], [
            'email.required' => 'Email tidak terdeteksi. Silakan kembali ke halaman lupa password.',
            'code.size' => 'Kode harus berjumlah 6 digit.'
        ]);

        $resetCode = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('created_at', '>', now()->subMinutes(10))
            ->first();

        if (!$resetCode) {
            return back()->withErrors(['code' => 'Kode verifikasi salah atau sudah kadaluwarsa.'])->withInput();
        }

        session(['reset_email' => $request->email]);
        return redirect()->route('password.change');
    }

    // ... fungsi ganti password tetap sama ...
}
