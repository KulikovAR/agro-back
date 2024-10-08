<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\Transport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class TransportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        Transport::factory()->count(5)->create();
    }
}
