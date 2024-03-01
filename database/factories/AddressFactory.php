<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->name,
            'address' => fake()->unique()->safeEmail,
            'receiver_name' => fake()->lastName(),
        ];
    }
}
