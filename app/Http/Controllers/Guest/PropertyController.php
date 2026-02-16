<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\Inquiry;
use App\Models\SavedProperty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    /**
     * Display a listing of properties with filtering.
     */
    public function index(Request $request)
    {
        $query = Property::approved()->with('images');

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->filled('bedrooms')) {
            $query->where('bedrooms', '>=', $request->bedrooms);
        }

        if ($request->filled('bathrooms')) {
            $query->where('bathrooms', '>=', $request->bathrooms);
        }

        if ($request->filled('furnished')) {
            $query->where('furnished', true);
        }

        // Search by keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Sort
        $sortBy = $request->sort ?? 'latest';
        switch ($sortBy) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }

        $properties = $query->paginate(12)->withQueryString();

        // Get filter options
        $states = Property::approved()->distinct()->pluck('state')->filter()->sort();
        $cities = Property::approved()->distinct()->pluck('city')->filter()->sort();

        return view('guest.properties.index', compact('properties', 'states', 'cities'));
    }

    /**
     * Display a specific property.
     */
    public function show($id)
    {
        $property = Property::with(['images', 'user'])->findOrFail($id);
        
        // Check if user has saved this property
        $isSaved = false;
        if (Auth::check()) {
            $isSaved = SavedProperty::isSaved(Auth::id(), $property->id);
        }

        // Get related properties in same category and location
        $relatedProperties = Property::approved()
            ->where('id', '!=', $property->id)
            ->where(function ($query) use ($property) {
                $query->where('category', $property->category)
                      ->orWhere('city', $property->city);
            })
            ->with('images')
            ->take(4)
            ->get();

        return view('guest.properties.show', compact('property', 'isSaved', 'relatedProperties'));
    }

    /**
     * Display properties by category.
     */
    public function apartments(Request $request)
    {
        return $this->index($request->merge(['category' => 'house_rental']));
    }

    public function houses(Request $request)
    {
        return $this->index($request->merge(['category' => 'house_purchase']));
    }

    public function land(Request $request)
    {
        return $this->index($request->merge(['category' => 'land_purchase']));
    }

    public function commercial(Request $request)
    {
        return $this->index($request->merge(['category' => 'shop_rental']));
    }

    /**
     * Submit an inquiry for a property.
     */
    public function inquiry(Request $request, $propertyId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
        ]);

        $property = Property::findOrFail($propertyId);

        Inquiry::create([
            'property_id' => $property->id,
            'user_id' => Auth::check() ? Auth::id() : null,
            'guest_name' => $request->name,
            'guest_email' => $request->email,
            'guest_phone' => $request->phone,
            'message' => $request->message,
            'status' => 'new',
        ]);

        return back()->with('success', 'Your inquiry has been sent successfully!');
    }

    /**
     * Toggle save/unsave a property.
     */
    public function toggleSave($propertyId)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to save properties.');
        }

        SavedProperty::toggle(Auth::id(), $propertyId);

        return back()->with('success', 'Property saved successfully!');
    }
}
