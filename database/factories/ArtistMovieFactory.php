<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory
 */
class ArtistMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'role_name' => $this->faker->randomElement(['Actor', 'Supporting Actor', 'Extra', 'Director', 'Producer', 'Stunt Double']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

