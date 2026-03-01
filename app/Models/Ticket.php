<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id','subject','body','status','priority','assigned_to','resolved_at'
    ];

    protected $casts = ['resolved_at' => 'datetime'];

    public function user()       { return $this->belongsTo(User::class); }
    public function assignedTo() { return $this->belongsTo(User::class, 'assigned_to'); }
    public function replies()    { return $this->hasMany(TicketReply::class)->orderBy('created_at'); }

    public function isOpen()          { return in_array($this->status, ['open','in_progress']); }
    public function statusBadgeColor(): string {
        return match($this->status) {
            'open'        => 'yellow',
            'in_progress' => 'blue',
            'resolved'    => 'green',
            'closed'      => 'gray',
            default       => 'gray',
        };
    }
}
