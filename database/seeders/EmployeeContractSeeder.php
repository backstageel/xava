<?php

    namespace Database\Seeders;

    use App\Models\Employee;
    use App\Models\EmployeeContract;
    use App\Models\Person;
    use App\Models\User;
    use Illuminate\Database\Console\Seeds\WithoutModelEvents;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Date;
    use Illuminate\Support\Facades\Hash;

    class EmployeeContractSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            EmployeeContract::factory()->count(5)->create();
            EmployeeContract::factory()
                ->for(Employee::factory()
                    ->for(Person::factory()->state([
                        'first_name'=>'Colaborador',
                        'last_name'=>'Inactivo'
                    ]))
                    ->state([
                    'employee_code' => '12345',
                    'contract_status_id' => 6,
                ]))->create([
                    'start_date' => '2020-01-01',
                    'end_date' => Date::now()->startOfWeek(),
                    'base_salary' => '10000',
                    'contract_status_id' => 6,
                ]);

            EmployeeContract::factory()
                ->for(Employee::factory()
                    ->for(Person::factory()
                        ->for(User::factory()->state([
                            'email'=>'colaborador.activo@xava.co.mz',
                            'password'=>Hash::make('password')
                        ]))
                        ->state([
                        'first_name'=>'Colaborador',
                            'last_name'=>'Activo'
                    ]))
                    ->state([
                        'employee_code' => '123456',
                        'contract_status_id' => 1,
                    ]))->create([
                    'start_date' => '2020-01-01',
                    'end_date' => Date::now()->endOfYear(),
                    'base_salary' => '10000',
                    'contract_status_id' => 1,
                ]);
        }
    }
