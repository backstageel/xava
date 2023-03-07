<?php

namespace Database\Factories;

use App\Models\Company;
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
