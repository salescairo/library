<?php

declare(strict_types=1);

namespace App\Infra\Repositories;

use App\Infra\Contracts\UserInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserRepository extends ResourceRepository implements UserInterface
{
    public mixed $model = User::class;
    public array $relationships = [];

    public function customFilters(Builder $query, array $data): void
    {
        parent::customFilters($query, $data);

        array_key_exists(key: 'name', array: $data)
            && $query->where('name', 'like', '%' . $data[User::NAME_FIELD] . '%');
    }
}