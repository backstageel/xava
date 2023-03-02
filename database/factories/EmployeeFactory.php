<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\EmployeePosition;
use App\Models\EmployeeType;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_id'=>Person::factory(),
            'employee_code'=>fake()->randomNumber(4),
            'emergency_name'=>fake()->name,
            'emergency_phone'=>fake()->phoneNumber,
            'employee_position_id'=>EmployeePosition::all()->random(),
            'department_id'=>Department::all()->random(),
            'start_date'=>fake()->dateTimeThisDecade,
            'salary'=>fake()->randomNumber(4),
            'employee_type_id'=>EmployeeType::all()->random(),

        ];
    }
}
