<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category',
        'status',
        'country',
        'state',
        'city',
        'address',
        'latitude',
        'longitude',
        'price',
        'price_type',
        'bedrooms',
        'bathrooms',
        'toilets',
        'size',
        'furnished',
        'serviced',
        'parking',
        'security',
        'water_supply',
        'power_supply',
        'featured_image',
        'features',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'furnished' => 'boolean',
            'serviced' => 'boolean',
            'parking' => 'boolean',
            'security' => 'boolean',
            'water_supply' => 'boolean',
            'power_supply' => 'boolean',
            'features' => 'array',
            'price' => 'decimal:2',
        ];
    }

    /**
     * Get the user (agent) that owns the property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all images for the property.
     */
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class)->orderBy('order');
    }

    /**
     * Get all inquiries for the property.
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Get the featured image.
     */
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }
        
        $firstImage = $this->images()->first();
        return $firstImage ? asset('storage/' . $firstImage->image_path) : null;
    }

    /**
     * Scope for approved properties only.
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope for filtering by category.
     */
    public function scopeCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
    }

    /**
     * Scope for filtering by location.
     */
    public function scopeLocation($query, $country = null, $state = null, $city = null)
    {
        if ($country) {
            $query->where('country', $country);
        }
        if ($state) {
            $query->where('state', $state);
        }
        if ($city) {
            $query->where('city', $city);
        }
        return $query;
    }

    /**
     * Scope for price range filtering.
     */
    public function scopePriceRange($query, $minPrice = null, $maxPrice = null)
    {
        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }
        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }
        return $query;
    }

    /**
     * Get category display name.
     */
    public function getCategoryDisplayNameAttribute(): string
    {
        return match($this->category) {
            'house_rental' => 'House Rental',
            'house_purchase' => 'House Purchase',
            'land_purchase' => 'Land Purchase',
            'shop_rental' => 'Shop Rental',
            'student_lodge' => 'Student Lodge',
            default => $this->category,
        };
    }

    /**
     * Get formatted price.
     */
    public function getFormattedPriceAttribute(): string
    {
        $price = number_format($this->price, 0, '.', ',');
        
        return match($this->price_type) {
            'monthly' => '₦' . $price . '/month',
            'yearly' => '₦' . $price . '/year',
            default => '₦' . $price,
        };
    }
}
