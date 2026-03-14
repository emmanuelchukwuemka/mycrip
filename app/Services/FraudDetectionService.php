<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Str;

class FraudDetectionService
{
    /**
     * Suspicious keywords common in real estate scams.
     */
    protected array $suspiciousKeywords = [
        'Western Union',
        'MoneyGram',
        'wire transfer',
        'urgent',
        'immediate deposit',
        'owner is abroad',
        'keys will be mailed',
        'no viewing possible',
        'pay before seeing',
        'too good to be true',
        'lottery winner',
        'donation',
        'blessing',
    ];

    /**
     * Analyze a property for fraudulent indicators.
     *
     * @param Property $property
     * @return array
     */
    public function analyze(Property $property): array
    {
        $reasons = [];

        // 1. Price Outlier Detection
        $priceSuspicion = $this->checkPriceOutlier($property);
        if ($priceSuspicion) {
            $reasons[] = $priceSuspicion;
        }

        // 2. Suspicious Description Keywords
        $keywordSuspicion = $this->checkSuspiciousKeywords($property);
        if ($keywordSuspicion) {
            $reasons[] = $keywordSuspicion;
        }

        // 3. Duplicate Image Detection (Cross-Property)
        $imageSuspicion = $this->checkDuplicateImages($property);
        if ($imageSuspicion) {
            $reasons[] = $imageSuspicion;
        }

        $isSuspicious = !empty($reasons);

        $property->update([
            'is_suspicious' => $isSuspicious,
            'suspicion_reasons' => $isSuspicious ? $reasons : null,
        ]);

        return [
            'is_suspicious' => $isSuspicious,
            'reasons' => $reasons,
        ];
    }

    /**
     * Check if the price is an outlier for its category and city.
     */
    protected function checkPriceOutlier(Property $property): ?string
    {
        // Simple logic: If price is > 300% or < 30% of average price in same city/category
        $avgPrice = Property::approved()
            ->where('category', $property->category)
            ->where('city', $property->city)
            ->where('id', '!=', $property->id)
            ->avg('price');

        if ($avgPrice) {
            if ($property->price > ($avgPrice * 3)) {
                return "Price is significantly higher (unrealistic) than city average (₦" . number_format($avgPrice) . ").";
            }
            if ($property->price < ($avgPrice * 0.3)) {
                return "Price is suspiciously low compared to city average (₦" . number_format($avgPrice) . ").";
            }
        }

        return null;
    }

    /**
     * Check for suspicious keywords in description.
     */
    protected function checkSuspiciousKeywords(Property $property): ?string
    {
        $description = strtolower($property->description);
        $found = [];

        foreach ($this->suspiciousKeywords as $keyword) {
            if (Str::contains($description, strtolower($keyword))) {
                $found[] = $keyword;
            }
        }

        if (!empty($found)) {
            return "Contains suspicious keywords: " . implode(', ', $found) . ".";
        }

        return null;
    }

    /**
     * Check if any images are duplicated across OTHER properties.
     */
    protected function checkDuplicateImages(Property $property): ?string
    {
        $imageHashes = $property->images()->pluck('image_hash')->toArray();
        
        $duplicatesFound = PropertyImage::whereIn('image_hash', $imageHashes)
            ->where('property_id', '!=', $property->id)
            ->exists();

        if ($duplicatesFound) {
            return "One or more images are shared with another property listing (potential duplicate scam).";
        }

        return null;
    }
}
