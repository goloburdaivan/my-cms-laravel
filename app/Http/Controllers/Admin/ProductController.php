<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repository\ProductRepository;

class ProductController extends AbstractCRUDController
{
    protected string $viewFolder = 'products';
    protected string $request = ProductRequest::class;

    public function __construct(
        private readonly ProductRepository $repository,
    ) {
        $this->modelClass = new Product();
        parent::__construct($repository);
    }

    public function createViewData(): array
    {
        return [
            'categories' => Category::all(),
        ];
    }

    public function editViewData(): array
    {
        return $this->createViewData();
    }

    public function indexViewData(): array
    {
        return $this->createViewData();
    }
}
