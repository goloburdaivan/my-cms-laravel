<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\Http\Requests\Admin\CategoryRequest;
use App\Models\Category;
use App\Repository\CategoryRepository;

class CategoryController extends AbstractCRUDController
{
    protected string $viewFolder = "categories";
    protected string $request = CategoryRequest::class;

    public function __construct(private readonly CategoryRepository $repository)
    {
        $this->modelClass = new Category();
        parent::__construct($repository);
    }

    public function indexViewData(): array
    {
        return [
            'categories' => Category::all(),
        ];
    }

    public function createViewData(): array
    {
        return $this->indexViewData();
    }

    public function editViewData(): array
    {
        return $this->indexViewData();
    }
}
