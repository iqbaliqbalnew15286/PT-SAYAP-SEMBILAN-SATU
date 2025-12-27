<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        // Generate 6-digit code
        $code = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store code in database with expiration (10 minutes)
        DB::table('password_reset_codes')->updateOrInsert(
            ['email' => $request->email],
            [
                'code' => $code,
                'created_at' => now(),
                'expires_at' => now()->addMinutes(10)
            ]
        );

        // Send email with code
        try {
            Mail::raw("Kode reset password Anda: {$code}\n\nKode ini akan kadaluarsa dalam 10 menit.", function ($message) use ($request) {
                $message->to($request->email)
                    ->subject('Kode Reset Password - PT Sayap Sembilan Satu');
            });

            return redirect()->route('password.verify')->with('status', 'Kode reset password telah dikirim ke email Anda.');
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi.']);
        }
    }
}
