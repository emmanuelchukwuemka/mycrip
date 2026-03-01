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
        $query = Property::approved()->with(['images', 'user']);

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Location search (broad)
        if ($request->filled('location')) {
            $location = $request->location;
            $query->where(function($q) use ($location) {
                $q->where('city', 'like', '%' . $location . '%')
                  ->orWhere('state', 'like', '%' . $location . '%')
                  ->orWhere('country', 'like', '%' . $location . '%')
                  ->orWhere('address', 'like', '%' . $location . '%');
            });
        } elseif ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        // Price range
        $minPrice = $request->minPrice ?? $request->min_price;
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        $maxPrice = $request->maxPrice ?? $request->max_price;
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
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

        // Amenities (array from Livewire)
        if ($request->filled('amenities') && is_array($request->amenities)) {
            $booleanAmenities = ['pool', 'gym', 'security', 'parking', 'garden', 'wifi', 'serviced', 'power_supply', 'water_supply'];
            foreach ($request->amenities as $amenity) {
                if (in_array($amenity, $booleanAmenities)) {
                    $query->where($amenity, true);
                }
            }
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

        // Featured first, then specific sort
        $query->orderBy('is_featured', 'desc');

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

        // Pre-process properties for the map to avoid redundant accessor calls in the view
        $mapProperties = $properties->map(fn($p) => [
            'id' => $p->id,
            'title' => $p->title,
            'price' => $p->formatted_price,
            'lat' => $p->latitude,
            'lng' => $p->longitude,
            'link' => route('properties.show', $p->id),
            'image' => $p->featured_image_url
        ]);

        // Get filter options
        $countries = Property::approved()->distinct()->pluck('country')->filter()->sort();
        $states = Property::approved()->distinct()->pluck('state')->filter()->sort();
        $cities = Property::approved()->distinct()->pluck('city')->filter()->sort();

        return view('guest.properties.index', compact('properties', 'countries', 'states', 'cities', 'mapProperties'));
    }

    /**
     * Display a specific property.
     */
    public function show($id)
    {
        $property = Property::with(['images', 'user'])->findOrFail($id);

        // Track view count (once per session per property)
        $viewedKey = 'viewed_properties';
        $viewed = session($viewedKey, []);
        if (!in_array($id, $viewed)) {
            $property->increment('view_count');
            $viewed[] = $id;
            session([$viewedKey => array_slice($viewed, -50)]); // keep last 50
        }

        // Track recently viewed (for "Recently Viewed" widget, last 8)
        $recentKey = 'recently_viewed';
        $recent = session($recentKey, []);
        $recent = array_filter($recent, fn($rid) => $rid != $id); // remove if already there
        array_unshift($recent, (int)$id);
        session([$recentKey => array_slice($recent, 0, 8)]);

        // Check if user has saved this property
        $isSaved = false;
        if (Auth::check()) {
            $isSaved = SavedProperty::isSaved(Auth::id(), $property->id);
        }

        // Similar properties: same category + location, ±30% price range
        $similar = Property::approved()
            ->where('id', '!=', $property->id)
            ->where('category', $property->category)
            ->when($property->location, fn($q) => $q->where('location', 'like', '%' . explode(',', $property->location)[0] . '%'))
            ->where('price', '>=', $property->price * 0.7)
            ->where('price', '<=', $property->price * 1.3)
            ->with('images')
            ->take(4)
            ->get();

        // If not enough similar, fall back to same category
        if ($similar->count() < 2) {
            $similar = Property::approved()
                ->where('id', '!=', $property->id)
                ->where('category', $property->category)
                ->with('images')
                ->take(4)
                ->get();
        }

        // Price estimate (median of similar properties)
        $priceEstimate = Property::approved()
            ->where('category', $property->category)
            ->where('id', '!=', $property->id)
            ->avg('price');

        return view('guest.properties.show', compact('property', 'isSaved', 'similar', 'priceEstimate'));
    }

    /**
     * Return map-ready JSON of all active properties with geo data.
     */
    public function mapData()
    {
        $properties = Property::approved()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->with('images')
            ->get(['id','title','price','location','category','latitude','longitude','is_featured']);

        return response()->json($properties->map(fn($p) => [
            'id'       => $p->id,
            'title'    => $p->title,
            'price'    => number_format($p->price),
            'location' => $p->location,
            'category' => $p->category,
            'lat'      => (float) $p->latitude,
            'lng'      => (float) $p->longitude,
            'featured' => (bool) $p->is_featured,
            'url'      => route('properties.show', $p->id),
            'image'    => $p->images->first()?->image_url ?? null,
        ]));
    }

    /**
     * Property map page.
     */
    public function map()
    {
        return view('guest.properties.map');
    }

    /**
     * Property comparison page (up to 3 properties).
     */
    public function compare(Request $request)
    {
        $ids = array_slice((array) $request->input('ids', []), 0, 3);
        $properties = Property::with('images')->findMany($ids);
        return view('guest.properties.compare', compact('properties'));
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
     * List all properties saved by the authenticated user.
     */
    public function savedIndex()
    {
        $user = Auth::user();
        $savedProperties = SavedProperty::where('user_id', $user->id)
            ->with(['property.images', 'property.user'])
            ->latest()
            ->paginate(12);

        return view('guest.properties.saved', compact('savedProperties'));
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
