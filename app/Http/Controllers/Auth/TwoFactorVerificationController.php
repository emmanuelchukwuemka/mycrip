<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorVerificationController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function showVerificationForm()
    {
        if (!Auth::check() || !Auth::user()->hasTwoFactorEnabled()) {
            return redirect()->route('login');
        }

        return view('auth.2fa.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $user = Auth::user();
        
        if (!$user || !$user->hasTwoFactorEnabled()) {
            Auth::logout();
            return redirect()->route('login');
        }

        $user2fa = $user->user2fa;
        $code = $request->code;

        // Check if it's a recovery code
        if (strlen($code) === 10 && ctype_alnum($code)) {
            if ($user2fa->isRecoveryCodeValid($code)) {
                $user2fa->invalidateRecoveryCode($code);
                Session::put('2fa_verified_' . $user->id, true);
                $user2fa->update(['last_used_at' => now()]);
                return redirect()->intended('/dashboard');
            }
        }

        // Check if it's a TOTP code
        if (strlen($code) === 6 && is_numeric($code)) {
            $valid = $this->google2fa->verifyKey($user2fa->secret, $code);
            
            if ($valid) {
                Session::put('2fa_verified_' . $user->id, true);
                $user2fa->update(['last_used_at' => now()]);
                return redirect()->intended('/dashboard');
            }
        }

        return back()->withErrors(['code' => 'Invalid authentication code']);
    }

    public function resend()
    {
        // In a real implementation, you might send an email/SMS
        // For now, we'll just redirect back
        return back()->with('resent', 'Verification code resent!');
    }
}
