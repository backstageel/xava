<?php

namespace App\Models;

use App\Events\EmployeeSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'saved' => EmployeeSaved::class,
    ];

    protected $casts = [
        #'employee_position_id' => \App\Enums\EmployeePosition::class,
    ];


    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function contractType()
    {
        return $this->belongsTo(EmployeeContractType::class);
    }

    public function contractStatus()
    {
        return $this->belongsTo(EmployeeContractStatus::class);
    }

    public function employeePosition()
    {
        return $this->belongsTo(EmployeePosition::class);
    }

}
