<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\TransportBrand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class TransportBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        TransportBrand::factory()->count(30)->create();
    }
}
