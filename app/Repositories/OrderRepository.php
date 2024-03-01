<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function __construct()
    {

    }

    public function getClass()
    {
        return new Order();
    }

    public function getQuery()
    {
        return Order::query();
    }

    public function getFirst($query)
    {
        return $query->first();
    }

    public function getAll($query)
    {
        return $query->get();
    }

    public function paginate($query)
    {
        return $query->paginate();
    }
}
