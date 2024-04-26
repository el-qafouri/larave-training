<?php

namespace API\V1\UserAddress;

use App\Models\Address;
use App\Models\User;
use Tests\TestCase;

class StoreTest extends TestCase
{
    private string $url = 'api/v1/users/addresses';

    public function test_that_route_exists()
    {
        $this->postJson($this->url)
            ->assertUnauthorized();
    }

    public function test_that_route_has_auth_middleware()
    {
        $this->postJson($this->url)
            ->assertUnauthorized();
    }

    public function test_that_address_stored_successfully()
    {
        $user = User::factory()->create();
        $address = [
            'name' => fake()->name,
            'address' => fake()->sentence(),
            'receiver_name' => fake()->lastName(),
        ];
        $this->actingAs($user)
            ->postJson($this->url, $address)
            ->assertCreated();
        $this->assertDatabaseCount((new Address())->getTable(), 1);
        $this->assertDatabaseHas((new Address())->getTable(), [
            'user_id' => $user->id,
            'name' => $address['name'],
            'address' => $address['address'],
            'receiver_name' => $address['receiver_name'],
        ]);
    }

    public function test_that_required_validation_validated_correctly()
    {
        $user = User::factory()->create();
        $address = [
            'name' => fake()->name,
            'address' => [],
            'receiver_name' => fake()->lastName(),
        ];
        $this->actingAs($user)
            ->postJson($this->url, $address)
            ->assertUnprocessable();
    }

    public function test_that_string_validation_validated_correctly()
    {
        $user = User::factory()->create();
        $address = [
            'name' => fake()->name,
            'address' => 1,
            'receiver_name' => fake()->lastName(),
        ];
        $this->actingAs($user)
            ->postJson($this->url, $address)
            ->assertUnprocessable();
    }

    public function test_that_validation_worked_correctly()
    {
        $user = User::factory()->create();
        $address = [
            'name' => fake()->name,
            'address' => fake()->sentence(),
            'receiver_name' => fake()->lastName(),
        ];
        $data = [
            'message',
            'data' => [
//                ['name' => $address->name,],
//                ['address' => $address->sentence,],
//                ['receiver_name' => $address->last_name]
            ],
        ];
        $this->actingAs($user)
            ->postJson($this->url, $address)
            ->assertCreated()
            ->assertJsonStructure($data);
    }


}
