<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

class PropertyImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'property_id',
        'image_path',
        'image_hash',
        'order',
        'is_featured',
        'caption',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'order' => 'integer',
        ];
    }

    /**
     * Get the property that owns the image.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Generate SHA-256 hash from file content.
     */
    public static function generateHash(UploadedFile $file): string
    {
        $content = $file->get();
        return hash('sha256', $content);
    }

    /**
     * Check if image hash already exists in database.
     */
    public static function hashExists(string $hash): bool
    {
        return self::where('image_hash', $hash)->exists();
    }

    /**
     * Get the full URL of the image.
     */
    public function getImageUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }

    /**
     * Check if this image is a duplicate.
     */
    public function isDuplicate(): bool
    {
        return self::where('image_hash', $this->image_hash)
            ->where('id', '!=', $this->id)
            ->exists();
    }
}
