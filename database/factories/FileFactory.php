<?php

namespace Database\Factories;

use App\Enums\FileTypeEnum;
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
        $mockFile = $fileService->loadFile($fakeFile, FileTypeEnum::randomCase());

        return [
            'path' => $mockFile->path,
            'type' => $mockFile->type,
            'md5_hash' => md5($fakeFile),
            'name' => $fakeFile->getClientOriginalName(),
        ];
    }
}
