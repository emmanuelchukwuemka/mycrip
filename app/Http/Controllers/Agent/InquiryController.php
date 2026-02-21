<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InquiryController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all inquiries for the agent's properties
        $inquiries = Inquiry::whereHas('property', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('property')->latest()->get();

        $totalInquiries = $inquiries->count();
        $newInquiries = $inquiries->where('status', 'new')->count();
        $readInquiries = $inquiries->where('status', 'read')->count();
        $repliedInquiries = $inquiries->where('status', 'replied')->count();

        return view('agent.inquiries.index', compact(
            'inquiries',
            'totalInquiries',
            'newInquiries',
            'readInquiries',
            'repliedInquiries'
        ));
    }

    public function show($id)
    {
        $user = Auth::user();

        $inquiry = Inquiry::whereHas('property', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('property')->findOrFail($id);

        return view('agent.inquiries.show', compact('inquiry'));
    }
}
