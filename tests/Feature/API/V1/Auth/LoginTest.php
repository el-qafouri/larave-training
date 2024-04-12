<?php

namespace Tests\Feature\API\V1\Auth;

use App\Events\UserLoggedIn;
use App\Listeners\NotifyUserByToken;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class LoginTest extends TestCase
{
    private string $url = 'api/v1/auth/login';

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
        ];

        $this->postJson($this->url, $data)
            ->assertOk();
    }

    public function test_that_user_registered_successfully()
    {
        $data = [
            'mobile' => fake()->phoneNumber(),
        ];

        $this->postJson($this->url, $data)
            ->assertOk();

        $this->assertDatabaseCount((new User())->getTable(), 1);
        $this->assertDatabaseHas((new User())->getTable(), [
            'mobile' => $data['mobile'],
            'email_verified_at' => null,
        ]);
    }

    public function test_that_user_registered_before_and_didnt_create_new_one()
    {
        $data = [
            'mobile' => fake()->phoneNumber(),
        ];
        User::factory()
            ->unverified()
            ->create([
                'mobile' => $data['mobile'],
            ]);

        $this->postJson($this->url, $data)
            ->assertOk();

        $this->assertDatabaseCount((new User())->getTable(), 1);
        $this->assertDatabaseHas((new User())->getTable(), [
            'mobile' => $data['mobile'],
            'email_verified_at' => null,
        ]);
    }

    public function test_that_token_generated_successfully()
    {
        $data = [
            'mobile' => fake()->phoneNumber(),
        ];

        Cache::shouldReceive('has')->once()->andReturnFalse();
        Cache::shouldReceive('put')->once()
            ->with($data['mobile'], \Mockery::any(), config('services.auth.verification_token_ttl'))
            ->andReturnTrue();

        $this->postJson($this->url, $data)
            ->assertOk();

        $this->assertDatabaseCount((new User())->getTable(), 1);
        $this->assertDatabaseHas((new User())->getTable(), [
            'mobile' => $data['mobile'],
            'email_verified_at' => null,
        ]);
    }

    public function test_that_events_was_dispatched_successfully()
    {
        $data = [
            'mobile' => fake()->phoneNumber(),
        ];

        Event::fake();

        $this->postJson($this->url, $data)
            ->assertOk();

        Event::assertDispatched(UserLoggedIn::class);
        Event::assertListening(UserLoggedIn::class,
            NotifyUserByToken::class,
        );
    }
}
