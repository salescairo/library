<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Infra\Contracts\BrandInterface;
use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder;

class BrandRepository extends ResourceRepository implements BrandInterface
{
    public mixed $model = Brand::class;
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