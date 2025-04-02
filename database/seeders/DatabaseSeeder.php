<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\ArtistSeeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\ArtistMovieSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        $this->call([
            CountrySeeder::class,
            ArtistSeeder::class,
            MovieSeeder::class,
            ArtistMovieSeeder::class,
        ]);
    }
}
