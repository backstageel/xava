<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }




//    public function competitions()
//    {
//        return $this->belongsToMany(Competition::class, 'competition_sub_categories');
//    }
}
