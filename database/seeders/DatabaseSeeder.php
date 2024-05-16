<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\ProductSeeder\ProductSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(FileSeeder::class);
        $this->call(FileTypeSeeder::class);
        $this->call(LoadTypeSeeder::class);
        $this->call(UnloadMethodSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(OrderSeeder::class);
//        $this->call(TransportSeeder::class);
//        $this->call(DriverSeeder::class);
//        $this->call(ProductSeeder::class);

        // $this->call(CounterAgentSeeder::class);
    }
}
