<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Infra\Contracts\BookInterface;
use App\Models\Book;
use Illuminate\Database\Eloquent\Builder;

class BookRepository extends ResourceRepository implements BookInterface
{
    public mixed $model = Book::class;
    public array $relationships = ['brand', 'gender', 'bookOutputs', 'bookLastOutput'];

    public function customFilters(Builder $query, array $data): void
    {
        parent::customFilters($query, $data);

        array_key_exists(key: 'name', array: $data)
            && $query->where('name', 'like', '%' . $data[Book::NAME_FIELD] . '%');
    }
}