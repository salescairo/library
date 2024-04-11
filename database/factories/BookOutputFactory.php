<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookOutput;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookOutput>
 */
class BookOutputFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = BookOutput::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'identification' => (string) fake()->numberBetween(1000, 100000),
            'return_date' => now()->addDays(value: 10),
            'book_id' => Book::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
        ];
    }
}
