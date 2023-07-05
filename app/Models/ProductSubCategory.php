<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productcategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }


//    public function competitions()
//    {
//        return $this->belongsToMany(Competition::class, 'competition_sub_categories');
//    }
}
