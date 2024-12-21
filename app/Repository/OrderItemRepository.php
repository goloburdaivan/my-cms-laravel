<?php

namespace App\Repository;

use App\Models\OrderItem;

class OrderItemRepository extends AbstractRepository
{
    public function model(): string
    {
        return OrderItem::class;
    }
}
