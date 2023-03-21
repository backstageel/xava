<?php

namespace Database\States;

use App\Models\EmployeeContractStatus;
use App\Models\EmployeeType;
use Illuminate\Support\Facades\DB;

class EnsureEmployeeContractStatusesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $contractTypes = [
            ['name' => 'Activo'],
            ['name' => 'Inactivo'],
            ['name' => 'Suspenso'],
            ['name' => 'Em Processo de rescisão'],
            ['name' => 'Rescindido'],
            ['name' => 'Expirado'],
            ['name' => 'Em negociação'],
            ['name' => 'Em aprovação'],
            ['name' => 'Aguardado Assinatura'],
            ['name' => 'Cancelado'],
        ];

        foreach ($contractTypes as $k => $v) {
            EmployeeContractStatus::create($v);
        }
    }

    public function present()
    {
        return DB::table('employee_contract_statuses')->count() > 0;
    }
}
