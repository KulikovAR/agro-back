<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\LoadType;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

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
