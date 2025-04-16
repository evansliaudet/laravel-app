<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 1;

        return [
            'name' => 'Room ' . $number++,
            'capacity' => $this->faker->numberBetween(50, 300),
            'cinema_id' => Cinema::factory(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
