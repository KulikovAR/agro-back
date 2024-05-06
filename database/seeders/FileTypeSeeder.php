<?php

namespace Database\Seeders;

use App\Models\FileType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FileType::create(['title' => 'Аватар']);
        FileType::create(['title' => 'ПСФЛ']);
        FileType::create(['title' => 'ЕФС']);
        FileType::create(['title' => 'Реквизиты']);
        FileType::create(['title' => 'Налоговая тайна']);
        FileType::create(['title' => 'Патент']);
        FileType::create(['title' => 'УСН']);
        FileType::create(['title' => 'НДС']);
    }
}
