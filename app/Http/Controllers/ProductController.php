<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ProductService;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    public function index(string $slug): View
    {
        return view('site.products.show', [
            'product' => $this->productService->getDataForIndex($slug),
        ]);
    }

    public function category(Category $category): View
    {
        $products = $this->productService->getDataForCategoryPage($category);
        return view('site.category.index', [
            'products' => $products,
            'categories' => $category->children,
            'category' => $category,
        ]);
    }
}
