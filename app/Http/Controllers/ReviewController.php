<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a new review.
     */
    public function store(Request $request)
    {
        $request->validate([
            'rating'      => 'required|integer|min:1|max:5',
            'comment'     => 'nullable|string|max:1000',
            'agent_id'    => 'required|exists:users,id',
            'property_id' => 'nullable|exists:properties,id',
        ]);

        // Create the review
        Review::create([
            'reviewer_id' => Auth::id(),
            'agent_id'    => $request->agent_id,
            'property_id' => $request->property_id,
            'rating'      => $request->rating,
            'comment'     => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    /**
     * Delete a review.
     */
    public function destroy(Review $review)
    {
        if ($review->reviewer_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review deleted successfully.');
    }
}
