<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\PropertyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyRequestController extends Controller
{
    /**
     * Display a listing of the property requests.
     */
    public function index()
    {
        $requests = PropertyRequest::with('user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(12);

        return view('guest.requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new property request.
     */
    public function create()
    {
        return view('guest.requests.create');
    }

    /**
     * Store a newly created property request in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|in:apartment,house,land,commercial',
            'location' => 'required|string|max:255',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0|gte:min_price',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'description' => 'required|string|min:20',
        ]);

        PropertyRequest::create([
            'user_id' => Auth::id(),
            'category' => $request->category,
            'location' => $request->location,
            'min_price' => $request->min_price,
            'max_price' => $request->max_price,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'description' => $request->description,
        ]);

        return redirect()->route('requests.index')->with('success', 'Your request has been posted on the Buyer Wall!');
    }
}
