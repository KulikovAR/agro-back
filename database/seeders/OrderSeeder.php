<?php

namespace Database\Seeders;

use App\Enums\EnvironmentTypeEnum;
use App\Models\LoadType;
use App\Models\Order;
use Database\Factories\LoadTypeFactory;
use Database\Factories\OrderFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (App::environment(EnvironmentTypeEnum::productEnv())) {
            return;
        }
        $orders = Order::factory(5)->create();
        foreach ($orders as $order) {
            $order->loadTypes()->attach(LoadType::inRandomOrder()->first()->id);
        }
    }

}
