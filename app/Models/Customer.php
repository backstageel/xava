<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    public function Customable(){
        return $this->morphTo(__FUNCTION__,'customable_type','customable_id');
    }
}
