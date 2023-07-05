<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    protected $with = ['productCategory'];
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function competitionType(){
        return $this->belongsTo(CompetitionType::class);
    }

    public function competitionStatus(){
        return $this->belongsTo(CompetitionStatus::class);
    }
    public function competitionResult(){
        return $this->belongsTo(CompetitionResult::class);
    }

    public function competitionReason(){
        return $this->belongsTo(CompetitionReason::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function companyType()
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function productcategory()
    {
        return $this->belongsToMany(ProductCategory::class,'competition_product_categories');
    }
//    public function productsubcategories(){
//        return $this->belongsToMany(ProductSubCategory::class,'competition_sub_categories')->withPivot('product_category_id');
//    }


}
