<?php

namespace App\Services\V1;

use App\Events\UserLoggedIn;
use App\Repositories\UserRepository;

class AuthService
{
    public function __construct(protected $userRepository = null)
    {
        $this->userRepository = app(UserRepository::class);
    }

    public function loginUser(array $loginData): bool
    {
        $user = $this->userRepository->findByMobile($loginData['mobile']);
        if (empty($user)) {
            $user = $this->userRepository->createUser($loginData);
        }
        $verificationCode = app(VerificationCodeService::class)
            ->generateToken($user->mobile);
        event(new UserLoggedIn($user, $verificationCode));

        //        UserLoggedIn::dispatch($user, $verificationCode);
        return true;
    }
}
