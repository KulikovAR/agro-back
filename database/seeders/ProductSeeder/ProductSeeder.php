<?php

namespace Database\Seeders\ProductSeeder;

use App\Enums\EnvironmentTypeEnum;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        Product::factory()->count(10)->create();
    }
}
