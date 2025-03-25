<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->insert([
            [
                'name' => 'United States of America',
                'created_at' => now(),
            ],
            [
                'name' => 'France',
                'created_at' => now(),
            ],
            [
                'name' => 'Portugal',
                'created_at' => now(),
            ],
            [
                'name' => 'Italia',
                'created_at' => now(),
            ],
            [
                'name' => 'Suisse',
                'created_at' => now(),
            ],
        ]);
    }
}
