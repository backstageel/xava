<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function prefix(){
        return $this->belongsTo(PersonPrefix::class,'person_prefix_id');
    }

    public function gender(){
        return $this->belongsTo(Gender::class);
    }

    public function customer(){
        return $this->morphOne(Customer::class,'customerable');
    }

    public function supplier(){
        return $this->morphOne(Supplier::class,'supplierable');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['first_name'].' '.$attributes['last_name'],
        );
    }

}
