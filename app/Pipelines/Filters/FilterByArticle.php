<?php

namespace App\Pipelines\Filters;

use Closure;

class FilterByArticle
{
    public function handle($products, Closure $next)
    {
        if ($article = request('article')) {
            $products = $products->filter(function ($product) use ($article) {
                return stripos($product->article, $article) !== false;
            });
        }

        return $next($products);
    }
}
