<?php

namespace App\Models;

use App\Events\EmployeeCreating;
use App\Events\EmployeeSaved;
use App\Events\EmployeeEditing;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'saved' => EmployeeSaved::class,
        'creating'=>EmployeeCreating::class,
        'editing' => EmployeeEditing::class
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
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
