<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        if (Auth::attempt($credentials, $request->has('remember-me'))) {
            $request->session()->regenerate();

            return $this->authenticated(Auth::user());
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
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
            'password' => 'required|string|min:8|confirmed',
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

        Auth::login($user);

        return $this->authenticated($user);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
