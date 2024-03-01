<?php

namespace App\Services;

use App\Repositories\OrderRepository;

class OrderService
{
    public function __construct(protected $orderRepository = null)
    {
        $this->orderRepository = app(OrderRepository::class);
    }

    public function getOrders(array $data = [])
    {
        $orders = $this->orderRepository->getQuery();
        $this->applyFilter($orders, $orders);

        return $this->orderRepository->getAll($orders);
    }

    public function paginateOrders(array $data)
    {
        $orders = $this->orderRepository->getQuery();
        $this->addEager($orders);
        $this->applyFilter($orders, $data);

        return $this->orderRepository->paginate($orders);
    }

    public function applyFilter($query, array $filters): void
    {
        foreach ($filters as $key => $filterValue) {
            $query = match ($key) {
                'price_from' => $query->where('total_price', '>=', $filterValue),
            };
        }
    }

    public function addEager($query): void
    {
        $query->with('address');
    }
}
