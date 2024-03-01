<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\OrderIndexRequest;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(protected $orderService = null)
    {
        $this->orderService = app(OrderService::class);
    }

    public function index(OrderIndexRequest $request)
    {
        $orders = $this->orderService->paginateOrders($request->validated());

        return $this->generateResponse($orders, true);
    }
}
