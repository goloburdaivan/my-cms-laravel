<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\DTO\CRUDRelationsDTO;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Requests\Admin\UpdateProductAttributesRequest;
use App\Models\Attribute;
use App\Models\Category;
use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\RedirectResponse;

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
        return array_merge($this->createViewData(), [
            'attributes' => Attribute::all(),
        ]);
    }

    public function indexViewData(): array
    {
        return $this->createViewData();
    }

    public function updateAttributes(int $id, UpdateProductAttributesRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->repository->updateAttributes($id, $data['attributes']);
        return redirect()->route('admin.products.edit', $id);
    }

    protected function relations(): CRUDRelationsDTO
    {
        return new CRUDRelationsDTO(
            ['category'],
        );
    }
}
