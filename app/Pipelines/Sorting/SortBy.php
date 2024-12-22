<?php

namespace App\Pipelines\Sorting;

use Closure;

class SortBy
{
    public function handle($products, Closure $next)
    {
        $sortOrder = request('sort');

        if ($sortOrder === 'price_asc') {
            $products = $products->sortBy('price');
        } elseif ($sortOrder === 'price_desc') {
            $products = $products->sortByDesc('price');
        }

        return $next($products);
    }
}
