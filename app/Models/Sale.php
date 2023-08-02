<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;
    public $lazyLoaded = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }




    public function saleStatus()
    {
        return $this->belongsTo(SaleStatus::class);
    }

    #[Deprecated("use saleItems instead")]
    public function saleItem()
    {
        return $this->hasMany(SaleItem::class);
    }
    public function ProductCategory()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function invoices()
    {
        return $this->hasMany(CustomerInvoice::class);
    }
}
