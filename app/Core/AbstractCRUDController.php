<?php

namespace App\Core;

use App\Contracts\Filterable;
use App\Repository\AbstractRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

abstract class AbstractCRUDController
{
    protected Filterable $modelClass;
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
        $query = $this->repository->filter($request);

        $data = [
            'items' => $query->paginate($this->paginationLimit),
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
        $item = $this->repository->find($id);
        return view("{$this->viewFolder}.show", compact('item'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->repository->create($request->all());

        return redirect()->route("admin.{$this->viewFolder}.index")
            ->with('success', 'Resource created successfully.');
    }

    public function edit(int $id): View
    {
        $data = [
            'item' => $this->repository->find($id),
        ];

        $data = array_merge($data, $this->editViewData());

        return view("{$this->viewFolder}.edit", $data);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->repository->update($id, $request->all());

        return redirect()->route("admin.{$this->viewFolder}.index")
            ->with('success', 'Resource updated successfully.');
    }

    public function destroy($id): RedirectResponse
    {
        $this->repository->delete($id);

        return redirect()->route("{$this->viewFolder}.index")
            ->with('success', 'Resource deleted successfully.');
    }
}
