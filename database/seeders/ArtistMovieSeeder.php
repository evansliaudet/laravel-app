<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Movie;
use Database\Factories\ArtistMovieFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArtistMovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = Movie::all();
        $artists = Artist::all();
        
        foreach ($movies as $movie) {
            $selectedArtists = $artists->random(min(3, $artists->count()));

            if ($selectedArtists->count() < 3) {
                continue;
            }
            
            $roles = ['Lead Actor', 'Supporting Actor', 'Cameo'];
            
            foreach ($selectedArtists as $index => $artist) {
                $role = $index < count($roles) ? $roles[$index] : app(ArtistMovieFactory::class)->definition()['role_name'];
                
                $exists = $movie->actors()->where('artist_id', $artist->id)->exists();
                
                if (!$exists) {
                    $movie->actors()->attach($artist->id, [
                        'role_name' => $role,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

