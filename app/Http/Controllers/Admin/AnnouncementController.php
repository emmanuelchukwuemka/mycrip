<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;



class AnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $announcements = Announcement::latest()->paginate(10);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.announcements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'link' => 'nullable|url',
            'bg_color' => 'required|string',
            'text_color' => 'required|string',
            'is_active' => 'boolean',
        ]);

        Announcement::create($request->all());

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Announcement $announcement)
    {
        $request->validate([
            'content' => 'required|string|max:255',
            'link' => 'nullable|url',
            'bg_color' => 'required|string',
            'text_color' => 'required|string',
            'is_active' => 'boolean',
        ]);

        $announcement->update($request->all());

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()->route('admin.announcements.index')->with('success', 'Announcement deleted successfully.');
    }

    /**
     * Toggle the active status of the announcement.
     */
    public function toggleStatus(Announcement $announcement)
    {
        $announcement->is_active = !$announcement->is_active;
        $announcement->save();

        $status = $announcement->is_active ? 'put live' : 'removed from live';
        return redirect()->route('admin.announcements.index')->with('success', "Announcement has been {$status}.");
    }
}


