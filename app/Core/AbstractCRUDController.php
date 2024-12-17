<?php

namespace App\Core;

use App\Contracts\Filterable;
use App\DTO\CRUDRelationsDTO;
use App\Repository\AbstractRepository;
use App\Services\ImageStorageService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

abstract class AbstractCRUDController
{
    use RequestCreationTrait;

    protected Model $modelClass;
    protected string $viewFolder;
    protected int $paginationLimit = 10;

    public function __construct(
        private readonly AbstractRepository $repository,
    ) {
    }

    abstract public function indexViewData(): array;
    abstract public function createViewData(): array;
    abstract public function editViewData(): array;

    public function index(Request $request): View
    {
        $query = $this->repository->query();

        if ($this->modelClass instanceof Filterable) {
            $query = $this->repository->filter($request);
        }

        $data = [
            'items' => $query
                ->with($this->relations()->index)
                ->paginate($this->paginationLimit)
                ->withQueryString(),
        ];

        $data = array_merge($data, $this->indexViewData());

        return view("{$this->viewFolder}.index", $data);
    }

    public function create(): View
    {
        return view("{$this->viewFolder}.create", $this->createViewData());
    }

    public function show(int $id): View
    {
        $item = $this->repository->find($id)->load($this->relations()->show);
        return view("{$this->viewFolder}.show", compact('item'));
    }

    public function store(): RedirectResponse
    {
        $createRequest = app($this->createRequest());
        $model = $this->repository->create($createRequest->safe()->except(['image']));
        $this->uploadPhoto($createRequest, $model);

        return redirect()->route("admin.{$this->viewFolder}.index")
            ->with('success', 'Resource created successfully.');
    }

    public function edit(int $id): View
    {
        $data = [
            'item' => $this->repository->find($id)->load($this->relations()->edit),
        ];

        $data = array_merge($data, $this->editViewData());

        return view("{$this->viewFolder}.edit", $data);
    }

    public function update(int $id): RedirectResponse
    {
        $updateRequest = app($this->updateRequest());

        $model = $this->repository->update($id, $updateRequest->safe()->except(['image']));
        $this->uploadPhoto($updateRequest, $model);

        return redirect()->route("admin.{$this->viewFolder}.index")
            ->with('success', 'Resource updated successfully.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->repository->delete($id);

        return redirect()->route("admin.{$this->viewFolder}.index")
            ->with('success', 'Resource deleted successfully.');
    }

    private function uploadPhoto(Request $request, Model $model): void
    {
        $service = app(ImageStorageService::class);
        if ($request->hasFile('image')) {
            $path = $service->upload('public', $this->viewFolder, $request->file('image'));
            $this->repository->update($model->id, [
                'image' => $path,
            ]);
        }
    }

    protected function relations(): CRUDRelationsDTO
    {
        return new CRUDRelationsDTO();
    }
}
