<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Services\OrderService;

class UserController extends Controller
{
    public function __construct(protected $orderService = null)
    {
        $this->orderService = app(OrderService::class);
    }

    public function showInformation()
    {
        return $this->generateResponse(data: new UserResource(auth()->user()));
    }
}
