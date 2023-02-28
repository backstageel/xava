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
                ['name' => 'Director Operativo'],
                ['name' => 'Colaborador'],
            ];

            foreach ($employeePositions as $k=>$v){
                EmployeePosition::create($v);
            }
        }

        public function present()
        {
            return DB::table('employee_positions')->count() > 0;
        }
    }
