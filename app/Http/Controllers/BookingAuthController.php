<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Message;

class BookingAuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('booking.index');
        }
        return view('pages.booking.login');
    }

    /**
     * Proses login user
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(route('booking.index'))
                ->with('success', 'Selamat datang kembali!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    /**
     * Menampilkan halaman registrasi
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('booking.index');
        }
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

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('booking.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * SIMPAN BOOKING (Method Baru untuk AJAX)
     * Menangani request dari dashboard booking
     */
    public function storeBooking(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'services' => 'required|string',
            'total_price' => 'required|numeric',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal, silakan cek kembali inputan Anda.',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'services' => $request->services,
                'total_price' => $request->total_price,
                'date' => $request->date,
                'time' => $request->time,
                'status' => 'pending',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Booking berhasil disimpan!',
                'data' => $reservation
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal menyimpan ke database: ' . $e->getMessage()
            ], 500);
        }
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
     * Fitur Password Reset
     */
    public function showReset()
    {
        return view('pages.booking.reset');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker()->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function showResetPasswordForm(Request $request, $token = null)
    {
        return view('pages.booking.reset-password')->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

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
     * Chat dengan Admin
     */
    public function chat()
    {
        // Ambil percakapan aktif dengan admin
        $messages = Message::where(function ($q) {
            $q->where('sender_id', auth()->id())->where('receiver_id', 1); // Assuming admin ID is 1
        })->orWhere(function ($q) {
            $q->where('sender_id', 1)->where('receiver_id', auth()->id());
        })->orderBy('created_at', 'asc')->get();

        return view('pages.booking.chat', compact('messages'));
    }

    /**
     * Kirim pesan ke Admin
     */
    public function sendChat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        Message::create([
            'sender_id' => auth()->id(),
            'receiver_id' => 1, // Admin ID
            'message' => $request->message,
            'sender_type' => 'user',
            'is_read' => false,
        ]);

        return back()->with('success', 'Pesan berhasil dikirim!');
    }

    /**
     * Hapus pesan user
     */
    public function deleteMessage($id)
    {
        $message = Message::where('id', $id)->where('sender_id', auth()->id())->firstOrFail();

        if ($message->image) {
            Storage::disk('public')->delete($message->image);
        }

        $message->delete();

        return back()->with('success', 'Pesan berhasil dihapus!');
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
            'Expires' => 'Fri, 01 Jan 1990 00:00:00 GMT',
        ]);
    }
}
