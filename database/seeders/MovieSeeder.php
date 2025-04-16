<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Movie;
use App\Models\Artist;

class MovieSeeder extends Seeder
{
    private $roles = [
        'Lead',
        'Co-star',
        'Villain',
        'Sidekick',
        'Mentor',
        'Friend',
        'Father',
        'Mother',
        'Brother',
        'Sister',
        'Detective',
        'Doctor',
        'Lawyer',
        'Teacher',
        'Boss',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory()
            ->count(20)
            ->create()
            ->each(function ($movie) {
                $actors = Artist::inRandomOrder()
                    ->take(fake()->numberBetween(3, 5))
                    ->get();

                $actors->each(function ($actor) use ($movie) {
                    $movie->actors()->attach($actor->id, [
                        'role_name' => fake()->randomElement($this->roles),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                });
            });
    }
}
