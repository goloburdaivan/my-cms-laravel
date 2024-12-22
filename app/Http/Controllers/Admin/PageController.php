<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use App\Repository\PageRepository;

class PageController extends AbstractCRUDController
{
    protected string $viewFolder = 'pages';
    protected string $request = PageRequest::class;

    public function __construct(
        private readonly PageRepository $repository,
    ) {
        $this->modelClass = new Page();
        parent::__construct($repository);
    }

    public function createViewData(): array
    {
        return [
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
