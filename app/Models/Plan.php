<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'currency',
        'interval',
        'features',
        'is_active',
        'order_limit',
        'listing_limit',
        'promoted_listings_limit',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'order_limit' => 'integer',
        'listing_limit' => 'integer',
        'promoted_listings_limit' => 'integer',
    ];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '₦' . number_format($this->price, 2);
    }

    public function getIntervalDisplayAttribute(): string
    {
        return ucfirst($this->interval);
    }
}
