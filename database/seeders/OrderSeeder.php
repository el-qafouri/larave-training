<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Address;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $i = 1;
        while ($i <= 1000) {
            $data[] = [
                'user_id' => User::factory()->create()->id,
                'address_id' => Address::factory()->create()->id,
                'total_price' => fake()->numberBetween(1_000_000, 100_000_000),
                'status' => fake()->randomElement(OrderStatus::cases())->value,
            ];
            $i++;
        }
        Order::insert($data);

        return;

        Order::factory(10000)
//            ->count(100)
            ->create();
    }
}
