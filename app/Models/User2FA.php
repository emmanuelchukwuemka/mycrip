<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User2FA extends Model
{
    protected $fillable = [
        'user_id',
        'secret',
        'recovery_codes',
        'enabled',
        'last_used_at',
    ];

    protected $casts = [
        'recovery_codes' => 'array',
        'enabled' => 'boolean',
        'last_used_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isRecoveryCodeValid(string $code): bool
    {
        return in_array($code, $this->recovery_codes);
    }

    public function invalidateRecoveryCode(string $code): void
    {
        $codes = $this->recovery_codes;
        $index = array_search($code, $codes);
        if ($index !== false) {
            unset($codes[$index]);
            $this->recovery_codes = array_values($codes);
            $this->save();
        }
    }
}
