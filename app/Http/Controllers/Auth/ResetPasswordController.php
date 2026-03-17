<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    protected $redirectTo = '/dashboard';

    public function showResetForm(Request $request, $token = null)
    {
        $email = $request->email ?: session('reset_email');
        
        if ($token === 'otp-verified' && !$email) {
            return redirect()->route('password.request')->withErrors(['email' => 'Session expired. Please request a new code.']);
        }

        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        if ($request->token === 'otp-verified') {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return back()->withErrors(['email' => 'User not found.']);
            }

            $user->forceFill([
                'password' => Hash::make($request->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
            
            // Clear session
            session()->forget('reset_email');

            return redirect($this->redirectTo)->with('status', 'Your password has been reset successfully.');
        }

        // Fallback to default Laravel token logic if needed
        $response = Password::broker()->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $response == Password::PASSWORD_RESET
                    ? redirect($this->redirectTo)->with('status', __($response))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($response)]);
    }
}
