<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }


}
