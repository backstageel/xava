<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    public function ProductCategory()
{
    return $this->belongsTo(ProductCategory::class,'category_id');
}
}
