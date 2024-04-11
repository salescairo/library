<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookOutput extends Model
{
    use HasFactory;

    public const NAME_FIELD = 'name';
    public const IDENTIFICATION_FIELD = 'identification';
    public const USER_ID_FIELD = 'user_id';
    public const BOOK_ID_FIELD = 'book_id';

    protected $fillable = [
        'name',
        'identification',
        'book_id',
        'user_id',
        'return_date',
        'returned_at',
    ];

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
