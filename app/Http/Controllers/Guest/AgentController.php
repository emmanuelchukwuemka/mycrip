<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AgentController extends Controller
{
    public function index()
    {
        // Get users with role 'agent'
        // In a real app, you might want to paginate this
        $agents = User::where('role', 'agent')->paginate(12);

        return view('guest.agents.index', compact('agents'));
    }
}
