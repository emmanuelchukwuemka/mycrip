<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\User;
use App\Notifications\NewReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'agent_id' => 'required|exists:users,id',
            'property_id' => 'nullable|exists:properties,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $agent = User::findOrFail($request->agent_id);

        if (!$agent->isAgent()) {
            return back()->with('error', 'You can only review agents.');
        }

        // Check if user has already reviewed this agent
        $existingReview = Review::where('reviewer_id', Auth::id())
            ->where('agent_id', $agent->id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this agent.');
        }

        $review = Review::create([
            'reviewer_id' => Auth::id(),
            'agent_id' => $agent->id,
            'property_id' => $request->property_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Notify the agent
        $agent->notify(new NewReview($review));

        return back()->with('success', 'Your review has been submitted successfully.');
    }
}
