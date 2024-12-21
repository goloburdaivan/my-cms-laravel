<?php

namespace App\Repository;

use App\Models\UserWishlist;

class UserWishlistRepository extends AbstractRepository
{
    public function model(): string
    {
        return UserWishlist::class;
    }
}
