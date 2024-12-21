<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
use App\Models\UserWishlist;
use App\Repository\UserWishlistRepository;
use Illuminate\Database\Eloquent\Collection;

class WishlistService
{
    public function __construct(
        private readonly UserWishlistRepository $userWishlistRepository,
    ) {
    }

    public function addToWishlist(User $user, Product $product): UserWishlist
    {
        /** @var UserWishlist */
        return $this->userWishlistRepository->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);
    }

    public function getUserWishlist(User $user): Collection
    {
        return $this
            ->userWishlistRepository
            ->query()
            ->where('user_id', $user->id)
            ->with(['product'])
            ->get();
    }

    public function delete(UserWishlist $wishlist): bool
    {
        return $this->userWishlistRepository->delete($wishlist->id);
    }
}
