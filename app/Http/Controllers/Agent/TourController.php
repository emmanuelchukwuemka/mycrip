<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TourController extends Controller
{
    /**
     * Display a listing of the tours.
     */
    public function index()
    {
        $tours = Tour::whereHas('property', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['property', 'user'])
        ->latest()
        ->paginate(15);

        return view('agent.tours.index', compact('tours'));
    }

    /**
     * Update the status of a tour request.
     */
    public function updateStatus(Request $request, Tour $tour)
    {
        if ($tour->property->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $tour->update(['status' => $validated['status']]);

        // Optional: Send notification to the user who booked the tour

        return back()->with('success', "Tour status updated to {$validated['status']}.");
    }
}
