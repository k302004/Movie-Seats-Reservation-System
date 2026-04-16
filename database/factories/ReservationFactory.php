<?php

namespace Database\Factories;

use App\Models\Seat;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    public function definition(): array
    {
        return [
            'seat_id' => Seat::factory(),
            'customer_name' => fake()->name(),
            'customer_email' => fake()->safeEmail(),
            'customer_phone' => fake()->optional()->phoneNumber(),
            'confirmation_code' => Reservation::generateConfirmationCode(),
            'is_confirmed' => true,
        ];
    }
}
