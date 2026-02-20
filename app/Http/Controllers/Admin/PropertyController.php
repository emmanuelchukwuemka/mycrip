<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of all properties.
     */
    public function index()
    {
        $properties = Property::with(['user', 'images'])->latest()->paginate(15);
        return view('admin.properties.index', compact('properties'));
    }

    /**
     * Display the specified property.
     */
    public function show($id)
    {
        $property = Property::with(['user', 'images', 'inquiries'])->findOrFail($id);
        return view('admin.properties.show', compact('property'));
    }
    
    /**
     * Verify the specified property.
     */
    public function verify($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['status' => 'approved']);

        return back()->with('success', 'Property verified and is now live.');
    }

    /**
     * Reject the specified property.
     */
    public function reject($id)
    {
        $property = Property::findOrFail($id);
        $property->update(['status' => 'rejected']);

        return back()->with('success', 'Property has been rejected.');
    }
}
