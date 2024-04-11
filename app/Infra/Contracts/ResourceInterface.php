<?php

namespace App\Infra\Contracts;

use Illuminate\Pagination\LengthAwarePaginator;

interface ResourceInterface
{
    public function save(array $data): ?object;
    public function delete(int $id): bool;
    public function update(int $id, array $data): ?object;

    public function findPaginate(array $data): LengthAwarePaginator;
    public function findAll(array $data): mixed;
    public function findById(int $id): ?object;
}