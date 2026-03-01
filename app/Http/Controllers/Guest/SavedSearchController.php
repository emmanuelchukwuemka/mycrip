<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use App\Models\SavedSearch;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedSearchController extends Controller
{

    public function index()
    {
        $searches = Auth::user()->savedSearches()->orderByDesc('created_at')->get();
        return view('guest.saved-searches.index', compact('searches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:100',
            'alert_email' => 'boolean',
            'filters'     => 'required|array',
        ]);

        Auth::user()->savedSearches()->create([
            'name'        => $request->name,
            'filters'     => $request->filters,
            'alert_email' => $request->boolean('alert_email'),
        ]);

        return back()->with('success', 'Search saved! ' . ($request->boolean('alert_email') ? 'We will email you when new matches appear.' : ''));
    }

    public function destroy(SavedSearch $savedSearch)
    {
        if ($savedSearch->user_id !== Auth::id()) abort(403);
        $savedSearch->delete();
        return back()->with('success', 'Saved search removed.');
    }
}
