<?php

namespace App\Http\Controllers\Admin;

use App\Core\AbstractCRUDController;
use App\DTO\CRUDRelationsDTO;
use App\Enums\Admin\OrderStatus;
use App\Http\Requests\Admin\OrderRequest;
use App\Models\Order;
use App\Repository\OrderRepository;

class OrderController extends AbstractCRUDController
{
    protected string $viewFolder = 'orders';
    protected string $request = OrderRequest::class;

    public function __construct(
        private readonly OrderRepository $repository,
    ) {
        $this->modelClass = new Order();
        parent::__construct($repository);
    }

    public function createViewData(): array
    {
        return [
            'statuses' => OrderStatus::getList(),
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

    protected function relations(): CRUDRelationsDTO
    {
        return new CRUDRelationsDTO(show: ['items.product']);
    }
}
