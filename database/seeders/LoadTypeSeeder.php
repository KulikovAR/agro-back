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
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        LoadType::create(['title' => 'Маниту']);
        LoadType::create(['title' => 'Зерномёт']);
        LoadType::create(['title' => 'Из-под трубы']);
        LoadType::create(['title' => 'Комбайн']);
        LoadType::create(['title' => 'Кун']);
        LoadType::create(['title' => 'Амкодор']);
        LoadType::create(['title' => 'Вертикальный']);
        LoadType::create(['title' => 'Элеватор']);
    }
}
