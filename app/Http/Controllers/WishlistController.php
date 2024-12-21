<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\UserWishlist;
use App\Services\WishlistService;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    public function __construct(
        private readonly WishlistService $wishlistService
    )
    {
    }

    public function addToWishlist(Product $product): JsonResponse
    {
        $this->wishlistService->addToWishlist(request()->user(), $product);

        return response()->json([
            'success' => true,
        ]);
    }

    public function removeFromWishlist(UserWishlist $wishlist): JsonResponse
    {
        $this->wishlistService->delete($wishlist);

        return response()->json([
            'success' => true,
        ]);
    }
}
