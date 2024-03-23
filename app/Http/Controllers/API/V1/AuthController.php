<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Auth\LoginRequest;
use App\Services\V1\AuthService;

class AuthController extends Controller
{
    public function __construct(protected $authService = null)
    {
        $this->authService = app(AuthService::class);
    }

    public function login(LoginRequest $request)
    {
        $result = $this->authService->loginUser($request->validated());
        if ($result) {
            return $this->generateResponse(message: __('Verification code has been sent'));
        }

        return $this->generateErrorResponse(message: __('We`ve got a big problem'));
    }
}
