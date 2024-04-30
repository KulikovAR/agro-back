<?php

namespace Database\Factories;

use App\Services\FileService;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fileService = new FileService();
        $fakeFile = UploadedFile::fake()->create('test_file.jpg');
        return [
            'path' => $fileService->loadFile($fakeFile),
        ];
    }
}
