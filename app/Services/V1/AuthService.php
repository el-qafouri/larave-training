<?php

namespace App\Services\V1;

use App\Events\UserLoggedIn;
use App\Events\UserVerified;
use App\Repositories\UserRepository;

class AuthService
{
    public function __construct(protected $userRepository = null,
        protected $verificationService = null)
    {
        $this->userRepository = app(UserRepository::class);
        $this->verificationService = app(VerificationCodeService::class);
    }

    public function loginUser(array $loginData): bool
    {
        $user = $this->userRepository
            ->findByMobile($loginData['mobile']);
        if (empty($user)) {
            $user = $this->userRepository
                ->createUser($loginData);
        }
        $verificationCode = $this->verificationService
            ->generateToken($user->mobile);
        event(new UserLoggedIn($user, $verificationCode));

        return true;
    }

    public function verifyUser(array $verifyData): bool|string
    {
        $user = $this->userRepository
            ->findByMobile($verifyData['mobile']);
        if (empty($user)) {
            return false;
        }

        $token = $this->verificationService
            ->isValid($user->mobile);
        if ($token !== $verifyData['code']) {
            return false;
        }
        $this->verificationService
            ->clearCode($user->mobile);
        UserVerified::dispatch($user);

        return $user->createToken('eli')->plainTextToken;
    }
}
