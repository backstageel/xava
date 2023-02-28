<?php

    namespace Database\States;

    use App\Models\EmployeeType;
    use Illuminate\Support\Facades\DB;

    class EnsureEmployeeTypesArePresent
    {
        public function __invoke()
        {
            if ($this->present()) {
                return;
            }
            $employeeTypes = [
                ['name' => 'Colaborador Permanente'],
                ['name' => 'Colaborador Temporário'],
                ['name' => 'Parceiro'],
                ['name' => 'Consultor'],
            ];

            foreach ($employeeTypes as $k=>$v){
                EmployeeType::create($v);
            }
        }

        public function present()
        {
            return DB::table('employee_types')->count() > 0;
        }
    }
