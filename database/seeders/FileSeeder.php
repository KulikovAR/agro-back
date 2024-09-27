<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        File::factory(10)->create();
    }
}
