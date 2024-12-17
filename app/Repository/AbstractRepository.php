<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class AbstractRepository
{
    public function query(): Builder
    {
        $modelName = $this->model();

        /** @var Model $model */
        $model = new $modelName();
        return $model::query();
    }

    public function create(array $data): Model
    {
        $modelName = $this->model();
        $model = new $modelName();
        $model->fill($data);
        $model->save();

        return $model;
    }

    public function update(int $id, array $data): Model
    {
        $model = $this->find($id);
        $model->fill($data);

        if (!$model->save()) {
            throw new \Exception("Failed to save model " . $model->getTable() . " id = $model->id");
        }

        return $model;
    }

    public function delete(int $id): bool
    {
        $model = $this->find($id);
        return $model->delete();
    }

    public function find(int $id): ?Model
    {
        $modelName = $this->model();

        return $modelName::query()->findOrFail($id);
    }

    abstract public function model(): string;

    public function filter(Request $request): Builder
    {
        $modelName = $this->model();
        $model = new $modelName();
        $query = $model->newQuery();

        if (method_exists($model, 'filters')) {
            $filters = $model->filters();

            foreach ($filters as $requestField => $filterConfig) {
                if ($request->has($requestField)) {
                    $value = $request->input($requestField);
                    $queryField = $filterConfig['query_field'];
                    $operator = $filterConfig['operator'];

                    $this->applyFilter($query, $queryField, $operator, $value);
                }
            }
        }

        return $query;
    }

    protected function applyFilter(Builder $query, string $field, string $operator, $value): void
    {
        if (!empty($value)) {
            if (str_contains($field, '.')) {
                [$relation, $relationField] = explode('.', $field);
                $query->whereHas($relation, function ($q) use ($relationField, $operator, $value) {
                    $q->where($relationField, $operator, $operator === 'like' ? "%$value%" : $value);
                });
            } else {
                $query->where($field, $operator, $operator === 'like' ? "%$value%" : $value);
            }
        }
    }
}
