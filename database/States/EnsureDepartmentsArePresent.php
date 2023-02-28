<?php

    namespace Database\States;

    use App\Models\Department;
    use App\Models\EmployeeType;
    use Illuminate\Support\Facades\DB;

    class EnsureDepartmentsArePresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $departments = [
                ['name' => 'Direcção Geral','company_id'=>1],
                ['name' => 'Direcção Administrativa e Financeira','company_id'=>1],
                ['name' => 'Departamento de Vendas IT','company_id'=>1],
                ['name' => 'Departamento de Vendas Motas e Bicicletas','company_id'=>1],
            ];

            foreach ($departments as $k=>$v){
                Department::create($v);
            }
        }

        public function present()
        {
            return DB::table('departments')->count() > 0;
        }
    }
