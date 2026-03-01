<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyDocumentController extends Controller
{

    public function store(Request $request, Property $property)
    {
        if ($property->user_id !== Auth::id()) abort(403);

        $request->validate([
            'type'     => 'required|string|in:' . implode(',', array_keys(PropertyDocument::TYPES)),
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240',
        ]);

        $path = $request->file('document')->store('property-documents', 'public');
        $name = $request->file('document')->getClientOriginalName();

        PropertyDocument::create([
            'property_id' => $property->id,
            'type'        => $request->type,
            'file_path'   => $path,
            'file_name'   => $name,
        ]);

        return back()->with('success', 'Document uploaded and pending verification.');
    }

    public function destroy(Property $property, PropertyDocument $document)
    {
        if ($property->user_id !== Auth::id()) abort(403);
        \Illuminate\Support\Facades\Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return back()->with('success', 'Document removed.');
    }
}
