<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\PersonPrefix;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'person_prefix_id'=>PersonPrefix::factory(),
            'user_id'=>User::factory(),
            'first_name'=>fake()->firstName,
            'last_name'=>fake()->lastName,
            'gender_id'=>Gender::all()->random(),
            'birth_date'=>fake()->date,
            'cellphone'=>fake()->phoneNumber,
            'personal_email'=>fake()->email
        ];
    }
}
