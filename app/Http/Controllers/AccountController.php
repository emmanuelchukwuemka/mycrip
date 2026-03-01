<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Privacy settings dashboard */
    public function privacy()
    {
        $user = Auth::user();
        return view('account.privacy', compact('user'));
    }

    /** Download a JSON export of all user data */
    public function export()
    {
        $user = Auth::user()->load([
            'properties',
            'savedProperties.property',
            'inquiries',
            'activityLogs',
            'subscriptions',
            'savedSearches',
            'tickets',
        ]);

        $data = [
            'user'             => $user->only(['name','email','role','created_at']),
            'properties'       => $user->properties->toArray(),
            'saved_properties' => $user->savedProperties->map(fn($s) => $s->property?->only(['title','location','price']))->filter()->values()->toArray(),
            'inquiries'        => $user->inquiries->toArray(),
            'saved_searches'   => $user->savedSearches->toArray(),
            'subscriptions'    => $user->subscriptions->toArray(),
            'activity_log'     => $user->activityLogs->take(200)->toArray(),
        ];

        ActivityLog::log('data_export', 'Downloaded personal data export');

        return response()->json($data, 200, [
            'Content-Disposition' => 'attachment; filename="mycrip-data-export.json"',
            'Content-Type'        => 'application/json',
        ]);
    }

    /** Activity log paginated view */
    public function activity()
    {
        $logs = Auth::user()->activityLogs()->paginate(25);
        return view('account.activity', compact('logs'));
    }

    /** Show account deletion confirmation form */
    public function deleteShow()
    {
        return view('account.delete');
    }

    /** Process account deletion */
    public function deleteAccount(Request $request)
    {
        $request->validate(['password' => 'required|string']);

        $user = Auth::user();

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Incorrect password.']);
        }

        ActivityLog::log('account_deletion', 'Account deletion initiated');

        // Soft-delete: anonymise the user but keep the record for data integrity
        $user->update([
            'name'               => 'Deleted User',
            'email'              => 'deleted_' . $user->id . '_' . time() . '@deleted.mycrip.com',
            'password'           => '',
            'account_deleted'    => true,
            'account_deleted_at' => now(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Your account has been deleted.');
    }

    /** Session / Security overview */
    public function security()
    {
        $user         = Auth::user();
        $recentLogins = $user->activityLogs()->where('action', 'login')->take(10)->get();
        return view('account.security', compact('user', 'recentLogins'));
    }

    /** Submit feedback */
    public function feedback(Request $request)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'message' => 'nullable|string|max:1000',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'rating'  => $request->rating,
            'message' => $request->message,
            'page'    => $request->header('Referer'),
        ]);

        return back()->with('success', 'Thank you for your feedback!');
    }
}
