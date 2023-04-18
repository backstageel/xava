<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Customer extends Model
{
    use HasFactory;

    public function customerable(): MorphTo
    {
        return $this->morphTo();
    }
    public function getFullnameAttribute(): MorphTo
    {
        return $this->name?? $this->first_name. ' ' . $this->last_name;
    }

    public function country()
    {
        return $this->belongsTo('Country', 'id');
    }

    public function province()
    {
        return $this->belongsTo('Province', 'id');
    }

    public function district()
    {
        return $this->belongsTo('District', 'id');
    }

    public function scopeWithCustomerable($query)
    {
        $query->with('customerable');
    }

}
