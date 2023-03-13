<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Customer extends Model
{
    use HasFactory;

    public function customerable():MorphTo{
        return $this->morphTo();
    }

    public function country(){
        return $this->belongsTo('Country');
    }
    public function scopeWithCustomerable($query){
        $query->with('customerable');
    }

}
