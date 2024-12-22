<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Pipelines\Filters\FilterByArticle;
use App\Pipelines\Filters\FilterByCategory;
use App\Pipelines\Filters\FilterByName;
use App\Pipelines\Filters\FilterByPrice;
use App\Pipelines\Sorting\SortBy;
use App\Repository\ProductRepository;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(
        private readonly ProductRepository $productRepository,
    ) {
    }

    public function getDataForIndex(string $slug): Product
    {
        return $this->productRepository
            ->query()
            ->where('slug', $slug)
            ->firstOrFail()
            ->load(['category', 'images', 'attributes']);
    }

    public function getDataForCategoryPage(Category $category): Collection
    {
        $children = $category->children;
        $products = collect();

        foreach ($children as $child) {
            $products = $products->merge($child->products);
        }

        $products = $products->merge(Product::query()->where('category_id', $category->id)->get());

        return app(Pipeline::class)
            ->send($products)
            ->through([
                FilterByArticle::class,
                FilterByName::class,
                FilterByPrice::class,
                FilterByCategory::class,
                SortBy::class,
            ])
            ->thenReturn();
    }
}
