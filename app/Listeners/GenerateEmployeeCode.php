<?php

namespace App\Listeners;

use App\Events\EmployeeCreating;
use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;

class GenerateEmployeeCode
{
    public function handle(EmployeeCreating $event)
    {

        $nextId = Employee::latest()->value('id') + 1;
        $employee = $event->employee;
        // Extrai o ano e o mês da data do contrato
        $year = $employee->start_date->year;
        $month = $employee->start_date->month;

        // Monta a referência do funcionário
        $employeeCode = null;
        if ($nextId < 10) {
            $employeeCode = 'XV000' . $nextId . $month . $year;
        } elseif ($nextId < 100) {
            $employeeCode = 'XV00' . $nextId . $month . $year;
        } elseif ($employeeCode < 1000) {
            $employeeCode = 'XV0' . $nextId . $month . $year;
        } else {
            $employeeCode = 'XV' . $nextId . $month . $year;
        }

        $employee->employee_code = $employeeCode;
    }
}
