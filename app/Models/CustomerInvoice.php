<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerInvoice extends Model
{
    use HasFactory;

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


}
