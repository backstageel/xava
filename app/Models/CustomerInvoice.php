<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerInvoice extends Model
{
    use HasFactory;

    public function invoiceItems(){
        return $this->hasMany(CustomerInvoiceItem::class,'invoice_id');
    }
}
