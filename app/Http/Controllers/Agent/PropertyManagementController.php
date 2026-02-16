<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropertyManagementController extends Controller
{
    /**
     * Display a listing of the agent's properties.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->properties();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $properties = $query->with('images')->latest()->paginate(10);

        return view('agent.properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new property.
     */
    public function create()
    {
        return view('agent.properties.create');
    }

    /**
     * Store a newly created property in storage.
     */
    public function store(Request $request)
    {
        // Check if agent is verified
        if (Auth::user()->agent_verification_status !== 'approved') {
            return back()->with('error', 'Your account must be verified before you can list properties.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'category' => 'required|in:house_rental,house_purchase,land_purchase,shop_rental,student_lodge',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:fixed,monthly,yearly',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'toilets' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'furnished' => 'boolean',
            'serviced' => 'boolean',
            'parking' => 'boolean',
            'security' => 'boolean',
            'water_supply' => 'boolean',
            'power_supply' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'images' => 'required|array|min:1',
        ]);

        // Create property
        $property = Property::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'category' => $validated['category'],
            'status' => 'pending', // Properties require approval
            'country' => $validated['country'],
            'state' => $validated['state'],
            'city' => $validated['city'],
            'address' => $validated['address'] ?? null,
            'latitude' => $validated['latitude'] ?? null,
            'longitude' => $validated['longitude'] ?? null,
            'price' => $validated['price'],
            'price_type' => $validated['price_type'],
            'bedrooms' => $validated['bedrooms'] ?? null,
            'bathrooms' => $validated['bathrooms'] ?? null,
            'toilets' => $validated['toilets'] ?? null,
            'size' => $validated['size'] ?? null,
            'furnished' => $request->boolean('furnished'),
            'serviced' => $request->boolean('serviced'),
            'parking' => $request->boolean('parking'),
            'security' => $request->boolean('security'),
            'water_supply' => $request->boolean('water_supply'),
            'power_supply' => $request->boolean('power_supply'),
        ]);

        // Handle image uploads with hash generation
        $duplicateWarnings = [];
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // Generate hash for duplicate detection
                $hash = PropertyImage::generateHash($image);
                
                // Check for duplicate
                if (PropertyImage::hashExists($hash)) {
                    $duplicateWarnings[] = "Image " . ($index + 1) . " appears to be a duplicate and was not uploaded.";
                    continue;
                }
                
                // Store the image
                $path = $image->store('properties/' . $property->id, 'public');
                
                // Create image record
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'image_hash' => $hash,
                    'order' => $index,
                    'is_featured' => $index === 0,
                ]);
                
                // Set first image as featured
                if ($index === 0) {
                    $property->update(['featured_image' => $path]);
                }
            }
        }

        $message = 'Property created successfully! It is pending approval.';
        if (!empty($duplicateWarnings)) {
            $message .= ' Note: ' . implode(' ', $duplicateWarnings);
        }

        return redirect()->route('agent.properties.index')->with('success', $message);
    }

    /**
     * Show the form for editing the specified property.
     */
    public function edit(string $id)
    {
        $property = Auth::user()->properties()->with('images')->findOrFail($id);
        
        return view('agent.properties.edit', compact('property'));
    }

    /**
     * Update the specified property in storage.
     */
    public function update(Request $request, string $id)
    {
        $property = Auth::user()->properties()->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:20',
            'category' => 'required|in:house_rental,house_purchase,land_purchase,shop_rental,student_lodge',
            'country' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|max:50',
            'longitude' => 'nullable|string|max:50',
            'price' => 'required|numeric|min:0',
            'price_type' => 'required|in:fixed,monthly,yearly',
            'bedrooms' => 'nullable|integer|min:0',
            'bathrooms' => 'nullable|integer|min:0',
            'toilets' => 'nullable|integer|min:0',
            'size' => 'nullable|string|max:50',
            'furnished' => 'boolean',
            'serviced' => 'boolean',
            'parking' => 'boolean',
            'security' => 'boolean',
            'water_supply' => 'boolean',
            'power_supply' => 'boolean',
        ]);

        $property->update($validated);

        // If property was rejected, reset to pending for re-approval
        if ($property->status === 'rejected') {
            $property->update(['status' => 'pending']);
        }

        return redirect()->route('agent.properties.index')->with('success', 'Property updated successfully!');
    }

    /**
     * Add more images to an existing property.
     */
    public function addImages(Request $request, string $id)
    {
        $property = Auth::user()->properties()->findOrFail($id);

        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120',
            'images' => 'required|array|min:1',
        ]);

        $duplicateWarnings = [];

        if ($request->hasFile('images')) {
            $currentMaxOrder = $property->images()->max('order') ?? -1;
            
            foreach ($request->file('images') as $index => $image) {
                // Generate hash for duplicate detection
                $hash = PropertyImage::generateHash($image);
                
                // Check for duplicate
                if (PropertyImage::hashExists($hash)) {
                    $duplicateWarnings[] = "Image " . ($index + 1) . " appears to be a duplicate and was not uploaded.";
                    continue;
                }
                
                // Store the image
                $path = $image->store('properties/' . $property->id, 'public');
                
                // Create image record
                PropertyImage::create([
                    'property_id' => $property->id,
                    'image_path' => $path,
                    'image_hash' => $hash,
                    'order' => $currentMaxOrder + $index + 1,
                    'is_featured' => false,
                ]);
            }
        }

        $message = 'Images added successfully!';
        if (!empty($duplicateWarnings)) {
            $message .= ' Note: ' . implode(' ', $duplicateWarnings);
        }

        return back()->with('success', $message);
    }

    /**
     * Remove an image from a property.
     */
    public function deleteImage(string $id, string $imageId)
    {
        $property = Auth::user()->properties()->findOrFail($id);
        $image = $property->images()->findOrFail($imageId);

        // Delete file from storage
        Storage::disk('public')->delete($image->image_path);

        // Delete record
        $image->delete();

        // Update featured image if needed
        if ($property->featured_image === $image->image_path) {
            $firstImage = $property->images()->first();
            $property->update(['featured_image' => $firstImage ? $firstImage->image_path : null]);
        }

        return back()->with('success', 'Image deleted successfully!');
    }

    /**
     * Remove the specified property from storage.
     */
    public function destroy(string $id)
    {
        $property = Auth::user()->properties()->findOrFail($id);

        // Delete all images from storage
        foreach ($property->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }

        $property->delete();

        return redirect()->route('agent.properties.index')->with('success', 'Property deleted successfully!');
    }
}
