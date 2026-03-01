<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActivityLog;
use App\Models\Referral;
use Illuminate\Support\Facades\Hash;
use App\Rules\PasswordStrength;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Rate limiting for login attempts
        $throttleKey = $request->ip() . '|' . $credentials['email'];
        $maxAttempts = 5; // 5 attempts
        $decayMinutes = 15; // in 15 minutes

        // Check if user has too many attempts
        if ($this->hasTooManyLoginAttempts($throttleKey, $maxAttempts)) {
            return back()->withErrors([
                'email' => 'Too many login attempts. Please try again in ' . $decayMinutes . ' minutes.',
            ])->withInput($request->only('email'));
        }

        if (Auth::attempt($credentials, $request->has('remember-me'))) {
            $this->clearLoginAttempts($throttleKey);
            $request->session()->regenerate();

            $user = Auth::user();
            $user->update([
                'last_login_at'     => now(),
                'last_login_ip'     => $request->ip(),
                'last_login_device' => substr($request->userAgent(), 0, 255),
            ]);
            ActivityLog::log('login', 'Logged in successfully');

            return $this->authenticated($user);
        }

        $this->incrementLoginAttempts($throttleKey);

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    protected function authenticated($user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'agent') {
            return redirect()->route('agent.dashboard');
        }

        return redirect()->intended('/dashboard');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'confirmed', new PasswordStrength],
            'role' => 'required|in:admin,agent,user',
        ];

        // Add agent-specific validation
        if ($request->role === 'agent') {
            $rules['agent_id_number'] = 'required|string|max:20';
            $rules['agent_phone'] = 'required|string|max:20';
            $rules['agent_image'] = 'nullable|image|max:10240';
            $rules['agent_id_document'] = 'nullable|file|mimes:jpg,jpeg,png,pdf|max:10240';
        }

        $request->validate($rules);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Handle agent-specific fields
        if ($request->role === 'agent') {
            $data['agent_id_number'] = $request->agent_id_number;
            $data['agent_phone'] = $request->agent_phone;
            $data['agent_verification_status'] = 'pending';
            
            // Handle profile picture upload
            if ($request->hasFile('agent_image')) {
                $path = $request->file('agent_image')->store('agent-images', 'public');
                $data['agent_image'] = $path;
            }

            // Handle verification document upload
            if ($request->hasFile('agent_id_document')) {
                $path = $request->file('agent_id_document')->store('agent-documents', 'public');
                $data['agent_id_document'] = $path;
            }
        }

        $user = User::create($data);

        // Handle referral code
        if ($request->query('ref')) {
            $referrer = User::where('referral_code', strtoupper($request->query('ref')))->first();
            if ($referrer && $referrer->id !== $user->id) {
                Referral::create(['referrer_id' => $referrer->id, 'referred_id' => $user->id]);
            }
        }

        Auth::login($user);
        ActivityLog::log('register', 'Account created');

        return $this->authenticated($user);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            ActivityLog::log('logout', 'Logged out');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Determine if the user has too many failed login attempts.
     */
    protected function hasTooManyLoginAttempts(string $key, int $maxAttempts): bool
    {
        $attempts = cache()->get($key, 0);
        return $attempts >= $maxAttempts;
    }

    /**
     * Increment the login attempts for the user.
     */
    protected function incrementLoginAttempts(string $key): void
    {
        $attempts = cache()->get($key, 0);
        cache()->put($key, $attempts + 1, now()->addMinutes(15));
    }

    /**
     * Clear the login locks for the given user credentials.
     */
    protected function clearLoginAttempts(string $key): void
    {
        cache()->forget($key);
    }
}
