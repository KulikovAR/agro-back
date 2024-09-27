<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\TransportType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class TransportTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        TransportType::factory()->count(30)->create();
    }
}
