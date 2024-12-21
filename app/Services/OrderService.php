<?php

namespace App\Services;

use App\Models\User;
use App\Repository\OrderRepository;
use Illuminate\Database\Eloquent\Collection;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
    ) {
    }

    public function getOrdersForUser(User $user): Collection
    {
        return $this->orderRepository
            ->query()
            ->where('user_id', $user->id)
            ->with(['items.product'])
            ->get();
    }
}
