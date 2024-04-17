<?php

namespace API\V1\UserAddress;

use App\Models\Address;
use App\Models\User;
use Tests\TestCase;

class IndexTest extends TestCase
{
    private string $url = 'api/v1/users/addresses';

    public function test_that_route_exists()
    {
        $this->getJson($this->url)
            ->assertUnauthorized();
    }

    public function test_that_route_has_auth_middleware()
    {
        $this->getJson($this->url)
            ->assertUnauthorized();
    }

    public function test_that_returned_null_if_there_is_no_address()
    {
        $user = User::factory()->create();
        $data = [
            'data' => [],
        ];

        $this->actingAs($user)
            ->getJson($this->url)
            ->assertOk()
            ->assertJson($data);
    }

    public function test_that_returned_null_if_user_has_no_address()
    {
        $user = User::factory()->create();
        Address::factory(10)->create();
        $data = [
            'data' => [],
        ];

        $this->actingAs($user)
            ->getJson($this->url)
            ->assertOk()
            ->assertJson($data);
    }

    public function test_that_returned_user_address_correctly()
    {
        $user = User::factory()
            ->hasAddresses(1)
            ->create();
        $address = $user->addresses->first();
        Address::factory(10)->create();
        $data = [
            'data' => [
                [
                    'id' => $address->id,
                    'name' => $address->name,
                ]
            ],
        ];

        $this->actingAs($user)
            ->getJson($this->url)
            ->assertOk()
            ->assertJson($data);
    }


}
