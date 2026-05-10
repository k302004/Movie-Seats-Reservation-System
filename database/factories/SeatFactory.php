<?php

namespace Database\Factories;

use App\Models\Show;
use App\Models\Seat;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeatFactory extends Factory
{
    protected $model = Seat::class;

    public function definition(): array
    {
        return [
            'show_id' => Show::factory(),
            'row' => fake()->randomElement(['A', 'B', 'C', 'D', 'E']),
            'number' => fake()->numberBetween(1, 10),
            'is_available' => true,
            'price' => 12.99,
        ];
    }
}
