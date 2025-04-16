<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Cinema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cinema::all()->each(function ($cinema) {
            Room::factory()
                ->count(fake()->numberBetween(3, 6))
                ->create(['cinema_id' => $cinema->id]);
        });
    }
}
