<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\BusinessException;
use App\Infra\Contracts\BrandInterface;
use App\Infra\Contracts\BookInterface;
use App\Infra\Contracts\GenderInterface;
use App\Models\Book;
use App\Utils\Message;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    public function __construct(
        private readonly BookInterface $repository,
        private readonly BrandInterface $brand_repository,
        private readonly GenderInterface $gender_repository
    ) {
    }

    public function findPaginate(array $data): LengthAwarePaginator
    {
        return $this->repository->findPaginate($data);
    }

    public function findAll(array $data): Collection
    {
        return $this->repository->findAll($data)->map(function (Book $product) {
            $product->content = $product->name . ' - ' . $product->brand->name;
            return $product;
        });
    }

    public function findById(int $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function save(array $data): ?object
    {
        $data[Book::BRAND_ID] = $this->brand_repository->findById((int) $data[Book::BRAND_ID])?->id;
        $data[Book::GENDER_ID] = $this->gender_repository->findById((int) $data[Book::GENDER_ID])?->id;
        return $this->repository->save($data);
    }

    public function update(int $id, array $data): ?object
    {
        array_key_exists(key: Book::BRAND_ID,array: $data)
            && $this->brand_repository->findById((int) $data[Book::BRAND_ID])?->id;

        array_key_exists(key: Book::GENDER_ID,array: $data)
            && $this->gender_repository->findById((int) $data[Book::GENDER_ID])?->id;

        return $this->repository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        $model = $this->findById($id);
        if (count($model->bookOutputs) > 0) {
            Message::danger();
            return false;
        }
        return $this->repository->delete($id);
    }

    public function rent(int $id, array $data): ?object
    {
        $model = $this->findById($id);
        !$model->itsAvailable() && throw new BusinessException(message: 'O livro não está disponível para alguar');
        $data['user_id'] = auth()->user()->id;
        return $model->rent($data);
    }

    public function return(int $id): void
    {
        $model = $this->findById($id);
        $model->return();
    }

    public function reserve(int $id, string $reserved_for = null): void
    {
        $model = $this->findById($id);
        $model->reserve($reserved_for);
    }
}