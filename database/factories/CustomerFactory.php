<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CustomerStatus;
use App\Models\CustomerType;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $customable = $this->customable();
        return [
           /* 'person_id'=>Person::factory(),

            'person.first_name'=>fake()->name,
            'person.last_name'=>fake()->name,
            'person.personal_email'=>fake()->email(),
            'customer_status.name'=>CustomerStatus::all()->random(),
            'customer_type.name'=>fake()->name,
            'person.cellphone'=>fake()->phoneNumber(),
           // 'contract_type_id'=>CustomerType::all()->random(),*/

            'customable_id'=>$customable::factory(),
            'customable_type'=>$customable
        ];
    }

    private function customable()
    {
        return fake()->randomElement([
            Person::class,
            Company::class
        ]);
    }
}
