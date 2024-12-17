<?php

namespace App\Services;

use App\Models\Product;
use App\Repository\ProductRepository;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    )
    {
    }

    public function getDataForIndex(string $slug): Product
    {
        return $this->productRepository
            ->query()
            ->where('slug', $slug)
            ->firstOrFail()
            ->load(['category', 'images', 'attributes']);
    }
}
