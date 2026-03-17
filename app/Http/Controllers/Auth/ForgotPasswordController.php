<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

use App\Models\User;
use App\Mail\PasswordResetOtp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
            return back()->withErrors(['email' => 'We can\'t find a user with that email address.']);
        }

        // Generate 6-digit OTP
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in database
        DB::table('password_reset_codes')->updateOrInsert(
            ['email' => $request->email],
            [
                'code' => $code,
                'created_at' => Carbon::now()
            ]
        );

        // Send email
        Mail::to($request->email)->send(new PasswordResetOtp($code));

        return redirect()->route('password.otp.verify', ['email' => $request->email])
            ->with('status', 'A verification code has been sent to your email.');
    }

    public function showOtpForm(Request $request)
    {
        return view('auth.passwords.otp', ['email' => $request->email]);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|size:6',
        ]);

        $record = DB::table('password_reset_codes')
            ->where('email', $request->email)
            ->where('code', $request->code)
            ->where('created_at', '>', Carbon::now()->subMinutes(60))
            ->first();

        if (!$record) {
            return back()->withErrors(['code' => 'Invalid or expired verification code.']);
        }

        // Store email in session for the reset form
        session(['reset_email' => $request->email]);

        // Delete the code after verification
        DB::table('password_reset_codes')->where('email', $request->email)->delete();

        return redirect()->route('password.reset', ['token' => 'otp-verified']);
    }
}
