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
        'name', 'email', 'password', 'role', 'google_id', 'google_avatar',
        'agent_image', 'agent_id_document', 'agent_id_number', 'agent_phone',
        'agent_whatsapp', 'agent_address', 'agent_verification_status',
        'agent_verification_notes', 'bio', 'agent_promise', 'experience_years',
        'specialties', 'license_number', 'profile_photo_path',
        'login_locked_until', 'last_login_at', 'last_login_ip', 'last_login_device',
        'referral_code', 'account_deleted', 'account_deleted_at',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $user) {
            if (empty($user->referral_code)) {
                $user->referral_code = strtoupper(substr(md5(uniqid()), 0, 8));
            }
        });
    }

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
            'email_verified_at'   => 'datetime',
            'password'            => 'hashed',
            'login_locked_until'  => 'datetime',
            'last_login_at'       => 'datetime',
            'account_deleted'     => 'boolean',
            'account_deleted_at'  => 'datetime',
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
     * Get reviews received as an agent.
     */
    public function reviewsAsAgent(): HasMany
    {
        return $this->hasMany(Review::class, 'agent_id');
    }

    /**
     * Get reviews written as a reviewer.
     */
    public function reviewsAsReviewer(): HasMany
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    /**
     * Get average rating as an agent.
     */
    public function getAverageRatingAttribute()
    {
        return $this->reviewsAsAgent()->avg('rating') ?? 0;
    }

    /**
     * Get all blog posts by this user.
     */
    public function blogPosts(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'author_id');
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

    /**
     * Get user's 2FA settings.
     */
    public function user2fa()
    {
        return $this->hasOne(User2FA::class);
    }

    /**
     * Check if user has 2FA enabled.
     */
    public function hasTwoFactorEnabled(): bool
    {
        return $this->user2fa && $this->user2fa->enabled;
    }

    /**
     * Get user's subscriptions.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Get user's current active subscription.
     */
    public function currentSubscription()
    {
        return $this->hasOne(Subscription::class)->where('status', 'active')->latest();
    }

    /**
     * Check if user has an active subscription.
     */
    public function hasActiveSubscription(): bool
    {
        return $this->currentSubscription()->exists() && $this->currentSubscription->isActive();
    }

    // ── New relationships ──────────────────────────────────────────────────────

    public function wallet()        { return $this->hasOne(Wallet::class); }
    public function activityLogs()  { return $this->hasMany(ActivityLog::class)->latest(); }
    public function savedSearches() { return $this->hasMany(SavedSearch::class); }
    public function commissions()   { return $this->hasMany(Commission::class, 'agent_id'); }
    public function referralsMade() { return $this->hasMany(Referral::class, 'referrer_id'); }
    public function referredBy()    { return $this->hasOne(Referral::class, 'referred_id'); }
    public function tickets()       { return $this->hasMany(Ticket::class); }
    public function feedback()      { return $this->hasMany(Feedback::class); }
    public function messageTemplates() { return $this->hasMany(MessageTemplate::class); }

    /** Ensure this user has a wallet, creating one if missing. */
    public function getOrCreateWallet(): Wallet
    {
        return $this->wallet ?? $this->wallet()->create(['balance' => 0, 'currency' => 'NGN']);
    }

    public function isLocked(): bool
    {
        return $this->login_locked_until && $this->login_locked_until->isFuture();
    }
}
