<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'description' => fake()->paragraph(),
            'poster' => null,
            'duration' => fake()->numberBetween(90, 180),
            'genre' => fake()->randomElement(['Action', 'Comedy', 'Drama', 'Horror', 'Sci-Fi', 'Thriller']),
            'release_date' => fake()->dateTimeBetween('-1 year', '+1 year'),
            'rating' => fake()->randomFloat(1, 5, 10),
            'is_active' => true,
        ];
    }
}
