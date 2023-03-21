<?php

namespace Database\States;

use App\Models\EmployeeContractType;
use App\Models\EmployeeType;
use Illuminate\Support\Facades\DB;

class EnsureEmployeeContractTypesArePresent
{
    public function __invoke()
    {
        if ($this->present()) {
            return;
        }
        $contractTypes = [
            ['name' => 'Indeterminado'],
            ['name' => 'Determinado'],
            ['name' => 'Parceiro'],
            ['name' => 'Consultor'],
            ['name' => 'Experimental'],
            ['name' => 'Parcial'],
            ['name' => 'Temporário'],
            ['name' => 'Internmitente'],
            ['name' => 'Remoto'],
            ['name' => 'Prestação de Serviços'],
            ['name' => 'Estágio'],
        ];

        foreach ($contractTypes as $k => $v) {
            EmployeeContractType::create($v);
        }
    }

    public function present()
    {
        return DB::table('employee_contract_types')->count() > 0;
    }
}
