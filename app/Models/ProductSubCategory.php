<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    public function productcategory()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_sub_categories');
    }

    public function competition()
    {
        return $this->belongsToMany(Competition::class, 'competition_sub_categories')->withPivot('product_category_id');
    }
}
