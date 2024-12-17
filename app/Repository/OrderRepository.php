<?php

namespace App\Repository;

use App\Models\Order;

class OrderRepository extends AbstractRepository
{
    public function model(): string
    {
        return Order::class;
    }
}
