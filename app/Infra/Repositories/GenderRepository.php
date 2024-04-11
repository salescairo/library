<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Infra\Contracts\GenderInterface;
use App\Models\Brand;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Builder;

class GenderRepository extends ResourceRepository implements GenderInterface
{
    public mixed $model = Gender::class;
    public array $relationships = [];

    public function customFilters(Builder $query, array $data): void
    {
        parent::customFilters($query, $data);

        array_key_exists(key: 'name', array: $data)
            && $query->where('name', 'like', '%' . $data[Brand::NAME_FIELD] . '%');

        array_key_exists(key: 'enabled', array: $data)
            && $query->where('enabled', $data[Brand::ENABLED_FIELD]);
    }
}