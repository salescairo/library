<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Brand;
use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'brand_id' => Brand::factory()->create()->id,
            'gender_id' => Gender::factory()->create()->id,
            'year' => fake()->numberBetween(1450, 2024),
            'situation' => Book::getSituations()[array_rand(Book::getSituations())]
        ];
    }
}
