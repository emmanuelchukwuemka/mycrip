<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'property_id',
        'user_id',
        'guest_name',
        'guest_email',
        'guest_phone',
        'message',
        'status',
    ];

    /**
     * Get the property that owns the inquiry.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    /**
     * Get the user that made the inquiry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope for new inquiries.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Mark inquiry as read.
     */
    public function markAsRead()
    {
        $this->update(['status' => 'read']);
    }

    /**
     * Mark inquiry as replied.
     */
    public function markAsReplied()
    {
        $this->update(['status' => 'replied']);
    }

    /**
     * Mark inquiry as closed.
     */
    public function markAsClosed()
    {
        $this->update(['status' => 'closed']);
    }
}
