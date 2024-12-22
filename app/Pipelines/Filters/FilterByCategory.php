<?php

namespace App\Pipelines\Filters;

use Closure;

class FilterByCategory
{
    public function handle($products, Closure $next)
    {
        if ($categoryId = request('category_id')) {
            $products = $products->filter(function ($product) use ($categoryId) {
                return $product->category_id == $categoryId;
            });
        }

        return $next($products);
    }
}
