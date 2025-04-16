<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Movie;
use App\Models\Screening;
use Illuminate\Database\Seeder;

class ScreeningSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Room::all()->each(function ($room) {
            $movies = Movie::inRandomOrder()
                ->take(3)
                ->get();

            foreach ($movies as $movie) {
                Screening::create([
                    'movie_id' => $movie->id,
                    'room_id' => $room->id,
                    'screening_time' => fake()->dateTimeBetween(
                        'now',
                        '+2 weeks'
                    ),
                ]);
            }
        });
    }
}
