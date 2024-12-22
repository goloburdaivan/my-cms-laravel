<?php

namespace App\Pipelines\Filters;

use Closure;

class FilterByPrice
{
    public function handle($products, Closure $next)
    {
        $minPrice = request('min_price');
        $maxPrice = request('max_price');

        $products = $products->filter(function ($product) use ($minPrice, $maxPrice) {
            return (!$minPrice || $product->price >= $minPrice) &&
                (!$maxPrice || $product->price <= $maxPrice);
        });

        return $next($products);
    }
}
