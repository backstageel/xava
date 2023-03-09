<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function customer(){
        return $this->morphOne(Customer::class,'customerable');
    }
}
