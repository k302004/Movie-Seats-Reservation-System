<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Show;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowFactory extends Factory
{
    protected $model = Show::class;

    public function definition(): array
    {
        return [
            'movie_id' => Movie::factory(),
            'screen_name' => 'Screen ' . fake()->numberBetween(1, 5),
            'show_time' => fake()->dateTimeBetween('now', '+1 month'),
            'price' => fake()->randomFloat(2, 8, 20),
            'total_seats' => 50,
        ];
    }
}
