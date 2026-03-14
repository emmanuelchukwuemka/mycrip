<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the privacy policy page.
     */
    public function privacyPolicy()
    {
        return view('guest.privacy-policy');
    }

    /**
     * Display the about us page.
     */
    public function aboutUs()
    {
        // Fetch real statistics from DB
        $activeProperties = \App\Models\Property::where('status', 'active')->count(); // Or approved, depending on system
        $verifiedAgents = \App\Models\User::where('role', 'agent')->where('agent_verification_status', 'approved')->count();

        return view('guest.pages.about', [
            'activePropertiesCount' => $activeProperties,
            'verifiedAgentsCount' => $verifiedAgents,
        ]);
    }
}
