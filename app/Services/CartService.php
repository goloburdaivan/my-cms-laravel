<?php

namespace App\Services;

use App\Enums\Admin\OrderStatus;
use App\Http\Requests\User\CheckoutRequest;
use App\Models\OrderItem;
use App\Models\Product;
use App\Repository\OrderItemRepository;
use App\Repository\OrderRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly OrderItemRepository $orderItemRepository,
    )
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart(Product $product, int $quantity): array
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return $cart;
    }

    public function checkout(CheckoutRequest $request): void
    {
        $data = $request->validated();

        $order = $this->orderRepository->create([
            'user_id' => $request->user()?->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'email' => $data['email'],
            'status' => OrderStatus::PROCESSING,
            'total_price' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart'))),
        ]);

        foreach (session('cart') as $productId => $item) {
            $this->orderItemRepository->create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');
    }
}
