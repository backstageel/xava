<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Supplier extends Model
{
    use HasFactory;

    public function supplierable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeWithSupplierable($query)
    {
        $query->with('supplierable');
    }

}
