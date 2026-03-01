<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $fillable = [
        'agent_id','property_id','buyer_id','amount','percentage','status','paid_at','notes'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'percentage' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    public function agent()    { return $this->belongsTo(User::class, 'agent_id'); }
    public function property() { return $this->belongsTo(Property::class); }
    public function buyer()    { return $this->belongsTo(User::class, 'buyer_id'); }

    public function isPaid(): bool { return $this->status === 'paid'; }
}
