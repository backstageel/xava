<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{

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
        return $this->belongsTo(ProductCategory::class);
    }


}
