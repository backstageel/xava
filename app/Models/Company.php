<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function customer(){
        return $this->morphOne(Customer::class,'customerable');
    }

    public function supplier(){
        return $this->morphOne(Supplier::class,'supplierable');
    }

    public function companyType(){
        return $this->belongsTo(CompanyType::class);
    }

    public function livingDistrict(){
        return $this->belongsTo(District::class);
    }

    public function livingProvince(){
        return $this->belongsTo(Province::class);
    }

    public function livingCountry(){
        return $this->belongsTo(Country::class);
    }
}
