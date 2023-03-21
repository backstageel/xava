<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleStatus()
    {
        return $this->belongsTo(SaleStatus::class);
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
