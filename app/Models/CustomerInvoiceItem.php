<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerInvoiceItem extends Model
{
    use HasFactory;

    public function invoice()
    {
        return $this->belongsTo(CustomerInvoice::class, 'invoice_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
