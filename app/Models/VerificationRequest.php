<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerificationRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'property_id',
        'payment_reference',
        'amount',
        'status',
        'report_file',
        'notes',
    ];

    /**
     * Get the user who requested the verification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the property to be verified.
     */
    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
