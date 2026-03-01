<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Newsletter extends Model
{
    protected $fillable = ['email','name','subscribed_at','unsubscribed_at','active','token'];

    protected $casts = [
        'subscribed_at'   => 'datetime',
        'unsubscribed_at' => 'datetime',
        'active'          => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (self $model) {
            $model->token ??= Str::random(64);
        });
    }

    public function scopeActive($query) { return $query->where('active', true); }

    public function unsubscribe(): void
    {
        $this->update(['active' => false, 'unsubscribed_at' => now()]);
    }
}
