<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    protected $with = ['productsubcategories'];
    protected $guarded = [];

    public function productsubcategories()
    {
        return $this->belongsToMany(ProductSubCategory::class, 'product_category_sub_categories');
    }

    public function competition()
    {
        return $this->belongsToMany(Competition::class, 'competition_product_categories');
    }



}
