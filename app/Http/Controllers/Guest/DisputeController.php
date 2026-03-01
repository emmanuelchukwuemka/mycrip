<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Dispute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisputeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id'  => 'nullable|exists:properties,id',
            'reason'       => 'required|string|in:' . implode(',', array_keys(Dispute::REASONS)),
            'description'  => 'required|string|min:30|max:2000',
        ]);

        Dispute::create([
            'reporter_id' => Auth::id(),
            'property_id' => $request->property_id,
            'reason'      => $request->reason,
            'description' => $request->description,
        ]);

        return back()->with('success', 'Your report has been submitted. We will review it within 24-48 hours.');
    }

    public function index()
    {
        $disputes = Dispute::where('reporter_id', Auth::id())->orderByDesc('created_at')->paginate(10);
        return view('guest.disputes.index', compact('disputes'));
    }
}
