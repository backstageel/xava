<?php

namespace App\Listeners;

use App\Events\EmployeeSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UpdateEmployeeRoles
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(EmployeeSaved $event): void
    {
//        $employee = $event->employee;
//        $roleName = Str::slug($employee->employee_position_id->key);
//        $role = Role::firstOrCreate(['name'=>$roleName]);
//        $employee->person->user->assignRole($role);
    }
}
