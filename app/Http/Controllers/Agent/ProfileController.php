<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('agent.profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:30',
            'license_number' => 'nullable|string|max:100',
            'bio' => 'nullable|string|max:2000',
            'agent_promise' => 'nullable|string|max:500',
            'experience_years' => 'nullable|integer|min:0|max:99',
            'specialties' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|max:5120',
        ]);

        // Update basic info
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->agent_phone = $validated['phone'] ?? $user->agent_phone;
        $user->license_number = $validated['license_number'] ?? null;
        $user->bio = $validated['bio'] ?? null;
        $user->agent_promise = $validated['agent_promise'] ?? null;
        $user->experience_years = $validated['experience_years'] ?? null;
        $user->specialties = $validated['specialties'] ?? null;

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }
            if ($user->agent_image) {
                Storage::disk('public')->delete($user->agent_image);
            }

            $path = $request->file('profile_photo')->store('agent-photos', 'public');
            $user->profile_photo_path = $path;
            $user->agent_image = $path;
        }

        $user->save();

        return redirect()->route('agent.profile.edit')->with('success', 'Profile updated successfully!');
    }
}
