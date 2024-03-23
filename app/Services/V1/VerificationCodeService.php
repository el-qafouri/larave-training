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

        $token = rand(1000, 9999);
        Cache::put($key, $token, 90);

        return $token;
    }
}
