<?php

namespace Database\Seeders;

use App\Models\Counteragent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CounterAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Counteragent::factory()->count(10)->create();
    }
}
