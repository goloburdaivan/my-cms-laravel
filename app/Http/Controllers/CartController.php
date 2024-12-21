<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CheckoutRequest;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    public function __construct(
        private readonly CartService $cartService,
    ) {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart(Product $product, Request $request): JsonResponse
    {
        $cart = $this->cartService->addToCart($product, $request->input('quantity', 1));
        return response()->json([
            'message' => 'Товар успешно добавлен в корзину!',
            'cart_count' => array_sum(array_column($cart, 'quantity')), // Общее количество товаров в корзине
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): View|RedirectResponse
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('home');
        }

        return view('site.cart.index', compact('cart'));
    }

    public function checkout(CheckoutRequest $request): RedirectResponse
    {
        $this->cartService->checkout($request);
        return redirect()->route('home')->with('success', 'Ваш заказ успешно оформлен!');
    }
}

