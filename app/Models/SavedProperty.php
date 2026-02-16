<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedProperty extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'property_id',
    ];

    /**
     * Get the user that saved the property.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the saved property.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Check if a property is saved by a user.
     */
    public static function isSaved(int $userId, int $propertyId): bool
    {
        return self::where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->exists();
    }

    /**
     * Toggle saved status.
     */
    public static function toggle(int $userId, int $propertyId): bool
    {
        $existing = self::where('user_id', $userId)
            ->where('property_id', $propertyId)
            ->first();

        if ($existing) {
            $existing->delete();
            return false;
        }

        self::create([
            'user_id' => $userId,
            'property_id' => $propertyId,
        ]);

        return true;
    }
}
