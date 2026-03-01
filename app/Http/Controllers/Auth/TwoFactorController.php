<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User2FA;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorController extends Controller
{
    protected $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    public function showSetupForm()
    {
        $user = Auth::user();
        $user2fa = $user->user2fa;

        if (!$user2fa) {
            // Generate new 2FA secret
            $secret = $this->google2fa->generateSecretKey();
            $user2fa = User2FA::create([
                'user_id' => $user->id,
                'secret' => $secret,
                'recovery_codes' => $this->generateRecoveryCodes(),
                'enabled' => false,
            ]);
        }

        $qrCodeUrl = $this->google2fa->getQRCodeUrl(
            'MyCrib Africa',
            $user->email,
            $user2fa->secret
        );

        $inlineUrl = $this->google2fa->getQRCodeInline(
            'MyCrib Africa',
            $user->email,
            $user2fa->secret
        );

        return view('auth.2fa.setup', compact('user2fa', 'qrCodeUrl', 'inlineUrl'));
    }

    public function enable(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric|digits:6',
        ]);

        $user = Auth::user();
        $user2fa = $user->user2fa;

        if (!$user2fa) {
            return back()->withErrors(['code' => '2FA not initialized']);
        }

        // Verify the code
        $valid = $this->google2fa->verifyKey($user2fa->secret, $request->code);

        if (!$valid) {
            return back()->withErrors(['code' => 'Invalid authentication code']);
        }

        $user2fa->update(['enabled' => true]);

        return redirect()->route('dashboard')->with('success', 'Two-factor authentication enabled successfully!');
    }

    public function disable(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Invalid password']);
        }

        $user->user2fa()->delete();

        return redirect()->route('dashboard')->with('success', 'Two-factor authentication disabled successfully!');
    }

    public function showRecoveryCodes()
    {
        $user = Auth::user();
        $user2fa = $user->user2fa;

        if (!$user2fa || !$user2fa->enabled) {
            return redirect()->route('2fa.setup');
        }

        return view('auth.2fa.recovery', compact('user2fa'));
    }

    public function regenerateRecoveryCodes(Request $request)
    {
        $request->validate([
            'password' => 'required|string',
        ]);

        $user = Auth::user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Invalid password']);
        }

        $user2fa = $user->user2fa;
        $user2fa->update([
            'recovery_codes' => $this->generateRecoveryCodes()
        ]);

        return back()->with('success', 'Recovery codes regenerated successfully!');
    }

    protected function generateRecoveryCodes()
    {
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = strtoupper(
                substr(str_replace(['/', '+', '='], '', base64_encode(random_bytes(10))), 0, 10)
            );
        }
        return $codes;
    }
}
