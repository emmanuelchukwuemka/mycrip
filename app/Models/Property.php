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
        'video_url',
        'virtual_tour_url',
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
     * Get all tours for the property.
     */
    public function tours(): HasMany
    {
        return $this->hasMany(Tour::class);
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
            if (filter_var($this->featured_image, FILTER_VALIDATE_URL)) {
                return $this->featured_image;
            }
            return asset('storage/' . $this->featured_image);
        }
        
        $firstImage = $this->images->first(); // Use collection's first() instead of relationship's first()
        if ($firstImage) {
            if (filter_var($firstImage->image_path, FILTER_VALIDATE_URL)) {
                return $firstImage->image_path;
            }
            return asset('storage/' . $firstImage->image_path);
        }

        return null;
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

    /**
     * Get YouTube ID from video_url.
     */
    public function getYoutubeIdAttribute(): ?string
    {
        if (!$this->video_url) return null;

        $pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/';
        preg_match($pattern, $this->video_url, $matches);
        
        return (isset($matches[7]) && strlen($matches[7]) == 11) ? $matches[7] : null;
    }

    /**
     * Get Vimeo ID from video_url.
     */
    public function getVimeoIdAttribute(): ?string
    {
        if (!$this->video_url) return null;

        if (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)/', $this->video_url, $matches)) {
            return $matches[3];
        }
        
        return null;
    }

    /**
     * Scope for featured properties.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
                     ->where('featured_until', '>=', now());
    }
}
