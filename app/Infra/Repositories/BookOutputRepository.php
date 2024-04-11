<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Infra\Contracts\BookOutputInterface;
use App\Models\BookOutput;
use Illuminate\Database\Eloquent\Builder;

class BookOutputRepository extends ResourceRepository implements BookOutputInterface
{
    public mixed $model = BookOutput::class;
    public array $relationships = ['book.brand', 'book.gender'];

    public function customFilters(Builder $query, array $data): void
    {
        parent::customFilters($query, $data);

        array_key_exists(key: 'name', array: $data)
            && $query->whereRelation('book', 'name', 'like', '%' . $data[Product::NAME_FIELD] . '%');
    }
}