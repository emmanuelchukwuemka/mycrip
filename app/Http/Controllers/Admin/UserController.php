<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function show($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Verify an agent.
     */
    public function verify($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->update(['agent_verification_status' => 'approved']);

        return back()->with('success', "Agent {$user->name} has been verified.");
    }

    /**
     * Reject an agent.
     */
    public function reject($id)
    {
        $user = \App\Models\User::findOrFail($id);
        $user->update(['agent_verification_status' => 'rejected']);

        return back()->with('success', "Agent {$user->name} verification rejected.");
    }

    public function destroy($id)
    {
        // Delete user logic
        return back()->with('success', 'User deleted successfully.');
    }
}
