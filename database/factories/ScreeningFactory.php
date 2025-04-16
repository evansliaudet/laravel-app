<?php

namespace Database\Factories;

use App\Models\Screening;
use App\Models\Movie;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Screening>
 */
class ScreeningFactory extends Factory
{
    protected $model = Screening::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'movie_id' => Movie::factory(),
            'room_id' => Room::factory(),
            'screening_time' => fake()->dateTimeBetween('now', '+2 weeks'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
