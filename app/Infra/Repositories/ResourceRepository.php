<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Exceptions\EntityNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

abstract class ResourceRepository
{
    public mixed $model;
    public array $relationships;

    public function __construct()
    {
        $this->model = app($this->model);
    }

    public function save(array $data): ?object
    {
        $object = (new $this->model)->fill($data);
        $object->save();
        return $object;
    }

    public function delete(int $id): bool
    {
        $object = $this->findById($id);
        is_null($object) && throw new EntityNotFoundException();
        return $object->delete();
    }

    public function update(int $id, array $data): ?object
    {
        $object = $this->findById($id);
        is_null($object) && throw new EntityNotFoundException();
        $object->fill($data);
        $object->save();
        return $object;
    }

    public function findPaginate(array $data): LengthAwarePaginator
    {
        $query = $this->getBuilder();
        $this->customFilters($query, $data);
        return $query->paginate();
    }

    public function findAll(array $data): array|Collection
    {
        $query = $this->getBuilder();
        $this->customFilters($query, $data);
        return $query->get();
    }

    public function findById(int $id): ?object
    {
        return $this->getBuilder()->find($id);
    }

    public function getBuilder(): Builder
    {
        return $this->model->query()->with($this->relationships);
    }

    public function customFilters(Builder $query, array $data): void
    {
    }
}