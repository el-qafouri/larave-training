<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'address_id' => Address::factory(),
            'total_price' => fake()->numberBetween(1_000_000, 100_000_000),
            'status' => fake()->randomElement(OrderStatus::cases())->value,
        ];
    }
}
