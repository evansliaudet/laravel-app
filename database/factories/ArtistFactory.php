<?php

namespace Database\Factories;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Artist::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => substr($this->faker->firstName(), 0, 15),
            'name' => substr($this->faker->lastName(), 0, 20),
            'birthdate' => $this->faker->numberBetween(1940, 2000),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}

