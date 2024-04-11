<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Book extends Model
{
    use HasFactory;

    public const NAME_FIELD = 'name';
    public const YEAR_FIELD = 'year';
    public const SITUATION_FIELD = 'situation';
    public const BRAND_ID = 'brand_id';
    public const GENDER_ID = 'gender_id';
    public const RESERVED_FOR = 'gender_id';


    public const AVAILABLE_SITUATION = 'Disponível';
    public const RENTED_SITUATION = 'Alugado';
    public const RESERVED_SITUATION = 'Reservado';

    protected $fillable = [
        'name',
        'year',
        'situation',
        'reserved_for',
        'brand_id',
        'gender_id',
    ];

    protected $casts = [
        'return_date' => 'datetime:Y-m-d'
    ];

    public static function getSituations(): array
    {
        return [
            self::AVAILABLE_SITUATION,
            self::RENTED_SITUATION,
            self::RESERVED_SITUATION,
        ];
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function bookOutputs(): HasMany
    {
        return $this->hasMany(BookOutput::class)->orderByDesc('id');
    }

    public function bookLastOutput(): HasOne
    {
        return $this->hasOne(BookOutput::class)->ofMany();
    }

    public function rent(array $data): BookOutput|Model
    {
        $object = $this->bookOutputs()->create($data);
        $this->updateSituation(situation: self::RENTED_SITUATION);
        return $object;
    }

    public function return(): void
    {
        $object = $this->bookLastOutput();
        $object->update([
            'returned_at' => now()->toDateTimeString()
        ]);

        $this->updateSituation(situation: self::AVAILABLE_SITUATION);
    }

    public function updateSituation(string $situation): void
    {
        $this->situation = $situation;
        $this->save();
    }

    public function reserve(?string $name): void
    {
        $situation = is_null($name) ? self::AVAILABLE_SITUATION : self::RESERVED_SITUATION;
        $this->reserved_for = $name;
        $this->updateSituation($situation);
        $this->save();
    }

    public function itsAvailable(): bool
    {
        return $this->situation == self::AVAILABLE_SITUATION;
    }

    public function itsReserved(): bool
    {
        return $this->situation == self::RESERVED_SITUATION;
    }

    public function itsRented(): bool
    {
        return $this->situation == self::RENTED_SITUATION;
    }
}
