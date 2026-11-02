<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Location extends Model
{
    protected $fillable = [
        'location_name',
        'address',
        'description'
    ];

    public function vendors(): HasMany
    {
        return $this->hasMany(Vendor::class);
    }
}