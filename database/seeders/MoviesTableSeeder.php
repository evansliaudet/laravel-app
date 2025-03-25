<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('movies')->insert([
            [
                'title' => 'Jurassic Park',
                'year' => 1993,
            ],
            [
                'title' => 'Avengers Endgame',
                'year' => 2019,
            ],
            [
                'title' => 'Inception',
                'year' => 2010,
            ],
            [
                'title' => 'The Dark Knight',
                'year' => 2008,
            ],
            [
                'title' => 'Interstellar',
                'year' => 2014,
            ]
        ]);
    }
}
