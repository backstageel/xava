<?php

namespace Database\States;

use App\Models\EmployeePosition;
use App\Models\EmployeeType;
use Illuminate\Support\Facades\DB;

class EnsureEmployeePositionsArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $employeePositions = [
            ['name' => 'Director Geral'],
            ['name' => 'Director Financeiro'],
            ['name' => 'Director Operaacional'],
            ['name' => 'Colaborador'],
            ['name' => 'Gestor do Escritório'],
            ['name' => 'Gestor Senior Vendas de IT'],
            ['name' => 'Gestor Senior Vendas Motas & Bicicletas'],
        ];

        foreach ($employeePositions as $k => $v) {
            EmployeePosition::firstOrCreate($v);
        }
    }

    public function present()
    {
        return DB::table('employee_positions')->count() > 0;
    }
}
