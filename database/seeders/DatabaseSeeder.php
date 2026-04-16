<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Seat;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@movie.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Test User',
            'email' => 'user@movie.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        $movies = [
            [
                'title' => 'The Matrix',
                'description' => 'A computer hacker learns about the true nature of reality and his role in the war against its controllers.',
                'duration' => 136,
                'genre' => 'Sci-Fi',
                'release_date' => '1999-03-31',
                'rating' => 8.7,
            ],
            [
                'title' => 'Inception',
                'description' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea.',
                'duration' => 148,
                'genre' => 'Sci-Fi',
                'release_date' => '2010-07-16',
                'rating' => 8.8,
            ],
            [
                'title' => 'The Dark Knight',
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological tests.',
                'duration' => 152,
                'genre' => 'Action',
                'release_date' => '2008-07-18',
                'rating' => 9.0,
            ],
            [
                'title' => 'Interstellar',
                'description' => 'A team of explorers travel through a wormhole in space in an attempt to ensure humanitys survival.',
                'duration' => 169,
                'genre' => 'Sci-Fi',
                'release_date' => '2014-11-07',
                'rating' => 8.6,
            ],
            [
                'title' => 'Pulp Fiction',
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife intertwine in four tales of violence and redemption.',
                'duration' => 154,
                'genre' => 'Crime',
                'release_date' => '1994-10-14',
                'rating' => 8.9,
            ],
            [
                'title' => 'The Shawshank Redemption',
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'duration' => 142,
                'genre' => 'Drama',
                'release_date' => '1994-09-23',
                'rating' => 9.3,
            ],
        ];

        foreach ($movies as $movieData) {
            $movie = Movie::create($movieData);

            $showDates = [
                Carbon::today()->addDays(1),
                Carbon::today()->addDays(2),
                Carbon::today()->addDays(3),
            ];

            $screens = ['Screen 1', 'Screen 2', 'Screen 3'];
            $times = ['14:00', '17:30', '21:00'];

            foreach ($showDates as $index => $date) {
                foreach ($times as $timeIndex => $time) {
                    $show = Show::create([
                        'movie_id' => $movie->id,
                        'screen_name' => $screens[($index + $timeIndex) % count($screens)],
                        'show_time' => $date->copy()->setTimeFromTimeString($time),
                        'price' => rand(10, 15) + 0.99,
                        'total_seats' => 50,
                    ]);

                    $rows = ['A', 'B', 'C', 'D', 'E'];
                    $seatsPerRow = 10;

                    foreach ($rows as $row) {
                        for ($seatNum = 1; $seatNum <= $seatsPerRow; $seatNum++) {
                            Seat::create([
                                'show_id' => $show->id,
                                'row' => $row,
                                'number' => $seatNum,
                                'is_available' => true,
                                'price' => $show->price,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
