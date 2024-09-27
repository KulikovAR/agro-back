<?php

namespace Database\Seeders;

use App\Models\UnloadMethod;
use Illuminate\Database\Seeder;

class UnloadMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UnloadMethod::create(['title' => 'Боковая']);
        UnloadMethod::create(['title' => 'Задняя']);
        UnloadMethod::create(['title' => 'Самосвальная задняя']);
        UnloadMethod::create(['title' => 'Самосвальная боковая']);
    }
}
