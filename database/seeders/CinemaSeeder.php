<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CinemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cinema::factory()
            ->count(5)
            ->create()
            ->each(function ($cinema) {
                // Get random movies
                $movies = Movie::inRandomOrder()
                    ->take(3)
                    ->get();

                // Attach movies with random screening times
                $movies->each(function ($movie) use ($cinema) {
                    $cinema->movies()->attach($movie->id, [
                        'screening_time' => fake()->dateTimeBetween(
                            'now',
                            '+2 weeks'
                        ),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                });
            });
    }
}
