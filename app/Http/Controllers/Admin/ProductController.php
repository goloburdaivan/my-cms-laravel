<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\Models\Category;
use App\Models\Product;
use App\Repository\ProductRepository;

class ProductController extends AbstractCRUDController
{
    public function __construct(
        private readonly ProductRepository $repository,
    ) {
        $this->modelClass = new Product();
        $this->viewFolder = 'products';
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
