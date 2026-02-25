<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AgentController extends Controller
{
    public function index()
    {
        $agents = User::where('role', 'agent')
            ->where('agent_verification_status', 'approved')
            ->paginate(12);

        return view('guest.agents.index', compact('agents'));
    }

    public function show(string $id)
    {
        $agent = User::where('role', 'agent')->findOrFail($id);
        $reviews = $agent->reviewsAsAgent()->with('reviewer')->latest()->paginate(10);
        $recentProperties = $agent->properties()->latest()->take(4)->get();

        return view('guest.agents.show', compact('agent', 'reviews', 'recentProperties'));
    }
}
