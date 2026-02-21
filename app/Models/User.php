<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'google_avatar',
        'agent_image',
        'agent_id_document',
        'agent_id_number',
        'agent_phone',
        'agent_whatsapp',
        'agent_address',
        'agent_verification_status',
        'agent_verification_notes',
        'bio',
        'agent_promise',
        'experience_years',
        'specialties',
        'license_number',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get all properties for this user (if agent).
     */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
     * Get all inquiries for this user's properties.
     */
    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /**
     * Get all saved properties for this user.
     */
    public function savedProperties(): HasMany
    {
        return $this->hasMany(SavedProperty::class);
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is an agent.
     */
    public function isAgent(): bool
    {
        return $this->role === 'agent';
    }

    /**
     * Check if user is a verified agent.
     */
    public function isVerifiedAgent(): bool
    {
        return $this->isAgent() && $this->agent_verification_status === 'approved';
    }

    /**
     * Get agent profile image URL.
     */
    public function getAgentImageUrlAttribute(): ?string
    {
        if ($this->agent_image) {
            return asset('storage/' . $this->agent_image);
        }
        return null;
    }
}
