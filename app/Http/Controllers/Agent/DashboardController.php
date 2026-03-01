<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get agent's properties with different statuses
        $properties = $user->properties();
        $totalProperties = $properties->count();
        $approvedProperties = $properties->where('status', 'approved')->count();
        $pendingProperties = $properties->where('status', 'pending')->count();
        $rejectedProperties = $properties->where('status', 'rejected')->count();
        
        // Get recent properties
        $recentProperties = $user->properties()->latest()->take(5)->get();
        
        // Get inquiries for agent's properties
        $inquiries = Inquiry::whereHas('property', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('property')->latest()->take(5)->get();
        
        $newInquiries = $inquiries->where('status', 'new')->count();
        
        // Get subscription information
        $currentSubscription = $user->currentSubscription;
        
        return view('agent.dashboard', compact(
            'user',
            'totalProperties',
            'approvedProperties',
            'pendingProperties',
            'rejectedProperties',
            'recentProperties',
            'inquiries',
            'newInquiries',
            'currentSubscription'
        ));
    }
}
