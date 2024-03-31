<?php

namespace App\Services\V1;

use Illuminate\Support\Facades\Cache;

class VerificationCodeService
{
    public function generateToken(string $key): string
    {
        if (Cache::has($key)) {
            return Cache::get($key);
        }

        if (app()->environment('local', 'development', 'testing')) {
            $token = 1111;
        } else {
            $token = rand(1000, 9999);
        }

        Cache::put($key, $token, config('services.auth.verification_token_ttl'));

        return $token;
    }

    public function isValid(string $key): ?string
    {
        return Cache::get($key);
    }

    public function clearCode(string $key): ?string
    {
        return Cache::forget($key);
    }
}
