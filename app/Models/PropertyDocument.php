<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyDocument extends Model
{
    protected $fillable = [
        'property_id','type','file_path','file_name','status','verified_at','verified_by','admin_notes'
    ];

    protected $casts = ['verified_at' => 'datetime'];

    const TYPES = [
        'title_deed'   => 'Title Deed',
        'survey'       => 'Survey Plan',
        'coo'          => 'Certificate of Occupancy',
        'deed_of_assignment' => 'Deed of Assignment',
        'building_plan' => 'Building Plan',
        'other'        => 'Other',
    ];

    public function property()    { return $this->belongsTo(Property::class); }
    public function verifiedBy()  { return $this->belongsTo(User::class, 'verified_by'); }

    public function isPending()  { return $this->status === 'pending'; }
    public function isVerified() { return $this->status === 'verified'; }
}
