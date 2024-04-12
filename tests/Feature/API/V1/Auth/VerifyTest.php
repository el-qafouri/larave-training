<?php

namespace Tests\Feature\API\V1\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class VerifyTest extends TestCase
{
    private string $url = 'api/v1/auth/verify';

    public function test_that_route_exists()
    {
        $this->postJson($this->url)
            ->assertUnprocessable();
    }

    public function test_that_validation_validated_correctly()
    {
        $data = [
            'mobile' => fake()->phoneNumber().'4',
        ];

        $this->postJson($this->url, $data)
            ->assertUnprocessable();
    }

    public function test_that_validation_worked_correctly()
    {
        $data = [
            'mobile' => fake()->phoneNumber(),
            'code' => strval(fake()->numberBetween(1111, 9999)),
        ];

        $this->postJson($this->url, $data)
            ->assertUnprocessable();
    }

    public function test_that_verify_prevent_user_to_verify_by_wrong_code()
    {
        $user = User::factory()
            ->create();

        $data = [
            'mobile' => $user->mobile,
            'code' => strval(fake()->numberBetween(1111, 9999)),
        ];

        $this->postJson($this->url, $data)
            ->assertBadRequest();
    }

    public function test_that_verify_was_worked_correctly()
    {
        $code = 1111;
        $user = User::factory()
            ->create();
        //1. call login method to set the cache
        $this->postJson('api/v1/auth/login', [
            'mobile' => $user->mobile,
        ])
            ->assertOk();

        //or fake the cache
        //        Cache::put($user->mobile, $code);

        $data = [
            'mobile' => $user->mobile,
            'code' => strval($code),
        ];

        $this->postJson($this->url, $data)
            ->assertOk();

        $this->assertDatabaseCount((new User())->getTable(), 1);
        $this->assertDatabaseMissing((new User())->getTable(), [
            'mobile' => $data['mobile'],
            'email_verified_at' => null,
        ]);
    }
}
