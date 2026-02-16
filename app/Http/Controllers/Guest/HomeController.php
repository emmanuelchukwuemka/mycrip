<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get featured properties (approved, most recent)
        $featuredProperties = Property::approved()
            ->latest()
            ->take(6)
            ->get();

        // Get recently added properties
        $recentProperties = Property::approved()
            ->latest()
            ->take(8)
            ->get();

        // Get properties by category for quick links
        $rentalProperties = Property::approved()
            ->whereIn('category', ['house_rental', 'student_lodge', 'shop_rental'])
            ->latest()
            ->take(4)
            ->get();

        $purchaseProperties = Property::approved()
            ->whereIn('category', ['house_purchase', 'land_purchase'])
            ->latest()
            ->take(4)
            ->get();

        // Get unique states for location filter
        $states = Property::approved()
            ->distinct()
            ->pluck('state')
            ->filter()
            ->take(10);

        return view('guest.home', compact(
            'featuredProperties',
            'recentProperties',
            'rentalProperties',
            'purchaseProperties',
            'states'
        ));
    }
}
