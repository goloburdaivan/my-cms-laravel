<?php

namespace App\Pipelines\Filters;

use Closure;

class FilterByName
{
    public function handle($products, Closure $next)
    {
        if ($name = request('name')) {
            $products = $products->filter(function ($product) use ($name) {
                return stripos($product->name, $name) !== false;
            });
        }

        return $next($products);
    }
}
