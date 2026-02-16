<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index');
    }

    public function show($id)
    {
        // View property details
    }
    
    public function verify($id)
    {
        // Logic to verify property
        return back()->with('success', 'Property verified successfully.');
    }

    public function reject($id)
    {
        // Logic to reject property
        return back()->with('success', 'Property rejected.');
    }
}
