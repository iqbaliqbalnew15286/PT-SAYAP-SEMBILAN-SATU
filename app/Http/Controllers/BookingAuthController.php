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
     * Menampilkan halaman login untuk user booking
     */
    public function showLogin()
    {
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
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
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

        return redirect()->route('booking.login')->with('success', 'Registrasi berhasil! Silakan login menggunakan akun Anda.');
    }

    /**
     * Menampilkan Riwayat Booking User
     */
    public function riwayat()
    {
        // Mengambil data booking berdasarkan user_id yang sedang login
        // Diurutkan dari yang terbaru (latest)
        $bookings = Reservation::where('user_id', Auth::id())
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('pages.booking.riwayat', compact('bookings'));
    }

    /**
     * Menyimpan data booking dari AJAX/Form
     */
    public function storeBooking(Request $request)
    {
        $request->validate([
            'services' => 'required|string',
            'total_price' => 'required|numeric',
            'date' => 'required|date',
            'time' => 'required|string',
        ]);

        // Simpan ke database
        $booking = Reservation::create([
            'user_id'    => Auth::id(),
            'name'       => Auth::user()->name,
            'phone'      => Auth::user()->phone ?? '',
            'email'      => Auth::user()->email,
            'date'       => $request->date,
            'time'       => $request->time,
            'note'       => $request->services, // Menyimpan daftar nama layanan
            'total_price'=> $request->total_price, // Menyimpan total biaya
            'status'     => 'pending', // Status awal otomatis pending
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dibuat!',
            'redirect' => route('booking.riwayat')
        ]);
    }

    /**
     * Fitur Password Reset
     */
    public function showReset()
    {
        return view('pages.booking.reset');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset password telah dikirim ke email Anda.')
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('pages.booking.reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
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
            ? redirect()->route('booking.login')->with('success', 'Password berhasil diperbarui. Silakan login.')
            : back()->withErrors(['email' => __($status)]);
    }

    /**
     * Proses Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
