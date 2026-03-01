<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedSearch extends Model
{
    protected $fillable = ['user_id','name','filters','alert_email','last_alerted_at'];

    protected $casts = [
        'filters' => 'array',
        'alert_email' => 'boolean',
        'last_alerted_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Build a query that matches this saved search's filters.
     */
    public function matchingProperties()
    {
        $query = Property::where('status', 'active');
        $f = $this->filters;

        if (!empty($f['category']))   $query->where('category', $f['category']);
        if (!empty($f['location']))   $query->where('location', 'like', '%'.$f['location'].'%');
        if (!empty($f['price_min']))  $query->where('price', '>=', $f['price_min']);
        if (!empty($f['price_max']))  $query->where('price', '<=', $f['price_max']);
        if (!empty($f['bedrooms']))   $query->where('bedrooms', '>=', $f['bedrooms']);

        return $query;
    }
}
