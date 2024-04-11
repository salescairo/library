<?php

declare(strict_types=1);

namespace App\Services;

use App\Infra\Contracts\BrandInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BrandService
{
    public function __construct(private readonly BrandInterface $repository)
    {
    }

    public function findPaginate(array $data): LengthAwarePaginator
    {
        return $this->repository->findPaginate($data);
    }

    public function findAll(array $data): Collection
    {
        return $this->repository->findAll($data);
    }

    public function findEnabledAll(): Collection
    {
        $data['enabled'] = true;
        return $this->repository->findAll($data);
    }

    public function findById(int $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function save(array $data): ?object
    {
        return $this->repository->save($data);
    }

    public function update(int $id, array $data): ?object
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}