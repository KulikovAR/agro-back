<?php

namespace Database\Seeders;

use App\Models\Driver;
use Database\Factories\TransportFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = Driver::factory()->count(30)->create();
        foreach($drivers as $driver)
        {
            $driver->transports()->create((new TransportFactory())->definition());
            
        }
    }
}
