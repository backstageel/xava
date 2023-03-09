<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Customer extends Model
{
    use HasFactory;

    public function Customerable():MorphTo{
        return $this->morphTo();
    }
}
