<?php

declare(strict_types=1);

namespace App\Services;

use App\Infra\Contracts\BookOutputInterface;
use App\Infra\Contracts\BookInterface;
use App\Models\BookOutput;
use Illuminate\Pagination\LengthAwarePaginator;

class BookOutputService
{
    public function __construct(
        private readonly BookOutputInterface $repository,
        private readonly BookInterface $product_repository
    ) {
    }

    public function findPaginate(array $data): LengthAwarePaginator
    {
        return $this->repository->findPaginate($data);
    }

    public function findById(int $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function save(array $data): ?object
    {
        $data[BookOutput::BOOK_ID_FIELD] = $this->product_repository->findById((int) $data[BookOutput::BOOK_ID_FIELD])?->id;
        $data[BookOutput::USER_ID_FIELD] = auth()->user()->id;
        return $this->repository->save($data);
    }

    public function update(int $id, array $data): ?object
    {
        array_key_exists(key: BookOutput::BOOK_ID_FIELD,array: $data)
            && $this->product_repository->findById((int) $data[BookOutput::BOOK_ID_FIELD])?->id;
        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}