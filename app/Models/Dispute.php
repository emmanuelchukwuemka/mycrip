<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dispute extends Model
{
    protected $fillable = [
        'reporter_id','property_id','reported_user_id','reason','description',
        'status','admin_notes','resolved_by','resolved_at'
    ];

    protected $casts = ['resolved_at' => 'datetime'];

    const REASONS = [
        'fraud'       => 'Fraudulent Listing',
        'spam'        => 'Spam / Duplicate',
        'wrong_info'  => 'Wrong Information',
        'offensive'   => 'Offensive Content',
        'other'       => 'Other',
    ];

    public function reporter()     { return $this->belongsTo(User::class, 'reporter_id'); }
    public function property()     { return $this->belongsTo(Property::class); }
    public function reportedUser() { return $this->belongsTo(User::class, 'reported_user_id'); }
    public function resolvedBy()   { return $this->belongsTo(User::class, 'resolved_by'); }

    public function isOpen()     { return $this->status === 'open'; }
    public function isResolved() { return $this->status === 'resolved'; }
}
