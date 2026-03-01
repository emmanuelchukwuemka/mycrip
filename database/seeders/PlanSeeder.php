<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
            'name' => 'Starter Plan',
            'description' => 'Perfect for new agents getting started',
            'price' => 5000,
            'currency' => 'NGN',
            'interval' => 'monthly',
            'features' => [
                'List up to 5 properties',
                'Basic property promotion',
                'Standard customer support',
                'Access to basic analytics'
            ],
            'is_active' => true,
            'listing_limit' => 5,
            'promoted_listings_limit' => 1,
        ]);

        Plan::create([
            'name' => 'Professional Plan',
            'description' => 'For growing agents with multiple listings',
            'price' => 12000,
            'currency' => 'NGN',
            'interval' => 'monthly',
            'features' => [
                'List up to 20 properties',
                'Premium property promotion',
                'Priority customer support',
                'Advanced analytics',
                'Featured agent badge',
                'Custom property page'
            ],
            'is_active' => true,
            'listing_limit' => 20,
            'promoted_listings_limit' => 5,
        ]);

        Plan::create([
            'name' => 'Enterprise Plan',
            'description' => 'For established agencies with extensive portfolios',
            'price' => 25000,
            'currency' => 'NGN',
            'interval' => 'monthly',
            'features' => [
                'Unlimited property listings',
                'Unlimited property promotions',
                '24/7 dedicated support',
                'Advanced analytics & insights',
                'Premium agent badge',
                'Custom branding options',
                'API access',
                'Team management'
            ],
            'is_active' => true,
            'listing_limit' => 999999, // effectively unlimited
            'promoted_listings_limit' => 999999,
        ]);
    }
}
