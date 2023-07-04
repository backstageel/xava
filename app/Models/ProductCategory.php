<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    protected $with = ['productSubcategory'];
    public function competition()
    {
        return $this->belongsToMany(Competition::class, 'competition_product_categories');
    }

    public function productSubcategory()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'product_category_sub_categories');
    }


}
