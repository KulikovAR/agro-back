<?php

namespace Database\Seeders;

use App\Models\LoadType;
use Illuminate\Database\Seeder;

class LoadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoadType::create(['title' => 'Сцепки']);
        LoadType::create(['title' => 'Полуприцеп']);
        LoadType::create(['title' => 'Тонар']);
    }
}
