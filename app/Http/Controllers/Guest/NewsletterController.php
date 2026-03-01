<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'name'  => 'nullable|string|max:100',
        ]);

        $existing = Newsletter::where('email', $request->email)->first();

        if ($existing) {
            if (!$existing->active) {
                // Resubscribe
                $existing->update(['active' => true, 'unsubscribed_at' => null]);
                return back()->with('success', 'You\'ve been re-subscribed to our newsletter!');
            }
            return back()->with('info', 'You\'re already subscribed.');
        }

        Newsletter::create([
            'email' => $request->email,
            'name'  => $request->name,
            'token' => Str::random(64),
        ]);

        return back()->with('success', 'Thank you for subscribing to MyCrip news and updates!');
    }

    public function unsubscribe(string $token)
    {
        $subscriber = Newsletter::where('token', $token)->firstOrFail();
        $subscriber->unsubscribe();
        return view('guest.newsletter.unsubscribed');
    }
}
