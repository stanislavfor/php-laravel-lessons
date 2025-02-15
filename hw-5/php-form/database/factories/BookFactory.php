<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'author' => $this->faker->name,
            'genre' => $this->faker->randomElement(['fantasy', 'sci-fi', 'mystery', 'drama', 'romance', 'thriller', 'non-fiction']),
            'description' => $this->faker->paragraph,
            'publication_year' => $this->faker->year,
            'publisher' => $this->faker->company,
            'pages' => $this->faker->numberBetween(50, 1000),
            'cover' => $this->faker->imageUrl(),
        ];
    }
}
