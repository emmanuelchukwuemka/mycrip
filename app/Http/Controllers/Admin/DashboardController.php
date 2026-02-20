<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'totalUsers' => User::count(),
            'totalProperties' => Property::count(),
            'verifiedAgents' => User::where('role', 'agent')->where('agent_verification_status', 'approved')->count(),
            'pendingAgents' => User::where('role', 'agent')->where('agent_verification_status', 'pending')->count(),
        ];

        $newestUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'newestUsers'));
    }
}
