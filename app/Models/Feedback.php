<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = ['user_id','rating','message','page'];

    public function user() { return $this->belongsTo(User::class); }

    public function scopeRated($query, int $rating) { return $query->where('rating', $rating); }
}
