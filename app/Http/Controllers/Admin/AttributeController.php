<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\Http\Requests\Admin\AttributeRequest;
use App\Models\Attribute;
use App\Repository\AttributeRepository;

class AttributeController extends AbstractCRUDController
{
    protected string $viewFolder = 'attributes';
    protected string $request = AttributeRequest::class;

    public function __construct(
        private readonly AttributeRepository $repository,
    ) {
        $this->modelClass = new Attribute();
        parent::__construct($repository);
    }

    public function createViewData(): array
    {
        return [];
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
