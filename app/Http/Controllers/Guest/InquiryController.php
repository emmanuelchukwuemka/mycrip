<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    /**
     * List all inquiries made by the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();
        $inquiries = Inquiry::where('user_id', $user->id)
            ->with('property.images')
            ->latest()
            ->paginate(10);

        return view('guest.inquiries.index', compact('inquiries'));
    }

    /**
     * Display a specific inquiry.
     */
    public function show($id)
    {
        $user = Auth::user();
        $inquiry = Inquiry::where('user_id', $user->id)
            ->with(['property.images', 'property.user'])
            ->findOrFail($id);

        return view('guest.inquiries.show', compact('inquiry'));
    }
}
