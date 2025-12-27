<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class VerifyCodeController extends Controller
{
    /**
     * Show the verify code form.
     */
    public function showVerifyForm()
    {
        return view('auth.passwords.verify');
    }

    /**
     * Verify the code and redirect to change password form.
     */
    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|size:6',
        ]);

        $resetCode = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('created_at', '>', now()->subMinutes(10))
            ->first();

        if (!$resetCode) {
            return back()->withErrors(['code' => 'Invalid or expired verification code.']);
        }

        // Store email in session for password change
        session(['reset_email' => $request->email]);

        return redirect()->route('password.change');
    }

    /**
     * Show the change password form.
     */
    public function showChangePasswordForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('password.request');
        }

        return view('auth.passwords.change');
    }

    /**
     * Change the password.
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = session('reset_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('password.request');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the reset code
        DB::table('password_reset_codes')->where('email', $email)->delete();

        // Clear session
        session()->forget('reset_email');

        return redirect()->route('login')->with('status', 'Password has been reset successfully.');
    }
}
