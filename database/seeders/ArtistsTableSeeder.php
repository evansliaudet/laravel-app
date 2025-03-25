<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'name' => 'Coppola',
                'firstname' => 'Francis Ford',
                'birthdate' => 1939,
                'created_at' => now(),
            ],
            [
                'name' => 'Lynch',
                'firstname' => 'David',
                'birthdate' => 1946,
                'created_at' => now(),
            ],
            [
                'name' => 'Spielberg',
                'firstname' => 'Steven',
                'birthdate' => 1946,
                'created_at' => now(),
            ],
            [
                'name' => 'Theron',
                'firstname' => 'Charlize',
                'birthdate' => 1975,
                'created_at' => now(),
            ],
            [
                'name' => 'Russo',
                'firstname' => 'Anthony',
                'birthdate' => 1975,
            ],
        ]);
    }
}
