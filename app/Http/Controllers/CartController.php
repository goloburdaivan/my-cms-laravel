<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function addToCart(Product $product, Request $request): JsonResponse
    {
        $cart = session()->get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'name' => $product->name,  // Сохраняем только имя товара
                'price' => $product->price,  // Сохраняем цену товара
                'quantity' => $quantity,  // Сохраняем количество
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'message' => 'Товар успешно добавлен в корзину!',
            'cart_count' => array_sum(array_column($cart, 'quantity')), // Общее количество товаров в корзине
        ]);
    }

    public function index(): View
    {
        $cart = session()->get('cart', []);
        return view('site.cart.index', compact('cart'));
    }

    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Создаем заказ
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'email' => $validated['email'],
            'status' => 'new',
            'total_price' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], session('cart'))),
        ]);

        foreach (session('cart') as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Ваш заказ успешно оформлен!');
    }
}

