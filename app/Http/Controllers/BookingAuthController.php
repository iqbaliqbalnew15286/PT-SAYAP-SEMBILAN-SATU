<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Reservation;

class BookingAuthController extends Controller
{
    /**
     * Menampilkan halaman login.
     * Mencegah user yang sudah login mengakses halaman login kembali.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->intended('/booking');
        }
        return view('pages.booking.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/booking')->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function showRegister()
    {
        return view('pages.booking.registrasi');
    }

    /**
     * Proses registrasi user baru
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('booking.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Fitur Password Reset - Menampilkan Halaman Input Email
     */
    public function showReset()
    {
        return view('pages.booking.reset');
    }

    /**
     * Mengirim Link Reset ke Email menggunakan Password Broker
     */
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Menggunakan Password Broker agar fitur "Throttle/Please Wait" terkelola otomatis
        $status = Password::broker()->sendResetLink(
            $request->only('email')
        );

        // Jika berhasil, Laravel mengembalikan 'passwords.sent'
        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        // Jika gagal (Throttle/Email salah), kirim pesan error
        return back()->withErrors(['email' => __($status)]);
    }

    /**
     * Menampilkan Form Password Baru (dari link email)
     */
    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('pages.booking.reset-password')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    /**
     * Proses Update Password Baru ke Database
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('booking.login')->with('success', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Menampilkan Riwayat Booking
     */
    public function riwayat()
    {
        $bookings = Reservation::where('user_id', Auth::id())->latest()->get();
        return view('pages.booking.riwayat', compact('bookings'));
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, max-age=0, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => 'Sun, 02 Jan 1990 00:00:00 GMT',
        ]);
    }
}
