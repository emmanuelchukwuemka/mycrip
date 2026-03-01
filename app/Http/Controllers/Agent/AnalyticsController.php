<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Property;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        // Properties this agent owns
        $properties = Property::where('user_id', $user->id)->get();
        $propertyIds = $properties->pluck('id');

        // Total views
        $totalViews = $properties->sum('view_count');

        // Inquiries this month vs last
        $thisMonth = \App\Models\Inquiry::whereIn('property_id', $propertyIds)
            ->whereMonth('created_at', now()->month)->count();
        $lastMonth = \App\Models\Inquiry::whereIn('property_id', $propertyIds)
            ->whereMonth('created_at', now()->subMonth()->month)->count();

        // Top performing properties
        $topProperties = $properties->sortByDesc('view_count')->take(5);

        // Inquiry conversion rate: inquiries / views
        $conversionRate = $totalViews > 0 ? round(($thisMonth / max($totalViews, 1)) * 100, 1) : 0;

        // Monthly views per property (last 6 months) - simplified view_count snapshot
        $monthlyData = Property::where('user_id', $user->id)
            ->selectRaw("strftime('%Y-%m', created_at) as month, SUM(view_count) as views")
            ->groupBy('month')
            ->orderBy('month')
            ->take(6)
            ->get();

        // Lead score: (response_rate*40) + (views_share*30) + (rating*30)
        $maxViews      = max($properties->max('view_count'), 1);
        $viewsShare    = $totalViews / ($maxViews * max($properties->count(), 1));
        $avgRating     = $user->reviewsAsAgent()->avg('rating') ?? 0;
        $responseRate  = $thisMonth > 0 ? min(100, ($thisMonth * 10)) : 0;
        $leadScore     = round(($responseRate * 0.4) + ($viewsShare * 30) + ($avgRating / 5 * 30));

        // Wallet
        $wallet        = $user->wallet;
        $commissions   = $user->commissions()->orderByDesc('created_at')->take(10)->get();

        return view('agent.analytics.index', compact(
            'properties', 'totalViews', 'thisMonth', 'lastMonth',
            'topProperties', 'conversionRate', 'monthlyData',
            'leadScore', 'wallet', 'commissions', 'avgRating'
        ));
    }
}
