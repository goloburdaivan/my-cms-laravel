<?php

namespace App\Repository;

use App\Models\Product;

class ProductRepository extends AbstractRepository
{
    public function __construct()
    {
    }

    public function model(): string
    {
        return Product::class;
    }

    public function updateAttributes(int $id, array $attributes)
    {
        /** @var Product $product */
        $product = $this->find($id);
        $product->attributes()->sync($attributes);
    }
}
