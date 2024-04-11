<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    public const NAME_FIELD = 'name';
    public const ENABLED_FIELD = 'enabled';

    protected $fillable = [
        'name',
        'enabled',
    ];
}
