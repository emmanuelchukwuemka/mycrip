<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'plan_id',
        'paystack_subscription_id',
        'paystack_customer_id',
        'status',
        'amount',
        'currency',
        'interval',
        'start_date',
        'end_date',
        'next_payment_date',
        'cancelled_at',
        'trial_ends_at',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'next_payment_date' => 'datetime',
        'cancelled_at' => 'datetime',
        'trial_ends_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function isActive(): bool
    {
        return $this->status === 'active' && now()->lt($this->end_date);
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled' && $this->cancelled_at !== null;
    }

    public function isExpired(): bool
    {
        return now()->gte($this->end_date);
    }
}
