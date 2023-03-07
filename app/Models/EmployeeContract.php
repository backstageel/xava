<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmployeeContract extends Model
{
    use HasFactory;

   /* protected $casts = [
        'contract_status_id' => ServerStatus::class,
    ];*/
    public function employee(){
        return $this->belongsTo(Employee::class);
    }
}
