<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\EmployeeContractType;
use App\Models\EmployeePosition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeContract>
 */
class EmployeeContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employee_id' => Employee::factory(),
            'contract_type_id' => EmployeeContractType::all()->random(),
            'start_date' => fake()->dateTimeThisDecade,
            'end_date' => fake()->dateTimeThisYear,
            'base_salary' => fake()->randomNumber(4),
            'employee_position_id' => EmployeePosition::all()->random(),
            'department_id' => 1
        ];
    }
}
