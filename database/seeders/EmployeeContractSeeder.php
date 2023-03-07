<?php

    namespace Database\Seeders;

    use App\Models\Employee;
    use App\Models\EmployeeContract;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Date;

    class EmployeeContractSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            EmployeeContract::factory()->count(5)->create();
            EmployeeContract::factory()
                ->for(Employee::factory()->state([
                    'employee_code' => '12345',
                    'contract_status_id' => 6,
                ]))->create([
                    'start_date' => '2020-01-01',
                    'end_date' => Date::now()->startOfWeek(),
                    'base_salary' => '10000',
                    'contract_status_id' => 6,
                ]);
        }
    }
